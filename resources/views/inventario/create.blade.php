@extends('layouts.app')

@section('title', 'Nuevo Producto - Inventario')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('inventario.index') }}">Inventario</a></li>
                    <li class="breadcrumb-item active">Nuevo Producto</li>
                </ol>
            </nav>
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h3 mb-0">
                    <i class="fas fa-plus text-primary"></i>
                    Nuevo Producto
                </h2>
                <a href="{{ route('inventario.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i>
                    Volver
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-box"></i>
                        Información del Producto
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('inventario.store') }}" method="POST" id="productoForm">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Código del Producto</label>
                                    <input type="text" class="form-control" 
                                           value="(Se generará automáticamente)" readonly 
                                           placeholder="Se generará automáticamente">
                                    <div class="form-text">El código se generará automáticamente al guardar</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Tipo *</label>
                                    <select class="form-select @error('tipo') is-invalid @enderror" 
                                            name="tipo" required>
                                        <option value="">Seleccionar tipo...</option>
                                        <option value="producto" {{ old('tipo') == 'producto' ? 'selected' : '' }}>Bien</option>
                                        <option value="servicio" {{ old('tipo') == 'servicio' ? 'selected' : '' }}>Servicio</option>
                                    </select>
                                    @error('tipo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Nombre del Producto *</label>
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror" 
                                   name="nombre" value="{{ old('nombre') }}" required 
                                   placeholder="Ej: Laptop Dell Inspiron 15">
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Descripción</label>
                            <textarea class="form-control @error('descripcion') is-invalid @enderror" 
                                      name="descripcion" rows="3" 
                                      placeholder="Descripción detallada del producto...">{{ old('descripcion') }}</textarea>
                            @error('descripcion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Precio de Compra *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" class="form-control @error('precio_compra') is-invalid @enderror" 
                                               name="precio_compra" value="{{ old('precio_compra') }}" 
                                               step="0.01" min="0" required 
                                               onchange="calcularMargen()">
                                        @error('precio_compra')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Precio de Venta *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" class="form-control @error('precio_venta') is-invalid @enderror" 
                                               name="precio_venta" value="{{ old('precio_venta') }}" 
                                               step="0.01" min="0" required 
                                               onchange="calcularMargen()">
                                        @error('precio_venta')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Stock Actual *</label>
                                    <input type="number" class="form-control @error('existencia') is-invalid @enderror" 
                                           name="existencia" value="{{ old('existencia', 0) }}" 
                                           min="0" step="0.01" required>
                                    @error('existencia')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Stock Mínimo *</label>
                                    <input type="number" class="form-control @error('existencia_minima') is-invalid @enderror" 
                                           name="existencia_minima" value="{{ old('existencia_minima', 5) }}" 
                                           min="0" step="0.01" required>
                                    @error('existencia_minima')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Cantidad mínima para generar alerta</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Unidad de Medida</label>
                                    <select class="form-select" name="unidad_medida">
                                        <option value="piezas" {{ old('unidad_medida') === 'piezas' ? 'selected' : '' }}>Piezas</option>
                                        <option value="kilogramos" {{ old('unidad_medida') === 'kilogramos' ? 'selected' : '' }}>Kilogramos</option>
                                        <option value="litros" {{ old('unidad_medida') === 'litros' ? 'selected' : '' }}>Litros</option>
                                        <option value="metros" {{ old('unidad_medida') === 'metros' ? 'selected' : '' }}>Metros</option>
                                        <option value="cajas" {{ old('unidad_medida') === 'cajas' ? 'selected' : '' }}>Cajas</option>
                                        <option value="otros" {{ old('unidad_medida') === 'otros' ? 'selected' : '' }}>Otros</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Proveedor Principal</label>
                                    <select class="form-select" name="proveedor_principal">
                                        <option value="">Seleccionar proveedor...</option>
                                        @foreach($proveedores as $proveedor)
                                        <option value="{{ $proveedor['id'] }}" {{ old('proveedor_principal') == $proveedor['id'] ? 'selected' : '' }}>
                                            {{ $proveedor['nombre'] }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Ubicación en Almacén</label>
                                    <input type="text" class="form-control" name="ubicacion" 
                                           value="{{ old('ubicacion') }}" 
                                           placeholder="Ej: Estante A-1, Pasillo 3">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Código de Barras</label>
                                    <input type="text" class="form-control" name="codigo_barras" 
                                           value="{{ old('codigo_barras') }}" 
                                           placeholder="Código de barras del producto">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Estado</label>
                                    <select class="form-select" name="estado">
                                        <option value="activo" {{ old('estado', 'activo') === 'activo' ? 'selected' : '' }}>Activo</option>
                                        <option value="inactivo" {{ old('estado') === 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                                        <option value="descontinuado" {{ old('estado') === 'descontinuado' ? 'selected' : '' }}>Descontinuado</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-file-invoice"></i> Plantilla Contable
                                    </label>
                                    <select class="form-select @error('plantilla_contable_id') is-invalid @enderror" 
                                            name="plantilla_contable_id">
                                        <option value="">Sin plantilla contable</option>
                                        @foreach($plantillas as $plantilla)
                                        <option value="{{ $plantilla->id }}" {{ old('plantilla_contable_id') == $plantilla->id ? 'selected' : '' }}>
                                            {{ $plantilla->nombre }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('plantilla_contable_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">
                                        <i class="fas fa-info-circle text-info"></i>
                                        La plantilla contable permite generar partidas automáticas al facturar este producto.
                                        <a href="{{ route('plantillas-contables.index') }}" target="_blank">Administrar plantillas</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('inventario.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i>
                                Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i>
                                Guardar Producto
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <!-- Información de Ayuda -->
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-info-circle"></i>
                        Información de Ayuda
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Código del Producto:</strong>
                        <p class="text-muted small">
                            Debe ser único en el sistema. Se recomienda usar un formato consistente como PROD001, SERV001, etc.
                        </p>
                    </div>
                    
                    <div class="mb-3">
                        <strong>Stock Mínimo:</strong>
                        <p class="text-muted small">
                            Cuando el stock actual sea igual o menor a este valor, se generará una alerta automática.
                        </p>
                    </div>
                    
                    <div class="mb-3">
                        <strong>Precios:</strong>
                        <p class="text-muted small">
                            El precio de venta debe ser mayor al precio de compra para obtener ganancia.
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Calculadora de Margen -->
            <div class="card mt-3">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-calculator"></i>
                        Calculadora de Margen
                    </h6>
                </div>
                <div class="card-body">
                    <div id="margenInfo" style="display: none;">
                        <div class="row text-center">
                            <div class="col-6">
                                <div class="mb-2">
                                    <h6 class="text-primary mb-0" id="margenPorcentaje">0%</h6>
                                    <small class="text-muted">Margen</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2">
                                    <h6 class="text-success mb-0" id="gananciaMonto">$0.00</h6>
                                    <small class="text-muted">Ganancia</small>
                                </div>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <div class="text-center">
                            <div id="margenEstado" class="badge bg-secondary">
                                Ingrese precios para calcular
                            </div>
                        </div>
                    </div>
                    
                    <div id="margenPlaceholder" class="text-center text-muted">
                        <i class="fas fa-calculator fa-2x mb-3"></i>
                        <p>Ingrese precio de compra y venta para ver el margen de ganancia</p>
                    </div>
                </div>
            </div>
            
            <!-- Categorías Disponibles -->
            <div class="card mt-3">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-tags"></i>
                        Categorías Disponibles
                    </h6>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        @foreach($categorias as $categoria)
                        <div class="list-group-item d-flex justify-content-between align-items-center p-2">
                            {{ $categoria['nombre'] }}
                            <span class="badge bg-primary rounded-pill">{{ $categoria['id'] }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <!-- Proveedores Disponibles -->
            <div class="card mt-3">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-truck"></i>
                        Proveedores Disponibles
                    </h6>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        @foreach($proveedores as $proveedor)
                        <div class="list-group-item p-2">
                            <div class="fw-bold">{{ $proveedor['nombre'] }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function calcularMargen() {
    const precioCompra = parseFloat(document.querySelector('input[name="precio_compra"]').value) || 0;
    const precioVenta = parseFloat(document.querySelector('input[name="precio_venta"]').value) || 0;
    
    const margenInfo = document.getElementById('margenInfo');
    const margenPlaceholder = document.getElementById('margenPlaceholder');
    
    if (precioCompra > 0 && precioVenta > 0) {
        const ganancia = precioVenta - precioCompra;
        const margen = (ganancia / precioCompra) * 100;
        
        // Mostrar información de margen
        margenInfo.style.display = 'block';
        margenPlaceholder.style.display = 'none';
        
        // Actualizar valores
        document.getElementById('margenPorcentaje').textContent = margen.toFixed(1) + '%';
        document.getElementById('gananciaMonto').textContent = '$' + ganancia.toFixed(2);
        
        // Actualizar estado del margen
        const estadoElement = document.getElementById('margenEstado');
        if (margen < 0) {
            estadoElement.className = 'badge bg-danger';
            estadoElement.textContent = 'Pérdida';
        } else if (margen < 10) {
            estadoElement.className = 'badge bg-warning';
            estadoElement.textContent = 'Margen Bajo';
        } else if (margen < 30) {
            estadoElement.className = 'badge bg-success';
            estadoElement.textContent = 'Margen Bueno';
        } else {
            estadoElement.className = 'badge bg-primary';
            estadoElement.textContent = 'Margen Excelente';
        }
    } else {
        margenInfo.style.display = 'none';
        margenPlaceholder.style.display = 'block';
    }
}

// Validación en tiempo real
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('productoForm');
    
    // Validación de existencia mínima vs existencia
    const existenciaInput = document.querySelector('input[name="existencia"]');
    const existenciaMinimaInput = document.querySelector('input[name="existencia_minima"]');
    
    if (existenciaInput && existenciaMinimaInput) {
        function validarExistencia() {
            const actual = parseFloat(existenciaInput.value) || 0;
            const minima = parseFloat(existenciaMinimaInput.value) || 0;
            
            if (actual < minima && actual > 0) {
                existenciaInput.classList.add('is-warning');
            } else {
                existenciaInput.classList.remove('is-warning');
            }
        }
        
        existenciaInput.addEventListener('input', validarExistencia);
        existenciaMinimaInput.addEventListener('input', validarExistencia);
    }
    
    // Permitir envío del formulario
    form.addEventListener('submit', function(e) {
        console.log('Formulario enviándose...');
    });
});
</script>

<style>
.is-warning {
    border-color: #ffc107 !important;
    box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25) !important;
}
</style>
@endsection