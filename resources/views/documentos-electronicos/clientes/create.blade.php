@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-user-plus text-primary"></i> 
                Nuevo Cliente
            </h1>
            <p class="text-muted">Registra un nuevo cliente para facturación electrónica</p>
        </div>
        <div>
            <a href="{{ route('documentos-electronicos.clientes.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver a Clientes
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Información del Cliente</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('documentos-electronicos.clientes.store') }}" method="POST">
                        @csrf
                        
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
                                    <option value="NIT" {{ old('tipo_documento') == 'NIT' ? 'selected' : '' }}>NIT</option>
                                    <option value="DUI" {{ old('tipo_documento') == 'DUI' ? 'selected' : '' }}>DUI</option>
                                </select>
                                @error('tipo_documento')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="numero_documento" class="form-label">Número de Documento <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('numero_documento') is-invalid @enderror" 
                                       id="numero_documento" name="numero_documento" value="{{ old('numero_documento') }}" 
                                       placeholder="Ej: 1234567890123" required>
                                @error('numero_documento')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="dui" class="form-label">DUI</label>
                                <input type="text" class="form-control @error('dui') is-invalid @enderror" 
                                       id="dui" name="dui" value="{{ old('dui') }}" 
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
                                <label for="razon_social" class="form-label">Razón Social <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('razon_social') is-invalid @enderror" 
                                       id="razon_social" name="razon_social" value="{{ old('razon_social') }}" 
                                       placeholder="Nombre legal de la empresa" required>
                                @error('razon_social')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="nombre_comercial" class="form-label">Nombre Comercial</label>
                                <input type="text" class="form-control @error('nombre_comercial') is-invalid @enderror" 
                                       id="nombre_comercial" name="nombre_comercial" value="{{ old('nombre_comercial') }}" 
                                       placeholder="Nombre comercial (opcional)">
                                @error('nombre_comercial')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 mt-3">
                                <label for="giro_comercial" class="form-label">Giro Comercial <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('giro_comercial') is-invalid @enderror" 
                                       id="giro_comercial" name="giro_comercial" value="{{ old('giro_comercial') }}" 
                                       placeholder="Actividad principal del cliente" required>
                                @error('giro_comercial')
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
                                       id="telefono" name="telefono" value="{{ old('telefono') }}" 
                                       placeholder="2234-5678">
                                @error('telefono')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email') }}" 
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
                                          placeholder="Dirección detallada del cliente" required>{{ old('direccion') }}</textarea>
                                @error('direccion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="departamento" class="form-label">Departamento <span class="text-danger">*</span></label>
                                <select class="form-select @error('departamento') is-invalid @enderror" 
                                        id="departamento" name="departamento" required onchange="cargarMunicipios()">
                                    <option value="">Seleccionar departamento...</option>
                                    <option value="Ahuachapán" {{ old('departamento') == 'Ahuachapán' ? 'selected' : '' }}>Ahuachapán</option>
                                    <option value="Cabañas" {{ old('departamento') == 'Cabañas' ? 'selected' : '' }}>Cabañas</option>
                                    <option value="Chalatenango" {{ old('departamento') == 'Chalatenango' ? 'selected' : '' }}>Chalatenango</option>
                                    <option value="Cuscatlán" {{ old('departamento') == 'Cuscatlán' ? 'selected' : '' }}>Cuscatlán</option>
                                    <option value="La Libertad" {{ old('departamento') == 'La Libertad' ? 'selected' : '' }}>La Libertad</option>
                                    <option value="La Paz" {{ old('departamento') == 'La Paz' ? 'selected' : '' }}>La Paz</option>
                                    <option value="La Unión" {{ old('departamento') == 'La Unión' ? 'selected' : '' }}>La Unión</option>
                                    <option value="Morazán" {{ old('departamento') == 'Morazán' ? 'selected' : '' }}>Morazán</option>
                                    <option value="San Miguel" {{ old('departamento') == 'San Miguel' ? 'selected' : '' }}>San Miguel</option>
                                    <option value="San Salvador" {{ old('departamento') == 'San Salvador' ? 'selected' : '' }}>San Salvador</option>
                                    <option value="San Vicente" {{ old('departamento') == 'San Vicente' ? 'selected' : '' }}>San Vicente</option>
                                    <option value="Santa Ana" {{ old('departamento') == 'Santa Ana' ? 'selected' : '' }}>Santa Ana</option>
                                    <option value="Sonsonate" {{ old('departamento') == 'Sonsonate' ? 'selected' : '' }}>Sonsonate</option>
                                    <option value="Usulután" {{ old('departamento') == 'Usulután' ? 'selected' : '' }}>Usulután</option>
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
                                <label for="credito_limite" class="form-label">Límite de Crédito</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control @error('credito_limite') is-invalid @enderror" 
                                           id="credito_limite" name="credito_limite" value="{{ old('credito_limite', '0.00') }}" 
                                           step="0.01" min="0" placeholder="0.00">
                                </div>
                                @error('credito_limite')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="dias_credito" class="form-label">Días de Crédito</label>
                                <input type="number" class="form-control @error('dias_credito') is-invalid @enderror" 
                                       id="dias_credito" name="dias_credito" value="{{ old('dias_credito', '30') }}" 
                                       min="0" max="365" placeholder="30">
                                @error('dias_credito')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Botones de acción -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('documentos-electronicos.clientes.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times"></i> Cancelar
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Guardar Cliente
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
// Datos geográficos simplificados para el ejemplo
const municipiosPorDepartamento = {
    'San Salvador': ['San Salvador', 'Mejicanos', 'Soyapango', 'Ciudad Delgado', 'Ilopango'],
    'La Libertad': ['Santa Tecla', 'Antiguo Cuscatlán', 'Nuevo Cuscatlán', 'San Juan Opico', 'Colón'],
    'Santa Ana': ['Santa Ana', 'Metapán', 'Texistepeque', 'Coatepeque', 'Chalchuapa'],
    // Agregar más según necesidad
};

const distritosPorMunicipio = {
    'San Salvador': ['Centro', 'Norte', 'Sur', 'Este', 'Oeste'],
    'Santa Tecla': ['Centro', 'Norte', 'Sur'],
    'Santa Ana': ['Centro', 'Norte', 'Sur', 'Este'],
    // Agregar más según necesidad
};

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
            municipioSelect.appendChild(option);
        });
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
            distritoSelect.appendChild(option);
        });
    }
}

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