@extends('layouts.app')

@section('title', 'Ver Plantilla - Parámetros Contables')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('parametros.index') }}">Parámetros Contables</a></li>
                    <li class="breadcrumb-item active">{{ $plantilla['nombre'] }}</li>
                </ol>
            </nav>
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h3 mb-0">
                    <i class="fas fa-eye text-info"></i>
                    {{ $plantilla['nombre'] }}
                    <span class="badge {{ $plantilla['activa'] ? 'bg-success' : 'bg-secondary' }} ms-2">
                        {{ $plantilla['activa'] ? 'Activa' : 'Inactiva' }}
                    </span>
                </h2>
                <div>
                    <a href="{{ route('parametros.edit', $plantilla['id']) }}" class="btn btn-outline-warning">
                        <i class="fas fa-edit"></i>
                        Editar
                    </a>
                    <a href="{{ route('parametros.index') }}" class="btn btn-outline-secondary">
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
                        <i class="fas fa-info-circle"></i>
                        Información General
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label text-muted">Nombre de la Plantilla</label>
                                <p class="h6">{{ $plantilla['nombre'] }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label text-muted">Tipo de Transacción</label>
                                <p>
                                    <span class="badge bg-primary">{{ ucfirst($plantilla['tipo']) }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label text-muted">Descripción</label>
                        <p>{{ $plantilla['descripcion'] }}</p>
                    </div>
                </div>
            </div>
            
            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-list"></i>
                        Estructura de Cuentas
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th width="15%">Tipo</th>
                                    <th width="35%">Concepto</th>
                                    <th width="35%">Fórmula</th>
                                    <th width="15%">Orden</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($plantilla['cuentas'] as $index => $cuenta)
                                <tr>
                                    <td>
                                        @if($cuenta['tipo'] === 'debito')
                                            <span class="badge bg-danger">
                                                <i class="fas fa-arrow-right"></i> Debe
                                            </span>
                                        @else
                                            <span class="badge bg-success">
                                                <i class="fas fa-arrow-left"></i> Haber
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $cuenta['concepto'] }}</strong>
                                    </td>
                                    <td>
                                        <code>{{ $cuenta['formula'] }}</code>
                                    </td>
                                    <td>
                                        <span class="text-muted">#{{ $index + 1 }}</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    @if(count($plantilla['cuentas']) === 0)
                    <div class="text-center py-4">
                        <i class="fas fa-exclamation-triangle text-warning fa-2x mb-3"></i>
                        <p class="text-muted">No hay cuentas definidas en esta plantilla</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-cog"></i>
                        Acciones
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('parametros.edit', $plantilla['id']) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i>
                            Editar Plantilla
                        </a>
                        
                        <a href="{{ route('parametros.toggle', $plantilla['id']) }}" 
                           class="btn {{ $plantilla['activa'] ? 'btn-outline-warning' : 'btn-outline-success' }}">
                            <i class="fas {{ $plantilla['activa'] ? 'fa-pause' : 'fa-play' }}"></i>
                            {{ $plantilla['activa'] ? 'Desactivar' : 'Activar' }}
                        </a>
                        
                        <button type="button" class="btn btn-outline-danger" onclick="confirmDelete()">
                            <i class="fas fa-trash"></i>
                            Eliminar Plantilla
                        </button>
                        
                        <hr>
                        
                        <button type="button" class="btn btn-outline-primary" onclick="showSimulation()">
                            <i class="fas fa-calculator"></i>
                            Simular Transacción
                        </button>
                    </div>
                </div>
            </div>
            
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
                            <div class="mb-2">
                                <h4 class="text-danger mb-0">{{ count(array_filter($plantilla['cuentas'], fn($c) => $c['tipo'] === 'debito')) }}</h4>
                                <small class="text-muted">Debe</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-2">
                                <h4 class="text-success mb-0">{{ count(array_filter($plantilla['cuentas'], fn($c) => $c['tipo'] === 'credito')) }}</h4>
                                <small class="text-muted">Haber</small>
                            </div>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="text-center">
                        <h5 class="text-primary mb-0">{{ count($plantilla['cuentas']) }}</h5>
                        <small class="text-muted">Total de Cuentas</small>
                    </div>
                </div>
            </div>
            
            <div class="card mt-3">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-info-circle"></i>
                        Variables Disponibles
                    </h6>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <code>subtotal</code>
                            <small class="text-muted d-block">Subtotal de la transacción</small>
                        </li>
                        <li class="mb-2">
                            <code>iva</code>
                            <small class="text-muted d-block">Impuesto al valor agregado</small>
                        </li>
                        <li class="mb-2">
                            <code>total</code>
                            <small class="text-muted d-block">Total de la transacción</small>
                        </li>
                        <li class="mb-2">
                            <code>descuento</code>
                            <small class="text-muted d-block">Descuento aplicado</small>
                        </li>
                        <li class="mb-0">
                            <code>cantidad</code>
                            <small class="text-muted d-block">Cantidad de productos</small>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Simulación -->
<div class="modal fade" id="simulationModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-calculator"></i>
                    Simulación de Transacción: {{ $plantilla['nombre'] }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Variables de Entrada:</h6>
                        <div class="mb-3">
                            <label class="form-label">Subtotal</label>
                            <input type="number" class="form-control" id="sim_subtotal" value="1000" step="0.01">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">IVA</label>
                            <input type="number" class="form-control" id="sim_iva" value="160" step="0.01">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Total</label>
                            <input type="number" class="form-control" id="sim_total" value="1160" step="0.01">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Descuento</label>
                            <input type="number" class="form-control" id="sim_descuento" value="0" step="0.01">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Cantidad</label>
                            <input type="number" class="form-control" id="sim_cantidad" value="1" step="1">
                        </div>
                        <button type="button" class="btn btn-primary" onclick="calculateSimulation()">
                            <i class="fas fa-calculator"></i>
                            Calcular
                        </button>
                    </div>
                    <div class="col-md-6">
                        <h6>Resultado de la Simulación:</h6>
                        <div id="simulationResult">
                            <p class="text-muted">Ingrese los valores y haga clic en "Calcular"</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Formulario de eliminación oculto -->
<form id="deleteForm" action="{{ route('parametros.destroy', $plantilla['id']) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection

@section('scripts')
<script>
function confirmDelete() {
    if (confirm('¿Está seguro de que desea eliminar esta plantilla? Esta acción no se puede deshacer.')) {
        document.getElementById('deleteForm').submit();
    }
}

function showSimulation() {
    const modal = new bootstrap.Modal(document.getElementById('simulationModal'));
    modal.show();
}

function calculateSimulation() {
    const subtotal = parseFloat(document.getElementById('sim_subtotal').value) || 0;
    const iva = parseFloat(document.getElementById('sim_iva').value) || 0;
    const total = parseFloat(document.getElementById('sim_total').value) || 0;
    const descuento = parseFloat(document.getElementById('sim_descuento').value) || 0;
    const cantidad = parseInt(document.getElementById('sim_cantidad').value) || 0;
    
    const variables = { subtotal, iva, total, descuento, cantidad };
    
    let resultHtml = '<div class="table-responsive"><table class="table table-sm"><thead><tr><th>Cuenta</th><th>Debe</th><th>Haber</th></tr></thead><tbody>';
    let totalDebe = 0;
    let totalHaber = 0;
    
    @foreach($plantilla['cuentas'] as $cuenta)
    try {
        // Evaluación simple de fórmulas matemáticas básicas
        let formula = '{{ $cuenta["formula"] }}';
        let valor = 0;
        
        // Reemplazar variables
        formula = formula.replace(/subtotal/g, subtotal);
        formula = formula.replace(/iva/g, iva);
        formula = formula.replace(/total/g, total);
        formula = formula.replace(/descuento/g, descuento);
        formula = formula.replace(/cantidad/g, cantidad);
        
        // Evaluación segura de expresiones matemáticas básicas
        if (/^[\d\+\-\*\/\.\(\)\s]+$/.test(formula)) {
            valor = eval(formula);
        } else {
            valor = parseFloat(formula) || 0;
        }
        
        if ('{{ $cuenta["tipo"] }}' === 'debito') {
            totalDebe += valor;
            resultHtml += `<tr><td>{{ $cuenta["concepto"] }}</td><td>$${valor.toFixed(2)}</td><td>-</td></tr>`;
        } else {
            totalHaber += valor;
            resultHtml += `<tr><td>{{ $cuenta["concepto"] }}</td><td>-</td><td>$${valor.toFixed(2)}</td></tr>`;
        }
    } catch (e) {
        resultHtml += `<tr><td>{{ $cuenta["concepto"] }}</td><td colspan="2" class="text-danger">Error en fórmula</td></tr>`;
    }
    @endforeach
    
    resultHtml += `<tr class="table-light"><th>TOTALES</th><th>$${totalDebe.toFixed(2)}</th><th>$${totalHaber.toFixed(2)}</th></tr>`;
    resultHtml += '</tbody></table></div>';
    
    const balance = totalDebe - totalHaber;
    if (Math.abs(balance) < 0.01) {
        resultHtml += '<div class="alert alert-success"><i class="fas fa-check"></i> La partida está balanceada</div>';
    } else {
        resultHtml += `<div class="alert alert-warning"><i class="fas fa-exclamation-triangle"></i> Diferencia: $${Math.abs(balance).toFixed(2)}</div>`;
    }
    
    document.getElementById('simulationResult').innerHTML = resultHtml;
}
</script>
@endsection