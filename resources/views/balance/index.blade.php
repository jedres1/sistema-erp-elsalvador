@extends('layouts.app')

@section('title', 'Balance General')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4 text-primary">
        <i class="fas fa-balance-scale"></i> Balance General
    </h1>
    
    <!-- Controles superiores -->
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="d-flex gap-2">
                <button class="btn btn-success" onclick="exportToPDF()">
                    <i class="fas fa-file-pdf"></i> Exportar PDF
                </button>
                <button class="btn btn-info" onclick="exportToExcel()">
                    <i class="fas fa-file-excel"></i> Exportar Excel
                </button>
                <button class="btn btn-warning" onclick="printBalance()">
                    <i class="fas fa-print"></i> Imprimir
                </button>
            </div>
        </div>
        
        <!-- Selector de fecha -->
        <div class="col-md-6">
            <div class="d-flex gap-2 justify-content-end">
                <label class="col-form-label">Balance al:</label>
                <input type="date" class="form-control" id="balanceDate" onchange="updateBalance()">
                <button class="btn btn-outline-primary" onclick="updateBalance()">
                    <i class="fas fa-refresh"></i> Actualizar
                </button>
            </div>
        </div>
    </div>

    <!-- Encabezado del balance -->
    <div class="card shadow mb-4">
        <div class="card-body text-center bg-light">
            <h3 class="mb-1">EMPRESA EJEMPLO S.A. DE C.V.</h3>
            <h4 class="mb-1">BALANCE GENERAL</h4>
            <h5 class="mb-0 text-muted">Al <span id="balanceDateDisplay">31 de Diciembre de 2024</span></h5>
            <small class="text-muted">(Cifras en pesos mexicanos)</small>
        </div>
    </div>

    <!-- Balance General -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-balance-scale"></i> BALANCE GENERAL
                    </h4>
                    <small>Cuentas de agrupación 1, 2 y 3 (4 dígitos + 8 ceros)</small>
                </div>
                <div class="card-body">

    <!-- Balance General -->
    <div class="row">
        <!-- ACTIVOS -->
        <div class="col-12 mb-4">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-arrow-up"></i> {{ $typeNames['A'] }}
                    </h5>
                </div>
                <div class="card-body p-0">
                    <table class="table table-sm mb-0">
                        <tbody>
                            @forelse($groupedAccounts['A'] as $account)
                            <tr>
                                <td class="ps-4">
                                    <strong>{{ $account->clean_code }}</strong> - {{ $account->description }}
                                    @if($account->balance != 0)
                                        <small class="text-success ms-2"><i class="fas fa-check-circle"></i></small>
                                    @endif
                                </td>
                                <td class="text-end">
                                    @if($account->balance != 0)
                                        ${{ number_format($account->balance, 2) }}
                                    @else
                                        <span class="text-muted">$0.00</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="text-center py-3 text-muted">
                                    <i class="fas fa-info-circle"></i> No hay cuentas de activos en el catálogo
                                </td>
                            </tr>
                            @endforelse
                            @if($groupedAccounts['A']->count() > 0)
                            <tr class="table-success">
                                <td class="fw-bold">TOTAL {{ $typeNames['A'] }}</td>
                                <td class="text-end fw-bold">${{ number_format($totals['A'], 2) }}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- PASIVOS -->
        <div class="col-12 mb-4">
            <div class="card shadow">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">
                        <i class="fas fa-arrow-down"></i> {{ $typeNames['P'] }}
                    </h5>
                </div>
                <div class="card-body p-0">
                    <table class="table table-sm mb-0">
                        <tbody>
                            @forelse($groupedAccounts['P'] as $account)
                            <tr>
                                <td class="ps-4">
                                    <strong>{{ $account->clean_code }}</strong> - {{ $account->description }}
                                    @if($account->balance != 0)
                                        <small class="text-warning ms-2"><i class="fas fa-check-circle"></i></small>
                                    @endif
                                </td>
                                <td class="text-end">
                                    @if($account->balance != 0)
                                        ${{ number_format(abs($account->balance), 2) }}
                                    @else
                                        <span class="text-muted">$0.00</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="text-center py-3 text-muted">
                                    <i class="fas fa-info-circle"></i> No hay cuentas de pasivos en el catálogo
                                </td>
                            </tr>
                            @endforelse
                            @if($groupedAccounts['P']->count() > 0)
                            <tr class="table-warning">
                                <td class="fw-bold">TOTAL {{ $typeNames['P'] }}</td>
                                <td class="text-end fw-bold">${{ number_format(abs($totals['P']), 2) }}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- CAPITAL CONTABLE -->
        <div class="col-12 mb-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-university"></i> {{ $typeNames['K'] }} CONTABLE
                    </h5>
                </div>
                <div class="card-body p-0">
                    <table class="table table-sm mb-0">
                        <tbody>
                            @forelse($groupedAccounts['K'] as $account)
                            <tr>
                                <td class="ps-4">
                                    <strong>{{ $account->clean_code }}</strong> - {{ $account->description }}
                                    @if($account->balance != 0)
                                        <small class="text-primary ms-2"><i class="fas fa-check-circle"></i></small>
                                    @endif
                                </td>
                                <td class="text-end">
                                    @if($account->balance != 0)
                                        ${{ number_format(abs($account->balance), 2) }}
                                    @else
                                        <span class="text-muted">$0.00</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="text-center py-3 text-muted">
                                    <i class="fas fa-info-circle"></i> No hay cuentas de capital en el catálogo
                                </td>
                            </tr>
                            @endforelse
                            @if($groupedAccounts['K']->count() > 0)
                            <tr class="table-light">
                                <td class="fw-bold">TOTAL {{ $typeNames['K'] }}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Verificación de Ecuación Contable -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-equals"></i> VERIFICACIÓN DE LA ECUACIÓN CONTABLE
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-4">
                            <h6>Total Activos</h6>
                            <h4 class="text-success">${{ number_format($totals['A'] ?? 0, 2) }}</h4>
                        </div>
                        <div class="col-md-1 d-flex align-items-center justify-content-center">
                            <h3>=</h3>
                        </div>
                        <div class="col-md-3">
                            <h6>Total Pasivos</h6>
                            <h4 class="text-warning">${{ number_format(abs($totals['P'] ?? 0), 2) }}</h4>
                        </div>
                        <div class="col-md-1 d-flex align-items-center justify-content-center">
                            <h3>+</h3>
                        </div>
                        <div class="col-md-3">
                            <h6>Total Capital</h6>
                            <h4 class="text-primary">${{ number_format(abs($totals['K'] ?? 0), 2) }}</h4>
                        </div>
                    </div>
                    <hr>
                    <div class="row text-center">
                        <div class="col-12">
                            @php
                                $totalActivos = $totals['A'] ?? 0;
                                $totalPasivos = abs($totals['P'] ?? 0);
                                $totalCapital = abs($totals['K'] ?? 0);
                                $totalPasivosMasCapital = $totalPasivos + $totalCapital;
                                $diferencia = $totalActivos - $totalPasivosMasCapital;
                            @endphp
                            <h5>
                                Diferencia: 
                                <span class="badge bg-{{ abs($diferencia) < 0.01 ? 'success' : 'danger' }}">
                                    ${{ number_format($diferencia, 2) }}
                                </span>
                            </h5>
                            @if(abs($diferencia) < 0.01)
                                <small class="text-success">
                                    <i class="fas fa-check-circle"></i> Balance cuadrado correctamente
                                </small>
                            @else
                                <small class="text-danger">
                                    <i class="fas fa-exclamation-triangle"></i> El balance no está cuadrado
                                </small>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Resumen de Cuentas por Tipo -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-chart-pie"></i> RESUMEN DE CUENTAS
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <!-- Balance General -->
                        <div class="col-md-8">
                            <h6 class="text-primary mb-3">Balance General (4 dígitos + 8 ceros)</h6>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card border-success">
                                        <div class="card-body">
                                            <h6 class="text-success">ACTIVOS</h6>
                                            <h4 class="text-success">{{ $groupedAccounts['A']->count() }}</h4>
                                            <small class="text-muted">
                                                cuentas total
                                                @if($groupedAccounts['A']->where('balance', '!=', 0)->count() > 0)
                                                    <br><span class="text-success">{{ $groupedAccounts['A']->where('balance', '!=', 0)->count() }} con movimientos</span>
                                                @endif
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card border-warning">
                                        <div class="card-body">
                                            <h6 class="text-warning">PASIVOS</h6>
                                            <h4 class="text-warning">{{ $groupedAccounts['P']->count() }}</h4>
                                            <small class="text-muted">
                                                cuentas total
                                                @if($groupedAccounts['P']->where('balance', '!=', 0)->count() > 0)
                                                    <br><span class="text-warning">{{ $groupedAccounts['P']->where('balance', '!=', 0)->count() }} con movimientos</span>
                                                @endif
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card border-primary">
                                        <div class="card-body">
                                            <h6 class="text-primary">CAPITAL</h6>
                                            <h4 class="text-primary">{{ $groupedAccounts['K']->count() }}</h4>
                                            <small class="text-muted">
                                                cuentas total
                                                @if($groupedAccounts['K']->where('balance', '!=', 0)->count() > 0)
                                                    <br><span class="text-primary">{{ $groupedAccounts['K']->where('balance', '!=', 0)->count() }} con movimientos</span>
                                                @endif
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Indicadores financieros -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h6 class="mb-0">
                        <i class="fas fa-chart-line"></i> Indicadores Financieros Básicos
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="text-center">
                                <h6>Liquidez Corriente</h6>
                                <h4 class="text-success" id="currentRatio">2.14</h4>
                                <small class="text-muted">Activo Cir. / Pasivo Cir.</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center">
                                <h6>Endeudamiento</h6>
                                <h4 class="text-warning" id="debtRatio">47.37%</h4>
                                <small class="text-muted">Pasivos / Activos</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center">
                                <h6>Capital de Trabajo</h6>
                                <h4 class="text-info" id="workingCapital">$40,000</h4>
                                <small class="text-muted">Act. Cir. - Pas. Cir.</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center">
                                <h6>ROE</h6>
                                <h4 class="text-primary" id="roe">8.00%</h4>
                                <small class="text-muted">Utilidad / Capital</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Notas al balance -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-sticky-note"></i> Notas al Balance General
                    </h6>
                </div>
                <div class="card-body">
                    <ol>
                        <li><strong>Base de preparación:</strong> El presente balance general ha sido preparado de acuerdo con las Normas de Información Financiera (NIF) mexicanas.</li>
                        <li><strong>Moneda funcional:</strong> Las cifras están expresadas en pesos mexicanos.</li>
                        <li><strong>Inventarios:</strong> Valuados al costo promedio ponderado.</li>
                        <li><strong>Depreciación:</strong> Se calcula utilizando el método de línea recta.</li>
                        <li><strong>Fecha de cierre:</strong> <span id="closingDate">31 de Diciembre de 2024</span></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function updateBalance() {
    const balanceDate = document.getElementById('balanceDate').value;
    
    if (balanceDate) {
        // Convertir fecha a formato legible
        const date = new Date(balanceDate);
        const options = { 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric' 
        };
        const formattedDate = date.toLocaleDateString('es-ES', options);
        
        document.getElementById('balanceDateDisplay').textContent = formattedDate;
        document.getElementById('closingDate').textContent = formattedDate;
        
        // Aquí iría la lógica para obtener los datos del balance en la fecha seleccionada
        console.log('Actualizando balance para la fecha:', balanceDate);
        
        // Simular actualización de datos
        setTimeout(() => {
            calculateFinancialRatios();
        }, 500);
    }
}

function calculateFinancialRatios() {
    // Datos simulados del balance
    const activoCirculante = 75000;
    const pasivoCirculante = 35000;
    const totalActivos = 475000;
    const totalPasivos = 225000;
    const capitalContable = 250000;
    const utilidadEjercicio = 20000;
    
    // Cálculo de indicadores
    const liquidezCorriente = activoCirculante / pasivoCirculante;
    const endeudamiento = (totalPasivos / totalActivos) * 100;
    const capitalTrabajo = activoCirculante - pasivoCirculante;
    const roe = (utilidadEjercicio / capitalContable) * 100;
    
    // Actualizar en la interfaz
    document.getElementById('currentRatio').textContent = liquidezCorriente.toFixed(2);
    document.getElementById('debtRatio').textContent = endeudamiento.toFixed(2) + '%';
    document.getElementById('workingCapital').textContent = '$' + capitalTrabajo.toLocaleString();
    document.getElementById('roe').textContent = roe.toFixed(2) + '%';
}

function exportToPDF() {
    alert('Funcionalidad en desarrollo: Exportar balance a PDF');
}

function exportToExcel() {
    alert('Funcionalidad en desarrollo: Exportar balance a Excel');
}

function printBalance() {
    window.print();
}

// Inicializar con fecha actual
document.addEventListener('DOMContentLoaded', function() {
    const today = new Date();
    const formattedDate = today.toISOString().split('T')[0];
    document.getElementById('balanceDate').value = formattedDate;
    
    updateBalance();
});
</script>

<style>
@media print {
    .btn, .card-header {
        display: none !important;
    }
    
    .card {
        border: none !important;
        box-shadow: none !important;
        page-break-inside: avoid;
    }
    
    .row.mt-4 {
        page-break-before: always;
    }
    
    @page {
        margin: 1.5cm;
        size: A4 portrait;
    }
    
    body {
        font-size: 12px;
    }
    
    h1, h2, h3 {
        font-size: 16px;
    }
    
    .table {
        font-size: 11px;
    }
}

.table td {
    border-bottom: 1px solid #dee2e6;
    padding: 0.5rem;
}

.table-success {
    background-color: #d1e7dd !important;
}

.table-warning {
    background-color: #fff3cd !important;
}
</style>
@endsection