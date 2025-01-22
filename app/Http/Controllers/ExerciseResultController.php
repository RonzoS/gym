<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\ExerciseResult;

class ExerciseResultController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_workout_id' => 'required|exists:user_workouts,id',
            'exercise_id' => 'required|exists:exercises,id',
            'performed_reps' => 'required|integer|min:0',
            'performed_weight' => 'required|numeric|min:0',
        ]);

        ExerciseResult::create($validatedData);

        return redirect()->back()->with('success', 'Result added successfully.');
    }
}
