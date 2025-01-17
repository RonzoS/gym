<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExerciseResult extends Model
{
    use HasFactory;

    protected $fillable = ['user_workout_id', 'exercise_id', 'performed_reps', 'performed_weight', 'date'];

    public function userWorkout()
    {
        return $this->belongsTo(UserWorkout::class);
    }

    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }
}
