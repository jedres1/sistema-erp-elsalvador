@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-user text-primary"></i> 
                Detalle del Cliente
            </h1>
            <p class="text-muted">Información completa del cliente</p>
        </div>
        <div>
            <a href="{{ route('clientes.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver a Clientes
            </a>
            <a href="{{ route('clientes.edit', $cliente['id']) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Información del Cliente -->
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-id-card"></i> Información del Cliente
                    </h6>
                </div>
                <div class="card-body">
                    <!-- Información Fiscal -->
                    <h6 class="text-primary border-bottom pb-2 mb-3">
                        <i class="fas fa-file-alt"></i> Información Fiscal
                    </h6>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="text-muted small">Tipo de Documento</label>
                            <p class="mb-0"><strong>{{ $cliente['tipo_documento'] }}</strong></p>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted small">Número de Documento</label>
                            <p class="mb-0"><strong>{{ $cliente['numero_documento'] }}</strong></p>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted small">DUI</label>
                            <p class="mb-0"><strong>{{ $cliente['dui'] ?? 'N/A' }}</strong></p>
                        </div>
                    </div>

                    <!-- Información Empresarial -->
                    <h6 class="text-primary border-bottom pb-2 mb-3 mt-4">
                        <i class="fas fa-building"></i> Información Empresarial
                    </h6>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="text-muted small">Razón Social</label>
                            <p class="mb-0"><strong>{{ $cliente['razon_social'] }}</strong></p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small">Nombre Comercial</label>
                            <p class="mb-0"><strong>{{ $cliente['nombre_comercial'] ?? 'N/A' }}</strong></p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="text-muted small">Giro Comercial</label>
                            <p class="mb-0"><strong>{{ $cliente['giro_comercial'] ?? 'N/A' }}</strong></p>
                        </div>
                    </div>

                    <!-- Información de Contacto -->
                    <h6 class="text-primary border-bottom pb-2 mb-3 mt-4">
                        <i class="fas fa-address-book"></i> Información de Contacto
                    </h6>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="text-muted small">Teléfono</label>
                            <p class="mb-0"><strong>{{ $cliente['telefono'] ?? 'N/A' }}</strong></p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small">Email</label>
                            <p class="mb-0"><strong>{{ $cliente['email'] ?? 'N/A' }}</strong></p>
                        </div>
                    </div>

                    <!-- Ubicación -->
                    <h6 class="text-primary border-bottom pb-2 mb-3 mt-4">
                        <i class="fas fa-map-marker-alt"></i> Ubicación
                    </h6>
                    <div class="row mb-3">
                        <div class="col-12 mb-2">
                            <label class="text-muted small">Dirección</label>
                            <p class="mb-0"><strong>{{ $cliente['direccion'] ?? 'N/A' }}</strong></p>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted small">Departamento</label>
                            <p class="mb-0"><strong>{{ $cliente['departamento'] ?? 'N/A' }}</strong></p>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted small">Municipio</label>
                            <p class="mb-0"><strong>{{ $cliente['municipio'] ?? 'N/A' }}</strong></p>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted small">Distrito</label>
                            <p class="mb-0"><strong>{{ $cliente['distrito'] ?? 'N/A' }}</strong></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Historial de Facturas -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-file-invoice-dollar"></i> Historial de Facturas
                    </h6>
                </div>
                <div class="card-body">
                    @if(isset($facturas) && count($facturas) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Número</th>
                                        <th>Fecha</th>
                                        <th class="text-end">Monto</th>
                                        <th class="text-center">Estado</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($facturas as $factura)
                                    <tr>
                                        <td><strong>{{ $factura['numero'] }}</strong></td>
                                        <td>{{ \Carbon\Carbon::parse($factura['fecha'])->format('d/m/Y') }}</td>
                                        <td class="text-end">${{ number_format($factura['monto'], 2) }}</td>
                                        <td class="text-center">
                                            @if($factura['estado'] == 'Pagada')
                                                <span class="badge bg-success">
                                                    <i class="fas fa-check"></i> Pagada
                                                </span>
                                            @elseif($factura['estado'] == 'Pendiente')
                                                <span class="badge bg-warning">
                                                    <i class="fas fa-clock"></i> Pendiente
                                                </span>
                                            @else
                                                <span class="badge bg-danger">
                                                    <i class="fas fa-times"></i> Vencida
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="#" class="btn btn-sm btn-info" title="Ver Factura">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No hay facturas registradas para este cliente</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Panel Lateral -->
        <div class="col-lg-4">
            <!-- Estado del Cliente -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-info-circle"></i> Estado del Cliente
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="text-muted small">Estado</label>
                        <p class="mb-0">
                            @if($cliente['estado'] == 'Activo')
                                <span class="badge bg-success">
                                    <i class="fas fa-check-circle"></i> Activo
                                </span>
                            @else
                                <span class="badge bg-danger">
                                    <i class="fas fa-times-circle"></i> Inactivo
                                </span>
                            @endif
                        </p>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted small">Fecha de Registro</label>
                        <p class="mb-0"><strong>{{ \Carbon\Carbon::parse($cliente['fecha_registro'])->format('d/m/Y') }}</strong></p>
                    </div>
                </div>
            </div>

            <!-- Información Crediticia -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-credit-card"></i> Información Crediticia
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="text-muted small">Límite de Crédito</label>
                        <p class="mb-0">
                            <strong class="text-success fs-5">${{ number_format($cliente['credito_limite'] ?? 0, 2) }}</strong>
                        </p>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted small">Crédito Utilizado</label>
                        <p class="mb-0">
                            <strong class="text-warning fs-5">${{ number_format($cliente['credito_utilizado'] ?? 0, 2) }}</strong>
                        </p>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted small">Crédito Disponible</label>
                        <p class="mb-0">
                            <strong class="text-primary fs-5">${{ number_format(($cliente['credito_limite'] ?? 0) - ($cliente['credito_utilizado'] ?? 0), 2) }}</strong>
                        </p>
                    </div>
                    <div class="progress" style="height: 25px;">
                        @php
                            $limite = $cliente['credito_limite'] ?? 1;
                            $utilizado = $cliente['credito_utilizado'] ?? 0;
                            $porcentaje = $limite > 0 ? ($utilizado / $limite) * 100 : 0;
                        @endphp
                        <div class="progress-bar {{ $porcentaje > 80 ? 'bg-danger' : ($porcentaje > 50 ? 'bg-warning' : 'bg-success') }}" 
                             role="progressbar" 
                             style="width: {{ $porcentaje }}%"
                             aria-valuenow="{{ $porcentaje }}" 
                             aria-valuemin="0" 
                             aria-valuemax="100">
                            {{ number_format($porcentaje, 1) }}%
                        </div>
                    </div>
                </div>
            </div>

            <!-- Acciones -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-cog"></i> Acciones
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('clientes.edit', $cliente['id']) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Editar Cliente
                        </a>
                        <button type="button" class="btn btn-danger" onclick="confirmarEliminacion({{ $cliente['id'] }})">
                            <i class="fas fa-trash"></i> Eliminar Cliente
                        </button>
                        <a href="#" class="btn btn-info">
                            <i class="fas fa-file-invoice"></i> Nueva Factura
                        </a>
                        <a href="#" class="btn btn-secondary">
                            <i class="fas fa-print"></i> Imprimir Información
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmación para eliminar -->
<div class="modal fade" id="modalEliminar" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Confirmar Eliminación</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                ¿Está seguro que desea eliminar este cliente? Esta acción no se puede deshacer.
            </div>
            <div class="modal-footer">
                <form id="formEliminar" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<script>
function confirmarEliminacion(clienteId) {
    document.getElementById('formEliminar').action = `/clientes/${clienteId}`;
    new bootstrap.Modal(document.getElementById('modalEliminar')).show();
}
</script>
@endsection
