@extends('layouts.app')

@section('content')

    <script>
        function selectServiceRequest(serviceRequestId, serviceRequestDescription) {
            document.getElementById('selected_service_request_id').value = serviceRequestId;
            document.getElementById('selected_service_request_display').value = serviceRequestDescription;
        }
    </script>

        <div class="container">
            <div class="col-md-12">
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
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-2">
                    filter filter filter filter filter filter filter filter filter filter filter filter filter filter
                    filter
                    filter filter filter filter filter filter filter filter filter filter filter filter filter filter
                    filter
                    filter filter filter filter filter filter filter filter filter filter filter filter
                </div>
                <div class="col-6">
                    @isset($service_requests)
                        @if($service_requests->isEmpty())
                            <p>Nie ma żadnych zgłoszeń</p>
                        @else
                            <ul class="list-styled">
                                @foreach($service_requests as $service_request)
                                    <x-service_request :service_request="$service_request"/>
                                @endforeach
                            </ul>
                        @endif
                    @endisset
                </div>
                <div class="col-4">
                    <form action="{{ route('service.offers.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="car_id">Wybrane zgłoszenie</label>
                            <input type="text" id="selected_service_request_display" class="form-control"
                                   value="Wybiersz zgłoszenie" disabled>
                            <input type="hidden" id="selected_service_request_id" name="service_request_id" value=""
                            >
                        </div>
                        <div class="form-group">
                            <label for="selected_service_request">Wybierz warsztat</label>
                            <select id="service_id" name="service_id" class="form-control" required>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->name }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Powiadomienie</label>
                            <textarea id="description"
                                      name="description"
                                      class="form-control"
                                      rows="4"
                                      required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="price">Cena</label>
                            <input id="price"
                                   type="number"
                                   name="price"
                                   class="form-control"
                                   required>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Wyslij oferte</button>
                    </form>
                </div>
            </div>
        </div>

@endsection
