@extends('layouts.app')

@section('content')
<div class="flex">
    <div class="w-1/4 bg-white p-4">
        @include('partials.sidebar-menu')
    </div>

    <div class="w-3/4 bg-gray-100 p-6 rounded-lg shadow-md">

        @if ($errors->any())
            <div class="mb-4 bg-red-100 text-red-500 p-4 rounded-lg">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h1 class="text-xl font-bold mb-4">{{ isset($measurement) ? 'Edit Measurement' : 'Add Measurement' }}</h1>

        <form action="{{ isset($measurement) ? route('measurements.update', $measurement->id) : route('user.measurements.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if (isset($measurement))
                @method('PUT')
            @endif

            <div class="mb-4">
                <label for="weight" class="block font-medium">Weight (kg)*</label>
                <input type="text" name="weight" id="weight" value="{{ old('weight', $measurement->weight ?? '') }}" class="block w-full mt-1 p-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label for="height" class="block font-medium">Height (cm)*</label>
                <input type="text" name="height" id="height" value="{{ old('height', $measurement->height ?? '') }}" class="block w-full mt-1 p-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label for="muscle_mass" class="block font-medium">Muscle Mass (kg)*</label>
                <input type="text" name="muscle_mass" id="muscle_mass" value="{{ old('muscle_mass', $measurement->muscle_mass ?? '') }}" class="block w-full mt-1 p-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label for="fat_mass" class="block font-medium">Fat Mass (kg)*</label>
                <input type="text" name="fat_mass" id="fat_mass" value="{{ old('fat_mass', $measurement->fat_mass ?? '') }}" class="block w-full mt-1 p-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label for="water_mass" class="block font-medium">Water Mass (kg)*</label>
                <input type="text" name="water_mass" id="water_mass" value="{{ old('water_mass', $measurement->water_mass ?? '') }}" class="block w-full mt-1 p-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label for="neck_circumference" class="block font-medium">Neck Circumference (cm)</label>
                <input type="text" name="neck_circumference" id="neck_circumference" value="{{ old('neck_circumference', $measurement->neck_circumference ?? '') }}" class="block w-full mt-1 p-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label for="arm_circumference" class="block font-medium">Arm Circumference (cm)</label>
                <input type="text" name="arm_circumference" id="arm_circumference" value="{{ old('arm_circumference', $measurement->arm_circumference ?? '') }}" class="block w-full mt-1 p-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label for="forearm_circumference" class="block font-medium">Forearm Circumference (cm)</label>
                <input type="text" name="forearm_circumference" id="forearm_circumference" value="{{ old('forearm_circumference', $measurement->forearm_circumference ?? '') }}" class="block w-full mt-1 p-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label for="wrist_circumference" class="block font-medium">Wrist Circumference (cm)</label>
                <input type="text" name="wrist_circumference" id="wrist_circumference" value="{{ old('wrist_circumference', $measurement->wrist_circumference ?? '') }}" class="block w-full mt-1 p-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label for="chest_circumference" class="block font-medium">Chest Circumference (cm)</label>
                <input type="text" name="chest_circumference" id="chest_circumference" value="{{ old('chest_circumference', $measurement->chest_circumference ?? '') }}" class="block w-full mt-1 p-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label for="waist_circumference" class="block font-medium">Waist Circumference (cm)</label>
                <input type="text" name="waist_circumference" id="waist_circumference" value="{{ old('waist_circumference', $measurement->waist_circumference ?? '') }}" class="block w-full mt-1 p-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label for="hip_circumference" class="block font-medium">Hip Circumference (cm)</label>
                <input type="text" name="hip_circumference" id="hip_circumference" value="{{ old('hip_circumference', $measurement->hip_circumference ?? '') }}" class="block w-full mt-1 p-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label for="thigh_circumference" class="block font-medium">Thigh Circumference (cm)</label>
                <input type="text" name="thigh_circumference" id="thigh_circumference" value="{{ old('thigh_circumference', $measurement->thigh_circumference ?? '') }}" class="block w-full mt-1 p-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label for="calf_circumference" class="block font-medium">Calf Circumference (cm)</label>
                <input type="text" name="calf_circumference" id="calf_circumference" value="{{ old('calf_circumference', $measurement->calf_circumference ?? '') }}" class="block w-full mt-1 p-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label for="ankle_circumference" class="block font-medium">Ankle Circumference (cm)</label>
                <input type="text" name="ankle_circumference" id="ankle_circumference" value="{{ old('ankle_circumference', $measurement->ankle_circumference ?? '') }}" class="block w-full mt-1 p-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label for="photo" class="block font-medium">Photo</label>
                @if (isset($measurement) && $measurement->photo)
                    <img src="{{ asset('storage/' . $measurement->photo) }}" alt="Measurement Photo" class="mb-2 max-w-xs rounded-lg shadow-md">
                @endif
                <input type="file" name="photo" id="photo" class="block w-full mt-1">
                <small class="text-gray-500">Leave empty if you don't want to change the photo.</small>
            </div>

            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                    {{ isset($measurement) ? 'Save Changes' : 'Add Measurement' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
