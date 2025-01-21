<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Exercise extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'name',
        'description',
        'clues',
        'image',
        'category',
        'calories_burned_per_hour',
    ];


    public function muscles(): BelongsToMany
    {
        return $this->belongsToMany(Muscle::class, 'exercise_muscle', 'exercise_id', 'muscle_id');
    }

    public function tools(): BelongsToMany
    {
        return $this->belongsToMany(Tool::class, 'exercise_tool', 'exercise_id', 'tool_id');
    }

    public function workoutSets()
    {
        return $this->belongsToMany(WorkoutSet::class, 'workout_set_exercises', 'exercise_id', 'workout_set_id');
    }

    public function exerciseResults()
    {
        return $this->hasMany(ExerciseResult::class, 'exercise_id');
    }
}
