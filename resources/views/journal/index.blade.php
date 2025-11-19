@extends('layouts.app')

@section('title', 'Libro Diario')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="mb-4">
        <div class="bg-white shadow-sm rounded-lg p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-1 text-gray-800">📖 Libro Diario</h1>
                    <p class="text-muted mb-0">Registro de todas las partidas contables</p>
                </div>
                <div class="btn-group" role="group">
                    <a href="{{ route('entries.create') }}" 
                       class="btn btn-success">
                        ➕ Nueva Partida
                    </a>
                    <button class="btn btn-primary">
                        📄 PDF
                    </button>
                    <button class="btn btn-success">
                        📊 Excel
                    </button>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="mb-4">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
    @endif

    <!-- Tabla de partidas -->
    <div class="bg-white shadow-sm rounded-lg">
        <div class="card-header bg-light">
            <h5 class="mb-0">📋 Partidas Registradas</h5>
        </div>
        
        <div class="card-body p-0">
            @if(isset($entries) && $entries->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 10%;">Fecha</th>
                            <th style="width: 35%;">Descripción</th>
                            <th style="width: 12%;" class="text-end">Débito</th>
                            <th style="width: 12%;" class="text-end">Crédito</th>
                            <th style="width: 12%;" class="text-center">Estado</th>
                            <th style="width: 9%;" class="text-center">Líneas</th>
                            <th style="width: 10%;" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($entries as $entry)
                        <tr>
                            <td class="text-nowrap">
                                {{ $entry->date_register->format('d/m/Y') }}
                            </td>
                            <td>{{ $entry->description }}</td>
                            <td class="text-end fw-bold text-primary">
                                ${{ number_format($entry->mount_debit, 2) }}
                            </td>
                            <td class="text-end fw-bold text-success">
                                ${{ number_format($entry->mount_credit, 2) }}
                            </td>
                            <td class="text-center">
                                @if($entry->mayor === 'N')
                                    <span class="badge bg-warning">⏳ Pendiente</span>
                                @else
                                    <span class="badge bg-success">✅ Mayorizada</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <span class="badge bg-info">{{ $entry->lines->count() }} líneas</span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('entries.show', $entry->id) }}" 
                                       class="btn btn-outline-primary" 
                                       title="Ver detalles">
                                        👁️
                                    </a>
                                    @if($entry->mayor === 'N')
                                    <button type="button" 
                                            class="btn btn-outline-success"
                                            onclick="mayorizeEntry({{ $entry->id }})"
                                            title="Mayorizar">
                                        ✓
                                    </button>
                                    @else
                                    <span class="btn btn-success btn-sm disabled" title="Ya mayorizada">
                                        ✓
                                    </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Paginación -->
            @if($entries->hasPages())
            <div class="card-footer bg-light">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted">
                        Mostrando {{ $entries->firstItem() }} a {{ $entries->lastItem() }} de {{ $entries->total() }} resultados
                    </div>
                    <div>
                        {{ $entries->links() }}
                    </div>
                </div>
            </div>
            @endif
            @else
            <div class="text-center py-5">
                <div class="mb-3">
                    <span style="font-size: 4rem;">📖</span>
                </div>
                <h5 class="text-muted">No hay movimientos en el libro diario</h5>
                <p class="text-muted">Las partidas aparecerán aquí hasta que sean mayorizadas.</p>
                <a href="{{ route('entries.create') }}" 
                   class="btn btn-primary mt-3">
                    ➕ Crear Primera Partida
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function mayorizeEntry(entryId) {
    Swal.fire({
        title: '¿Mayorizar partida?',
        text: "Esta acción pasará la partida al libro mayor y no podrá ser revertida.",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#198754',
        cancelButtonColor: '#6c757d',
        confirmButtonText: '✓ Sí, mayorizar',
        cancelButtonText: '❌ Cancelar'
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
                    Swal.fire({
                        icon: 'success',
                        title: '¡Mayorizada!',
                        text: data.message,
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.reload();
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
</script>
@endsection