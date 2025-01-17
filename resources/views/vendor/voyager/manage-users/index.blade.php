@extends('voyager::master')

@section('content')
<div class="container">
    <h1>Lista użytkowników</h1>

    <form method="GET" action="{{ route('voyager.manage-users.index') }}">
        <div class="form-group">
            <input type="text" name="search" class="form-control" placeholder="Szukaj użytkownika..." value="{{ request('search') }}">
        </div>
        <button type="submit" class="btn btn-primary">Szukaj</button>
    </form>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nazwa</th>
                <th>Email</th>
                <th>Akcje</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <a href="{{ route('voyager.manage-users.manage', $user->id) }}" class="btn btn-primary">Manage</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
