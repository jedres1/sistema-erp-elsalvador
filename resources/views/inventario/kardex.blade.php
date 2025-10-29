@extends('layouts.app')

@section('title', 'Reporte Kardex')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('inventario.index') }}">Inventario</a></li>
                    <li class="breadcrumb-item active">Reporte Kardex</li>
                </ol>
            </nav>
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h3 mb-0">
                    <i class="fas fa-chart-line text-primary"></i>
                    Reporte Kardex de Inventario
                </h2>
                <div>
                    <a href="{{ route('inventario.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i>
                        Volver al Inventario
                    </a>
                    @if($productoSeleccionado)
                    <button class="btn btn-success" onclick="exportarKardex()">
                        <i class="fas fa-file-excel"></i>
                        Exportar Excel
                    </button>
                    <button class="btn btn-danger" onclick="imprimirKardex()">
                        <i class="fas fa-print"></i>
                        Imprimir
                    </button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Filtros -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-filter"></i>
                        Filtros de Consulta
                    </h5>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('inventario.kardex') }}" id="filtrosForm">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">Producto *</label>
                                <select class="form-select" name="producto_id" required onchange="this.form.submit()">
                                    <option value="">Seleccionar producto...</option>
                                    @foreach($productos as $producto)
                                    <option value="{{ $producto['id'] }}" 
                                            {{ $productoSeleccionado == $producto['id'] ? 'selected' : '' }}>
                                        {{ $producto['codigo'] }} - {{ $producto['nombre'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Fecha Desde</label>
                                <input type="date" class="form-control" name="fecha_desde" 
                                       value="{{ $fechaDesde }}" onchange="this.form.submit()">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Fecha Hasta</label>
                                <input type="date" class="form-control" name="fecha_hasta" 
                                       value="{{ $fechaHasta }}" onchange="this.form.submit()">
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="button" class="btn btn-outline-secondary w-100" onclick="limpiarFiltros()">
                                    <i class="fas fa-eraser"></i>
                                    Limpiar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if($productoSeleccionado && count($movimientosKardex) > 0)
        <!-- Información del Producto -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-box"></i>
                            Información del Producto
                        </h5>
                    </div>
                    <div class="card-body">
                        @php
                            $producto = collect($productos)->firstWhere('id', $productoSeleccionado);
                        @endphp
                        @if($producto)
                        <div class="row">
                            <div class="col-md-3">
                                <strong>Código:</strong><br>
                                <span class="text-primary">{{ $producto['codigo'] }}</span>
                            </div>
                            <div class="col-md-6">
                                <strong>Producto:</strong><br>
                                {{ $producto['nombre'] }}
                            </div>
                            <div class="col-md-3">
                                <strong>Stock Actual:</strong><br>
                                <span class="text-success fs-5">{{ end($movimientosKardex)['saldo_cantidad'] ?? 0 }} {{ $producto['unidad'] ?? 'piezas' }}</span>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-3">
                                <strong>Categoría:</strong><br>
                                {{ $producto['categoria'] }}
                            </div>
                            <div class="col-md-3">
                                <strong>Costo Promedio:</strong><br>
                                ${{ number_format(end($movimientosKardex)['saldo_costo'] ?? 0, 2) }}
                            </div>
                            <div class="col-md-3">
                                <strong>Valor Total:</strong><br>
                                <span class="text-info fs-5">${{ number_format(end($movimientosKardex)['saldo_total'] ?? 0, 2) }}</span>
                            </div>
                            <div class="col-md-3">
                                <strong>Período:</strong><br>
                                {{ \Carbon\Carbon::parse($fechaDesde)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($fechaHasta)->format('d/m/Y') }}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Reporte Kardex -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-table"></i>
                            Movimientos del Kardex
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" id="kardexTable">
                            <table class="table table-sm table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th rowspan="2" class="text-center align-middle">Fecha</th>
                                        <th rowspan="2" class="text-center align-middle">Documento</th>
                                        <th rowspan="2" class="text-center align-middle">Concepto</th>
                                        <th colspan="3" class="text-center bg-success">ENTRADAS</th>
                                        <th colspan="3" class="text-center bg-danger">SALIDAS</th>
                                        <th colspan="3" class="text-center bg-primary">SALDOS</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center bg-success">Cant.</th>
                                        <th class="text-center bg-success">Costo</th>
                                        <th class="text-center bg-success">Total</th>
                                        <th class="text-center bg-danger">Cant.</th>
                                        <th class="text-center bg-danger">Costo</th>
                                        <th class="text-center bg-danger">Total</th>
                                        <th class="text-center bg-primary">Cant.</th>
                                        <th class="text-center bg-primary">Costo</th>
                                        <th class="text-center bg-primary">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($movimientosKardex as $movimiento)
                                    <tr>
                                        <td class="text-center">{{ \Carbon\Carbon::parse($movimiento['fecha'])->format('d/m/Y') }}</td>
                                        <td class="text-center">{{ $movimiento['documento'] }}</td>
                                        <td>{{ $movimiento['concepto'] }}</td>
                                        
                                        <!-- Entradas -->
                                        <td class="text-center">
                                            @if($movimiento['entrada_cantidad'] > 0)
                                                {{ number_format($movimiento['entrada_cantidad'], 0) }}
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            @if($movimiento['entrada_total'] > 0)
                                                ${{ number_format($movimiento['entrada_costo'], 2) }}
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            @if($movimiento['entrada_total'] > 0)
                                                ${{ number_format($movimiento['entrada_total'], 2) }}
                                            @endif
                                        </td>
                                        
                                        <!-- Salidas -->
                                        <td class="text-center">
                                            @if($movimiento['salida_cantidad'] > 0)
                                                {{ number_format($movimiento['salida_cantidad'], 0) }}
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            @if($movimiento['salida_total'] > 0)
                                                ${{ number_format($movimiento['salida_costo'], 2) }}
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            @if($movimiento['salida_total'] > 0)
                                                ${{ number_format($movimiento['salida_total'], 2) }}
                                            @endif
                                        </td>
                                        
                                        <!-- Saldos -->
                                        <td class="text-center fw-bold">{{ number_format($movimiento['saldo_cantidad'], 0) }}</td>
                                        <td class="text-end fw-bold">${{ number_format($movimiento['saldo_costo'], 2) }}</td>
                                        <td class="text-end fw-bold text-primary">${{ number_format($movimiento['saldo_total'], 2) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="table-secondary">
                                    <tr>
                                        <td colspan="9" class="text-end fw-bold">SALDO FINAL:</td>
                                        <td class="text-center fw-bold">{{ number_format(end($movimientosKardex)['saldo_cantidad'], 0) }}</td>
                                        <td class="text-end fw-bold">${{ number_format(end($movimientosKardex)['saldo_costo'], 2) }}</td>
                                        <td class="text-end fw-bold text-primary">${{ number_format(end($movimientosKardex)['saldo_total'], 2) }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Resumen Estadístico -->
        <div class="row mt-4">
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title text-success">Total Entradas</h5>
                        <h3 class="text-success">{{ number_format(array_sum(array_column($movimientosKardex, 'entrada_cantidad')), 0) }}</h3>
                        <p class="card-text">${{ number_format(array_sum(array_column($movimientosKardex, 'entrada_total')), 2) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title text-danger">Total Salidas</h5>
                        <h3 class="text-danger">{{ number_format(array_sum(array_column($movimientosKardex, 'salida_cantidad')), 0) }}</h3>
                        <p class="card-text">${{ number_format(array_sum(array_column($movimientosKardex, 'salida_total')), 2) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Stock Final</h5>
                        <h3 class="text-primary">{{ number_format(end($movimientosKardex)['saldo_cantidad'], 0) }}</h3>
                        <p class="card-text">${{ number_format(end($movimientosKardex)['saldo_total'], 2) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title text-info">Movimientos</h5>
                        <h3 class="text-info">{{ count($movimientosKardex) }}</h3>
                        <p class="card-text">En el período</p>
                    </div>
                </div>
            </div>
        </div>

    @elseif($productoSeleccionado)
        <!-- No hay movimientos -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="fas fa-inbox fa-3x text-muted"></i>
                        </div>
                        <h5>No hay movimientos para mostrar</h5>
                        <p class="text-muted">No se encontraron movimientos para el producto seleccionado en el período especificado.</p>
                    </div>
                </div>
            </div>
        </div>

    @else
        <!-- Seleccionar producto -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="fas fa-search fa-3x text-primary"></i>
                        </div>
                        <h5>Seleccione un producto para ver su Kardex</h5>
                        <p class="text-muted">El reporte Kardex muestra todos los movimientos de entrada, salida y saldos de un producto específico.</p>
                        
                        <div class="row mt-4">
                            <div class="col-md-4 mx-auto">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h6 class="card-title">¿Qué es el Kardex?</h6>
                                        <p class="card-text small">
                                            El Kardex es un registro detallado que muestra:
                                        </p>
                                        <ul class="text-start small">
                                            <li>Entradas de mercancía</li>
                                            <li>Salidas por ventas</li>
                                            <li>Saldos en existencia</li>
                                            <li>Costos promedio</li>
                                            <li>Valores totales</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<script>
function limpiarFiltros() {
    document.querySelector('select[name="producto_id"]').value = '';
    document.querySelector('input[name="fecha_desde"]').value = '{{ date("Y-m-01") }}';
    document.querySelector('input[name="fecha_hasta"]').value = '{{ date("Y-m-d") }}';
    document.getElementById('filtrosForm').submit();
}

function exportarKardex() {
    // Aquí se implementaría la exportación a Excel
    alert('Funcionalidad de exportación a Excel en desarrollo');
}

function imprimirKardex() {
    const kardexTable = document.getElementById('kardexTable').outerHTML;
    const ventanaImpresion = window.open('', '_blank');
    
    ventanaImpresion.document.write(`
        <html>
        <head>
            <title>Reporte Kardex</title>
            <style>
                body { font-family: Arial, sans-serif; font-size: 12px; }
                table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                th, td { border: 1px solid #000; padding: 5px; text-align: center; }
                th { background-color: #f0f0f0; font-weight: bold; }
                .bg-success { background-color: #d4edda !important; }
                .bg-danger { background-color: #f8d7da !important; }
                .bg-primary { background-color: #d1ecf1 !important; }
                .text-end { text-align: right; }
                .fw-bold { font-weight: bold; }
                .text-primary { color: #0d6efd; }
                @media print {
                    body { margin: 0; }
                    .no-print { display: none; }
                }
            </style>
        </head>
        <body>
            <h2>Reporte Kardex de Inventario</h2>
            <p><strong>Producto:</strong> ${document.querySelector('select[name="producto_id"] option:checked').textContent}</p>
            <p><strong>Período:</strong> {{ $fechaDesde }} - {{ $fechaHasta }}</p>
            ${kardexTable}
            <script>window.print();</script>
        </body>
        </html>
    `);
    
    ventanaImpresion.document.close();
}
</script>

<style>
@media print {
    .no-print {
        display: none !important;
    }
    
    .table th {
        background-color: #f8f9fa !important;
        -webkit-print-color-adjust: exact;
    }
}
</style>
@endsection