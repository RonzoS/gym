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
        Schema::create('exercise_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_workout_id');
            $table->unsignedBigInteger('exercise_id');
            $table->unsignedInteger('performed_reps')->nullable();
            $table->float('performed_weight')->nullable();
            $table->date('date')->nullable();
            $table->timestamps();

            $table->foreign('user_workout_id')->references('id')->on('user_workouts')->onDelete('cascade');
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
        Schema::dropIfExists('exercise_results');
    }
};
