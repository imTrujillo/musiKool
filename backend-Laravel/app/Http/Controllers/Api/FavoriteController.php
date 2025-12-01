<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChordResource;
use App\Http\Resources\FavoriteResource;
use App\Http\Resources\SongResource;
use App\Http\Resources\UserResource;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

/**
 * @group Favoritos
 *
 * Endpoints para marcar o desmarcar un item como favorito.
 */
class FavoriteController extends Controller
{
    /**
     * Buscar favoritos de un modelo.
     */
    public function index(User $user, Request $request)
    {
        Gate::authorize('viewMySongs', $user);
        $model = $request->query('model', 'Song');

        $items = Favorite::myFavorites($model, $request->user());

        return match ($model) {
            "Song" => SongResource::collection($items->withAvgRating()->withReviewsCount()->with(['artist', 'genre'])->latest()->paginate(5)),
            "Chord" => ChordResource::collection($items->paginate(5)),
            "User" => UserResource::collection($items->withSongsCount()->paginate(5)),
            default => ""
        };
    }

    /**
     * Mostrar ids de los items favoritos de un usuario según entidad.
     */
    public function getIds(User $user, Request $request)
    {
        Gate::authorize('viewMySongs', $user);
        $model = $request->query('model', 'Song');

        $favorites = Favorite::where('model', $model)
            ->where('user_id', $user->id)
            ->get(['id', 'favoritable_id']);

        return response()->json([
            'favorites' => $favorites->map(function ($favorite) {
                return [
                    'id' => $favorite->id,
                    'favoritable_id' => $favorite->favoritable_id,
                ];
            }),
        ]);
    }



    /**
     * Marcar un item como favoritos.
     */
    public function store(User $user, Request $request)
    {
        $data = $request->validate([
            'model' => 'required|in:Song,Chord,User',
            'favoritable_id' => 'required|integer|min:1'
        ]);

        Favorite::validateFavoriteItem($user, $data['model'], $data['favoritable_id']);

        $favorite = $user->favorites()->create($data);

        return new FavoriteResource($favorite);
    }

    /**
     * Desmarcar un item de favoritos.
     */
    public function destroy(User $user, Favorite $favorite)
    {
        Gate::authorize('delete', $user);
        $favorite->delete();

        return response(status: 204);
    }
}
