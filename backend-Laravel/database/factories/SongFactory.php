<?php

namespace Database\Factories;

use App\Models\Chord;
use App\Models\Song;
use App\Models\SongMetric;
use App\Models\SongScale;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Songs>
 */
class SongFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $created = fake()->dateTimeBetween('-2 years');
        $tone = SongScale::inRandomOrder()->first();
        $metric = SongMetric::inRandomOrder()->first();

        return [
            'title'       => fake()->sentence(4),
            'song_scale_id'        => $tone->id,
            'bpm'         => fake()->numberBetween(40, 240),
            'song_metric_id'      => $metric->id,
            'created_at' => $created,
            'updated_at' => fake()->dateTimeBetween($created, 'now')
        ];
    }
}
