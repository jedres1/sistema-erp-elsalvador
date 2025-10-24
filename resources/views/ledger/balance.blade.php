@extends('layouts.app')

@section('title', 'Balance General')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-chart-bar me-2"></i>Balance General</h2>
    <a href="{{ route('ledger.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i>Volver al Libro Mayor
    </a>
</div>

<div class="row">
    @foreach($summary as $typeCode => $typeData)
    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-header bg-{{ $typeCode === 'A' ? 'primary' : ($typeCode === 'P' ? 'warning' : ($typeCode === 'K' ? 'success' : ($typeCode === 'I' ? 'info' : 'danger'))) }} text-white">
                <h5 class="mb-0">
                    @switch($typeCode)
                        @case('A')
                            <i class="fas fa-wallet me-2"></i>{{ $typeData['name'] }}
                            @break
                        @case('P')
                            <i class="fas fa-credit-card me-2"></i>{{ $typeData['name'] }}
                            @break
                        @case('K')
                            <i class="fas fa-coins me-2"></i>{{ $typeData['name'] }}
                            @break
                        @case('I')
                            <i class="fas fa-arrow-up me-2"></i>{{ $typeData['name'] }}
                            @break
                        @case('G')
                            <i class="fas fa-arrow-down me-2"></i>{{ $typeData['name'] }}
                            @break
                    @endswitch
                </h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-4">
                        <h6 class="text-muted">Débitos</h6>
                        <h5 class="text-success">${{ number_format($typeData['debits'], 2) }}</h5>
                    </div>
                    <div class="col-4">
                        <h6 class="text-muted">Créditos</h6>
                        <h5 class="text-info">${{ number_format($typeData['credits'], 2) }}</h5>
                    </div>
                    <div class="col-4">
                        <h6 class="text-muted">Saldo</h6>
                        <h5 class="{{ $typeData['balance'] >= 0 ? 'text-primary' : 'text-danger' }}">
                            @if($typeData['balance'] >= 0)
                                ${{ number_format($typeData['balance'], 2) }}
                            @else
                                (${{ number_format(abs($typeData['balance']), 2) }})
                            @endif
                        </h5>
                    </div>
                </div>
                <hr>
                <div class="text-center">
                    <span class="badge bg-secondary">{{ $typeData['accounts_count'] }} cuentas</span>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@if(count($summary) > 0)
<!-- Resumen financiero -->
<div class="card mt-4">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-calculator me-2"></i>Resumen Financiero</h5>
    </div>
    <div class="card-body">
        <div class="row">
            @php
                $totalActivos = $summary['A']['balance'] ?? 0;
                $totalPasivos = $summary['P']['balance'] ?? 0;
                $totalCapital = $summary['K']['balance'] ?? 0;
                $totalIngresos = $summary['I']['balance'] ?? 0;
                $totalGastos = $summary['G']['balance'] ?? 0;
                
                $ecuacionContable = $totalActivos - ($totalPasivos + $totalCapital);
                $resultadoEjercicio = $totalIngresos - $totalGastos;
            @endphp
            
            <div class="col-md-6">
                <h6>Ecuación Contable Básica</h6>
                <div class="alert alert-{{ abs($ecuacionContable) < 0.01 ? 'success' : 'warning' }}">
                    <strong>Activos = Pasivos + Capital</strong><br>
                    ${{ number_format($totalActivos, 2) }} = ${{ number_format($totalPasivos, 2) }} + ${{ number_format($totalCapital, 2) }}<br>
                    <small>Diferencia: ${{ number_format($ecuacionContable, 2) }}</small>
                    @if(abs($ecuacionContable) < 0.01)
                        <i class="fas fa-check-circle text-success ms-2"></i>
                    @else
                        <i class="fas fa-exclamation-triangle text-warning ms-2"></i>
                    @endif
                </div>
            </div>
            
            <div class="col-md-6">
                <h6>Estado de Resultados</h6>
                <div class="alert alert-{{ $resultadoEjercicio >= 0 ? 'success' : 'danger' }}">
                    <strong>Resultado del Ejercicio</strong><br>
                    Ingresos: ${{ number_format($totalIngresos, 2) }}<br>
                    Gastos: ${{ number_format($totalGastos, 2) }}<br>
                    <hr class="my-2">
                    <strong>
                        @if($resultadoEjercicio >= 0)
                            Utilidad: ${{ number_format($resultadoEjercicio, 2) }}
                            <i class="fas fa-arrow-up text-success ms-2"></i>
                        @else
                            Pérdida: ${{ number_format(abs($resultadoEjercicio), 2) }}
                            <i class="fas fa-arrow-down text-danger ms-2"></i>
                        @endif
                    </strong>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Gráfico de composición -->
<div class="card mt-4">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-chart-pie me-2"></i>Composición por Tipo de Cuenta</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <canvas id="balanceChart"></canvas>
            </div>
            <div class="col-md-6">
                <canvas id="resultChart"></canvas>
            </div>
        </div>
    </div>
</div>
@else
<div class="text-center py-5">
    <i class="fas fa-chart-bar fa-3x text-muted mb-3"></i>
    <h5 class="text-muted">No hay datos suficientes para generar el balance</h5>
    <p class="text-muted">Necesita tener partidas mayorizadas para ver el balance general.</p>
</div>
@endif

<div class="mt-4">
    <div class="d-flex justify-content-between">
        <a href="{{ route('ledger.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i>Volver
        </a>
        <div>
            <button type="button" class="btn btn-outline-primary" onclick="window.print()">
                <i class="fas fa-print me-1"></i>Imprimir Balance
            </button>
            <button type="button" class="btn btn-outline-success">
                <i class="fas fa-file-excel me-1"></i>Exportar Excel
            </button>
        </div>
    </div>
</div>

@endsection

@section('scripts')
@if(count($summary) > 0)
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Gráfico de Balance (Activos, Pasivos, Capital)
const balanceCtx = document.getElementById('balanceChart').getContext('2d');
const balanceChart = new Chart(balanceCtx, {
    type: 'doughnut',
    data: {
        labels: ['Activos', 'Pasivos', 'Capital'],
        datasets: [{
            data: [
                {{ $summary['A']['balance'] ?? 0 }},
                {{ $summary['P']['balance'] ?? 0 }},
                {{ $summary['K']['balance'] ?? 0 }}
            ],
            backgroundColor: [
                'rgba(54, 162, 235, 0.8)',
                'rgba(255, 193, 7, 0.8)',
                'rgba(40, 167, 69, 0.8)'
            ]
        }]
    },
    options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: 'Balance General'
            }
        }
    }
});

// Gráfico de Resultados (Ingresos vs Gastos)
const resultCtx = document.getElementById('resultChart').getContext('2d');
const resultChart = new Chart(resultCtx, {
    type: 'doughnut',
    data: {
        labels: ['Ingresos', 'Gastos'],
        datasets: [{
            data: [
                {{ $summary['I']['balance'] ?? 0 }},
                {{ $summary['G']['balance'] ?? 0 }}
            ],
            backgroundColor: [
                'rgba(23, 162, 184, 0.8)',
                'rgba(220, 53, 69, 0.8)'
            ]
        }]
    },
    options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: 'Estado de Resultados'
            }
        }
    }
});
</script>
@endif
@endsection