@extends('layouts.app')

@section('title', 'Parámetros Contables')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h3 mb-0">
                    <i class="fas fa-cogs text-primary"></i>
                    Parámetros Contables
                </h2>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTemplateModal">
                    <i class="fas fa-plus"></i>
                    Nueva Plantilla
                </button>
            </div>
        </div>
    </div>

    <!-- Alertas -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Filtros -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">
                        <i class="fas fa-filter"></i>
                        Filtros
                    </h6>
                    <div class="row">
                        <div class="col-md-6">
                            <select class="form-select" id="tipoFilter">
                                <option value="">Todos los tipos</option>
                                <option value="venta">Ventas</option>
                                <option value="compra">Compras</option>
                                <option value="nomina">Nómina</option>
                                <option value="gasto">Gastos</option>
                                <option value="otro">Otros</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select class="form-select" id="estadoFilter">
                                <option value="">Todos los estados</option>
                                <option value="activa">Activas</option>
                                <option value="inactiva">Inactivas</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">
                        <i class="fas fa-chart-pie"></i>
                        Resumen
                    </h6>
                    <div class="row text-center">
                        <div class="col-3">
                            <h5 class="text-primary">{{ count($plantillas) }}</h5>
                            <small>Total</small>
                        </div>
                        <div class="col-3">
                            <h5 class="text-success">{{ count(array_filter($plantillas, fn($p) => $p['activa'])) }}</h5>
                            <small>Activas</small>
                        </div>
                        <div class="col-3">
                            <h5 class="text-info">{{ count(array_filter($plantillas, fn($p) => $p['tipo'] === 'venta')) }}</h5>
                            <small>Ventas</small>
                        </div>
                        <div class="col-3">
                            <h5 class="text-warning">{{ count(array_filter($plantillas, fn($p) => $p['tipo'] === 'compra')) }}</h5>
                            <small>Compras</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Lista de Plantillas -->
    <div class="row">
        @foreach($plantillas as $plantilla)
        <div class="col-lg-6 mb-4">
            <div class="card h-100 {{ $plantilla['activa'] ? '' : 'border-secondary' }}">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0">
                            <i class="fas fa-{{ $plantilla['tipo'] === 'venta' ? 'shopping-cart' : ($plantilla['tipo'] === 'compra' ? 'truck' : ($plantilla['tipo'] === 'nomina' ? 'users' : 'cog')) }}"></i>
                            {{ $plantilla['nombre'] }}
                        </h6>
                        <small class="text-muted">
                            <span class="badge bg-{{ $plantilla['tipo'] === 'venta' ? 'success' : ($plantilla['tipo'] === 'compra' ? 'warning' : ($plantilla['tipo'] === 'nomina' ? 'info' : 'secondary')) }}">
                                {{ ucfirst($plantilla['tipo']) }}
                            </span>
                        </small>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#" onclick="viewTemplate({{ $plantilla['id'] }})">
                                <i class="fas fa-eye"></i> Ver Detalle
                            </a></li>
                            <li><a class="dropdown-item" href="#" onclick="editTemplate({{ $plantilla['id'] }})">
                                <i class="fas fa-edit"></i> Editar
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#" onclick="toggleTemplate({{ $plantilla['id'] }})">
                                <i class="fas fa-{{ $plantilla['activa'] ? 'ban' : 'check' }}"></i> 
                                {{ $plantilla['activa'] ? 'Desactivar' : 'Activar' }}
                            </a></li>
                            <li><a class="dropdown-item text-danger" href="#" onclick="deleteTemplate({{ $plantilla['id'] }})">
                                <i class="fas fa-trash"></i> Eliminar
                            </a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <p class="card-text">{{ $plantilla['descripcion'] }}</p>
                    
                    <!-- Vista previa de las cuentas -->
                    <div class="mb-3">
                        <h6 class="text-muted mb-2">Estructura de la Plantilla:</h6>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Tipo</th>
                                        <th>Concepto</th>
                                        <th>Fórmula</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($plantilla['cuentas'] as $cuenta)
                                    <tr>
                                        <td>
                                            <span class="badge bg-{{ $cuenta['tipo'] === 'debito' ? 'primary' : 'success' }}">
                                                {{ $cuenta['tipo'] === 'debito' ? 'Debe' : 'Haber' }}
                                            </span>
                                        </td>
                                        <td>{{ $cuenta['concepto'] }}</td>
                                        <td><code>{{ $cuenta['formula'] }}</code></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted d-flex justify-content-between align-items-center">
                    <small>
                        <i class="fas fa-cog"></i>
                        Tipo: {{ ucfirst($plantilla['tipo']) }}
                    </small>
                    <span class="badge bg-{{ $plantilla['activa'] ? 'success' : 'secondary' }}">
                        {{ $plantilla['activa'] ? 'Activa' : 'Inactiva' }}
                    </span>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if(count($plantillas) === 0)
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center py-5">
                    <i class="fas fa-cogs fa-3x text-muted mb-3"></i>
                    <h5>No hay plantillas configuradas</h5>
                    <p class="text-muted">Comienza creando tu primera plantilla de transacción</p>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTemplateModal">
                        <i class="fas fa-plus"></i>
                        Crear Primera Plantilla
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<!-- Modal para crear/editar plantilla -->
<div class="modal fade" id="createTemplateModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-plus"></i>
                    Nueva Plantilla de Transacción
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="templateForm">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nombre de la Plantilla</label>
                                <input type="text" class="form-control" name="nombre" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Tipo</label>
                                <select class="form-select" name="tipo" required>
                                    <option value="">Seleccionar tipo</option>
                                    <option value="venta">Venta</option>
                                    <option value="compra">Compra</option>
                                    <option value="nomina">Nómina</option>
                                    <option value="gasto">Gasto</option>
                                    <option value="otro">Otro</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea class="form-control" name="descripcion" rows="2" required></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Estructura de Cuentas</label>
                        <div id="cuentasContainer">
                            <!-- Se llenará dinámicamente -->
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="addCuentaRow()">
                            <i class="fas fa-plus"></i> Agregar Cuenta
                        </button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Guardar Plantilla
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
let cuentaIndex = 0;

function addCuentaRow() {
    const container = document.getElementById('cuentasContainer');
    const row = document.createElement('div');
    row.className = 'row mb-2 cuenta-row';
    row.innerHTML = `
        <div class="col-md-3">
            <select class="form-select" name="cuentas[${cuentaIndex}][tipo]" required>
                <option value="debito">Debe</option>
                <option value="credito">Haber</option>
            </select>
        </div>
        <div class="col-md-4">
            <input type="text" class="form-control" name="cuentas[${cuentaIndex}][concepto]" placeholder="Concepto" required>
        </div>
        <div class="col-md-4">
            <input type="text" class="form-control" name="cuentas[${cuentaIndex}][formula]" placeholder="Fórmula (ej: subtotal + iva)" required>
        </div>
        <div class="col-md-1">
            <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeCuentaRow(this)">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    `;
    container.appendChild(row);
    cuentaIndex++;
}

function removeCuentaRow(button) {
    button.closest('.cuenta-row').remove();
}

function viewTemplate(id) {
    // Implementar vista detallada
    alert('Ver detalle de plantilla ' + id);
}

function editTemplate(id) {
    // Implementar edición
    alert('Editar plantilla ' + id);
}

function toggleTemplate(id) {
    // Implementar cambio de estado
    if(confirm('¿Está seguro de cambiar el estado de esta plantilla?')) {
        alert('Cambiar estado de plantilla ' + id);
    }
}

function deleteTemplate(id) {
    if(confirm('¿Está seguro de eliminar esta plantilla? Esta acción no se puede deshacer.')) {
        alert('Eliminar plantilla ' + id);
    }
}

// Inicializar con una fila por defecto
document.addEventListener('DOMContentLoaded', function() {
    addCuentaRow();
    addCuentaRow();
});
</script>
@endsection