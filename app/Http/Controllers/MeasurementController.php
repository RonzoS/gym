<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserMeasurement;

class MeasurementController extends Controller
{
    public function index()
    {
        $measurements = UserMeasurement::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('user.measurements.index', compact('measurements'));
    }

    public function create()
    {
        return view('user.measurements.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'muscle_mass' => 'required|numeric',
            'fat_mass' => 'required|numeric',
            'water_mass' => 'required|numeric',
            'neck_circumference' => 'nullable|numeric',
            'arm_circumference' => 'nullable|numeric',
            'forearm_circumference' => 'nullable|numeric',
            'wrist_circumference' => 'nullable|numeric',
            'chest_circumference' => 'nullable|numeric',
            'waist_circumference' => 'nullable|numeric',
            'hip_circumference' => 'nullable|numeric',
            'thigh_circumference' => 'nullable|numeric',
            'calf_circumference' => 'nullable|numeric',
            'ankle_circumference' => 'nullable|numeric',
            'photo' => 'nullable|image',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('photos', 'public');
        }

        $data['user_id'] = auth()->id();
        UserMeasurement::create($data);

        return redirect()->route('user.measurements.index')->with('success', 'Measurement added successfully.');
    }

    public function show($id)
    {
        $measurement = UserMeasurement::where('user_id', auth()->id())->findOrFail($id);
        return view('user.measurements.show', compact('measurement'));
    }

    public function edit($id)
    {
        $measurement = UserMeasurement::where('user_id', auth()->id())->findOrFail($id);
        return view('user.measurements.create', compact('measurement'));
    }

    public function update(Request $request, $id)
    {
        $measurement = UserMeasurement::where('user_id', auth()->id())->findOrFail($id);

        $data = $request->validate([
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'muscle_mass' => 'nullable|numeric',
            'fat_mass' => 'nullable|numeric',
            'water_mass' => 'nullable|numeric',
            'neck_circumference' => 'nullable|numeric',
            'arm_circumference' => 'nullable|numeric',
            'forearm_circumference' => 'nullable|numeric',
            'wrist_circumference' => 'nullable|numeric',
            'chest_circumference' => 'nullable|numeric',
            'waist_circumference' => 'nullable|numeric',
            'hip_circumference' => 'nullable|numeric',
            'thigh_circumference' => 'nullable|numeric',
            'calf_circumference' => 'nullable|numeric',
            'ankle_circumference' => 'nullable|numeric',
            'photo' => 'nullable|image',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('photos', 'public');
        }

        $measurement->update($data);

        return redirect()->route('user.measurements.index')->with('success', 'Measurement updated successfully.');
    }

    public function destroy($id)
    {
        $measurement = UserMeasurement::where('user_id', auth()->id())->findOrFail($id);
        $measurement->delete();

        return redirect()->route('user.measurements.index')->with('success', 'Measurement deleted successfully.');
    }
}
