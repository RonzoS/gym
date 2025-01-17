@extends('voyager::master')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Edytuj trenera: {{ $trainer->name }}</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card mb-5">
        <div class="card-header">
            <h3 class="custom-margin">Przypisani użytkownicy</h3>
        </div>
        <div class="card-body">
            @if($assignedUsers->isEmpty())
                <p>Brak przypisanych użytkowników.</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Imię i nazwisko</th>
                            <th>Email</th>
                            <th>Akcje</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($assignedUsers as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <form method="POST"
                                          action="{{ route('voyager.assign-users.detach', [$trainer->id, $user->id]) }}"
                                          onsubmit="return confirm('Czy na pewno chcesz usunąć tego użytkownika?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Usuń</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="custom-margin">Dodaj użytkowników</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('voyager.assign-users.update', $trainer->id) }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="users">Wybierz użytkowników:</label>
                    <select name="user_ids[]" id="users" class="form-control select2" multiple>
                        @foreach($availableUsers as $user)
                            <option value="{{ $user->id }}">
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Dodaj użytkowników</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('css')
<style>
    .custom-margin {
        margin-left: 15px;
    }
</style>
@endsection


