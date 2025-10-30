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
                    
                    <!-- Sección Facturación -->
                    <div class="nav-section-header">
                        <h6 class="text-light text-uppercase fw-bold mb-3 nav-section-toggle" onclick="toggleSection('facturacion')">
                            <i class="fas fa-file-invoice-dollar"></i> Facturación
                            <i class="fas fa-chevron-down toggle-icon" id="facturacion-icon"></i>
                        </h6>
                    </div>
                    
                    <div id="facturacion-items" class="nav-section-items">
                        <a class="nav-link {{ request()->routeIs('facturacion.index') ? 'active' : '' }}" href="{{ route('facturacion.index') }}">
                            <i class="fas fa-file-invoice"></i>
                            Gestión de Facturas
                        </a>
                        
                        <a class="nav-link {{ request()->routeIs('documentos-electronicos.index') ? 'active' : '' }}" href="{{ route('documentos-electronicos.index') }}">
                            <i class="fas fa-file-digital"></i>
                            Documentos Electrónicos
                        </a>
                        
                        <a class="nav-link {{ request()->routeIs('documentos-electronicos.clientes.*') ? 'active' : '' }}" href="{{ route('documentos-electronicos.clientes.index') }}">
                            <i class="fas fa-users"></i>
                            Gestión de Clientes
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
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
    </script>
    
    @yield('scripts')
</body>
</html>