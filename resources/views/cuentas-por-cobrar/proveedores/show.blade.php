@extends('layouts.app')

@section('title', 'Detalle del Proveedor')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-truck me-2"></i>
                            Detalle del Proveedor
                        </h5>
                        <div class="btn-group" role="group">
                            <a href="{{ route('cuentas-por-cobrar.proveedores.edit', 1) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit me-1"></i>
                                Editar
                            </a>
                            <a href="{{ route('cuentas-por-cobrar.proveedores.index') }}" class="btn btn-light btn-sm">
                                <i class="fas fa-arrow-left me-1"></i>
                                Volver a Lista
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Información principal -->
                        <div class="col-lg-8">
                            <!-- Datos básicos -->
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">
                                        <i class="fas fa-id-card text-primary"></i>
                                        Información Básica
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td class="text-muted fw-bold">Tipo de Documento:</td>
                                                    <td>
                                                        <span class="badge bg-primary">NIT</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted fw-bold">Número:</td>
                                                    <td class="fw-bold">0614-150393-001-2</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted fw-bold">Razón Social:</td>
                                                    <td class="fw-bold">DISTRIBUIDORA COMERCIAL EL SALVADOR S.A. DE C.V.</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted fw-bold">Nombre Comercial:</td>
                                                    <td>Distribuidora El Salvador</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td class="text-muted fw-bold">Estado:</td>
                                                    <td>
                                                        <span class="badge bg-success">Activo</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted fw-bold">Límite de Crédito:</td>
                                                    <td class="fw-bold text-success">$15,000.00</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted fw-bold">Fecha de Registro:</td>
                                                    <td>15 de marzo, 2024</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted fw-bold">Última Actualización:</td>
                                                    <td>08 de enero, 2025</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Información de contacto -->
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">
                                        <i class="fas fa-address-card text-success"></i>
                                        Información de Contacto
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center mb-3">
                                                <i class="fas fa-phone text-primary me-3"></i>
                                                <div>
                                                    <strong>Teléfono:</strong><br>
                                                    <span>2298-5500</span>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center mb-3">
                                                <i class="fas fa-envelope text-primary me-3"></i>
                                                <div>
                                                    <strong>Email:</strong><br>
                                                    <a href="mailto:ventas@distrib.com.sv">ventas@distrib.com.sv</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-start">
                                                <i class="fas fa-map-marker-alt text-primary me-3 mt-1"></i>
                                                <div>
                                                    <strong>Dirección:</strong><br>
                                                    <span>Boulevard de Los Héroes y 25 Avenida Norte, San Salvador</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Ubicación geográfica -->
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">
                                        <i class="fas fa-globe text-warning"></i>
                                        Ubicación Geográfica
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="text-center">
                                                <i class="fas fa-map text-primary fs-3"></i>
                                                <h6 class="mt-2">Departamento</h6>
                                                <span class="badge bg-info">San Salvador</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="text-center">
                                                <i class="fas fa-compass text-success fs-3"></i>
                                                <h6 class="mt-2">Zona Geográfica</h6>
                                                <span class="badge bg-success">Zona Metropolitana de San Salvador</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="text-center">
                                                <i class="fas fa-city text-warning fs-3"></i>
                                                <h6 class="mt-2">Ciudad/Distrito</h6>
                                                <span class="badge bg-warning">San Salvador</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Historial de transacciones -->
                            <div class="card">
                                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0">
                                        <i class="fas fa-history text-info"></i>
                                        Historial de Transacciones
                                    </h6>
                                    <button class="btn btn-outline-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#historialTransacciones">
                                        <i class="fas fa-chevron-down"></i>
                                    </button>
                                </div>
                                <div class="collapse show" id="historialTransacciones">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-sm table-striped">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th>Fecha</th>
                                                        <th>Tipo</th>
                                                        <th>Documento</th>
                                                        <th>Monto</th>
                                                        <th>Estado</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>08/01/2025</td>
                                                        <td><span class="badge bg-success">Compra</span></td>
                                                        <td>FACT-001234</td>
                                                        <td>$2,450.00</td>
                                                        <td><span class="badge bg-success">Pagado</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>28/12/2024</td>
                                                        <td><span class="badge bg-success">Compra</span></td>
                                                        <td>FACT-001198</td>
                                                        <td>$1,850.75</td>
                                                        <td><span class="badge bg-success">Pagado</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>15/12/2024</td>
                                                        <td><span class="badge bg-warning">Nota Crédito</span></td>
                                                        <td>NC-000087</td>
                                                        <td>-$125.00</td>
                                                        <td><span class="badge bg-info">Aplicada</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>10/12/2024</td>
                                                        <td><span class="badge bg-success">Compra</span></td>
                                                        <td>FACT-001156</td>
                                                        <td>$3,225.50</td>
                                                        <td><span class="badge bg-success">Pagado</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>25/11/2024</td>
                                                        <td><span class="badge bg-success">Compra</span></td>
                                                        <td>FACT-001089</td>
                                                        <td>$1,975.25</td>
                                                        <td><span class="badge bg-success">Pagado</span></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="text-center mt-3">
                                            <a href="#" class="btn btn-outline-info btn-sm">
                                                <i class="fas fa-history me-1"></i>
                                                Ver Historial Completo
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Panel lateral -->
                        <div class="col-lg-4">
                            <!-- Estadísticas -->
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">
                                        <i class="fas fa-chart-bar text-primary"></i>
                                        Estadísticas Comerciales
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="text-center mb-3">
                                        <h4 class="text-primary mb-1">$45,230.75</h4>
                                        <small class="text-muted">Total Compras Históricas</small>
                                    </div>
                                    
                                    <div class="row text-center">
                                        <div class="col-6">
                                            <div class="border-end">
                                                <h5 class="text-success mb-1">28</h5>
                                                <small class="text-muted">Transacciones</small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <h5 class="text-warning mb-1">$1,615.38</h5>
                                            <small class="text-muted">Promedio/Mes</small>
                                        </div>
                                    </div>
                                    
                                    <hr>
                                    
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between">
                                            <small>Crédito Utilizado:</small>
                                            <small>$8,230.50 / $15,000.00</small>
                                        </div>
                                        <div class="progress" style="height: 8px;">
                                            <div class="progress-bar bg-success" style="width: 55%"></div>
                                        </div>
                                        <small class="text-muted">55% del límite disponible</small>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between">
                                            <small>Días promedio de pago:</small>
                                            <small class="text-success">18 días</small>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between">
                                            <small>Última compra:</small>
                                            <small>Hace 2 días</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Estado del crédito -->
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">
                                        <i class="fas fa-credit-card text-warning"></i>
                                        Estado del Crédito
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span>Límite Total:</span>
                                        <span class="fw-bold text-primary">$15,000.00</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span>Utilizado:</span>
                                        <span class="fw-bold text-warning">$8,230.50</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span>Disponible:</span>
                                        <span class="fw-bold text-success">$6,769.50</span>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>Calificación:</span>
                                        <span class="badge bg-success">Excelente</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Acciones rápidas -->
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">
                                        <i class="fas fa-bolt text-danger"></i>
                                        Acciones Rápidas
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-file-invoice me-1"></i>
                                            Nueva Compra
                                        </button>
                                        <button class="btn btn-outline-success btn-sm">
                                            <i class="fas fa-dollar-sign me-1"></i>
                                            Registrar Pago
                                        </button>
                                        <button class="btn btn-outline-warning btn-sm">
                                            <i class="fas fa-credit-card me-1"></i>
                                            Ajustar Crédito
                                        </button>
                                        <button class="btn btn-outline-info btn-sm">
                                            <i class="fas fa-envelope me-1"></i>
                                            Enviar Estado
                                        </button>
                                        <hr>
                                        <button class="btn btn-outline-danger btn-sm" onclick="confirmarSuspension()">
                                            <i class="fas fa-ban me-1"></i>
                                            Suspender Proveedor
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmación de suspensión -->
<div class="modal fade" id="suspensionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Suspender Proveedor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>¿Está seguro que desea suspender a este proveedor?</p>
                <p class="text-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    Esta acción impedirá que se registren nuevas compras hasta que se reactive.
                </p>
                <div class="mb-3">
                    <label for="motivoSuspension" class="form-label">Motivo de la suspensión:</label>
                    <textarea class="form-control" id="motivoSuspension" rows="3" placeholder="Ingrese el motivo..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" onclick="ejecutarSuspension()">Suspender</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
function confirmarSuspension() {
    $('#suspensionModal').modal('show');
}

function ejecutarSuspension() {
    const motivo = $('#motivoSuspension').val();
    
    if (!motivo.trim()) {
        Swal.fire({
            title: 'Error',
            text: 'Debe proporcionar un motivo para la suspensión.',
            icon: 'error'
        });
        return;
    }
    
    // Aquí iría la lógica para suspender el proveedor
    console.log('Suspendiendo proveedor. Motivo:', motivo);
    
    $('#suspensionModal').modal('hide');
    
    Swal.fire({
        title: '¡Proveedor Suspendido!',
        text: 'El proveedor ha sido suspendido exitosamente.',
        icon: 'success',
        timer: 2000,
        showConfirmButton: false
    }).then(() => {
        // Recargar o actualizar estado
        location.reload();
    });
}

// Tooltip para badges y elementos informativos
$(document).ready(function() {
    $('[data-bs-toggle="tooltip"]').tooltip();
    
    // Animación para las estadísticas
    $('.text-primary, .text-success, .text-warning').each(function() {
        $(this).hover(
            function() { $(this).addClass('fw-bold'); },
            function() { $(this).removeClass('fw-bold'); }
        );
    });
});
</script>
@endsection