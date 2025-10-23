@extends('layouts.app')

@section('title', 'Partidas')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4 text-primary">
        <i class="fas fa-file-invoice"></i> Partidas Contables
    </h1>
    
    <!-- Controles superiores -->
    <div class="row mb-3">
        <div class="col-md-6">
            <button class="btn btn-success" onclick="showNewEntryModal()">
                <i class="fas fa-plus"></i> Nueva Partida
            </button>
            <button class="btn btn-info">
                <i class="fas fa-file-export"></i> Exportar
            </button>
        </div>
        
        <!-- Filtros y búsqueda -->
        <div class="col-md-6">
            <div class="d-flex gap-2">
                <input type="date" class="form-control" id="dateFilter" placeholder="Filtrar por fecha">
                <input type="text" class="form-control" placeholder="Buscar partida..." id="searchEntry">
                <button class="btn btn-outline-primary" onclick="filterEntries()">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Tarjetas de resumen -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title">Total Partidas</h6>
                            <h3>0</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-file-invoice fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title">Total Débitos</h6>
                            <h3>$0.00</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-plus fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title">Total Créditos</h6>
                            <h3>$0.00</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-minus fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title">Balance</h6>
                            <h3>$0.00</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-balance-scale fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de partidas -->
    <div class="card shadow">
        <div class="card-header bg-light">
            <h5 class="mb-0">
                <i class="fas fa-list"></i> Lista de Partidas
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Fecha</th>
                            <th>No. Partida</th>
                            <th>Descripción</th>
                            <th>Referencia</th>
                            <th>Débito</th>
                            <th>Crédito</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <i class="fas fa-file-invoice fa-4x text-muted mb-3"></i>
                                <h5 class="text-muted">No hay partidas registradas</h5>
                                <p class="text-muted">Comienza creando tu primera partida contable.</p>
                                <button class="btn btn-primary btn-lg" onclick="showNewEntryModal()">
                                    <i class="fas fa-plus"></i> Crear Primera Partida
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal para nueva partida -->
<div class="modal fade" id="newEntryModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-plus-circle"></i> Nueva Partida Contable
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="entryForm">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Fecha</label>
                            <input type="date" class="form-control" id="entryDate" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">No. Partida</label>
                            <input type="text" class="form-control" id="entryNumber" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Referencia</label>
                            <input type="text" class="form-control" id="entryReference">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea class="form-control" id="entryDescription" rows="2" required></textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-12">
                            <h6>Detalle de la Partida</h6>
                            <div class="table-responsive">
                                <table class="table table-sm" id="entryDetailsTable">
                                    <thead>
                                        <tr>
                                            <th>Cuenta</th>
                                            <th>Descripción</th>
                                            <th>Débito</th>
                                            <th>Crédito</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Los detalles se agregan dinámicamente -->
                                    </tbody>
                                </table>
                            </div>
                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="addEntryDetail()">
                                <i class="fas fa-plus"></i> Agregar Línea
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="saveEntry()">
                    <i class="fas fa-save"></i> Guardar Partida
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function showNewEntryModal() {
    // Configurar fecha actual
    document.getElementById('entryDate').value = new Date().toISOString().split('T')[0];
    
    // Generar número de partida automático
    document.getElementById('entryNumber').value = 'PT-' + Date.now();
    
    // Mostrar modal
    new bootstrap.Modal(document.getElementById('newEntryModal')).show();
}

function addEntryDetail() {
    const tbody = document.querySelector('#entryDetailsTable tbody');
    const row = document.createElement('tr');
    row.innerHTML = `
        <td>
            <select class="form-control form-control-sm" required>
                <option value="">Seleccionar cuenta...</option>
                <!-- Las cuentas se cargarían dinámicamente desde el backend -->
            </select>
        </td>
        <td>
            <input type="text" class="form-control form-control-sm" placeholder="Descripción">
        </td>
        <td>
            <input type="number" class="form-control form-control-sm" placeholder="0.00" step="0.01" min="0">
        </td>
        <td>
            <input type="number" class="form-control form-control-sm" placeholder="0.00" step="0.01" min="0">
        </td>
        <td>
            <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeEntryDetail(this)">
                <i class="fas fa-trash"></i>
            </button>
        </td>
    `;
    tbody.appendChild(row);
}

function removeEntryDetail(button) {
    button.closest('tr').remove();
}

function saveEntry() {
    // Aquí iría la lógica para guardar la partida
    alert('Funcionalidad en desarrollo: Guardar partida');
}

function filterEntries() {
    // Aquí iría la lógica para filtrar partidas
    alert('Funcionalidad en desarrollo: Filtrar partidas');
}

// Agregar una línea inicial al abrir el modal
document.getElementById('newEntryModal').addEventListener('shown.bs.modal', function () {
    if (document.querySelector('#entryDetailsTable tbody').children.length === 0) {
        addEntryDetail();
        addEntryDetail(); // Agregar al menos 2 líneas iniciales
    }
});
</script>
@endsection