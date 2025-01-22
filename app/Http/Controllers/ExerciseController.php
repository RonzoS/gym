<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Exercise;
use App\Models\ExerciseResult;

class ExerciseController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();

        $search = $request->input('search');
        $muscleFilter = $request->input('muscle');

        $exercises = Exercise::with(['muscles', 'tools'])
            ->withCount(['exerciseResults as user_results_count' => function ($query) use ($userId) {
                $query->whereHas('userWorkout', function ($subQuery) use ($userId) {
                    $subQuery->where('user_id', $userId);
                });
            }])
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->when($muscleFilter, function ($query, $muscleFilter) {
                $query->whereHas('muscles', function ($subQuery) use ($muscleFilter) {
                    $subQuery->where('name', 'like', '%' . $muscleFilter . '%');
                });
            })
            ->orderByDesc('user_results_count')
            ->paginate(10);

        return view('user.results.index', compact('exercises', 'search', 'muscleFilter'));
    }

    public function show($id)
    {
        $userId = Auth::id();

        $exercise = Exercise::with(['muscles', 'tools'])->findOrFail($id);

        $exerciseResults = ExerciseResult::with('userWorkout')
            ->whereHas('userWorkout', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->where('exercise_id', $id)
            ->get();

        return view('user.results.show', compact('exercise', 'exerciseResults'));
    }
}
