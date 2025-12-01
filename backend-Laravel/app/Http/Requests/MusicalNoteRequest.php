<?php

namespace App\Http\Requests;

use App\Models\MusicalNote;
use App\Rules\CompassMetric;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class MusicalNoteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

    public function rules(): array
    {

        return [
            'chord_id' => 'required|integer|exists:chords,id',
            'lyrics' => 'nullable|string|max:255',
            'is_dotted' => 'boolean',
            'is_silence' => 'boolean',
            'rhythmic_figure_id' => [
                'required',
                'integer',
                'exists:rhythmic_figures,id',
                new CompassMetric(
                    $this->route('song'),
                    $this->route('compass'),
                    $this->route('musicalNote'),
                    $this->input('rhythmic_figure_id'),
                    $this->input('is_dotted'),

                ),
            ],
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'message' => 'Error de validación.',
                'errors' => $validator->errors()
            ], 422)
        );
    }
}
