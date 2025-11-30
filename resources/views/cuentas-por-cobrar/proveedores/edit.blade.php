@extends('layouts.app')

@section('title', 'Editar Proveedor')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-edit me-2"></i>
                            Editar Proveedor
                        </h5>
                        <div>
                            <a href="{{ route('proveedores.show', 1) }}" class="btn btn-info btn-sm me-2">
                                <i class="fas fa-eye me-1"></i>
                                Ver Proveedor
                            </a>
                            <a href="{{ route('proveedores.index') }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left me-1"></i>
                                Volver a Lista
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form id="formEditarProveedor" action="{{ route('proveedores.update', 1) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <!-- Información básica -->
                        <div class="row">
                            <div class="col-12">
                                <h6 class="text-primary mb-3">
                                    <i class="fas fa-id-card"></i> Información Básica
                                </h6>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="tipo_documento" class="form-label">Tipo de Documento *</label>
                                <select class="form-select @error('tipo_documento') is-invalid @enderror" 
                                        id="tipo_documento" name="tipo_documento" required>
                                    <option value="">Seleccione...</option>
                                    <option value="NIT" {{ old('tipo_documento', 'NIT') == 'NIT' ? 'selected' : '' }}>NIT</option>
                                    <option value="DUI" {{ old('tipo_documento', 'NIT') == 'DUI' ? 'selected' : '' }}>DUI</option>
                                    <option value="Pasaporte" {{ old('tipo_documento', 'NIT') == 'Pasaporte' ? 'selected' : '' }}>Pasaporte</option>
                                    <option value="Carnet de Residente" {{ old('tipo_documento', 'NIT') == 'Carnet de Residente' ? 'selected' : '' }}>Carnet de Residente</option>
                                </select>
                                @error('tipo_documento')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="numero_documento" class="form-label">Número de Documento *</label>
                                <input type="text" class="form-control @error('numero_documento') is-invalid @enderror" 
                                       id="numero_documento" name="numero_documento" 
                                       value="{{ old('numero_documento', '0614-150393-001-2') }}" 
                                       placeholder="Ej: 0614-150393-001-2" required>
                                @error('numero_documento')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    <small id="formatoDocumento"><i class="fas fa-info-circle text-info"></i> Formato: 0000-000000-000-0</small>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <label for="razon_social" class="form-label">Razón Social *</label>
                                <input type="text" class="form-control @error('razon_social') is-invalid @enderror" 
                                       id="razon_social" name="razon_social" 
                                       value="{{ old('razon_social', 'DISTRIBUIDORA COMERCIAL EL SALVADOR S.A. DE C.V.') }}" 
                                       placeholder="Nombre completo o razón social" required>
                                @error('razon_social')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="nombre_comercial" class="form-label">Nombre Comercial</label>
                                <input type="text" class="form-control @error('nombre_comercial') is-invalid @enderror" 
                                       id="nombre_comercial" name="nombre_comercial" 
                                       value="{{ old('nombre_comercial', 'Distribuidora El Salvador') }}" 
                                       placeholder="Nombre comercial o marca">
                                @error('nombre_comercial')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="limite_credito" class="form-label">Límite de Crédito</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" step="0.01" min="0" 
                                           class="form-control @error('limite_credito') is-invalid @enderror" 
                                           id="limite_credito" name="limite_credito" 
                                           value="{{ old('limite_credito', '15000.00') }}" 
                                           placeholder="0.00">
                                    @error('limite_credito')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-12">
                                <label for="giro_search" class="form-label">Actividad Económica / Giro Comercial</label>
                                <div class="position-relative">
                                    <input type="text" 
                                           class="form-control @error('giro') is-invalid @enderror" 
                                           id="giro_search" 
                                           placeholder="Buscar por código o descripción de actividad económica..."
                                           autocomplete="off">
                                    <input type="hidden" id="giro" name="giro" value="{{ old('giro', $proveedor->giro ?? '') }}">
                                    <div id="giro_results" class="list-group position-absolute w-100" style="max-height: 300px; overflow-y: auto; z-index: 1000; display: none;"></div>
                                </div>
                                @error('giro')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    <i class="fas fa-search"></i> Escriba al menos 2 caracteres para buscar por código o descripción
                                </div>
                            </div>
                        </div>
                                           placeholder="0.00">
                                    @error('limite_credito')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Información de contacto -->
                        <div class="row">
                            <div class="col-12">
                                <h6 class="text-primary mb-3">
                                    <i class="fas fa-phone"></i> Información de Contacto
                                </h6>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="text" class="form-control @error('telefono') is-invalid @enderror" 
                                       id="telefono" name="telefono" 
                                       value="{{ old('telefono', '2298-5500') }}" 
                                       placeholder="Ej: 2298-5500 o 7845-6789">
                                @error('telefono')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" 
                                       value="{{ old('email', 'ventas@distrib.com.sv') }}" 
                                       placeholder="proveedor@empresa.com">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-12">
                                <label for="direccion" class="form-label">Dirección</label>
                                <textarea class="form-control @error('direccion') is-invalid @enderror" 
                                          id="direccion" name="direccion" rows="2" 
                                          placeholder="Dirección completa del proveedor">{{ old('direccion', 'Boulevard de Los Héroes y 25 Avenida Norte, San Salvador') }}</textarea>
                                @error('direccion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Ubicación geográfica -->
                        <div class="row">
                            <div class="col-12">
                                <h6 class="text-primary mb-3">
                                    <i class="fas fa-map-marker-alt"></i> Ubicación Geográfica
                                </h6>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-4">
                                <label for="departamento" class="form-label">Departamento</label>
                                <select class="form-select @error('departamento') is-invalid @enderror" 
                                        id="departamento" name="departamento">
                                    <option value="">Seleccione...</option>
                                    <option value="01" {{ old('departamento', '06') == '01' ? 'selected' : '' }}>01 - Ahuachapán</option>
                                    <option value="02" {{ old('departamento', '06') == '02' ? 'selected' : '' }}>02 - Santa Ana</option>
                                    <option value="03" {{ old('departamento', '06') == '03' ? 'selected' : '' }}>03 - Sonsonate</option>
                                    <option value="04" {{ old('departamento', '06') == '04' ? 'selected' : '' }}>04 - Chalatenango</option>
                                    <option value="05" {{ old('departamento', '06') == '05' ? 'selected' : '' }}>05 - La Libertad</option>
                                    <option value="06" {{ old('departamento', '06') == '06' ? 'selected' : '' }}>06 - San Salvador</option>
                                    <option value="07" {{ old('departamento', '06') == '07' ? 'selected' : '' }}>07 - Cuscatlán</option>
                                    <option value="08" {{ old('departamento', '06') == '08' ? 'selected' : '' }}>08 - La Paz</option>
                                    <option value="09" {{ old('departamento', '06') == '09' ? 'selected' : '' }}>09 - Cabañas</option>
                                    <option value="10" {{ old('departamento', '06') == '10' ? 'selected' : '' }}>10 - San Vicente</option>
                                    <option value="11" {{ old('departamento', '06') == '11' ? 'selected' : '' }}>11 - Usulután</option>
                                    <option value="12" {{ old('departamento', '06') == '12' ? 'selected' : '' }}>12 - San Miguel</option>
                                    <option value="13" {{ old('departamento', '06') == '13' ? 'selected' : '' }}>13 - Morazán</option>
                                    <option value="14" {{ old('departamento', '06') == '14' ? 'selected' : '' }}>14 - La Unión</option>
                                </select>
                                @error('departamento')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="municipio" class="form-label">Municipio</label>
                                <select class="form-select @error('municipio') is-invalid @enderror" 
                                        id="municipio" name="municipio">
                                    <option value="">Seleccione primero el departamento...</option>
                                </select>
                                @error('municipio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="distrito" class="form-label">Distrito</label>
                                <select class="form-select @error('distrito') is-invalid @enderror" 
                                        id="distrito" name="distrito">
                                    <option value="">Seleccione primero el municipio...</option>
                                </select>
                                @error('distrito')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Información adicional -->
                        <div class="row">
                            <div class="col-12">
                                <h6 class="text-primary mb-3">
                                    <i class="fas fa-chart-line"></i> Información Comercial
                                </h6>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-4">
                                <label class="form-label">Fecha de Registro</label>
                                <input type="text" class="form-control" value="15 de marzo, 2024" readonly>
                                <small class="form-text text-muted">Fecha de creación del proveedor</small>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Última Compra</label>
                                <input type="text" class="form-control" value="08 de enero, 2025" readonly>
                                <small class="form-text text-muted">Última transacción registrada</small>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Total Compras</label>
                                <input type="text" class="form-control" value="$45,230.75" readonly>
                                <small class="form-text text-muted">Monto total histórico</small>
                            </div>
                        </div>

                        <!-- Estado del proveedor -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="estado" class="form-label">Estado del Proveedor</label>
                                <select class="form-select" id="estado" name="estado">
                                    <option value="activo" {{ old('estado', 'activo') == 'activo' ? 'selected' : '' }}>Activo</option>
                                    <option value="inactivo" {{ old('estado', 'activo') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                                    <option value="suspendido" {{ old('estado', 'activo') == 'suspendido' ? 'selected' : '' }}>Suspendido</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="observaciones" class="form-label">Observaciones</label>
                                <textarea class="form-control" id="observaciones" name="observaciones" rows="3" 
                                          placeholder="Notas adicionales sobre el proveedor">{{ old('observaciones', 'Proveedor confiable con historial de pagos puntuales.') }}</textarea>
                            </div>
                        </div>

                        <!-- Configuración Contable -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <h6 class="text-primary mb-3">
                                    <i class="fas fa-book"></i> Configuración Contable
                                </h6>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-12">
                                <label for="plantilla_contable_id" class="form-label">
                                    Plantilla Contable
                                    <i class="fas fa-info-circle text-info" 
                                       data-bs-toggle="tooltip" 
                                       title="Seleccione la plantilla contable que se aplicará automáticamente a las transacciones con este proveedor"></i>
                                </label>
                                <select class="form-select @error('plantilla_contable_id') is-invalid @enderror" 
                                        id="plantilla_contable_id" name="plantilla_contable_id">
                                    <option value="">Sin plantilla asignada</option>
                                    @foreach(\App\Models\PlantillaContable::where('tipo', 'proveedor')->get() as $plantilla)
                                        <option value="{{ $plantilla->id }}" {{ old('plantilla_contable_id', 2) == $plantilla->id ? 'selected' : '' }}>
                                            {{ $plantilla->nombre }} - {{ $plantilla->descripcion }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('plantilla_contable_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    <i class="fas fa-lightbulb"></i> 
                                    Esta plantilla define las cuentas contables que se usarán automáticamente en compras y pagos.
                                    <a href="{{ route('plantillas-contables.index') }}" target="_blank" class="ms-2">
                                        <i class="fas fa-external-link-alt"></i> Administrar plantillas
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('proveedores.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times me-1"></i>
                                        Cancelar
                                    </a>
                                    <button type="submit" class="btn btn-warning">
                                        <i class="fas fa-save me-1"></i>
                                        Actualizar Proveedor
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/geografia.js') }}"></script>
<script>
// Cargar actividades económicas
let actividadesEconomicas = [];
const valorActual = '{{ old("giro", $proveedor->giro ?? "") }}';

async function cargarActividadesEconomicas() {
    try {
        const response = await fetch('/js/actividades-economicas.json');
        actividadesEconomicas = await response.json();
        
        // Preseleccionar valor actual
        const actividadActual = actividadesEconomicas.find(a => a.codigo === valorActual);
        if (actividadActual) {
            document.getElementById('giro_search').value = `${actividadActual.codigo} - ${actividadActual.descripcion}`;
        }
    } catch (error) {
        console.error('Error cargando actividades económicas:', error);
    }
}

// Función de búsqueda de actividades económicas
function buscarActividadesEconomicas(query) {
    if (query.length < 2) return [];
    
    const searchTerm = query.toLowerCase();
    return actividadesEconomicas.filter(actividad => {
        const codigo = actividad.codigo.toLowerCase();
        const descripcion = actividad.descripcion.toLowerCase();
        return codigo.includes(searchTerm) || descripcion.includes(searchTerm);
    }).slice(0, 50); // Limitar a 50 resultados
}

function mostrarResultados(resultados) {
    const resultsDiv = document.getElementById('giro_results');
    resultsDiv.innerHTML = '';
    
    if (resultados.length === 0) {
        resultsDiv.style.display = 'none';
        return;
    }
    
    resultados.forEach(actividad => {
        const item = document.createElement('a');
        item.href = '#';
        item.className = 'list-group-item list-group-item-action';
        item.innerHTML = `<strong>${actividad.codigo}</strong> - ${actividad.descripcion}`;
        item.onclick = function(e) {
            e.preventDefault();
            seleccionarActividad(actividad);
        };
        resultsDiv.appendChild(item);
    });
    
    resultsDiv.style.display = 'block';
}

function seleccionarActividad(actividad) {
    document.getElementById('giro_search').value = `${actividad.codigo} - ${actividad.descripcion}`;
    document.getElementById('giro').value = actividad.codigo;
    document.getElementById('giro_results').style.display = 'none';
}

// Initialize geographic data module
document.addEventListener('DOMContentLoaded', function() {
    Geografia.inicializar({
        departamentoId: 'departamento',
        municipioId: 'municipio',
        distritoId: 'distrito',
        valoresActuales: {
            departamento: '{{ $proveedor->departamento }}',
            municipio: '{{ $proveedor->municipio }}',
            distrito: '{{ $proveedor->distrito }}'
        }
    });
    
    // Cargar actividades económicas
    cargarActividadesEconomicas();
    
    // Configurar buscador de actividades económicas
    const giroSearch = document.getElementById('giro_search');
    
    giroSearch.addEventListener('input', function(e) {
        const query = e.target.value;
        const resultados = buscarActividadesEconomicas(query);
        mostrarResultados(resultados);
    });
    
    giroSearch.addEventListener('blur', function() {
        setTimeout(() => {
            document.getElementById('giro_results').style.display = 'none';
        }, 200);
    });
    
    giroSearch.addEventListener('focus', function() {
        if (this.value.length >= 2) {
            const resultados = buscarActividadesEconomicas(this.value);
            mostrarResultados(resultados);
        }
    });
});

$(document).ready(function() {

    // Actualizar formato según tipo de documento
    $('#tipo_documento').on('change', function() {
        const tipo = $(this).val();
        const formatoDiv = $('#formatoDocumento');
        
        switch(tipo) {
            case 'NIT':
                formatoDiv.html('<i class="fas fa-info-circle text-info"></i> Formato: 0000-000000-000-0');
                $('#numero_documento').attr('placeholder', 'Ej: 0614-150393-001-2');
                break;
            case 'DUI':
                formatoDiv.html('<i class="fas fa-info-circle text-info"></i> Formato: 00000000-0');
                $('#numero_documento').attr('placeholder', 'Ej: 03458721-3');
                break;
            case 'Pasaporte':
                formatoDiv.html('<i class="fas fa-info-circle text-info"></i> Formato: Alfanumérico');
                $('#numero_documento').attr('placeholder', 'Ej: A1234567');
                break;
            case 'Carnet de Residente':
                formatoDiv.html('<i class="fas fa-info-circle text-info"></i> Formato: 000000000');
                $('#numero_documento').attr('placeholder', 'Ej: 123456789');
                break;
            default:
                formatoDiv.html('');
                $('#numero_documento').attr('placeholder', '');
        }
    });

    // Validación del formulario
    $('#formEditarProveedor').on('submit', function(e) {
        let valid = true;
        const tipoDocumento = $('#tipo_documento').val();
        const numeroDocumento = $('#numero_documento').val();
        
        // Validar formato de documento
        if (tipoDocumento && numeroDocumento) {
            let patron;
            switch(tipoDocumento) {
                case 'NIT':
                    patron = /^\d{4}-\d{6}-\d{3}-\d$/;
                    break;
                case 'DUI':
                    patron = /^\d{8}-\d$/;
                    break;
            }
            
            if (patron && !patron.test(numeroDocumento)) {
                $('#numero_documento').addClass('is-invalid');
                $('#numero_documento').siblings('.invalid-feedback').remove();
                $('#numero_documento').after('<div class="invalid-feedback">Formato de documento inválido</div>');
                valid = false;
            }
        }

        if (!valid) {
            e.preventDefault();
        }
    });
});
</script>
@endsection