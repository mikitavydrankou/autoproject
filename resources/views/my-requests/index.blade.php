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
                        @isset($requests)
                            <h2>Ваши заявки</h2>
                            @if($requests->isEmpty())
                                <p>У вас пока нет заявок</p>
                                <a href="{{ route('my-requests.create') }}" class="btn btn-primary">Добавить заявку</a>
                            @else
                                <ul class="list-styled">
                                    @foreach($requests as $request)
                                        <x-request :request="$request"/>
                                    @endforeach
                                </ul>
                                <a href="{{route('my-requests.create')}}" class="btn btn-primary">
                                    Добавить ещё заявку
                                </a>
                            @endif
                        @endisset
                    </div>
            </div>
        </div>
    </div>
@endsection
