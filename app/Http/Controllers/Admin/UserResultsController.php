<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExerciseResult;
use App\Models\Exercise;
use App\Models\Muscle;
use App\Models\User;
use Illuminate\Http\Request;

class UserResultsController extends Controller
{
    public function index(Request $request, $userId)
    {
        $user = User::findOrFail($userId);

        $search = $request->input('search');
        $muscleFilter = $request->input('muscle');

        $muscles = Muscle::orderBy('name')->get();

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
                    $subQuery->where('id', $muscleFilter);
                });
            })
            ->orderByDesc('user_results_count')
            ->paginate(10);

        return view('vendor.voyager.user-results.index', compact('user', 'exercises', 'search', 'muscleFilter', 'muscles'));
    }

    public function show($userId, $exerciseId)
    {
        $exercise = Exercise::with(['muscles', 'tools'])->findOrFail($exerciseId);

        $sort = request()->get('sort', 'created_at');
        $direction = request()->get('direction', 'desc');

        $exerciseResults = ExerciseResult::with('userWorkout')
            ->whereHas('userWorkout', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->where('exercise_id', $exerciseId)
            ->orderBy($sort, $direction)
            ->paginate(10);

        return view('vendor.voyager.user-results.show', compact('exercise', 'exerciseResults'));
    }
}
