<?php

namespace App\Http\Resources;

use App\Models\SongMetric;
use App\Models\SongScale;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SongResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id' => $this->id,
            'title' => $this->title,
            'bpm' => $this->bpm,
            'song_scale' => new SongScaleResource($this->whenLoaded('scale')),
            'song_metric' => new SongMetricResource($this->whenLoaded('metric')),
            'user' => new UserResource($this->whenLoaded('artist')),
            'musical_genre' => new MusicalGenreResource($this->whenLoaded('genre')),
            'compasses' => CompassResource::collection($this->whenLoaded('compasses')),
            'reviews' => SongReviewResource::collection($this->whenLoaded('reviews')),
            'avg_rating' => $this->reviews_avg_rating,
            'reviews_count' => $this->reviews_count,
            'chords' => $this->withChords()
        ];
    }
}
