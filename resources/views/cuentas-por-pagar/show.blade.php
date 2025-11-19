@extends('layouts.app')

@section('title', 'Detalle de Cuenta por Pagar')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="h3 mb-0">
                        <i class="fas fa-file-invoice text-danger"></i>
                        Detalle de Cuenta por Pagar
                    </h2>
                    <p class="text-muted">{{ $cuenta['numero_factura'] }}</p>
                </div>
                <div>
                    <a href="{{ route('cuentas-por-pagar.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Información de la Cuenta -->
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Información de la Cuenta</h6>
                    <span class="badge 
                        @if($cuenta['estado'] == 'Pendiente') bg-warning
                        @elseif($cuenta['estado'] == 'Pagado') bg-success
                        @elseif($cuenta['estado'] == 'Vencido') bg-danger
                        @else bg-secondary
                        @endif">
                        {{ $cuenta['estado'] }}
                    </span>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong><i class="fas fa-hashtag text-muted"></i> Número de Factura:</strong>
                            <p class="mb-0">{{ $cuenta['numero_factura'] }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong><i class="fas fa-tag text-muted"></i> Tipo de Documento:</strong>
                            <p class="mb-0">{{ $cuenta['documento_tipo'] }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong><i class="fas fa-truck text-muted"></i> Proveedor:</strong>
                            <p class="mb-0">{{ $cuenta['proveedor'] }}</p>
                            <small class="text-muted">{{ $cuenta['proveedor_documento'] }}</small>
                        </div>
                        <div class="col-md-6">
                            <strong><i class="fas fa-folder text-muted"></i> Categoría:</strong>
                            <p class="mb-0">{{ $cuenta['categoria'] }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong><i class="fas fa-calendar text-muted"></i> Fecha de Emisión:</strong>
                            <p class="mb-0">{{ \Carbon\Carbon::parse($cuenta['fecha_emision'])->format('d/m/Y') }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong><i class="fas fa-calendar-check text-muted"></i> Fecha de Vencimiento:</strong>
                            <p class="mb-0">{{ \Carbon\Carbon::parse($cuenta['fecha_vencimiento'])->format('d/m/Y') }}</p>
                            @if($cuenta['dias_vencido'] > 0)
                                <span class="badge bg-danger">Vencido hace {{ $cuenta['dias_vencido'] }} días</span>
                            @endif
                        </div>
                    </div>

                    <hr>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Monto Original:</strong>
                            <h4 class="text-primary">${{ number_format($cuenta['monto_original'], 2) }}</h4>
                        </div>
                        <div class="col-md-4">
                            <strong>Monto Pagado:</strong>
                            <h4 class="text-success">${{ number_format($cuenta['monto_pagado'], 2) }}</h4>
                        </div>
                        <div class="col-md-4">
                            <strong>Saldo Pendiente:</strong>
                            <h4 class="text-danger">${{ number_format($cuenta['saldo_pendiente'], 2) }}</h4>
                        </div>
                    </div>

                    @if($cuenta['observaciones'])
                    <div class="row">
                        <div class="col-12">
                            <strong><i class="fas fa-comment text-muted"></i> Observaciones:</strong>
                            <p class="text-muted">{{ $cuenta['observaciones'] }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Historial de Pagos -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-history"></i> Historial de Pagos
                    </h6>
                </div>
                <div class="card-body">
                    @if(count($historialPagos) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Método</th>
                                        <th>Referencia</th>
                                        <th>Monto</th>
                                        <th>Usuario</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($historialPagos as $pago)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($pago['fecha'])->format('d/m/Y') }}</td>
                                        <td>{{ $pago['metodo'] }}</td>
                                        <td>{{ $pago['referencia'] ?? '-' }}</td>
                                        <td class="text-success">${{ number_format($pago['monto'], 2) }}</td>
                                        <td>{{ $pago['usuario'] }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center text-muted py-4">
                            <i class="fas fa-info-circle fa-2x mb-2"></i>
                            <p>No hay pagos registrados para esta cuenta</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Panel de Acciones -->
        <div class="col-lg-4">
            <!-- Registrar Pago -->
            @if($cuenta['saldo_pendiente'] > 0)
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-success text-white">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-money-bill-wave"></i> Registrar Pago
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('cuentas-por-pagar.registrar-pago', $cuenta['id']) }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="monto" class="form-label">Monto a Pagar <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control @error('monto') is-invalid @enderror" 
                                       id="monto" name="monto" step="0.01" min="0.01" 
                                       max="{{ $cuenta['saldo_pendiente'] }}" 
                                       value="{{ old('monto', $cuenta['saldo_pendiente']) }}" required>
                                @error('monto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="text-muted">Saldo pendiente: ${{ number_format($cuenta['saldo_pendiente'], 2) }}</small>
                        </div>

                        <div class="mb-3">
                            <label for="fecha_pago" class="form-label">Fecha de Pago <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('fecha_pago') is-invalid @enderror" 
                                   id="fecha_pago" name="fecha_pago" value="{{ old('fecha_pago', date('Y-m-d')) }}" required>
                            @error('fecha_pago')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="metodo_pago" class="form-label">Método de Pago <span class="text-danger">*</span></label>
                            <select class="form-select @error('metodo_pago') is-invalid @enderror" 
                                    id="metodo_pago" name="metodo_pago" required>
                                <option value="">Seleccionar...</option>
                                <option value="Efectivo" {{ old('metodo_pago') == 'Efectivo' ? 'selected' : '' }}>Efectivo</option>
                                <option value="Transferencia" {{ old('metodo_pago') == 'Transferencia' ? 'selected' : '' }}>Transferencia Bancaria</option>
                                <option value="Cheque" {{ old('metodo_pago') == 'Cheque' ? 'selected' : '' }}>Cheque</option>
                                <option value="Tarjeta" {{ old('metodo_pago') == 'Tarjeta' ? 'selected' : '' }}>Tarjeta</option>
                            </select>
                            @error('metodo_pago')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="referencia" class="form-label">Referencia / No. Cheque</label>
                            <input type="text" class="form-control @error('referencia') is-invalid @enderror" 
                                   id="referencia" name="referencia" value="{{ old('referencia') }}" 
                                   placeholder="Número de referencia o cheque">
                            @error('referencia')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="observaciones" class="form-label">Observaciones</label>
                            <textarea class="form-control @error('observaciones') is-invalid @enderror" 
                                      id="observaciones" name="observaciones" rows="2" 
                                      placeholder="Notas adicionales sobre el pago">{{ old('observaciones') }}</textarea>
                            @error('observaciones')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success w-100">
                            <i class="fas fa-check"></i> Registrar Pago
                        </button>
                    </form>
                </div>
            </div>
            @endif

            <!-- Programar Pago -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-info text-white">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-calendar-alt"></i> Programar Pago
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('cuentas-por-pagar.programar-pago', $cuenta['id']) }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="fecha_programada" class="form-label">Fecha Programada</label>
                            <input type="date" class="form-control" id="fecha_programada" name="fecha_programada" required>
                        </div>

                        <div class="mb-3">
                            <label for="monto_programado" class="form-label">Monto</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="monto_programado" 
                                       name="monto_programado" step="0.01" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-info w-100">
                            <i class="fas fa-clock"></i> Programar
                        </button>
                    </form>
                </div>
            </div>

            <!-- Acciones Adicionales -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-cog"></i> Acciones
                    </h6>
                </div>
                <div class="card-body">
                    <a href="#" class="btn btn-outline-primary w-100 mb-2">
                        <i class="fas fa-print"></i> Imprimir Detalle
                    </a>
                    <a href="#" class="btn btn-outline-success w-100 mb-2">
                        <i class="fas fa-file-pdf"></i> Exportar PDF
                    </a>
                    <a href="#" class="btn btn-outline-info w-100">
                        <i class="fas fa-envelope"></i> Enviar por Email
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
