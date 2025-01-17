@extends('voyager::master')

@section('content')
<div class="container">
    <h1>User measurement: {{ $user->name }}</h1>

    @if($measurements->isEmpty())
        <p>No measurements for this user.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Measurement date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($measurements as $measurement)
                <tr>
                    <td>{{ $measurement->created_at->format('Y-m-d H:i') }}</td>
                    <td>
                        <a href="{{ route('voyager.measurements.show', $measurement->id) }}" class="btn btn-primary btn-sm">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    <div class="d-flex justify-content-between">
        <a href="{{ route('voyager.manage-users.manage', $user->id) }}" class="btn btn-secondary">Return</a>
    </div>
</div>
@endsection
