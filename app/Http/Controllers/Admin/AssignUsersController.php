<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use TCG\Voyager\Http\Controllers\Controller;

class AssignUsersController extends Controller
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

    public function index()
    {
        if (auth()->user()->role_id == 3) {
            $trainers = User::where('id', auth()->id())->get();
        } else {
            $trainers = User::where('role_id', 3)->get();
        }

        return view('vendor.voyager.assign-users.index', compact('trainers'));
    }

    public function edit($trainerId)
    {
        if (auth()->user()->role_id == 3 && auth()->id() != $trainerId) {
            abort(403, 'Access denied');
        }

        $trainer = User::findOrFail($trainerId);

        $assignedUsers = User::where('trainer_id', $trainer->id)->get();

        $availableUsers = User::where(function ($query) use ($trainer) {
            $query->whereNull('trainer_id')
                  ->orWhere('trainer_id', '<>', $trainer->id);
        })->where('role_id', 2)->get();

        return view('vendor.voyager.assign-users.edit', compact('trainer', 'assignedUsers', 'availableUsers'));
    }

    public function update(Request $request, $trainerId)
    {
        $trainer = User::findOrFail($trainerId);

        $userIds = $request->input('user_ids', []);
        User::whereIn('id', $userIds)->update(['trainer_id' => $trainer->id]);

        return redirect()->route('voyager.assign-users.edit', $trainer->id)
                        ->with('success', 'Users have been assigned to a trainer.');
    }

    public function detach($trainerId, $userId)
    {
        $user = User::findOrFail($userId);

        if ($user->trainer_id == $trainerId) {
            $user->trainer_id = null;
            $user->save();
        }

        return redirect()->route('voyager.assign-users.edit', $trainerId)
                        ->with('success', 'The user has been removed from the trainer.');
    }
}
