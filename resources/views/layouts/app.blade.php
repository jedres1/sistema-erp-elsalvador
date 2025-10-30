<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sistema Contable')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome para iconos -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- CSS personalizado -->
    <link href="{{ asset('css/accounts.css') }}" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #2c3e50 0%, #34495e 100%);
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }
        
        .nav-link {
            color: #ecf0f1 !important;
            padding: 12px 20px;
            margin: 5px 10px;
            border-radius: 8px;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }
        
        .nav-link:hover {
            background: rgba(52, 152, 219, 0.2);
            color: #3498db !important;
            border-left-color: #3498db;
            transform: translateX(5px);
        }
        
        .nav-link.active {
            background: rgba(52, 152, 219, 0.3);
            color: #3498db !important;
            border-left-color: #3498db;
            font-weight: 600;
        }
        
        .nav-link i {
            width: 20px;
            margin-right: 10px;
        }
        
        .main-content {
            background-color: #f8f9fa;
            min-height: 100vh;
            padding: 20px;
        }
        
        .logo-section {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 20px;
        }
        
        .logo-section h4 {
            color: #ecf0f1;
            margin: 0;
            font-weight: 300;
        }
        
        .logo-section .text-muted {
            color: #bdc3c7 !important;
            font-size: 0.9rem;
        }
        
        .nav-section-header h6 {
            color: #bdc3c7;
            font-size: 0.8rem;
            letter-spacing: 1px;
            padding-left: 20px;
            margin-bottom: 10px;
        }
        
        .nav-divider {
            border-color: rgba(255,255,255,0.1);
            margin: 20px 15px;
        }
        
        .nav-link {
            padding-left: 30px;
        }
        
        .nav-section-toggle {
            cursor: pointer;
            user-select: none;
            transition: all 0.3s ease;
        }
        
        .nav-section-toggle:hover {
            background-color: rgba(255,255,255,0.1);
            border-radius: 5px;
        }
        
        .nav-section-items {
            transition: all 0.3s ease;
            overflow: hidden;
        }
        
        .nav-section-items.collapsed {
            height: 0 !important;
            opacity: 0;
        }
        
        .toggle-icon {
            transition: transform 0.3s ease;
            float: right;
            margin-top: 2px;
        }
        
        .toggle-icon.rotated {
            transform: rotate(-90deg);
        }
    </style>
</head>
<body>
    <div class="container-fluid p-0">
        <div class="row g-0">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar">
                <div class="logo-section">
                    <h4><i class="fas fa-calculator"></i> Sistema</h4>
                    <small class="text-muted">Contable</small>
                </div>
                
                <nav class="nav flex-column">
                    <!-- Título Principal de Contabilidad con Toggle -->
                    <div class="nav-section-header">
                        <h6 class="text-light text-uppercase fw-bold mb-3 mt-2 nav-section-toggle" onclick="toggleSection('contabilidad')">
                            <i class="fas fa-calculator"></i> Contabilidad
                            <i class="fas fa-chevron-down toggle-icon" id="contabilidad-icon"></i>
                        </h6>
                    </div>
                    
                    <div id="contabilidad-items" class="nav-section-items">
                        <a class="nav-link {{ request()->routeIs('accounts.*') ? 'active' : '' }}" href="{{ route('accounts.index') }}">
                            <i class="fas fa-list-alt"></i>
                            Catálogo de Cuentas
                        </a>
                        
                        <a class="nav-link {{ request()->routeIs('journal.*') ? 'active' : '' }}" href="{{ route('journal.index') }}">
                            <i class="fas fa-book"></i>
                            Libro Diario
                        </a>
                        
                        <a class="nav-link {{ request()->routeIs('ledger.*') ? 'active' : '' }}" href="{{ route('ledger.index') }}">
                            <i class="fas fa-book-open"></i>
                            Libro Mayor
                        </a>
                        
                        <a class="nav-link {{ request()->routeIs('balance.*') ? 'active' : '' }}" href="{{ route('balance.index') }}">
                            <i class="fas fa-balance-scale"></i>
                            Balance General
                        </a>
                        
                        <a class="nav-link {{ request()->routeIs('estado-resultados.*') ? 'active' : '' }}" href="{{ route('estado-resultados.index') }}">
                            <i class="fas fa-chart-line"></i>
                            Estado de Resultados
                        </a>
                        
                        <a class="nav-link {{ request()->routeIs('parametros.*') ? 'active' : '' }}" href="{{ route('parametros.index') }}">
                            <i class="fas fa-sliders-h"></i>
                            Parámetros Contables
                        </a>
                    </div>
                    
                    <!-- Separador -->
                    <hr class="nav-divider">
                    
                    <!-- Sección Documentos Electrónicos -->
                    <div class="nav-section-header">
                        <h6 class="text-light text-uppercase fw-bold mb-3 nav-section-toggle" onclick="toggleSection('documentos')">
                            <i class="fas fa-file-digital"></i> Documentos Electrónicos
                            <i class="fas fa-chevron-down toggle-icon" id="documentos-icon"></i>
                        </h6>
                    </div>
                    
                    <div id="documentos-items" class="nav-section-items">
                        <a class="nav-link {{ request()->routeIs('documentos-electronicos.index') ? 'active' : '' }}" href="{{ route('documentos-electronicos.index') }}">
                            <i class="fas fa-file-digital"></i>
                            Documentos Electrónicos
                        </a>
                        
                        <a class="nav-link {{ request()->routeIs('clientes.*') ? 'active' : '' }}" href="{{ route('clientes.index') }}">
                            <i class="fas fa-users"></i>
                            Clientes
                        </a>
                        
                        <a class="nav-link {{ request()->routeIs('cuentas-por-cobrar.*') ? 'active' : '' }}" href="{{ route('cuentas-por-cobrar.index') }}">
                            <i class="fas fa-hand-holding-usd"></i>
                            Cuentas por Cobrar
                        </a>
                    </div>
                    
                    <!-- Separador -->
                    <hr class="nav-divider">
                    
                    <!-- Sección Operaciones -->
                    <div class="nav-section-header">
                        <h6 class="text-light text-uppercase fw-bold mb-3 nav-section-toggle" onclick="toggleSection('operaciones')">
                            <i class="fas fa-cogs"></i> Operaciones
                            <i class="fas fa-chevron-down toggle-icon" id="operaciones-icon"></i>
                        </h6>
                    </div>
                    
                    <div id="operaciones-items" class="nav-section-items">
                        <a class="nav-link {{ request()->routeIs('inventario.*') ? 'active' : '' }}" href="{{ route('inventario.index') }}">
                            <i class="fas fa-boxes"></i>
                            Inventario
                        </a>
                        
                        <a class="nav-link {{ request()->routeIs('compras.*') ? 'active' : '' }}" href="{{ route('compras.index') }}">
                            <i class="fas fa-shopping-cart"></i>
                            Compras
                        </a>
                        
                        <a class="nav-link" href="#" onclick="abrirModalProveedor()" data-bs-toggle="tooltip" title="Crear nuevo proveedor">
                            <i class="fas fa-truck"></i>
                            Proveedores
                        </a>
                        
                        <a class="nav-link {{ request()->routeIs('cuentas-por-pagar.*') ? 'active' : '' }}" href="{{ route('cuentas-por-pagar.index') }}">
                            <i class="fas fa-credit-card"></i>
                            Cuentas por Pagar
                        </a>
                        
                        <a class="nav-link {{ request()->routeIs('bancos.*') ? 'active' : '' }}" href="{{ route('bancos.index') }}">
                            <i class="fas fa-university"></i>
                            Control Bancario
                        </a>
                    </div>
                </nav>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 main-content">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function toggleSection(sectionId) {
            const items = document.getElementById(sectionId + '-items');
            const icon = document.getElementById(sectionId + '-icon');
            
            if (items.classList.contains('collapsed')) {
                items.classList.remove('collapsed');
                icon.classList.remove('rotated');
                // Guardar estado en localStorage
                localStorage.setItem('nav_' + sectionId + '_collapsed', 'false');
            } else {
                items.classList.add('collapsed');
                icon.classList.add('rotated');
                // Guardar estado en localStorage
                localStorage.setItem('nav_' + sectionId + '_collapsed', 'true');
            }
        }
        
        // Restaurar estado desde localStorage al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            const sections = ['contabilidad', 'operaciones'];
            
            sections.forEach(function(sectionId) {
                const isCollapsed = localStorage.getItem('nav_' + sectionId + '_collapsed') === 'true';
                
                if (isCollapsed) {
                    const items = document.getElementById(sectionId + '-items');
                    const icon = document.getElementById(sectionId + '-icon');
                    
                    if (items && icon) {
                        items.classList.add('collapsed');
                        icon.classList.add('rotated');
                    }
                }
            });
        });
        
        // Función para abrir modal de proveedor
        function abrirModalProveedor() {
            $('#modalProveedor').modal('show');
        }
        
        // Datos geográficos de El Salvador para el modal
        const geografiaElSalvador = {
            'San Salvador': {
                'Zona Metropolitana de San Salvador': ['San Salvador', 'Mejicanos', 'Soyapango', 'Delgado', 'Ilopango', 'San Marcos', 'Tonacatepeque', 'Ayutuxtepeque', 'Apopa', 'Nejapa', 'Cuscatancingo', 'San Martín'],
                'Zona Norte de San Salvador': ['Aguilares', 'El Paisnal', 'Guazapa'],
                'Zona Sur de San Salvador': ['Panchimalco', 'Rosario de Mora', 'San Antonio Abad', 'Candelaria', 'San Marcos', 'Escalón', 'Flor Blanca']
            },
            'La Libertad': {
                'Zona Costera': ['La Libertad', 'Puerto de La Libertad', 'Tamanique', 'Teotepeque', 'Tepecoyo', 'Talnique'],
                'Zona Central': ['Santa Tecla', 'Antiguo Cuscatlán', 'Huizúcar', 'Nuevo Cuscatlán'],
                'Zona Norte': ['Quezaltepeque', 'San Pablo Tacachico', 'Jayaque', 'Sacacoyo', 'San José Villanueva']
            },
            'Santa Ana': {
                'Zona Central de Santa Ana': ['Santa Ana', 'Coatepeque', 'El Congo'],
                'Zona Norte': ['Chalchuapa', 'El Porvenir', 'Masahuat', 'Metapán', 'San Antonio Pajonal', 'San Sebastián Salitrillo', 'Santiago de la Frontera', 'Texistepeque'],
                'Zona Sur': ['Candelaria de la Frontera', 'Santa Rosa Guachipilín', 'Casitas']
            }
        };
        
        // Inicializar eventos del modal
        $(document).ready(function() {
            // Cascada geográfica en el modal
            $('#modal_departamento').on('change', function() {
                const departamento = $(this).val();
                const municipioSelect = $('#modal_municipio');
                const distritoSelect = $('#modal_distrito');
                
                municipioSelect.html('<option value="">Seleccione...</option>');
                distritoSelect.html('<option value="">Seleccione zona...</option>');
                
                if (departamento && geografiaElSalvador[departamento]) {
                    Object.keys(geografiaElSalvador[departamento]).forEach(zona => {
                        municipioSelect.append(`<option value="${zona}">${zona}</option>`);
                    });
                }
            });
            
            $('#modal_municipio').on('change', function() {
                const departamento = $('#modal_departamento').val();
                const zona = $(this).val();
                const distritoSelect = $('#modal_distrito');
                
                distritoSelect.html('<option value="">Seleccione...</option>');
                
                if (departamento && zona && geografiaElSalvador[departamento][zona]) {
                    geografiaElSalvador[departamento][zona].forEach(distrito => {
                        distritoSelect.append(`<option value="${distrito}">${distrito}</option>`);
                    });
                }
            });
            
            // Formato de documento en el modal
            $('#modal_tipo_documento').on('change', function() {
                const tipo = $(this).val();
                const input = $('#modal_numero_documento');
                
                switch(tipo) {
                    case 'NIT':
                        input.attr('placeholder', 'Ej: 0614-150393-001-2');
                        break;
                    case 'DUI':
                        input.attr('placeholder', 'Ej: 03458721-3');
                        break;
                    case 'Pasaporte':
                        input.attr('placeholder', 'Ej: A1234567');
                        break;
                    case 'Carnet de Residente':
                        input.attr('placeholder', 'Ej: 123456789');
                        break;
                    default:
                        input.attr('placeholder', '');
                }
            });
        });
        
        // Función para manejar el formulario del modal
        function guardarProveedorModal() {
            const formData = new FormData(document.getElementById('formProveedorModal'));
            
            fetch('{{ route("cuentas-por-cobrar.proveedores.store.ajax") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    $('#modalProveedor').modal('hide');
                    Swal.fire({
                        title: '¡Éxito!',
                        text: 'Proveedor creado exitosamente',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    document.getElementById('formProveedorModal').reset();
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: data.message || 'Error al crear el proveedor',
                        icon: 'error'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Error',
                    text: 'Error de conexión',
                    icon: 'error'
                });
            });
        }
    </script>
    
    @yield('scripts')
    
    <!-- Modal para crear proveedor -->
    <div class="modal fade" id="modalProveedor" tabindex="-1" aria-labelledby="modalProveedorLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalProveedorLabel">
                        <i class="fas fa-truck me-2"></i>
                        Crear Nuevo Proveedor
                    </h5>
                    <div class="d-flex gap-2">
                        <a href="{{ route('cuentas-por-cobrar.proveedores.index') }}" class="btn btn-outline-light btn-sm" title="Ver lista completa">
                            <i class="fas fa-list"></i>
                        </a>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>
                <div class="modal-body">
                    <form id="formProveedorModal">
                        @csrf
                        
                        <!-- Información básica -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="modal_tipo_documento" class="form-label">Tipo de Documento *</label>
                                <select class="form-select" id="modal_tipo_documento" name="tipo_documento" required>
                                    <option value="">Seleccione...</option>
                                    <option value="NIT">NIT</option>
                                    <option value="DUI">DUI</option>
                                    <option value="Pasaporte">Pasaporte</option>
                                    <option value="Carnet de Residente">Carnet de Residente</option>
                                </select>
                            </div>
                            <div class="col-md-8">
                                <label for="modal_numero_documento" class="form-label">Número de Documento *</label>
                                <input type="text" class="form-control" id="modal_numero_documento" name="numero_documento" 
                                       placeholder="Ej: 0614-150393-001-2" required>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="modal_razon_social" class="form-label">Razón Social *</label>
                                <input type="text" class="form-control" id="modal_razon_social" name="razon_social" 
                                       placeholder="Nombre completo o razón social" required>
                            </div>
                            <div class="col-md-6">
                                <label for="modal_nombre_comercial" class="form-label">Nombre Comercial</label>
                                <input type="text" class="form-control" id="modal_nombre_comercial" name="nombre_comercial" 
                                       placeholder="Nombre comercial o marca">
                            </div>
                        </div>
                        
                        <!-- Información de contacto -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="modal_telefono" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="modal_telefono" name="telefono" 
                                       placeholder="Ej: 2298-5500">
                            </div>
                            <div class="col-md-6">
                                <label for="modal_email" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" id="modal_email" name="email" 
                                       placeholder="proveedor@empresa.com">
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <label for="modal_direccion" class="form-label">Dirección</label>
                                <input type="text" class="form-control" id="modal_direccion" name="direccion" 
                                       placeholder="Dirección completa">
                            </div>
                            <div class="col-md-4">
                                <label for="modal_limite_credito" class="form-label">Límite de Crédito</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" step="0.01" min="0" class="form-control" 
                                           id="modal_limite_credito" name="limite_credito" value="0.00">
                                </div>
                            </div>
                        </div>
                        
                        <!-- Ubicación geográfica -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="modal_departamento" class="form-label">Departamento</label>
                                <select class="form-select" id="modal_departamento" name="departamento">
                                    <option value="">Seleccione...</option>
                                    <option value="San Salvador">San Salvador</option>
                                    <option value="La Libertad">La Libertad</option>
                                    <option value="Santa Ana">Santa Ana</option>
                                    <option value="San Miguel">San Miguel</option>
                                    <option value="Usulután">Usulután</option>
                                    <option value="Sonsonate">Sonsonate</option>
                                    <option value="La Paz">La Paz</option>
                                    <option value="Chalatenango">Chalatenango</option>
                                    <option value="Ahuachapán">Ahuachapán</option>
                                    <option value="Cuscatlán">Cuscatlán</option>
                                    <option value="La Unión">La Unión</option>
                                    <option value="Morazán">Morazán</option>
                                    <option value="San Vicente">San Vicente</option>
                                    <option value="Cabañas">Cabañas</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="modal_municipio" class="form-label">Zona/Municipio</label>
                                <select class="form-select" id="modal_municipio" name="municipio">
                                    <option value="">Seleccione departamento...</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="modal_distrito" class="form-label">Distrito/Ciudad</label>
                                <select class="form-select" id="modal_distrito" name="distrito">
                                    <option value="">Seleccione zona...</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>
                        Cancelar
                    </button>
                    <button type="button" class="btn btn-primary" onclick="guardarProveedorModal()">
                        <i class="fas fa-save me-1"></i>
                        Guardar Proveedor
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>