<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RhythmicFigure;
use Illuminate\Http\Request;

/**
 * @group Figura Musical
 */
class RhythmicFigureController extends Controller
{
    /**
     * Buscar una figura musical.
     *
     * @unauthenticated
     */
    public function __invoke(Request $request)
    {
        $search = $request->query('search');

        $rhythmic_figures = RhythmicFigure::when(
            $search,
            fn($q, $search) => $q->rhytmicFigureName($search)
        );


        return response()->json($rhythmic_figures->get(), 200);
    }
}
