<?php

namespace Database\Seeders;

use App\Models\Favorite;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin Mellara',
            'email' => 'admin@admin.com',
            'color' => '#111826',
            'is_admin' => true,
        ]);

        User::factory(10)->create();

        $this->call(ChordSeeder::class);
        $this->call(MusicalGenreSeeder::class);
        $this->call(SongDetailsSeeder::class);
        $this->call(SongSeeder::class);
        $this->call(CompassSeeder::class);
        $this->call(FavoriteSeeder::class);
    }
}
