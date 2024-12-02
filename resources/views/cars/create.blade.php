@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Добавить автомобиль</h1>
        <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="make">make</label>
                <input id="make"
                       type="text"
                       class="form-control"
                       name="make" required>
            </div>

            <div class="form-group">
                <label for="model">model</label>
                <input id="model"
                       type="text"
                       class="form-control"
                       name="model" required>
            </div>

            <div class="form-group">
                <label for="year">year </label>
                <input type="number"
                       class="form-control"
                       id="year"
                       name="year"
                       required min="1886"
                       max="{{ date('Y') }}">
            </div>

            <div class="form-group">
                <label for="license_plate">license_plate</label>
                <input id="license_plate"
                       type="text"
                       class="form-control"
                       name="license_plate" required>
            </div>

            <div class="form-group">
                <label for="engine_type">engine_type</label>
                <input id="engine_type"
                       type="text"
                       class="form-control"
                       name="engine_type" required>
            </div>

            <div class="form-group">
                <label for="transmission">transmission</label>
                <input id="transmission"
                       type="text"
                       class="form-control"
                       name="transmission" required>
            </div>

            <div class="form-group">
                <label for="mileage">mileage</label>
                <input id="mileage"
                       type="text"
                       class="form-control"
                       name="mileage" required>

                @if ($errors->has('mileage'))
                    <span class="text-danger">{{ $errors->first('mileage') }}</span>
                @endif
            </div>


            <div class="form-group">
                <label for="last_service_date">last_service_date</label>
                <input type="number"
                       class="form-control"
                       id="last_service_date"
                       name="last_service_date"
                       required min="1886"
                       max="{{ date('Y') }}">
            </div>


            <div class="mb-3">
                <label for="image" class="form-label">Upload Image</label>
                <div class="input-group">
                    <input type="file" name="image" id="image">
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Добавить автомобиль</button>
        </form>
    </div>
@endsection
