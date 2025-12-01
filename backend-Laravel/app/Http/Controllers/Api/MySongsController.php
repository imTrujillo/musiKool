<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SongResource;
use App\Http\Traits\CanLoadRelationships;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

/**
 * @group Canciones
 *
 * Endpoints para administrar canciones.
 */
class MySongsController extends Controller
{
    use CanLoadRelationships;
    private array $relations = ['compasses', 'artist', 'genre', 'reviews', 'metric', 'scale'];
    /**
     * Obtener mis canciones.
     */
    public function index(Request $request)
    {
        Gate::authorize('viewAny', Song::class);
        $songs = $request->user()
            ? $request->user()->songs()
            : Song::whereRaw('0 = 1');

        $songs = $this->loadRelationships($songs)
            ->withAvgRating()
            ->withReviewsCount()
            ->latest();

        return SongResource::collection($songs->paginate(5));
    }
}
