@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-user-edit text-warning"></i> 
                Editar Cliente
            </h1>
            <p class="text-muted">Actualiza la información del cliente</p>
        </div>
        <div>
            <a href="{{ route('clientes.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver a Clientes
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-warning">Información del Cliente</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <!-- Información fiscal -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary border-bottom pb-2 mb-3">
                                    <i class="fas fa-file-alt"></i> Información Fiscal
                                </h5>
                            </div>
                            <div class="col-md-3">
                                <label for="tipo_documento" class="form-label">Tipo de Documento <span class="text-danger">*</span></label>
                                <select class="form-select @error('tipo_documento') is-invalid @enderror" 
                                        id="tipo_documento" name="tipo_documento" required>
                                    <option value="">Seleccionar...</option>
                                    <option value="NIT" {{ old('tipo_documento', $cliente->tipo_documento) == 'NIT' ? 'selected' : '' }}>NIT</option>
                                    <option value="DUI" {{ old('tipo_documento', $cliente->tipo_documento) == 'DUI' ? 'selected' : '' }}>DUI</option>
                                </select>
                                @error('tipo_documento')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="numero_documento" class="form-label">Número de Documento <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('numero_documento') is-invalid @enderror" 
                                       id="numero_documento" name="numero_documento" value="{{ old('numero_documento', $cliente->numero_documento) }}" 
                                       placeholder="Ej: 1234567890123" required>
                                @error('numero_documento')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="dui" class="form-label">DUI</label>
                                <input type="text" class="form-control @error('dui') is-invalid @enderror" 
                                       id="dui" name="dui" value="{{ old('dui', $cliente->dui ?? '') }}" 
                                       placeholder="12345678-9" maxlength="10">
                                @error('dui')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Información empresarial -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary border-bottom pb-2 mb-3">
                                    <i class="fas fa-building"></i> Información Empresarial
                                </h5>
                            </div>
                            <div class="col-md-6">
                                <label for="nombre" class="form-label">Razón Social <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nombre') is-invalid @enderror" 
                                       id="nombre" name="nombre" value="{{ old('nombre', $cliente->nombre) }}" 
                                       placeholder="Nombre legal de la empresa" required>
                                @error('nombre')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="nombre_comercial" class="form-label">Nombre Comercial</label>
                                <input type="text" class="form-control @error('nombre_comercial') is-invalid @enderror" 
                                       id="nombre_comercial" name="nombre_comercial" value="{{ old('nombre_comercial', $cliente->nombre_comercial ?? '') }}" 
                                       placeholder="Nombre comercial (opcional)">
                                @error('nombre_comercial')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 mt-3">
                                <label for="giro" class="form-label">Giro Comercial <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('giro') is-invalid @enderror" 
                                       id="giro" name="giro" value="{{ old('giro', $cliente->giro) }}" 
                                       placeholder="Actividad principal del cliente" required>
                                @error('giro')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Información de contacto -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary border-bottom pb-2 mb-3">
                                    <i class="fas fa-address-book"></i> Información de Contacto
                                </h5>
                            </div>
                            <div class="col-md-6">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="text" class="form-control @error('telefono') is-invalid @enderror" 
                                       id="telefono" name="telefono" value="{{ old('telefono', $cliente->telefono ?? '') }}" 
                                       placeholder="2234-5678">
                                @error('telefono')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email', $cliente->email ?? '') }}" 
                                       placeholder="cliente@empresa.com">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Información geográfica -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary border-bottom pb-2 mb-3">
                                    <i class="fas fa-map-marker-alt"></i> Ubicación
                                </h5>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="direccion" class="form-label">Dirección Completa <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('direccion') is-invalid @enderror" 
                                          id="direccion" name="direccion" rows="2" 
                                          placeholder="Dirección detallada del cliente" required>{{ old('direccion', $cliente->direccion) }}</textarea>
                                @error('direccion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="departamento" class="form-label">Departamento <span class="text-danger">*</span></label>
                                <select class="form-select @error('departamento') is-invalid @enderror" 
                                        id="departamento" name="departamento" required onchange="cargarMunicipios()">
                                    <option value="">Seleccionar departamento...</option>
                                    <option value="Ahuachapán" {{ old('departamento', $cliente->departamento) == 'Ahuachapán' ? 'selected' : '' }}>Ahuachapán</option>
                                    <option value="Cabañas" {{ old('departamento', $cliente->departamento) == 'Cabañas' ? 'selected' : '' }}>Cabañas</option>
                                    <option value="Chalatenango" {{ old('departamento', $cliente->departamento) == 'Chalatenango' ? 'selected' : '' }}>Chalatenango</option>
                                    <option value="Cuscatlán" {{ old('departamento', $cliente->departamento) == 'Cuscatlán' ? 'selected' : '' }}>Cuscatlán</option>
                                    <option value="La Libertad" {{ old('departamento', $cliente->departamento) == 'La Libertad' ? 'selected' : '' }}>La Libertad</option>
                                    <option value="La Paz" {{ old('departamento', $cliente->departamento) == 'La Paz' ? 'selected' : '' }}>La Paz</option>
                                    <option value="La Unión" {{ old('departamento', $cliente->departamento) == 'La Unión' ? 'selected' : '' }}>La Unión</option>
                                    <option value="Morazán" {{ old('departamento', $cliente->departamento) == 'Morazán' ? 'selected' : '' }}>Morazán</option>
                                    <option value="San Miguel" {{ old('departamento', $cliente->departamento) == 'San Miguel' ? 'selected' : '' }}>San Miguel</option>
                                    <option value="San Salvador" {{ old('departamento', $cliente->departamento) == 'San Salvador' ? 'selected' : '' }}>San Salvador</option>
                                    <option value="San Vicente" {{ old('departamento', $cliente->departamento) == 'San Vicente' ? 'selected' : '' }}>San Vicente</option>
                                    <option value="Santa Ana" {{ old('departamento', $cliente->departamento) == 'Santa Ana' ? 'selected' : '' }}>Santa Ana</option>
                                    <option value="Sonsonate" {{ old('departamento', $cliente->departamento) == 'Sonsonate' ? 'selected' : '' }}>Sonsonate</option>
                                    <option value="Usulután" {{ old('departamento', $cliente->departamento) == 'Usulután' ? 'selected' : '' }}>Usulután</option>
                                </select>
                                @error('departamento')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="municipio" class="form-label">Municipio <span class="text-danger">*</span></label>
                                <select class="form-select @error('municipio') is-invalid @enderror" 
                                        id="municipio" name="municipio" required onchange="cargarDistritos()">
                                    <option value="">Seleccionar municipio...</option>
                                </select>
                                @error('municipio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="distrito" class="form-label">Distrito</label>
                                <select class="form-select @error('distrito') is-invalid @enderror" 
                                        id="distrito" name="distrito">
                                    <option value="">Seleccionar distrito...</option>
                                </select>
                                @error('distrito')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Información crediticia -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary border-bottom pb-2 mb-3">
                                    <i class="fas fa-credit-card"></i> Información Crediticia
                                </h5>
                            </div>
                            <div class="col-md-6">
                                <label for="limite_credito" class="form-label">Límite de Crédito</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control @error('limite_credito') is-invalid @enderror" 
                                           id="limite_credito" name="limite_credito" value="{{ old('limite_credito', $cliente->limite_credito ?? '0.00') }}" 
                                           step="0.01" min="0" placeholder="0.00">
                                </div>
                                @error('limite_credito')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="dias_credito" class="form-label">Días de Crédito</label>
                                <input type="number" class="form-control @error('dias_credito') is-invalid @enderror" 
                                       id="dias_credito" name="dias_credito" value="{{ old('dias_credito', $cliente->dias_credito ?? '30') }}" 
                                       min="0" max="365" placeholder="30">
                                @error('dias_credito')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Plantilla Contable -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary border-bottom pb-2 mb-3">
                                    <i class="fas fa-file-invoice"></i> Configuración Contable
                                </h5>
                            </div>
                            <div class="col-md-12">
                                <label for="plantilla_contable_id" class="form-label">
                                    <i class="fas fa-file-invoice"></i> Plantilla Contable
                                </label>
                                <select class="form-select @error('plantilla_contable_id') is-invalid @enderror" 
                                        id="plantilla_contable_id" name="plantilla_contable_id">
                                    <option value="">Sin plantilla contable</option>
                                    @php
                                        $plantillas = \App\Models\PlantillaContable::where('tipo', 'cliente')
                                                                                    ->where('activo', true)
                                                                                    ->get();
                                    @endphp
                                    @foreach($plantillas as $plantilla)
                                        <option value="{{ $plantilla->id }}" 
                                                {{ old('plantilla_contable_id', $cliente->plantilla_contable_id ?? '') == $plantilla->id ? 'selected' : '' }}>
                                            {{ $plantilla->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('plantilla_contable_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    <i class="fas fa-info-circle text-info"></i>
                                    La plantilla contable permite generar partidas automáticas al facturar a este cliente.
                                    <a href="{{ route('plantillas-contables.index') }}" target="_blank">Administrar plantillas</a>
                                </div>
                            </div>
                        </div>

                        <!-- Botones de acción -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('clientes.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times"></i> Cancelar
                                    </a>
                                    <button type="submit" class="btn btn-warning">
                                        <i class="fas fa-save"></i> Actualizar Cliente
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

<script>
// Datos geográficos de El Salvador
const municipiosPorDepartamento = {
    'Ahuachapán': ['Ahuachapán', 'Apaneca', 'Atiquizaya', 'Concepción de Ataco', 'El Refugio', 'Guaymango', 'Jujutla', 'San Francisco Menéndez', 'San Lorenzo', 'San Pedro Puxtla', 'Tacuba', 'Turín'],
    'Cabañas': ['Sensuntepeque', 'Cinquera', 'Dolores', 'Guacotecti', 'Ilobasco', 'Jutiapa', 'San Isidro', 'Tejutepeque', 'Victoria'],
    'Chalatenango': ['Chalatenango', 'Agua Caliente', 'Arcatao', 'Azacualpa', 'Cancasque', 'Citalá', 'Comalapa', 'Concepción Quezaltepeque', 'Dulce Nombre de María', 'El Carrizal', 'El Paraíso', 'La Laguna', 'La Palma', 'La Reina', 'Las Vueltas', 'Nombre de Jesús', 'Nueva Concepción', 'Nueva Trinidad', 'Ojos de Agua', 'Potonico', 'San Antonio de la Cruz', 'San Antonio Los Ranchos', 'San Fernando', 'San Francisco Lempa', 'San Francisco Morazán', 'San Ignacio', 'San Isidro Labrador', 'San Luis del Carmen', 'San Miguel de Mercedes', 'San Rafael', 'Santa Rita', 'Tejutla'],
    'Cuscatlán': ['Cojutepeque', 'Candelaria', 'El Carmen', 'El Rosario', 'Monte San Juan', 'Oratorio de Concepción', 'San Bartolomé Perulapía', 'San Cristóbal', 'San José Guayabal', 'San Pedro Perulapán', 'San Rafael Cedros', 'San Ramón', 'Santa Cruz Analquito', 'Santa Cruz Michapa', 'Suchitoto', 'Tenancingo'],
    'La Libertad': ['Santa Tecla', 'Antiguo Cuscatlán', 'Nuevo Cuscatlán', 'San Juan Opico', 'Colón', 'Jayaque', 'Sacacoyo', 'Tepecoyo', 'Talnique', 'Comasagua', 'Huizúcar', 'Chiltiupán', 'Jicalapa', 'La Libertad', 'Tamanique', 'Teotepeque', 'Quezaltepeque', 'San Matías', 'San Pablo Tacachico', 'San José Villanueva', 'Zaragoza', 'Ciudad Arce'],
    'La Paz': ['Zacatecoluca', 'Cuyultitán', 'El Rosario', 'Jerusalén', 'Mercedes La Ceiba', 'Olocuilta', 'Paraíso de Osorio', 'San Antonio Masahuat', 'San Emigdio', 'San Francisco Chinameca', 'San Juan Nonualco', 'San Juan Talpa', 'San Juan Tepezontes', 'San Luis La Herradura', 'San Luis Talpa', 'San Miguel Tepezontes', 'San Pedro Masahuat', 'San Pedro Nonualco', 'San Rafael Obrajuelo', 'Santa María Ostuma', 'Santiago Nonualco', 'Tapalhuaca'],
    'La Unión': ['La Unión', 'Anamorós', 'Bolívar', 'Concepción de Oriente', 'Conchagua', 'El Carmen', 'El Sauce', 'Intipucá', 'Lislique', 'Meanguera del Golfo', 'Nueva Esparta', 'Pasaquina', 'Polorós', 'San Alejo', 'San José', 'Santa Rosa de Lima', 'Yayantique', 'Yucuaiquín'],
    'Morazán': ['San Francisco Gotera', 'Arambala', 'Cacaopera', 'Chilanga', 'Corinto', 'Delicias de Concepción', 'El Divisadero', 'El Rosario', 'Gualococti', 'Guatajiagua', 'Joateca', 'Jocoaitique', 'Jocoro', 'Lolotiquillo', 'Meanguera', 'Osicala', 'Perquín', 'San Carlos', 'San Fernando', 'San Isidro', 'San Simón', 'Sensembra', 'Sociedad', 'Torola', 'Yamabal', 'Yoloaiquín'],
    'San Miguel': ['San Miguel', 'Carolina', 'Chapeltique', 'Chinameca', 'Chirilagua', 'Ciudad Barrios', 'Comacarán', 'El Tránsito', 'Lolotique', 'Moncagua', 'Nueva Guadalupe', 'Nuevo Edén de San Juan', 'Quelepa', 'San Antonio', 'San Gerardo', 'San Jorge', 'San Luis de la Reina', 'San Rafael Oriente', 'Sesori', 'Uluazapa'],
    'San Salvador': ['San Salvador', 'Aguilares', 'Apopa', 'Ayutuxtepeque', 'Ciudad Delgado', 'Cuscatancingo', 'El Paisnal', 'Guazapa', 'Ilopango', 'Mejicanos', 'Nejapa', 'Panchimalco', 'Rosario de Mora', 'San Marcos', 'San Martín', 'Santiago Texacuangos', 'Santo Tomás', 'Soyapango', 'Tonacatepeque'],
    'San Vicente': ['San Vicente', 'Apastepeque', 'Guadalupe', 'San Cayetano Istepeque', 'San Esteban Catarina', 'San Ildefonso', 'San Lorenzo', 'San Sebastián', 'Santa Clara', 'Santo Domingo', 'Tecoluca', 'Tepetitán', 'Verapaz'],
    'Santa Ana': ['Santa Ana', 'Candelaria de la Frontera', 'Chalchuapa', 'Coatepeque', 'El Congo', 'El Porvenir', 'Masahuat', 'Metapán', 'San Antonio Pajonal', 'San Sebastián Salitrillo', 'Santa Rosa Guachipilín', 'Santiago de la Frontera', 'Texistepeque'],
    'Sonsonate': ['Sonsonate', 'Acajutla', 'Armenia', 'Caluco', 'Cuisnahuat', 'Izalco', 'Juayúa', 'Nahuizalco', 'Nahulingo', 'Salcoatitán', 'San Antonio del Monte', 'San Julián', 'Santa Catarina Masahuat', 'Santa Isabel Ishuatán', 'Santo Domingo de Guzmán', 'Sonzacate'],
    'Usulután': ['Usulután', 'Alegría', 'Berlín', 'California', 'Concepción Batres', 'El Triunfo', 'Ereguayquín', 'Estanzuelas', 'Jiquilisco', 'Jucuapa', 'Jucuarán', 'Mercedes Umaña', 'Nueva Granada', 'Ozatlán', 'Puerto El Triunfo', 'San Agustín', 'San Buenaventura', 'San Dionisio', 'San Francisco Javier', 'Santa Elena', 'Santa María', 'Santiago de María', 'Tecapán']
};

const distritosPorMunicipio = {
    'San Salvador': ['Centro', 'Norte', 'Sur', 'Este', 'Oeste', 'Centro Histórico'],
    'Santa Tecla': ['Centro', 'Norte', 'Sur', 'Las Colinas', 'Santa Cruz'],
    'Santa Ana': ['Centro', 'Norte', 'Sur', 'Este', 'Oeste'],
    'San Miguel': ['Centro', 'Norte', 'Sur', 'Zona Industrial'],
    'Soyapango': ['Centro', 'Norte', 'Sur', 'Planes de Renderos'],
    'Mejicanos': ['Centro', 'Norte', 'Zona Industrial'],
    'Apopa': ['Centro', 'Norte', 'Sur'],
    'Antiguo Cuscatlán': ['Centro', 'La Mascota', 'Los Bosques'],
    'Ilopango': ['Centro', 'Zona Industrial', 'Zona Franca']
};

// Valores actuales del cliente
const departamentoActual = '{{ old("departamento", $cliente["departamento"]) }}';
const municipioActual = '{{ old("municipio", $cliente["municipio"] ?? "") }}';
const distritoActual = '{{ old("distrito", $cliente["distrito"] ?? "") }}';

function cargarMunicipios() {
    const departamento = document.getElementById('departamento').value;
    const municipioSelect = document.getElementById('municipio');
    const distritoSelect = document.getElementById('distrito');
    
    // Limpiar municipios y distritos
    municipioSelect.innerHTML = '<option value="">Seleccionar municipio...</option>';
    distritoSelect.innerHTML = '<option value="">Seleccionar distrito...</option>';
    
    if (departamento && municipiosPorDepartamento[departamento]) {
        municipiosPorDepartamento[departamento].forEach(municipio => {
            const option = document.createElement('option');
            option.value = municipio;
            option.textContent = municipio;
            if (municipio === municipioActual) {
                option.selected = true;
            }
            municipioSelect.appendChild(option);
        });
        
        // Si hay municipio seleccionado, cargar sus distritos
        if (municipioActual && municipiosPorDepartamento[departamento].includes(municipioActual)) {
            cargarDistritos();
        }
    }
}

function cargarDistritos() {
    const municipio = document.getElementById('municipio').value;
    const distritoSelect = document.getElementById('distrito');
    
    // Limpiar distritos
    distritoSelect.innerHTML = '<option value="">Seleccionar distrito...</option>';
    
    if (municipio && distritosPorMunicipio[municipio]) {
        distritosPorMunicipio[municipio].forEach(distrito => {
            const option = document.createElement('option');
            option.value = distrito;
            option.textContent = distrito;
            if (distrito === distritoActual) {
                option.selected = true;
            }
            distritoSelect.appendChild(option);
        });
    }
}

// Cargar municipios al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    if (departamentoActual) {
        cargarMunicipios();
    }
});

// Formatear DUI mientras se escribe
document.getElementById('dui').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    if (value.length >= 8) {
        value = value.substring(0, 8) + '-' + value.substring(8, 9);
    }
    e.target.value = value;
});

// Validación de tipo de documento
document.getElementById('tipo_documento').addEventListener('change', function() {
    const tipo = this.value;
    const numeroDoc = document.getElementById('numero_documento');
    const dui = document.getElementById('dui');
    
    if (tipo === 'DUI') {
        numeroDoc.placeholder = '12345678-9';
        numeroDoc.maxLength = 10;
        dui.required = false;
    } else if (tipo === 'NIT') {
        numeroDoc.placeholder = '1234567890123';
        numeroDoc.maxLength = 17;
        dui.required = false;
    }
});
</script>
@endsection
