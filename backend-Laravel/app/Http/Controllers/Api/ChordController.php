<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChordResource;
use App\Models\Chord;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @group Acordes
 */
class ChordController extends Controller
{
    /**
     * Buscar un acorde.
     *
     * @unauthenticated
     */
    public function index(Request $request)
    {
        $chord_name = $request->query('chord_name');
        $filter = $request->query('filter', '');

        $chords = Chord::when(
            $chord_name,
            fn($q, $chord_name) => $q->chordName($chord_name)
        );

        $chords = match ($filter) {
            'basic' => $chords->basic(),
            'advanced' => $chords->advanced(),
            default => $chords
        };

        return ChordResource::collection($chords->paginate(5));
    }

    public function noPaginateIndex(Request $request)
    {
        return response()->json(Chord::all(), 200);
    }
}
