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

    public function edit($id)
    {
        $result = ExerciseResult::findOrFail($id);

        return view('user.results.edit', compact('result'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'performed_reps' => 'required|integer|min:0',
            'performed_weight' => 'required|numeric|min:0',
        ]);

        $result = ExerciseResult::findOrFail($id);

        $result->performed_reps = $request->input('performed_reps');
        $result->performed_weight = $request->input('performed_weight');
        $result->save();

        return redirect()->route('workouts.start', $result->user_workout_id)
                        ->with('success', 'Result updated successfully.');
    }

    public function destroy($id)
    {
        $result = ExerciseResult::findOrFail($id);
        $result->delete();

        return redirect()->back()->with('success', 'Result deleted successfully.');
    }
}
