@props(['service_request'])

<div class="card mb-4" style="max-width: 1000px;">
    <div class="card-body">
        <div class="card-img-top mb-2">
            @if(count($service_request->attachments) > 0)
                <div id="carouselExampleCaptions{{ $service_request->id }}" class="carousel slide" data-bs-ride="carousel">
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
                                <img src="{{ asset($image) }}" class="d-block w-100" alt="Image {{ $index + 1 }}" style="object-fit: cover; height: 200px;">
                            </div>
                        @endforeach
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions{{ $service_request->id }}"
                            data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    </button>

                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions{{ $service_request->id }}"
                            data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    </button>
                </div>
            @endif
        </div>


        <h5 class="card-title">{{ $service_request->car->make }} - {{ $service_request->location }}</h5>

        <div class="d-grid gap-2">
            <a href="{{ route('client.requests.show', $service_request) }}" class="btn btn-outline-primary">Zobacz</a>
            <form method="POST" action="{{route('client.requests.destroy', $service_request->id)}}" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Confirm delete?')">
                    Usuń
                </button>
            </form>
        </div>
    </div>
</div>
