@extends('voyager::master')

@section('content')
<div class="page-content container-fluid">
    <form action="{{ route('voyager.workout-sets.update', $dataTypeContent->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" value="{{ $dataTypeContent->name }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control">{{ $dataTypeContent->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="exercises">Exercises</label>
            <div id="exercise-container">
                @foreach($dataTypeContent->exercises as $exercise)
                <div class="exercise-row" style="margin-bottom: 10px;">
                    <div class="form-group" style="display: flex; gap: 10px; align-items: center;">
                        <select name="exercises[]" class="form-control select2" style="width: 90%;">
                            @foreach($allExercises as $ex)
                                <option value="{{ $ex->id }}" {{ $ex->id == $exercise->id ? 'selected' : '' }}>
                                    {{ $ex->name }}
                                </option>
                            @endforeach
                        </select>
                        <input type="hidden" name="orders[]" value="{{ $exercise->pivot->order }}">
                        <button type="button" class="btn btn-danger remove-exercise" style="width: 10%;">Remove</button>
                    </div>
                </div>
                @endforeach
            </div>
            <button type="button" id="add-exercise" class="btn btn-primary">Add Exercise</button>
        </div>

        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('exercise-container');
    const addButton = document.getElementById('add-exercise');

    // Inicjalizacja Select2
    $('.select2').select2();

    // Funkcja do aktualizacji ukrytych wartości order
    function updateOrders() {
        const rows = container.querySelectorAll('.exercise-row');
        rows.forEach((row, index) => {
            const orderInput = row.querySelector('input[name="orders[]"]');
            if (orderInput) {
                orderInput.value = index + 1; // Ustawia "order" od 1 do X
            }
        });
    }

    // Obsługa dodawania nowego ćwiczenia
    addButton.addEventListener('click', function () {
        const row = document.createElement('div');
        row.classList.add('exercise-row');
        row.style.marginBottom = '10px';
        row.innerHTML = `
            <div class="form-group" style="display: flex; gap: 10px; align-items: center;">
                <select name="exercises[]" class="form-control select2" style="width: 90%;">
                    @foreach($allExercises as $exercise)
                        <option value="{{ $exercise->id }}">{{ $exercise->name }}</option>
                    @endforeach
                </select>
                <input type="hidden" name="orders[]" value="">
                <button type="button" class="btn btn-danger remove-exercise" style="width: 10%;">Remove</button>
            </div>
        `;
        container.appendChild(row);

        // Inicjalizacja Select2 dla nowo dodanego selecta
        $(row).find('.select2').select2();

        // Obsługa usuwania
        row.querySelector('.remove-exercise').addEventListener('click', function () {
            row.remove();
            updateOrders();
        });

        updateOrders(); // Zaktualizuj order po dodaniu
    });

    // Obsługa usuwania wierszy
    container.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-exercise')) {
            e.target.closest('.exercise-row').remove();
            updateOrders();
        }
    });

    // Inicjalizacja order
    updateOrders();
});
</script>
@endsection
