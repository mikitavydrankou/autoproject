@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session('status'))
                    <div class="alert alert-success" role="alert" id="success-alert">
                        {{ session('status') }}
                    </div>
                    <script>
                        setTimeout(function () {
                            document.getElementById('success-alert').style.display = 'none';
                        }, 5000);
                    </script>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger" id="error-alert">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                    <script>
                        setTimeout(function () {
                            document.getElementById('error-alert').style.display = 'none';
                        }, 5000);
                    </script>
                @endif
                <div class="container">
                    @isset($cars)
                        <h2>Twoje auto:</h2>
                        @if($cars->isEmpty())
                            <p>Nie masz jeszcze dodanych żadnych samochodów.</p>
                            <a href="{{ route('cars.create') }}" class="btn btn-primary">Dodaj samochód</a>
                        @else
                            <ul class="list-unstyled">
                                @foreach($cars as $car)
                                    <x-car :car="$car"/>
                                @endforeach
                            </ul>
                            <a href="{{ route('cars.create') }}" class="btn btn-primary">
                                Dodaj kolejny samochód
                            </a>
                        @endif
                    @endisset
                </div>
            </div>
        </div>
@endsection
