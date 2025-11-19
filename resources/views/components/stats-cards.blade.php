@props(['stats'])

<div class="row mb-4">
    @foreach ($stats as $stat)
        <div class="col-md-{{ $stat['size'] ?? '3' }} mb-3">
            <div class="card stats-card h-100">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="{{ $stat['icon'] }} fa-3x text-{{ $stat['color'] ?? 'primary' }}"></i>
                    </div>
                    <h3 class="stats-number mb-2">{{ $stat['value'] }}</h3>
                    <p class="text-muted mb-0 fw-medium">{{ $stat['label'] }}</p>
                    @if (isset($stat['change']))
                        <small class="text-{{ $stat['change'] >= 0 ? 'success' : 'danger' }} mt-2 d-block">
                            <i class="fas fa-{{ $stat['change'] >= 0 ? 'arrow-up' : 'arrow-down' }}"></i>
                            {{ abs($stat['change']) }}% vs mes anterior
                        </small>
                    @endif
                </div>
                @if (isset($stat['link']))
                    <div class="card-footer bg-transparent border-0 text-center">
                        <a href="{{ $stat['link'] }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-eye me-1"></i>
                            Ver detalles
                        </a>
                    </div>
                @endif
            </div>
        </div>
    @endforeach
</div>