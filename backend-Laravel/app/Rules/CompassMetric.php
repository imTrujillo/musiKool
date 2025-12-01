<?php

namespace App\Rules;

use App\Models\RhythmicFigure;
use Illuminate\Contracts\Validation\Rule;

class CompassMetric implements Rule
{
    public function __construct(
        protected $song,
        protected $compass,
        protected $musicalNote,
        protected $rhythmic_figure_id,
        protected $is_dotted,
    ) {}

    public function passes($attribute, $value): bool
    {
        $figure = RhythmicFigure::find($this->rhythmic_figure_id);
        if (!$figure) return false;

        $isDotted = filter_var($this->is_dotted, FILTER_VALIDATE_BOOLEAN);

        // duración de la nueva nota
        $newDuration = $figure->duration * ($isDotted ? 1.5 : 1);

        // suma de notas existentes en el compás
        $currentDuration = $this->compass->musicalNotes()
            ->when($this->musicalNote, fn($q) => $q->where('id', '!=', $this->musicalNote->id))
            ->sum('duration_in_compass');

        $total = $currentDuration + $newDuration;

        // capacidad máxima del compás según la métrica
        $maxDuration = $this->song->metric->getMetric()->beats;

        return $total <= $maxDuration;
    }

    public function message(): string
    {
        return 'La figura rítmica no encaja con la métrica del compás.';
    }
}
