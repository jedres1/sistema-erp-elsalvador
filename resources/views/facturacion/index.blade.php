@extends('layouts.app')

@section('title', 'Facturación')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h3 mb-0">
                    <i class="fas fa-file-invoice-dollar text-primary"></i>
                    Sistema de Facturación
                </h2>
                <div class="btn-group" role="group">
                    <a href="{{ route('facturacion.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        Nueva Factura
                    </a>
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalCrearCliente">
                        <i class="fas fa-user-plus"></i>
                        Nuevo Cliente
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Estadísticas -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="text-success mb-2">
                        <i class="fas fa-dollar-sign fa-2x"></i>
                    </div>
                    <h4 class="text-success">${{ number_format($estadisticas['total_mes'], 2) }}</h4>
                    <p class="text-muted mb-0">Total del Mes</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="text-primary mb-2">
                        <i class="fas fa-file-invoice fa-2x"></i>
                    </div>
                    <h4 class="text-primary">{{ $estadisticas['facturas_mes'] }}</h4>
                    <p class="text-muted mb-0">Facturas del Mes</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="text-warning mb-2">
                        <i class="fas fa-clock fa-2x"></i>
                    </div>
                    <h4 class="text-warning">${{ number_format($estadisticas['pendientes_cobro'], 2) }}</h4>
                    <p class="text-muted mb-0">Pendientes de Cobro</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="text-info mb-2">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                    <h4 class="text-info">{{ $estadisticas['clientes_activos'] }}</h4>
                    <p class="text-muted mb-0">Clientes Activos</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtros y Acciones -->
    <div class="row mb-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <input type="text" class="form-control" placeholder="Buscar factura..." id="searchInput">
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" id="estadoFilter">
                                <option value="">Todos los estados</option>
                                <option value="pendiente">Pendiente</option>
                                <option value="pagada">Pagada</option>
                                <option value="vencida">Vencida</option>
                                <option value="cancelada">Cancelada</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="date" class="form-control" id="fechaDesde">
                        </div>
                        <div class="col-md-3">
                            <input type="date" class="form-control" id="fechaHasta">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-primary flex-fill">
                            <i class="fas fa-download"></i>
                            Exportar
                        </button>
                        <button class="btn btn-outline-success flex-fill">
                            <i class="fas fa-print"></i>
                            Imprimir
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Lista de Facturas -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-list"></i>
                        Facturas Recientes
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Número</th>
                                    <th>Cliente</th>
                                    <th>Fecha</th>
                                    <th>Total</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($facturas_recientes as $factura)
                                <tr>
                                    <td>
                                        <strong>{{ $factura['numero'] }}</strong>
                                    </td>
                                    <td>{{ $factura['cliente'] }}</td>
                                    <td>{{ \Carbon\Carbon::parse($factura['fecha'])->format('d/m/Y') }}</td>
                                    <td>
                                        <strong>${{ number_format($factura['total'], 2) }}</strong>
                                    </td>
                                    <td>
                                        @if($factura['estado'] === 'pagada')
                                            <span class="badge bg-success">Pagada</span>
                                        @elseif($factura['estado'] === 'pendiente')
                                            <span class="badge bg-warning">Pendiente</span>
                                        @elseif($factura['estado'] === 'vencida')
                                            <span class="badge bg-danger">Vencida</span>
                                        @else
                                            <span class="badge bg-secondary">{{ ucfirst($factura['estado']) }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('facturacion.show', $factura['id']) }}" 
                                               class="btn btn-sm btn-outline-info" title="Ver">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('facturacion.edit', $factura['id']) }}" 
                                               class="btn btn-sm btn-outline-warning" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('facturacion.pdf', $factura['id']) }}" 
                                               class="btn btn-sm btn-outline-danger" title="PDF">
                                                <i class="fas fa-file-pdf"></i>
                                            </a>
                                            <button class="btn btn-sm btn-outline-danger" 
                                                    onclick="confirmarEliminacion({{ $factura['id'] }})" title="Eliminar">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    @if(count($facturas_recientes) === 0)
                    <div class="text-center py-4">
                        <i class="fas fa-file-invoice fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">No hay facturas registradas</h5>
                        <p class="text-muted">Comience creando su primera factura</p>
                        <a href="{{ route('facturacion.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i>
                            Crear Primera Factura
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Confirmación -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar Eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                ¿Está seguro de que desea eliminar esta factura? Esta acción no se puede deshacer.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function confirmarEliminacion(id) {
    const form = document.getElementById('deleteForm');
    form.action = `/facturacion/${id}`;
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}

// Filtros en tiempo real
document.getElementById('searchInput').addEventListener('input', filtrarTabla);
document.getElementById('estadoFilter').addEventListener('change', filtrarTabla);

function filtrarTabla() {
    const search = document.getElementById('searchInput').value.toLowerCase();
    const estado = document.getElementById('estadoFilter').value;
    const filas = document.querySelectorAll('tbody tr');
    
    filas.forEach(fila => {
        const texto = fila.textContent.toLowerCase();
        const estadoFila = fila.querySelector('.badge').textContent.toLowerCase();
        
        const coincideTexto = texto.includes(search);
        const coincideEstado = !estado || estadoFila.includes(estado);
        
        fila.style.display = (coincideTexto && coincideEstado) ? '' : 'none';
    });
}
</script>

<!-- Modal para Crear Cliente -->
<div class="modal fade" id="modalCrearCliente" tabindex="-1" aria-labelledby="modalCrearClienteLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCrearClienteLabel">
                    <i class="fas fa-user-plus"></i>
                    Nuevo Cliente
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formCrearCliente" onsubmit="guardarCliente(event)">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nombre/Razón Social *</label>
                                <input type="text" class="form-control" name="nombre" required 
                                       placeholder="Nombre del cliente o empresa">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Tipo de Cliente</label>
                                <select class="form-select" name="tipo">
                                    <option value="persona">Persona Física</option>
                                    <option value="empresa">Empresa</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">RFC/NIT</label>
                                <input type="text" class="form-control" name="rfc" 
                                       placeholder="RFC o número de identificación fiscal">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" 
                                       placeholder="correo@ejemplo.com">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Teléfono</label>
                                <input type="tel" class="form-control" name="telefono" 
                                       placeholder="Número de teléfono">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Límite de Crédito</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control" name="limite_credito" 
                                           step="0.01" min="0" placeholder="0.00">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Dirección</label>
                        <textarea class="form-control" name="direccion" rows="2" 
                                  placeholder="Dirección completa del cliente"></textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Ciudad</label>
                                <input type="text" class="form-control" name="ciudad" 
                                       placeholder="Ciudad">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Estado/Provincia</label>
                                <input type="text" class="form-control" name="estado" 
                                       placeholder="Estado o provincia">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Código Postal</label>
                                <input type="text" class="form-control" name="codigo_postal" 
                                       placeholder="C.P.">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Días de Crédito</label>
                                <select class="form-select" name="dias_credito">
                                    <option value="0">Contado</option>
                                    <option value="15">15 días</option>
                                    <option value="30">30 días</option>
                                    <option value="45">45 días</option>
                                    <option value="60">60 días</option>
                                    <option value="90">90 días</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Estado</label>
                                <select class="form-select" name="activo">
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i>
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        Guardar Cliente
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function guardarCliente(event) {
    event.preventDefault();
    
    const formData = new FormData(event.target);
    const clienteData = Object.fromEntries(formData);
    
    // Simular guardado (aquí se implementaría la llamada AJAX real)
    console.log('Guardando cliente:', clienteData);
    
    // Mostrar mensaje de éxito
    const toast = document.createElement('div');
    toast.className = 'toast align-items-center text-white bg-success border-0 position-fixed top-0 end-0 m-3';
    toast.setAttribute('role', 'alert');
    toast.style.zIndex = '9999';
    toast.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">
                <i class="fas fa-check-circle me-2"></i>
                Cliente "${clienteData.nombre}" creado exitosamente
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    `;
    
    document.body.appendChild(toast);
    const bsToast = new bootstrap.Toast(toast);
    bsToast.show();
    
    // Cerrar modal y limpiar formulario
    const modal = bootstrap.Modal.getInstance(document.getElementById('modalCrearCliente'));
    modal.hide();
    event.target.reset();
    
    // Remover toast después de que se oculte
    toast.addEventListener('hidden.bs.toast', () => {
        toast.remove();
    });
}
</script>
@endsection