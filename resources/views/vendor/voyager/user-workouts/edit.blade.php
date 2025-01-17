@extends('voyager::master')

@section('content')
<div class="container">
    <h1>Edytuj Workout dla: {{ $user->name }}</h1>

    <form action="{{ route('voyager.user-workouts.update', [$user->id, $workout->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="workout_set_id">Zestaw ćwiczeń</label>
            <select name="workout_set_id" id="workout_set_id" class="form-control select2">
                @foreach($workoutSets as $set)
                <option value="{{ $set->id }}" {{ $set->id == $workout->workout_set_id ? 'selected' : '' }}>
                    {{ $set->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="scheduled_date">Data</label>
            <input type="date" name="scheduled_date" id="scheduled_date" class="form-control"
                value="{{ $workout->scheduled_date }}">
        </div>

        <div class="form-group">
            <label for="recommendations">Rekomendacje</label>
            <textarea name="recommendations" id="recommendations" class="form-control" rows="3">{{ $workout->recommendations }}</textarea>
        </div>

        <h5>Ćwiczenia w zestawie</h5>
        <ul class="list-group mb-3">
            @forelse($exercises as $workoutExercise)
            <li class="list-group-item">
                <strong>{{ $workoutExercise->name }}</strong></br>
                <strong>{{ $workoutExercise->category }}</strong>
            </li>
            @empty
            <p class="text-muted">Brak ćwiczeń w tym zestawie.</p>
            @endforelse
        </ul>

        <button type="submit" class="btn btn-primary">Zapisz</button>
        <a href="{{ route('voyager.user-workouts.index', $user->id) }}" class="btn btn-secondary">Powrót</a>
    </form>
</div>
@endsection