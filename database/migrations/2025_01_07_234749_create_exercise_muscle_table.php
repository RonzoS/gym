<?php

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
        Schema::create('exercise_muscle', function (Blueprint $table) {
            $table->bigInteger('exercise_id')->unsigned()->index();
            $table->foreign('exercise_id')->references('id')->on('exercises')->onDelete('cascade');
            $table->bigInteger('muscle_id')->unsigned()->index();
            $table->foreign('muscle_id')->references('id')->on('muscles')->onDelete('cascade');
            $table->primary(['exercise_id', 'muscle_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercise_muscle');
    }
};
