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
        /* Variables CSS para tema oscuro */
        :root {
            --primary-dark: #1a1625;
            --secondary-dark: #232136;
            --tertiary-dark: #2d2a45;
            --accent-purple: #7c3aed;
            --accent-blue: #06b6d4;
            --accent-pink: #ec4899;
            --text-primary: #f1f5f9;
            --text-secondary: #cbd5e1;
            --text-muted: #94a3b8;
            --border-dark: rgba(148, 163, 184, 0.1);
            --hover-overlay: rgba(124, 58, 237, 0.1);
            --active-overlay: rgba(124, 58, 237, 0.2);
            --shadow-dark: rgba(0, 0, 0, 0.3);
        }
        
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--secondary-dark) 50%, var(--tertiary-dark) 100%);
            box-shadow: 4px 0 20px var(--shadow-dark);
            position: relative;
        }
        
        .sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, 
                rgba(124, 58, 237, 0.03) 0%, 
                rgba(6, 182, 212, 0.03) 50%, 
                rgba(236, 72, 153, 0.03) 100%);
            pointer-events: none;
        }
        
        .nav-link {
            color: var(--text-primary) !important;
            padding: 14px 20px;
            margin: 4px 12px;
            border-radius: 12px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border-left: 3px solid transparent;
            position: relative;
            overflow: hidden;
        }
        
        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
            transition: left 0.5s;
        }
        
        .nav-link:hover {
            background: var(--hover-overlay);
            color: var(--accent-purple) !important;
            border-left-color: var(--accent-purple);
            transform: translateX(8px) scale(1.02);
            box-shadow: 0 4px 15px rgba(124, 58, 237, 0.2);
        }
        
        .nav-link:hover::before {
            left: 100%;
        }
        
        .nav-link.active {
            background: var(--active-overlay);
            color: var(--accent-blue) !important;
            border-left-color: var(--accent-blue);
            font-weight: 600;
            box-shadow: 0 4px 20px rgba(6, 182, 212, 0.3);
        }
        
        .nav-link i {
            width: 22px;
            margin-right: 12px;
            font-size: 1.1em;
        }
        
        .main-content {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            min-height: 100vh;
            padding: 25px;
            color: var(--text-primary);
        }
        
        .logo-section {
            text-align: center;
            padding: 25px 0;
            border-bottom: 2px solid var(--border-dark);
            margin-bottom: 25px;
            position: relative;
        }
        
        .logo-section::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 2px;
            background: linear-gradient(90deg, var(--accent-purple), var(--accent-blue), var(--accent-pink));
            border-radius: 2px;
        }
        
        .logo-section h4 {
            color: var(--text-primary);
            margin-bottom: 5px;
            font-weight: 800;
            font-size: 1.4rem;
            letter-spacing: 1px;
            background: linear-gradient(135deg, var(--accent-purple), var(--accent-blue));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .logo-section small {
            color: var(--text-muted) !important;
            font-weight: 500;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        
        .nav-divider {
            border-color: var(--border-dark);
            margin: 25px 15px;
        }
        
        .nav-link {
            padding-left: 35px;
        }
        
        .nav-section-toggle {
            cursor: pointer;
            user-select: none;
            transition: all 0.3s ease;
            padding: 12px 20px;
            margin: 4px 12px;
            border-radius: 10px;
            color: var(--text-secondary);
            font-weight: 600;
            position: relative;
        }
        
        .nav-section-toggle:hover {
            background: var(--hover-overlay);
            color: var(--accent-purple);
            transform: translateX(4px);
        }
        
        .nav-section-toggle i {
            margin-right: 10px;
            font-size: 1.1em;
        }
        
        .nav-section-items {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
        }
        
        .nav-section-items.collapsed {
            height: 0 !important;
            opacity: 0;
            transform: translateY(-10px);
        }
        
        .toggle-icon {
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            float: right;
            margin-top: 3px;
            color: var(--accent-purple);
        }
        
        .toggle-icon.rotated {
            transform: rotate(-90deg);
        }
        
        /* Scrollbar personalizado para tema oscuro */
        .sidebar::-webkit-scrollbar {
            width: 8px;
        }
        
        .sidebar::-webkit-scrollbar-track {
            background: var(--secondary-dark);
        }
        
        .sidebar::-webkit-scrollbar-thumb {
            background: var(--accent-purple);
            border-radius: 4px;
        }
        
        .sidebar::-webkit-scrollbar-thumb:hover {
            background: var(--accent-blue);
        }
        
        /* Estilos para modales y formularios con tema oscuro */
        .modal-content {
            background: var(--secondary-dark);
            border: 1px solid var(--border-dark);
            border-radius: 15px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
        }
        
        .modal-header {
            background: linear-gradient(135deg, var(--accent-purple), var(--accent-blue));
            color: var(--text-primary);
            border-bottom: 1px solid var(--border-dark);
            border-radius: 15px 15px 0 0;
        }
        
        .modal-body {
            background: var(--tertiary-dark);
            color: var(--text-primary);
        }
        
        .modal-footer {
            background: var(--secondary-dark);
            border-top: 1px solid var(--border-dark);
            border-radius: 0 0 15px 15px;
        }
        
        /* Formularios oscuros */
        .form-control, .form-select {
            background: var(--primary-dark);
            border: 1px solid var(--border-dark);
            color: var(--text-primary);
            border-radius: 8px;
        }
        
        .form-control:focus, .form-select:focus {
            background: var(--secondary-dark);
            border-color: var(--accent-purple);
            color: var(--text-primary);
            box-shadow: 0 0 0 0.2rem rgba(124, 58, 237, 0.25);
        }
        
        .form-label {
            color: var(--text-secondary);
            font-weight: 500;
        }
        
        /* Botones con tema oscuro */
        .btn-primary {
            background: linear-gradient(135deg, var(--accent-purple), var(--accent-blue));
            border: none;
            border-radius: 8px;
            font-weight: 600;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(124, 58, 237, 0.4);
        }
        
        .btn-secondary {
            background: var(--tertiary-dark);
            border: 1px solid var(--border-dark);
            color: var(--text-secondary);
            border-radius: 8px;
        }
        
        .btn-secondary:hover {
            background: var(--secondary-dark);
            color: var(--text-primary);
        }
        
        /* Cards y contenedores oscuros */
        .card {
            background: var(--secondary-dark);
            border: 1px solid var(--border-dark);
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }
        
        .card-header {
            background: var(--tertiary-dark);
            border-bottom: 1px solid var(--border-dark);
            color: var(--text-primary);
            font-weight: 600;
        }
        
        .card-body {
            color: var(--text-primary);
        }
        
        /* Tablas oscuras */
        .table-dark {
            --bs-table-bg: var(--secondary-dark);
            --bs-table-striped-bg: var(--tertiary-dark);
            color: var(--text-primary);
        }
        
        .table-dark th {
            border-color: var(--border-dark);
            background: var(--primary-dark);
            color: var(--accent-purple);
        }
        
        .table-dark td {
            border-color: var(--border-dark);
        }
        
        /* Alerts oscuros */
        .alert {
            border-radius: 10px;
            border: 1px solid var(--border-dark);
        }
        
        .alert-success {
            background: rgba(34, 197, 94, 0.1);
            color: #4ade80;
            border-color: rgba(34, 197, 94, 0.2);
        }
        
        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            color: #f87171;
            border-color: rgba(239, 68, 68, 0.2);
        }
        
        .alert-warning {
            background: rgba(245, 158, 11, 0.1);
            color: #fbbf24;
            border-color: rgba(245, 158, 11, 0.2);
        }
        
        .alert-info {
            background: rgba(6, 182, 212, 0.1);
            color: #22d3ee;
            border-color: rgba(6, 182, 212, 0.2);
        }
        
        /* Breadcrumbs oscuros */
        .breadcrumb {
            background: var(--tertiary-dark);
            border-radius: 8px;
            padding: 12px 16px;
        }
        
        .breadcrumb-item a {
            color: var(--accent-purple);
            text-decoration: none;
        }
        
        .breadcrumb-item.active {
            color: var(--text-secondary);
        }
        
        /* Paginación oscura */
        .pagination .page-link {
            background: var(--secondary-dark);
            border: 1px solid var(--border-dark);
            color: var(--text-primary);
        }
        
        .pagination .page-link:hover {
            background: var(--accent-purple);
            border-color: var(--accent-purple);
        }
        
        .pagination .page-item.active .page-link {
            background: var(--accent-blue);
            border-color: var(--accent-blue);
        }
    </style>
</head>
<body>
    <div class="container-fluid p-0">
        <div class="row g-0">
            @php
                $navigationSections = [
                    [
                        'id' => 'contabilidad',
                        'title' => 'Contabilidad',
                        'icon' => 'fas fa-calculator',
                        'items' => [
                            [
                                'type' => 'link',
                                'title' => 'Gestión de Cuentas',
                                'icon' => 'fas fa-list-alt',
                                'route' => 'accounts.index',
                                'route_pattern' => 'accounts.*'
                            ],
                            [
                                'type' => 'link',
                                'title' => 'Asientos Contables',
                                'icon' => 'fas fa-book',
                                'route' => 'journal.index',
                                'route_pattern' => 'journal.*'
                            ],
                            [
                                'type' => 'link',
                                'title' => 'Mayor General',
                                'icon' => 'fas fa-file-alt',
                                'route' => 'ledger.index',
                                'route_pattern' => 'ledger.*'
                            ],
                            [
                                'type' => 'link',
                                'title' => 'Balance General',
                                'icon' => 'fas fa-balance-scale',
                                'route' => 'balance.index',
                                'route_pattern' => 'balance.*'
                            ],
                            [
                                'type' => 'link',
                                'title' => 'Estado de Resultados',
                                'icon' => 'fas fa-chart-line',
                                'route' => 'estado-resultados.index',
                                'route_pattern' => 'estado-resultados.*'
                            ],
                            [
                                'type' => 'link',
                                'title' => 'Parámetros Contables',
                                'icon' => 'fas fa-sliders-h',
                                'route' => 'parametros.index',
                                'route_pattern' => 'parametros.*'
                            ]
                        ]
                    ],
                    [
                        'id' => 'facturacion',
                        'title' => 'Facturación',
                        'icon' => 'fas fa-file-digital',
                        'items' => [
                            [
                                'type' => 'link',
                                'title' => 'Clientes',
                                'icon' => 'fas fa-users',
                                'route' => 'clientes.index',
                                'route_pattern' => 'clientes.*'
                            ],
                            [
                                'type' => 'link',
                                'title' => 'Factura Electrónica',
                                'icon' => 'fas fa-file-digital',
                                'route' => 'documentos-electronicos.index',
                                'route_pattern' => 'documentos-electronicos.*'
                            ],
                            [
                                'type' => 'link',
                                'title' => 'Cuentas por Cobrar',
                                'icon' => 'fas fa-hand-holding-usd',
                                'route' => 'cuentas-por-cobrar.index',
                                'route_pattern' => 'cuentas-por-cobrar.*'
                            ]
                        ]
                    ],
                    [
                        'id' => 'operaciones',
                        'title' => 'Operaciones',
                        'icon' => 'fas fa-cogs',
                        'items' => [
                            [
                                'type' => 'link',
                                'title' => 'Inventario',
                                'icon' => 'fas fa-boxes',
                                'route' => 'inventario.index',
                                'route_pattern' => 'inventario.*'
                            ],
                            [
                                'type' => 'link',
                                'title' => 'Compras',
                                'icon' => 'fas fa-shopping-cart',
                                'route' => 'compras.index',
                                'route_pattern' => 'compras.*'
                            ],
                            [
                                'type' => 'modal',
                                'title' => 'Proveedores',
                                'icon' => 'fas fa-truck',
                                'onclick' => 'abrirModalProveedor()',
                                'tooltip' => 'Crear nuevo proveedor'
                            ],
                            [
                                'type' => 'link',
                                'title' => 'Cuentas por Pagar',
                                'icon' => 'fas fa-credit-card',
                                'route' => 'cuentas-por-pagar.index',
                                'route_pattern' => 'cuentas-por-pagar.*'
                            ],
                            [
                                'type' => 'link',
                                'title' => 'Control Bancario',
                                'icon' => 'fas fa-university',
                                'route' => 'bancos.index',
                                'route_pattern' => 'bancos.*'
                            ]
                        ]
                    ]
                ];
            @endphp
            
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar">
                <div class="logo-section">
                    <h4><i class="fas fa-calculator"></i> Sistema</h4>
                    <small class="text-muted">Contable</small>
                </div>
                
                <nav class="nav flex-column">
                    @foreach ($navigationSections as $section)
                        <x-nav-section :section="$section" />
                    @endforeach
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

        // Restaurar estado de secciones al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            const sections = ['contabilidad', 'facturacion', 'operaciones'];
            
            sections.forEach(function(sectionId) {
                const collapsed = localStorage.getItem('nav_' + sectionId + '_collapsed');
                
                if (collapsed === 'true') {
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
    
    <!-- Modal para crear proveedor usando componente -->
    @php
        $proveedorFields = [
            'basic' => [
                'title' => 'Información Básica',
                'icon' => 'fas fa-id-card',
                'fields' => [
                    [
                        'columns' => [
                            [
                                'size' => 'md-4',
                                'name' => 'tipo_documento',
                                'label' => 'Tipo de Documento',
                                'type' => 'select',
                                'required' => true,
                                'options' => [
                                    'NIT' => 'NIT',
                                    'DUI' => 'DUI',
                                    'Pasaporte' => 'Pasaporte',
                                    'Carnet de Residente' => 'Carnet de Residente'
                                ]
                            ],
                            [
                                'size' => 'md-8',
                                'name' => 'numero_documento',
                                'label' => 'Número de Documento',
                                'type' => 'text',
                                'required' => true,
                                'placeholder' => 'Ej: 0614-150393-001-2'
                            ]
                        ]
                    ],
                    [
                        'columns' => [
                            [
                                'size' => 'md-6',
                                'name' => 'razon_social',
                                'label' => 'Razón Social',
                                'type' => 'text',
                                'required' => true,
                                'placeholder' => 'Nombre completo o razón social'
                            ],
                            [
                                'size' => 'md-6',
                                'name' => 'nombre_comercial',
                                'label' => 'Nombre Comercial',
                                'type' => 'text',
                                'placeholder' => 'Nombre comercial o marca'
                            ]
                        ]
                    ]
                ]
            ],
            'contact' => [
                'title' => 'Información de Contacto',
                'icon' => 'fas fa-phone',
                'fields' => [
                    [
                        'columns' => [
                            [
                                'size' => 'md-6',
                                'name' => 'telefono',
                                'label' => 'Teléfono',
                                'type' => 'text',
                                'placeholder' => 'Ej: 2298-5500'
                            ],
                            [
                                'size' => 'md-6',
                                'name' => 'email',
                                'label' => 'Correo Electrónico',
                                'type' => 'email',
                                'placeholder' => 'proveedor@empresa.com'
                            ]
                        ]
                    ],
                    [
                        'columns' => [
                            [
                                'size' => 'md-8',
                                'name' => 'direccion',
                                'label' => 'Dirección',
                                'type' => 'text',
                                'placeholder' => 'Dirección completa'
                            ],
                            [
                                'size' => 'md-4',
                                'name' => 'limite_credito',
                                'label' => 'Límite de Crédito',
                                'type' => 'number',
                                'prefix' => '$',
                                'default' => '0.00'
                            ]
                        ]
                    ]
                ]
            ]
        ];
    @endphp
    
    <x-crud-modal 
        modalId="modalProveedor" 
        title="Crear Nuevo Proveedor" 
        action="guardarProveedorModal()" 
        :fields="$proveedorFields"
        listRoute="cuentas-por-cobrar.proveedores.index" />
</body>
</html>