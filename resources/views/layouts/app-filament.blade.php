<!DOCTYPE html>
<html lang="es" class="h-full bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sistema Contable')</title>
    
    <!-- Bootstrap CSS compilado -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <!-- Filament Styles -->
    @filamentStyles
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- CSS personalizado para tema claro -->
    <style>
        /* Forzar tema claro básico */
        html, body {
            background-color: #ffffff !important;
            color: #1f2937 !important;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }
        
        /* Asegurar que Bootstrap se aplique */
        .container, .container-fluid {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }
        
        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }
        
        .bg-white {
            background-color: #ffffff !important;
        }
        
        .shadow-sm {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
        }
        
        .rounded-lg {
            border-radius: 0.5rem !important;
        }
        
        .p-4 {
            padding: 1.5rem !important;
        }
        
        .mb-4 {
            margin-bottom: 1.5rem !important;
        }
        
        .d-flex {
            display: flex !important;
        }
        
        .align-items-center {
            align-items: center !important;
        }
        
        .justify-content-between {
            justify-content: space-between !important;
        }
        
        .text-muted {
            color: #6c757d !important;
        }
        
        .btn {
            display: inline-block;
            font-weight: 400;
            text-align: center;
            vertical-align: middle;
            cursor: pointer;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out;
        }
        
        .btn-primary {
            color: #fff;
            background-color: #0d6efd;
            border: 1px solid #0d6efd;
        }
        
        .btn-primary:hover {
            background-color: #0b5ed7;
            border-color: #0a58ca;
        }
        
        .btn-outline-secondary {
            color: #6c757d;
            border: 1px solid #6c757d;
            background-color: transparent;
        }
        
        .btn-outline-secondary:hover {
            color: #fff;
            background-color: #6c757d;
        }
        
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            border-collapse: collapse;
        }
        
        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
            padding: 0.75rem;
        }
        
        .table tbody td {
            padding: 0.75rem;
            border-top: 1px solid #dee2e6;
        }
        
        .table-hover tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.075);
        }
        
        .badge {
            display: inline-block;
            padding: 0.35em 0.65em;
            font-size: 0.75em;
            font-weight: 700;
            line-height: 1;
            color: #fff;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.25rem;
        }
        
        .bg-success {
            background-color: #198754 !important;
        }
        
        .bg-info {
            background-color: #0dcaf0 !important;
        }
        
        .bg-warning {
            background-color: #ffc107 !important;
            color: #000 !important;
        }
        
        .bg-danger {
            background-color: #dc3545 !important;
        }
        
        .bg-secondary {
            background-color: #6c757d !important;
        }
        
        .form-control, .form-select {
            display: block;
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #212529;
            background-color: #fff;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #86b7fe;
            outline: 0;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
        
        .alert {
            padding: 1rem 1rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: 0.25rem;
        }
        
        .alert-info {
            color: #055160;
            background-color: #cff4fc;
            border-color: #b6effb;
        }
        
        .alert-warning {
            color: #664d03;
            background-color: #fff3cd;
            border-color: #ffecb5;
        }
        
        /* Asegurar que los SVG tengan tamaño correcto */
        svg {
            display: inline-block;
            vertical-align: middle;
        }
        
        /* Navegación personalizada */
        .nav-link {
            @apply text-gray-600 hover:text-gray-900 hover:bg-gray-100 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200;
        }
        
        .nav-link.active {
            @apply bg-blue-100 text-blue-700 font-semibold;
        }
        
        .nav-section-toggle {
            @apply text-gray-600 hover:text-gray-900 hover:bg-gray-100 px-3 py-2 rounded-md text-sm font-medium cursor-pointer transition-colors duration-200 select-none;
        }
        
        .nav-section-items {
            @apply transition-all duration-300 overflow-hidden;
        }
        
        .nav-section-items.collapsed {
            @apply h-0 opacity-0 transform -translate-y-2;
        }
        
        .toggle-icon {
            @apply transition-all duration-300 float-right mt-0.5;
        }
        
        /* Sidebar personalizado */
        .sidebar {
            @apply min-h-screen bg-white border-r border-gray-200;
        }
        
        .logo-section {
            @apply text-center py-6 border-b border-gray-200 mb-6;
        }
        
        .logo-section h4 {
            @apply text-gray-900 mb-1 font-bold text-xl tracking-wide;
        }
        
        .logo-section small {
            @apply text-gray-500 font-medium text-xs uppercase tracking-widest;
        }
        
        /* Área principal */
        .main-content {
            @apply min-h-screen bg-gray-50 p-6;
        }
    </style>
    
    @livewireStyles
</head>
<body class="h-full bg-white text-gray-900"  data-theme="light">
    <div class="flex h-full">
        @php
            $navigationSections = [
                [
                    'id' => 'contabilidad',
                    'title' => 'Contabilidad',
                    'icon' => 'heroicon-o-calculator',
                    'items' => [
                        [
                            'type' => 'link',
                            'title' => 'Gestión de Cuentas',
                            'icon' => 'heroicon-o-rectangle-stack',
                            'route' => 'accounts.index',
                            'route_pattern' => 'accounts.*'
                        ],
                        [
                            'type' => 'link',
                            'title' => 'Asientos Contables',
                            'icon' => 'heroicon-o-book-open',
                            'route' => 'journal.index',
                            'route_pattern' => 'journal.*'
                        ],
                        [
                            'type' => 'link',
                            'title' => 'Mayor General',
                            'icon' => 'heroicon-o-document-text',
                            'route' => 'ledger.index',
                            'route_pattern' => 'ledger.*'
                        ],
                        [
                            'type' => 'link',
                            'title' => 'Balance General',
                            'icon' => 'heroicon-o-scale',
                            'route' => 'balance.index',
                            'route_pattern' => 'balance.*'
                        ],
                        [
                            'type' => 'link',
                            'title' => 'Estado de Resultados',
                            'icon' => 'heroicon-o-chart-bar',
                            'route' => 'balance.index',
                            'route_pattern' => 'estado-resultados.*'
                        ],
                        [
                            'type' => 'link',
                            'title' => 'Parámetros Contables',
                            'icon' => 'heroicon-o-adjustments-horizontal',
                            'route' => 'accounts.index',
                            'route_pattern' => 'parametros.*'
                        ]
                    ]
                ],
                [
                    'id' => 'facturacion',
                    'title' => 'Facturación',
                    'icon' => 'heroicon-o-document-duplicate',
                    'items' => [
                        [
                            'type' => 'link',
                            'title' => 'Clientes',
                            'icon' => 'heroicon-o-users',
                            'route' => 'accounts.index',
                            'route_pattern' => 'clientes.*'
                        ],
                        [
                            'type' => 'link',
                            'title' => 'Factura Electrónica',
                            'icon' => 'heroicon-o-document-check',
                            'route' => 'accounts.index',
                            'route_pattern' => 'documentos-electronicos.*'
                        ],
                        [
                            'type' => 'link',
                            'title' => 'Cuentas por Cobrar',
                            'icon' => 'heroicon-o-banknotes',
                            'route' => 'accounts.index',
                            'route_pattern' => 'cuentas-por-cobrar.*'
                        ]
                    ]
                ],
                [
                    'id' => 'administracion',
                    'title' => 'Administración',
                    'icon' => 'heroicon-o-cog-6-tooth',
                    'items' => [
                        [
                            'type' => 'link',
                            'title' => 'Panel Filament',
                            'icon' => 'heroicon-o-squares-2x2',
                            'route' => 'filament.pages.dashboard',
                            'route_pattern' => 'filament.*'
                        ],
                        [
                            'type' => 'link',
                            'title' => 'Inventario',
                            'icon' => 'heroicon-o-cube',
                            'route' => 'accounts.index',
                            'route_pattern' => 'inventario.*'
                        ],
                        [
                            'type' => 'link',
                            'title' => 'Compras',
                            'icon' => 'heroicon-o-shopping-cart',
                            'route' => 'accounts.index',
                            'route_pattern' => 'compras.*'
                        ]
                    ]
                ]
            ];
        @endphp
        
        <!-- Sidebar -->
        <div class="flex-shrink-0 w-64 sidebar">
            <div class="logo-section">
                <div class="flex items-center justify-center space-x-2">
                    <svg class="w-8 h-8 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01m3-3h.01m0-3h.01m3 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <h4>Sistema</h4>
                        <small>Contable ERP</small>
                    </div>
                </div>
            </div>
            
            <nav class="px-4 space-y-2">
                @foreach ($navigationSections as $section)
                    <div class="space-y-1">
                        <!-- Section Header -->
                        <div class="nav-section-toggle flex items-center justify-between"
                             onclick="toggleSection('{{ $section['id'] }}')">
                            <div class="flex items-center space-x-2">
                                @if($section['id'] === 'contabilidad')
                                    <span class="text-lg">📊</span>
                                @elseif($section['id'] === 'facturacion')
                                    <span class="text-lg">🧾</span>
                                @elseif($section['id'] === 'administracion')
                                    <span class="text-lg">⚙️</span>
                                @endif
                                <span>{{ $section['title'] }}</span>
                            </div>
                            <span class="text-sm toggle-icon" id="{{ $section['id'] }}-icon">▼</span>
                        </div>
                        
                        <!-- Section Items -->
                        <div class="nav-section-items ml-4 space-y-1" 
                             id="{{ $section['id'] }}-items">
                            @foreach($section['items'] as $item)
                                @if($item['type'] === 'link')
                                    <a class="nav-link flex items-center space-x-2 {{ request()->routeIs($item['route_pattern']) ? 'active' : '' }}" 
                                       href="{{ route($item['route']) }}">
                                        @if(str_contains($item['icon'], 'rectangle-stack'))
                                            <span>📋</span>
                                        @elseif(str_contains($item['icon'], 'book-open'))
                                            <span>📖</span>
                                        @elseif(str_contains($item['icon'], 'document-text'))
                                            <span>📄</span>
                                        @elseif(str_contains($item['icon'], 'scale'))
                                            <span>⚖️</span>
                                        @elseif(str_contains($item['icon'], 'chart-bar'))
                                            <span>📊</span>
                                        @elseif(str_contains($item['icon'], 'adjustments'))
                                            <span>🔧</span>
                                        @elseif(str_contains($item['icon'], 'users'))
                                            <span>👥</span>
                                        @elseif(str_contains($item['icon'], 'document-check'))
                                            <span>✅</span>
                                        @elseif(str_contains($item['icon'], 'banknotes'))
                                            <span>💰</span>
                                        @elseif(str_contains($item['icon'], 'squares'))
                                            <span>⊞</span>
                                        @elseif(str_contains($item['icon'], 'cube'))
                                            <span>📦</span>
                                        @elseif(str_contains($item['icon'], 'shopping'))
                                            <span>🛒</span>
                                        @else
                                            <span>📄</span>
                                        @endif
                                        <span>{{ $item['title'] }}</span>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </nav>
        </div>
        
        <!-- Main Content -->
        <div class="flex-1 main-content">
            @yield('content')
        </div>
    </div>

    <!-- Filament Scripts -->
    @filamentScripts
    @livewireScripts
    
    <script>
        // Forzar tema claro y prevenir cambios de tema
        document.documentElement.setAttribute('data-theme', 'light');
        document.documentElement.classList.remove('dark');
        document.body.classList.remove('dark');
        
        // Prevenir que se aplique el tema oscuro
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.type === 'attributes' && 
                    (mutation.attributeName === 'class' || mutation.attributeName === 'data-theme')) {
                    
                    const target = mutation.target;
                    if (target.classList.contains('dark')) {
                        target.classList.remove('dark');
                    }
                    if (target.getAttribute('data-theme') === 'dark') {
                        target.setAttribute('data-theme', 'light');
                    }
                }
            });
        });
        
        observer.observe(document.documentElement, {
            attributes: true,
            attributeFilter: ['class', 'data-theme']
        });
        
        observer.observe(document.body, {
            attributes: true,
            attributeFilter: ['class', 'data-theme']
        });
        
        function toggleSection(sectionId) {
            const items = document.getElementById(sectionId + '-items');
            const icon = document.getElementById(sectionId + '-icon');
            
            if (items.classList.contains('collapsed')) {
                items.classList.remove('collapsed');
                icon.textContent = '▼';
                localStorage.setItem('nav_' + sectionId + '_collapsed', 'false');
            } else {
                items.classList.add('collapsed');
                icon.textContent = '▶';
                localStorage.setItem('nav_' + sectionId + '_collapsed', 'true');
            }
        }

        // Restaurar estado de secciones al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            const sections = ['contabilidad', 'facturacion', 'administracion'];
            
            sections.forEach(function(sectionId) {
                const collapsed = localStorage.getItem('nav_' + sectionId + '_collapsed');
                
                if (collapsed === 'true') {
                    const items = document.getElementById(sectionId + '-items');
                    const icon = document.getElementById(sectionId + '-icon');
                    
                    if (items && icon) {
                        items.classList.add('collapsed');
                        icon.textContent = '▶';
                    }
                }
            });
            
            // Forzar tema claro después de que se cargue todo
            setTimeout(function() {
                document.documentElement.setAttribute('data-theme', 'light');
                document.documentElement.classList.remove('dark');
                document.body.classList.remove('dark');
            }, 100);
        });
    </script>
    
    <!-- JavaScript compilado -->
    <script src="{{ asset('js/app.js') }}"></script>
    
    @yield('scripts')
</body>
</html>