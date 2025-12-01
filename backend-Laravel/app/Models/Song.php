<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder as QueryBuilder;


class Song extends Model
{
    /** @use HasFactory<\Database\Factories\SongsFactory> */
    use HasFactory;
    protected $fillable = [
        'title',
        'bpm',
        'reviews',
        'user_id',
        'song_scale_id',
        'song_metric_id',
        'musical_genre_id'
    ];

    public function artist()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function genre()
    {
        return $this->belongsTo(MusicalGenre::class, 'musical_genre_id');
    }

    public function metric(): BelongsTo
    {
        return $this->belongsTo(SongMetric::class, 'song_metric_id');
    }

    public function scale(): BelongsTo
    {
        return $this->belongsTo(SongScale::class, 'song_scale_id');
    }

    public function compasses(): HasMany
    {
        return $this->hasMany(Compass::class)->orderBy('order', 'asc');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(SongReview::class);
    }

    public function scopeTitle(Builder|QueryBuilder $query, string $title): Builder|QueryBuilder
    {
        return $query->where('title', 'LIKE', '%' . $title . '%');
    }

    public function scopeWithReviewsCount(Builder|QueryBuilder $query)
    {
        return $query->withCount('reviews');
    }

    public function scopeWithAvgRating(Builder|QueryBuilder $query)
    {
        return $query->withAvg('reviews', 'rating');
    }

    public function scopePopular(Builder|QueryBuilder $query)
    {
        return $query->withReviewsCount()->orderBy('reviews_count', 'desc');
    }

    public function scopeHighestRated(Builder|QueryBuilder $query)
    {
        return $query->withAvgRating()->orderBy('reviews_avg_rating', 'desc');
    }

    public function scopeByGenre(Builder|QueryBuilder $query, string $genre)
    {
        return $query->where('musical_genre_id', $genre);
    }

    public function scopeByArtist(Builder|QueryBuilder $query, string $user)
    {
        return $query->where('user_id', $user);
    }

    public function scopeWithChords(Builder|QueryBuilder $query)
    {
        return $this->compasses
            ->flatMap(fn($compass) => $compass->musicalNotes->pluck('chord.chord_name'))
            ->unique()
            ->values();
    }
}
