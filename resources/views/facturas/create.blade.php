@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0">Nueva Factura</h1>
                <a href="{{ route('journal.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
            </div>
        </div>
    </div>

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error:</strong>
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('facturas.store') }}" method="POST" id="facturaForm">
                @csrf

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="cliente_id" class="form-label">Cliente <span class="text-danger">*</span></label>
                        <select name="cliente_id" id="cliente_id" class="form-select" required>
                            <option value="">Seleccione un cliente</option>
                            @forelse($clientes as $cliente)
                                <option value="{{ $cliente->id }}" 
                                        data-tiene-plantilla="{{ $cliente->plantilla_contable_id ? 'true' : 'false' }}"
                                        {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                                    {{ $cliente->nombre }}
                                    @if(!$cliente->plantilla_contable_id)
                                        (Sin plantilla)
                                    @endif
                                </option>
                            @empty
                                <option value="" disabled>No hay clientes disponibles</option>
                            @endforelse
                        </select>
                        @if($clientes->isEmpty())
                            <div class="alert alert-warning mt-2 mb-0">
                                <i class="fas fa-exclamation-triangle"></i> 
                                No hay clientes registrados. 
                                <a href="{{ route('clientes.create') }}" class="alert-link">Crear primer cliente</a>
                            </div>
                        @else
                            <small class="text-muted">Solo clientes con plantilla contable asignada pueden generar partidas automáticas</small>
                        @endif
                    </div>

                    <div class="col-md-3">
                        <label for="fecha" class="form-label">Fecha <span class="text-danger">*</span></label>
                        <input type="date" name="fecha" id="fecha" class="form-control" 
                               value="{{ old('fecha', date('Y-m-d')) }}" required>
                    </div>

                    <div class="col-md-3">
                        <label for="numero_factura" class="form-label">No. Factura</label>
                        <input type="text" name="numero_factura" id="numero_factura" 
                               class="form-control" value="{{ old('numero_factura') }}" 
                               placeholder="Ej: FAC-001">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="descripcion" class="form-label">Descripción <span class="text-danger">*</span></label>
                        <input type="text" name="descripcion" id="descripcion" 
                               class="form-control" value="{{ old('descripcion') }}" 
                               placeholder="Descripción de la factura" required>
                    </div>
                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Productos/Servicios</h5>
                    <button type="button" class="btn btn-sm btn-primary" id="agregarItem">
                        <i class="fas fa-plus"></i> Agregar Producto
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered" id="tablaItems">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 40%">Producto</th>
                                <th style="width: 15%">Cantidad</th>
                                <th style="width: 15%">Precio Unit.</th>
                                <th style="width: 15%">Subtotal</th>
                                <th style="width: 10%">Plantilla</th>
                                <th style="width: 5%"></th>
                            </tr>
                        </thead>
                        <tbody id="itemsContainer">
                            <!-- Los items se agregarán dinámicamente aquí -->
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                <td colspan="3">
                                    <strong id="totalFactura">$0.00</strong>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="alert alert-info mt-3">
                    <i class="fas fa-info-circle"></i> 
                    <strong>Nota:</strong> Al guardar esta factura, se generará automáticamente una partida contable 
                    en estado NO mayorizado para su revisión. Solo los productos con plantilla contable asignada 
                    generarán movimientos contables.
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('journal.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-success" id="btnGuardar">
                        <i class="fas fa-save"></i> Guardar Factura y Generar Partida
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('scripts')
<script>
let itemCounter = 0;
const productos = @json($productos);

console.log('Productos disponibles:', productos); // Debug

document.addEventListener('DOMContentLoaded', function() {
    // Agregar primer item automáticamente
    agregarNuevoItem();

    // Evento para agregar nuevo item
    document.getElementById('agregarItem').addEventListener('click', function(e) {
        e.preventDefault();
        agregarNuevoItem();
    });

    // Validar cliente al enviar
    document.getElementById('facturaForm').addEventListener('submit', function(e) {
        const clienteSelect = document.getElementById('cliente_id');
        const selectedOption = clienteSelect.options[clienteSelect.selectedIndex];
        const tienePlantilla = selectedOption.getAttribute('data-tiene-plantilla');
        
        if (tienePlantilla === 'false' || !tienePlantilla) {
            e.preventDefault();
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Cliente sin plantilla',
                    text: 'El cliente seleccionado no tiene una plantilla contable asignada. La partida contable se creará sin aplicar plantilla automática.',
                    confirmButtonColor: '#3085d6'
                });
            } else {
                alert('El cliente seleccionado no tiene una plantilla contable asignada.');
            }
            // Permitir continuar de todas formas
            return true;
        }

        // Validar que haya al menos un item
        const items = document.querySelectorAll('#itemsContainer tr').length;
        if (items === 0) {
            e.preventDefault();
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'error',
                    title: 'Sin productos',
                    text: 'Debe agregar al menos un producto a la factura.',
                    confirmButtonColor: '#3085d6'
                });
            } else {
                alert('Debe agregar al menos un producto a la factura.');
            }
            return false;
        }
    });
});

function agregarNuevoItem() {
    itemCounter++;
    
    let productosOptions = '<option value="">Seleccione un producto</option>';
    productos.forEach(p => {
        const tienePlantilla = p.plantilla_contable_id ? 'true' : 'false';
        const manejaInventario = p.maneja_inventario ? 'true' : 'false';
        const sinPlantilla = !p.plantilla_contable_id ? ' (Sin plantilla)' : '';
        
        productosOptions += `
            <option value="${p.id}" 
                    data-precio="${p.precio_venta}" 
                    data-tiene-plantilla="${tienePlantilla}"
                    data-maneja-inventario="${manejaInventario}">
                ${p.nombre}${sinPlantilla}
            </option>
        `;
    });
    
    const itemHtml = `
        <tr data-item="${itemCounter}">
            <td>
                <select name="items[${itemCounter}][producto_id]" class="form-select producto-select" required>
                    ${productosOptions}
                </select>
            </td>
            <td>
                <input type="number" name="items[${itemCounter}][cantidad]" 
                       class="form-control cantidad-input" min="0.01" step="0.01" value="1" required>
            </td>
            <td>
                <input type="number" name="items[${itemCounter}][precio_unitario]" 
                       class="form-control precio-input" min="0.01" step="0.01" value="0.00" required>
            </td>
            <td>
                <input type="text" class="form-control subtotal-display" readonly value="$0.00">
                <input type="hidden" name="items[${itemCounter}][subtotal]" class="subtotal-value" value="0">
            </td>
            <td class="text-center plantilla-status">
                <span class="badge bg-secondary">-</span>
            </td>
            <td class="text-center">
                <button type="button" class="btn btn-sm btn-danger eliminar-item">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        </tr>
    `;
    
    document.getElementById('itemsContainer').insertAdjacentHTML('beforeend', itemHtml);
    
    // Eventos para el nuevo item
    const newRow = document.querySelector(`tr[data-item="${itemCounter}"]`);
    
    // Cambio de producto
    newRow.querySelector('.producto-select').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const precio = parseFloat(selectedOption.getAttribute('data-precio')) || 0;
        const tienePlantilla = selectedOption.getAttribute('data-tiene-plantilla');
        
        // Actualizar precio
        newRow.querySelector('.precio-input').value = precio.toFixed(2);
        
        // Actualizar badge de plantilla
        const badge = newRow.querySelector('.plantilla-status span');
        if (tienePlantilla === 'true') {
            badge.className = 'badge bg-success';
            badge.innerHTML = '<i class="fas fa-check"></i>';
        } else {
            badge.className = 'badge bg-danger';
            badge.innerHTML = '<i class="fas fa-times"></i>';
        }
        
        calcularSubtotal(newRow);
    });
    
    // Cambio de cantidad o precio
    newRow.querySelector('.cantidad-input').addEventListener('input', function() {
        calcularSubtotal(newRow);
    });
    
    newRow.querySelector('.precio-input').addEventListener('input', function() {
        calcularSubtotal(newRow);
    });
    
    // Eliminar item
    newRow.querySelector('.eliminar-item').addEventListener('click', function() {
        newRow.remove();
        calcularTotal();
    });
}

function calcularSubtotal(row) {
    const cantidad = parseFloat(row.querySelector('.cantidad-input').value) || 0;
    const precio = parseFloat(row.querySelector('.precio-input').value) || 0;
    const subtotal = cantidad * precio;
    
    row.querySelector('.subtotal-display').value = '$' + subtotal.toFixed(2);
    row.querySelector('.subtotal-value').value = subtotal.toFixed(2);
    
    calcularTotal();
}

function calcularTotal() {
    let total = 0;
    
    document.querySelectorAll('#itemsContainer tr').forEach(function(row) {
        const subtotal = parseFloat(row.querySelector('.subtotal-value').value) || 0;
        total += subtotal;
    });
    
    document.getElementById('totalFactura').textContent = '$' + total.toFixed(2);
}
</script>
@endsection

@section('styles')
<style>
    .table-responsive {
        overflow-x: auto;
    }
    
    .producto-select {
        font-size: 0.9rem;
    }
    
    .badge {
        padding: 0.35em 0.65em;
    }
    
    #totalFactura {
        font-size: 1.2rem;
        color: #198754;
    }
    
    .alert-info {
        border-left: 4px solid #0dcaf0;
    }
</style>
@endsection
                <input type="hidden" name="items[${itemCounter}][subtotal]" class="subtotal-value" value="0">
            </td>
            <td class="text-center plantilla-status">
                <span class="badge bg-secondary">-</span>
            </td>
            <td class="text-center">
                <button type="button" class="btn btn-sm btn-danger eliminar-item">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        </tr>
    `;
    
    $('#itemsContainer').append(itemHtml);
    
    // Eventos para el nuevo item
    const $newRow = $(`tr[data-item="${itemCounter}"]`);
    
    // Cambio de producto
    $newRow.find('.producto-select').change(function() {
        const selectedOption = $(this).find('option:selected');
        const precio = parseFloat(selectedOption.data('precio')) || 0;
        const tienePlantilla = selectedOption.data('tiene-plantilla');
        
        // Actualizar precio
        $newRow.find('.precio-input').val(precio.toFixed(2));
        
        // Actualizar badge de plantilla
        const $badge = $newRow.find('.plantilla-status span');
        if (tienePlantilla === 'true') {
            $badge.removeClass('bg-secondary bg-danger').addClass('bg-success').html('<i class="fas fa-check"></i>');
        } else {
            $badge.removeClass('bg-secondary bg-success').addClass('bg-danger').html('<i class="fas fa-times"></i>');
        }
        
        calcularSubtotal($newRow);
    });
    
    // Cambio de cantidad o precio
    $newRow.find('.cantidad-input, .precio-input').on('input', function() {
        calcularSubtotal($newRow);
    });
    
    // Eliminar item
    $newRow.find('.eliminar-item').click(function() {
        $newRow.remove();
        calcularTotal();
    });
}

function calcularSubtotal($row) {
    const cantidad = parseFloat($row.find('.cantidad-input').val()) || 0;
    const precio = parseFloat($row.find('.precio-input').val()) || 0;
    const subtotal = cantidad * precio;
    
    $row.find('.subtotal-display').val('$' + subtotal.toFixed(2));
    $row.find('.subtotal-value').val(subtotal.toFixed(2));
    
    calcularTotal();
}

function calcularTotal() {
    let total = 0;
    
    $('#itemsContainer tr').each(function() {
        const subtotal = parseFloat($(this).find('.subtotal-value').val()) || 0;
        total += subtotal;
    });
    
    $('#totalFactura').text('$' + total.toFixed(2));
}
</script>
@endsection
