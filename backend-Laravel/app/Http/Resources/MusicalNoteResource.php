<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MusicalNoteResource extends JsonResource
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
            'chord_id' => $this->chord_id,
            'compass_id' => $this->compass_id,
            'rhythmic_figure_id' => $this->rhythmic_figure_id,
            'lyrics' => $this->lyrics,
            'is_dotted' => (bool) $this->is_dotted,
            'is_silence' => (bool) $this->is_silence,
            'order_in_compass' => $this->order_in_compass,
            'duration_in_compass' => $this->duration_in_compass,
        ];
    }
}
