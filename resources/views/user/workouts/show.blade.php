@extends('layouts.app')

@section('content')
<div class="flex">
    <div class="w-1/4 bg-white p-4">
        @include('partials.sidebar-menu')
    </div>

    <div class="w-3/4 bg-gray-100 p-6 rounded-lg shadow-md">
        <h1 class="text-xl font-bold mb-4">Workout Details</h1>

        <div class="bg-white p-4 rounded-lg shadow-md">
            <h2 class="text-xl font-bold mb-4">Workout Details</h2>
            <p><strong>Scheduled Date:</strong> {{ $workout->scheduled_date }}</p>
            <p><strong>Workout Name:</strong> {{ $workout->workoutSet->name }}</p>
            <p><strong>Done:</strong> {{ $workout->done ? 'Yes' : 'No' }}</p>
            <p><strong>Description:</strong> </br> {!! nl2br(e($workout->workoutSet->description)) !!}</p>
            <p><strong>Recommendations:</strong> </br> {!! nl2br(e($workout->recommendations)) !!}</p>

            <h3 class="text-lg font-bold mt-6 mb-4">Exercises in this Workout Set</h3>
            @if ($workout->workoutSet->exercises->isEmpty())
                <p class="text-gray-500">No exercises found for this workout set.</p>
            @else
                @foreach ($workout->workoutSet->exercises as $exercise)
                    <div class="bg-gray-100 p-4 mb-4 rounded-lg shadow">
                        <h4 class="text-lg font-bold cursor-pointer" onclick="toggleDetails('exercise-{{ $loop->index }}')">
                            {{ $exercise->name }}
                            <span id="arrow-{{ $loop->index }}" class="transition-transform transform rotate-0">
                                &#9662;
                            </span>
                        </h4>

                        <div id="exercise-{{ $loop->index }}" class="exercise-details hidden mt-4">
                            <p><strong>Description:</strong> </br> {!! nl2br(e($exercise->description)) !!}</p>
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
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <a href="{{ route('user.workouts.index') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
            Return
        </a>
    </div>
</div>

{{-- JavaScript --}}
<script>
    function toggleDetails(id) {
        const element = document.getElementById(id);
        if (element.classList.contains('hidden')) {
            element.classList.remove('hidden');
        } else {
            element.classList.add('hidden');
        }
    }
</script>
@endsection
