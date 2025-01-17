@extends('voyager::master')

@section('content')
<div class="container">
    <h1>Pomiar użytkownika: {{ $user->name }}</h1>

    @if($measurements->isEmpty())
        <p>Brak pomiarów dla tego użytkownika.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Data pomiaru</th>
                    <th>Akcje</th>
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
        <a href="{{ route('voyager.manage-users.manage', $user->id) }}" class="btn btn-secondary">Powrót</a>
    </div>
</div>
@endsection
