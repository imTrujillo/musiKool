<?php

namespace App\Http\Requests;

use App\Models\Chord;
use App\Models\MusicalGenre;
use App\Models\Song;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class SongRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('create', Song::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $songId = $this->route('song');
        return [
            'title' => [
                'required',
                'string',
                'min:5',
                'max:50',
                Rule::unique('songs', 'title')->ignore($songId),
            ],
            'bpm' => 'required|integer|min:30|max:280',
            'user_id' => 'required|integer|exists:users,id',
            'song_scale_id' => 'required|integer|exists:song_scales,id',
            'song_metric_id' => 'required|integer|exists:song_metrics,id',
            'musical_genre_id' => 'required|integer|exists:musical_genres,id',
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
