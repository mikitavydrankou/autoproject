@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Добавить заявку</h1>
        <form action="{{ route('client.requests.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Car Selection -->
            <div class="form-group">
                <label for="car_id">Wybierz samochód</label>
                <select id="car_id" name="car_id" class="form-control" required>
                    @foreach($cars as $car)
                        <option value="{{ $car->id }}">{{ $car->make }} {{ $car->model }} ({{ $car->year }})</option>
                    @endforeach
                </select>
            </div>


            <!-- Problem Description -->
            <div class="form-group">
                <label for="problem_description">Opis problemu</label>
                <textarea id="problem_description"
                          name="problem_description"
                          class="form-control"
                          rows="4"
                          required></textarea>
            </div>

            <!-- Urgency -->
            <div class="form-group">
                <label for="urgency">Pilność</label>
                <select id="urgency" name="urgency" class="form-control" required>
                    <option value="low">Niewielkie znaczenie</option>
                    <option value="medium">Średnie znaczenie</option>
                    <option value="high">Duże znaczenie</option>
                </select>
            </div>


            <!-- Location -->
            <div class="form-group">
                <label for="location">Lokalizacja</label>
                <input id="location"
                       type="text"
                       name="location"
                       class="form-control"
                       required>
            </div>

            <!-- Attachments -->
            <div class="form-group">
                <label for="attachments">Zdjęcia (do 3 sztuk)</label>
                <div class="input-group">
                    <input type="file" name="attachments[]" id="attachments" multiple accept="image/*">
                </div>
                <small class="form-text text-muted">
                    Możesz przesłać maksymalnie 3 zdjęcia.
                </small>
            </div>

            <!-- Submit Button -->
            <br>
            <button type="submit" class="btn btn-primary">Dodaj zgłoszenie</button>
        </form>
    </div>
@endsection
