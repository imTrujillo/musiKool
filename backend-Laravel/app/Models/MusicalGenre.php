<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;

class MusicalGenre extends Model
{
    /** @use HasFactory<\Database\Factories\MusicalGenreFactory> */
    use HasFactory;
    public $timestamps = false;

    public static array $musical_genres = [
        'Pop',
        'Rock',
        'Hip Hop',
        'Rap',
        'R&B',
        'Soul',
        'Funk',
        'Disco',
        'Reggaetón',
        'Electrónica',
        'House',
        'Techno',
        'Trance',
        'Dubstep',
        'Drum and Bass',
        'Electro',
        'Ambiental',
        'Chillout',
        'Synthwave',
        'Clásica',
        'Barroca',
        'Romántica',
        'Ópera',
        'Música de Cámara',
        'Orquestal',
        'Jazz',
        'Swing',
        'Bebop',
        'Fusión',
        'Cool Jazz',
        'Rock Alternativo',
        'Indie Rock',
        'Hard Rock',
        'Punk',
        'Metal',
        'Rock Progresivo',
        'Grunge',
        'Garage Rock',
        'Folk Rock',
        'Salsa',
        'Merengue',
        'Bachata',
        'Cumbia',
        'Reggae',
        'Tango',
        'Bolero',
        'Mariachi',
        'Flamenco',
        'Country',
        'Bluegrass',
        'Folk',
        'Americana',
        'Celta',
        'Blues',
        'Delta Blues',
        'Chicago Blues',
        'Gospel',
        'Espiritual',
        'Afrobeat',
        'Highlife',
        'K-Pop',
        'J-Pop',
        'Samba',
        'Bossa Nova',
        'Fado',
        'Gnawa',
        'Clásica India',
        'Arabesco',
        'Infantil',
        'Educativa',
        'Banda Sonora',
        'Experimental',
        'Industrial',
        'Noise',
        'Pop Ambiental',
        'Lo-fi',
        'Chiptune',
    ];


    public function songs(): HasMany
    {
        return $this->hasMany(Song::class);
    }

    public function scopeGenreName(Builder|EloquentBuilder $query, string $genre_name): Builder|EloquentBuilder
    {
        return $query->where('name', 'LIKE', '%' . $genre_name . '%');
    }

    public function scopeWithSongsCount(Builder|EloquentBuilder $query)
    {
        return $query->withCount('songs');
    }
}
