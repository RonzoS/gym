<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\DailyCalorieIntake;
use Illuminate\Http\Request;
use TCG\Voyager\Http\Controllers\Controller;

class UserCalorieIntakeController extends Controller
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

    public function edit($userId)
    {
        $user = User::findOrFail($userId);
        $calorieIntake = $user->dailyCalorieIntake;

        return view('vendor.voyager.calorie-intake.edit', compact('user', 'calorieIntake'));
    }

    public function update(Request $request, $userId)
    {
        $request->validate([
            'calories' => 'required|numeric',
            'carbohydrates' => 'required|numeric',
            'fats' => 'required|numeric',
            'protein' => 'required|numeric',
        ]);

        $user = User::findOrFail($userId);
        $calorieIntake = $user->dailyCalorieIntake;

        if (!$calorieIntake) {
            $calorieIntake = new DailyCalorieIntake();
            $calorieIntake->user_id = $user->id;
        }

        $calorieIntake->calories = $request->input('calories');
        $calorieIntake->carbohydrates = $request->input('carbohydrates');
        $calorieIntake->fats = $request->input('fats');
        $calorieIntake->protein = $request->input('protein');
        $calorieIntake->save();

        return back()->with('success', 'Dzienne spożycie kalorii zostało zaktualizowane.');
    }
}
