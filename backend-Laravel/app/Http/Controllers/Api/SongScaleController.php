<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SongScale;
use Illuminate\Http\Request;

/**
 * @group Escalas
 */
class SongScaleController extends Controller
{
    /**
     * Buscar una escala musical.
     *
     * @unauthenticated
     */
    public function __invoke(Request $request)
    {
        $search = $request->query('search');

        $song_scales = SongScale::when(
            $search,
            fn($q, $search) => $q->songScaleName($search)
        );


        return response()->json($song_scales->get(), 200);
    }
}
