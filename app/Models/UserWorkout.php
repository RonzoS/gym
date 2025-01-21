<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWorkout extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = ['user_id', 'workout_set_id', 'scheduled_date', 'recommendations'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function workoutSet()
    {
        return $this->belongsTo(WorkoutSet::class);
    }

    public function exerciseResults()
    {
        return $this->hasMany(ExerciseResult::class);
    }
}
