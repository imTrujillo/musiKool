<?php

namespace Database\Seeders;

use App\Models\Chord;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Chord::$chords as $note) {
            foreach (Chord::$chord_suffixes as $suffix) {
                $chord = $note . $suffix;
                Chord::create([
                    'chord_name' => $chord,
                    'piano_diagram' => "https://www.scales-chords.com/chord/piano/" . urlencode($chord),
                    'guitar_diagram' => "https://www.scales-chords.com/chord/guitar/" . urlencode($chord),
                    'piano_sound'   => "https://www.scales-chords.com/api/scales-chords-api.js?chord=" . urlencode($chord) . "&instrument=piano&output=sound",
                    'guitar_sound'  => "https://www.scales-chords.com/api/scales-chords-api.js?chord=" . urlencode($chord) . "&instrument=guitar&output=sound",
                ]);
            }
        }
    }
}
