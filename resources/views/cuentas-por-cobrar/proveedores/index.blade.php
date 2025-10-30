@extends('layouts.app')

@section('title', 'Gestión de Proveedores')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-truck me-2"></i>
                            Gestión de Proveedores
                        </h5>
                        <a href="{{ route('cuentas-por-cobrar.proveedores.create') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-plus me-1"></i>
                            Nuevo Proveedor
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Filtros -->
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                <input type="text" class="form-control" id="searchProveedor" placeholder="Buscar por nombre o documento...">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" id="filterTipoDocumento">
                                <option value="">Todos los tipos</option>
                                <option value="NIT">NIT</option>
                                <option value="DUI">DUI</option>
                                <option value="Pasaporte">Pasaporte</option>
                                <option value="Carnet de Residente">Carnet de Residente</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" id="filterDepartamento">
                                <option value="">Todos los departamentos</option>
                                <option value="San Salvador">San Salvador</option>
                                <option value="La Libertad">La Libertad</option>
                                <option value="Santa Ana">Santa Ana</option>
                                <option value="San Miguel">San Miguel</option>
                                <option value="Usulután">Usulután</option>
                                <option value="Sonsonate">Sonsonate</option>
                                <option value="La Paz">La Paz</option>
                                <option value="Chalatenango">Chalatenango</option>
                                <option value="Ahuachapán">Ahuachapán</option>
                                <option value="Cuscatlán">Cuscatlán</option>
                                <option value="La Unión">La Unión</option>
                                <option value="Morazán">Morazán</option>
                                <option value="San Vicente">San Vicente</option>
                                <option value="Cabañas">Cabañas</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-outline-secondary w-100" id="clearFilters">
                                <i class="fas fa-times"></i> Limpiar
                            </button>
                        </div>
                    </div>

                    <!-- Estadísticas -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card bg-info text-white">
                                <div class="card-body text-center">
                                    <h4>45</h4>
                                    <small>Total Proveedores</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-success text-white">
                                <div class="card-body text-center">
                                    <h4>38</h4>
                                    <small>Activos</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-warning text-white">
                                <div class="card-body text-center">
                                    <h4>$125,450.00</h4>
                                    <small>Crédito Total</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-danger text-white">
                                <div class="card-body text-center">
                                    <h4>$8,230.50</h4>
                                    <small>Pendiente Pago</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabla de proveedores -->
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="proveedoresTable">
                            <thead class="table-dark">
                                <tr>
                                    <th>Documento</th>
                                    <th>Razón Social</th>
                                    <th>Nombre Comercial</th>
                                    <th>Ubicación</th>
                                    <th>Contacto</th>
                                    <th>Límite Crédito</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <strong>0614-150393-001-2</strong><br>
                                        <small class="text-muted">NIT</small>
                                    </td>
                                    <td>DISTRIBUIDORA COMERCIAL EL SALVADOR S.A. DE C.V.</td>
                                    <td>Distribuidora El Salvador</td>
                                    <td>
                                        <i class="fas fa-map-marker-alt text-muted"></i>
                                        San Salvador<br>
                                        <small class="text-muted">Centro Histórico</small>
                                    </td>
                                    <td>
                                        <i class="fas fa-phone text-muted"></i> 2298-5500<br>
                                        <i class="fas fa-envelope text-muted"></i> ventas@distrib.com.sv
                                    </td>
                                    <td>
                                        <span class="badge bg-success">$15,000.00</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-success">Activo</span>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('cuentas-por-cobrar.proveedores.show', 1) }}" class="btn btn-outline-info" title="Ver">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('cuentas-por-cobrar.proveedores.edit', 1) }}" class="btn btn-outline-warning" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-outline-danger" title="Eliminar" onclick="eliminarProveedor(1)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>0614-280587-001-4</strong><br>
                                        <small class="text-muted">NIT</small>
                                    </td>
                                    <td>IMPORTACIONES Y EXPORTACIONES GLOBALES S.A. DE C.V.</td>
                                    <td>ImportEx Global</td>
                                    <td>
                                        <i class="fas fa-map-marker-alt text-muted"></i>
                                        La Libertad<br>
                                        <small class="text-muted">Puerto de La Libertad</small>
                                    </td>
                                    <td>
                                        <i class="fas fa-phone text-muted"></i> 2346-7890<br>
                                        <i class="fas fa-envelope text-muted"></i> info@importex.com.sv
                                    </td>
                                    <td>
                                        <span class="badge bg-warning">$25,000.00</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-success">Activo</span>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('cuentas-por-cobrar.proveedores.show', 2) }}" class="btn btn-outline-info" title="Ver">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('cuentas-por-cobrar.proveedores.edit', 2) }}" class="btn btn-outline-warning" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-outline-danger" title="Eliminar" onclick="eliminarProveedor(2)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>03458721-3</strong><br>
                                        <small class="text-muted">DUI</small>
                                    </td>
                                    <td>MARÍA ELENA RODRÍGUEZ TORRES</td>
                                    <td>Abarrotes Rodríguez</td>
                                    <td>
                                        <i class="fas fa-map-marker-alt text-muted"></i>
                                        Santa Ana<br>
                                        <small class="text-muted">Centro Comercial Santa Ana</small>
                                    </td>
                                    <td>
                                        <i class="fas fa-phone text-muted"></i> 2441-2233<br>
                                        <i class="fas fa-envelope text-muted"></i> maria.rodriguez@abarrotes.com
                                    </td>
                                    <td>
                                        <span class="badge bg-info">$8,500.00</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-success">Activo</span>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('cuentas-por-cobrar.proveedores.show', 3) }}" class="btn btn-outline-info" title="Ver">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('cuentas-por-cobrar.proveedores.edit', 3) }}" class="btn btn-outline-warning" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-outline-danger" title="Eliminar" onclick="eliminarProveedor(3)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginación -->
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div>
                            <small class="text-muted">Mostrando 1-3 de 45 proveedores</small>
                        </div>
                        <nav>
                            <ul class="pagination pagination-sm mb-0">
                                <li class="page-item disabled">
                                    <span class="page-link">Anterior</span>
                                </li>
                                <li class="page-item active">
                                    <span class="page-link">1</span>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">3</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Siguiente</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
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
                ¿Está seguro que desea eliminar este proveedor? Esta acción no se puede deshacer.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Eliminar</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Funcionalidad de búsqueda
    $('#searchProveedor').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        $('#proveedoresTable tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    // Filtros
    $('#filterTipoDocumento, #filterDepartamento').on('change', function() {
        filtrarProveedores();
    });

    // Limpiar filtros
    $('#clearFilters').on('click', function() {
        $('#searchProveedor').val('');
        $('#filterTipoDocumento').val('');
        $('#filterDepartamento').val('');
        $('#proveedoresTable tbody tr').show();
    });
});

function filtrarProveedores() {
    var tipoDocumento = $('#filterTipoDocumento').val().toLowerCase();
    var departamento = $('#filterDepartamento').val().toLowerCase();
    
    $('#proveedoresTable tbody tr').filter(function() {
        var row = $(this);
        var rowTipoDocumento = row.find('td:first small').text().toLowerCase();
        var rowDepartamento = row.find('td:nth-child(4)').text().toLowerCase();
        
        var showTipo = !tipoDocumento || rowTipoDocumento.indexOf(tipoDocumento) > -1;
        var showDepartamento = !departamento || rowDepartamento.indexOf(departamento) > -1;
        
        row.toggle(showTipo && showDepartamento);
    });
}

let proveedorAEliminar;

function eliminarProveedor(id) {
    proveedorAEliminar = id;
    $('#deleteModal').modal('show');
}

$('#confirmDelete').on('click', function() {
    // Aquí iría la lógica para eliminar el proveedor
    console.log('Eliminando proveedor ID:', proveedorAEliminar);
    
    // Simular eliminación exitosa
    $('#deleteModal').modal('hide');
    
    // Mostrar mensaje de éxito
    Swal.fire({
        title: '¡Eliminado!',
        text: 'El proveedor ha sido eliminado exitosamente.',
        icon: 'success',
        timer: 2000,
        showConfirmButton: false
    }).then(() => {
        // Recargar la página o remover la fila
        location.reload();
    });
});
</script>
@endsection