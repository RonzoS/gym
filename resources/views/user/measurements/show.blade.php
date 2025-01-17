@extends('layouts.app')

@section('content')
<div class="flex">
    <div class="w-1/4 bg-white p-4">
        @include('partials.sidebar-menu')
    </div>

    <div class="w-3/4 bg-gray-100 p-6 rounded-lg shadow-md">
        <h1 class="text-xl font-bold mb-4">Measurement Details</h1>

        <div class="space-y-4">
            @if ($measurement->created_at)
                <p><strong>Date:</strong> {{ $measurement->created_at->format('Y-m-d') }}</p>
            @endif
            @if ($measurement->weight)
                <p><strong>Weight:</strong> {{ $measurement->weight }} kg</p>
            @endif
            @if ($measurement->height)
                <p><strong>Height:</strong> {{ $measurement->height }} cm</p>
            @endif
            @if ($measurement->bmi)
                <p><strong>BMI:</strong> {{ $measurement->bmi }}</p>
            @endif
            @if ($measurement->muscle_mass)
                <p><strong>Muscle Mass:</strong> {{ $measurement->muscle_mass }} kg</p>
            @endif
            @if ($measurement->muscle_percentage)
                <p><strong>Muscle Percentage:</strong> {{ $measurement->muscle_percentage }}%</p>
            @endif
            @if ($measurement->fat_percentage)
                <p><strong>Fat Percentage:</strong> {{ $measurement->fat_percentage }}%</p>
            @endif
            @if ($measurement->water_percentage)
                <p><strong>Water Percentage:</strong> {{ $measurement->water_percentage }}%</p>
            @endif
            @if ($measurement->neck_circumference)
                <p><strong>Neck Circumference:</strong> {{ $measurement->neck_circumference }} cm</p>
            @endif
            @if ($measurement->arm_circumference)
                <p><strong>Arm Circumference:</strong> {{ $measurement->arm_circumference }} cm</p>
            @endif
            @if ($measurement->forearm_circumference)
                <p><strong>Forearm Circumference:</strong> {{ $measurement->forearm_circumference }} cm</p>
            @endif
            @if ($measurement->wrist_circumference)
                <p><strong>Wrist Circumference:</strong> {{ $measurement->wrist_circumference }} cm</p>
            @endif
            @if ($measurement->chest_circumference)
                <p><strong>Chest Circumference:</strong> {{ $measurement->chest_circumference }} cm</p>
            @endif
            @if ($measurement->waist_circumference)
                <p><strong>Waist Circumference:</strong> {{ $measurement->waist_circumference }} cm</p>
            @endif
            @if ($measurement->hip_circumference)
                <p><strong>Hip Circumference:</strong> {{ $measurement->hip_circumference }} cm</p>
            @endif
            @if ($measurement->thigh_circumference)
                <p><strong>Thigh Circumference:</strong> {{ $measurement->thigh_circumference }} cm</p>
            @endif
            @if ($measurement->calf_circumference)
                <p><strong>Calf Circumference:</strong> {{ $measurement->calf_circumference }} cm</p>
            @endif
            @if ($measurement->ankle_circumference)
                <p><strong>Ankle Circumference:</strong> {{ $measurement->ankle_circumference }} cm</p>
            @endif
        </div>

        @if ($measurement->photo)
            <div class="mt-6">
                <strong>Photo:</strong><br>
                <img src="{{ asset('storage/' . $measurement->photo) }}" alt="Measurement Photo" class="max-w-xs rounded-lg shadow-md">
            </div>
        @endif
        <div class="mt-4">
            <a href="{{ route('user.measurements.index') }}"
                class="py-2 px-4 rounded-lg bg-blue-500 text-white hover:bg-blue-600">
                Return
            </a>
        </div>
    </div>
</div>

@endsection
