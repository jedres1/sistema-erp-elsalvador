@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-users text-primary"></i> 
                Gestión de Clientes
            </h1>
            <p class="text-muted">Administra los clientes para facturación electrónica</p>
        </div>
        <div>
            <a href="{{ route('documentos-electronicos.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Documentos Electrónicos
            </a>
            <a href="{{ route('clientes.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nuevo Cliente
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Filtros de búsqueda -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Buscar Cliente</label>
                    <input type="text" class="form-control" id="buscarCliente" placeholder="Nombre, NIT o DUI...">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Tipo Documento</label>
                    <select class="form-select" id="filtroTipo">
                        <option value="">Todos</option>
                        <option value="NIT">NIT</option>
                        <option value="DUI">DUI</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Estado</label>
                    <select class="form-select" id="filtroEstado">
                        <option value="">Todos</option>
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">&nbsp;</label>
                    <button type="button" class="btn btn-outline-secondary d-block w-100" onclick="limpiarFiltros()">
                        <i class="fas fa-eraser"></i> Limpiar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Estadísticas rápidas -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Clientes</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($clientes) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Clientes Activos</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $clientes->where('estado', 'A')->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Límite Crédito Total</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{ number_format($clientes->sum('limite_credito'), 2) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-credit-card fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Crédito Utilizado</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$0.00</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de clientes -->
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista de Clientes</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="tablaClientes">
                    <thead class="table-light">
                        <tr>
                            <th>Tipo Doc.</th>
                            <th>Número Documento</th>
                            <th>Razón Social</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                            <th>Ubicación</th>
                            <th>Crédito</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clientes as $cliente)
                        <tr>
                            <td>
                                <span class="badge {{ $cliente->tipo_documento == 'NIT' ? 'bg-primary' : 'bg-info' }}">
                                    {{ $cliente->tipo_documento }}
                                </span>
                            </td>
                            <td class="font-monospace">{{ $cliente->numero_documento }}</td>
                            <td>
                                <div class="fw-bold">{{ $cliente->nombre }}</div>
                                @if($cliente->nombre_comercial)
                                    <small class="text-muted">{{ $cliente->nombre_comercial }}</small>
                                @endif
                            </td>
                            <td>
                                @if($cliente->telefono)
                                    <i class="fas fa-phone text-muted me-1"></i>{{ $cliente->telefono }}
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($cliente->email)
                                    <a href="mailto:{{ $cliente->email }}" class="text-decoration-none">
                                        <i class="fas fa-envelope text-muted me-1"></i>{{ $cliente->email }}
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <small>{{ $cliente->direccion ?? '-' }}</small>
                            </td>
                            <td>
                                <div class="text-end">
                                    <div class="fw-bold text-success">${{ number_format($cliente->limite_credito ?? 0, 2) }}</div>
                                    <small class="text-muted">Disponible</small>
                                </div>
                            </td>
                            <td>
                                <span class="badge {{ $cliente->estado == 'A' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $cliente->estado == 'A' ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('clientes.show', $cliente->id) }}" 
                                       class="btn btn-sm btn-outline-info" title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('clientes.edit', $cliente->id) }}" 
                                       class="btn btn-sm btn-outline-primary" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger" 
                                            onclick="confirmarEliminacion({{ $cliente->id }})" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
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

<!-- Modal de confirmación para eliminar -->
<div class="modal fade" id="modalEliminar" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar Eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                ¿Está seguro que desea eliminar este cliente? Esta acción no se puede deshacer.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form id="formEliminar" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function confirmarEliminacion(clienteId) {
    document.getElementById('formEliminar').action = `/clientes/${clienteId}`;
    new bootstrap.Modal(document.getElementById('modalEliminar')).show();
}

function limpiarFiltros() {
    document.getElementById('buscarCliente').value = '';
    document.getElementById('filtroTipo').value = '';
    document.getElementById('filtroEstado').value = '';
    filtrarTabla();
}

// Filtrado en tiempo real
document.getElementById('buscarCliente').addEventListener('input', filtrarTabla);
document.getElementById('filtroTipo').addEventListener('change', filtrarTabla);
document.getElementById('filtroEstado').addEventListener('change', filtrarTabla);

function filtrarTabla() {
    const buscar = document.getElementById('buscarCliente').value.toLowerCase();
    const tipo = document.getElementById('filtroTipo').value;
    const estado = document.getElementById('filtroEstado').value;
    
    const filas = document.querySelectorAll('#tablaClientes tbody tr');
    
    filas.forEach(fila => {
        const textoFila = fila.textContent.toLowerCase();
        const tipoDoc = fila.querySelector('.badge').textContent.trim();
        const estadoCliente = fila.querySelectorAll('.badge')[1].textContent.trim();
        
        const cumpleBuscar = buscar === '' || textoFila.includes(buscar);
        const cumpleTipo = tipo === '' || tipoDoc === tipo;
        const cumpleEstado = estado === '' || estadoCliente === estado;
        
        if (cumpleBuscar && cumpleTipo && cumpleEstado) {
            fila.style.display = '';
        } else {
            fila.style.display = 'none';
        }
    });
}
</script>
@endsection