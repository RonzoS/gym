@extends('voyager::master')

@section('content')
<div class="container">
    <h1>Manage user: {{ $user->name }}</h1>

    <div class="card mb-4">
        <div class="card-body" style="position: relative;">
            @if($user->avatar)
            <img src="{{ Voyager::image($user->avatar) }}" alt="{{ $user->name }}"
                 style="position: absolute; top: 10px; right: 10px; max-width: 100px; max-height: 100px; object-fit: cover; border-radius: 50%;">
            @endif

            <h5 class="card-title">User details</h5>
            <p><strong>E-mail:</strong> {{ $user->email }}</p>
            <p><strong>Phone number:</strong> {{ $user->phone_number ?? 'No information available' }}</p>

            @if($trainer)
            <p><strong>Trainer:</strong> {{ $trainer->name }}</p>
            @else
            <p><strong>Trainer:</strong> Not assigned</p>
            @endif
        </div>
    </div>

    <div class="card mb-4">
    <div class="card-body">
        <h5 class="card-title">Manage user workouts</h5>
        <p><strong>Number of sets completed:</strong> {{ $completedWorkouts}}</p>
        <p><strong>Number of waiting sets:</strong> {{ $pendingWorkouts }}</p>
        <p><strong>Number of sets missed:</strong> {{ $missedWorkouts }}</p>
        <a href="{{ route('voyager.user-workouts.index', $user->id) }}" class="btn btn-primary">Workouts</a>
    </div>
</div>

    @if($latestMeasurement)
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Latest measurements</h5>
            <p><strong>Height:</strong> {{ $latestMeasurement->height ?? 'No information available' }} cm</p>
            <p><strong>Weight:</strong> {{ $latestMeasurement->weight ?? 'No information available' }} kg</p>
            <p><strong>BMI:</strong> {{ $latestMeasurement->bmi ?? 'No information available' }}</p>
            <p><strong>Muscle percentage:</strong> {{ $latestMeasurement->muscle_percentage ?? 'No information available' }}%</p>
            <p><strong>Percentage of fat:</strong> {{ $latestMeasurement->fat_percentage ?? 'No information available' }}%</p>
            <p><strong>Percentage of water:</strong> {{ $latestMeasurement->water_percentage ?? 'No information available' }}%</p>
            <a href="{{ route('voyager.measurements.index', $user->id) }}" class="btn btn-primary">Measurements</a>
        </div>
    </div>
    @endif

    @if($calorieIntake)
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Daily caloric intake</h5>
            <p><strong>Calories:</strong> {{ $calorieIntake->calories }} kcal</p>
            <p><strong>Proteins:</strong> {{ $calorieIntake->protein }} g</p>
            <p><strong>Carbohydrates:</strong> {{ $calorieIntake->carbohydrates }} g</p>
            <p><strong>Fats:</strong> {{ $calorieIntake->fats }} g</p>
            <a href="{{ route('voyager.calorie-intake.edit', $user->id) }}" class="btn btn-primary">Edit calories</a>
        </div>
    </div>
    @endif
</div>
@endsection
