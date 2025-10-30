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
                        <a href="{{ route('cuentas-por-cobrar.proveedores.index') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left me-1"></i>
                            Volver a Lista
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form id="formProveedor" action="{{ route('cuentas-por-cobrar.proveedores.store') }}" method="POST">
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

                        <!-- Botones -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('cuentas-por-cobrar.proveedores.index') }}" class="btn btn-secondary">
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
<script>
$(document).ready(function() {
    // Datos geográficos de El Salvador
    const geografiaElSalvador = {
        'San Salvador': {
            'Zona Metropolitana de San Salvador': ['San Salvador', 'Mejicanos', 'Soyapango', 'Delgado', 'Ilopango', 'San Marcos', 'Tonacatepeque', 'Ayutuxtepeque', 'Apopa', 'Nejapa', 'Cuscatancingo', 'San Martín'],
            'Zona Norte de San Salvador': ['Aguilares', 'El Paisnal', 'Guazapa'],
            'Zona Sur de San Salvador': ['Panchimalco', 'Rosario de Mora', 'San Antonio Abad', 'Candelaria', 'San Marcos', 'Escalón', 'Flor Blanca']
        },
        'La Libertad': {
            'Zona Costera': ['La Libertad', 'Puerto de La Libertad', 'Tamanique', 'Teotepeque', 'Tepecoyo', 'Talnique'],
            'Zona Central': ['Santa Tecla', 'Antiguo Cuscatlán', 'Huizúcar', 'Nuevo Cuscatlán'],
            'Zona Norte': ['Quezaltepeque', 'San Pablo Tacachico', 'Jayaque', 'Sacacoyo', 'San José Villanueva']
        },
        'Santa Ana': {
            'Zona Central de Santa Ana': ['Santa Ana', 'Coatepeque', 'El Congo'],
            'Zona Norte': ['Chalchuapa', 'El Porvenir', 'Masahuat', 'Metapán', 'San Antonio Pajonal', 'San Sebastián Salitrillo', 'Santiago de la Frontera', 'Texistepeque'],
            'Zona Sur': ['Candelaria de la Frontera', 'Santa Rosa Guachipilín', 'Casitas']
        },
        'San Miguel': {
            'Zona Central': ['San Miguel', 'Carolina', 'Ciudad Barrios', 'Comacarán', 'Chapeltique', 'Nueva Guadalupe'],
            'Zona Norte': ['Sesori', 'San Gerardo', 'Lolotique', 'Moncagua', 'Quelepa'],
            'Zona Este': ['Chirilagua', 'San Jorge', 'Uluazapa']
        },
        'Usulután': {
            'Zona Central': ['Usulután', 'Jucuapa', 'Concepción Batres', 'Santa Elena', 'Ereguayquín'],
            'Zona Costera': ['Jiquilisco', 'Puerto El Triunfo', 'San Dionisio'],
            'Zona Norte': ['Alegría', 'Berlín', 'Mercedes Umaña', 'Nueva Granada', 'Santiago de María', 'California', 'Tecapán', 'El Triunfo']
        },
        'Sonsonate': {
            'Zona Central': ['Sonsonate', 'Armenia', 'Caluco', 'Izalco', 'Juayúa', 'Nahuizalco', 'Nahulingo', 'Salcoatitán', 'San Antonio del Monte', 'Santa Catarina Masahuat', 'Santa Isabel Ishuatán', 'Santo Domingo de Guzmán', 'Sonzacate'],
            'Zona Costera': ['Acajutla', 'San Julián', 'Cuisnahuat'],
            'Zona Norte': ['Santa Ana Tecla']
        },
        'La Paz': {
            'Zona Central': ['Zacatecoluca', 'San Luis Talpa', 'San Pedro Masahuat', 'Tapalhuaca', 'San Emigdio', 'San Francisco Chinameca', 'Santiago Nonualco', 'Santa María Ostuma'],
            'Zona Norte': ['Cuyultitán', 'El Rosario', 'Jerusalén', 'Mercedes La Ceiba', 'Olocuilta', 'Paraíso de Osorio', 'San Antonio Masahuat', 'San Juan Nonualco', 'San Juan Talpa', 'San Luis La Herradura', 'San Miguel Tepezontes', 'San Pedro Nonualco', 'San Rafael Obrajuelo']
        },
        'Chalatenango': {
            'Zona Central': ['Chalatenango', 'Agua Caliente', 'Arcatao', 'Azacualpa', 'Comalapa', 'Concepción Quezaltepeque', 'Dulce Nombre de María', 'El Carrizal', 'El Paraíso', 'La Laguna', 'La Palma', 'La Reina', 'Las Vueltas', 'Nombre de Jesús', 'Nueva Concepción', 'Nueva Trinidad', 'Ojos de Agua', 'Potonico', 'San Antonio de la Cruz', 'San Antonio Los Ranchos', 'San Fernando', 'San Francisco Lempa', 'San Francisco Morazán', 'San Ignacio', 'San Isidro Labrador', 'San José Cancasque', 'San José Las Flores', 'San Luis del Carmen', 'San Miguel de Mercedes', 'San Rafael', 'Santa Rita', 'Tejutla']
        },
        'Ahuachapán': {
            'Zona Central': ['Ahuachapán', 'Apaneca', 'Atiquizaya', 'Concepción de Ataco', 'El Refugio', 'Guaymango', 'Jujutla', 'San Francisco Menéndez', 'San Lorenzo', 'San Pedro Puxtla', 'Tacuba', 'Turín']
        },
        'Cuscatlán': {
            'Zona Central': ['Cojutepeque', 'Candelaria', 'El Carmen', 'El Rosario', 'Monte San Juan', 'Oratorio de Concepción', 'San Bartolomé Perulapía', 'San Cristóbal', 'San José Guayabal', 'San Pedro Perulapán', 'San Rafael Cedros', 'San Ramón', 'Santa Cruz Analquito', 'Santa Cruz Michapa', 'Suchitoto', 'Tenancingo']
        },
        'La Unión': {
            'Zona Central': ['La Unión', 'Anamorós', 'Bolívar', 'Concepción de Oriente', 'Conchagua', 'El Carmen', 'El Sauce', 'Intipucá', 'Lislique', 'Meanguera del Golfo', 'Nueva Esparta', 'Pasaquina', 'Polorós', 'San Alejo', 'San José', 'Santa Rosa de Lima', 'Yayantique', 'Yucuaiquín']
        },
        'Morazán': {
            'Zona Central': ['San Francisco Gotera', 'Arambala', 'Cacaopera', 'Chilanga', 'Corinto', 'Delicias de Concepción', 'El Divisadero', 'El Rosario', 'Gualococti', 'Guatajiagua', 'Joateca', 'Jocoaitique', 'Jocoro', 'Lolotiquillo', 'Meanguera', 'Osicala', 'Perquín', 'San Carlos', 'San Fernando', 'San Isidro', 'San Simón', 'Sensembra', 'Sociedad', 'Torola', 'Yamabal', 'Yoloaiquín']
        },
        'San Vicente': {
            'Zona Central': ['San Vicente', 'Apastepeque', 'Guadalupe', 'San Cayetano Istepeque', 'San Esteban Catarina', 'San Ildefonso', 'San Lorenzo', 'San Sebastián', 'Santa Clara', 'Santo Domingo', 'Tecoluca', 'Tepetitán', 'Verapaz']
        },
        'Cabañas': {
            'Zona Central': ['Sensuntepeque', 'Cinquera', 'Dolores', 'Guacotecti', 'Ilobasco', 'Jutiapa', 'San Isidro', 'Tejutepeque', 'Victoria']
        }
    };

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

    // Cascada de ubicación geográfica
    $('#departamento').on('change', function() {
        const departamento = $(this).val();
        const municipioSelect = $('#municipio');
        const distritoSelect = $('#distrito');
        
        // Limpiar selects dependientes
        municipioSelect.html('<option value="">Seleccione...</option>');
        distritoSelect.html('<option value="">Seleccione primero la zona...</option>');
        
        if (departamento && geografiaElSalvador[departamento]) {
            Object.keys(geografiaElSalvador[departamento]).forEach(zona => {
                municipioSelect.append(`<option value="${zona}">${zona}</option>`);
            });
        }
    });

    $('#municipio').on('change', function() {
        const departamento = $('#departamento').val();
        const zona = $(this).val();
        const distritoSelect = $('#distrito');
        
        // Limpiar select de distrito
        distritoSelect.html('<option value="">Seleccione...</option>');
        
        if (departamento && zona && geografiaElSalvador[departamento][zona]) {
            geografiaElSalvador[departamento][zona].forEach(distrito => {
                distritoSelect.append(`<option value="${distrito}">${distrito}</option>`);
            });
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

    // Trigger inicial para cargar zonas si hay valor previo
    if ($('#departamento').val()) {
        $('#departamento').trigger('change');
    }
});
</script>
@endsection