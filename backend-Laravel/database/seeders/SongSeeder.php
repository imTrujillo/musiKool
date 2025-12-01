<?php

namespace Database\Seeders;

use App\Models\MusicalGenre;
use App\Models\Song;
use App\Models\SongReview;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users  = User::all();
        $genres = MusicalGenre::all();

        for ($i = 0; $i < 10; $i++) {
            $user = $users->random();
            $genre = $genres->random();
            $song = Song::factory()->create([
                'user_id' => $user->id,
                'musical_genre_id' => $genre->id
            ]);

            //Crear los ratings por cada cancion
            $songReviews = random_int(5, 30);
            SongReview::factory()
                ->count($songReviews)
                ->state(function () {
                    return match (fake()->randomElement(['good', 'bad', 'avg'])) {
                        'good' => ['rating' => fake()->numberBetween(4, 5)],
                        'bad'  => ['rating' => fake()->numberBetween(1, 2)],
                        default => ['rating' => 3],
                    };
                })
                ->for($song)
                ->create();
        }
    }
}
