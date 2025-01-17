<?php

namespace App\Http\Controllers;

use App\Models\DailyCalorieIntake;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DailyCalorieIntakeController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $user = User::findOrFail($userId);

        $dailyCalories = DailyCalorieIntake::where('user_id', $user->id)->first();

        return view('user.dailycalorieintakes', compact('dailyCalories'));
    }
}
