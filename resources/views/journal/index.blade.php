@extends('layouts.app')

@section('title', 'Libro Diario')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4 text-primary">
        <i class="fas fa-book"></i> Libro Diario
    </h1>
    
    <!-- Controles superiores -->
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="d-flex gap-2">
                <button class="btn btn-success">
                    <i class="fas fa-file-export"></i> Exportar PDF
                </button>
                <button class="btn btn-info">
                    <i class="fas fa-file-excel"></i> Exportar Excel
                </button>
                <button class="btn btn-warning">
                    <i class="fas fa-print"></i> Imprimir
                </button>
            </div>
        </div>
        
        <!-- Filtros -->
        <div class="col-md-6">
            <div class="d-flex gap-2">
                <input type="date" class="form-control" id="dateFrom" title="Fecha desde">
                <input type="date" class="form-control" id="dateTo" title="Fecha hasta">
                <button class="btn btn-outline-primary" onclick="filterJournal()">
                    <i class="fas fa-filter"></i> Filtrar
                </button>
                <button class="btn btn-outline-secondary" onclick="clearFilters()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Resumen del período -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body text-center">
                    <h6>Total Movimientos</h6>
                    <h3>0</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body text-center">
                    <h6>Total Débitos</h6>
                    <h3>$0.00</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body text-center">
                    <h6>Total Créditos</h6>
                    <h3>$0.00</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body text-center">
                    <h6>Período</h6>
                    <h6 id="currentPeriod">Todo el tiempo</h6>
                </div>
            </div>
        </div>
    </div>

    <!-- Libro Diario -->
    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">
                <i class="fas fa-book"></i> Registro Cronológico de Operaciones
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-sm mb-0">
                    <thead class="table-secondary">
                        <tr>
                            <th width="80">Fecha</th>
                            <th width="100">No. Partida</th>
                            <th width="120">Código Cuenta</th>
                            <th>Descripción de la Cuenta</th>
                            <th>Concepto</th>
                            <th width="100" class="text-end">Debe</th>
                            <th width="100" class="text-end">Haber</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Ejemplo de estructura del libro diario -->
                        <tr class="table-light">
                            <td colspan="7" class="text-center py-5">
                                <i class="fas fa-book-open fa-4x text-muted mb-3"></i>
                                <h5 class="text-muted">No hay movimientos registrados</h5>
                                <p class="text-muted">Los movimientos aparecerán aquí una vez que se registren partidas contables.</p>
                                <a href="{{ route('entries.index') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Ir a Partidas
                                </a>
                            </td>
                        </tr>
                        
                        <!-- Ejemplo de como se vería con datos:
                        <tr>
                            <td>01/01/2024</td>
                            <td>PT-001</td>
                            <td>1000000000000</td>
                            <td>Caja</td>
                            <td>Apertura de ejercicio</td>
                            <td class="text-end">$10,000.00</td>
                            <td class="text-end">-</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>3000000000000</td>
                            <td>Capital Social</td>
                            <td>Apertura de ejercicio</td>
                            <td class="text-end">-</td>
                            <td class="text-end">$10,000.00</td>
                        </tr>
                        <tr class="border-bottom-3">
                            <td colspan="5" class="text-end fw-bold">TOTALES:</td>
                            <td class="text-end fw-bold">$10,000.00</td>
                            <td class="text-end fw-bold">$10,000.00</td>
                        </tr>
                        -->
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-light">
            <div class="row">
                <div class="col-md-6">
                    <small class="text-muted">
                        <i class="fas fa-info-circle"></i> 
                        El libro diario muestra todos los movimientos contables en orden cronológico
                    </small>
                </div>
                <div class="col-md-6 text-end">
                    <small class="text-muted">
                        Última actualización: <span id="lastUpdate">-</span>
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function filterJournal() {
    const dateFrom = document.getElementById('dateFrom').value;
    const dateTo = document.getElementById('dateTo').value;
    
    if (!dateFrom || !dateTo) {
        alert('Por favor selecciona ambas fechas para filtrar');
        return;
    }
    
    if (dateFrom > dateTo) {
        alert('La fecha inicial no puede ser mayor que la fecha final');
        return;
    }
    
    // Actualizar período mostrado
    document.getElementById('currentPeriod').textContent = `${dateFrom} a ${dateTo}`;
    
    // Aquí iría la lógica para filtrar los datos
    console.log('Filtrando libro diario:', { dateFrom, dateTo });
    alert('Funcionalidad en desarrollo: Filtrar libro diario');
}

function clearFilters() {
    document.getElementById('dateFrom').value = '';
    document.getElementById('dateTo').value = '';
    document.getElementById('currentPeriod').textContent = 'Todo el tiempo';
    
    // Aquí iría la lógica para limpiar filtros
    console.log('Limpiando filtros del libro diario');
}

// Establecer fecha de última actualización
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('lastUpdate').textContent = new Date().toLocaleString('es-ES');
});

// Funciones para exportar (placeholder)
function exportToPDF() {
    alert('Funcionalidad en desarrollo: Exportar a PDF');
}

function exportToExcel() {
    alert('Funcionalidad en desarrollo: Exportar a Excel');
}

function printJournal() {
    window.print();
}
</script>

<style>
@media print {
    .btn, .card-header, .card-footer {
        display: none !important;
    }
    
    .card {
        border: none !important;
        box-shadow: none !important;
    }
    
    .table {
        font-size: 12px;
    }
    
    @page {
        margin: 1cm;
        size: A4 landscape;
    }
}

.border-bottom-3 {
    border-bottom: 3px solid #dee2e6 !important;
}
</style>
@endsection