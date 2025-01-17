<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkoutSetExercise extends Model
{
    use HasFactory;

    protected $fillable = ['workout_set_id', 'exercise_id', 'order'];

    public function workoutSet()
    {
        return $this->belongsTo(WorkoutSet::class);
    }

    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }
}
