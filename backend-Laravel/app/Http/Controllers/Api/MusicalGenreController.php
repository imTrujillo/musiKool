<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MusicalGenre;
use Illuminate\Http\Request;

/**
 * @group Género
 */
class MusicalGenreController extends Controller
{
    /**
     * Buscar un género musical.
     *
     * @unauthenticated
     */
    public function __invoke(Request $request)
    {
        $search = $request->query('search');

        $genres = MusicalGenre::when(
            $search,
            fn($q, $search) => $q->genreName($search)
        );


        return response()->json($genres->orderBy('name', 'asc')->withSongsCount()->get(), 200);
    }
}
