<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkoutSet extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = ['name', 'description', 'creator_id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($workoutSet) {
            if (auth()->check()) {
                $workoutSet->creator_id = auth()->id();
            }
        });
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function exercises()
    {
        return $this->belongsToMany(Exercise::class, 'workout_set_exercises')
                ->withPivot('order')
                ->orderBy('order');
    }
}
