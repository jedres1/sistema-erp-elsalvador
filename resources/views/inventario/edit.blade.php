@extends('layouts.app')

@section('title', 'Editar Producto - Inventario')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('inventario.index') }}">Inventario</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('inventario.show', $producto['id']) }}">{{ $producto['nombre'] }}</a></li>
                    <li class="breadcrumb-item active">Editar</li>
                </ol>
            </nav>
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h3 mb-0">
                    <i class="fas fa-edit text-warning"></i>
                    Editar Producto
                </h2>
                <div>
                    <a href="{{ route('inventario.show', $producto['id']) }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i>
                        Volver
                    </a>
                </div>
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
                    <form action="{{ route('inventario.update', $producto['id']) }}" method="POST" id="productoForm">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Código del Producto *</label>
                                    <input type="text" class="form-control @error('codigo') is-invalid @enderror" 
                                           name="codigo" value="{{ old('codigo', $producto['codigo']) }}" required 
                                           placeholder="Ej: PROD001">
                                    @error('codigo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Código único para identificar el producto</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Tipo *</label>
                                    <select class="form-select @error('tipo') is-invalid @enderror" 
                                            name="tipo" required>
                                        <option value="">Seleccionar tipo...</option>
                                        <option value="producto" {{ old('tipo', $producto->tipo) == 'producto' ? 'selected' : '' }}>Bien</option>
                                        <option value="servicio" {{ old('tipo', $producto->tipo) == 'servicio' ? 'selected' : '' }}>Servicio</option>
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
                                   name="nombre" value="{{ old('nombre', $producto['nombre']) }}" required 
                                   placeholder="Ej: Laptop Dell Inspiron 15">
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Descripción</label>
                            <textarea class="form-control @error('descripcion') is-invalid @enderror" 
                                      name="descripcion" rows="3" 
                                      placeholder="Descripción detallada del producto...">{{ old('descripcion', $producto['descripcion'] ?? '') }}</textarea>
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
                                               name="precio_compra" value="{{ old('precio_compra', $producto['precio_compra']) }}" 
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
                                               name="precio_venta" value="{{ old('precio_venta', $producto['precio_venta']) }}" 
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
                                    <input type="number" class="form-control @error('stock_actual') is-invalid @enderror" 
                                           name="stock_actual" value="{{ old('stock_actual', $producto['stock_actual']) }}" 
                                           min="0" required>
                                    @error('stock_actual')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Stock Mínimo *</label>
                                    <input type="number" class="form-control @error('stock_minimo') is-invalid @enderror" 
                                           name="stock_minimo" value="{{ old('stock_minimo', $producto['stock_minimo']) }}" 
                                           min="0" required>
                                    @error('stock_minimo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Cantidad mínima para generar alerta</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Unidad de Medida</label>
                                    <select class="form-select" name="unidad_medida">
                                        <option value="piezas" {{ old('unidad_medida', $producto['unidad_medida'] ?? 'piezas') === 'piezas' ? 'selected' : '' }}>Piezas</option>
                                        <option value="kilogramos" {{ old('unidad_medida', $producto['unidad_medida'] ?? '') === 'kilogramos' ? 'selected' : '' }}>Kilogramos</option>
                                        <option value="litros" {{ old('unidad_medida', $producto['unidad_medida'] ?? '') === 'litros' ? 'selected' : '' }}>Litros</option>
                                        <option value="metros" {{ old('unidad_medida', $producto['unidad_medida'] ?? '') === 'metros' ? 'selected' : '' }}>Metros</option>
                                        <option value="cajas" {{ old('unidad_medida', $producto['unidad_medida'] ?? '') === 'cajas' ? 'selected' : '' }}>Cajas</option>
                                        <option value="otros" {{ old('unidad_medida', $producto['unidad_medida'] ?? '') === 'otros' ? 'selected' : '' }}>Otros</option>
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
                                        <option value="{{ $proveedor['id'] }}" 
                                                {{ old('proveedor_principal', $producto['proveedor_id'] ?? '') == $proveedor['id'] ? 'selected' : '' }}>
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
                                           value="{{ old('ubicacion', $producto['ubicacion'] ?? '') }}" 
                                           placeholder="Ej: Estante A-1, Pasillo 3">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Código de Barras</label>
                                    <input type="text" class="form-control" name="codigo_barras" 
                                           value="{{ old('codigo_barras', $producto['codigo_barras'] ?? '') }}" 
                                           placeholder="Código de barras del producto">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Estado</label>
                                    <select class="form-select" name="estado">
                                        <option value="activo" {{ old('estado', $producto['estado'] ?? 'activo') === 'activo' ? 'selected' : '' }}>Activo</option>
                                        <option value="inactivo" {{ old('estado', $producto['estado'] ?? '') === 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                                        <option value="descontinuado" {{ old('estado', $producto['estado'] ?? '') === 'descontinuado' ? 'selected' : '' }}>Descontinuado</option>
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
                                        <option value="{{ $plantilla->id }}" 
                                                {{ old('plantilla_contable_id', $producto['plantilla_contable_id'] ?? '') == $plantilla->id ? 'selected' : '' }}>
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
                            <a href="{{ route('inventario.show', $producto['id']) }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i>
                                Cancelar
                            </a>
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-save"></i>
                                Actualizar Producto
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
                        <strong>Margen de Ganancia:</strong>
                        <p class="text-muted small">
                            Se calcula automáticamente basado en la diferencia entre el precio de venta y el precio de compra.
                        </p>
                    </div>
                    
                    <div>
                        <strong id="margenLabel" class="d-none">Tu Margen:</strong>
                        <div id="margenDisplay" class="alert alert-info mt-2 d-none">
                            <i class="fas fa-chart-line"></i>
                            <span id="margenValue"></span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Estadísticas del Producto -->
            <div class="card mt-3">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-chart-bar"></i>
                        Estadísticas del Producto
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-muted small">Stock Actual:</span>
                            <strong>{{ $producto['stock_actual'] }} unidades</strong>
                        </div>
                        <div class="progress" style="height: 8px;">
                            @php
                                $porcentaje = $producto['stock_minimo'] > 0 
                                    ? min(100, ($producto['stock_actual'] / ($producto['stock_minimo'] * 2)) * 100) 
                                    : 100;
                                $clase = $producto['stock_actual'] <= $producto['stock_minimo'] ? 'bg-danger' : 'bg-success';
                            @endphp
                            <div class="progress-bar {{ $clase }}" role="progressbar" style="width: {{ $porcentaje }}%" 
                                 aria-valuenow="{{ $porcentaje }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    
                    @if($producto['stock_actual'] <= $producto['stock_minimo'])
                    <div class="alert alert-danger py-2 px-3 mb-0">
                        <i class="fas fa-exclamation-triangle"></i>
                        <small><strong>Alerta:</strong> Stock por debajo del mínimo</small>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function calcularMargen() {
        const precioCompra = parseFloat(document.querySelector('input[name="precio_compra"]').value) || 0;
        const precioVenta = parseFloat(document.querySelector('input[name="precio_venta"]').value) || 0;
        
        if (precioCompra > 0 && precioVenta > 0) {
            const margen = ((precioVenta - precioCompra) / precioCompra * 100).toFixed(2);
            const ganancia = (precioVenta - precioCompra).toFixed(2);
            
            document.getElementById('margenLabel').classList.remove('d-none');
            document.getElementById('margenDisplay').classList.remove('d-none');
            
            let colorClass = 'alert-info';
            if (margen < 10) colorClass = 'alert-danger';
            else if (margen < 20) colorClass = 'alert-warning';
            else colorClass = 'alert-success';
            
            document.getElementById('margenDisplay').className = 'alert mt-2 ' + colorClass;
            document.getElementById('margenValue').innerHTML = `
                <strong>${margen}%</strong> ($${ganancia} de ganancia por unidad)
            `;
        } else {
            document.getElementById('margenLabel').classList.add('d-none');
            document.getElementById('margenDisplay').classList.add('d-none');
        }
    }
    
    // Calcular margen al cargar la página
    document.addEventListener('DOMContentLoaded', function() {
        calcularMargen();
    });
    
    // Confirmación antes de enviar
    document.getElementById('productoForm').addEventListener('submit', function(e) {
        const stockActual = parseInt(document.querySelector('input[name="stock_actual"]').value);
        const stockMinimo = parseInt(document.querySelector('input[name="stock_minimo"]').value);
        
        if (stockActual < stockMinimo) {
            if (!confirm('El stock actual está por debajo del stock mínimo. ¿Desea continuar?')) {
                e.preventDefault();
            }
        }
    });
</script>
@endpush
@endsection
