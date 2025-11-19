@extends('layouts.app')

@section('title', 'Crear Plantilla Contable')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="mb-4">
        <div class="bg-white shadow-sm rounded-lg p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-1 text-gray-800">➕ Nueva Plantilla Contable</h1>
                    <p class="text-muted mb-0">Define las cuentas contables para clientes, productos o proveedores</p>
                </div>
                <a href="{{ route('plantillas-contables.index') }}" class="btn btn-outline-secondary">
                    ← Volver
                </a>
            </div>
        </div>
    </div>

    <!-- Formulario -->
    <div class="bg-white shadow-sm rounded-lg p-4">
        <form action="{{ route('plantillas-contables.store') }}" method="POST" id="plantillaForm">
            @csrf
            
            <div class="row">
                <!-- Información básica -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre de la Plantilla <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('nombre') is-invalid @enderror" 
                               id="nombre" 
                               name="nombre" 
                               value="{{ old('nombre') }}" 
                               required
                               placeholder="Ej: Plantilla Cliente Corporativo">
                        @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo <span class="text-danger">*</span></label>
                        <select class="form-select @error('tipo') is-invalid @enderror" 
                                id="tipo" 
                                name="tipo" 
                                required>
                            <option value="">Seleccione...</option>
                            <option value="cliente" {{ old('tipo') == 'cliente' ? 'selected' : '' }}>👤 Cliente</option>
                            <option value="articulo" {{ old('tipo') == 'articulo' ? 'selected' : '' }}>📦 Artículo</option>
                            <option value="proveedor" {{ old('tipo') == 'proveedor' ? 'selected' : '' }}>🏢 Proveedor</option>
                        </select>
                        @error('tipo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">Estado</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   id="activo" 
                                   name="activo" 
                                   value="1"
                                   {{ old('activo', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="activo">
                                Activa
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control @error('descripcion') is-invalid @enderror" 
                                  id="descripcion" 
                                  name="descripcion" 
                                  rows="2"
                                  placeholder="Descripción opcional de la plantilla">{{ old('descripcion') }}</textarea>
                        @error('descripcion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <!-- Cuentas Contables -->
            <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">📊 Cuentas Contables</h5>
                    <button type="button" class="btn btn-sm btn-success" id="addCuentaBtn" disabled>
                        ➕ Agregar Cuenta
                    </button>
                </div>

                <div class="alert alert-info" id="seleccioneTipoAlert">
                    <i class="fas fa-info-circle"></i> Seleccione primero el tipo de plantilla para configurar las cuentas
                </div>

                <div id="cuentasContainer" style="display: none;">
                    <!-- Las cuentas se agregarán dinámicamente aquí -->
                </div>
            </div>

            <hr class="my-4">

            <!-- Botones -->
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('plantillas-contables.index') }}" class="btn btn-outline-secondary">
                    ❌ Cancelar
                </a>
                <button type="submit" class="btn btn-primary">
                    💾 Guardar Plantilla
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
let cuentaIndex = 0;
const tiposCuenta = {
    cliente: [
        { value: 'cuentas_por_cobrar', label: 'Cuentas por Cobrar' },
        { value: 'anticipos_cliente', label: 'Anticipos de Cliente' }
    ],
    articulo: [
        { value: 'ingresos_venta', label: 'Ingresos por Venta' },
        { value: 'inventario', label: 'Inventario' },
        { value: 'costo_venta', label: 'Costo de Venta' }
    ],
    proveedor: [
        { value: 'cuentas_por_pagar', label: 'Cuentas por Pagar' },
        { value: 'anticipos_proveedor', label: 'Anticipos a Proveedor' }
    ]
};

const cuentasContables = @json($cuentasContables);

document.getElementById('tipo').addEventListener('change', function() {
    const tipo = this.value;
    const addBtn = document.getElementById('addCuentaBtn');
    const container = document.getElementById('cuentasContainer');
    const alert = document.getElementById('seleccioneTipoAlert');
    
    if (tipo) {
        addBtn.disabled = false;
        container.style.display = 'block';
        alert.style.display = 'none';
        container.innerHTML = ''; // Limpiar cuentas existentes
        cuentaIndex = 0;
    } else {
        addBtn.disabled = true;
        container.style.display = 'none';
        alert.style.display = 'block';
        container.innerHTML = '';
    }
});

document.getElementById('addCuentaBtn').addEventListener('click', function() {
    const tipo = document.getElementById('tipo').value;
    if (!tipo) return;
    
    agregarCuenta();
});

function agregarCuenta(tipoCuenta = '', accountId = '') {
    const tipo = document.getElementById('tipo').value;
    const tipos = tiposCuenta[tipo] || [];
    
    const html = `
        <div class="card mb-3 cuenta-item" data-index="${cuentaIndex}">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-5">
                        <label class="form-label small">Tipo de Cuenta</label>
                        <select class="form-select form-select-sm" 
                                name="cuentas[${cuentaIndex}][tipo_cuenta]" 
                                required>
                            <option value="">Seleccione tipo...</option>
                            ${tipos.map(t => `
                                <option value="${t.value}" ${tipoCuenta === t.value ? 'selected' : ''}>
                                    ${t.label}
                                </option>
                            `).join('')}
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small">Cuenta Contable</label>
                        <select class="form-select form-select-sm cuenta-select" 
                                name="cuentas[${cuentaIndex}][account_catalog_id]" 
                                required>
                            <option value="">Seleccione cuenta...</option>
                            ${cuentasContables.map(c => `
                                <option value="${c.id}" ${accountId == c.id ? 'selected' : ''}>
                                    ${c.code} - ${c.description}
                                </option>
                            `).join('')}
                        </select>
                    </div>
                    <div class="col-md-1 text-end">
                        <label class="form-label small d-block">&nbsp;</label>
                        <button type="button" 
                                class="btn btn-sm btn-outline-danger" 
                                onclick="eliminarCuenta(${cuentaIndex})">
                            🗑️
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    document.getElementById('cuentasContainer').insertAdjacentHTML('beforeend', html);
    cuentaIndex++;
}

function eliminarCuenta(index) {
    const item = document.querySelector(`[data-index="${index}"]`);
    if (item) {
        item.remove();
    }
}

// Validación del formulario
document.getElementById('plantillaForm').addEventListener('submit', function(e) {
    const tipo = document.getElementById('tipo').value;
    const cuentas = document.querySelectorAll('.cuenta-item');
    
    if (tipo && cuentas.length === 0) {
        e.preventDefault();
        Swal.fire({
            icon: 'warning',
            title: 'Cuentas requeridas',
            text: 'Debe agregar al menos una cuenta contable a la plantilla',
            confirmButtonColor: '#0d6efd'
        });
    }
});
</script>
@endsection
