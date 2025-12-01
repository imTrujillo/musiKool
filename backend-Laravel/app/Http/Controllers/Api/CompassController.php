<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompassResource;
use App\Models\Compass;
use App\Models\Song;
use Illuminate\Http\Request;

/**
 * @group Compases
 *
 * Endpoints para guardar y eliminar compases, así como modificar su orden.
 */
class CompassController extends Controller
{
    /**
     * Guardar un compás.
     */
    public function store(Request $request, Song $song)
    {
        $n_compasses = $song->compasses()->max('order') ?? 0;
        $order = $n_compasses + 1;

        $compass = $song->compasses()->create(array_merge(
            $request->all(),
            ['order' => $order]
        ));

        return new CompassResource($compass);
    }

    /**
     * Actualizar un compás.
     */
    public function update(Request $request, Song $song, Compass $compass)
    {
        $request->validate([
            'order' => 'required|integer|min:1'
        ]);

        $old_order = $compass->order;
        $new_order = $request->input('order');

        if ($new_order === $old_order) {
            return new CompassResource($compass);
        }

        if ($new_order < $old_order) {
            $song->compasses()
                ->whereBetween('order', [$new_order, $old_order - 1])
                ->increment('order');
        } else {
            $song->compasses()
                ->whereBetween('order', [$old_order + 1, $new_order])
                ->decrement('order');
        }

        $compass->update(array_merge(
            $request->all(),
            ['order' => $new_order]
        ));

        return new CompassResource($compass);
    }

    /**
     * Eliminar un compás.
     */
    public function destroy(Song $song, Compass $compass)
    {
        $song->compasses()
            ->where('order', '>', $compass->order)
            ->decrement('order');

        $compass->delete();

        return response(status: 204);
    }
}
