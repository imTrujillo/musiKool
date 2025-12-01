<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;


class Chord extends Model
{
    /** @use HasFactory<\Database\Factories\ChordsFactory> */
    use HasFactory;
    public $timestamps = false;

    public static array $chords = [
        'C',
        'C#',
        'D',
        'D#',
        'E',
        'F',
        'F#',
        'G',
        'A#',
        'B'
    ];

    public static array $chord_suffixes = [
        '',
        'm',
        'dim',
        'aug',
        '7',
        'm7',
        'maj7',
        'dim7',
        'm7b5',
        'aug7',
        '9',
        'm9',
        'maj9',
        '11',
        '13',
        '7b5',
        '7#5',
        '7b9',
        '7#9',
        '7#11',
        '13b13',
        'sus2',
        'sus4',
        'add9',
        'add11',
        'add13',
        '5',
    ];

    public function musicalNotes(): HasMany
    {
        return $this->hasMany(MusicalNote::class);
    }

    public function scopeChordName(Builder|EloquentBuilder $query, string $chord_name): Builder|EloquentBuilder
    {
        return $query->where('chord_name', 'LIKE', '%' . $chord_name . '%');
    }

    public function scopeBasic(Builder|EloquentBuilder $query)
    {
        $advanced = ['2', '4', '5', '7', '9', '11', '13'];
        return $query->where(function ($q) use ($advanced) {
            foreach ($advanced as $a) {
                $q->where('chord_name', 'NOT LIKE', "%$a%");
            }
        });
    }

    public function scopeAdvanced(Builder|EloquentBuilder $query)
    {
        $advanced = ['2', '4', '5', '7', '9', '11', '13'];
        return $query->where(function ($q) use ($advanced) {
            foreach ($advanced as $a) {
                $q->orWhere('chord_name', 'LIKE', "%$a%");
            }
        });
    }
}
