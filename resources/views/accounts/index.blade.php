@extends('layouts.app')

@section('title', 'Catálogo de Cuentas')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4 text-primary">
        <i class="fas fa-list-alt"></i> Catálogo de Cuentas Contables
    </h1>
    
    <!-- Controles superiores -->
    <div class="row mb-3">
        <div class="col-md-6">
            <a href="{{ route('accounts.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Nueva Cuenta
            </a>
        </div>
        
        <!-- Buscador -->
        <div class="col-md-6">
            <form method="GET" action="{{ route('accounts.index') }}" class="d-flex">
                <input type="text" 
                       name="search" 
                       class="form-control me-2" 
                       placeholder="Buscar por código o descripción..." 
                       value="{{ $search ?? '' }}">
                <button type="submit" class="btn btn-outline-primary me-2">
                    <i class="fas fa-search"></i>
                </button>
                @if($search)
                    <a href="{{ route('accounts.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times"></i>
                    </a>
                @endif
            </form>
        </div>
    </div>

                <!-- Mensajes de éxito -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Información de resultados -->
                @if($search)
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> 
                        Se encontraron {{ $accounts->total() }} resultado(s) para "<strong>{{ $search }}</strong>"
                    </div>
                @endif

                <!-- Tabla de cuentas -->
                <div class="card shadow">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-table"></i> Lista de Cuentas
                            <span class="badge bg-light text-dark ms-2">{{ $accounts->total() }} total</span>
                        </h5>
                        
                        <!-- Control de elementos por página -->
                        <div class="d-flex align-items-center">
                            <label class="text-white me-2">Mostrar:</label>
                            <form method="GET" action="{{ route('accounts.index') }}" class="d-flex">
                                @if($search)
                                    <input type="hidden" name="search" value="{{ $search }}">
                                @endif
                                <select name="per_page" class="form-select form-select-sm" onchange="this.form.submit()">
                                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                    <option value="15" {{ request('per_page', 15) == 15 ? 'selected' : '' }}>15</option>
                                    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                    <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                                </select>
                            </form>
                        </div>
                    </div>
                    
                    <div class="card-body p-0">
                        @if($accounts->count() > 0)
                            <!-- Información de paginación superior -->
                            <div class="d-flex justify-content-between align-items-center p-3 bg-light border-bottom">
                                <div class="text-muted">
                                    Mostrando {{ $accounts->firstItem() }} a {{ $accounts->lastItem() }} 
                                    de {{ $accounts->total() }} cuentas
                                </div>
                                <div class="text-muted">
                                    Página {{ $accounts->currentPage() }} de {{ $accounts->lastPage() }}
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover mb-0 account-table">
                                    <thead class="table-dark">
                                        <tr>
                                            <th><i class="fas fa-code"></i> Código</th>
                                            <th><i class="fas fa-file-alt"></i> Descripción</th>
                                            <th><i class="fas fa-tag"></i> Tipo</th>
                                            <th><i class="fas fa-balance-scale"></i> Naturaleza</th>
                                            <th><i class="fas fa-layer-group"></i> Grupo</th>
                                            <th><i class="fas fa-exchange-alt"></i> Transacciones</th>
                                            <th width="200"><i class="fas fa-cogs"></i> Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($accounts as $account)
                                            <tr>
                                                <td>
                                                    <code class="account-code">{{ str_replace('.', '', $account->code) }}</code>
                                                </td>
                                                <td class="fw-medium">{{ $account->description }}</td>
                                                <td>
                                                    <span class="badge bg-info">{{ $account->type_account }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge {{ $account->type_naturaled == 'D' ? 'bg-success' : 'bg-warning' }}">
                                                        <i class="fas {{ $account->type_naturaled == 'D' ? 'fa-plus' : 'fa-minus' }}"></i>
                                                        {{ $account->type_naturaled == 'D' ? 'Deudora' : 'Acreedora' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-secondary">{{ $account->group }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge {{ $account->accept_transaction == 'S' ? 'bg-success' : 'bg-secondary' }}">
                                                        <i class="fas {{ $account->accept_transaction == 'S' ? 'fa-check' : 'fa-times' }}"></i>
                                                        {{ $account->accept_transaction == 'S' ? 'Sí' : 'No' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <!-- Botón Editar -->
                                                        <a href="{{ route('accounts.edit', $account->id) }}" 
                                                           class="btn btn-sm btn-outline-primary btn-edit" 
                                                           title="Editar cuenta">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        
                                                        <!-- Botón Eliminar con confirmación mejorada -->
                                                        <button type="button" 
                                                                class="btn btn-sm btn-outline-danger btn-delete" 
                                                                title="Eliminar cuenta"
                                                                onclick="confirmDelete('{{ $account->id }}', '{{ str_replace('.', '', $account->code) }}', '{{ $account->description }}')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                        
                                                        <!-- Form oculto para eliminar -->
                                                        <form id="delete-form-{{ $account->id }}" 
                                                              action="{{ route('accounts.destroy', $account->id) }}" 
                                                              method="POST" 
                                                              style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Controles de paginación -->
                            <div class="card-footer bg-light">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="text-muted">
                                            Mostrando {{ $accounts->firstItem() }} a {{ $accounts->lastItem() }} 
                                            de {{ $accounts->total() }} cuentas
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex justify-content-end">
                                            {{ $accounts->appends(request()->query())->links('pagination.custom') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-folder-open fa-4x text-muted mb-3"></i>
                                <h5 class="text-muted">No hay cuentas registradas</h5>
                                <p class="text-muted">Comienza creando tu primera cuenta contable.</p>
                                <a href="{{ route('accounts.create') }}" class="btn btn-primary btn-lg">
                                    <i class="fas fa-plus"></i> Crear Primera Cuenta
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    
    <script>
        function confirmDelete(accountId, accountCode, accountDescription) {
            Swal.fire({
                title: '¿Eliminar cuenta?',
                html: `
                    <div class="text-start">
                        <p><strong>Código:</strong> <code>${accountCode}</code></p>
                        <p><strong>Descripción:</strong> ${accountDescription}</p>
                        <p class="text-danger">
                            <i class="fas fa-exclamation-triangle"></i> 
                            Esta acción no se puede deshacer.
                        </p>
                    </div>
                `,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="fas fa-trash"></i> Sí, eliminar',
                cancelButtonText: '<i class="fas fa-times"></i> Cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + accountId).submit();
                }
            });
        }

        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                if (alert.classList.contains('show')) {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }
            });
        }, 5000);

        // Mejorar la experiencia del buscador
        document.addEventListener('DOMContentLoaded', function() {
            const searchForm = document.querySelector('form');
            const searchInput = document.querySelector('input[name="search"]');
            const searchButton = document.querySelector('button[type="submit"]');
            
            // Agregar loading state al buscar
            if (searchForm && searchButton) {
                searchForm.addEventListener('submit', function() {
                    searchButton.classList.add('loading');
                    searchButton.innerHTML = '<span class="loading-spinner spinner-border spinner-border-sm" role="status"></span> Buscando...';
                });
            }
            
            // Auto-submit con debounce para búsqueda en tiempo real (opcional)
            let searchTimeout;
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(() => {
                        // Descomentar la siguiente línea para búsqueda automática
                        // searchForm.submit();
                    }, 1000); // Esperar 1 segundo después de que el usuario deje de escribir
                });
            }

            // Agregar atajos de teclado
            document.addEventListener('keydown', function(e) {
                // Ctrl/Cmd + F para enfocar el buscador
                if ((e.ctrlKey || e.metaKey) && e.key === 'f') {
                    e.preventDefault();
                    if (searchInput) {
                        searchInput.focus();
                        searchInput.select();
                    }
                }
                
                // Escape para limpiar búsqueda
                if (e.key === 'Escape' && document.activeElement === searchInput) {
                    searchInput.value = '';
                }
            });
        });

        // Función para ir a una página específica
        function goToPage(page) {
            const url = new URL(window.location);
            url.searchParams.set('page', page);
            window.location.href = url.toString();
        }

        // Función para cambiar elementos por página
        function changePerPage(perPage) {
            const url = new URL(window.location);
            url.searchParams.set('per_page', perPage);
            url.searchParams.delete('page'); // Reset a la primera página
            window.location.href = url.toString();
        }
    </script>
@endsection