@extends('layouts.app')

@section('title', 'Compras')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h3 mb-0">
                    <i class="fas fa-shopping-cart text-primary"></i>
                    Gestión de Compras
                </h2>
                <div class="btn-group" role="group">
                    <a href="{{ route('compras.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        Nueva Orden de Compra
                    </a>
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalCrearProveedor">
                        <i class="fas fa-truck"></i>
                        Nuevo Proveedor
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
                    <div class="text-warning mb-2">
                        <i class="fas fa-clock fa-2x"></i>
                    </div>
                    <h4 class="text-warning">{{ $estadisticas['ordenes_pendientes'] }}</h4>
                    <p class="text-muted mb-0">Órdenes Pendientes</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="text-danger mb-2">
                        <i class="fas fa-exclamation-triangle fa-2x"></i>
                    </div>
                    <h4 class="text-danger">{{ $estadisticas['ordenes_vencidas'] }}</h4>
                    <p class="text-muted mb-0">Órdenes Vencidas</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="text-info mb-2">
                        <i class="fas fa-truck fa-2x"></i>
                    </div>
                    <h4 class="text-info">{{ $estadisticas['proveedores_activos'] }}</h4>
                    <p class="text-muted mb-0">Proveedores Activos</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Órdenes Pendientes -->
    @if(count($ordenes_pendientes) > 0)
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-warning">
                <div class="card-header bg-warning text-dark">
                    <h6 class="mb-0">
                        <i class="fas fa-exclamation-triangle"></i>
                        Órdenes Próximas a Vencer
                    </h6>
                </div>
                <div class="card-body">
                    @foreach($ordenes_pendientes as $orden)
                    <div class="alert alert-{{ $orden['dias_restantes'] < 0 ? 'danger' : 'warning' }} alert-dismissible fade show" role="alert">
                        <strong>{{ $orden['numero_orden'] }}</strong> - {{ $orden['proveedor'] }} - 
                        ${{ number_format($orden['total'], 2) }} - 
                        {{ $orden['dias_restantes'] < 0 ? 'Vencida hace ' . abs($orden['dias_restantes']) . ' días' : $orden['dias_restantes'] . ' días restantes' }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Lista de Compras -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-list"></i>
                        Órdenes de Compra
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Número</th>
                                    <th>Proveedor</th>
                                    <th>Fecha Orden</th>
                                    <th>Fecha Entrega</th>
                                    <th>Total</th>
                                    <th>Items</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($compras as $compra)
                                <tr>
                                    <td>
                                        <strong>{{ $compra['numero_orden'] }}</strong>
                                    </td>
                                    <td>{{ $compra['proveedor'] }}</td>
                                    <td>{{ \Carbon\Carbon::parse($compra['fecha_orden'])->format('d/m/Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($compra['fecha_entrega'])->format('d/m/Y') }}</td>
                                    <td>
                                        <strong>${{ number_format($compra['total'], 2) }}</strong>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $compra['items_count'] }}</span>
                                    </td>
                                    <td>
                                        @if($compra['estado'] === 'pendiente')
                                            <span class="badge bg-warning">Pendiente</span>
                                        @elseif($compra['estado'] === 'aprobada')
                                            <span class="badge bg-info">Aprobada</span>
                                        @elseif($compra['estado'] === 'recibida')
                                            <span class="badge bg-success">Recibida</span>
                                        @else
                                            <span class="badge bg-secondary">{{ ucfirst($compra['estado']) }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('compras.show', $compra['id']) }}" 
                                               class="btn btn-sm btn-outline-info" title="Ver">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if($compra['estado'] === 'pendiente')
                                            <a href="{{ route('compras.edit', $compra['id']) }}" 
                                               class="btn btn-sm btn-outline-warning" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @endif
                                            @if($compra['estado'] === 'aprobada')
                                            <form action="{{ route('compras.recibir', $compra['id']) }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-success" title="Marcar como Recibida">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Crear Proveedor -->
<div class="modal fade" id="modalCrearProveedor" tabindex="-1" aria-labelledby="modalCrearProveedorLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCrearProveedorLabel">
                    <i class="fas fa-truck"></i>
                    Nuevo Proveedor
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formCrearProveedor" onsubmit="guardarProveedor(event)">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nombre/Razón Social *</label>
                                <input type="text" class="form-control" name="nombre" required 
                                       placeholder="Nombre del proveedor o empresa">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Tipo de Proveedor</label>
                                <select class="form-select" name="tipo">
                                    <option value="productos">Productos</option>
                                    <option value="servicios">Servicios</option>
                                    <option value="materias_primas">Materias Primas</option>
                                    <option value="equipos">Equipos</option>
                                    <option value="otros">Otros</option>
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
                                       placeholder="ventas@proveedor.com">
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
                                <label class="form-label">Persona de Contacto</label>
                                <input type="text" class="form-control" name="contacto" 
                                       placeholder="Nombre del contacto principal">
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Dirección</label>
                        <textarea class="form-control" name="direccion" rows="2" 
                                  placeholder="Dirección completa del proveedor"></textarea>
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
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Días de Pago</label>
                                <select class="form-select" name="dias_pago">
                                    <option value="0">Inmediato</option>
                                    <option value="15">15 días</option>
                                    <option value="30">30 días</option>
                                    <option value="45">45 días</option>
                                    <option value="60">60 días</option>
                                    <option value="90">90 días</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Calificación</label>
                                <select class="form-select" name="calificacion">
                                    <option value="5">⭐⭐⭐⭐⭐ Excelente</option>
                                    <option value="4">⭐⭐⭐⭐ Bueno</option>
                                    <option value="3">⭐⭐⭐ Regular</option>
                                    <option value="2">⭐⭐ Malo</option>
                                    <option value="1">⭐ Muy Malo</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Estado</label>
                                <select class="form-select" name="activo">
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Sitio Web</label>
                                <input type="url" class="form-control" name="sitio_web" 
                                       placeholder="https://www.proveedor.com">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Especialidad</label>
                                <input type="text" class="form-control" name="especialidad" 
                                       placeholder="Área de especialización">
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Notas</label>
                        <textarea class="form-control" name="notas" rows="2" 
                                  placeholder="Notas adicionales sobre el proveedor..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i>
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        Guardar Proveedor
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function guardarProveedor(event) {
    event.preventDefault();
    
    const formData = new FormData(event.target);
    const proveedorData = Object.fromEntries(formData);
    
    // Simular guardado (aquí se implementaría la llamada AJAX real)
    console.log('Guardando proveedor:', proveedorData);
    
    // Mostrar mensaje de éxito
    const toast = document.createElement('div');
    toast.className = 'toast align-items-center text-white bg-success border-0 position-fixed top-0 end-0 m-3';
    toast.setAttribute('role', 'alert');
    toast.style.zIndex = '9999';
    toast.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">
                <i class="fas fa-check-circle me-2"></i>
                Proveedor "${proveedorData.nombre}" creado exitosamente
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    `;
    
    document.body.appendChild(toast);
    const bsToast = new bootstrap.Toast(toast);
    bsToast.show();
    
    // Cerrar modal y limpiar formulario
    const modal = bootstrap.Modal.getInstance(document.getElementById('modalCrearProveedor'));
    modal.hide();
    event.target.reset();
    
    // Remover toast después de que se oculte
    toast.addEventListener('hidden.bs.toast', () => {
        toast.remove();
    });
}
</script>
@endsection