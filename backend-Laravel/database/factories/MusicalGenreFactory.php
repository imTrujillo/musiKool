<?php

namespace Database\Factories;

use App\Models\MusicalGenre;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MusicalGenre>
 */
class MusicalGenreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->randomElement(MusicalGenre::$musical_genres),
            'description' => fake()->text(20),
            'color' => fake()->unique()->hexColor()
        ];
    }
}
