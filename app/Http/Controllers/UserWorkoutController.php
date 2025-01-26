<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\UserWorkout;
use Barryvdh\DomPDF\Facade\Pdf;

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
            'workoutSet.exercises.exerciseResults' => function ($query) use ($id) {
                $query->where('user_workout_id', $id);
            },
            'workoutSet.exercises.muscles',
            'workoutSet.exercises.tools',
        ])->findOrFail($id);

        return view('user.workouts.show', compact('workout'));
    }

    public function edit($id)
    {
        $workout = UserWorkout::with([
            'workoutSet.exercises.exerciseResults' => function ($query) use ($id) {
                $query->where('user_workout_id', $id);
            },
            'workoutSet.exercises.muscles',
            'workoutSet.exercises.tools',
        ])->findOrFail($id);

        if (!$workout->done) {
            abort(403, 'Editing is only allowed for completed workouts.');
        }

        return view('user.workouts.edit', compact('workout'));
    }

    public function start($id)
    {
        $workout = UserWorkout::with([
            'workoutSet.exercises.exerciseResults' => function ($query) use ($id) {
                $query->where('user_workout_id', $id);
            },
            'workoutSet.exercises.muscles',
            'workoutSet.exercises.tools',
        ])->findOrFail($id);

        return view('user.workouts.start', compact('workout'));
    }

    public function end($id)
    {
        $workout = UserWorkout::findOrFail($id);

        $workout->done = 1;
        $workout->save();

        return redirect()->route('user.workouts.index')->with('success', 'Workout has been successfully ended.');
    }

    public function downloadPdf($id)
    {
        $workout = UserWorkout::with(['workoutSet.exercises'])
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Generowanie PDF
        $pdf = Pdf::loadView('pdf.workout', compact('workout'));

        // Zwrot pliku PDF do pobrania
        return $pdf->download('workout-' . $workout->id . '.pdf');
    }
}
