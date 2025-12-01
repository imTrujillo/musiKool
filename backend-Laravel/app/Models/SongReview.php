<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SongReview extends Model
{
    /** @use HasFactory<\Database\Factories\SongReviewFactory> */
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['rating', 'user_id'];

    public function song(): BelongsTo
    {
        return $this->belongsTo(Song::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
