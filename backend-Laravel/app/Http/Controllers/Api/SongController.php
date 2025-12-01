<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\CanLoadRelationships;
use App\Http\Requests\SongRequest;
use App\Http\Resources\SongResource;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

/**
 * @group Canciones
 *
 * Endpoints para administrar canciones.
 */
class SongController extends Controller
{
    use CanLoadRelationships;
    private array $relations = ['compasses.musicalNotes.rhythmicFigure', 'artist', 'genre', 'reviews', 'metric', 'scale'];
    /**
     * Obtener y filtrar canciones.
     *
     * @unauthenticated
     */
    public function index(Request $request)
    {
        Gate::authorize('viewAny', Song::class);

        $title = $request->query('title');
        $filter = $request->query('filter', '');
        $genre = $request->query('genre_id', '');
        $artist = $request->query('artist_id', '');


        $songs = Song::query()
            ->when($title, fn($q, $title) => $q->title($title))
            ->when($genre, fn($q, $genre) => $q->byGenre($genre))
            ->when($artist, fn($q, $artist) => $q->byArtist($artist));

        $songs = match ($filter) {
            'popular' => $songs->popular(),
            'rating' => $songs->highestRated(),
            default => $songs
        };

        $songs = $this->loadRelationships($songs)->withAvgRating()->withReviewsCount()->latest();

        return SongResource::collection($songs->paginate(10));
    }

    /**
     * Mostrar una canción.
     *
     * @unauthenticated
     */
    public function show(Song $song)
    {
        Gate::authorize('view', $song);
        return new SongResource($this->loadRelationships($song));
    }

    /**
     * Guardar una canción.
     */
    public function store(SongRequest $request)
    {
        $song = Song::create($request->validated());

        $song = $this->loadRelationships($song);
        return new SongResource($song);
    }

    /**
     * Actualizar una canción.
     */
    public function update(SongRequest $request, Song $song)
    {
        Gate::authorize('update', $song);
        $song->update($request->validated());

        return new SongResource($this->loadRelationships($song));
    }

    /**
     * Eliminar un canción.
     */
    public function destroy(Song $song)
    {
        Gate::authorize('delete', $song);
        $song->delete();

        return response(status: 204);
    }
}
