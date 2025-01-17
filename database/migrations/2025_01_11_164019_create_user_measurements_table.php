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
        Schema::create('user_measurements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->float('weight')->nullable();
            $table->float('height')->nullable();
            $table->float('muscle_mass')->nullable();
            $table->float('fat_mass')->nullable();
            $table->float('water_mass')->nullable();
            $table->float('bmi')->nullable();
            $table->float('muscle_percentage')->nullable();
            $table->float('fat_percentage')->nullable();
            $table->float('water_percentage')->nullable();
            $table->float('neck_circumference')->nullable();
            $table->float('arm_circumference')->nullable();
            $table->float('forearm_circumference')->nullable();
            $table->float('wrist_circumference')->nullable();
            $table->float('chest_circumference')->nullable();
            $table->float('waist_circumference')->nullable();
            $table->float('hip_circumference')->nullable();
            $table->float('thigh_circumference')->nullable();
            $table->float('calf_circumference')->nullable();
            $table->float('ankle_circumference')->nullable();
            $table->string('photo')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_measurements');
    }
};
