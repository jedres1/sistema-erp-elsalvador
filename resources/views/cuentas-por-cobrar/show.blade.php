@extends('layouts.app')

@section('title', 'Detalle Cuenta por Cobrar')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('cuentas-por-cobrar.index') }}">Cuentas por Cobrar</a></li>
                    <li class="breadcrumb-item active">{{ $cuenta['numero_factura'] }}</li>
                </ol>
            </nav>
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h3 mb-0">
                    <i class="fas fa-eye text-primary"></i>
                    Detalle de Cuenta por Cobrar
                </h2>
                <a href="{{ route('cuentas-por-cobrar.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i>
                    Volver
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Información de la Cuenta -->
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle"></i>
                        Información de la Cuenta
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td class="fw-bold">Número de Factura:</td>
                                    <td>{{ $cuenta['numero_factura'] }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Cliente:</td>
                                    <td>{{ $cuenta['cliente'] }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Documento:</td>
                                    <td>{{ $cuenta['cliente_documento'] }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Tipo de Documento:</td>
                                    <td>{{ $cuenta['documento_tipo'] }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Fecha de Emisión:</td>
                                    <td>{{ \Carbon\Carbon::parse($cuenta['fecha_emision'])->format('d/m/Y') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td class="fw-bold">Fecha de Vencimiento:</td>
                                    <td>{{ \Carbon\Carbon::parse($cuenta['fecha_vencimiento'])->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Monto Original:</td>
                                    <td class="fs-5">${{ number_format($cuenta['monto_original'], 2) }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Monto Pagado:</td>
                                    <td class="fs-5 text-success">${{ number_format($cuenta['monto_pagado'], 2) }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Saldo Pendiente:</td>
                                    <td class="fs-4 fw-bold text-primary">${{ number_format($cuenta['saldo_pendiente'], 2) }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Estado:</td>
                                    <td>
                                        @switch($cuenta['estado'])
                                            @case('Pagada')
                                                <span class="badge bg-success fs-6">{{ $cuenta['estado'] }}</span>
                                                @break
                                            @case('Pendiente')
                                                <span class="badge bg-primary fs-6">{{ $cuenta['estado'] }}</span>
                                                @break
                                            @case('Parcial')
                                                <span class="badge bg-warning fs-6">{{ $cuenta['estado'] }}</span>
                                                @break
                                            @case('Vencida')
                                                <span class="badge bg-danger fs-6">{{ $cuenta['estado'] }}</span>
                                                @break
                                        @endswitch
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    @if($cuenta['observaciones'])
                    <div class="row">
                        <div class="col-12">
                            <hr>
                            <h6 class="fw-bold">Observaciones:</h6>
                            <p class="text-muted">{{ $cuenta['observaciones'] }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Historial de Pagos -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-history"></i>
                        Historial de Pagos
                    </h5>
                    @if($cuenta['saldo_pendiente'] > 0)
                    <button class="btn btn-success btn-sm" onclick="mostrarModalPago({{ $cuenta['id'] }})">
                        <i class="fas fa-plus"></i>
                        Registrar Pago
                    </button>
                    @endif
                </div>
                <div class="card-body">
                    @if(count($historialPagos) > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Fecha</th>
                                    <th>Monto</th>
                                    <th>Método de Pago</th>
                                    <th>Referencia</th>
                                    <th>Observaciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($historialPagos as $pago)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($pago['fecha_pago'])->format('d/m/Y') }}</td>
                                    <td class="fw-bold text-success">${{ number_format($pago['monto'], 2) }}</td>
                                    <td>{{ $pago['metodo_pago'] }}</td>
                                    <td>{{ $pago['referencia'] ?: '-' }}</td>
                                    <td>{{ $pago['observaciones'] ?: '-' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-4">
                        <i class="fas fa-receipt fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No hay pagos registrados para esta cuenta</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Panel de Acciones -->
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-cogs"></i>
                        Acciones Disponibles
                    </h5>
                </div>
                <div class="card-body">
                    @if($cuenta['saldo_pendiente'] > 0)
                    <div class="d-grid gap-2 mb-3">
                        <button class="btn btn-success" onclick="mostrarModalPago({{ $cuenta['id'] }})">
                            <i class="fas fa-dollar-sign"></i>
                            Registrar Pago
                        </button>
                        <button class="btn btn-info" onclick="enviarRecordatorio({{ $cuenta['id'] }})">
                            <i class="fas fa-envelope"></i>
                            Enviar Recordatorio
                        </button>
                    </div>
                    @endif
                    
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-primary">
                            <i class="fas fa-print"></i>
                            Imprimir Estado de Cuenta
                        </button>
                        <button class="btn btn-outline-secondary">
                            <i class="fas fa-file-pdf"></i>
                            Exportar PDF
                        </button>
                    </div>
                </div>
            </div>

            <!-- Información de Vencimiento -->
            @if($cuenta['dias_vencido'] > 0)
            <div class="card border-danger">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-exclamation-triangle"></i>
                        Cuenta Vencida
                    </h5>
                </div>
                <div class="card-body">
                    <p class="mb-1"><strong>Días vencidos:</strong> {{ $cuenta['dias_vencido'] }}</p>
                    <p class="mb-0 text-muted">Esta cuenta requiere atención inmediata</p>
                </div>
            </div>
            @elseif($cuenta['saldo_pendiente'] > 0)
            <div class="card border-warning">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">
                        <i class="fas fa-clock"></i>
                        Cuenta Pendiente
                    </h5>
                </div>
                <div class="card-body">
                    <p class="mb-1"><strong>Vence el:</strong> {{ \Carbon\Carbon::parse($cuenta['fecha_vencimiento'])->format('d/m/Y') }}</p>
                    <p class="mb-0 text-muted">
                        Faltan {{ \Carbon\Carbon::parse($cuenta['fecha_vencimiento'])->diffInDays(\Carbon\Carbon::now()) }} días para el vencimiento
                    </p>
                </div>
            </div>
            @else
            <div class="card border-success">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-check-circle"></i>
                        Cuenta Pagada
                    </h5>
                </div>
                <div class="card-body">
                    <p class="mb-0 text-muted">Esta cuenta ha sido pagada completamente</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal para registrar pago -->
<div class="modal fade" id="modalRegistrarPago" tabindex="-1" aria-labelledby="modalRegistrarPagoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalRegistrarPagoLabel">
                    <i class="fas fa-dollar-sign text-success"></i>
                    Registrar Pago
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formRegistrarPago" method="POST" action="{{ route('cuentas-por-cobrar.registrar-pago', $cuenta['id']) }}">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-info">
                        <strong>Saldo pendiente:</strong> ${{ number_format($cuenta['saldo_pendiente'], 2) }}
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Monto *</label>
                                <input type="number" class="form-control" name="monto" step="0.01" min="0.01" 
                                       max="{{ $cuenta['saldo_pendiente'] }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Fecha de Pago *</label>
                                <input type="date" class="form-control" name="fecha_pago" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Método de Pago *</label>
                                <select class="form-select" name="metodo_pago" required>
                                    <option value="">Seleccionar...</option>
                                    <option value="Efectivo">Efectivo</option>
                                    <option value="Transferencia Bancaria">Transferencia Bancaria</option>
                                    <option value="Cheque">Cheque</option>
                                    <option value="Tarjeta de Crédito">Tarjeta de Crédito</option>
                                    <option value="Tarjeta de Débito">Tarjeta de Débito</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Referencia</label>
                                <input type="text" class="form-control" name="referencia" maxlength="100">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Observaciones</label>
                        <textarea class="form-control" name="observaciones" rows="3" maxlength="500"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Registrar Pago
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function mostrarModalPago(cuentaId) {
    // Establecer fecha actual
    document.querySelector('input[name="fecha_pago"]').value = new Date().toISOString().split('T')[0];
    
    // Mostrar modal
    const modal = new bootstrap.Modal(document.getElementById('modalRegistrarPago'));
    modal.show();
}

function enviarRecordatorio(cuentaId) {
    if (confirm('¿Está seguro de enviar un recordatorio de pago al cliente?')) {
        fetch(`/cuentas-por-cobrar/${cuentaId}/recordatorio`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            if (response.ok) {
                alert('Recordatorio enviado exitosamente');
            } else {
                alert('Error al enviar el recordatorio');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al enviar el recordatorio');
        });
    }
}
</script>
@endsection