<?php

namespace App\Http\Controllers\Admin;

use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use Illuminate\Http\Request;
use App\Models\WorkoutSet;
use App\Models\Exercise;

class WorkoutSetController extends VoyagerBaseController
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!in_array(auth()->user()->role->name, ['admin', 'trainer'])) {
                abort(403, 'Access denied');
            }
            return $next($request);
        });
    }

    public function update(Request $request, $id)
    {
        $workoutSet = WorkoutSet::findOrFail($id);

        $workoutSet->name = $request->input('name');
        $workoutSet->description = $request->input('description');
        $workoutSet->updated_at = now();
        $workoutSet->save();

        $workoutSet->exercises()->detach();

        $exercises = $request->input('exercises', []);
        $orders = $request->input('orders', []);

        foreach ($exercises as $index => $exerciseId) {
            $workoutSet->exercises()->attach($exerciseId, ['order' => $orders[$index]]);
        }

        return redirect()->route('voyager.workout-sets.index')->with('success', 'Workout Set updated successfully!');
    }

    public function edit(Request $request, $id)
    {
        $workoutSet = WorkoutSet::with('exercises')->findOrFail($id);

        $allExercises = Exercise::all();

        return view('vendor.voyager.workout-sets.edit', [
            'dataTypeContent' => $workoutSet,
            'allExercises' => $allExercises,
        ]);
    }
}
