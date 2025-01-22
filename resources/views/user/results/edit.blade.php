@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-xl font-bold mb-4">Edit Result</h1>
    <form action="{{ route('results.update', $result->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="performed_reps" class="block font-bold mb-2">Performed Reps:</label>
            <input type="number" id="performed_reps" name="performed_reps" value="{{ $result->performed_reps }}"
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                   required>
        </div>

        <div class="mb-4">
            <label for="performed_weight" class="block font-bold mb-2">Performed Weight (kg):</label>
            <input type="number" step="0.01" id="performed_weight" name="performed_weight" value="{{ $result->performed_weight }}"
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                   required>
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
            Update Result
        </button>
    </form>
</div>
@endsection
