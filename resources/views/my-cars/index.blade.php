@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="container">
                            @isset($cars)
                                <h2>Ваши автомобили</h2>
                                @if($cars->isEmpty())
                                    <p>У вас пока нет добавленных автомобилей.</p>
                                    <a href="{{ route('cars.create') }}" class="btn btn-primary">Добавить автомобиль</a>
                                @else
                                    <ul class="list-unstyled">
                                        @foreach($cars as $car)
                                            <x-car :car="$car"/>
                                        @endforeach
                                    </ul>
                                    <a href="{{ route('cars.create') }}" class="btn btn-primary">
                                        Добавить ещё автомобиль
                                    </a>
                                @endif
                            @endisset
                        </div>
            </div>
        </div>
@endsection
