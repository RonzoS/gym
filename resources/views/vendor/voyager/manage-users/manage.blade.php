@extends('voyager::master')

@section('content')
<div class="container">
    <h1>Zarządzaj użytkownikiem: {{ $user->name }}</h1>

    <div class="card mb-4">
        <div class="card-body" style="position: relative;">
            @if($user->avatar)
            <img src="{{ Voyager::image($user->avatar) }}" alt="{{ $user->name }}"
                 style="position: absolute; top: 10px; right: 10px; max-width: 100px; max-height: 100px; object-fit: cover; border-radius: 50%;">
            @endif

            <h5 class="card-title">Szczegóły użytkownika</h5>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Numer telefonu:</strong> {{ $user->phone_number ?? 'Brak informacji' }}</p>

            @if($trainer)
            <p><strong>Trener:</strong> {{ $trainer->name }}</p>
            @else
            <p><strong>Trener:</strong> Nie przypisano</p>
            @endif
        </div>
    </div>

    <div class="card mb-4">
    <div class="card-body">
        <h5 class="card-title">Zarządzaj zestawami użytkownika</h5>
        <p><strong>Ilość wykonanych zestawów:</strong> {{ $completedWorkouts}}</p>
        <p><strong>Ilość oczekujących zestawów:</strong> {{ $pendingWorkouts }}</p>
        <p><strong>Ilość ominiętych zestawów:</strong> {{ $missedWorkouts }}</p>
        <a href="{{ route('voyager.user-workouts.index', $user->id) }}" class="btn btn-primary">Przypisane Zestawy</a>
    </div>
</div>

    @if($latestMeasurement)
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Ostatnie pomiary</h5>
            <p><strong>Wzrost:</strong> {{ $latestMeasurement->height ?? 'Brak informacji' }} cm</p>
            <p><strong>Waga:</strong> {{ $latestMeasurement->weight ?? 'Brak informacji' }} kg</p>
            <p><strong>BMI:</strong> {{ $latestMeasurement->bmi ?? 'Brak informacji' }}</p>
            <p><strong>Procent mięśni:</strong> {{ $latestMeasurement->muscle_percentage ?? 'Brak informacji' }}%</p>
            <p><strong>Procent tłuszczu:</strong> {{ $latestMeasurement->fat_percentage ?? 'Brak informacji' }}%</p>
            <p><strong>Procent wody:</strong> {{ $latestMeasurement->water_percentage ?? 'Brak informacji' }}%</p>
            <a href="{{ route('voyager.measurements.index', $user->id) }}" class="btn btn-primary">Pomiary</a>
        </div>
    </div>
    @endif

    @if($calorieIntake)
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Dzienne spożycie kalorii</h5>
            <p><strong>Kalorie:</strong> {{ $calorieIntake->calories }} kcal</p>
            <p><strong>Białka:</strong> {{ $calorieIntake->protein }} g</p>
            <p><strong>Węglowodany:</strong> {{ $calorieIntake->carbohydrates }} g</p>
            <p><strong>Tłuszcze:</strong> {{ $calorieIntake->fats }} g</p>
            <a href="{{ route('voyager.calorie-intake.edit', $user->id) }}" class="btn btn-primary">Edytuj Kalorie</a>
        </div>
    </div>
    @endif
</div>
@endsection
