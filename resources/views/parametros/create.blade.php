@extends('layouts.app')

@section('title', 'Crear Plantilla - Parámetros Contables')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('parametros.index') }}">Parámetros Contables</a></li>
                    <li class="breadcrumb-item active">Nueva Plantilla</li>
                </ol>
            </nav>
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h3 mb-0">
                    <i class="fas fa-plus text-primary"></i>
                    Nueva Plantilla de Transacción
                </h2>
                <a href="{{ route('parametros.index') }}" class="btn btn-outline-secondary">
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
                        <i class="fas fa-cog"></i>
                        Configuración de la Plantilla
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('parametros.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nombre de la Plantilla *</label>
                                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" 
                                           name="nombre" value="{{ old('nombre') }}" required>
                                    @error('nombre')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Tipo de Transacción *</label>
                                    <select class="form-select @error('tipo') is-invalid @enderror" name="tipo" required>
                                        <option value="">Seleccionar tipo</option>
                                        <option value="venta" {{ old('tipo') === 'venta' ? 'selected' : '' }}>Venta</option>
                                        <option value="compra" {{ old('tipo') === 'compra' ? 'selected' : '' }}>Compra</option>
                                        <option value="nomina" {{ old('tipo') === 'nomina' ? 'selected' : '' }}>Nómina</option>
                                        <option value="gasto" {{ old('tipo') === 'gasto' ? 'selected' : '' }}>Gasto</option>
                                        <option value="otro" {{ old('tipo') === 'otro' ? 'selected' : '' }}>Otro</option>
                                    </select>
                                    @error('tipo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Descripción *</label>
                            <textarea class="form-control @error('descripcion') is-invalid @enderror" 
                                      name="descripcion" rows="3" required>{{ old('descripcion') }}</textarea>
                            @error('descripcion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Describe el propósito y uso de esta plantilla</div>
                        </div>
                        
                        <hr>
                        
                        <div class="mb-3">
                            <label class="form-label">Estructura de Cuentas *</label>
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i>
                                <strong>Información:</strong> Define las cuentas que se afectarán con esta transacción.
                                Puedes usar variables como: <code>subtotal</code>, <code>iva</code>, <code>total</code>, <code>descuento</code>
                            </div>
                            
                            <div id="cuentasContainer">
                                <!-- Se llenará dinámicamente -->
                            </div>
                            
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="addCuentaRow()">
                                <i class="fas fa-plus"></i> Agregar Cuenta
                            </button>
                        </div>
                        
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('parametros.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i>
                                Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i>
                                Guardar Plantilla
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-lightbulb"></i>
                        Ejemplos de Fórmulas
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Variables disponibles:</strong>
                        <ul class="list-unstyled mt-2">
                            <li><code>subtotal</code> - Subtotal de la transacción</li>
                            <li><code>iva</code> - Impuesto al valor agregado</li>
                            <li><code>total</code> - Total de la transacción</li>
                            <li><code>descuento</code> - Descuento aplicado</li>
                            <li><code>cantidad</code> - Cantidad de productos</li>
                        </ul>
                    </div>
                    
                    <div class="mb-3">
                        <strong>Ejemplos de uso:</strong>
                        <ul class="list-unstyled mt-2">
                            <li><code>subtotal + iva</code></li>
                            <li><code>total - descuento</code></li>
                            <li><code>subtotal * 0.13</code></li>
                            <li><code>cantidad * precio</code></li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="card mt-3">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-question-circle"></i>
                        Ayuda
                    </h6>
                </div>
                <div class="card-body">
                    <p class="mb-2"><strong>Debe vs Haber:</strong></p>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-arrow-right text-primary"></i> <strong>Debe:</strong> Incrementa activos y gastos</li>
                        <li><i class="fas fa-arrow-left text-success"></i> <strong>Haber:</strong> Incrementa pasivos, capital e ingresos</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
let cuentaIndex = 0;

function addCuentaRow() {
    const container = document.getElementById('cuentasContainer');
    const row = document.createElement('div');
    row.className = 'row mb-3 cuenta-row border p-3 rounded';
    row.innerHTML = `
        <div class="col-md-2">
            <label class="form-label">Tipo</label>
            <select class="form-select" name="cuentas[${cuentaIndex}][tipo]" required>
                <option value="debito">Debe</option>
                <option value="credito">Haber</option>
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label">Concepto</label>
            <input type="text" class="form-control" name="cuentas[${cuentaIndex}][concepto]" 
                   placeholder="Ej: Caja, Ventas, IVA por Pagar" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Fórmula</label>
            <input type="text" class="form-control" name="cuentas[${cuentaIndex}][formula]" 
                   placeholder="Ej: subtotal + iva" required>
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button type="button" class="btn btn-outline-danger" onclick="removeCuentaRow(this)">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    `;
    container.appendChild(row);
    cuentaIndex++;
}

function removeCuentaRow(button) {
    if (document.querySelectorAll('.cuenta-row').length > 1) {
        button.closest('.cuenta-row').remove();
    } else {
        alert('Debe tener al menos una cuenta en la plantilla');
    }
}

// Inicializar con dos filas por defecto
document.addEventListener('DOMContentLoaded', function() {
    addCuentaRow();
    addCuentaRow();
});
</script>
@endsection