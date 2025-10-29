@extends('layouts.app')

@section('title', 'Detalle del Producto - Inventario')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('inventario.index') }}">Inventario</a></li>
                    <li class="breadcrumb-item active">{{ $producto['nombre'] }}</li>
                </ol>
            </nav>
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h3 mb-0">
                    <i class="fas fa-box text-primary"></i>
                    {{ $producto['nombre'] }}
                </h2>
                <div>
                    <a href="{{ route('inventario.edit', $producto['id']) }}" class="btn btn-outline-warning">
                        <i class="fas fa-edit"></i>
                        Editar
                    </a>
                    <a href="{{ route('inventario.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i>
                        Volver
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Información del Producto -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle"></i>
                        Información del Producto
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label text-muted">Código del Producto</label>
                                <p class="h6"><code>{{ $producto['codigo'] }}</code></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label text-muted">Categoría</label>
                                <p class="h6">
                                    <span class="badge bg-primary">{{ $producto['categoria'] }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label text-muted">Stock Actual</label>
                                <p class="h5">
                                    <span class="badge bg-{{ $producto['estado'] === 'normal' ? 'success' : ($producto['estado'] === 'bajo' ? 'warning' : 'danger') }}">
                                        {{ $producto['stock_actual'] }} unidades
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label text-muted">Stock Mínimo</label>
                                <p class="h6">{{ $producto['stock_minimo'] }} unidades</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label text-muted">Estado</label>
                                <p>
                                    @if($producto['estado'] === 'normal')
                                        <span class="badge bg-success">
                                            <i class="fas fa-check"></i> Normal
                                        </span>
                                    @elseif($producto['estado'] === 'bajo')
                                        <span class="badge bg-warning">
                                            <i class="fas fa-exclamation-triangle"></i> Bajo Stock
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            <i class="fas fa-times"></i> Agotado
                                        </span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label text-muted">Precio de Compra</label>
                                <p class="h5 text-danger">${{ number_format($producto['precio_compra'], 2) }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label text-muted">Precio de Venta</label>
                                <p class="h5 text-success">${{ number_format($producto['precio_venta'], 2) }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label text-muted">Valor Total en Inventario</label>
                                <p class="h5 text-primary">
                                    ${{ number_format($producto['stock_actual'] * $producto['precio_compra'], 2) }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label text-muted">Margen de Ganancia</label>
                                <p class="h6">
                                    @php
                                        $margen = (($producto['precio_venta'] - $producto['precio_compra']) / $producto['precio_compra']) * 100;
                                    @endphp
                                    <span class="text-{{ $margen > 0 ? 'success' : 'danger' }}">
                                        {{ number_format($margen, 1) }}%
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Historial de Movimientos -->
            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-history"></i>
                        Historial de Movimientos
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Fecha</th>
                                    <th>Tipo</th>
                                    <th>Cantidad</th>
                                    <th>Motivo</th>
                                    <th>Usuario</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($movimientos as $movimiento)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($movimiento['fecha'])->format('d/m/Y') }}</td>
                                    <td>
                                        @if($movimiento['tipo'] === 'entrada')
                                            <span class="badge bg-success">
                                                <i class="fas fa-arrow-down"></i> Entrada
                                            </span>
                                        @else
                                            <span class="badge bg-warning">
                                                <i class="fas fa-arrow-up"></i> Salida
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $movimiento['cantidad'] }}</strong>
                                    </td>
                                    <td>{{ $movimiento['motivo'] }}</td>
                                    <td>{{ $movimiento['usuario'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    @if(count($movimientos) === 0)
                    <div class="text-center py-4">
                        <i class="fas fa-history fa-2x text-muted mb-3"></i>
                        <p class="text-muted">No hay movimientos registrados para este producto</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Panel de Acciones -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-cog"></i>
                        Acciones Rápidas
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <button class="btn btn-success" onclick="mostrarModalEntrada()">
                            <i class="fas fa-plus"></i>
                            Registrar Entrada
                        </button>
                        
                        <button class="btn btn-warning" onclick="mostrarModalSalida()">
                            <i class="fas fa-minus"></i>
                            Registrar Salida
                        </button>
                        
                        <a href="{{ route('inventario.edit', $producto['id']) }}" class="btn btn-outline-primary">
                            <i class="fas fa-edit"></i>
                            Editar Producto
                        </a>
                        
                        <button class="btn btn-outline-danger" onclick="confirmarEliminacion()">
                            <i class="fas fa-trash"></i>
                            Eliminar Producto
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Estadísticas Rápidas -->
            <div class="card mt-3">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-chart-bar"></i>
                        Estadísticas
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="mb-3">
                                <h5 class="text-primary mb-0">{{ $producto['stock_actual'] }}</h5>
                                <small class="text-muted">Stock Actual</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <h5 class="text-info mb-0">{{ $producto['stock_minimo'] }}</h5>
                                <small class="text-muted">Stock Mínimo</small>
                            </div>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="row text-center">
                        <div class="col-12">
                            <div class="mb-2">
                                <h6 class="text-success mb-0">
                                    ${{ number_format($producto['stock_actual'] * $producto['precio_compra'], 2) }}
                                </h6>
                                <small class="text-muted">Valor Total</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Alertas -->
            <div class="card mt-3">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-exclamation-triangle"></i>
                        Alertas
                    </h6>
                </div>
                <div class="card-body">
                    @if($producto['estado'] === 'agotado')
                        <div class="alert alert-danger">
                            <i class="fas fa-times-circle"></i>
                            <strong>Producto Agotado</strong><br>
                            No hay unidades disponibles en stock.
                        </div>
                    @elseif($producto['estado'] === 'bajo')
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i>
                            <strong>Stock Bajo</strong><br>
                            El stock está por debajo del mínimo requerido.
                        </div>
                    @else
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle"></i>
                            <strong>Stock Normal</strong><br>
                            El producto tiene suficiente stock.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Entrada -->
<div class="modal fade" id="entradaModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Entrada de Inventario - {{ $producto['nombre'] }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('inventario.entrada') }}" method="POST">
                @csrf
                <input type="hidden" name="producto_id" value="{{ $producto['id'] }}">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Cantidad</label>
                        <input type="number" class="form-control" name="cantidad" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Precio Unitario</label>
                        <input type="number" class="form-control" name="precio_unitario" 
                               step="0.01" min="0" value="{{ $producto['precio_compra'] }}" required>
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

<!-- Modal Salida -->
<div class="modal fade" id="salidaModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Salida de Inventario - {{ $producto['nombre'] }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('inventario.salida') }}" method="POST">
                @csrf
                <input type="hidden" name="producto_id" value="{{ $producto['id'] }}">
                <div class="modal-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i>
                        Stock actual: <strong>{{ $producto['stock_actual'] }} unidades</strong>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cantidad</label>
                        <input type="number" class="form-control" name="cantidad" 
                               min="1" max="{{ $producto['stock_actual'] }}" required>
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

<!-- Formulario de eliminación oculto -->
<form id="deleteForm" action="{{ route('inventario.destroy', $producto['id']) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
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

function confirmarEliminacion() {
    if (confirm('¿Está seguro de que desea eliminar este producto? Esta acción no se puede deshacer.')) {
        document.getElementById('deleteForm').submit();
    }
}
</script>
@endsection