@extends('layouts.app')

@section('content')
<div class="flex">
    <div class="w-1/4 bg-white p-4">
        @include('partials.sidebar-menu')
    </div>

    <div class="w-3/4 bg-gray-100 p-6 rounded-lg shadow-md">
        <h1 class="text-xl font-bold mb-4">Edit Workout</h1>

        <form action="{{ route('user.workouts.update', $workout->id) }}" method="POST" class="bg-white p-4 rounded-lg shadow-md">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="scheduled_date" class="block font-bold mb-2">Scheduled Date:</label>
                <input type="date" name="scheduled_date" id="scheduled_date" value="{{ $workout->scheduled_date }}" class="w-full p-2 border rounded">
            </div>

            <div class="mb-4">
                <label for="recommendations" class="block font-bold mb-2">Recommendations:</label>
                <textarea name="recommendations" id="recommendations" class="w-full p-2 border rounded">{{ $workout->recommendations }}</textarea>
            </div>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Save Changes</button>
        </form>
    </div>
</div>
@endsection
