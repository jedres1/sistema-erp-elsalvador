@extends('layouts.app')

@section('title', 'Nuevo Proveedor')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-plus me-2"></i>
                            Crear Nuevo Proveedor
                        </h5>
                        <a href="{{ route('proveedores.index') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left me-1"></i>
                            Volver a Lista
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form id="formProveedor" action="{{ route('proveedores.store') }}" method="POST">
                        @csrf
                        
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
                                    <option value="NIT" {{ old('tipo_documento') == 'NIT' ? 'selected' : '' }}>NIT</option>
                                    <option value="DUI" {{ old('tipo_documento') == 'DUI' ? 'selected' : '' }}>DUI</option>
                                    <option value="Pasaporte" {{ old('tipo_documento') == 'Pasaporte' ? 'selected' : '' }}>Pasaporte</option>
                                    <option value="Carnet de Residente" {{ old('tipo_documento') == 'Carnet de Residente' ? 'selected' : '' }}>Carnet de Residente</option>
                                </select>
                                @error('tipo_documento')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="numero_documento" class="form-label">Número de Documento *</label>
                                <input type="text" class="form-control @error('numero_documento') is-invalid @enderror" 
                                       id="numero_documento" name="numero_documento" value="{{ old('numero_documento') }}" 
                                       placeholder="Ej: 0614-150393-001-2" required>
                                @error('numero_documento')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    <small id="formatoDocumento"></small>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <label for="razon_social" class="form-label">Razón Social *</label>
                                <input type="text" class="form-control @error('razon_social') is-invalid @enderror" 
                                       id="razon_social" name="razon_social" value="{{ old('razon_social') }}" 
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
                                       id="nombre_comercial" name="nombre_comercial" value="{{ old('nombre_comercial') }}" 
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
                                           id="limite_credito" name="limite_credito" value="{{ old('limite_credito', '0.00') }}" 
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
                                       id="telefono" name="telefono" value="{{ old('telefono') }}" 
                                       placeholder="Ej: 2298-5500 o 7845-6789">
                                @error('telefono')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email') }}" 
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
                                          placeholder="Dirección completa del proveedor">{{ old('direccion') }}</textarea>
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
                                    <option value="San Salvador" {{ old('departamento') == 'San Salvador' ? 'selected' : '' }}>San Salvador</option>
                                    <option value="La Libertad" {{ old('departamento') == 'La Libertad' ? 'selected' : '' }}>La Libertad</option>
                                    <option value="Santa Ana" {{ old('departamento') == 'Santa Ana' ? 'selected' : '' }}>Santa Ana</option>
                                    <option value="San Miguel" {{ old('departamento') == 'San Miguel' ? 'selected' : '' }}>San Miguel</option>
                                    <option value="Usulután" {{ old('departamento') == 'Usulután' ? 'selected' : '' }}>Usulután</option>
                                    <option value="Sonsonate" {{ old('departamento') == 'Sonsonate' ? 'selected' : '' }}>Sonsonate</option>
                                    <option value="La Paz" {{ old('departamento') == 'La Paz' ? 'selected' : '' }}>La Paz</option>
                                    <option value="Chalatenango" {{ old('departamento') == 'Chalatenango' ? 'selected' : '' }}>Chalatenango</option>
                                    <option value="Ahuachapán" {{ old('departamento') == 'Ahuachapán' ? 'selected' : '' }}>Ahuachapán</option>
                                    <option value="Cuscatlán" {{ old('departamento') == 'Cuscatlán' ? 'selected' : '' }}>Cuscatlán</option>
                                    <option value="La Unión" {{ old('departamento') == 'La Unión' ? 'selected' : '' }}>La Unión</option>
                                    <option value="Morazán" {{ old('departamento') == 'Morazán' ? 'selected' : '' }}>Morazán</option>
                                    <option value="San Vicente" {{ old('departamento') == 'San Vicente' ? 'selected' : '' }}>San Vicente</option>
                                    <option value="Cabañas" {{ old('departamento') == 'Cabañas' ? 'selected' : '' }}>Cabañas</option>
                                </select>
                                @error('departamento')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="municipio" class="form-label">Zona Geográfica/Municipio</label>
                                <select class="form-select @error('municipio') is-invalid @enderror" 
                                        id="municipio" name="municipio">
                                    <option value="">Seleccione primero el departamento...</option>
                                </select>
                                @error('municipio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="distrito" class="form-label">Distrito/Ciudad</label>
                                <select class="form-select @error('distrito') is-invalid @enderror" 
                                        id="distrito" name="distrito">
                                    <option value="">Seleccione primero la zona...</option>
                                </select>
                                @error('distrito')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
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
                                        <option value="{{ $plantilla->id }}" {{ old('plantilla_contable_id') == $plantilla->id ? 'selected' : '' }}>
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
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-save me-1"></i>
                                        Guardar Proveedor
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
$(document).ready(function() {
    // Inicializar sistema geográfico centralizado
    Geografia.inicializar({
        departamentoId: 'departamento',
        municipioId: 'municipio',
        distritoId: 'distrito'
    });

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
    $('#formProveedor').on('submit', function(e) {
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