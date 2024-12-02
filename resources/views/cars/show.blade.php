@extends('layouts.app')

@section('content')
    <div class="container">
        <a class="btn-outline-primary" href={{ route('cars.edit', $car->id)}}>Edit</a>
        <div class="card">
            <div class="card-header">Car page</div>
            <div class="card-body">
                <div class="card-body">
                    <p class="card-text">make: {{ $car->make }}</p>
                    <p class="card-text">model: {{ $car->model }}</p>
                    <p class="card-text">year: {{ $car->year }}</p>
                    <p class="card-text">license_plate: {{ $car->license_plate }}</p>
                    <p class="card-text">engine_type: {{ $car->engine_type }}</p>
                    <p class="card-text">transmission: {{ $car->transmission }}</p>
                    <p class="card-text">mileage: {{ $car->mileage }}</p>
                    <p class="card-text">last_service_date: {{ $car->last_service_date }}</p>
                </div>
                <hr/>
            </div>
        </div>
    </div>
@endsection
