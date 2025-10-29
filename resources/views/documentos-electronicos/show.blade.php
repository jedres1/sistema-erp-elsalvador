@extends('layouts.app')

@section('title', 'Detalle Documento Electrónico')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('documentos-electronicos.index') }}">Documentos Electrónicos</a></li>
                    <li class="breadcrumb-item active">{{ $documento['numero'] }}</li>
                </ol>
            </nav>
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h3 mb-0">
                    <i class="fas fa-file-digital text-primary"></i>
                    {{ $documento['tipo'] }} - {{ $documento['numero'] }}
                </h2>
                <div class="btn-group" role="group">
                    <a href="{{ route('documentos-electronicos.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i>
                        Volver
                    </a>
                    @if($documento['xml_url'])
                        <a href="{{ route('documentos-electronicos.xml', $documento['id']) }}" class="btn btn-outline-info">
                            <i class="fas fa-file-code"></i>
                            Descargar XML
                        </a>
                    @endif
                    @if($documento['pdf_url'])
                        <a href="{{ route('documentos-electronicos.pdf', $documento['id']) }}" class="btn btn-outline-danger">
                            <i class="fas fa-file-pdf"></i>
                            Descargar PDF
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Información Principal -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle"></i>
                        Información del Documento
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Tipo de Documento:</label>
                                <div class="d-flex align-items-center">
                                    @switch($documento['tipo'])
                                        @case('Factura Electrónica')
                                            <span class="badge bg-primary me-2">
                                                <i class="fas fa-file-invoice"></i> FE
                                            </span>
                                            @break
                                        @case('Nota de Crédito')
                                            <span class="badge bg-warning me-2">
                                                <i class="fas fa-file-minus"></i> NC
                                            </span>
                                            @break
                                        @case('Carta Porte')
                                            <span class="badge bg-info me-2">
                                                <i class="fas fa-truck"></i> CP
                                            </span>
                                            @break
                                        @case('Recibo de Honorarios')
                                            <span class="badge bg-secondary me-2">
                                                <i class="fas fa-receipt"></i> RH
                                            </span>
                                            @break
                                    @endswitch
                                    {{ $documento['tipo'] }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Estado:</label>
                                <div>
                                    @switch($documento['estado'])
                                        @case('Timbrado')
                                            <span class="badge bg-success fs-6">
                                                <i class="fas fa-check-circle"></i> Timbrado
                                            </span>
                                            @break
                                        @case('Pendiente')
                                            <span class="badge bg-warning fs-6">
                                                <i class="fas fa-clock"></i> Pendiente
                                            </span>
                                            @break
                                        @case('Cancelado')
                                            <span class="badge bg-secondary fs-6">
                                                <i class="fas fa-ban"></i> Cancelado
                                            </span>
                                            @break
                                        @case('Rechazado')
                                            <span class="badge bg-danger fs-6">
                                                <i class="fas fa-times-circle"></i> Rechazado
                                            </span>
                                            @break
                                    @endswitch
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Serie:</label>
                                <div>{{ $documento['serie'] }}</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Folio:</label>
                                <div>{{ $documento['folio'] }}</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Fecha Emisión:</label>
                                <div>{{ \Carbon\Carbon::parse($documento['fecha_emision'])->format('d/m/Y') }}</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Fecha Timbrado:</label>
                                <div>
                                    @if($documento['fecha_timbrado'])
                                        {{ \Carbon\Carbon::parse($documento['fecha_timbrado'])->format('d/m/Y H:i:s') }}
                                    @else
                                        <span class="text-muted">Sin timbrar</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Información del Cliente -->
            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-user"></i>
                        Información del Cliente/Receptor
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nombre/Razón Social:</label>
                                <div>{{ $documento['cliente']['nombre'] }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">RFC:</label>
                                <div class="text-monospace">{{ $documento['cliente']['rfc'] }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Dirección:</label>
                                <div>{{ $documento['cliente']['direccion'] }}</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Email:</label>
                                <div>{{ $documento['cliente']['email'] }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Conceptos del Documento -->
            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-list"></i>
                        Conceptos del Documento
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>Cantidad</th>
                                    <th>Descripción</th>
                                    <th>Precio Unitario</th>
                                    <th>Importe</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($documento['conceptos'] as $concepto)
                                <tr>
                                    <td class="text-center">{{ number_format($concepto['cantidad'], 2) }}</td>
                                    <td>{{ $concepto['descripcion'] }}</td>
                                    <td class="text-end">${{ number_format($concepto['precio_unitario'], 2) }}</td>
                                    <td class="text-end">${{ number_format($concepto['importe'], 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Totales -->
                    <div class="row mt-3">
                        <div class="col-md-8"></div>
                        <div class="col-md-4">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Subtotal:</span>
                                        <span>${{ number_format($documento['subtotal'], 2) }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>IVA (13%):</span>
                                        <span>${{ number_format($documento['iva'], 2) }}</span>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-between fw-bold fs-5">
                                        <span>Total:</span>
                                        <span class="text-primary">${{ number_format($documento['total'], 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Panel Lateral -->
        <div class="col-lg-4">
            <!-- Información Fiscal -->
            @if($documento['estado'] === 'Timbrado')
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-shield-alt"></i>
                        Información Fiscal SAT
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">UUID:</label>
                        <div class="text-monospace small">{{ $documento['uuid'] }}</div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">PAC Certificador:</label>
                        <div>{{ $documento['pac'] }}</div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Cadena Original:</label>
                        <div class="text-monospace small text-wrap">{{ $documento['cadena_original'] }}</div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Sello Digital:</label>
                        <div class="text-monospace small text-wrap">{{ Str::limit($documento['sello_digital'], 50) }}...</div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Sello SAT:</label>
                        <div class="text-monospace small text-wrap">{{ Str::limit($documento['sello_sat'], 50) }}...</div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Acciones -->
            <div class="card mt-3">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-tools"></i>
                        Acciones Disponibles
                    </h6>
                </div>
                <div class="card-body">
                    @if($documento['estado'] === 'Pendiente')
                        <form method="POST" action="{{ route('documentos-electronicos.timbrar', $documento['id']) }}" class="mb-2">
                            @csrf
                            <button type="submit" class="btn btn-success w-100">
                                <i class="fas fa-stamp"></i>
                                Timbrar Documento
                            </button>
                        </form>
                        
                        <div class="alert alert-info small">
                            <i class="fas fa-info-circle"></i>
                            Este documento está pendiente de timbrado. Una vez timbrado, se generará el UUID y los sellos digitales correspondientes.
                        </div>
                    @endif

                    @if($documento['estado'] === 'Timbrado')
                        <form method="POST" action="{{ route('documentos-electronicos.cancelar', $documento['id']) }}" class="mb-2">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger w-100" 
                                    onclick="return confirm('¿Está seguro de cancelar este documento? Esta acción no se puede deshacer.')">
                                <i class="fas fa-ban"></i>
                                Cancelar Documento
                            </button>
                        </form>
                        
                        <div class="alert alert-success small">
                            <i class="fas fa-check-circle"></i>
                            Este documento ha sido timbrado exitosamente y es válido ante el SAT.
                        </div>
                    @endif

                    @if($documento['estado'] === 'Cancelado')
                        <div class="alert alert-secondary small">
                            <i class="fas fa-ban"></i>
                            Este documento ha sido cancelado y ya no es válido para efectos fiscales.
                        </div>
                    @endif

                    @if($documento['estado'] === 'Rechazado')
                        <div class="alert alert-danger small">
                            <i class="fas fa-times-circle"></i>
                            Este documento fue rechazado por el PAC. Revise los datos y genere uno nuevo.
                        </div>
                        
                        <a href="{{ route('documentos-electronicos.create') }}" class="btn btn-primary w-100">
                            <i class="fas fa-plus"></i>
                            Generar Nuevo Documento
                        </a>
                    @endif
                </div>
            </div>

            <!-- Historial de Estados -->
            <div class="card mt-3">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-history"></i>
                        Historial de Estados
                    </h6>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-marker bg-primary"></div>
                            <div class="timeline-content">
                                <h6 class="timeline-title">Documento Creado</h6>
                                <p class="timeline-text small text-muted">
                                    {{ \Carbon\Carbon::parse($documento['fecha_emision'])->format('d/m/Y H:i:s') }}
                                </p>
                            </div>
                        </div>
                        
                        @if($documento['fecha_timbrado'])
                        <div class="timeline-item">
                            <div class="timeline-marker bg-success"></div>
                            <div class="timeline-content">
                                <h6 class="timeline-title">Documento Timbrado</h6>
                                <p class="timeline-text small text-muted">
                                    {{ \Carbon\Carbon::parse($documento['fecha_timbrado'])->format('d/m/Y H:i:s') }}
                                </p>
                            </div>
                        </div>
                        @endif
                        
                        @if($documento['estado'] === 'Cancelado')
                        <div class="timeline-item">
                            <div class="timeline-marker bg-secondary"></div>
                            <div class="timeline-content">
                                <h6 class="timeline-title">Documento Cancelado</h6>
                                <p class="timeline-text small text-muted">
                                    Fecha de cancelación
                                </p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #dee2e6;
}

.timeline-item {
    position: relative;
    margin-bottom: 20px;
}

.timeline-marker {
    position: absolute;
    left: -23px;
    top: 5px;
    width: 16px;
    height: 16px;
    border-radius: 50%;
    border: 2px solid white;
}

.timeline-content {
    background: #f8f9fa;
    padding: 10px;
    border-radius: 5px;
    border-left: 3px solid #007bff;
}

.timeline-title {
    margin: 0 0 5px 0;
    font-size: 14px;
}

.timeline-text {
    margin: 0;
}
</style>
@endsection