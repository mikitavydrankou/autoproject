@props(['service_request'])


<html lang="en">
<head>
    <script>
        function setCarId(serviceRequestId) {
            document.getElementById('car_id_input').value = serviceRequestId;
        }
    </script>
    <title>fr</title>
</head>

<div class="card mb-4" style="max-width: 1000px;">
    <div class="card-body">
        <div class="card-img-top mb-2">
            @if(count($service_request->attachments) > 0)
                <div id="carouselExampleCaptions{{ $service_request->id }}" class="carousel slide"
                     data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        @foreach($service_request->attachments as $index => $image)
                            <button type="button" data-bs-target="#carouselExampleCaptions{{ $service_request->id }}"
                                    data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}"
                                    aria-label="Slide {{ $index + 1 }}"></button>
                        @endforeach
                    </div>

                    <div class="carousel-inner">
                        @foreach($service_request->attachments as $index => $image)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <img src="{{ asset($image) }}" class="d-block w-100" alt="Image {{ $index + 1 }}"
                                     style="object-fit: cover; height: 200px;">
                            </div>
                        @endforeach
                    </div>

                    <button class="carousel-control-prev" type="button"
                            data-bs-target="#carouselExampleCaptions{{ $service_request->id }}"
                            data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    </button>

                    <button class="carousel-control-next" type="button"
                            data-bs-target="#carouselExampleCaptions{{ $service_request->id }}"
                            data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    </button>


                </div>
            @endif
        </div>

        <div class="row">
            <div class="col">
                <h4 class="card-title">{{ $service_request->car->make }}  {{ $service_request->car->model }}
                    - {{ $service_request->car->year }}</h4>
                <h5 class="card-text">Lokacja: {{ $service_request->location }}</h5>
                <h6 class="card-text">Problem: "{{ $service_request->problem_description }}" </h6>
            </div>
            <div class="col text-end">
                <div class="col mb-2">
                    <button class="btn btn-primary"
                            onclick="selectServiceRequest({{ $service_request->id }}, '{{ $service_request->car->make }} - {{ $service_request->location }}')">
                        Выбрать
                    </button>
                </div>
                <div class="col mb-2">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Więcej
                    </button>
                </div>

                {{--Modal--}}
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                ...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
</html>
