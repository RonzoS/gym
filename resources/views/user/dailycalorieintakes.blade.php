@extends('layouts.app')

@section('content')
<div class="flex">
    <div class="w-1/4 bg-white p-4">
        @include('partials.sidebar-menu')
    </div>

    <div class="w-3/4 bg-gray-100 p-6 rounded-lg shadow-md">
        <h1 class="text-xl font-bold mb-4">Daily Calories Intake</h1>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-2">Calories Information</h2>

            @if ($dailyCalories)
                <p class="mb-2"><strong>Total Calories:</strong> {{ $dailyCalories->calories }} kcal</p>
                <p class="mb-2"><strong>Protein:</strong> {{ $dailyCalories->protein }}g</p>
                <p class="mb-2"><strong>Carbs:</strong> {{ $dailyCalories->carbohydrates }}g</p>
                <p class="mb-2"><strong>Fat:</strong> {{ $dailyCalories->fats }}g</p>
            @else
                <p class="text-gray-500">No daily calorie intake data available.</p>
            @endif
        </div>

    </div>
</div>
@endsection
