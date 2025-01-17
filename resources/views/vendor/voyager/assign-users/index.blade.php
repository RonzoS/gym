@extends('voyager::master')

@section('content')
<div class="container">
    <h1>Lista trenerów</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Lista trenerów -->
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Imię i nazwisko</th>
                <th>E-mail</th>
                <th>Akcje</th>
            </tr>
        </thead>
        <tbody>
            @foreach($trainers as $trainer)
                <tr>
                    <td>{{ $trainer->id }}</td>
                    <td>{{ $trainer->name }}</td>
                    <td>{{ $trainer->email }}</td>
                    <td>
                        <a href="{{ route('voyager.assign-users.edit', $trainer->id) }}" class="btn btn-primary">Edytuj</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
