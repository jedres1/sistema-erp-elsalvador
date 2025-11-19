@extends('layouts.app')

@section('title', 'Inventario')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h3 mb-0">
                    <i class="fas fa-boxes text-primary"></i>
                    Control de Inventario
                </h2>
                <div>
                    <a href="{{ route('inventario.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        Nuevo Producto
                    </a>
                    <a href="{{ route('inventario.kardex') }}" class="btn btn-info">
                        <i class="fas fa-chart-line"></i>
                        Reporte Kardex
                    </a>
                    <button class="btn btn-success" onclick="mostrarModalEntrada()">
                        <i class="fas fa-arrow-down"></i>
                        Entrada
                    </button>
                    <button class="btn btn-warning" onclick="mostrarModalSalida()">
                        <i class="fas fa-arrow-up"></i>
                        Salida
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Estadísticas -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="text-primary mb-2">
                        <i class="fas fa-box fa-2x"></i>
                    </div>
                    <h4 class="text-primary">{{ $estadisticas['total_productos'] }}</h4>
                    <p class="text-muted mb-0">Total Productos</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="text-success mb-2">
                        <i class="fas fa-dollar-sign fa-2x"></i>
                    </div>
                    <h4 class="text-success">${{ number_format($estadisticas['valor_inventario'], 2) }}</h4>
                    <p class="text-muted mb-0">Valor del Inventario</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="text-warning mb-2">
                        <i class="fas fa-exclamation-triangle fa-2x"></i>
                    </div>
                    <h4 class="text-warning">{{ $estadisticas['productos_bajo_stock'] }}</h4>
                    <p class="text-muted mb-0">Bajo Stock</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="text-danger mb-2">
                        <i class="fas fa-times-circle fa-2x"></i>
                    </div>
                    <h4 class="text-danger">{{ $estadisticas['productos_agotados'] }}</h4>
                    <p class="text-muted mb-0">Agotados</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Alertas -->
    @if(count($alertas) > 0)
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-warning">
                <div class="card-header bg-warning text-dark">
                    <h6 class="mb-0">
                        <i class="fas fa-bell"></i>
                        Alertas de Inventario
                    </h6>
                </div>
                <div class="card-body">
                    @foreach($alertas as $alerta)
                    <div class="alert alert-{{ $alerta['tipo'] === 'agotado' ? 'danger' : 'warning' }} alert-dismissible fade show" role="alert">
                        <i class="fas fa-{{ $alerta['tipo'] === 'agotado' ? 'times-circle' : 'exclamation-triangle' }}"></i>
                        <strong>{{ $alerta['producto'] }}</strong> - 
                        {{ $alerta['tipo'] === 'agotado' ? 'Producto agotado' : 'Stock bajo' }} 
                        ({{ $alerta['stock'] }} unidades)
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Lista de Productos -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-list"></i>
                        Productos en Inventario
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Código</th>
                                    <th>Producto</th>
                                    <th>Categoría</th>
                                    <th>Stock</th>
                                    <th>Mín.</th>
                                    <th>Precio Compra</th>
                                    <th>Precio Venta</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($productos as $producto)
                                <tr>
                                    <td>
                                        <code>{{ $producto->codigo }}</code>
                                    </td>
                                    <td>
                                        <strong>{{ $producto->nombre }}</strong>
                                    </td>
                                    <td>{{ $producto->tipo == 'producto' ? 'Bien' : 'Servicio' }}</td>
                                    <td>
                                        <span class="badge bg-{{ $producto->existencia > $producto->existencia_minima ? 'success' : ($producto->existencia > 0 && $producto->existencia <= $producto->existencia_minima ? 'warning' : 'danger') }}">
                                            {{ $producto->existencia }}
                                        </span>
                                    </td>
                                    <td>{{ $producto->existencia_minima }}</td>
                                    <td>${{ number_format($producto->precio_compra, 2) }}</td>
                                    <td>${{ number_format($producto->precio_venta, 2) }}</td>
                                    <td>
                                        @if($producto->existencia > $producto->existencia_minima)
                                            <span class="badge bg-success">Normal</span>
                                        @elseif($producto->existencia > 0 && $producto->existencia <= $producto->existencia_minima)
                                            <span class="badge bg-warning">Bajo Stock</span>
                                        @else
                                            <span class="badge bg-danger">Agotado</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('inventario.show', $producto->id) }}" 
                                               class="btn btn-sm btn-outline-info" title="Ver">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('inventario.edit', $producto->id) }}" 
                                               class="btn btn-sm btn-outline-warning" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button class="btn btn-sm btn-outline-success" 
                                                    title="Entrada" onclick="entradaRapida({{ $producto->id }}, '{{ $producto->nombre }}')">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-warning" 
                                                    title="Salida" onclick="salidaRapida({{ $producto->id }}, '{{ $producto->nombre }}')">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Entrada de Inventario -->
<div class="modal fade" id="entradaModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Entrada de Inventario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('inventario.entrada') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Producto</label>
                        <select class="form-select" name="producto_id" required>
                            <option value="">Seleccionar producto...</option>
                            @foreach($productos as $producto)
                            <option value="{{ $producto->id }}">{{ $producto->codigo }} - {{ $producto->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cantidad</label>
                        <input type="number" class="form-control" name="cantidad" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Precio Unitario</label>
                        <input type="number" class="form-control" name="precio_unitario" step="0.01" min="0" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Proveedor</label>
                        <select class="form-select" name="proveedor_id" required>
                            <option value="">Seleccionar proveedor...</option>
                            <option value="1">Proveedor Tech SA</option>
                            <option value="2">Distribuidora XYZ</option>
                            <option value="3">Importadora ABC</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Observaciones</label>
                        <textarea class="form-control" name="observaciones" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Registrar Entrada</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Salida de Inventario -->
<div class="modal fade" id="salidaModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Salida de Inventario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('inventario.salida') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Producto</label>
                        <select class="form-select" name="producto_id" required>
                            <option value="">Seleccionar producto...</option>
                            @foreach($productos as $producto)
                            <option value="{{ $producto->id }}">{{ $producto->codigo }} - {{ $producto->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cantidad</label>
                        <input type="number" class="form-control" name="cantidad" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Motivo</label>
                        <select class="form-select" name="motivo" required>
                            <option value="">Seleccionar motivo...</option>
                            <option value="venta">Venta</option>
                            <option value="devolucion">Devolución</option>
                            <option value="daño">Daño/Pérdida</option>
                            <option value="ajuste">Ajuste de Inventario</option>
                            <option value="otro">Otro</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Observaciones</label>
                        <textarea class="form-control" name="observaciones" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-warning">Registrar Salida</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function mostrarModalEntrada() {
    const modal = new bootstrap.Modal(document.getElementById('entradaModal'));
    modal.show();
}

function mostrarModalSalida() {
    const modal = new bootstrap.Modal(document.getElementById('salidaModal'));
    modal.show();
}

function entradaRapida(productoId, nombreProducto) {
    const modal = new bootstrap.Modal(document.getElementById('entradaModal'));
    const select = document.querySelector('#entradaModal select[name="producto_id"]');
    select.value = productoId;
    modal.show();
}

function salidaRapida(productoId, nombreProducto) {
    const modal = new bootstrap.Modal(document.getElementById('salidaModal'));
    const select = document.querySelector('#salidaModal select[name="producto_id"]');
    select.value = productoId;
    modal.show();
}
</script>
@endsection