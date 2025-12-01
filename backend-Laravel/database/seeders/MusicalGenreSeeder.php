<?php

namespace Database\Seeders;

use App\Models\MusicalGenre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MusicalGenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $total = count(MusicalGenre::$musical_genres);
        MusicalGenre::factory()->count($total)->create();
    }
}
