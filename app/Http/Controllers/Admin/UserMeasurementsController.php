<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserMeasurement;

class UserMeasurementsController extends Controller
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

    public function index($userId)
    {
        $user = User::findOrFail($userId);

        $measurements = UserMeasurement::where('user_id', $userId)
                                        ->orderBy('created_at', 'desc')
                                        ->get();

        return view('vendor.voyager.measurements.index', compact('user', 'measurements'));
    }

    public function show($measurementId)
    {
        $measurement = UserMeasurement::findOrFail($measurementId);

        return view('vendor.voyager.measurements.show', compact('measurement'));
    }
}
