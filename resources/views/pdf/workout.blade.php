<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workout</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 20px;
        }
        h1, h2, h3 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .notes {
            height: 150px;
            border: 1px dashed #999;
            margin-top: 20px;
            padding: 10px;
        }
    </style>
</head>
<body>
    <h2>{{ $workout->workoutSet->name }}</h2>
    <h3>Recommendations</h3>
    <p>{!! nl2br(e($workout->recommendations)) !!}</p>

    <h3>Exercises</h3>
    <table>
        <thead>
            <tr>
                <th></th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($workout->workoutSet->exercises as $index => $exercise)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $exercise->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Notes</h3>
    <div class="notes"></div>
</body>
</html>
