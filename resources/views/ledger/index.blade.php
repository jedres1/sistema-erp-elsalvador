@extends('layouts.app')

@section('title', 'Libro Mayor')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-book-open me-2"></i>Libro Mayor</h2>
    <div class="d-flex gap-2">
        <a href="{{ route('ledger.balance') }}" class="btn btn-outline-info">
            <i class="fas fa-chart-bar me-1"></i>Balance General
        </a>
        <button class="btn btn-outline-primary">
            <i class="fas fa-file-pdf me-1"></i>Exportar
        </button>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-list me-2"></i>Cuentas con Movimientos Mayorizados</h5>
    </div>
    <div class="card-body">
        @if($accounts->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Código</th>
                        <th>Cuenta</th>
                        <th>Tipo</th>
                        <th class="text-end">Total Débitos</th>
                        <th class="text-end">Total Créditos</th>
                        <th class="text-end">Saldo Actual</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($accounts as $account)
                    <tr>
                        <td>
                            <code>{{ str_replace('.', '', $account->code) }}</code>
                        </td>
                        <td>{{ $account->description }}</td>
                        <td class="text-center">
                            @php
                                $typeColors = [
                                    'A' => 'primary', 'P' => 'warning', 'K' => 'success', 
                                    'I' => 'info', 'G' => 'danger'
                                ];
                                $typeNames = [
                                    'A' => 'Activo', 'P' => 'Pasivo', 'K' => 'Capital',
                                    'I' => 'Ingreso', 'G' => 'Gasto'
                                ];
                                $color = $typeColors[$account->type_account] ?? 'secondary';
                                $typeName = $typeNames[$account->type_account] ?? 'N/A';
                            @endphp
                            <span class="badge bg-{{ $color }}">{{ $typeName }}</span>
                        </td>
                        <td class="text-end">
                            <span class="text-success">
                                ${{ number_format($account->total_debits ?? 0, 2) }}
                            </span>
                        </td>
                        <td class="text-end">
                            <span class="text-danger">
                                ${{ number_format($account->total_credits ?? 0, 2) }}
                            </span>
                        </td>
                        <td class="text-end">
                            @php $balance = $account->current_balance ?? 0; @endphp
                            <strong class="text-{{ $balance >= 0 ? 'success' : 'danger' }}">
                                ${{ number_format($balance, 2) }}
                            </strong>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('ledger.account', $account->id) }}" 
                               class="btn btn-sm btn-outline-primary" 
                               title="Ver movimientos">
                                <i class="fas fa-eye"></i> Ver Detalle
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="d-flex justify-content-center mt-3">
            {{ $accounts->links() }}
        </div>
        @else
        <div class="text-center py-5">
            <i class="fas fa-book-open fa-3x text-muted mb-3"></i>
            <h5 class="text-muted">No hay cuentas con movimientos mayorizados</h5>
            <p class="text-muted">Las cuentas aparecerán aquí después de mayorizar partidas del libro diario.</p>
            <a href="{{ route('journal.index') }}" class="btn btn-primary">
                <i class="fas fa-book me-1"></i>Ir al Libro Diario
            </a>
        </div>
        @endif
    </div>
</div>

<!-- Resumen por Tipo de Cuenta -->
@if($accounts->count() > 0)
<div class="row mt-4">
    @php
        $groupedAccounts = $accounts->groupBy('type_account');
        $summaryTypes = [
            'A' => ['name' => 'Activos', 'color' => 'primary', 'icon' => 'fas fa-building'],
            'P' => ['name' => 'Pasivos', 'color' => 'warning', 'icon' => 'fas fa-credit-card'],
            'K' => ['name' => 'Capital', 'color' => 'success', 'icon' => 'fas fa-coins'],
            'I' => ['name' => 'Ingresos', 'color' => 'info', 'icon' => 'fas fa-arrow-up'],
            'G' => ['name' => 'Gastos', 'color' => 'danger', 'icon' => 'fas fa-arrow-down']
        ];
    @endphp
    
    @foreach($summaryTypes as $typeCode => $info)
        @if(isset($groupedAccounts[$typeCode]))
            @php
                $typeAccounts = $groupedAccounts[$typeCode];
                $totalDebits = $typeAccounts->sum('total_debits');
                $totalCredits = $typeAccounts->sum('total_credits');
                $totalBalance = $totalDebits - $totalCredits;
            @endphp
            <div class="col-md-2 mb-3">
                <div class="card border-{{ $info['color'] }}">
                    <div class="card-body text-center">
                        <i class="{{ $info['icon'] }} fa-2x text-{{ $info['color'] }} mb-2"></i>
                        <h6 class="card-title">{{ $info['name'] }}</h6>
                        <p class="card-text">
                            <strong class="text-{{ $info['color'] }}">
                                ${{ number_format($totalBalance, 2) }}
                            </strong><br>
                            <small class="text-muted">{{ $typeAccounts->count() }} cuentas</small>
                        </p>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>
@endif

@endsection

@section('scripts')
<script>
// Script para mejorar la interacción con la tabla
document.addEventListener('DOMContentLoaded', function() {
    // Resaltar filas al pasar el mouse
    const tableRows = document.querySelectorAll('tbody tr');
    tableRows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.backgroundColor = '#f8f9fa';
        });
        row.addEventListener('mouseleave', function() {
            this.style.backgroundColor = '';
        });
    });
    
    // Tooltips para los badges de tipo
    const badges = document.querySelectorAll('.badge');
    badges.forEach(badge => {
        badge.setAttribute('data-bs-toggle', 'tooltip');
        badge.setAttribute('data-bs-placement', 'top');
    });
});
</script>
@endsection