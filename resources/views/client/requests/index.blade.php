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
                    @isset($service_requests)
                        <h2>Twoje zgłoszenia</h2>
                        @if($service_requests->isEmpty())
                            <p>Nie masz jeszcze żadnych zgłoszeń</p>
                            <a href="{{ route('client.requests.create') }}" class="btn btn-primary">Dodaj zgłoszenie</a>
                        @else
                            <ul class="list-styled">
                                @foreach($service_requests as $service_request)
                                    <x-client_request :service_request="$service_request"/>
                                @endforeach
                            </ul>
                            <a href="{{route('client.requests.create')}}" class="btn btn-primary">
                                Dodaj kolejne zgłoszenie
                            </a>
                        @endif
                    @endisset
                </div>
            </div>
        </div>
    </div>
@endsection
