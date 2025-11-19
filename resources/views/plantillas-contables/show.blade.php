@extends('layouts.app')

@section('title', 'Detalle Plantilla Contable')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="mb-4">
        <div class="bg-white shadow-sm rounded-lg p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-1 text-gray-800">👁️ Detalle de Plantilla Contable</h1>
                    <p class="text-muted mb-0">{{ $plantillasContable->nombre }}</p>
                </div>
                <div class="btn-group" role="group">
                    <a href="{{ route('plantillas-contables.edit', $plantillasContable->id) }}" class="btn btn-primary">
                        ✏️ Editar
                    </a>
                    <a href="{{ route('plantillas-contables.index') }}" class="btn btn-outline-secondary">
                        ← Volver
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Información General -->
        <div class="col-md-4">
            <div class="bg-white shadow-sm rounded-lg p-4 mb-4">
                <h5 class="mb-3">📋 Información General</h5>
                
                <div class="mb-3">
                    <label class="text-muted small">Nombre</label>
                    <p class="mb-0 fw-bold">{{ $plantillasContable->nombre }}</p>
                </div>

                <div class="mb-3">
                    <label class="text-muted small">Tipo</label>
                    <p class="mb-0">
                        @if($plantillasContable->tipo === 'cliente')
                            <span class="badge bg-primary">👤 Cliente</span>
                        @elseif($plantillasContable->tipo === 'articulo')
                            <span class="badge bg-success">📦 Artículo</span>
                        @else
                            <span class="badge bg-info">🏢 Proveedor</span>
                        @endif
                    </p>
                </div>

                <div class="mb-3">
                    <label class="text-muted small">Estado</label>
                    <p class="mb-0">
                        @if($plantillasContable->activo)
                            <span class="badge bg-success">✅ Activa</span>
                        @else
                            <span class="badge bg-danger">❌ Inactiva</span>
                        @endif
                    </p>
                </div>

                @if($plantillasContable->descripcion)
                <div class="mb-3">
                    <label class="text-muted small">Descripción</label>
                    <p class="mb-0">{{ $plantillasContable->descripcion }}</p>
                </div>
                @endif

                <div class="mb-3">
                    <label class="text-muted small">Cuentas Configuradas</label>
                    <p class="mb-0">
                        <span class="badge bg-secondary">{{ $plantillasContable->cuentas->count() }} cuentas</span>
                    </p>
                </div>

                <hr>

                <div class="mb-3">
                    <label class="text-muted small">Fecha de Creación</label>
                    <p class="mb-0">{{ $plantillasContable->created_at->format('d/m/Y H:i') }}</p>
                </div>

                <div class="mb-0">
                    <label class="text-muted small">Última Actualización</label>
                    <p class="mb-0">{{ $plantillasContable->updated_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>

        <!-- Cuentas Contables -->
        <div class="col-md-8">
            <div class="bg-white shadow-sm rounded-lg p-4">
                <h5 class="mb-3">📊 Cuentas Contables Asociadas</h5>

                @if($plantillasContable->cuentas->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 35%;">Tipo de Cuenta</th>
                                <th style="width: 15%;">Código</th>
                                <th style="width: 50%;">Cuenta Contable</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($plantillasContable->cuentas as $cuenta)
                            <tr>
                                <td>
                                    <span class="badge bg-primary">
                                        {{ $cuenta->tipo_cuenta_label }}
                                    </span>
                                </td>
                                <td class="fw-bold text-primary">
                                    {{ $cuenta->cuenta->code }}
                                </td>
                                <td>
                                    {{ $cuenta->cuenta->description }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-5">
                    <div class="mb-3">
                        <span style="font-size: 3rem;">📊</span>
                    </div>
                    <h6 class="text-muted">No hay cuentas configuradas</h6>
                    <p class="text-muted small">Agrega cuentas contables a esta plantilla</p>
                    <a href="{{ route('plantillas-contables.edit', $plantillasContable->id) }}" class="btn btn-sm btn-primary mt-2">
                        ➕ Agregar Cuentas
                    </a>
                </div>
                @endif
            </div>

            <!-- Información Adicional según el Tipo -->
            <div class="bg-white shadow-sm rounded-lg p-4 mt-4">
                <h5 class="mb-3">ℹ️ Información del Tipo de Plantilla</h5>
                
                @if($plantillasContable->tipo === 'cliente')
                <div class="alert alert-info mb-0">
                    <strong>Plantilla para Clientes:</strong>
                    <ul class="mb-0 mt-2">
                        <li><strong>Cuentas por Cobrar:</strong> Registra los saldos pendientes de pago de los clientes</li>
                        <li><strong>Anticipos de Cliente:</strong> Registra los pagos anticipados realizados por clientes</li>
                    </ul>
                </div>
                @elseif($plantillasContable->tipo === 'articulo')
                <div class="alert alert-success mb-0">
                    <strong>Plantilla para Artículos/Productos:</strong>
                    <ul class="mb-0 mt-2">
                        <li><strong>Ingresos por Venta:</strong> Cuenta para registrar los ingresos generados por ventas</li>
                        <li><strong>Inventario:</strong> Cuenta de activo para el valor del inventario</li>
                        <li><strong>Costo de Venta:</strong> Cuenta de gasto para registrar el costo de los productos vendidos</li>
                    </ul>
                </div>
                @else
                <div class="alert alert-warning mb-0">
                    <strong>Plantilla para Proveedores:</strong>
                    <ul class="mb-0 mt-2">
                        <li><strong>Cuentas por Pagar:</strong> Registra los saldos pendientes de pago a proveedores</li>
                        <li><strong>Anticipos a Proveedor:</strong> Registra los pagos anticipados realizados a proveedores</li>
                    </ul>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
