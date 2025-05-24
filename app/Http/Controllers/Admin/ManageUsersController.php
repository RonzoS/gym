<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\UserWorkout;
use Carbon\Carbon;
use Illuminate\Http\Request;
use TCG\Voyager\Http\Controllers\Controller;

class ManageUsersController extends Controller
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

    public function index(Request $request)
    {
        $query = User::query();

        $today = Carbon::today();

        if (auth()->user()->role->id === 3) {
            $query->where('trainer_id', auth()->id());
        }

        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $query->whereHas('subscriptions', function ($q) use ($today) {
            $q->where('name', 'default')
              ->where('stripe_status', 'active')
              ->where(function ($query) use ($today) {
                  $query->whereNull('ends_at')
                        ->orWhereDate('ends_at', '>=', $today);
              });
        });

        $users = $query->where('role_id', 2)
            ->withCount(['userWorkouts' => function ($q) use ($today) {
                $q->where('scheduled_date', '>=', $today);
            }])
            ->orderBy('user_workouts_count')
            ->paginate(10);

        return view('vendor.voyager.manage-users.index', compact('users'));
    }

    public function manage($userId)
    {
        $user = User::findOrFail($userId);

        if (auth()->user()->role->name === 'trainer' && $user->id !== auth()->id() && $user->trainer_id !== auth()->id()) {
            abort(403, 'Access denied');
        }

        $trainer = $user->trainer_id ? User::find($user->trainer_id) : null;
        $latestMeasurement = $user->measurements()->latest()->first();
        $calorieIntake = $user->dailyCalorieIntake;

        $today = Carbon::today();

        $completedWorkouts = UserWorkout::where('user_id', $user->id)
            ->where('done', 1)
            ->count();

        $pendingWorkouts = UserWorkout::where('user_id', $user->id)
            ->where('scheduled_date', '>=', $today)
            ->count();

        $missedWorkouts = UserWorkout::where('user_id', $user->id)
            ->where('scheduled_date', '<', $today)
            ->where('done', 0)
            ->count();

        return view('vendor.voyager.manage-users.manage', compact(
            'user',
            'trainer',
            'latestMeasurement',
            'calorieIntake',
            'completedWorkouts',
            'pendingWorkouts',
            'missedWorkouts'
        ));
    }

    public function editCalorieIntake($userId)
    {
        $user = User::findOrFail($userId);
        $calorieIntake = $user->dailyCalorieIntake;

        return view('vendor.voyager.manage-users.calorie-edit', compact('user', 'calorieIntake'));
    }

    public function updateCalorieIntake(Request $request, $userId)
    {
        $request->validate([
            'calories' => 'required|numeric',
            'carbohydrates' => 'required|numeric',
            'fats' => 'required|numeric',
            'protein' => 'required|numeric',
        ]);

        $user = User::findOrFail($userId);
        $calorieIntake = $user->dailyCalorieIntake;

        $calorieIntake->calories = $request->input('calories');
        $calorieIntake->carbohydrates = $request->input('carbohydrates');
        $calorieIntake->fats = $request->input('fats');
        $calorieIntake->protein = $request->input('protein');
        $calorieIntake->save();

        return redirect()->route('voyager.manage-users.index', ['id' => $user->id])
            ->with('success', 'Daily calorie intake has been updated.');
    }
}
