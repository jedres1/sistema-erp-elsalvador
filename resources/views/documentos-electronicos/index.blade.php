@extends('layouts.app')

@section('title', 'Documentos Electrónicos')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h3 mb-0">
                    <i class="fas fa-file-digital text-primary"></i>
                    Documentos Electrónicos
                </h2>
                <div class="btn-group" role="group">
                    <a href="{{ route('clientes.index') }}" class="btn btn-success">
                        <i class="fas fa-users"></i>
                        Gestión de Clientes
                    </a>
                    <a href="{{ route('documentos-electronicos.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        Nuevo Documento
                    </a>
                    <a href="{{ route('documentos-electronicos.configuracion') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-cog"></i>
                        Configuración PAC
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Estadísticas -->
    <div class="row mb-4">
        <div class="col-md-2">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="text-success mb-2">
                        <i class="fas fa-dollar-sign fa-2x"></i>
                    </div>
                    <h4 class="text-success">${{ number_format($estadisticas['total_mes'], 2) }}</h4>
                    <p class="text-muted mb-0">Total del Mes</p>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="text-primary mb-2">
                        <i class="fas fa-check-circle fa-2x"></i>
                    </div>
                    <h4 class="text-primary">{{ $estadisticas['documentos_timbrados'] }}</h4>
                    <p class="text-muted mb-0">Timbrados</p>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="text-warning mb-2">
                        <i class="fas fa-clock fa-2x"></i>
                    </div>
                    <h4 class="text-warning">{{ $estadisticas['documentos_pendientes'] }}</h4>
                    <p class="text-muted mb-0">Pendientes</p>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="text-secondary mb-2">
                        <i class="fas fa-ban fa-2x"></i>
                    </div>
                    <h4 class="text-secondary">{{ $estadisticas['documentos_cancelados'] }}</h4>
                    <p class="text-muted mb-0">Cancelados</p>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="text-danger mb-2">
                        <i class="fas fa-times-circle fa-2x"></i>
                    </div>
                    <h4 class="text-danger">{{ $estadisticas['documentos_rechazados'] }}</h4>
                    <p class="text-muted mb-0">Rechazados</p>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="text-info mb-2">
                        <i class="fas fa-percentage fa-2x"></i>
                    </div>
                    <h4 class="text-info">{{ $estadisticas['porcentaje_exitosos'] }}%</h4>
                    <p class="text-muted mb-0">Éxito</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Información del PAC -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="mb-0">
                        <i class="fas fa-shield-alt"></i>
                        Estado del PAC (Proveedor Autorizado de Certificación)
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="d-flex align-items-center">
                                <div class="text-success me-3">
                                    <i class="fas fa-link fa-2x"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">{{ $configuracion_pac['pac_nombre'] }}</h6>
                                    <small class="text-muted">{{ $configuracion_pac['estado_conexion'] }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center">
                                <h5 class="mb-0 text-primary">{{ $configuracion_pac['timbres_disponibles'] }}</h5>
                                <small class="text-muted">Timbres Disponibles</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center">
                                <h5 class="mb-0 text-info">{{ $configuracion_pac['timbres_utilizados'] }}</h5>
                                <small class="text-muted">Timbres Utilizados</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center">
                                <h6 class="mb-0">{{ $configuracion_pac['certificado_vigencia'] }}</h6>
                                <small class="text-muted">Vigencia Certificado</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtros -->
    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-label">Buscar documento</label>
                            <input type="text" class="form-control" id="buscarDocumento" 
                                   placeholder="Número, cliente, UUID...">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Tipo</label>
                            <select class="form-select" id="filtroTipo">
                                <option value="">Todos los tipos</option>
                                <option value="factura">Factura Electrónica</option>
                                <option value="nota_credito">Nota de Crédito</option>
                                <option value="carta_porte">Carta Porte</option>
                                <option value="honorarios">Recibo de Honorarios</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Estado</label>
                            <select class="form-select" id="filtroEstado">
                                <option value="">Todos los estados</option>
                                <option value="timbrado">Timbrado</option>
                                <option value="pendiente">Pendiente</option>
                                <option value="cancelado">Cancelado</option>
                                <option value="rechazado">Rechazado</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Fecha Desde</label>
                            <input type="date" class="form-control" id="fechaDesde">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Fecha Hasta</label>
                            <input type="date" class="form-control" id="fechaHasta">
                        </div>
                        <div class="col-md-1 d-flex align-items-end">
                            <button class="btn btn-outline-secondary" onclick="limpiarFiltros()">
                                <i class="fas fa-eraser"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Lista de Documentos -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-list"></i>
                        Documentos Electrónicos
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Tipo</th>
                                    <th>Número</th>
                                    <th>Cliente</th>
                                    <th>Fecha Emisión</th>
                                    <th>Monto</th>
                                    <th>Estado</th>
                                    <th>UUID</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($documentos as $documento)
                                <tr>
                                    <td>
                                        <span class="badge bg-info">
                                            @switch($documento['tipo'])
                                                @case('Factura Electrónica')
                                                    <i class="fas fa-file-invoice"></i> FE
                                                    @break
                                                @case('Nota de Crédito')
                                                    <i class="fas fa-file-minus"></i> NC
                                                    @break
                                                @case('Carta Porte')
                                                    <i class="fas fa-truck"></i> CP
                                                    @break
                                                @case('Recibo de Honorarios')
                                                    <i class="fas fa-receipt"></i> RH
                                                    @break
                                                @default
                                                    <i class="fas fa-file"></i> DOC
                                            @endswitch
                                        </span>
                                    </td>
                                    <td>
                                        <strong>{{ $documento['numero'] }}</strong>
                                    </td>
                                    <td>{{ $documento['cliente'] }}</td>
                                    <td>{{ \Carbon\Carbon::parse($documento['fecha_emision'])->format('d/m/Y') }}</td>
                                    <td>
                                        <strong class="text-success">${{ number_format($documento['monto'], 2) }}</strong>
                                    </td>
                                    <td>
                                        @switch($documento['estado'])
                                            @case('Timbrado')
                                                <span class="badge bg-success">
                                                    <i class="fas fa-check-circle"></i> Timbrado
                                                </span>
                                                @break
                                            @case('Pendiente')
                                                <span class="badge bg-warning">
                                                    <i class="fas fa-clock"></i> Pendiente
                                                </span>
                                                @break
                                            @case('Cancelado')
                                                <span class="badge bg-secondary">
                                                    <i class="fas fa-ban"></i> Cancelado
                                                </span>
                                                @break
                                            @case('Rechazado')
                                                <span class="badge bg-danger">
                                                    <i class="fas fa-times-circle"></i> Rechazado
                                                </span>
                                                @break
                                        @endswitch
                                    </td>
                                    <td>
                                        @if($documento['uuid'])
                                            <small class="text-monospace">{{ Str::limit($documento['uuid'], 20) }}</small>
                                        @else
                                            <span class="text-muted">Sin timbrar</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('documentos-electronicos.show', $documento['id']) }}" 
                                               class="btn btn-outline-primary" title="Ver detalle">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            
                                            @if($documento['estado'] === 'Pendiente')
                                                <form method="POST" action="{{ route('documentos-electronicos.timbrar', $documento['id']) }}" style="display: inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-success" title="Timbrar">
                                                        <i class="fas fa-stamp"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            
                                            @if($documento['xml_url'])
                                                <a href="{{ route('documentos-electronicos.xml', $documento['id']) }}" 
                                                   class="btn btn-outline-info" title="Descargar XML">
                                                    <i class="fas fa-file-code"></i>
                                                </a>
                                            @endif
                                            
                                            @if($documento['pdf_url'])
                                                <a href="{{ route('documentos-electronicos.pdf', $documento['id']) }}" 
                                                   class="btn btn-outline-secondary" title="Descargar PDF">
                                                    <i class="fas fa-file-pdf"></i>
                                                </a>
                                            @endif
                                            
                                            @if($documento['estado'] === 'Timbrado')
                                                <form method="POST" action="{{ route('documentos-electronicos.cancelar', $documento['id']) }}" style="display: inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-danger" title="Cancelar"
                                                            onclick="return confirm('¿Está seguro de cancelar este documento?')">
                                                        <i class="fas fa-ban"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function limpiarFiltros() {
    document.getElementById('buscarDocumento').value = '';
    document.getElementById('filtroTipo').value = '';
    document.getElementById('filtroEstado').value = '';
    document.getElementById('fechaDesde').value = '';
    document.getElementById('fechaHasta').value = '';
}

// Filtrado en tiempo real
document.addEventListener('DOMContentLoaded', function() {
    const buscar = document.getElementById('buscarDocumento');
    const filtroTipo = document.getElementById('filtroTipo');
    const filtroEstado = document.getElementById('filtroEstado');
    
    function filtrarTabla() {
        const search = buscar.value.toLowerCase();
        const tipo = filtroTipo.value.toLowerCase();
        const estado = filtroEstado.value.toLowerCase();
        
        const filas = document.querySelectorAll('tbody tr');
        
        filas.forEach(fila => {
            const texto = fila.textContent.toLowerCase();
            const estadoFila = fila.querySelector('.badge').textContent.toLowerCase();
            
            const coincideTexto = texto.includes(search);
            const coincideEstado = !estado || estadoFila.includes(estado);
            const coincideTipo = !tipo || texto.includes(tipo);
            
            fila.style.display = (coincideTexto && coincideEstado && coincideTipo) ? '' : 'none';
        });
    }
    
    buscar.addEventListener('input', filtrarTabla);
    filtroTipo.addEventListener('change', filtrarTabla);
    filtroEstado.addEventListener('change', filtrarTabla);
});
</script>
@endsection