@extends('layouts.app')

@section('content')
<div class="flex">
    <div class="w-1/4 bg-white p-4">
        @include('partials.sidebar-menu')
    </div>

    <div class="w-3/4 bg-gray-100 p-6 rounded-lg shadow-md">
        <h1 class="text-xl font-bold mb-4">Start Workout</h1>

        <div class="bg-white p-4 rounded-lg shadow-md">
            <h2 class="text-xl font-bold mb-4">Workout Details</h2>
            <p><strong>Scheduled Date:</strong> {{ $workout->scheduled_date }}</p>
            <p><strong>Workout Name:</strong> {{ $workout->workoutSet->name }}</p>
            <p><strong>Description:</strong></br> {!! nl2br(e($workout->workoutSet->description)) !!}</p>

            <h3 class="text-lg font-bold mt-6 mb-4">Exercises</h3>
            @foreach ($workout->workoutSet->exercises as $exercise)
                <div class="bg-gray-100 p-4 mb-4 rounded-lg shadow">
                    <h4 class="text-lg font-bold">{{ $exercise->name }}</h4>
                    <p><strong>Description:</strong></br> {!! nl2br(e($exercise->description)) !!}</p>

                    <h5 class="text-md font-bold mt-4">Add Result</h5>
                    <form action="{{ route('results.store') }}" method="POST" class="mt-4">
                        @csrf
                        <input type="hidden" name="user_workout_id" value="{{ $workout->id }}">
                        <input type="hidden" name="exercise_id" value="{{ $exercise->id }}">

                        <div class="mb-4">
                            <label for="performed_reps-{{ $exercise->id }}" class="block font-bold mb-2">Performed Reps:</label>
                            <input type="number" id="performed_reps-{{ $exercise->id }}" name="performed_reps"
                                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   required>
                        </div>

                        <div class="mb-4">
                            <label for="performed_weight-{{ $exercise->id }}" class="block font-bold mb-2">Performed Weight (kg):</label>
                            <input type="number" step="0.01" id="performed_weight-{{ $exercise->id }}" name="performed_weight"
                                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   required>
                        </div>

                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
                            Save Result
                        </button>
                    </form>
                </div>
            @endforeach
        </div>

        <a href="{{ route('user.workouts.index') }}"
           class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
           Return
        </a>
    </div>
</div>
@endsection
