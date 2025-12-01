<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SongMetric;
use Illuminate\Http\Request;

/**
 * @group Métrica
 */
class SongMetricController extends Controller
{
    /**
     * Buscar una métrica musical.
     *
     * @unauthenticated
     */
    public function __invoke(Request $request)
    {
        $search = $request->query('search');

        $song_metrics = SongMetric::when(
            $search,
            fn($q, $search) => $q->songMetricName($search)
        );

        return response()->json($song_metrics->get(), 200);
    }
}
