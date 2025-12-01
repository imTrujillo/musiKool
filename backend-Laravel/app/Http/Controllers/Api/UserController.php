<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Http\Traits\CanLoadRelationships;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

/**
 * @group Artistas
 *
 * Endpoints para administrar los artistas.
 */
class UserController extends Controller
{
    use CanLoadRelationships;
    private array $relations = ['songs', 'favorites', 'reviews'];
    /**
     * Obtener artistas.
     *
     * @unauthenticated
     */
    public function index(Request $request)
    {
        Gate::authorize('viewAny', User::class);

        $name = $request->query('name');
        $filter = $request->query('filter', '');

        $users = User::when(
            $name,
            fn($q, $name) => $q->name($name)
        );

        $users = match ($filter) {
            'most_songs' => $users->mostSongs(),
            default => $users->latest()
        };

        $users = $this->loadRelationships($users)->withSongsCount();

        return UserResource::collection($users->paginate(25));
    }

    /**
     * Mostrar un artista.
     *
     * @unauthenticated
     */
    public function show(User $user)
    {
        Gate::authorize('view', $user);
        return new UserResource($this->loadRelationships($user));
    }

    /**
     * Guardar un artista.
     */
    public function store(UserRequest $request)
    {
        Gate::authorize('create', User::class);

        $user = User::create($request->validated());

        $user = $this->loadRelationships($user);
        return new UserResource($user);
    }

    /**
     * Actualizar un artista.
     */
    public function update(UserRequest $request, User $user)
    {
        Gate::authorize('update', $user);
        $user->update($request->validated());

        return new UserResource($this->loadRelationships($user));
    }

    /**
     * Eliminar un artista.
     */
    public function destroy(User $user)
    {
        Gate::authorize('delete', $user);
        $user->delete();

        return response(status: 204);
    }
}
