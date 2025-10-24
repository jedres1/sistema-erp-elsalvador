@extends('layouts.app')

@section('title', 'Detalle de Cuenta - ' . $account->description)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-eye me-2"></i>Detalle de Cuenta</h2>
    <a href="{{ route('ledger.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i>Volver al Libro Mayor
    </a>
</div>

<!-- Información de la cuenta -->
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Información de la Cuenta</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <strong>Código:</strong><br>
                <code class="fs-6">{{ str_replace('.', '', $account->code) }}</code>
            </div>
            <div class="col-md-6">
                <strong>Descripción:</strong><br>
                <span class="text-muted">{{ $account->description }}</span>
            </div>
            <div class="col-md-3">
                <strong>Tipo:</strong><br>
                @php
                    $typeColors = ['A' => 'primary', 'P' => 'warning', 'K' => 'success', 'I' => 'info', 'G' => 'danger'];
                    $typeNames = ['A' => 'Activo', 'P' => 'Pasivo', 'K' => 'Capital', 'I' => 'Ingreso', 'G' => 'Gasto'];
                @endphp
                <span class="badge bg-{{ $typeColors[$account->type_account] ?? 'secondary' }}">
                    {{ $typeNames[$account->type_account] ?? $account->type_account }}
                </span>
            </div>
        </div>
    </div>
</div>

<!-- Resumen de saldos -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body text-center">
                <h6>Total Débitos</h6>
                <h4>${{ number_format($totalDebits, 2) }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-info text-white">
            <div class="card-body text-center">
                <h6>Total Créditos</h6>
                <h4>${{ number_format($totalCredits, 2) }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card {{ $currentBalance >= 0 ? 'bg-primary' : 'bg-danger' }} text-white">
            <div class="card-body text-center">
                <h6>Saldo Actual</h6>
                <h4>
                    @if($currentBalance >= 0)
                        ${{ number_format($currentBalance, 2) }}
                    @else
                        (${{ number_format(abs($currentBalance), 2) }})
                    @endif
                </h4>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-secondary text-white">
            <div class="card-body text-center">
                <h6>Total Movimientos</h6>
                <h4>{{ $movements->count() }}</h4>
            </div>
        </div>
    </div>
</div>

<!-- Movimientos de la cuenta -->
<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-list me-2"></i>Movimientos Mayorizados</h5>
    </div>
    <div class="card-body">
        @if($movements->count() > 0)
        <div class="table-responsive">
            <table class="table table-sm table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Fecha</th>
                        <th>Descripción de la Partida</th>
                        <th>Partida #</th>
                        <th class="text-end">Débito</th>
                        <th class="text-end">Crédito</th>
                        <th class="text-end">Saldo Acumulado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($movements as $movement)
                    <tr>
                        <td>{{ $movement->dailyRegister->date_register->format('d/m/Y') }}</td>
                        <td>{{ Str::limit($movement->dailyRegister->description, 50) }}</td>
                        <td class="text-center">
                            <span class="badge bg-secondary">#{{ $movement->dailyRegister->id }}</span>
                        </td>
                        <td class="text-end">
                            @if($movement->debit_amount > 0)
                                <span class="text-success fw-bold">${{ number_format($movement->debit_amount, 2) }}</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td class="text-end">
                            @if($movement->credit_amount > 0)
                                <span class="text-info fw-bold">${{ number_format($movement->credit_amount, 2) }}</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td class="text-end">
                            @if($movement->running_balance >= 0)
                                <span class="text-success fw-bold">${{ number_format($movement->running_balance, 2) }}</span>
                            @else
                                <span class="text-danger fw-bold">(${{ number_format(abs($movement->running_balance), 2) }})</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('entries.show', $movement->dailyRegister->id) }}" 
                               class="btn btn-xs btn-outline-info"
                               title="Ver partida completa">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="table-info">
                        <th colspan="3" class="text-end">TOTALES:</th>
                        <th class="text-end">${{ number_format($totalDebits, 2) }}</th>
                        <th class="text-end">${{ number_format($totalCredits, 2) }}</th>
                        <th class="text-end">
                            @if($currentBalance >= 0)
                                <span class="text-success fw-bold">${{ number_format($currentBalance, 2) }}</span>
                            @else
                                <span class="text-danger fw-bold">(${{ number_format(abs($currentBalance), 2) }})</span>
                            @endif
                        </th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        @else
        <div class="text-center py-5">
            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
            <h5 class="text-muted">No hay movimientos mayorizados para esta cuenta</h5>
            <p class="text-muted">Los movimientos aparecerán aquí cuando las partidas que afecten esta cuenta sean mayorizadas.</p>
        </div>
        @endif
    </div>
</div>

<!-- Gráfico de evolución del saldo (opcional) -->
@if($movements->count() > 1)
<div class="card mt-4">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-chart-line me-2"></i>Evolución del Saldo</h5>
    </div>
    <div class="card-body">
        <canvas id="balanceChart" width="400" height="200"></canvas>
    </div>
</div>
@endif

<div class="mt-4">
    <div class="d-flex justify-content-between">
        <a href="{{ route('ledger.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i>Volver al Libro Mayor
        </a>
        <div>
            <button type="button" class="btn btn-outline-primary" onclick="window.print()">
                <i class="fas fa-print me-1"></i>Imprimir Mayor
            </button>
            <button type="button" class="btn btn-outline-success">
                <i class="fas fa-file-excel me-1"></i>Exportar Excel
            </button>
        </div>
    </div>
</div>

@endsection

@section('scripts')
@if($movements->count() > 1)
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Datos para el gráfico de evolución del saldo
const ctx = document.getElementById('balanceChart').getContext('2d');
const movementData = @json($movements->values());

const chart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: movementData.map(movement => new Date(movement.daily_register.date_register).toLocaleDateString()),
        datasets: [{
            label: 'Saldo Acumulado',
            data: movementData.map(movement => movement.running_balance),
            borderColor: 'rgb(75, 192, 192)',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            tension: 0.1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: 'Evolución del Saldo de la Cuenta'
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return '$' + value.toLocaleString();
                    }
                }
            }
        }
    }
});
</script>
@endif

<style>
@media print {
    .btn, .card-header {
        display: none !important;
    }
    
    .card {
        border: none !important;
        box-shadow: none !important;
    }
}
</style>
@endsection