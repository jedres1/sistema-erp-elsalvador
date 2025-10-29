@extends('layouts.app')

@section('title', 'Nueva Factura - Facturación')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('facturacion.index') }}">Facturación</a></li>
                    <li class="breadcrumb-item active">Nueva Factura</li>
                </ol>
            </nav>
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h3 mb-0">
                    <i class="fas fa-plus text-primary"></i>
                    Nueva Factura
                </h2>
                <a href="{{ route('facturacion.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i>
                    Volver
                </a>
            </div>
        </div>
    </div>

    <form action="{{ route('facturacion.store') }}" method="POST" id="facturaForm">
        @csrf
        <div class="row">
            <!-- Información de la Factura -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-file-invoice"></i>
                            Información de la Factura
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Cliente *</label>
                                    <div class="input-group">
                                        <div class="position-relative flex-grow-1">
                                            <input type="text" class="form-control @error('cliente_id') is-invalid @enderror" 
                                                   id="clienteBuscador" placeholder="Buscar cliente por nombre o RFC..." 
                                                   autocomplete="off" onkeyup="buscarClientes()" 
                                                   onfocus="mostrarListaClientes()">
                                            <input type="hidden" name="cliente_id" id="clienteIdHidden" required>
                                            
                                            <!-- Lista desplegable de resultados -->
                                            <div id="listaClientes" class="dropdown-menu w-100" style="max-height: 200px; overflow-y: auto; display: none;">
                                                <!-- Los resultados se cargarán aquí dinámicamente -->
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalCrearClienteFactura">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    @error('cliente_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Escriba para buscar un cliente o créelo si no existe</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Fecha *</label>
                                    <input type="date" class="form-control @error('fecha') is-invalid @enderror" 
                                           name="fecha" value="{{ old('fecha', date('Y-m-d')) }}" required>
                                    @error('fecha')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Número de Factura</label>
                                    <input type="text" class="form-control" name="numero_factura" 
                                           value="FAC-{{ str_pad(random_int(1, 9999), 4, '0', STR_PAD_LEFT) }}" readonly>
                                    <div class="form-text">Se generará automáticamente</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Forma de Pago</label>
                                    <select class="form-select" name="forma_pago">
                                        <option value="efectivo">Efectivo</option>
                                        <option value="transferencia">Transferencia</option>
                                        <option value="cheque">Cheque</option>
                                        <option value="tarjeta">Tarjeta</option>
                                        <option value="credito" selected>Crédito</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Observaciones</label>
                            <textarea class="form-control" name="observaciones" rows="3" 
                                      placeholder="Notas adicionales...">{{ old('observaciones') }}</textarea>
                        </div>
                    </div>
                </div>
                
                <!-- Items de la Factura -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-list"></i>
                            Productos/Servicios
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="itemsTable">
                                <thead class="table-light">
                                    <tr>
                                        <th width="35%">Producto/Servicio</th>
                                        <th width="15%">Cantidad</th>
                                        <th width="20%">Precio Unitario</th>
                                        <th width="20%">Subtotal</th>
                                        <th width="10%">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="itemsTableBody">
                                    <!-- Los items se agregan dinámicamente -->
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <button type="button" class="btn btn-outline-primary" onclick="agregarItem()">
                                <i class="fas fa-plus"></i>
                                Agregar Producto/Servicio
                            </button>
                            <div class="text-muted">
                                <small>* Agregue al menos un producto o servicio</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Resumen de la Factura -->
            <div class="col-lg-4">
                <div class="card position-sticky" style="top: 20px;">
                    <div class="card-header">
                        <h6 class="mb-0">
                            <i class="fas fa-calculator"></i>
                            Resumen de la Factura
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal:</span>
                            <span id="subtotalDisplay">$0.00</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>IVA (13%):</span>
                            <span id="ivaDisplay">$0.00</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <strong>Total:</strong>
                            <strong id="totalDisplay" class="text-primary">$0.00</strong>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Descuento (%)</label>
                            <input type="number" class="form-control" id="descuentoPorcentaje" 
                                   min="0" max="100" step="0.1" value="0" onchange="calcularTotales()">
                        </div>
                        
                        <div class="d-flex justify-content-between mb-2 text-warning" id="descuentoSection" style="display: none;">
                            <span>Descuento:</span>
                            <span id="descuentoDisplay">$0.00</span>
                        </div>
                        
                        <div class="d-flex justify-content-between mb-3" id="totalFinalSection">
                            <strong>Total Final:</strong>
                            <strong id="totalFinalDisplay" class="text-success">$0.00</strong>
                        </div>
                        
                        <hr>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary" id="guardarBtn" disabled>
                                <i class="fas fa-save"></i>
                                Crear Factura
                            </button>
                            <button type="button" class="btn btn-outline-info" onclick="previsualizarFactura()">
                                <i class="fas fa-eye"></i>
                                Previsualizar
                            </button>
                            <a href="{{ route('facturacion.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times"></i>
                                Cancelar
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Productos Disponibles -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h6 class="mb-0">
                            <i class="fas fa-box"></i>
                            Productos Disponibles
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            @foreach($productos as $producto)
                            <a href="#" class="list-group-item list-group-item-action" 
                               onclick="agregarProductoRapido({{ $producto['id'] }}, '{{ $producto['nombre'] }}', {{ $producto['precio'] }})">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">{{ $producto['nombre'] }}</h6>
                                    <small class="text-success">${{ number_format($producto['precio'], 2) }}</small>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Modal de Previsualización -->
<div class="modal fade" id="previsualizacionModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Previsualización de Factura</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="previsualizacionContent">
                <!-- Contenido de previsualización -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="$('#facturaForm').submit()">
                    Crear Factura
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
let itemCounter = 0;
let productos = @json($productos);
let clientes = @json($clientes);
let clienteSeleccionado = null;

// Funciones para el buscador de clientes
function buscarClientes() {
    const input = document.getElementById('clienteBuscador');
    const lista = document.getElementById('listaClientes');
    const termino = input.value.toLowerCase().trim();
    
    // Limpiar selección actual si se está escribiendo
    if (clienteSeleccionado) {
        const tipoDocumento = clienteSeleccionado.nacionalidad === 'nacional' 
            ? (clienteSeleccionado.tipo_persona === 'natural' ? 'DUI' : 'NIT')
            : 'ID';
        const valorEsperado = clienteSeleccionado.nombre + ' - ' + tipoDocumento + ': ' + clienteSeleccionado.numero_identificacion;
        
        if (input.value !== valorEsperado) {
            clienteSeleccionado = null;
            document.getElementById('clienteIdHidden').value = '';
            validarFormulario();
        }
    }
    
    if (termino.length < 2) {
        lista.style.display = 'none';
        return;
    }
    
    // Filtrar clientes
    const clientesFiltrados = clientes.filter(cliente => {
        const nombreCompleto = (cliente.nombre + ' ' + cliente.numero_identificacion + ' ' + (cliente.email || '')).toLowerCase();
        return nombreCompleto.includes(termino);
    });
    
    // Mostrar resultados
    mostrarResultadosClientes(clientesFiltrados);
}

function mostrarListaClientes() {
    const input = document.getElementById('clienteBuscador');
    const lista = document.getElementById('listaClientes');
    
    if (input.value.length === 0) {
        mostrarResultadosClientes(clientes.slice(0, 10)); // Mostrar primeros 10
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
            <div class="dropdown-divider"></div>
            <div class="dropdown-item" onclick="abrirModalCrearCliente()">
                <i class="fas fa-plus text-primary"></i>
                <strong class="text-primary">Crear nuevo cliente</strong>
            </div>
        `;
    } else {
        lista.innerHTML = clientesFiltrados.map(cliente => {
            const tipoDocumento = cliente.nacionalidad === 'nacional' 
                ? (cliente.tipo_persona === 'natural' ? 'DUI' : 'NIT')
                : 'ID';
            
            return `
                <div class="dropdown-item" onclick="seleccionarCliente(${cliente.id}, '${cliente.nombre}', '${cliente.numero_identificacion}')" 
                     style="cursor: pointer;">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="fw-bold">${cliente.nombre}</div>
                            <small class="text-muted">${tipoDocumento}: ${cliente.numero_identificacion}</small>
                            ${cliente.telefono ? `<br><small class="text-muted"><i class="fas fa-phone"></i> ${cliente.telefono}</small>` : ''}
                        </div>
                        <div class="text-end">
                            <small class="text-muted">${cliente.email || 'Sin email'}</small>
                            ${cliente.tipo_persona === 'natural' ? '<br><span class="badge bg-info">Natural</span>' : '<br><span class="badge bg-primary">Jurídica</span>'}
                        </div>
                    </div>
                </div>
            `;
        }).join('') + `
            <div class="dropdown-divider"></div>
            <div class="dropdown-item" onclick="abrirModalCrearCliente()">
                <i class="fas fa-plus text-primary"></i>
                <strong class="text-primary">Crear nuevo cliente</strong>
            </div>
        `;
    }
    
    lista.style.display = 'block';
}

function seleccionarCliente(id, nombre, numero_identificacion) {
    // Buscar el cliente completo en el array
    const cliente = clientes.find(c => c.id === id);
    clienteSeleccionado = cliente;
    
    const tipoDocumento = cliente.nacionalidad === 'nacional' 
        ? (cliente.tipo_persona === 'natural' ? 'DUI' : 'NIT')
        : 'ID';
    
    document.getElementById('clienteBuscador').value = nombre + ' - ' + tipoDocumento + ': ' + numero_identificacion;
    document.getElementById('clienteIdHidden').value = id;
    document.getElementById('listaClientes').style.display = 'none';
    
    validarFormulario();
}

        // Función para actualizar campos de identificación según tipo de persona y nacionalidad
        function actualizarCamposIdentificacion() {
            const tipoPersona = document.querySelector('select[name="tipo_persona"]').value;
            const nacionalidad = document.querySelector('select[name="nacionalidad"]').value;
            const labelIdentificacion = document.getElementById('labelIdentificacion');
            const inputIdentificacion = document.getElementById('numeroIdentificacion');
            const ayudaIdentificacion = document.getElementById('ayudaIdentificacion');
            const camposJuridicos = document.getElementById('camposJuridicos');
            
            // Mostrar/ocultar campos específicos para personas jurídicas
            if (tipoPersona === 'juridica') {
                camposJuridicos.style.display = 'block';
                document.querySelector('input[name="actividad_economica"]').required = true;
                document.querySelector('input[name="crn"]').required = true;
            } else {
                camposJuridicos.style.display = 'none';
                document.querySelector('input[name="actividad_economica"]').required = false;
                document.querySelector('input[name="crn"]').required = false;
            }
            
            // Limpiar campo actual
            inputIdentificacion.value = '';
            
            if (!tipoPersona || !nacionalidad) {
                labelIdentificacion.textContent = 'Número de Identificación *';
                inputIdentificacion.placeholder = 'Ingrese número de identificación';
                ayudaIdentificacion.textContent = 'Seleccione tipo de persona y nacionalidad';
                return;
            }
            
            if (nacionalidad === 'nacional') {
                if (tipoPersona === 'natural') {
                    labelIdentificacion.textContent = 'DUI *';
                    inputIdentificacion.placeholder = 'Ej: 046463505';
                    ayudaIdentificacion.textContent = 'Formato: 9 dígitos (sin guiones)';
                    inputIdentificacion.maxLength = 9;
                    inputIdentificacion.pattern = '[0-9]{9}';
                    
                    // Aplicar máscara de DUI
                    inputIdentificacion.addEventListener('input', function(e) {
                        aplicarMascaraDUI(e.target);
                    });
                    
                } else if (tipoPersona === 'juridica') {
                    labelIdentificacion.textContent = 'NIT *';
                    inputIdentificacion.placeholder = 'Ej: 06071007921019';
                    ayudaIdentificacion.textContent = 'Formato: 14 dígitos (sin guiones)';
                    inputIdentificacion.maxLength = 14;
                    inputIdentificacion.pattern = '[0-9]{14}';
                    
                    // Aplicar máscara de NIT
                    inputIdentificacion.addEventListener('input', function(e) {
                        aplicarMascaraNIT(e.target);
                    });
                }
            } else if (nacionalidad === 'extranjero') {
                labelIdentificacion.textContent = 'Documento de Identificación *';
                inputIdentificacion.placeholder = 'Número de identificación extranjero';
                ayudaIdentificacion.textContent = 'Máximo 25 caracteres alfanuméricos';
                inputIdentificacion.maxLength = 25;
                inputIdentificacion.pattern = '[A-Za-z0-9]{1,25}';
                
                // Remover máscaras para extranjeros
                inputIdentificacion.removeEventListener('input', aplicarMascaraDUI);
                inputIdentificacion.removeEventListener('input', aplicarMascaraNIT);
            }
        }
        
        // Función para aplicar máscara de DUI (9 dígitos)
        function aplicarMascaraDUI(input) {
            let valor = input.value.replace(/\D/g, ''); // Solo números
            if (valor.length > 9) {
                valor = valor.substring(0, 9);
            }
            input.value = valor;
        }
        
        // Función para aplicar máscara de NIT (14 dígitos)
        function aplicarMascaraNIT(input) {
            let valor = input.value.replace(/\D/g, ''); // Solo números
            if (valor.length > 14) {
                valor = valor.substring(0, 14);
            }
            input.value = valor;
        }
        
        // Función para aplicar máscara de CRN (15 dígitos)
        function aplicarMascaraCRN(input) {
            let valor = input.value.replace(/\D/g, ''); // Solo números
            if (valor.length > 15) {
                valor = valor.substring(0, 15);
            }
            input.value = valor;
        }
        
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
            'chalatenango_sur': ['Arcatao', 'Azacualpa', 'Comalapa', 'Concepción Quezaltepeque', 'Chalatenango', 'El Carrizal', 'La Laguna', 'Las Vueltas', 'Nombre de Jesús', 'Nueva Trinidad', 'Ojos de Agua', 'Potonico', 'San Antonio de la Cruz', 'San Antonio Los Ranchos', 'San Isidro Labrador', 'San Francisco Lempa', 'San José Cancasque / Cancasque', 'San José Las Flores / Las Flores', 'San Luis del Carmen', 'San Miguel de Mercedes'],
            
            // LA LIBERTAD
            'la_libertad_centro': ['Ciudad Arce', 'San Juan Opico'],
            'la_libertad_costa': ['Chiltiupán', 'Jicalapa', 'La Libertad', 'Tamanique', 'Teotepeque'],
            'la_libertad_este': ['Antiguo Cuscatlán', 'Huizúcar', 'Nuevo Cuscatlán', 'San José Villanueva', 'Zaragoza'],
            'la_libertad_norte': ['Quezaltepeque', 'San Matías', 'San Pablo Tacachico'],
            'la_libertad_oeste': ['Colón', 'Jayaque', 'Sacacoyo', 'Talnique', 'Tepecoyo'],
            'la_libertad_sur': ['Comasagua', 'Santa Tecla antes: Nueva San Salvador'],
            
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
            'la_paz_centro': ['El Rosario / Rosario de La Paz', 'Jerusalén', 'Mercedes La Ceiba', 'Paraíso de Osorio', 'San Antonio Masahuat', 'San Emigdio', 'San Juan Tepezontes', 'San Miguel Tepezontes', 'San Pedro Nonualco', 'Santa María Ostuma', 'Santiago Nonualco', 'San Luis La Herradura'],
            'la_paz_este': ['San Juan Nonualco', 'San Rafael Obrajuelo', 'Zacatecoluca'],
            'la_paz_oeste': ['Cuyultitán', 'Olocuilta', 'San Francisco Chinameca', 'San Juan Talpa', 'San Luis Talpa', 'San Pedro Masahuat', 'Tapalhuaca'],
            
            // CABAÑAS
            'cabanas_este': ['Dolores / Villa Dolores', 'Guacotecti', 'San Isidro', 'Sensuntepeque', 'Victoria'],
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
            'morazan_sur': ['Chilanga', 'Delicias de Concepción', 'El Divisadero', 'Gualococti', 'Guatajiagua', 'Jocoro', 'Lolotiquillo', 'Osicala', 'San Carlos', 'San Francisco Gotera', 'San Simón', 'Sensembra', 'Sociedad', 'Yamabal', 'Yoloaiquín'],
            
            // LA UNIÓN
            'la_union_norte': ['Anamorós', 'Bolívar', 'Concepción de Oriente', 'El Sauce', 'Lislique', 'Nueva Esparta', 'Pasaquina', 'Polorós', 'San José La Fuente', 'Santa Rosa de Lima'],
            'la_union_sur': ['Conchagua', 'El Carmen', 'Intipucá', 'La Unión', 'Meanguera del Golfo', 'San Alejo', 'Yayantique', 'Yucuaiquín']
        };
        
        // Función para cargar municipios según el departamento seleccionado
        function cargarMunicipios() {
            const departamento = document.querySelector('select[name="departamento"]').value;
            const municipioSelect = document.querySelector('select[name="municipio"]');
            const distritoSelect = document.querySelector('select[name="distrito"]');
            
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
        
        // Función para cargar distritos según el municipio seleccionado
        function cargarDistritos() {
            const municipio = document.querySelector('select[name="municipio"]').value;
            const distritoSelect = document.querySelector('select[name="distrito"]');
            
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
        
        // Función para validar formulario de cliente
        function validarFormularioCliente() {
            const tipoPersona = document.querySelector('select[name="tipo_persona"]').value;
            const nacionalidad = document.querySelector('select[name="nacionalidad"]').value;
            const numeroId = document.getElementById('numeroIdentificacion').value;
            const departamento = document.querySelector('select[name="departamento"]').value;
            const municipio = document.querySelector('select[name="municipio"]').value;
            
            if (!tipoPersona || !nacionalidad) {
                mostrarToast('Error', 'Debe seleccionar tipo de persona y nacionalidad', 'error');
                return false;
            }
            
            if (!departamento || !municipio) {
                mostrarToast('Error', 'Debe seleccionar departamento y municipio', 'error');
                return false;
            }
            
            // Validar campos específicos de persona jurídica
            if (tipoPersona === 'juridica') {
                const actividadEconomica = document.querySelector('input[name="actividad_economica"]').value;
                const crn = document.querySelector('input[name="crn"]').value;
                
                if (!actividadEconomica.trim()) {
                    mostrarToast('Error', 'La actividad económica es requerida para personas jurídicas', 'error');
                    return false;
                }
                
                if (!crn.trim()) {
                    mostrarToast('Error', 'El número de registro (CRN) es requerido para personas jurídicas', 'error');
                    return false;
                }
                
                if (crn.length < 1 || crn.length > 15) {
                    mostrarToast('Error', 'El CRN debe tener entre 1 y 15 dígitos', 'error');
                    return false;
                }
            }
            
            if (nacionalidad === 'nacional') {
                if (tipoPersona === 'natural' && numeroId.length !== 9) {
                    mostrarToast('Error', 'El DUI debe tener exactamente 9 dígitos', 'error');
                    return false;
                }
                if (tipoPersona === 'juridica' && numeroId.length !== 14) {
                    mostrarToast('Error', 'El NIT debe tener exactamente 14 dígitos', 'error');
                    return false;
                }
            } else if (nacionalidad === 'extranjero') {
                if (numeroId.length < 1 || numeroId.length > 25) {
                    mostrarToast('Error', 'El documento de identificación debe tener entre 1 y 25 caracteres', 'error');
                    return false;
                }
            }
            
            return true;
        }

        function abrirModalCrearCliente() {
    document.getElementById('listaClientes').style.display = 'none';
    const modal = new bootstrap.Modal(document.getElementById('modalCrearClienteFactura'));
    modal.show();
}

// Ocultar lista al hacer clic fuera
document.addEventListener('click', function(event) {
    const buscador = document.getElementById('clienteBuscador');
    const lista = document.getElementById('listaClientes');
    
    if (!buscador.contains(event.target) && !lista.contains(event.target)) {
        lista.style.display = 'none';
    }
});

// Manejar teclas especiales en el buscador
document.getElementById('clienteBuscador').addEventListener('keydown', function(event) {
    const lista = document.getElementById('listaClientes');
    const items = lista.querySelectorAll('.dropdown-item:not(.text-muted)');
    
    if (event.key === 'ArrowDown') {
        event.preventDefault();
        // Lógica para navegar con flechas (opcional)
    } else if (event.key === 'Escape') {
        lista.style.display = 'none';
    } else if (event.key === 'Enter') {
        event.preventDefault();
        if (items.length > 0 && !clienteSeleccionado) {
            // Seleccionar el primer resultado si hay resultados
            const firstItem = items[0];
            if (firstItem.onclick) {
                firstItem.click();
            }
        }
    }
});

// Agregar el primer item al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    agregarItem();
    calcularTotales(); // Inicializar cálculos
});

function agregarItem() {
    itemCounter++;
    const tbody = document.getElementById('itemsTableBody');
    
    const row = document.createElement('tr');
    row.innerHTML = `
        <td>
            <select class="form-select" name="items[${itemCounter}][producto_id]" onchange="actualizarPrecio(this, ${itemCounter})" required>
                <option value="">Seleccionar...</option>
                ${productos.map(p => `<option value="${p.id}" data-precio="${p.precio}">${p.nombre}</option>`).join('')}
            </select>
        </td>
        <td>
            <input type="number" class="form-control" name="items[${itemCounter}][cantidad]" 
                   min="1" step="0.01" value="1" onchange="calcularSubtotal(${itemCounter})" required>
        </td>
        <td>
            <input type="number" class="form-control" name="items[${itemCounter}][precio]" 
                   step="0.01" min="0" onchange="calcularSubtotal(${itemCounter})" required>
        </td>
        <td>
            <input type="text" class="form-control" id="subtotal_${itemCounter}" readonly 
                   style="background-color: #f8f9fa;">
        </td>
        <td>
            <button type="button" class="btn btn-sm btn-outline-danger" onclick="eliminarItem(this)">
                <i class="fas fa-trash"></i>
            </button>
        </td>
    `;
    
    tbody.appendChild(row);
    validarFormulario();
}

function eliminarItem(button) {
    if (document.querySelectorAll('#itemsTableBody tr').length > 1) {
        button.closest('tr').remove();
        calcularTotales();
        validarFormulario();
    } else {
        alert('Debe mantener al menos un producto en la factura');
    }
}

function actualizarPrecio(select, itemId) {
    const option = select.selectedOptions[0];
    const precio = option.getAttribute('data-precio');
    const precioInput = select.closest('tr').querySelector(`input[name="items[${itemId}][precio]"]`);
    
    if (precio) {
        precioInput.value = precio;
        calcularSubtotal(itemId);
    }
}

function calcularSubtotal(itemId) {
    const row = document.querySelector(`input[name="items[${itemId}][cantidad]"]`).closest('tr');
    const cantidad = parseFloat(row.querySelector(`input[name="items[${itemId}][cantidad]"]`).value) || 0;
    const precio = parseFloat(row.querySelector(`input[name="items[${itemId}][precio]"]`).value) || 0;
    const subtotal = cantidad * precio;
    
    document.getElementById(`subtotal_${itemId}`).value = '$' + subtotal.toFixed(2);
    calcularTotales();
}

function calcularTotales() {
    let subtotal = 0;
    
    // Calcular subtotal de todos los items
    const items = document.querySelectorAll('#itemsTableBody tr');
    items.forEach(item => {
        const subtotalInput = item.querySelector('input[id^="subtotal_"]');
        if (subtotalInput && subtotalInput.value) {
            // Extraer el valor numérico quitando el símbolo $
            const valor = parseFloat(subtotalInput.value.replace('$', '')) || 0;
            subtotal += valor;
        }
    });
    
    // Obtener el descuento
    const descuentoPorcentaje = parseFloat(document.getElementById('descuentoPorcentaje').value) || 0;
    const descuentoMonto = subtotal * (descuentoPorcentaje / 100);
    const subtotalConDescuento = subtotal - descuentoMonto;
    
    // Calcular IVA (13%)
    const iva = subtotalConDescuento * 0.13;
    const totalFinal = subtotalConDescuento + iva;
    
    // Actualizar valores en el DOM con los IDs correctos
    document.getElementById('subtotalDisplay').textContent = '$' + subtotal.toFixed(2);
    document.getElementById('ivaDisplay').textContent = '$' + iva.toFixed(2);
    document.getElementById('totalDisplay').textContent = '$' + subtotalConDescuento.toFixed(2);
    
    // Mostrar/ocultar sección de descuento
    const descuentoSection = document.getElementById('descuentoSection');
    if (descuentoPorcentaje > 0) {
        descuentoSection.style.display = 'flex';
        document.getElementById('descuentoDisplay').textContent = '-$' + descuentoMonto.toFixed(2);
    } else {
        descuentoSection.style.display = 'none';
    }
    
    // Actualizar total final
    document.getElementById('totalFinalDisplay').textContent = '$' + totalFinal.toFixed(2);
    
    // Habilitar/deshabilitar botón de guardar
    const guardarBtn = document.getElementById('guardarBtn');
    if (subtotal > 0 && clienteSeleccionado) {
        guardarBtn.disabled = false;
    } else {
        guardarBtn.disabled = true;
    }
}

function agregarProductoRapido(id, nombre, precio) {
    // Buscar si ya existe el producto en la tabla
    const filas = document.querySelectorAll('#itemsTableBody tr');
    let encontrado = false;
    
    filas.forEach(fila => {
        const select = fila.querySelector('select');
        if (select.value == id) {
            // Incrementar cantidad
            const cantidadInput = fila.querySelector('input[name*="[cantidad]"]');
            cantidadInput.value = parseInt(cantidadInput.value) + 1;
            
            // Recalcular subtotal
            const itemId = cantidadInput.name.match(/\[(\d+)\]/)[1];
            calcularSubtotal(itemId);
            encontrado = true;
        }
    });
    
    if (!encontrado) {
        // Agregar nuevo item
        agregarItem();
        const ultimaFila = document.querySelector('#itemsTableBody tr:last-child');
        const select = ultimaFila.querySelector('select');
        const precioInput = ultimaFila.querySelector('input[name*="[precio]"]');
        
        select.value = id;
        precioInput.value = precio;
        
        const itemId = select.name.match(/\[(\d+)\]/)[1];
        calcularSubtotal(itemId);
    }
}

function validarFormulario() {
    calcularTotales(); // Esto ya maneja la habilitación del botón basado en cliente y subtotal
}

function previsualizarFactura() {
    // Implementar previsualización
    const modal = new bootstrap.Modal(document.getElementById('previsualizacionModal'));
    modal.show();
}

// Validar en tiempo real
document.addEventListener('change', validarFormulario);
document.addEventListener('input', validarFormulario);
</script>

<!-- Modal para Crear Cliente -->
<div class="modal fade" id="modalCrearClienteFactura" tabindex="-1" aria-labelledby="modalCrearClienteFacturaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCrearClienteFacturaLabel">
                    <i class="fas fa-user-plus"></i>
                    Crear Nuevo Cliente
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formCrearClienteFactura" onsubmit="guardarClienteFactura(event)">
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
                                <select class="form-select" name="departamento" onchange="cargarMunicipios()" required>
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
                                <select class="form-select" name="municipio" onchange="cargarDistritos()" required>
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
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        Crear y Seleccionar Cliente
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function guardarClienteFactura(event) {
    event.preventDefault();
    
    // Validar formulario antes de procesar
    if (!validarFormularioCliente()) {
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
    const modal = bootstrap.Modal.getInstance(document.getElementById('modalCrearClienteFactura'));
    modal.hide();
    event.target.reset();
    
    // Validar formulario después de seleccionar cliente
    validarFormulario();
    
    // Remover toast después de que se oculte
    toast.addEventListener('hidden.bs.toast', () => {
        toast.remove();
    });
}
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
</style>
@endsection