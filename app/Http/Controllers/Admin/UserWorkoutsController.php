<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserWorkout;
use App\Models\WorkoutSet;
use Illuminate\Http\Request;

class UserWorkoutsController extends Controller
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

    public function index(User $user)
    {
        $workouts = UserWorkout::where('user_id', $user->id)
            ->with('workoutSet')
            ->orderBy('scheduled_date', 'desc')
            ->paginate(10);
        return view('vendor.voyager.user-workouts.index', compact('user', 'workouts'));
    }

    public function create(User $user)
    {
        $workoutSets = WorkoutSet::all();
        return view('vendor.voyager.user-workouts.create', compact('user', 'workoutSets'));
    }

    public function store(Request $request, User $user)
    {
        $request->validate([
            'workout_set_id' => 'required|exists:workout_sets,id',
            'scheduled_date' => 'required|date',
        ]);

        $userWorkout = UserWorkout::create([
            'user_id' => $user->id,
            'workout_set_id' => $request->workout_set_id,
            'scheduled_date' => $request->scheduled_date,
        ]);

        return redirect()->route('voyager.user-workouts.edit', [
            'user' => $user->id,
            'workout' => $userWorkout->id,
        ])->with('success', 'Workout został pomyślnie przypisany. Przekierowano na stronę edycji.');
    }

    public function edit(User $user, UserWorkout $workout)
    {
        $workoutSets = WorkoutSet::all();
        $exercises = $workout->workoutSet->exercises;

        return view('vendor.voyager.user-workouts.edit', [
            'user' => $user,
            'workout' => $workout,
            'workoutSets' => $workoutSets,
            'exercises' => $exercises,
        ]);
    }

    public function update(Request $request, User $user, UserWorkout $workout)
    {
        $request->validate([
            'workout_set_id' => 'required|exists:workout_sets,id',
            'scheduled_date' => 'required|date',
        ]);

        $workout->update([
            'workout_set_id' => $request->input('workout_set_id'),
            'scheduled_date' => $request->input('scheduled_date'),
            'recommendations' => $request->input('recommendations'),
        ]);

        return redirect()->route('voyager.user-workouts.index', $user->id)
            ->with('success', 'Workout został zaktualizowany.');
    }

    public function destroy(User $user, UserWorkout $workout)
    {
        $workout->delete();

        return redirect()->route('voyager.user-workouts.index', $user->id)
            ->with('success', 'Workout został pomyślnie usunięty.');
    }
}
