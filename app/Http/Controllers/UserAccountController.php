<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserAccountController extends Controller
{
    public function workouts()
    {
        return view('user.workouts');
    }

    public function account()
{
    $user = Auth::user(); // Pobiera dane zalogowanego użytkownika

    // Jeśli użytkownik ma rolę trenera, załaduj dodatkowe dane
    $trainerDetails = null;
    if ($user->role === 'trainer') {
        $trainerDetails = $user->trainer; // Relacja 'trainer' musi być ustawiona w modelu User
    }

    return view('user.account', [
        'user' => $user,
        'trainerDetails' => $trainerDetails, // Szczegóły trenera
    ]);
}

    public function results()
    {
        return view('user.results');
    }

    public function measurements()
    {
        return view('user.measurements');
    }

    public function dailycalorieintakes()
    {
        return view('user.dailycalorieintakes');
    }
}
