<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserWorkout;

class UserWorkoutController extends Controller
{
    public function index()
    {
        $workouts = UserWorkout::with('workoutSet')->where('user_id', auth()->id())->orderBy('scheduled_date', 'desc')->paginate(10);

        return view('user.workouts.index', compact('workouts'));
    }

    public function show($id)
    {
        $workout = UserWorkout::with([
            'workoutSet.exercises.muscles',
            'workoutSet.exercises.tools'
        ])->findOrFail($id);

        return view('user.workouts.show', compact('workout'));
    }

    public function edit($id)
    {
        $workout = UserWorkout::with('workoutSet')->findOrFail($id);

        if (!$workout->done) {
            abort(403, 'Editing is only allowed for completed workouts.');
        }

        return view('user.workouts.edit', compact('workout'));
    }

    public function start($id)
    {
        $workout = UserWorkout::with([
            'workoutSet.exercises.exerciseResults',
            'workoutSet.exercises.muscles',
            'workoutSet.exercises.tools',
        ])->findOrFail($id);

        return view('user.workouts.start', compact('workout'));
    }
}
