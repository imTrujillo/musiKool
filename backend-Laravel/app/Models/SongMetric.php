<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;

class SongMetric extends Model
{
    /** @use HasFactory<\Database\Factories\SongMetricFactory> */
    use HasFactory;
    public $timestamps = false;

    public static array $metrics = [
        '2/4',
        '3/4',
        '4/4',
        '5/4',
        '6/4',
        '7/4',
        '8/4',
        '2/8',
        '3/8',
        '4/8',
        '5/8',
        '6/8',
        '7/8',
        '9/8',
        '12/8',
        '6/8',
        '9/8',
        '12/8',
        '5/8',
        '7/8',
        '11/8',
        '13/8',
        '15/8',
        '3/2',
        '4/2',
        '5/2',
        '7/2',
        '9/4',
        '12/4'
    ];

    public function songs(): HasMany
    {
        return $this->hasMany(Song::class);
    }

    public function getMetric()
    {
        [$beats, $noteValue] = explode('/', $this->name);


        return (object) [
            'beats' => (int) $beats,
            'noteValue' => (int) $noteValue,
        ];
    }

    public function scopeSongMetricName(Builder|EloquentBuilder $query, string $song_metric_name): Builder|EloquentBuilder
    {
        return $query->where('name', 'LIKE', '%' . $song_metric_name . '%');
    }
}
