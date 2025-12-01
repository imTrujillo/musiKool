<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MusicalNoteRequest;
use App\Http\Resources\MusicalNoteResource;
use App\Models\Compass;
use App\Models\MusicalNote;
use App\Models\RhythmicFigure;
use App\Models\Song;

/**
 * @group Notas Musicales
 *
 * Endpoints para administrar las notas musicales dentro de una compás.
 */
class MusicalNoteController extends Controller
{
    /**
     * Mostrar notas musicales.
     *
     * @unauthenticated
     */
    public function index(Song $song, Compass $compass)
    {
        return MusicalNoteResource::collection($compass->musicalNotes);
    }

    /**
     * Añadir un nueva nota musical.
     */
    public function store(Song $song, Compass $compass, MusicalNoteRequest $request)
    {
        $data = $request->validated();

        $rhythmicFigure = RhythmicFigure::findOrFail($data['rhythmic_figure_id']);
        $metric = $song->metric;
        $duration = MusicalNote::calculateDurationForNote(
            $metric,
            $rhythmicFigure,
            $data['is_dotted'] ?? false
        );

        $musicalNote = $compass->musicalNotes()->create([
            ...$data,
            'order_in_compass'    => ($compass->musicalNotes()->max('order_in_compass') ?? 0) + 1,
            'duration_in_compass' => $duration,
        ]);

        return new MusicalNoteResource($musicalNote->load(['chord', 'rhythmicFigure']));
    }

    /**
     * Mostrar una nota musical.
     *
     * @unauthenticated
     */
    public function show(Song $song, Compass $compass, MusicalNote $musicalNote)
    {
        return new MusicalNoteResource($musicalNote);
    }

    /**
     * Actualizar una nota.
     */
    public function update(Song $song, Compass $compass, MusicalNote $musicalNote, MusicalNoteRequest $request)
    {
        $data = $request->validated();

        $rhythmicFigure = RhythmicFigure::findOrFail($data['rhythmic_figure_id']);
        $metric = $song->metric;
        $duration = MusicalNote::calculateDurationForNote(
            $metric,
            $rhythmicFigure,
            $data['is_dotted'] ?? false
        );

        $musicalNote->update([
            ...$data,
            'duration_in_compass' => $duration,
        ]);

        return new MusicalNoteResource($musicalNote->load(['chord', 'rhythmicFigure']));
    }


    /**
     * Eliminar una nota musical.
     */
    public function destroy(Song $song, Compass $compass, MusicalNote $musical_note)
    {
        $musical_note->delete();

        return response(status: 204);
    }
}
