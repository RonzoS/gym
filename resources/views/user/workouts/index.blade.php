@extends('layouts.app')

@section('content')
<div class="flex">
    <div class="w-1/4 bg-white p-4">
        @include('partials.sidebar-menu')
    </div>

    <div class="w-3/4 bg-gray-100 p-6 rounded-lg shadow-md">
        <h1 class="text-xl font-bold mb-4">My Workouts</h1>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if ($workouts->isEmpty())
            <p class="text-gray-500">No workouts found.</p>
        @else
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">Workout</th>
                        <th class="border border-gray-300 px-4 py-2">Date</th>
                        <th class="border border-gray-300 px-4 py-2">Done</th>
                        <th class="border border-gray-300 px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($workouts as $workout)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">{{ $workout->workoutSet->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $workout->scheduled_date }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                {{ $workout->done ? 'Yes' : 'No' }}
                            </td>
                            <td class="border border-gray-300 px-4 py-2">
                                <div class="flex space-x-2">
                                    @if (!$workout->done)
                                        <a href="{{ route('workouts.start', $workout->id) }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                                            Start
                                        </a>
                                    @else
                                        <a href="{{ route('workouts.edit', $workout->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white py-2 px-4 rounded">
                                            Edit
                                        </a>
                                    @endif

                                    <a href="{{ route('workouts.show', $workout->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
                                        View
                                    </a>

                                    <a href="{{ route('workouts.downloadPdf', $workout->id) }}"
                                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                                        PDF
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <div class="mt-4">
            {{ $workouts->links() }}
        </div>
    </div>
</div>
@endsection
