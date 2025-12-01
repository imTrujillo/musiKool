<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MusicalNote extends Model
{
    /** @use HasFactory<\Database\Factories\MusicalNotesFactory> */
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'chord_id',
        'compass_id',
        'rhythmic_figure_id',
        'order_in_compass',
        'duration_in_compass',
        'lyrics',
        'is_dotted',
        'is_silence'
    ];


    public function compass(): BelongsTo
    {
        return $this->belongsTo(Compass::class);
    }

    public function chord(): BelongsTo
    {
        return $this->belongsTo(Chord::class);
    }

    public function rhythmicFigure(): BelongsTo
    {
        return $this->belongsTo(RhythmicFigure::class, 'rhythmic_figure_id', 'id');
    }

    public static function calculateDurationForNote($metric, $rhythmic_figure, $is_dotted)
    {
        $data = $metric->getMetric();


        $note_duration = $rhythmic_figure->duration ?? 0;
        $note_duration *= $is_dotted ? 1.5 : 1;
        $note_duration *= (4 / $data->noteValue);

        return $note_duration;
    }
}
