<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ChordController;
use App\Http\Controllers\Api\CompassController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\MusicalNoteController;
use App\Http\Controllers\Api\MusicalGenreController;
use App\Http\Controllers\Api\MySongsController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\RhythmicFigureController;
use App\Http\Controllers\Api\SongController;
use App\Http\Controllers\Api\SongMetricController;
use App\Http\Controllers\Api\SongReviewController;
use App\Http\Controllers\Api\SongScaleController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/docs');
});


//Auth
Route::post('/auth', [AuthController::class, 'store']);
Route::delete('/auth', [AuthController::class, 'destroy'])->middleware(['auth:sanctum', 'throttle:60,1'])->name('logout');
Route::post('/auth/register', [RegisterController::class, 'store'])->name('auth.register');


//Rutas protegidas
Route::middleware(['auth:sanctum', 'throttle:60,1'])->group(function () {
    Route::apiResource('/songs', SongController::class)
        ->only(['store', 'update', 'destroy']);
    Route::get('/my-songs', [MySongsController::class, 'index']);

    Route::apiResource('/songs/{song}/reviews', SongReviewController::class)
        ->only(['index', 'store', 'update']);
    Route::put('/songs/{song}/reviews', [SongReviewController::class, 'updateReview']);
    Route::apiResource('/songs/{song}/compasses', CompassController::class)
        ->only(['store', 'update', 'destroy']);
    Route::apiResource('/songs/{song}/compasses/{compass}/musicalNotes', MusicalNoteController::class);
    // ->scoped(['musicalNote' => 'id']);;

    Route::apiResource('/users', UserController::class)
        ->only(['store', 'update', 'destroy']);
    Route::apiResource('/users/{user}/favorites', FavoriteController::class)
        ->only(['index', 'store', 'destroy']);
    Route::get('/users/{user}/favorites/ids', [FavoriteController::class, "getIds"])->name('favorites.getIds');
});

//Rutas públicas
Route::apiResource('/songs', SongController::class)
    ->only(['index', 'show']);
Route::apiResource('/users', UserController::class)
    ->only(['index', 'show']);
Route::get('/chords', [ChordController::class, 'index'])->name('chords.index');
Route::get('/chords/no-paginate', [ChordController::class, 'noPaginateIndex'])->name('chords.index.noPaginate');
Route::get('/musical-genres', MusicalGenreController::class)->name('musical-genres.index');
Route::get('/rhythmic-figures', RhythmicFigureController::class)->name('rhythmic-figures.index');
Route::get('/song-metrics', SongMetricController::class)->name('song-metrics.index');
Route::get('/song-scales', SongScaleController::class)->name('song-scales.index');



// Ruta para manejar acceso sin token
/**
 * Manejar acceso sin token.
 *
 * @group Autenticación
 * @unauthenticated
 */
Route::any('/token', function () {
    return response()->json(['message' => 'Necesitas un token'], 401);
})->name('login');
