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
                                    <div class="input-group">
                                        <div class="position-relative flex-grow-1">
                                            <input type="text" class="form-control @error('cliente_id') is-invalid @enderror" 
                                                   id="clienteBuscador" placeholder="Buscar cliente por nombre o documento..." 
                                                   autocomplete="off" onkeyup="buscarClientes()" 
                                                   onfocus="mostrarListaClientes()">
                                            <input type="hidden" name="cliente_id" id="clienteIdHidden" required>
                                            
                                            <!-- Lista desplegable de resultados -->
                                            <div id="listaClientes" class="dropdown-menu w-100" style="max-height: 200px; overflow-y: auto; display: none;">
                                                <!-- Los resultados se cargarán aquí dinámicamente -->
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-outline-success" 
                                                data-bs-toggle="modal" data-bs-target="#modalCrearClienteDocumento"
                                                title="Agregar nuevo cliente">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    @error('cliente_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Escriba para buscar un cliente o créelo si no existe</div>
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

<!-- Contenedor para alertas -->
<div id="alertContainer" class="position-fixed top-0 end-0 p-3" style="z-index: 9999;"></div>

<!-- Modal para crear nuevo cliente -->
<div class="modal fade" id="modalCrearClienteDocumento" tabindex="-1" aria-labelledby="modalCrearClienteDocumentoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCrearClienteDocumentoLabel">
                    <i class="fas fa-user-plus text-success"></i>
                    Crear Nuevo Cliente
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formCrearClienteDocumento" onsubmit="guardarClienteDocumento(event)">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nombre/Razón Social *</label>
                                <input type="text" class="form-control" name="nombre" required 
                                       placeholder="Nombre completo o razón social">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Tipo de Persona *</label>
                                <select class="form-select" name="tipo_persona" onchange="actualizarCamposIdentificacion()" required>
                                    <option value="">Seleccionar...</option>
                                    <option value="natural">Persona Natural</option>
                                    <option value="juridica">Persona Jurídica</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Nacionalidad *</label>
                                <select class="form-select" name="nacionalidad" onchange="actualizarCamposIdentificacion()" required>
                                    <option value="">Seleccionar...</option>
                                    <option value="nacional" selected>Nacional</option>
                                    <option value="extranjero">Extranjero</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" id="labelIdentificacion">Número de Identificación *</label>
                                <input type="text" class="form-control" name="numero_identificacion" required 
                                       id="numeroIdentificacion" placeholder="Ingrese número de identificación">
                                <div class="form-text" id="ayudaIdentificacion">
                                    Seleccione tipo de persona y nacionalidad
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Alias</label>
                                <input type="text" class="form-control" name="alias" 
                                       placeholder="Nombre comercial o alias">
                                <div class="form-text">Nombre corto para identificar fácilmente al cliente</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Campos adicionales para personas jurídicas -->
                    <div class="row" id="camposJuridicos" style="display: none;">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Actividad Económica</label>
                                <input type="text" class="form-control" name="actividad_economica" 
                                       placeholder="Descripción de la actividad económica">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">CRN (Número de Registro)</label>
                                <input type="text" class="form-control" name="crn" 
                                       placeholder="Número de registro de 15 dígitos"
                                       pattern="[0-9]{1,15}" maxlength="15"
                                       oninput="aplicarMascaraCRN(this)">
                                <div class="form-text">Número de registro comercial (máximo 15 dígitos)</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" 
                                       placeholder="correo@ejemplo.com">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Teléfono</label>
                                <input type="tel" class="form-control" name="telefono" 
                                       placeholder="Número de teléfono">
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Dirección Complementaria</label>
                        <textarea class="form-control" name="direccion_complementaria" rows="2" 
                                  placeholder="Dirección detallada (colonia, referencias, etc.)"></textarea>
                        <div class="form-text">Información adicional de ubicación</div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Departamento *</label>
                                <select class="form-select" name="departamento" onchange="cargarMunicipiosDocumento()" required>
                                    <option value="">Seleccionar departamento...</option>
                                    <option value="ahuachapan">Ahuachapán</option>
                                    <option value="cabanas">Cabañas</option>
                                    <option value="chalatenango">Chalatenango</option>
                                    <option value="cuscatlan">Cuscatlán</option>
                                    <option value="la_libertad">La Libertad</option>
                                    <option value="la_paz">La Paz</option>
                                    <option value="la_union">La Unión</option>
                                    <option value="morazan">Morazán</option>
                                    <option value="san_miguel">San Miguel</option>
                                    <option value="san_salvador">San Salvador</option>
                                    <option value="san_vicente">San Vicente</option>
                                    <option value="santa_ana">Santa Ana</option>
                                    <option value="sonsonate">Sonsonate</option>
                                    <option value="usulutan">Usulután</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Municipio *</label>
                                <select class="form-select" name="municipio" onchange="cargarDistritosDocumento()" required>
                                    <option value="">Seleccionar municipio...</option>
                                    <!-- Se cargarán dinámicamente -->
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Distrito</label>
                                <select class="form-select" name="distrito">
                                    <option value="">Seleccionar distrito...</option>
                                    <!-- Se cargarán dinámicamente -->
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Límite de Crédito</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control" name="limite_credito" 
                                           step="0.01" min="0" placeholder="0.00">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Días de Crédito</label>
                                <select class="form-select" name="dias_credito">
                                    <option value="0">Contado</option>
                                    <option value="15">15 días</option>
                                    <option value="30" selected>30 días</option>
                                    <option value="45">45 días</option>
                                    <option value="60">60 días</option>
                                    <option value="90">90 días</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Estado</label>
                                <select class="form-select" name="activo">
                                    <option value="1" selected>Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i>
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i>
                        Crear y Seleccionar Cliente
                    </button>
                </div>
            </form>
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

// Funciones para gestión de clientes
// Datos simulados de clientes (en producción vendrían de la base de datos)
let clientes = [
    {
        id: 1,
        nombre: 'Empresa ABC S.A. de C.V.',
        numero_identificacion: '1234567890123',
        telefono: '2234-5678',
        email: 'facturacion@empresaabc.com'
    },
    {
        id: 2,
        nombre: 'Comercial XYZ Ltda.',
        numero_identificacion: '9876543210987',
        telefono: '2345-6789',
        email: 'ventas@comercialxyz.com'
    },
    {
        id: 3,
        nombre: 'Servicios Profesionales MNO',
        numero_identificacion: '4567890123456',
        telefono: '2456-7890',
        email: 'info@serviciosmno.com'
    }
];

function buscarClientes() {
    const termino = document.getElementById('clienteBuscador').value.toLowerCase();
    const lista = document.getElementById('listaClientes');
    
    if (termino.length < 2) {
        lista.style.display = 'none';
        return;
    }
    
    const clientesFiltrados = clientes.filter(cliente => 
        cliente.nombre.toLowerCase().includes(termino) ||
        cliente.numero_identificacion.includes(termino) ||
        (cliente.email && cliente.email.toLowerCase().includes(termino))
    );
    
    mostrarResultadosClientes(clientesFiltrados);
}

function mostrarListaClientes() {
    if (clientes.length > 0) {
        mostrarResultadosClientes(clientes.slice(0, 10)); // Mostrar máximo 10 clientes
    }
}

function mostrarResultadosClientes(clientesFiltrados) {
    const lista = document.getElementById('listaClientes');
    
    if (clientesFiltrados.length === 0) {
        lista.innerHTML = `
            <div class="dropdown-item text-muted">
                <i class="fas fa-search"></i>
                No se encontraron clientes
            </div>
            <div class="dropdown-item" onclick="abrirModalCrearCliente()">
                <i class="fas fa-plus text-success"></i>
                <strong class="text-success">Crear nuevo cliente</strong>
            </div>
        `;
    } else {
        lista.innerHTML = clientesFiltrados.map(cliente => `
            <div class="dropdown-item" onclick="seleccionarCliente(${cliente.id}, '${cliente.nombre}', '${cliente.numero_identificacion}')">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <strong>${cliente.nombre}</strong>
                        <br>
                        <small class="text-muted">${cliente.numero_identificacion}</small>
                    </div>
                    <div class="text-end">
                        <small class="text-muted">${cliente.telefono || ''}</small>
                        <br>
                        <small class="text-muted">${cliente.email || ''}</small>
                    </div>
                </div>
            </div>
        `).join('') + `
            <div class="dropdown-item" onclick="abrirModalCrearCliente()">
                <i class="fas fa-plus text-success"></i>
                <strong class="text-success">Crear nuevo cliente</strong>
            </div>
        `;
    }
    
    lista.style.display = 'block';
}

function seleccionarCliente(id, nombre, documento) {
    document.getElementById('clienteBuscador').value = nombre;
    document.getElementById('clienteIdHidden').value = id;
    document.getElementById('cliente_rfc').value = documento;
    document.getElementById('listaClientes').style.display = 'none';
}

function abrirModalCrearCliente() {
    document.getElementById('listaClientes').style.display = 'none';
    const modal = new bootstrap.Modal(document.getElementById('modalCrearClienteDocumento'));
    modal.show();
}

// Ocultar lista cuando se hace clic fuera
document.addEventListener('click', function(event) {
    const buscador = document.getElementById('clienteBuscador');
    const lista = document.getElementById('listaClientes');
    
    if (!buscador.contains(event.target) && !lista.contains(event.target)) {
        lista.style.display = 'none';
    }
});

function guardarClienteDocumento(event) {
    event.preventDefault();
    
    // Validar formulario antes de procesar
    if (!validarFormularioClienteDocumento()) {
        return;
    }
    
    const formData = new FormData(event.target);
    const clienteData = Object.fromEntries(formData);
    
    // Validar campos requeridos básicos
    if (!clienteData.nombre || !clienteData.numero_identificacion) {
        mostrarToast('Error', 'Por favor complete todos los campos obligatorios', 'error');
        return;
    }
    
    // Simular guardado del cliente (en una implementación real, sería una llamada AJAX)
    const nuevoId = Date.now(); // ID temporal
    const clienteCompleto = {
        id: nuevoId,
        nombre: clienteData.nombre,
        alias: clienteData.alias || '',
        tipo_persona: clienteData.tipo_persona,
        nacionalidad: clienteData.nacionalidad,
        numero_identificacion: clienteData.numero_identificacion,
        actividad_economica: clienteData.actividad_economica || '',
        crn: clienteData.crn || '',
        email: clienteData.email || '',
        telefono: clienteData.telefono || '',
        direccion_complementaria: clienteData.direccion_complementaria || '',
        departamento: clienteData.departamento || '',
        municipio: clienteData.municipio || '',
        distrito: clienteData.distrito || '',
        limite_credito: parseFloat(clienteData.limite_credito) || 0,
        dias_credito: parseInt(clienteData.dias_credito) || 0,
        activo: clienteData.activo === '1'
    };
    
    // Agregar el nuevo cliente a la lista de clientes
    clientes.push(clienteCompleto);
    
    // Seleccionar el nuevo cliente en el buscador
    seleccionarCliente(nuevoId, clienteCompleto.nombre, clienteCompleto.numero_identificacion);
    
    // Mostrar mensaje de éxito
    const toast = document.createElement('div');
    toast.className = 'toast align-items-center text-white bg-success border-0 position-fixed top-0 end-0 m-3';
    toast.setAttribute('role', 'alert');
    toast.style.zIndex = '9999';
    toast.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">
                <i class="fas fa-check-circle me-2"></i>
                Cliente "${clienteCompleto.nombre}" creado y seleccionado exitosamente
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    `;
    
    document.body.appendChild(toast);
    const bsToast = new bootstrap.Toast(toast);
    bsToast.show();
    
    // Cerrar modal y limpiar formulario
    const modal = bootstrap.Modal.getInstance(document.getElementById('modalCrearClienteDocumento'));
    modal.hide();
    event.target.reset();
    
    // Remover toast después de que se oculte
    toast.addEventListener('hidden.bs.toast', () => {
        toast.remove();
    });
}

function validarFormularioClienteDocumento() {
    // Implementar validaciones básicas
    return true;
}

function mostrarToast(titulo, mensaje, tipo) {
    const toast = document.createElement('div');
    const colorClase = tipo === 'error' ? 'bg-danger' : 'bg-success';
    toast.className = `toast align-items-center text-white ${colorClase} border-0 position-fixed top-0 end-0 m-3`;
    toast.setAttribute('role', 'alert');
    toast.style.zIndex = '9999';
    toast.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">
                <strong>${titulo}:</strong> ${mensaje}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    `;
    
    document.body.appendChild(toast);
    const bsToast = new bootstrap.Toast(toast);
    bsToast.show();
    
    toast.addEventListener('hidden.bs.toast', () => {
        toast.remove();
    });
}

function actualizarCamposIdentificacion() {
    const tipoPersona = document.querySelector('#modalCrearClienteDocumento select[name="tipo_persona"]').value;
    const nacionalidad = document.querySelector('#modalCrearClienteDocumento select[name="nacionalidad"]').value;
    const labelIdentificacion = document.getElementById('labelIdentificacion');
    const inputIdentificacion = document.getElementById('numeroIdentificacion');
    const ayudaIdentificacion = document.getElementById('ayudaIdentificacion');
    const camposJuridicos = document.getElementById('camposJuridicos');
    
    // Mostrar/ocultar campos jurídicos
    if (tipoPersona === 'juridica') {
        camposJuridicos.style.display = 'flex';
    } else {
        camposJuridicos.style.display = 'none';
    }
    
    // Actualizar etiquetas según tipo de persona y nacionalidad
    if (tipoPersona && nacionalidad) {
        if (tipoPersona === 'natural') {
            if (nacionalidad === 'nacional') {
                labelIdentificacion.textContent = 'DUI *';
                inputIdentificacion.placeholder = '12345678-9';
                inputIdentificacion.maxLength = 10;
                ayudaIdentificacion.textContent = 'Formato: 12345678-9';
            } else {
                labelIdentificacion.textContent = 'Pasaporte *';
                inputIdentificacion.placeholder = 'Número de pasaporte';
                inputIdentificacion.maxLength = 20;
                ayudaIdentificacion.textContent = 'Número de pasaporte o documento extranjero';
            }
        } else {
            if (nacionalidad === 'nacional') {
                labelIdentificacion.textContent = 'NIT *';
                inputIdentificacion.placeholder = '1234-567890-123-4';
                inputIdentificacion.maxLength = 17;
                ayudaIdentificacion.textContent = 'Formato: 1234-567890-123-4';
            } else {
                labelIdentificacion.textContent = 'Número de Identificación Fiscal *';
                inputIdentificacion.placeholder = 'RFC o identificación fiscal';
                inputIdentificacion.maxLength = 20;
                ayudaIdentificacion.textContent = 'RFC o número de identificación fiscal extranjero';
            }
        }
    } else {
        labelIdentificacion.textContent = 'Número de Identificación *';
        inputIdentificacion.placeholder = 'Ingrese número de identificación';
        ayudaIdentificacion.textContent = 'Seleccione tipo de persona y nacionalidad';
    }
}

function aplicarMascaraCRN(input) {
    // Permitir solo números
    input.value = input.value.replace(/[^0-9]/g, '');
}

function mostrarAlerta(tipo, mensaje) {
    mostrarToast(tipo === 'success' ? 'Éxito' : 'Error', mensaje, tipo === 'success' ? 'success' : 'error');
}

// Funciones para cargar datos geográficos de El Salvador
// Datos oficiales de El Salvador - Municipios (Zonas Geográficas) por Departamento
const municipiosPorDepartamento = {
    'ahuachapan': ['Ahuachapán Centro', 'Ahuachapán Norte', 'Ahuachapán Sur'],
    'santa_ana': ['Santa Ana Centro', 'Santa Ana Este', 'Santa Ana Norte', 'Santa Ana Oeste'],
    'sonsonate': ['Sonsonate Centro', 'Sonsonate Este', 'Sonsonate Norte', 'Sonsonate Oeste'],
    'chalatenango': ['Chalatenango Centro', 'Chalatenango Norte', 'Chalatenango Sur'],
    'la_libertad': ['La Libertad Centro', 'La Libertad Costa', 'La Libertad Este', 'La Libertad Norte', 'La Libertad Oeste', 'La Libertad Sur'],
    'san_salvador': ['San Salvador Centro', 'San Salvador Este', 'San Salvador Norte', 'San Salvador Oeste', 'San Salvador Sur'],
    'cuscatlan': ['Cuscatlán Norte', 'Cuscatlán Sur'],
    'la_paz': ['La Paz Centro', 'La Paz Este', 'La Paz Oeste'],
    'cabanas': ['Cabañas Este', 'Cabañas Oeste'],
    'san_vicente': ['San Vicente Norte', 'San Vicente Sur'],
    'usulutan': ['Usulután Este', 'Usulután Norte', 'Usulután Oeste'],
    'san_miguel': ['San Miguel Centro', 'San Miguel Norte', 'San Miguel Oeste'],
    'morazan': ['Morazán Norte', 'Morazán Sur'],
    'la_union': ['La Unión Norte', 'La Unión Sur']
};

// Datos oficiales de El Salvador - Distritos (Ciudades/Pueblos) por Municipio
const distritosPorMunicipio = {
    // AHUACHAPÁN
    'ahuachapan_centro': ['Ahuachapán', 'Apaneca', 'Concepción de Ataco', 'Tacuba'],
    'ahuachapan_norte': ['Atiquizaya', 'El Refugio', 'San Lorenzo', 'Turín'],
    'ahuachapan_sur': ['Guaymango', 'Jujutla', 'San Francisco Menéndez', 'San Pedro Puxtla'],
    
    // SANTA ANA
    'santa_ana_centro': ['Santa Ana'],
    'santa_ana_este': ['Coatepeque', 'El Congo'],
    'santa_ana_norte': ['Masahuat', 'Metapán', 'Santa Rosa Guachipilín', 'Texistepeque'],
    'santa_ana_oeste': ['Candelaria de la Frontera', 'Chalchuapa', 'El Porvenir', 'San Antonio Pajonal', 'San Sebastián Salitrillo', 'Santiago de la Frontera'],
    
    // SONSONATE
    'sonsonate_centro': ['Nahulingo', 'San Antonio del Monte', 'Santo Domingo de Guzmán', 'Sonsonate', 'Sonzacate'],
    'sonsonate_este': ['Armenia', 'Caluco', 'Cuisnahuat', 'Santa Isabel Ishuatán', 'Izalco', 'San Julián'],
    'sonsonate_norte': ['Juayúa', 'Nahuizalco', 'Salcoatitán', 'Santa Catarina Masahuat'],
    'sonsonate_oeste': ['Acajutla'],
    
    // CHALATENANGO
    'chalatenango_centro': ['Agua Caliente', 'Dulce Nombre de María', 'El Paraíso', 'La Reina', 'Nueva Concepción', 'San Fernando', 'San Francisco Morazán', 'San Rafael', 'Santa Rita', 'Tejutla'],
    'chalatenango_norte': ['Citalá', 'San Ignacio', 'La Palma'],
    'chalatenango_sur': ['Arcatao', 'Azacualpa', 'Comalapa', 'Concepción Quezaltepeque', 'Chalatenango', 'El Carrizal', 'La Laguna', 'Las Vueltas', 'Nombre de Jesús', 'Nueva Trinidad', 'Ojos de Agua', 'Potonico', 'San Antonio de la Cruz', 'San Antonio Los Ranchos', 'San Isidro Labrador', 'San Francisco Lempa', 'San José Cancasque', 'San José Las Flores', 'San Luis del Carmen', 'San Miguel de Mercedes'],
    
    // LA LIBERTAD
    'la_libertad_centro': ['Ciudad Arce', 'San Juan Opico'],
    'la_libertad_costa': ['Chiltiupán', 'Jicalapa', 'La Libertad', 'Tamanique', 'Teotepeque'],
    'la_libertad_este': ['Antiguo Cuscatlán', 'Huizúcar', 'Nuevo Cuscatlán', 'San José Villanueva', 'Zaragoza'],
    'la_libertad_norte': ['Quezaltepeque', 'San Matías', 'San Pablo Tacachico'],
    'la_libertad_oeste': ['Colón', 'Jayaque', 'Sacacoyo', 'Talnique', 'Tepecoyo'],
    'la_libertad_sur': ['Comasagua', 'Santa Tecla'],
    
    // SAN SALVADOR
    'san_salvador_centro': ['Ayutuxtepeque', 'Cuscatancingo', 'Mejicanos', 'San Salvador', 'Delgado'],
    'san_salvador_este': ['Ilopango', 'San Martín', 'Soyapango', 'Tonacatepeque'],
    'san_salvador_norte': ['Aguilares', 'El Paisnal', 'Guazapa'],
    'san_salvador_oeste': ['Apopa', 'Nejapa'],
    'san_salvador_sur': ['Panchimalco', 'Rosario de Mora', 'San Marcos', 'Santiago Texacuangos', 'Santo Tomás'],
    
    // CUSCATLÁN
    'cuscatlan_norte': ['Oratorio de Concepción', 'San Bartolomé Perulapía', 'San José Guayabal', 'San Pedro Perulapán', 'Suchitoto'],
    'cuscatlan_sur': ['Candelaria', 'Cojutepeque', 'El Carmen', 'El Rosario', 'Monte San Juan', 'San Cristóbal', 'San Rafael Cedros', 'San Ramón', 'Santa Cruz Analquito', 'Santa Cruz Michapa', 'Tenancingo'],
    
    // LA PAZ
    'la_paz_centro': ['El Rosario', 'Jerusalén', 'Mercedes La Ceiba', 'Paraíso de Osorio', 'San Antonio Masahuat', 'San Emigdio', 'San Juan Tepezontes', 'San Miguel Tepezontes', 'San Pedro Nonualco', 'Santa María Ostuma', 'Santiago Nonualco', 'San Luis La Herradura'],
    'la_paz_este': ['San Juan Nonualco', 'San Rafael Obrajuelo', 'Zacatecoluca'],
    'la_paz_oeste': ['Cuyultitán', 'Olocuilta', 'San Francisco Chinameca', 'San Juan Talpa', 'San Luis Talpa', 'San Pedro Masahuat', 'Tapalhuaca'],
    
    // CABAÑAS
    'cabanas_este': ['Dolores', 'Guacotecti', 'San Isidro', 'Sensuntepeque', 'Victoria'],
    'cabanas_oeste': ['Cinquera', 'Ilobasco', 'Jutiapa', 'Tejutepeque'],
    
    // SAN VICENTE
    'san_vicente_norte': ['Apastepeque', 'San Esteban Catarina', 'San Ildefonso', 'San Lorenzo', 'San Sebastián', 'Santa Clara', 'Santo Domingo'],
    'san_vicente_sur': ['Guadalupe', 'San Cayetano Istepeque', 'San Vicente', 'Tecoluca', 'Tepetitán', 'Verapaz'],
    
    // USULUTÁN
    'usulutan_este': ['California', 'Concepción Batres', 'Ereguayquín', 'Jucuarán', 'Ozatlán', 'Usulután', 'San Dionisio', 'Santa Elena', 'Santa María', 'Tecapán'],
    'usulutan_norte': ['Alegría', 'Berlín', 'El Triunfo', 'Estanzuelas', 'Jucuapa', 'Mercedes Umaña', 'Nueva Granada', 'San Buenaventura', 'Santiago de María'],
    'usulutan_oeste': ['Jiquilisco', 'Puerto El Triunfo', 'San Agustín', 'San Francisco Javier'],
    
    // SAN MIGUEL
    'san_miguel_centro': ['Comacarán', 'Moncagua', 'Chirilagua', 'Quelepa', 'San Miguel', 'Uluazapa'],
    'san_miguel_norte': ['Carolina', 'Ciudad Barrios', 'Chapeltique', 'Nuevo Edén de San Juan', 'San Antonio del Mosco', 'San Gerardo', 'San Luis de La Reina', 'Sesori'],
    'san_miguel_oeste': ['Chinameca', 'El Tránsito', 'Lolotique', 'Nueva Guadalupe', 'San Jorge', 'San Rafael Oriente'],
    
    // MORAZÁN
    'morazan_norte': ['Arambala', 'Cacaopera', 'Corinto', 'El Rosario', 'Joateca', 'Jocoaitique', 'Meanguera', 'Perquín', 'San Fernando', 'San Isidro', 'Torola'],
    'morazan_sur': ['Chilanga', 'Delicias de Concepción', 'El Divisadero', 'Gualococti', 'Guatajiagua', 'Jocoro', 'Lolotiquillo', 'Osicala', 'San Francisco Gotera', 'San Simón', 'Sensembra', 'Sociedad', 'Yamabal', 'Yoloaiquín'],
    
    // LA UNIÓN
    'la_union_norte': ['Anamorós', 'Bolívar', 'Concepción de Oriente', 'El Sauce', 'Lislique', 'Nueva Esparta', 'Pasaquina', 'Polorós', 'San José La Fuente', 'Santa Rosa de Lima'],
    'la_union_sur': ['Conchagua', 'El Carmen', 'Intipucá', 'La Unión', 'Meanguera del Golfo', 'San Alejo', 'Yayantique', 'Yucuaiquín']
};

function cargarMunicipiosDocumento() {
    const departamento = document.querySelector('#modalCrearClienteDocumento select[name="departamento"]').value;
    const municipioSelect = document.querySelector('#modalCrearClienteDocumento select[name="municipio"]');
    const distritoSelect = document.querySelector('#modalCrearClienteDocumento select[name="distrito"]');
    
    // Limpiar municipios y distritos
    municipioSelect.innerHTML = '<option value="">Seleccionar municipio...</option>';
    distritoSelect.innerHTML = '<option value="">Seleccionar distrito...</option>';
    
    if (departamento && municipiosPorDepartamento[departamento]) {
        municipiosPorDepartamento[departamento].forEach(municipio => {
            const option = document.createElement('option');
            // Convertir nombre a valor válido para crear la clave correcta
            option.value = municipio.toLowerCase()
                .replace(/\s+/g, '_')
                .replace(/ñ/g, 'n')
                .replace(/á/g, 'a')
                .replace(/é/g, 'e')
                .replace(/í/g, 'i')
                .replace(/ó/g, 'o')
                .replace(/ú/g, 'u');
            option.textContent = municipio;
            municipioSelect.appendChild(option);
        });
    }
}

function cargarDistritosDocumento() {
    const municipio = document.querySelector('#modalCrearClienteDocumento select[name="municipio"]').value;
    const distritoSelect = document.querySelector('#modalCrearClienteDocumento select[name="distrito"]');
    
    // Limpiar distritos
    distritoSelect.innerHTML = '<option value="">Seleccionar distrito...</option>';
    
    if (municipio) {
        // Usar directamente el valor del municipio como clave
        const municipioClave = municipio;
        
        console.log('Buscando distritos para clave:', municipioClave);
        
        // Buscar distritos específicos para el municipio
        if (distritosPorMunicipio[municipioClave]) {
            const distritos = distritosPorMunicipio[municipioClave];
            console.log('Distritos encontrados:', distritos);
            
            distritos.forEach(distrito => {
                const option = document.createElement('option');
                option.value = distrito.toLowerCase()
                    .replace(/\s+/g, '_')
                    .replace(/[\/]/g, '_')
                    .replace(/:/g, '')
                    .replace(/ñ/g, 'n')
                    .replace(/á/g, 'a')
                    .replace(/é/g, 'e')
                    .replace(/í/g, 'i')
                    .replace(/ó/g, 'o')
                    .replace(/ú/g, 'u');
                option.textContent = distrito;
                distritoSelect.appendChild(option);
            });
        } else {
            console.log('No se encontraron distritos para:', municipioClave);
        }
    }
}

// Inicializar
document.addEventListener('DOMContentLoaded', function() {
    calcularTotales();
});
</script>

<style>
#listaClientes {
    position: absolute;
    z-index: 1050;
    border: 1px solid #dee2e6;
    border-radius: 0.375rem;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    background-color: #fff;
    top: 100%;
    left: 0;
    right: 0;
}

#listaClientes .dropdown-item {
    border: none;
    padding: 0.75rem 1rem;
    border-bottom: 1px solid #f8f9fa;
    cursor: pointer;
}

#listaClientes .dropdown-item:hover {
    background-color: #f8f9fa;
}

#listaClientes .dropdown-item:last-child {
    border-bottom: none;
}

.position-relative {
    position: relative !important;
}

#clienteBuscador {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}

/* Animación suave para el dropdown */
#listaClientes {
    opacity: 0;
    transform: translateY(-10px);
    transition: all 0.2s ease;
}

#listaClientes[style*="block"] {
    opacity: 1;
    transform: translateY(0);
}

/* Estilos para el input group */
.input-group .position-relative {
    flex: 1 1 auto;
}

/* Asegurar que el dropdown esté bien posicionado */
.flex-grow-1 {
    flex-grow: 1 !important;
}
</style>
@endsection