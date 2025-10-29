@extends('layouts.app')

@section('title', 'Nuevo Documento Electrónico')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('documentos-electronicos.index') }}">Documentos Electrónicos</a></li>
                    <li class="breadcrumb-item active">Nuevo Documento</li>
                </ol>
            </nav>
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h3 mb-0">
                    <i class="fas fa-file-plus text-primary"></i>
                    Nuevo Documento Electrónico
                </h2>
                <a href="{{ route('documentos-electronicos.index') }}" class="btn btn-outline-secondary">
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
                        <i class="fas fa-file-contract"></i>
                        Información del Documento
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('documentos-electronicos.store') }}" method="POST" id="documentoForm">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Tipo de Documento *</label>
                                    <select class="form-select @error('tipo_documento') is-invalid @enderror" 
                                            name="tipo_documento" required onchange="actualizarSerie()">
                                        <option value="">Seleccionar tipo...</option>
                                        @foreach($tipos_documento as $key => $tipo)
                                        <option value="{{ $key }}" {{ old('tipo_documento') == $key ? 'selected' : '' }}>
                                            {{ $tipo }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('tipo_documento')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Serie</label>
                                    <input type="text" class="form-control" name="serie" 
                                           value="{{ old('serie', 'A') }}" id="serie" maxlength="25">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Folio *</label>
                                    <input type="number" class="form-control @error('folio') is-invalid @enderror" 
                                           name="folio" value="{{ old('folio', 1) }}" required min="1">
                                    @error('folio')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Cliente/Receptor *</label>
                                    <select class="form-select @error('cliente_id') is-invalid @enderror" 
                                            name="cliente_id" required onchange="cargarDatosCliente()">
                                        <option value="">Seleccionar cliente...</option>
                                        @foreach($clientes as $cliente)
                                        <option value="{{ $cliente['id'] }}" 
                                                data-rfc="{{ $cliente['rfc'] }}"
                                                {{ old('cliente_id') == $cliente['id'] ? 'selected' : '' }}>
                                            {{ $cliente['nombre'] }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('cliente_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">RFC del Cliente</label>
                                    <input type="text" class="form-control" name="cliente_rfc" 
                                           id="cliente_rfc" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Fecha de Emisión *</label>
                                    <input type="date" class="form-control @error('fecha_emision') is-invalid @enderror" 
                                           name="fecha_emision" value="{{ old('fecha_emision', date('Y-m-d')) }}" required>
                                    @error('fecha_emision')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Método de Pago *</label>
                                    <select class="form-select" name="metodo_pago" required>
                                        <option value="PUE">PUE - Pago en una sola exhibición</option>
                                        <option value="PPD">PPD - Pago en parcialidades o diferido</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Forma de Pago</label>
                                    <select class="form-select" name="forma_pago">
                                        <option value="01">01 - Efectivo</option>
                                        <option value="02">02 - Cheque nominativo</option>
                                        <option value="03">03 - Transferencia electrónica</option>
                                        <option value="04">04 - Tarjeta de crédito</option>
                                        <option value="28">28 - Tarjeta de débito</option>
                                        <option value="99">99 - Por definir</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Uso CFDI *</label>
                                    <select class="form-select" name="uso_cfdi" required>
                                        <option value="G01">G01 - Adquisición de mercancías</option>
                                        <option value="G02">G02 - Devoluciones, descuentos o bonificaciones</option>
                                        <option value="G03">G03 - Gastos en general</option>
                                        <option value="I01">I01 - Construcciones</option>
                                        <option value="I02">I02 - Mobiliario y equipo de oficina</option>
                                        <option value="P01">P01 - Por definir</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <!-- Conceptos -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6>
                                    <i class="fas fa-list"></i>
                                    Conceptos del Documento
                                </h6>
                                <button type="button" class="btn btn-sm btn-outline-primary" onclick="agregarConcepto()">
                                    <i class="fas fa-plus"></i>
                                    Agregar Concepto
                                </button>
                            </div>
                            
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tablaConceptos">
                                    <thead class="table-light">
                                        <tr>
                                            <th width="10%">Cantidad</th>
                                            <th width="10%">Unidad</th>
                                            <th width="8%">Clave SAT</th>
                                            <th width="35%">Descripción</th>
                                            <th width="12%">Precio Unit.</th>
                                            <th width="10%">IVA</th>
                                            <th width="12%">Importe</th>
                                            <th width="3%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="number" class="form-control form-control-sm cantidad" 
                                                       name="conceptos[0][cantidad]" value="1" min="0.01" step="0.01" 
                                                       onchange="calcularImporte(this)">
                                            </td>
                                            <td>
                                                <select class="form-select form-select-sm" name="conceptos[0][unidad]">
                                                    <option value="H87">H87 - Pieza</option>
                                                    <option value="E48">E48 - Servicio</option>
                                                    <option value="KGM">KGM - Kilogramo</option>
                                                    <option value="LTR">LTR - Litro</option>
                                                    <option value="MTR">MTR - Metro</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm" 
                                                       name="conceptos[0][clave_sat]" value="01010101" maxlength="8">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm" 
                                                       name="conceptos[0][descripcion]" required 
                                                       placeholder="Descripción del producto o servicio">
                                            </td>
                                            <td>
                                                <input type="number" class="form-control form-control-sm precio" 
                                                       name="conceptos[0][precio_unitario]" min="0" step="0.01" 
                                                       onchange="calcularImporte(this)">
                                            </td>
                                            <td>
                                                <select class="form-select form-select-sm iva" name="conceptos[0][iva]" onchange="calcularImporte(this)">
                                                    <option value="0">0%</option>
                                                    <option value="13" selected>13%</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control form-control-sm importe" 
                                                       name="conceptos[0][importe]" readonly>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-outline-danger" 
                                                        onclick="eliminarConcepto(this)">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <!-- Totales -->
                        <div class="row">
                            <div class="col-md-8"></div>
                            <div class="col-md-4">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>Subtotal:</span>
                                            <span id="subtotal">$0.00</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>IVA:</span>
                                            <span id="totalIva">$0.00</span>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between fw-bold">
                                            <span>Total:</span>
                                            <span id="total">$0.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('documentos-electronicos.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i>
                                Cancelar
                            </a>
                            <button type="submit" class="btn btn-success" name="accion" value="guardar">
                                <i class="fas fa-save"></i>
                                Guardar Borrador
                            </button>
                            <button type="submit" class="btn btn-primary" name="accion" value="timbrar">
                                <i class="fas fa-stamp"></i>
                                Guardar y Timbrar
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
                        Guía Rápida CFDI 4.0
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Tipos de Documento:</strong>
                        <ul class="small text-muted mt-1">
                            <li><strong>Factura:</strong> Documento fiscal principal</li>
                            <li><strong>Nota de Crédito:</strong> Devoluciones o descuentos</li>
                            <li><strong>Carta Porte:</strong> Transporte de mercancías</li>
                            <li><strong>Recibo de Honorarios:</strong> Servicios profesionales</li>
                        </ul>
                    </div>
                    
                    <div class="mb-3">
                        <strong>Métodos de Pago:</strong>
                        <ul class="small text-muted mt-1">
                            <li><strong>PUE:</strong> Pago inmediato</li>
                            <li><strong>PPD:</strong> Pago posterior</li>
                        </ul>
                    </div>
                    
                    <div class="mb-3">
                        <strong>Uso CFDI Común:</strong>
                        <ul class="small text-muted mt-1">
                            <li><strong>G01:</strong> Adquisición de mercancías</li>
                            <li><strong>G03:</strong> Gastos en general</li>
                            <li><strong>P01:</strong> Por definir</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Validaciones -->
            <div class="card mt-3">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-shield-alt"></i>
                        Validaciones SAT
                    </h6>
                </div>
                <div class="card-body">
                    <div id="validaciones">
                        <div class="alert alert-info small">
                            <i class="fas fa-info-circle"></i>
                            Complete los campos para validar automáticamente con las reglas del SAT.
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Estado del PAC -->
            <div class="card mt-3">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-link"></i>
                        Estado del PAC
                    </h6>
                </div>
                <div class="card-body text-center">
                    <div class="text-success mb-2">
                        <i class="fas fa-check-circle fa-2x"></i>
                    </div>
                    <h6 class="text-success">Conectado</h6>
                    <small class="text-muted">850 timbres disponibles</small>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let conceptoIndex = 1;

function actualizarSerie() {
    const tipo = document.querySelector('select[name="tipo_documento"]').value;
    const serieInput = document.getElementById('serie');
    
    const series = {
        'factura': 'A',
        'nota_credito': 'NC',
        'nota_debito': 'ND',
        'carta_porte': 'CP',
        'recibo_honorarios': 'RH',
        'recibo_arrendamiento': 'RA'
    };
    
    serieInput.value = series[tipo] || 'A';
}

function cargarDatosCliente() {
    const clienteSelect = document.querySelector('select[name="cliente_id"]');
    const rfcInput = document.getElementById('cliente_rfc');
    
    const selectedOption = clienteSelect.options[clienteSelect.selectedIndex];
    if (selectedOption && selectedOption.dataset.rfc) {
        rfcInput.value = selectedOption.dataset.rfc;
    } else {
        rfcInput.value = '';
    }
}

function agregarConcepto() {
    const tbody = document.querySelector('#tablaConceptos tbody');
    const newRow = document.createElement('tr');
    
    newRow.innerHTML = `
        <td>
            <input type="number" class="form-control form-control-sm cantidad" 
                   name="conceptos[${conceptoIndex}][cantidad]" value="1" min="0.01" step="0.01" 
                   onchange="calcularImporte(this)">
        </td>
        <td>
            <select class="form-select form-select-sm" name="conceptos[${conceptoIndex}][unidad]">
                <option value="H87">H87 - Pieza</option>
                <option value="E48">E48 - Servicio</option>
                <option value="KGM">KGM - Kilogramo</option>
                <option value="LTR">LTR - Litro</option>
                <option value="MTR">MTR - Metro</option>
            </select>
        </td>
        <td>
            <input type="text" class="form-control form-control-sm" 
                   name="conceptos[${conceptoIndex}][clave_sat]" value="01010101" maxlength="8">
        </td>
        <td>
            <input type="text" class="form-control form-control-sm" 
                   name="conceptos[${conceptoIndex}][descripcion]" required 
                   placeholder="Descripción del producto o servicio">
        </td>
        <td>
            <input type="number" class="form-control form-control-sm precio" 
                   name="conceptos[${conceptoIndex}][precio_unitario]" min="0" step="0.01" 
                   onchange="calcularImporte(this)">
        </td>
        <td>
            <select class="form-select form-select-sm iva" name="conceptos[${conceptoIndex}][iva]" onchange="calcularImporte(this)">
                <option value="0">0%</option>
                <option value="13" selected>13%</option>
            </select>
        </td>
        <td>
            <input type="number" class="form-control form-control-sm importe" 
                   name="conceptos[${conceptoIndex}][importe]" readonly>
        </td>
        <td>
            <button type="button" class="btn btn-sm btn-outline-danger" 
                    onclick="eliminarConcepto(this)">
                <i class="fas fa-trash"></i>
            </button>
        </td>
    `;
    
    tbody.appendChild(newRow);
    conceptoIndex++;
}

function eliminarConcepto(btn) {
    const row = btn.closest('tr');
    const tbody = row.parentElement;
    
    if (tbody.children.length > 1) {
        row.remove();
        calcularTotales();
    } else {
        alert('Debe mantener al menos un concepto.');
    }
}

function calcularImporte(element) {
    const row = element.closest('tr');
    const cantidad = parseFloat(row.querySelector('.cantidad').value) || 0;
    const precio = parseFloat(row.querySelector('.precio').value) || 0;
    const iva = parseInt(row.querySelector('.iva').value) || 0;
    
    const subtotal = cantidad * precio;
    const ivaAmount = subtotal * (iva / 100);
    const importe = subtotal + ivaAmount;
    
    row.querySelector('.importe').value = importe.toFixed(2);
    
    calcularTotales();
}

function calcularTotales() {
    let subtotal = 0;
    let totalIva = 0;
    
    document.querySelectorAll('#tablaConceptos tbody tr').forEach(row => {
        const cantidad = parseFloat(row.querySelector('.cantidad').value) || 0;
        const precio = parseFloat(row.querySelector('.precio').value) || 0;
        const iva = parseInt(row.querySelector('.iva').value) || 0;
        
        const subtotalConcepto = cantidad * precio;
        const ivaConcepto = subtotalConcepto * (iva / 100);
        
        subtotal += subtotalConcepto;
        totalIva += ivaConcepto;
    });
    
    const total = subtotal + totalIva;
    
    document.getElementById('subtotal').textContent = '$' + subtotal.toFixed(2);
    document.getElementById('totalIva').textContent = '$' + totalIva.toFixed(2);
    document.getElementById('total').textContent = '$' + total.toFixed(2);
}

// Inicializar
document.addEventListener('DOMContentLoaded', function() {
    calcularTotales();
});
</script>
@endsection