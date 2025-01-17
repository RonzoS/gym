@extends('voyager::master')

@section('content')
<div class="container">
    <h1>Measurement details</h1>

    <table class="table table-bordered">
        <tr>
            <th>Weight</th>
            <td>{{ $measurement->weight }} kg</td>
        </tr>
        <tr>
            <th>Height</th>
            <td>{{ $measurement->height }} cm</td>
        </tr>
        <tr>
            <th>Muscle mass</th>
            <td>{{ $measurement->muscle_mass }} kg</td>
        </tr>
        <tr>
            <th>Fat mass</th>
            <td>{{ $measurement->fat_mass }} kg</td>
        </tr>
        <tr>
            <th>Water mass</th>
            <td>{{ $measurement->water_mass }} kg</td>
        </tr>
        <tr>
            <th>BMI</th>
            <td>{{ $measurement->bmi }}</td>
        </tr>
        <tr>
            <th>Muscle percentage</th>
            <td>{{ $measurement->muscle_percentage }}%</td>
        </tr>
        <tr>
            <th>Fat percentage</th>
            <td>{{ $measurement->fat_percentage }}%</td>
        </tr>
        <tr>
            <th>Water percentage</th>
            <td>{{ $measurement->water_percentage }}%</td>
        </tr>
        <tr>
            <th>Neck circumference</th>
            <td>{{ $measurement->neck_circumference }} cm</td>
        </tr>
        <tr>
            <th>Arm circumference</th>
            <td>{{ $measurement->arm_circumference }} cm</td>
        </tr>
        <tr>
            <th>Forearm circumference</th>
            <td>{{ $measurement->forearm_circumference }} cm</td>
        </tr>
        <tr>
            <th>Wrist circumference</th>
            <td>{{ $measurement->wrist_circumference }} cm</td>
        </tr>
        <tr>
            <th>Chest circumference</th>
            <td>{{ $measurement->chest_circumference }} cm</td>
        </tr>
        <tr>
            <th>Waist circumference</th>
            <td>{{ $measurement->waist_circumference }} cm</td>
        </tr>
        <tr>
            <th>Hip circumference</th>
            <td>{{ $measurement->hip_circumference }} cm</td>
        </tr>
        <tr>
            <th>Thigh circumference</th>
            <td>{{ $measurement->thigh_circumference }} cm</td>
        </tr>
        <tr>
            <th>Calf circumference</th>
            <td>{{ $measurement->calf_circumference }} cm</td>
        </tr>
        <tr>
            <th>Ankle circumference</th>
            <td>{{ $measurement->ankle_circumference }} cm</td>
        </tr>
        <tr>
            <th>Photo</th>
            <td>
                @if($measurement->photo)
                    <img src="{{ Voyager::image($measurement->photo) }}" alt="Measurement photo" style="max-width: 600px;">
                @else
                    No photo
                @endif
            </td>
        </tr>
    </table>

    <a href="{{ url()->previous() }}" class="btn btn-secondary">Return</a>
</div>
@endsection
