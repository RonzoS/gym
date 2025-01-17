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
        Schema::dropIfExists('user_workout_exercise_sets');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('user_workout_exercise_sets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_workout_id');
            $table->unsignedBigInteger('workout_set_exercise_id');
            $table->unsignedInteger('set_number');
            $table->unsignedInteger('target_reps')->nullable();
            $table->float('target_weight')->nullable();
            $table->unsignedInteger('performed_reps')->nullable();
            $table->float('performed_weight')->nullable();
            $table->date('date')->nullable();
            $table->timestamps();

            $table->foreign('user_workout_id')->references('id')->on('user_workouts')->onDelete('cascade');
            $table->foreign('workout_set_exercise_id')->references('id')->on('workout_set_exercises')->onDelete('cascade');
        });
    }
};
