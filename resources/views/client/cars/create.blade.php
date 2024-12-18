@extends('layouts.app')

@section('content')

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

    <div class="container">
        <h1>Dodaj samochód</h1>
        <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="make">Marka</label>
                <input id="make" type="text" class="form-control" name="make" required>
            </div>

            <div class="form-group">
                <label for="model">Model</label>
                <input id="model" type="text" class="form-control" name="model" required>
            </div>

            <div class="form-group">
                <label for="year">Rok</label>
                <select id="year" name="year" class="form-control" required style="max-height: 200px; overflow-y: auto; width: auto;">
                    @for ($i = date('Y'); $i >= 1886; $i--)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>

            <div class="form-group">
                <label for="last_service_date">Ostatnia data obsługi (opcjonalnie)</label>
                <div class="d-flex align-items-center">
                    <select id="last_service_date" name="last_service_date" class="form-control" style="max-height: 200px; overflow-y: auto; width: auto;">
                        <option value=""> Wybierz rok </option>
                    </select>
                    <div class="form-check ms-3">
                        <input class="form-check-input" type="checkbox" id="no_service_checkbox">
                        <label class="form-check-label" for="no_service_checkbox">Nie było obsługi</label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="license_plate">Tablica rejestracyjna</label>
                <input id="license_plate" type="text" class="form-control" name="license_plate" required>
            </div>

            <div class="form-group">
                <label for="engine_type">Typ silnika</label>
                <select id="engine_type" name="engine_type" class="form-control" required>
                    <option value="diesel">Diesel</option>
                    <option value="petrol">Benzynowy</option>
                    <option value="gas">Instalacja gazowa</option>
                    <option value="hybrid">Hybryd</option>
                    <option value="electric">Elektryczny</option>
                </select>
            </div>

            <div class="form-group">
                <label for="transmission">Skrzynia biegów</label>
                <select id="transmission" name="transmission" class="form-control" required>
                    <option value="manual">Manualna</option>
                    <option value="automated">Zautomatyzowana</option>
                    <option value="automatic">Automatyczna</option>
                </select>
            </div>

            <div class="form-group">
                <label for="mileage">Przebieg</label>
                <input id="mileage" type="text" class="form-control" name="mileage" required>
                @if ($errors->has('mileage'))
                    <span class="text-danger">{{ $errors->first('mileage') }}</span>
                @endif
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Prześlij obraz</label>
                <div class="input-group">
                    <input type="file" name="image" id="image">
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Dodaj samochód</button>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            const currentYear = new Date().getFullYear();

            $('#year').change(function() {
                const selectedYear = parseInt($(this).val());
                const serviceDateSelect = $('#last_service_date');

                serviceDateSelect.empty();
                serviceDateSelect.append('<option value=""> Wybierz rok </option>');

                for (let i = selectedYear + 1; i <= currentYear; i++) {
                    serviceDateSelect.append(`<option value="${i}">${i}</option>`);
                }
            });

            // Обработка чекбокса "Nie było obsługi"
            $('#no_service_checkbox').change(function() {
                const isChecked = $(this).is(':checked');
                $('#last_service_date').prop('disabled', isChecked);
                if (isChecked) {
                    $('#last_service_date').val('');
                }
            });
        });
    </script>
@endsection
