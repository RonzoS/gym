@extends('layouts.app')

@section('content')
<div class="flex">
    <div class="w-1/4 bg-white p-4">
        @include('partials.sidebar-menu')
    </div>

    <div class="w-3/4 bg-gray-100 p-6 rounded-lg shadow-md">
        <h1 class="text-xl font-bold mb-4">Exercises</h1>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <form method="GET" action="{{ route('user.results.index') }}" class="mb-6">
            <div class="flex items-center gap-4">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search by name"
                    class="border border-gray-300 rounded-lg px-4 py-2 w-1/2">

                <select
                    name="muscle"
                    class="border border-gray-300 rounded-lg px-4 py-2 w-1/2">
                    <option value="">-- Select Muscle --</option>
                    @foreach ($muscles as $muscle)
                        <option value="{{ $muscle->id }}"
                                {{ request('muscle') == $muscle->id ? 'selected' : '' }}>
                            {{ $muscle->name }}
                        </option>
                    @endforeach
                </select>

                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
                    Search
                </button>
            </div>
        </form>

        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="border border-gray-300 px-4 py-2">Name</th>
                    <th class="border border-gray-300 px-4 py-2">Category</th>
                    <th class="border border-gray-300 px-4 py-2">Results Count</th>
                    <th class="border border-gray-300 px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($exercises as $exercise)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $exercise->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $exercise->category }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $exercise->user_results_count }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <a href="{{ route('results.show', $exercise->id) }}"
                               class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded inline-block">
                               View
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $exercises->links() }}
        </div>
    </div>
</div>
@endsection
