@props(['car'])

<div class="card mb-4" style="max-width: 1000px;">
    <div class="card-body">
        <img src="{{ asset($car->image) }}" class="card-img-top mb-2" alt="{{ $car->name }}"
             style="object-fit: cover; height: 200px;">

        <h5 class="card-title">{{ $car->make }} - {{ $car->model }}</h5>
        <p class="card-text">{{ $car->status }}</p>

        <div class="d-grid gap-2">
            <a href="{{ route('cars.show', $car->id) }}" class="btn btn-outline-primary">Look</a>
            <a href="{{ route('cars.show', $car->id) }}" class="btn btn-outline-primary">Fix</a>
            <form method="POST" action="{{ route('cars.destroy', $car->id) }}" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Confirm delete?')">
                    Delete
                </button>
            </form>
        </div>
    </div>
</div>
