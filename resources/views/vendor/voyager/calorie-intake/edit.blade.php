@extends('voyager::master')

@section('content')
<div class="container">
    <h1>Manage calorie intake: {{ $user->name }}</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('voyager.calorie-intake.update', $user->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="calories">Calories:</label>
            <input type="number" name="calories" id="calories" class="form-control"
                   value="{{ $calorieIntake->calories ?? '' }}" required>
        </div>

        <div class="form-group">
            <label for="carbohydrates">Carbohydrates:</label>
            <input type="number" name="carbohydrates" id="carbohydrates" class="form-control"
                   value="{{ $calorieIntake->carbohydrates ?? '' }}" required>
        </div>

        <div class="form-group">
            <label for="fats">Fats:</label>
            <input type="number" name="fats" id="fats" class="form-control"
                   value="{{ $calorieIntake->fats ?? '' }}" required>
        </div>

        <div class="form-group">
            <label for="protein">Proteins:</label>
            <input type="number" name="protein" id="protein" class="form-control"
                   value="{{ $calorieIntake->protein ?? '' }}" required>
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('voyager.manage-users.manage', $user->id) }}" class="btn btn-secondary">Return</a>
        </div>
    </form>
</div>
@endsection
