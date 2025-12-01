<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;

class SongScale extends Model
{
    /** @use HasFactory<\Database\Factories\SongScaleFactory> */
    use HasFactory;
    public $timestamps = false;

    public static array $scale_types = [
        'Mayor',
        'Menor Natural',
        'Menor Armónica',
        'Menor Melódica',
        'Dórica',
        'Frigia',
        'Lidia',
        'Mixolidia',
        'Lócria',
        'Pentatónica Mayor',
        'Pentatónica Menor',
        'Escala de Blues',
        'Blues Menor',
        'Blues Mayor',
        'Cromática',
        'Entera',
        'Disminuida',
        'Aumentada',
        'Frigia Española',
        'Menor Húngara',
        'Menor Napolitana',
        'Mayor Napolitana',
        'Persa',
        'Japonesa (In Sen)',
        'Oriental',
        'Egipcia',
        'Lidia Dominante',
        'Escala Alterada',
        'Disminuida Semitono-Tono',
        'Disminuida Tono-Semitono'
    ];

    public function songs(): HasMany
    {
        return $this->hasMany(Song::class);
    }

    public function scopeSongScaleName(Builder|EloquentBuilder $query, string $chord_name): Builder|EloquentBuilder
    {
        return $query->where('chord_name', 'LIKE', '%' . $chord_name . '%');
    }
}
