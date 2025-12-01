<?php

namespace Database\Seeders;

use App\Models\Chord;
use App\Models\Compass;
use App\Models\MusicalNote;
use App\Models\RhythmicFigure;
use App\Models\Song;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $songs = Song::all();
        $chords = Chord::all();
        $rhythmic_figures = RhythmicFigure::all();

        foreach ($songs as $song) {
            $compassesPerSong = rand(1, 8);

            for ($i = 0; $i < $compassesPerSong; $i++) {
                $compass = Compass::create([
                    'song_id' => $song->id,
                    'order' => $i + 1
                ]);

                $notesPerCompass = rand(1, 8);

                for ($j = 1; $j <= $notesPerCompass; $j++) {
                    $chord = $chords->random();
                    $rhythmic_figure = $rhythmic_figures->random();
                    $is_dotted = fake()->boolean(15);

                    $data = $song->metric->getMetric();
                    $beats = $data->beats;

                    $duration = MusicalNote::calculateDurationForNote($song->metric, $rhythmic_figure, $is_dotted);
                    $compass_size = Compass::calculateCompassSize($compass);

                    if ($compass_size + $duration <= $beats) {
                        MusicalNote::factory()->create([
                            'compass_id' => $compass->id,
                            'rhythmic_figure_id' => $rhythmic_figure->id,
                            'chord_id' => $chord->id,
                            'is_dotted' => $is_dotted,
                            'order_in_compass' => $j,
                            'duration_in_compass' => $duration,
                        ]);
                    } else {
                        break;
                    }
                }
            }
        }
    }
}
