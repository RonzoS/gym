<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller

{
    public function account()
    {
        $userId = Auth::id();

        $user = User::findOrFail($userId);

        $trainer = null;
        $currentTime = now()->format('H:i');

        if ($user->trainer_id) {
            $trainer = User::find($user->trainer_id);

            if ($trainer) {
                $isAvailable = false;

                if ($trainer->work_start_time && $trainer->work_end_time) {
                    $isAvailable = $currentTime >= $trainer->work_start_time && $currentTime <= $trainer->work_end_time;
                }

                $trainer = [
                    'name' => $trainer->name,
                    'email' => $trainer->email,
                    'phone_number' => $isAvailable ? $trainer->phone_number : null,
                ];
            }
    }

        return view('user.account', [
            'user' => $user,
            'trainer' => $trainer,
        ]);
    }

    public function updateAccount(Request $request)
    {
        $userId = Auth::id();

        $user = User::findOrFail($userId);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone_number' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
            'avatar' => 'nullable|image|max:2048',
            'work_start_time' => 'nullable|date_format:H:i',
            'work_end_time' => 'nullable|date_format:H:i',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('avatar')) {
            $user->avatar = $request->file('avatar')->store('avatars', 'public');
        }

        $user->save();

        return redirect()->route('user.account')->with('success', 'Account updated successfully!');
    }

}
