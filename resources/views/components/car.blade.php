@props(['car'])

@php
    $statusStyles = [
        1 => ['class' => 'bg-success', 'text' => 'Działa bez problem'],
        2 => ['class' => 'bg-danger', 'text' => 'Nie działa'],
        3 => ['class' => 'bg-warning', 'text' => 'Jest w trakcie obsługi'],
        'default' => ['class' => 'bg-secondary', 'text' => 'Error'],
    ];
    $currentStatus = $statusStyles[$car->status] ?? $statusStyles['default'];
@endphp

<div class="card mb-4" style="max-width: 1000px;">
    <div class="card-body">
        <img src="{{ asset($car->image) }}" class="card-img-top mb-2" alt="{{ $car->name }}"
             style="object-fit: cover; height: 200px;">

        <h5 class="card-title">{{ $car->make }} - {{ $car->model }}</h5>

        <div class="car-status d-flex align-items-center mb-4">
            <span class="badge rounded-circle {{ $currentStatus['class'] }} me-2" style="width: 16px; height: 16px;">&nbsp;</span>
            <span>{{ $currentStatus['text'] }}</span>
        </div>


        <div class="d-grid gap-2">
            <a href="{{ route('cars.show', $car->id) }}" class="btn btn-outline-primary">Zobacz</a>
            <a href="{{ route('client.requests.create')}}" class="btn btn-outline-primary">Napraw</a>
            <form method="POST" action="{{ route('cars.destroy', $car->id) }}" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Confirm delete?')">
                    Usuń
                </button>
            </form>
        </div>
    </div>
</div>
