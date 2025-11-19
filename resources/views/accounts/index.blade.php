@extends('layouts.app')

@section('title', 'Catálogo de Cuentas')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="mb-4">
        <div class="bg-white shadow-sm rounded-lg p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-1 text-gray-800">📋 Catálogo de Cuentas Contables</h1>
                    <p class="text-muted mb-0">Gestiona tu plan de cuentas contables</p>
                </div>
                <a href="{{ route('accounts.create') }}" 
                   class="btn btn-primary">
                    ➕ Nueva Cuenta
                </a>
            </div>
        </div>
    </div>

    <!-- Buscador -->
    <div class="mb-4">
        <div class="bg-white shadow-sm rounded-lg p-4">
            <form method="GET" action="{{ route('accounts.index') }}">
                <div class="row g-3">
                    <div class="col-md-10">
                        <div class="input-group">
                            <span class="input-group-text">🔍</span>
                            <input type="text" 
                                   name="search" 
                                   class="form-control" 
                                   placeholder="Buscar por código o descripción..." 
                                   value="{{ $search ?? '' }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-outline-primary w-100">
                            Buscar
                        </button>
                        @if($search)
                        <a href="{{ route('accounts.index') }}" class="btn btn-outline-secondary w-100 mt-2">
                            ❌ Limpiar
                        </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Resultados -->
    @if($search)
    <div class="mb-4">
        <div class="bg-white shadow-sm rounded-lg p-3">
            <div class="d-flex align-items-center">
                <span class="text-success me-2">✅</span>
                <span class="text-muted">
                    Se encontraron {{ $accounts->total() }} resultado(s) para "<strong>{{ $search }}</strong>"
                </span>
            </div>
        </div>
    </div>
    @endif

    <!-- Tabla de cuentas -->
    <div class="bg-white shadow-sm rounded-lg">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                📊 Lista de Cuentas
                <span class="badge bg-secondary ms-2">{{ $accounts->total() }} total</span>
            </h5>
        </div>
        
        <div class="card-body p-0">
            @if($accounts->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 12%;">Código</th>
                            <th style="width: 40%;">Descripción</th>
                            <th style="width: 15%;" class="text-center">Tipo</th>
                            <th style="width: 15%;" class="text-center">Naturaleza</th>
                            <th style="width: 10%;" class="text-center">Estado</th>
                            <th style="width: 8%;" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($accounts as $account)
                        <tr>
                            <td class="fw-bold text-primary">{{ $account->code }}</td>
                            <td>{{ $account->description }}</td>
                            <td class="text-center">
                                @if($account->accept_transaction === 'S')
                                    <span class="badge bg-success">💰 Transaccional</span>
                                @else
                                    <span class="badge bg-secondary">📁 Agrupadora</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($account->nature === 'D')
                                    <span class="badge bg-info">⬅️ Débito</span>
                                @else
                                    <span class="badge bg-warning">➡️ Crédito</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($account->status === 'A')
                                    <span class="badge bg-success">✅ Activa</span>
                                @else
                                    <span class="badge bg-danger">❌ Inactiva</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('accounts.edit', $account->id) }}" 
                                       class="btn btn-outline-primary" 
                                       title="Editar">
                                        ✏️
                                    </a>
                                    <button type="button" 
                                            class="btn btn-outline-danger" 
                                            onclick="confirmDelete({{ $account->id }}, '{{ $account->code }}', '{{ addslashes($account->description) }}')"
                                            title="Eliminar">
                                        🗑️
                                    </button>
                                    
                                    <!-- Formulario oculto para eliminar -->
                                    <form id="delete-form-{{ $account->id }}" 
                                          action="{{ route('accounts.destroy', $account->id) }}" 
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
            @else
            <div class="text-center py-5">
                <div class="mb-3">
                    <span style="font-size: 4rem;">📋</span>
                </div>
                <h5 class="text-muted">No se encontraron cuentas</h5>
                @if($search)
                    <p class="text-muted">Prueba con otros términos de búsqueda</p>
                @endif
            </div>
        @endif
        
        <!-- Paginación -->
        @if($accounts->hasPages())
        <div class="card-footer bg-light">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted">
                    Mostrando {{ $accounts->firstItem() }} a {{ $accounts->lastItem() }} de {{ $accounts->total() }} resultados
                </div>
                <div>
                    {{ $accounts->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
    function confirmDelete(id, code, description) {
        Swal.fire({
            title: '¿Eliminar Cuenta?',
            html: `
                <div class="text-start">
                    <p class="mb-2">¿Estás seguro de que deseas eliminar esta cuenta?</p>
                    <div class="alert alert-warning">
                        <strong>Código:</strong> ${code}<br>
                        <strong>Descripción:</strong> ${description}
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
