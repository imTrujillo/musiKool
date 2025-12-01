<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class Favorite extends Model
{
    /** @use HasFactory<\Database\Factories\FavoriteFactory> */
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['user_id', 'model', 'favoritable_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function myFavorites(string $model, User $user)
    {
        $modelClass = "App\\Models\\$model";

        if (!$user) {
            return $modelClass::whereRaw('0 = 1');
        }

        $ids = self::where('model', $model)
            ->where('user_id', $user->id)
            ->pluck('favoritable_id');

        return $modelClass::whereIn('id', $ids);
    }

    public static function validateFavoriteItem(User $user, string $model, string $favoritable_id)
    {
        $modelClass = "App\\Models\\$model";

        $alreadyFavorite = $user->favorites()
            ->where('model', $model)
            ->where('favoritable_id', $favoritable_id)
            ->exists();

        if ($alreadyFavorite) {
            throw new HttpResponseException(
                response()->json([
                    'message' => 'Error de validación.',
                    'errors' => 'El item ya se agregó a favoritos'
                ], 422)
            );
        }

        if ($favoritable_id > $modelClass::count()) {
            throw new HttpResponseException(
                response()->json([
                    'message' => 'Error de validación.',
                    'errors' => 'El favoritable_id está fuera del rango'
                ], 422)
            );
        }
    }
}
