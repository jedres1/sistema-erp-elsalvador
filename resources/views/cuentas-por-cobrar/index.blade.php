@extends('layouts.app')

@section('title', 'Cuentas por Cobrar')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h3 mb-0">
                    <i class="fas fa-hand-holding-usd text-success"></i>
                    Cuentas por Cobrar
                </h2>
                <div>
                    <a href="{{ route('cuentas-por-cobrar.reporte-antiguedad') }}" class="btn btn-outline-info me-2">
                        <i class="fas fa-chart-bar"></i>
                        Reporte de Antigüedad
                    </a>
                    <a href="{{ route('cuentas-por-cobrar.exportar-excel') }}" class="btn btn-outline-success">
                        <i class="fas fa-file-excel"></i>
                        Exportar Excel
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Tarjetas de Estadísticas -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title text-white-50 mb-0">Total por Cobrar</h6>
                            <h3 class="mb-0">${{ number_format($estadisticas['total_por_cobrar'], 2) }}</h3>
                        </div>
                        <i class="fas fa-money-bill-wave fa-2x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm bg-danger text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title text-white-50 mb-0">Vencido</h6>
                            <h3 class="mb-0">${{ number_format($estadisticas['total_vencido'], 2) }}</h3>
                        </div>
                        <i class="fas fa-exclamation-triangle fa-2x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title text-white-50 mb-0">Al Día</h6>
                            <h3 class="mb-0">${{ number_format($estadisticas['total_al_dia'], 2) }}</h3>
                        </div>
                        <i class="fas fa-check-circle fa-2x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title text-white-50 mb-0">Facturas Pendientes</h6>
                            <h3 class="mb-0">{{ $estadisticas['facturas_pendientes'] }}</h3>
                        </div>
                        <i class="fas fa-file-invoice fa-2x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtros -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-filter"></i>
                        Filtros de Búsqueda
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-label">Cliente</label>
                            <input type="text" class="form-control" id="filtroCliente" placeholder="Buscar cliente...">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Estado</label>
                            <select class="form-select" id="filtroEstado">
                                <option value="">Todos los estados</option>
                                <option value="Pendiente">Pendiente</option>
                                <option value="Parcial">Parcial</option>
                                <option value="Vencida">Vencida</option>
                                <option value="Pagada">Pagada</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Desde</label>
                            <input type="date" class="form-control" id="filtroFechaDesde">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Hasta</label>
                            <input type="date" class="form-control" id="filtroFechaHasta">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de Cuentas por Cobrar -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-list"></i>
                        Listado de Cuentas por Cobrar
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle" id="tablaCuentasPorCobrar">
                            <thead class="table-dark">
                                <tr>
                                    <th>Factura</th>
                                    <th>Cliente</th>
                                    <th>Fecha Emisión</th>
                                    <th>Fecha Vencimiento</th>
                                    <th>Monto Original</th>
                                    <th>Pagado</th>
                                    <th>Saldo Pendiente</th>
                                    <th>Estado</th>
                                    <th>Días Vencido</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cuentasPorCobrar as $cuenta)
                                <tr>
                                    <td>
                                        <span class="fw-bold">{{ $cuenta['numero_factura'] }}</span><br>
                                        <small class="text-muted">{{ $cuenta['documento_tipo'] }}</small>
                                    </td>
                                    <td>{{ $cuenta['cliente'] }}</td>
                                    <td>{{ \Carbon\Carbon::parse($cuenta['fecha_emision'])->format('d/m/Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($cuenta['fecha_vencimiento'])->format('d/m/Y') }}</td>
                                    <td>${{ number_format($cuenta['monto_original'], 2) }}</td>
                                    <td>${{ number_format($cuenta['monto_pagado'], 2) }}</td>
                                    <td>
                                        <span class="fw-bold">${{ number_format($cuenta['saldo_pendiente'], 2) }}</span>
                                    </td>
                                    <td>
                                        @switch($cuenta['estado'])
                                            @case('Pagada')
                                                <span class="badge bg-success">{{ $cuenta['estado'] }}</span>
                                                @break
                                            @case('Pendiente')
                                                <span class="badge bg-primary">{{ $cuenta['estado'] }}</span>
                                                @break
                                            @case('Parcial')
                                                <span class="badge bg-warning">{{ $cuenta['estado'] }}</span>
                                                @break
                                            @case('Vencida')
                                                <span class="badge bg-danger">{{ $cuenta['estado'] }}</span>
                                                @break
                                        @endswitch
                                    </td>
                                    <td>
                                        @if($cuenta['dias_vencido'] > 0)
                                            <span class="text-danger fw-bold">{{ $cuenta['dias_vencido'] }} días</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('cuentas-por-cobrar.show', $cuenta['id']) }}" 
                                               class="btn btn-outline-primary" title="Ver detalles">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if($cuenta['saldo_pendiente'] > 0)
                                            <button class="btn btn-outline-success" 
                                                    onclick="mostrarModalPago({{ $cuenta['id'] }})" title="Registrar pago">
                                                <i class="fas fa-dollar-sign"></i>
                                            </button>
                                            <button class="btn btn-outline-info" 
                                                    onclick="enviarRecordatorio({{ $cuenta['id'] }})" title="Enviar recordatorio">
                                                <i class="fas fa-envelope"></i>
                                            </button>
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
            <form id="formRegistrarPago" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Monto *</label>
                                <input type="number" class="form-control" name="monto" step="0.01" min="0.01" required>
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
    const form = document.getElementById('formRegistrarPago');
    form.action = `/cuentas-por-cobrar/${cuentaId}/pago`;
    
    // Limpiar formulario
    form.reset();
    
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
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Recordatorio enviado exitosamente');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al enviar el recordatorio');
        });
    }
}

// Filtros
document.addEventListener('DOMContentLoaded', function() {
    const filtroCliente = document.getElementById('filtroCliente');
    const filtroEstado = document.getElementById('filtroEstado');
    const tabla = document.getElementById('tablaCuentasPorCobrar');
    
    function filtrarTabla() {
        const filas = tabla.querySelectorAll('tbody tr');
        const cliente = filtroCliente.value.toLowerCase();
        const estado = filtroEstado.value;
        
        filas.forEach(fila => {
            const textoCliente = fila.children[1].textContent.toLowerCase();
            const textoEstado = fila.children[7].textContent.trim();
            
            const coincideCliente = cliente === '' || textoCliente.includes(cliente);
            const coincideEstado = estado === '' || textoEstado.includes(estado);
            
            fila.style.display = coincideCliente && coincideEstado ? '' : 'none';
        });
    }
    
    filtroCliente.addEventListener('input', filtrarTabla);
    filtroEstado.addEventListener('change', filtrarTabla);
});
</script>
@endsection