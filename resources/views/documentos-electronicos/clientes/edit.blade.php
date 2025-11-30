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
                                <label for="giro_search" class="form-label">Actividad Económica / Giro Comercial <span class="text-danger">*</span></label>
                                <div class="position-relative">
                                    <input type="text" 
                                           class="form-control @error('giro') is-invalid @enderror" 
                                           id="giro_search" 
                                           placeholder="Buscar por código o descripción de actividad económica..."
                                           autocomplete="off">
                                    <input type="hidden" id="giro" name="giro" value="{{ old('giro', $cliente->giro) }}" required>
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
                                        id="departamento" name="departamento" required>
                                    <option value="">Seleccionar departamento...</option>
                                    <option value="01" {{ old('departamento', $cliente->departamento) == '01' ? 'selected' : '' }}>01 - Ahuachapán</option>
                                    <option value="02" {{ old('departamento', $cliente->departamento) == '02' ? 'selected' : '' }}>02 - Santa Ana</option>
                                    <option value="03" {{ old('departamento', $cliente->departamento) == '03' ? 'selected' : '' }}>03 - Sonsonate</option>
                                    <option value="04" {{ old('departamento', $cliente->departamento) == '04' ? 'selected' : '' }}>04 - Chalatenango</option>
                                    <option value="05" {{ old('departamento', $cliente->departamento) == '05' ? 'selected' : '' }}>05 - La Libertad</option>
                                    <option value="06" {{ old('departamento', $cliente->departamento) == '06' ? 'selected' : '' }}>06 - San Salvador</option>
                                    <option value="07" {{ old('departamento', $cliente->departamento) == '07' ? 'selected' : '' }}>07 - Cuscatlán</option>
                                    <option value="08" {{ old('departamento', $cliente->departamento) == '08' ? 'selected' : '' }}>08 - La Paz</option>
                                    <option value="09" {{ old('departamento', $cliente->departamento) == '09' ? 'selected' : '' }}>09 - Cabañas</option>
                                    <option value="10" {{ old('departamento', $cliente->departamento) == '10' ? 'selected' : '' }}>10 - San Vicente</option>
                                    <option value="11" {{ old('departamento', $cliente->departamento) == '11' ? 'selected' : '' }}>11 - Usulután</option>
                                    <option value="12" {{ old('departamento', $cliente->departamento) == '12' ? 'selected' : '' }}>12 - San Miguel</option>
                                    <option value="13" {{ old('departamento', $cliente->departamento) == '13' ? 'selected' : '' }}>13 - Morazán</option>
                                    <option value="14" {{ old('departamento', $cliente->departamento) == '14' ? 'selected' : '' }}>14 - La Unión</option>
                                </select>
                                @error('departamento')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="municipio" class="form-label">Municipio <span class="text-danger">*</span></label>
                                <select class="form-select @error('municipio') is-invalid @enderror" 
                                        id="municipio" name="municipio" required>
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

<script src="{{ asset('js/geografia.js') }}"></script>
<script>
// Cargar actividades económicas
let actividadesEconomicas = [];
const valorActual = '{{ old("giro", $cliente->giro) }}';

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

document.addEventListener('DOMContentLoaded', function() {
    // Inicializar sistema geográfico centralizado
    Geografia.inicializar({
        departamentoId: 'departamento',
        municipioId: 'municipio',
        distritoId: 'distrito',
        valoresActuales: {
            departamento: '{{ $cliente->departamento }}',
            municipio: '{{ $cliente->municipio }}',
            distrito: '{{ $cliente->distrito }}'
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
});
</script>
@endsection
