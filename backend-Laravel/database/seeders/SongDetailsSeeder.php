<?php

namespace Database\Seeders;

use App\Models\Chord;
use App\Models\MusicalNote;
use App\Models\RhythmicFigure;
use App\Models\Song;
use App\Models\SongMetric;
use App\Models\SongScale;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SongDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Chord::$chords as $chord) {
            foreach (SongScale::$scale_types as $scale_type) {
                $scale = $chord . ' ' . $scale_type;
                SongScale::create([
                    'name' => $scale
                ]);
            }
        }

        foreach (SongMetric::$metrics as $metric) {
            SongMetric::create([
                'name' => $metric
            ]);
        }

        $duration = 4;
        foreach (RhythmicFigure::$rhythmic_figures as $figure) {
            RhythmicFigure::create([
                'name' => $figure,
                'duration' => $duration,
            ]);
            $duration /= 2;
        }
    }
}
