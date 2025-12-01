<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SongReviewResource;
use App\Models\Favorite;
use App\Models\Song;
use App\Models\SongReview;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * @group Reseñas de Canciones
 *
 * Endpoints para dejar reseñas.
 */
class SongReviewController extends Controller
{
    /**
     * Mostrar una reseña
     */
    public function index(Song $song, Request $request)
    {
        $review = $song->reviews()
            ->where('user_id', $request->user()->id)
            ->first();

        if (!$review) {
            return response()->json(['message' => 'No se encontró reseña'], 404);
        }

        return new SongReviewResource($review);
    }


    /**
     * Guardar una reseña
     */
    public function store(Song $song, Request $request)
    {
        $data = $request->validate([
            'rating' => 'required|min:1|max:5|integer',
            'user_id' => 'required|integer|exists:users,id'
        ]);

        $review = $song->reviews()->create($data);
        return response($review, 201);
    }

    /**
     * Actualizar una reseña
     */
    public function updateReview(Song $song, Request $request)
    {
        $data = $request->validate([
            'rating' => 'required|min:1|max:5|integer',
            'user_id' => 'required|integer|exists:users,id'
        ]);

        $review = $song->reviews()
            ->where('user_id', $request->user()->id)
            ->first();

        if (!$review) {
            return response()->json(['message' => 'No se encontró reseña'], 404);
        }


        $review->update($data);
        $review->refresh();
        return response($review, 202);
    }
}
