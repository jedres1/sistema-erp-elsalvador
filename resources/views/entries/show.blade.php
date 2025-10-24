@extends('layouts.app')

@section('title', 'Detalle de Partida')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-eye me-2"></i>Detalle de Partida</h2>
    <a href="{{ route('journal.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i>Volver
    </a>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Información General</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <strong>Fecha:</strong><br>
                <span class="text-muted">{{ $entry->date_register->format('d/m/Y') }}</span>
            </div>
            <div class="col-md-3">
                <strong>ID de Partida:</strong><br>
                <span class="text-muted">#{{ $entry->id }}</span>
            </div>
            <div class="col-md-3">
                <strong>Total Débito:</strong><br>
                <span class="text-success fw-bold">${{ number_format($entry->mount_debit, 2) }}</span>
            </div>
            <div class="col-md-3">
                <strong>Total Crédito:</strong><br>
                <span class="text-info fw-bold">${{ number_format($entry->mount_credit, 2) }}</span>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <strong>Descripción:</strong><br>
                <span class="text-muted">{{ $entry->description }}</span>
            </div>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-list me-2"></i>Detalle de Líneas</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th width="5%">#</th>
                        <th width="15%">Código</th>
                        <th width="45%">Cuenta</th>
                        <th width="15%">Débito</th>
                        <th width="15%">Crédito</th>
                        <th width="5%">Tipo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($entry->lines as $line)
                    <tr>
                        <td class="text-center">{{ $line->line }}</td>
                        <td>
                            <code>{{ str_replace('.', '', $line->accountCataloge->code) }}</code>
                        </td>
                        <td>{{ $line->accountCataloge->description }}</td>
                        <td class="text-end">
                            @if($line->debit_amount > 0)
                                <span class="text-success fw-bold">${{ number_format($line->debit_amount, 2) }}</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td class="text-end">
                            @if($line->credit_amount > 0)
                                <span class="text-info fw-bold">${{ number_format($line->credit_amount, 2) }}</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <span class="badge bg-secondary">{{ $line->accountCataloge->type_account }}</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="table-info">
                        <th colspan="3" class="text-end">TOTALES:</th>
                        <th class="text-end">${{ number_format($entry->mount_debit, 2) }}</th>
                        <th class="text-end">${{ number_format($entry->mount_credit, 2) }}</th>
                        <th class="text-center">
                            @if($entry->mount_debit == $entry->mount_credit)
                                <span class="badge bg-success">Balanceado</span>
                            @else
                                <span class="badge bg-danger">Desbalanceado</span>
                            @endif
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Resumen por Tipo de Cuenta</h5>
    </div>
    <div class="card-body">
        <div class="row">
            @php
                $summary = $entry->lines->groupBy('accountCataloge.type_account');
                $types = [
                    'A' => ['name' => 'Activo', 'icon' => 'fas fa-wallet', 'color' => 'primary'],
                    'P' => ['name' => 'Pasivo', 'icon' => 'fas fa-credit-card', 'color' => 'warning'],
                    'K' => ['name' => 'Capital', 'icon' => 'fas fa-coins', 'color' => 'success'],
                    'I' => ['name' => 'Ingreso', 'icon' => 'fas fa-arrow-up', 'color' => 'info'],
                    'G' => ['name' => 'Gasto', 'icon' => 'fas fa-arrow-down', 'color' => 'danger']
                ];
            @endphp
            
            @foreach($types as $typeCode => $typeInfo)
                @if($summary->has($typeCode))
                    @php
                        $typeLines = $summary[$typeCode];
                        $totalDebits = $typeLines->sum('debit_amount');
                        $totalCredits = $typeLines->sum('credit_amount');
                    @endphp
                    <div class="col-md-4 mb-3">
                        <div class="card border-{{ $typeInfo['color'] }}">
                            <div class="card-body text-center">
                                <i class="{{ $typeInfo['icon'] }} fa-2x text-{{ $typeInfo['color'] }} mb-2"></i>
                                <h6 class="card-title">{{ $typeInfo['name'] }}</h6>
                                <p class="card-text">
                                    <small class="text-muted">Débitos:</small> ${{ number_format($totalDebits, 2) }}<br>
                                    <small class="text-muted">Créditos:</small> ${{ number_format($totalCredits, 2) }}
                                </p>
                                <span class="badge bg-{{ $typeInfo['color'] }}">{{ $typeLines->count() }} líneas</span>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>

<div class="mt-4">
    <div class="d-flex justify-content-between">
        <a href="{{ route('journal.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i>Volver a la Lista
        </a>
        <div>
            <button type="button" class="btn btn-info" onclick="window.print()">
                <i class="fas fa-print me-1"></i>Imprimir
            </button>
            <button type="button" class="btn btn-outline-danger" onclick="confirmDelete({{ $entry->id }})">
                <i class="fas fa-trash me-1"></i>Eliminar
            </button>
        </div>
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
                <hr>
                <strong>Partida:</strong> #{{ $entry->id }}<br>
                <strong>Fecha:</strong> {{ $entry->date_register->format('d/m/Y') }}<br>
                <strong>Descripción:</strong> {{ $entry->description }}
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
function confirmDelete(entryId) {
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
    
    document.getElementById('confirmDeleteBtn').onclick = function() {
        // Cerrar modal
        modal.hide();

        // Realizar la eliminación
        fetch(`/entries/${entryId}`, {
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
                    window.location.href = '{{ route("journal.index") }}';
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
    };
}

// Estilos para impresión
window.addEventListener('beforeprint', function() {
    document.body.classList.add('printing');
});

window.addEventListener('afterprint', function() {
    document.body.classList.remove('printing');
});
</script>

<style>
@media print {
    .btn, .modal, .card-header {
        display: none !important;
    }
    
    .card {
        border: none !important;
        box-shadow: none !important;
    }
    
    .container-fluid {
        padding: 0 !important;
    }
    
    h2 {
        font-size: 18px !important;
        margin-bottom: 20px !important;
    }
}
</style>
@endsection