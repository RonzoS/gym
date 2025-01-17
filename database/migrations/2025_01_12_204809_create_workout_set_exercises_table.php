<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workout_set_exercises', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('workout_set_id');
            $table->unsignedBigInteger('exercise_id');
            $table->unsignedInteger('order')->nullable();
            $table->timestamps();

            $table->foreign('workout_set_id')->references('id')->on('workout_sets')->onDelete('cascade');
            $table->foreign('exercise_id')->references('id')->on('exercises')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workout_set_exercises');
    }
};
