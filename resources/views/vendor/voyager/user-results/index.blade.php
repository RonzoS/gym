@extends('voyager::master')

@section('content')
<div class="container">
    <h1>Results for user: {{ $user->name }}</h1>

    <form method="GET" action="{{ route('voyager.user-results.index', $user->id) }}">
        <div class="form-group">
            <input type="text" name="search" class="form-control" placeholder="Search exercises..." value="{{ request('search') }}">
        </div>
        <div class="form-group">
            <select name="muscle" class="form-control">
                <option value="">Filter by muscle group</option>
                @foreach($muscles as $muscle)
                <option value="{{ $muscle->id }}" {{ request('muscle') == $muscle->id ? 'selected' : '' }}>
                    {{ $muscle->name }}
                </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Exercise</th>
                <th>User Results</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($exercises as $exercise)
            <tr>
                <td>{{ $exercise->name }}</td>
                <td>{{ $exercise->user_results_count }}</td>
                <td>
                    <a href="{{ route('voyager.user-results.show', ['user' => $user->id, 'exercise' => $exercise->id]) }}"
                        class="btn btn-info btn-sm">View Results</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-4">
        {{ $exercises->links() }}
    </div>
</div>
@endsection
