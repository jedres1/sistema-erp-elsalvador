@extends('layouts.app')

@section('title', 'Plantillas Contables')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="mb-4">
        <div class="bg-white shadow-sm rounded-lg p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-1 text-gray-800">📋 Plantillas Contables</h1>
                    <p class="text-muted mb-0">Gestiona las plantillas de cuentas para clientes, productos y proveedores</p>
                </div>
                <a href="{{ route('plantillas-contables.create') }}" 
                   class="btn btn-primary">
                    ➕ Nueva Plantilla
                </a>
            </div>
        </div>
    </div>

    <!-- Filtros -->
    <div class="mb-4">
        <div class="bg-white shadow-sm rounded-lg p-4">
            <form method="GET" action="{{ route('plantillas-contables.index') }}">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Buscar</label>
                        <input type="text" 
                               name="search" 
                               class="form-control" 
                               placeholder="Buscar por nombre..." 
                               value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Tipo</label>
                        <select name="tipo" class="form-select">
                            <option value="">Todos los tipos</option>
                            <option value="cliente" {{ request('tipo') == 'cliente' ? 'selected' : '' }}>Cliente</option>
                            <option value="articulo" {{ request('tipo') == 'articulo' ? 'selected' : '' }}>Artículo</option>
                            <option value="proveedor" {{ request('tipo') == 'proveedor' ? 'selected' : '' }}>Proveedor</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Estado</label>
                        <select name="estado" class="form-select">
                            <option value="">Todos</option>
                            <option value="activo" {{ request('estado') == 'activo' ? 'selected' : '' }}>Activo</option>
                            <option value="inactivo" {{ request('estado') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">&nbsp;</label>
                        <button type="submit" class="btn btn-outline-primary w-100">
                            🔍 Buscar
                        </button>
                        @if(request()->hasAny(['search', 'tipo', 'estado']))
                        <a href="{{ route('plantillas-contables.index') }}" class="btn btn-outline-secondary w-100 mt-2">
                            ❌ Limpiar
                        </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabla de plantillas -->
    <div class="bg-white shadow-sm rounded-lg">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                📊 Lista de Plantillas
                <span class="badge bg-secondary ms-2">{{ $plantillas->total() }} total</span>
            </h5>
        </div>
        
        <div class="card-body p-0">
            @if($plantillas->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 25%;">Nombre</th>
                            <th style="width: 12%;" class="text-center">Tipo</th>
                            <th style="width: 35%;">Descripción</th>
                            <th style="width: 10%;" class="text-center">Cuentas</th>
                            <th style="width: 10%;" class="text-center">Estado</th>
                            <th style="width: 8%;" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($plantillas as $plantilla)
                        <tr>
                            <td class="fw-bold">{{ $plantilla->nombre }}</td>
                            <td class="text-center">
                                @if($plantilla->tipo === 'cliente')
                                    <span class="badge bg-primary">👤 Cliente</span>
                                @elseif($plantilla->tipo === 'articulo')
                                    <span class="badge bg-success">📦 Artículo</span>
                                @else
                                    <span class="badge bg-info">🏢 Proveedor</span>
                                @endif
                            </td>
                            <td class="text-muted small">
                                {{ $plantilla->descripcion ?? 'Sin descripción' }}
                            </td>
                            <td class="text-center">
                                <span class="badge bg-secondary">{{ $plantilla->cuentas->count() }} cuentas</span>
                            </td>
                            <td class="text-center">
                                @if($plantilla->activo)
                                    <span class="badge bg-success">✅ Activa</span>
                                @else
                                    <span class="badge bg-danger">❌ Inactiva</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('plantillas-contables.show', $plantilla->id) }}" 
                                       class="btn btn-outline-info" 
                                       title="Ver">
                                        👁️
                                    </a>
                                    <a href="{{ route('plantillas-contables.edit', $plantilla->id) }}" 
                                       class="btn btn-outline-primary" 
                                       title="Editar">
                                        ✏️
                                    </a>
                                    <button type="button" 
                                            class="btn btn-outline-danger" 
                                            onclick="confirmDelete({{ $plantilla->id }}, '{{ addslashes($plantilla->nombre) }}')"
                                            title="Eliminar">
                                        🗑️
                                    </button>
                                    
                                    <form id="delete-form-{{ $plantilla->id }}" 
                                          action="{{ route('plantillas-contables.destroy', $plantilla->id) }}" 
                                          method="POST" 
                                          style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            @if($plantillas->hasPages())
            <div class="card-footer bg-light">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted">
                        Mostrando {{ $plantillas->firstItem() }} a {{ $plantillas->lastItem() }} de {{ $plantillas->total() }} resultados
                    </div>
                    <div>
                        {{ $plantillas->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
            @endif
            @else
            <div class="text-center py-5">
                <div class="mb-3">
                    <span style="font-size: 4rem;">📋</span>
                </div>
                <h5 class="text-muted">No se encontraron plantillas</h5>
                <p class="text-muted">Crea tu primera plantilla contable</p>
                <a href="{{ route('plantillas-contables.create') }}" class="btn btn-primary mt-2">
                    ➕ Nueva Plantilla
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function confirmDelete(id, nombre) {
        Swal.fire({
            title: '¿Eliminar Plantilla?',
            html: `
                <div class="text-start">
                    <p class="mb-2">¿Estás seguro de que deseas eliminar esta plantilla?</p>
                    <div class="alert alert-warning">
                        <strong>Nombre:</strong> ${nombre}
                    </div>
                    <p class="text-danger mb-0"><small>⚠️ Esta acción no se puede deshacer</small></p>
                </div>
            `,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '🗑️ Sí, eliminar',
            cancelButtonText: '❌ Cancelar',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
@endsection
