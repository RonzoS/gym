@extends('voyager::master')

@section('content')
<div class="container">
    <h1>Szczegóły pomiaru</h1>

    <table class="table table-bordered">
        <tr>
            <th>Waga</th>
            <td>{{ $measurement->weight }} kg</td>
        </tr>
        <tr>
            <th>Wzrost</th>
            <td>{{ $measurement->height }} cm</td>
        </tr>
        <tr>
            <th>Masa mięśniowa</th>
            <td>{{ $measurement->muscle_mass }} kg</td>
        </tr>
        <tr>
            <th>Masa tłuszczowa</th>
            <td>{{ $measurement->fat_mass }} kg</td>
        </tr>
        <tr>
            <th>Masa wody</th>
            <td>{{ $measurement->water_mass }} kg</td>
        </tr>
        <tr>
            <th>BMI</th>
            <td>{{ $measurement->bmi }}</td>
        </tr>
        <tr>
            <th>Procent mięśni</th>
            <td>{{ $measurement->muscle_percentage }}%</td>
        </tr>
        <tr>
            <th>Procent tłuszczu</th>
            <td>{{ $measurement->fat_percentage }}%</td>
        </tr>
        <tr>
            <th>Procent wody</th>
            <td>{{ $measurement->water_percentage }}%</td>
        </tr>
        <tr>
            <th>Obwód szyi</th>
            <td>{{ $measurement->neck_circumference }} cm</td>
        </tr>
        <tr>
            <th>Obwód ramienia</th>
            <td>{{ $measurement->arm_circumference }} cm</td>
        </tr>
        <tr>
            <th>Obwód przedramienia</th>
            <td>{{ $measurement->forearm_circumference }} cm</td>
        </tr>
        <tr>
            <th>Obwód nadgarstka</th>
            <td>{{ $measurement->wrist_circumference }} cm</td>
        </tr>
        <tr>
            <th>Obwód klatki</th>
            <td>{{ $measurement->chest_circumference }} cm</td>
        </tr>
        <tr>
            <th>Obwód talii</th>
            <td>{{ $measurement->waist_circumference }} cm</td>
        </tr>
        <tr>
            <th>Obwód bioder</th>
            <td>{{ $measurement->hip_circumference }} cm</td>
        </tr>
        <tr>
            <th>Obwód uda</th>
            <td>{{ $measurement->thigh_circumference }} cm</td>
        </tr>
        <tr>
            <th>Obwód łydki</th>
            <td>{{ $measurement->calf_circumference }} cm</td>
        </tr>
        <tr>
            <th>Obwód kostki</th>
            <td>{{ $measurement->ankle_circumference }} cm</td>
        </tr>
        <tr>
            <th>Zdjęcie</th>
            <td>
                @if($measurement->photo)
                <img src="{{ Voyager::image($measurement->photo) }}" alt="Zdjęcie pomiaru" style="max-width: 600px;">
                @else
                Brak zdjęcia
                @endif
            </td>
        </tr>
    </table>

    <a href="{{ url()->previous() }}" class="btn btn-secondary">Powrót</a>
</div>
@endsection
