@extends('voyager::master')

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <h1 class="my-4">User workouts: {{ $user->name }}</h1>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('voyager.user-workouts.create', $user->id) }}" class="btn btn-success">
            Add Workout
        </a>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Workout name</th>
                <th>Date</th>
                <th>Completed</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($workouts as $workout)
                <tr>
                    <td>{{ $workout->workoutSet->name }}</td>
                    <td>{{ $workout->scheduled_date }}</td>
                    <td>{{ $workout->done ? 'Yes' : 'No' }}</td>
                    <td>
                        <div class="d-inline-flex" role="group">
                            <a href="{{ route('voyager.user-workouts.edit', [$user->id, $workout->id]) }}"
                               class="btn btn-warning btn-sm me-2">
                                Edit
                            </a>
                            <form method="POST"
                                  action="{{ route('voyager.user-workouts.destroy', [$user->id, $workout->id]) }}"
                                  onsubmit="return confirm('Are you sure you want to delete the exercise set?');"
                                  style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">No workouts assigned to the user.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-4">
        <nav aria-label="Pagination">
            <ul class="pagination">
                @if ($workouts->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">Previous</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $workouts->previousPageUrl() }}" aria-label="Previous">
                            Previous
                        </a>
                    </li>
                @endif

                @foreach ($workouts->getUrlRange(1, $workouts->lastPage()) as $page => $url)
                    <li class="page-item {{ $page == $workouts->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach

                @if ($workouts->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $workouts->nextPageUrl() }}" aria-label="Next">
                            Next
                        </a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link">Next</span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>

    <div class="mb-3">
        <a href="{{ route('voyager.manage-users.manage', ['id' => $user->id]) }}" class="btn btn-secondary">
            Return
        </a>
    </div>
</div>
@endsection
