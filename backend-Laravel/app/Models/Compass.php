<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Compass extends Model
{
    public $timestamps = false;

    protected $fillable = ['order'];

    public function song(): BelongsTo
    {
        return $this->belongsTo(Song::class);
    }

    public function musicalNotes(): HasMany
    {
        return $this->hasMany(MusicalNote::class)->orderBy('order_in_compass', 'asc');
    }

    public static function calculateCompassSize($compass)
    {
        return $compass->musicalNotes()->sum('duration_in_compass');
    }
}
