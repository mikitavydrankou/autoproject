@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Добавить заявку</h1>
        <form action="{{ route('my-requests.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Car Selection -->
            <div class="form-group">
                <label for="car_id">Выберите автомобиль</label>
                <select id="car_id" name="car_id" class="form-control" required>
                    @foreach($cars as $car)
                        <option value="{{ $car->id }}">{{ $car->make }} {{ $car->model }} ({{ $car->year }})</option>
                    @endforeach
                </select>
            </div>



            <!-- Problem Description -->
            <div class="form-group">
                <label for="problem_description">Описание проблемы</label>
                <textarea id="problem_description"
                          name="problem_description"
                          class="form-control"
                          rows="4"
                          required></textarea>
            </div>

            <!-- Urgency -->
            <div class="form-group">
                <label for="urgency">Срочность</label>
                <select id="urgency" name="urgency" class="form-control" required>
                    <option value="low">Низкая</option>
                    <option value="medium">Средняя</option>
                    <option value="high">Высокая</option>
                </select>
            </div>



            <!-- Location -->
            <div class="form-group">
                <label for="location">Местоположение</label>
                <input id="location"
                       type="text"
                       name="location"
                       class="form-control"
                       required>
            </div>

            <!-- Attachments -->
            <div class="form-group">
                <label for="attachments">Фотографии (до 3 штук)</label>
                <div class="input-group">
                    <input type="file" name="attachments[]" id="attachments" multiple accept="image/*">
                </div>
                <small class="form-text text-muted">Вы можете загрузить до 3 изображений.</small>
            </div>

            <!-- Submit Button -->
            <br>
            <button type="submit" class="btn btn-primary">Добавить заявку</button>
        </form>
    </div>
@endsection
