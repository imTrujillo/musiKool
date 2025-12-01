<?php

namespace Database\Factories;

use App\Models\Chord;
use App\Models\Compass;
use App\Models\MusicalNote;
use App\Models\RhythmicFigure;
use App\Models\Song;
use App\Models\SongMetric;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MusicalNotes>
 */
class MusicalNoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'lyrics' => fake()->text(10),
            'is_silence' => fake()->boolean(15),
        ];
    }
}
