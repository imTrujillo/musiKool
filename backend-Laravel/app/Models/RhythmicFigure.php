<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;

class RhythmicFigure extends Model
{
    /** @use HasFactory<\Database\Factories\RhythmicFigureFactory> */
    use HasFactory;
    public $timestamps = false;

    public static array $rhythmic_figures = ['Redonda', 'Blanca', 'Negra', 'Corchea'];

    public function musicalNotes(): HasMany
    {
        return $this->hasMany(MusicalNote::class, 'rhythmic_figure_id', 'id');
    }

    public function scopeRhythmicFigureName(Builder|EloquentBuilder $query, string $rhythmic_figure_name): Builder|EloquentBuilder
    {
        return $query->where('name', 'LIKE', '%' . $rhythmic_figure_name . '%');
    }
}
