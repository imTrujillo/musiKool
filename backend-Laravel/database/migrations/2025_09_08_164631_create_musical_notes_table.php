<?php

use App\Models\Chord;
use App\Models\Compass;
use App\Models\RhythmicFigure;
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
        Schema::create('musical_notes', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Chord::class)->constrained('chords')->cascadeOnDelete();
            $table->foreignIdFor(Compass::class)->constrained('compasses')->cascadeOnDelete();
            $table->foreignIdFor(RhythmicFigure::class)->constrained('rhythmic_figures')->cascadeOnDelete();

            $table->string('lyrics', 255)->nullable();
            $table->boolean('is_dotted');
            $table->boolean('is_silence');
            $table->unsignedSmallInteger('order_in_compass');
            $table->float('duration_in_compass');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('musical_notes');
    }
};
