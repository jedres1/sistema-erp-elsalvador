<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sistema Contable')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    
    <style>
        body {
            background-color: #f8f9fa;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }
        
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #2c3e50 0%, #34495e 100%);
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }
        
        .sidebar .logo {
            padding: 1.5rem;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .sidebar .logo h4 {
            color: #fff;
            margin: 0;
            font-weight: 600;
        }
        
        .sidebar .logo small {
            color: rgba(255,255,255,0.7);
            font-size: 0.75rem;
        }
        
        .sidebar .nav-section {
            padding: 1rem 0;
        }
        
        .sidebar .nav-section-title {
            padding: 0.5rem 1.5rem;
            color: rgba(255,255,255,0.5);
            font-size: 0.75rem;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 1px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s;
        }
        
        .sidebar .nav-section-title:hover {
            color: rgba(255,255,255,0.8);
            background-color: rgba(255,255,255,0.05);
        }
        
        .sidebar .nav-section-title i {
            transition: transform 0.3s;
        }
        
        .sidebar .nav-section-title.collapsed i {
            transform: rotate(-90deg);
        }
        
        .sidebar .nav-section-content {
            transition: all 0.3s ease-in-out;
            overflow: hidden;
        }
        
        .sidebar .nav-section-content.collapse:not(.show) {
            display: none;
        }
        
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 0.75rem 1.5rem;
            display: flex;
            align-items: center;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }
        
        .sidebar .nav-link:hover {
            background-color: rgba(255,255,255,0.1);
            color: #fff;
            border-left-color: #3498db;
        }
        
        .sidebar .nav-link.active {
            background-color: rgba(52, 152, 219, 0.2);
            color: #fff;
            border-left-color: #3498db;
        }
        
        .sidebar .nav-link i {
            width: 20px;
            margin-right: 0.75rem;
        }
        
        .main-content {
            min-height: 100vh;
            padding: 2rem;
        }
        
        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
            margin-bottom: 1.5rem;
        }
        
        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #e9ecef;
            padding: 1rem 1.5rem;
        }
        
        .table-hover tbody tr:hover {
            background-color: rgba(52, 152, 219, 0.05);
        }
        
        .badge {
            padding: 0.35em 0.65em;
            font-weight: 500;
        }
        
        .btn {
            padding: 0.5rem 1rem;
            font-weight: 500;
        }
        
        .page-header {
            margin-bottom: 2rem;
        }
        
        .page-header h1 {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        
        .page-header .breadcrumb {
            background: none;
            padding: 0;
            margin: 0;
        }
    </style>
    
    @yield('styles')
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 px-0 sidebar">
                <div class="logo">
                    <h4>📊 ERP System</h4>
                    <small>Sistema Contable</small>
                </div>
                
                <nav class="nav flex-column">
                    <!-- Contabilidad -->
                    <div class="nav-section">
                        <div class="nav-section-title {{ request()->routeIs(['accounts.*', 'journal.*', 'ledger.*', 'balance.*']) ? '' : 'collapsed' }}" data-bs-toggle="collapse" data-bs-target="#contabilidadMenu">
                            <span>Contabilidad</span>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="collapse {{ request()->routeIs(['accounts.*', 'journal.*', 'ledger.*', 'balance.*']) ? 'show' : '' }} nav-section-content" id="contabilidadMenu">
                            <a class="nav-link {{ request()->routeIs('accounts.*') ? 'active' : '' }}" href="{{ route('accounts.index') }}">
                                <i class="fas fa-list"></i>
                                <span>Catálogo de Cuentas</span>
                            </a>
                            <a class="nav-link {{ request()->routeIs('journal.*') ? 'active' : '' }}" href="{{ route('journal.index') }}">
                                <i class="fas fa-book"></i>
                                <span>Libro Diario</span>
                            </a>
                            <a class="nav-link {{ request()->routeIs('ledger.*') ? 'active' : '' }}" href="{{ route('ledger.index') }}">
                                <i class="fas fa-file-alt"></i>
                                <span>Mayor General</span>
                            </a>
                            <a class="nav-link {{ request()->routeIs('balance.*') ? 'active' : '' }}" href="{{ route('balance.index') }}">
                                <i class="fas fa-balance-scale"></i>
                                <span>Balance General</span>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Facturación -->
                    <div class="nav-section">
                        <div class="nav-section-title {{ request()->routeIs(['clientes.*', 'facturas.*', 'documentos-electronicos.*', 'cuentas-por-cobrar.*']) ? '' : 'collapsed' }}" data-bs-toggle="collapse" data-bs-target="#facturacionMenu">
                            <span>Facturación</span>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="collapse {{ request()->routeIs(['clientes.*', 'facturas.*', 'documentos-electronicos.*', 'cuentas-por-cobrar.*']) ? 'show' : '' }} nav-section-content" id="facturacionMenu">
                            <a class="nav-link {{ request()->routeIs('clientes.*') ? 'active' : '' }}" href="{{ route('clientes.index') }}">
                                <i class="fas fa-users"></i>
                                <span>Clientes</span>
                            </a>
                            <a class="nav-link {{ request()->routeIs('facturas.*') ? 'active' : '' }}" href="{{ route('facturas.create') }}">
                                <i class="fas fa-plus-circle"></i>
                                <span>Nueva Factura</span>
                            </a>
                            <a class="nav-link {{ request()->routeIs('documentos-electronicos.*') ? 'active' : '' }}" href="{{ route('documentos-electronicos.index') }}">
                                <i class="fas fa-file-invoice"></i>
                                <span>Factura Electrónica</span>
                            </a>
                            <a class="nav-link {{ request()->routeIs('cuentas-por-cobrar.*') ? 'active' : '' }}" href="{{ route('cuentas-por-cobrar.index') }}">
                                <i class="fas fa-hand-holding-usd"></i>
                                <span>Cuentas por Cobrar</span>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Compras -->
                    <div class="nav-section">
                        <div class="nav-section-title {{ request()->routeIs(['proveedores.*', 'compras.*', 'cuentas-por-pagar.*']) ? '' : 'collapsed' }}" data-bs-toggle="collapse" data-bs-target="#comprasMenu">
                            <span>Compras</span>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="collapse {{ request()->routeIs(['proveedores.*', 'compras.*', 'cuentas-por-pagar.*']) ? 'show' : '' }} nav-section-content" id="comprasMenu">
                            <a class="nav-link {{ request()->routeIs('proveedores.*') ? 'active' : '' }}" href="{{ route('proveedores.index') }}">
                                <i class="fas fa-truck"></i>
                                <span>Proveedores</span>
                            </a>
                            <a class="nav-link {{ request()->routeIs('compras.*') ? 'active' : '' }}" href="{{ route('compras.index') }}">
                                <i class="fas fa-shopping-cart"></i>
                                <span>Órdenes de Compra</span>
                            </a>
                            <a class="nav-link {{ request()->routeIs('cuentas-por-pagar.*') ? 'active' : '' }}" href="{{ route('cuentas-por-pagar.index') }}">
                                <i class="fas fa-money-check-alt"></i>
                                <span>Cuentas por Pagar</span>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Tesorería -->
                    <div class="nav-section">
                        <div class="nav-section-title {{ request()->routeIs(['bancos.*']) ? '' : 'collapsed' }}" data-bs-toggle="collapse" data-bs-target="#tesoreriaMenu">
                            <span>Tesorería</span>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="collapse {{ request()->routeIs(['bancos.*']) ? 'show' : '' }} nav-section-content" id="tesoreriaMenu">
                            <a class="nav-link {{ request()->routeIs('bancos.*') ? 'active' : '' }}" href="{{ route('bancos.index') }}">
                                <i class="fas fa-university"></i>
                                <span>Control Bancario</span>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Inventario -->
                    <div class="nav-section">
                        <div class="nav-section-title {{ request()->routeIs(['inventario.*']) ? '' : 'collapsed' }}" data-bs-toggle="collapse" data-bs-target="#inventarioMenu">
                            <span>Inventario</span>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="collapse {{ request()->routeIs(['inventario.*']) ? 'show' : '' }} nav-section-content" id="inventarioMenu">
                            <a class="nav-link {{ request()->routeIs('inventario.index') ? 'active' : '' }}" href="{{ route('inventario.index') }}">
                                <i class="fas fa-boxes"></i>
                                <span>Productos</span>
                            </a>
                            <a class="nav-link {{ request()->routeIs('inventario.kardex') ? 'active' : '' }}" href="{{ route('inventario.kardex') }}">
                                <i class="fas fa-clipboard-list"></i>
                                <span>Kardex</span>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Reportes -->
                    <div class="nav-section">
                        <div class="nav-section-title {{ request()->routeIs(['estado-resultados.*']) ? '' : 'collapsed' }}" data-bs-toggle="collapse" data-bs-target="#reportesMenu">
                            <span>Reportes</span>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="collapse {{ request()->routeIs(['estado-resultados.*']) ? 'show' : '' }} nav-section-content" id="reportesMenu">
                            <a class="nav-link {{ request()->routeIs('estado-resultados.*') ? 'active' : '' }}" href="{{ route('estado-resultados.index') }}">
                                <i class="fas fa-chart-bar"></i>
                                <span>Estado de Resultados</span>
                            </a>
                            <a class="nav-link" href="#">
                                <i class="fas fa-chart-line"></i>
                                <span>Flujo de Efectivo</span>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Configuración -->
                    <div class="nav-section">
                        <div class="nav-section-title {{ request()->routeIs(['parametros.*', 'plantillas-contables.*']) ? '' : 'collapsed' }}" data-bs-toggle="collapse" data-bs-target="#configuracionMenu">
                            <span>Configuración</span>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="collapse {{ request()->routeIs(['parametros.*', 'plantillas-contables.*']) ? 'show' : '' }} nav-section-content" id="configuracionMenu">
                            <a class="nav-link {{ request()->routeIs('parametros.*') ? 'active' : '' }}" href="{{ route('parametros.index') }}">
                                <i class="fas fa-cog"></i>
                                <span>Parámetros Contables</span>
                            </a>
                            <a class="nav-link {{ request()->routeIs('plantillas-contables.*') ? 'active' : '' }}" href="{{ route('plantillas-contables.index') }}">
                                <i class="fas fa-file-invoice"></i>
                                <span>Plantillas Contables</span>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-10 main-content">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @yield('content')
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        // Manejar la navegación para que solo un menú esté abierto a la vez
        document.addEventListener('DOMContentLoaded', function() {
            const collapsibleElements = document.querySelectorAll('[data-bs-toggle="collapse"]');
            
            collapsibleElements.forEach(element => {
                const targetId = element.getAttribute('data-bs-target');
                const targetElement = document.querySelector(targetId);
                
                if (targetElement) {
                    // Manejar rotación del icono
                    targetElement.addEventListener('show.bs.collapse', function() {
                        element.classList.remove('collapsed');
                    });
                    
                    targetElement.addEventListener('hide.bs.collapse', function() {
                        element.classList.add('collapsed');
                    });
                }
            });
            
            // Cerrar otros menús cuando se abre uno nuevo
            collapsibleElements.forEach(element => {
                element.addEventListener('click', function(e) {
                    const targetId = this.getAttribute('data-bs-target');
                    const targetElement = document.querySelector(targetId);
                    
                    // Si el menú está cerrado (se va a abrir)
                    if (targetElement && !targetElement.classList.contains('show')) {
                        // Obtener todos los menús collapse abiertos
                        const allCollapseMenus = document.querySelectorAll('.nav-section-content.collapse.show');
                        
                        // Cerrar todos los menús abiertos
                        allCollapseMenus.forEach(menu => {
                            if (menu !== targetElement) {
                                const bsCollapse = bootstrap.Collapse.getInstance(menu);
                                if (bsCollapse) {
                                    bsCollapse.hide();
                                } else {
                                    // Si no tiene instancia, crear una y cerrar
                                    new bootstrap.Collapse(menu, {toggle: false}).hide();
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>
    
    @yield('scripts')
</body>
</html>
