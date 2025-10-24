@extends('layouts.app')

@section('title', 'Partidas de Diario')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-book-open me-2"></i>Partidas de Diario</h2>
    <a href="{{ route('entries.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i>Nueva Partida
    </a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="card">
    <div class="card-body">
        @if(isset($entries) && $entries->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Fecha</th>
                        <th>Descripción</th>
                        <th>Débito</th>
                        <th>Crédito</th>
                        <th>Estado</th>
                        <th>Líneas</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($entries as $entry)
                    <tr>
                        <td>{{ $entry->date_register->format('d/m/Y') }}</td>
                        <td>{{ $entry->description }}</td>
                        <td class="text-end">{{ number_format($entry->mount_debit, 2) }}</td>
                        <td class="text-end">{{ number_format($entry->mount_credit, 2) }}</td>
                        <td class="text-center">
                            @if($entry->mayor === 'N')
                                <span class="badge bg-warning">Pendiente</span>
                            @else
                                <span class="badge bg-success">Mayorizada</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <span class="badge bg-info">{{ $entry->lines->count() }} líneas</span>
                        </td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                <a href="{{ route('entries.show', $entry->id) }}" 
                                   class="btn btn-sm btn-outline-info" 
                                   title="Ver detalles">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if($entry->mayor === 'N')
                                <button type="button" 
                                        class="btn btn-sm btn-outline-success" 
                                        onclick="mayorizeEntry({{ $entry->id }})"
                                        title="Mayorizar">
                                    <i class="fas fa-check-circle"></i>
                                </button>
                                @else
                                <span class="badge bg-success" title="Ya mayorizada">
                                    <i class="fas fa-check"></i> Mayorizada
                                </span>
                                @endif
                                <button type="button" 
                                        class="btn btn-sm btn-outline-danger" 
                                        onclick="confirmDelete({{ $entry->id }})"
                                        title="Eliminar">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="d-flex justify-content-center">
            {{ $entries->links() }}
        </div>
        @else
        <div class="text-center py-5">
            <i class="fas fa-book-open fa-3x text-muted mb-3"></i>
            <h5 class="text-muted">No hay partidas de diario registradas</h5>
            <p class="text-muted">Comience creando su primera partida de diario.</p>
            <a href="{{ route('entries.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>Crear Primera Partida
            </a>
        </div>
        @endif
    </div>
</div>

<!-- Modal de confirmación para eliminar -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar Eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>¿Está seguro que desea eliminar esta partida de diario?</p>
                <p class="text-warning"><i class="fas fa-exclamation-triangle"></i> Esta acción no se puede deshacer.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Eliminar</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
let entryToDelete = null;

function confirmDelete(entryId) {
    entryToDelete = entryId;
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}

function mayorizeEntry(entryId) {
    Swal.fire({
        title: '¿Mayorizar partida?',
        text: "Esta acción pasará la partida al libro mayor y no podrá ser revertida.",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí, mayorizar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/entries/${entryId}/mayorize`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Remover la fila de la tabla inmediatamente
                    const entryRow = document.querySelector(`button[onclick="mayorizeEntry(${entryId})"]`).closest('tr');
                    entryRow.style.transition = 'opacity 0.5s';
                    entryRow.style.opacity = '0';
                    
                    setTimeout(() => {
                        entryRow.remove();
                        
                        // Verificar si no quedan más partidas
                        const tbody = document.querySelector('tbody');
                        if (tbody.children.length === 0) {
                            tbody.innerHTML = `
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <i class="fas fa-book-open fa-3x text-muted mb-3"></i>
                                        <h5 class="text-muted">No hay partidas de diario registradas</h5>
                                        <p class="text-muted">Comience creando su primera partida de diario.</p>
                                        <a href="{{ route('entries.create') }}" class="btn btn-primary">
                                            <i class="fas fa-plus me-1"></i>Crear Primera Partida
                                        </a>
                                    </td>
                                </tr>
                            `;
                        }
                    }, 500);
                    
                    Swal.fire({
                        icon: 'success',
                        title: '¡Mayorizada!',
                        text: data.message,
                        timer: 1500,
                        showConfirmButton: false
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Ocurrió un error al mayorizar la partida.'
                });
            });
        }
    });
}

document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
    if (entryToDelete) {
        // Cerrar modal
        const modal = bootstrap.Modal.getInstance(document.getElementById('deleteModal'));
        modal.hide();

        // Realizar la eliminación
        fetch(`/entries/${entryToDelete}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: '¡Eliminado!',
                    text: data.message,
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => {
                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message
                });
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Ocurrió un error al eliminar la partida.'
            });
        });

        entryToDelete = null;
    }
});
</script>
@endsection