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
                    <p><strong>Clues:</strong> </br> {!! nl2br(e($exercise->clues)) !!}</p>

                    @if (!empty($exercise->image))
                        <div class="mt-4">
                            <strong>Image:</strong>
                            <img src="{{ asset('storage/' . $exercise->image) }}" alt="{{ $exercise->name }}" class="mt-2 rounded-lg max-w-full h-auto">
                        </div>
                    @endif

                    <p><strong>Category:</strong> {{ $exercise->category }}</p>
                    <p><strong>Calories Burned Per Hour:</strong> {{ $exercise->calories_burned_per_hour }} kcal</p>

                    <h5 class="text-md font-bold mt-4">Muscles</h5>
                    @if ($exercise->muscles->isEmpty())
                        <p class="text-gray-500">No muscles associated with this exercise.</p>
                    @else
                        <ul class="list-disc pl-6">
                            @foreach ($exercise->muscles as $muscle)
                                <li>{{ $muscle->name }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <h5 class="text-md font-bold mt-4">Tools</h5>
                    @if ($exercise->tools->isEmpty())
                        <p class="text-gray-500">No tools required for this exercise.</p>
                    @else
                        <ul class="list-disc pl-6">
                            @foreach ($exercise->tools as $tool)
                                <li>{{ $tool->name }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <h5 class="text-md font-bold mt-4">Existing Results</h5>
                    @if ($exercise->exerciseResults->isEmpty())
                        <p class="text-gray-500">No results found for this exercise.</p>
                    @else
                        <table class="table-auto w-full text-left border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="px-4 py-2 border border-gray-300">Reps</th>
                                    <th class="px-4 py-2 border border-gray-300">Weight (kg)</th>
                                    <th class="px-4 py-2 border border-gray-300">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($exercise->exerciseResults as $result)
                                    <tr>
                                        <td class="px-4 py-2 border border-gray-300">{{ $result->performed_reps }}</td>
                                        <td class="px-4 py-2 border border-gray-300">{{ $result->performed_weight }}</td>
                                        <td class="px-4 py-2 border border-gray-300">
                                            <a href="{{ route('results.edit', $result->id) }}"
                                                class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-3 rounded">
                                                Edit
                                            </a>

                                            <form action="{{ route('results.destroy', $result->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded"
                                                    onclick="return confirm('Are you sure you want to delete this result?');">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif

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

        <form id="end-workout-form" action="{{ route('workouts.end', $workout->id) }}" method="POST" class="mt-4">
            @csrf
            @method('PUT')
            <div class="flex space-x-4">
                <button type="button" onclick="document.getElementById('confirm-dialog').showModal()"
                    class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">
                    End Workout
                </button>
                <a href="{{ route('user.workouts.index') }}"
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                    Return
                </a>
            </div>
        </form>

        <dialog id="confirm-dialog" class="rounded-lg shadow-lg p-6">
            <p class="text-lg mb-4">Are you sure you want to end this workout?</p>
            <div class="flex space-x-4">
                <form method="POST" action="{{ route('workouts.end', $workout->id) }}">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">
                        Yes, End Workout
                    </button>
                </form>
                <button type="button" onclick="document.getElementById('confirm-dialog').close()"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-4 rounded">
                    Cancel
                </button>
            </div>
        </dialog>
    </div>
</div>
@endsection

