@extends('voyager::master')

@section('content')
<div class="container">
    <h1>Dodaj Workout dla użytkownika: {{ $user->name }}</h1>

    <form method="POST" action="{{ route('voyager.user-workouts.store', $user->id) }}">
        @csrf

        <div class="form-group">
            <label for="workout_set_id">Wybierz Zestaw Workout</label>
            <select class="form-control select2" name="workout_set_id" id="workout_set_id" required>
                @foreach($workoutSets as $set)
                    <option value="{{ $set->id }}">{{ $set->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="scheduled_date">Data</label>
            <input type="date" class="form-control" name="scheduled_date" id="scheduled_date" required>
        </div>

        <button type="submit" class="btn btn-primary">Dodaj Workout</button>
        <a href="{{ route('voyager.user-workouts.index', $user->id) }}" class="btn btn-secondary">Powrót</a>
    </form>
</div>
@endsection
