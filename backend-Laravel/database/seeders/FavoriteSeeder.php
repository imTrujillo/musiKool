<?php

namespace Database\Seeders;

use App\Models\Chord;
use App\Models\Favorite;
use App\Models\Song;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FavoriteSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $models = ['User' => User::class, 'Chord' => Chord::class, 'Song' => Song::class];

        for ($i = 0; $i < 100; $i++) {
            $user = $users->random();
            $modelName =  collect(array_keys($models))->random();
            $modelClass = $models[$modelName];
            $model = $modelClass::inRandomOrder()->first();

            Favorite::create([
                'user_id' => $user->id,
                'model' => $modelName,
                'favoritable_id' => $model->id
            ]);
        }
    }
}
