<?php

use App\Models\MusicalGenre;
use App\Models\SongMetric;
use App\Models\SongScale;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->id();

            $table->string('title', 50)->unique();
            $table->unsignedMediumInteger('bpm');

            $table->foreignIdFor(SongScale::class)->constrained('song_scales')->cascadeOnDelete();
            $table->foreignIdFor(SongMetric::class)->constrained('song_metrics')->cascadeOnDelete();
            $table->foreignIdFor(User::class)->constrained('users')->cascadeOnDelete();
            $table->foreignIdFor(MusicalGenre::class)->constrained('musical_genres')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('songs');
    }
};
