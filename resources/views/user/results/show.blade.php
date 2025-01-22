@extends('layouts.app')

@section('content')
<div class="flex">
    <div class="w-1/4 bg-white p-4">
        @include('partials.sidebar-menu')
    </div>

    <div class="w-3/4 bg-gray-100 p-6 rounded-lg shadow-md">
        <h1 class="text-xl font-bold mb-4">{{ $exercise->name }}</h1>

        <p><strong>Category:</strong> {{ $exercise->category }}</p>
        <p><strong>Description:</strong></br> {!! nl2br(e($exercise->description)) !!}</p>
        <p><strong>Calories Burned Per Hour:</strong> {{ $exercise->calories_burned_per_hour }} kcal</p>
        <p><strong>Clues:</strong></br> {!! nl2br(e($exercise->clues)) !!}</p>
        @if ($exercise->image)
            <img src="{{ asset('storage/' . $exercise->image) }}" alt="{{ $exercise->name }}" class="mt-4 max-w-full h-auto rounded-lg">
        @endif

        <h5 class="text-md font-bold mt-4">Existing Results</h5>
            @if ($exerciseResults->isEmpty())
                <p class="text-gray-500">No results found for this exercise.</p>
            @else
                <table class="table-auto w-full text-left border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2 border border-gray-300">Reps</th>
                            <th class="px-4 py-2 border border-gray-300">Weight (kg)</th>
                            <th class="px-4 py-2 border border-gray-300">Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($exerciseResults as $result)
                            <tr>
                                <td class="px-4 py-2 border border-gray-300">{{ $result->performed_reps }}</td>
                                <td class="px-4 py-2 border border-gray-300">{{ $result->performed_weight }}</td>
                                <td class="px-4 py-2 border border-gray-300">{{ $result->created_at->format('Y-m-d H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

        <a href="{{ route('user.results.index') }}"
           class="inline-block mt-4 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
           Back to List
        </a>
    </div>
</div>
@endsection
