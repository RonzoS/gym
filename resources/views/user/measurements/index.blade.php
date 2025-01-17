@extends('layouts.app')

@section('content')
<div class="flex">
    <div class="w-1/4 bg-white p-4">
        @include('partials.sidebar-menu')
    </div>

    <div class="w-3/4 bg-gray-100 p-6 rounded-lg shadow-md">
        <h1 class="text-xl font-bold mb-4">Measurements</h1>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('user.measurements.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg mb-4 inline-block hover:bg-blue-600">
            Add New Measurement
        </a>

        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="border border-gray-300 px-4 py-2">Date</th>
                    <th class="border border-gray-300 px-4 py-2">BMI</th>
                    <th class="border border-gray-300 px-4 py-2">Weight</th>
                    <th class="border border-gray-300 px-4 py-2">Muscle</th>
                    <th class="border border-gray-300 px-4 py-2">Fat</th>
                    <th class="border border-gray-300 px-4 py-2">Water</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($measurements as $measurement)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $measurement->created_at->format('Y-m-d') }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $measurement->bmi }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $measurement->weight }} kg</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $measurement->muscle_percentage }}%</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $measurement->fat_percentage }}%</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $measurement->water_percentage }}%</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <div class="flex space-x-2">
                                <a href="{{ route('measurements.show', $measurement->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">View</a>
                                <a href="{{ route('measurements.edit', $measurement->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white py-2 px-4 rounded">Edit</a>
                                <form
                                    action="{{ route('measurements.destroy', $measurement->id) }}"
                                    method="POST"
                                    class="inline-block m-0"
                                    onsubmit="return confirm('Are you sure you want to delete this measurement?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded inline-block">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                <div class="mt-4">
                    {{ $measurements->links() }}
                </div>
            </tbody>
        </table>
    </div>
</div>
@endsection
