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
    <div class="row">
        <!-- ACTIVOS -->
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-arrow-up"></i> ACTIVOS
                    </h5>
                </div>
                <div class="card-body p-0">
                    <table class="table table-sm mb-0">
                        <tbody>
                            <!-- ACTIVO CIRCULANTE -->
                            <tr class="table-secondary">
                                <td colspan="2" class="fw-bold">ACTIVO CIRCULANTE</td>
                            </tr>
                            <tr>
                                <td class="ps-4">Caja</td>
                                <td class="text-end">$5,000.00</td>
                            </tr>
                            <tr>
                                <td class="ps-4">Bancos</td>
                                <td class="text-end">$25,000.00</td>
                            </tr>
                            <tr>
                                <td class="ps-4">Clientes</td>
                                <td class="text-end">$15,000.00</td>
                            </tr>
                            <tr>
                                <td class="ps-4">Inventarios</td>
                                <td class="text-end">$30,000.00</td>
                            </tr>
                            <tr class="table-light fw-bold">
                                <td class="ps-4">SUMA ACTIVO CIRCULANTE</td>
                                <td class="text-end">$75,000.00</td>
                            </tr>
                            
                            <!-- ACTIVO NO CIRCULANTE -->
                            <tr class="table-secondary">
                                <td colspan="2" class="fw-bold">ACTIVO NO CIRCULANTE</td>
                            </tr>
                            <tr>
                                <td class="ps-4">Terrenos</td>
                                <td class="text-end">$100,000.00</td>
                            </tr>
                            <tr>
                                <td class="ps-4">Edificios</td>
                                <td class="text-end">$200,000.00</td>
                            </tr>
                            <tr>
                                <td class="ps-4">Maquinaria y Equipo</td>
                                <td class="text-end">$150,000.00</td>
                            </tr>
                            <tr>
                                <td class="ps-4">Depreciación Acumulada</td>
                                <td class="text-end">($50,000.00)</td>
                            </tr>
                            <tr class="table-light fw-bold">
                                <td class="ps-4">SUMA ACTIVO NO CIRCULANTE</td>
                                <td class="text-end">$400,000.00</td>
                            </tr>
                            
                            <!-- TOTAL ACTIVOS -->
                            <tr class="table-success">
                                <td class="fw-bold">TOTAL ACTIVOS</td>
                                <td class="text-end fw-bold">$475,000.00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- PASIVOS Y CAPITAL -->
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-arrow-down"></i> PASIVOS Y CAPITAL
                    </h5>
                </div>
                <div class="card-body p-0">
                    <table class="table table-sm mb-0">
                        <tbody>
                            <!-- PASIVO CIRCULANTE -->
                            <tr class="table-secondary">
                                <td colspan="2" class="fw-bold">PASIVO CIRCULANTE</td>
                            </tr>
                            <tr>
                                <td class="ps-4">Proveedores</td>
                                <td class="text-end">$15,000.00</td>
                            </tr>
                            <tr>
                                <td class="ps-4">Acreedores Diversos</td>
                                <td class="text-end">$8,000.00</td>
                            </tr>
                            <tr>
                                <td class="ps-4">Impuestos por Pagar</td>
                                <td class="text-end">$12,000.00</td>
                            </tr>
                            <tr class="table-light fw-bold">
                                <td class="ps-4">SUMA PASIVO CIRCULANTE</td>
                                <td class="text-end">$35,000.00</td>
                            </tr>
                            
                            <!-- PASIVO NO CIRCULANTE -->
                            <tr class="table-secondary">
                                <td colspan="2" class="fw-bold">PASIVO NO CIRCULANTE</td>
                            </tr>
                            <tr>
                                <td class="ps-4">Préstamos Bancarios</td>
                                <td class="text-end">$100,000.00</td>
                            </tr>
                            <tr>
                                <td class="ps-4">Hipotecas por Pagar</td>
                                <td class="text-end">$90,000.00</td>
                            </tr>
                            <tr class="table-light fw-bold">
                                <td class="ps-4">SUMA PASIVO NO CIRCULANTE</td>
                                <td class="text-end">$190,000.00</td>
                            </tr>
                            
                            <!-- TOTAL PASIVOS -->
                            <tr class="table-warning">
                                <td class="fw-bold">TOTAL PASIVOS</td>
                                <td class="text-end fw-bold">$225,000.00</td>
                            </tr>
                            
                            <!-- CAPITAL CONTABLE -->
                            <tr class="table-secondary">
                                <td colspan="2" class="fw-bold">CAPITAL CONTABLE</td>
                            </tr>
                            <tr>
                                <td class="ps-4">Capital Social</td>
                                <td class="text-end">$200,000.00</td>
                            </tr>
                            <tr>
                                <td class="ps-4">Utilidades Retenidas</td>
                                <td class="text-end">$30,000.00</td>
                            </tr>
                            <tr>
                                <td class="ps-4">Utilidad del Ejercicio</td>
                                <td class="text-end">$20,000.00</td>
                            </tr>
                            <tr class="table-light fw-bold">
                                <td class="ps-4">SUMA CAPITAL CONTABLE</td>
                                <td class="text-end">$250,000.00</td>
                            </tr>
                            
                            <!-- TOTAL PASIVOS Y CAPITAL -->
                            <tr class="table-success">
                                <td class="fw-bold">TOTAL PASIVOS Y CAPITAL</td>
                                <td class="text-end fw-bold">$475,000.00</td>
                            </tr>
                        </tbody>
                    </table>
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