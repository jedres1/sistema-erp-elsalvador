@extends('layouts.app')

@section('title', 'Control Bancario')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h3 mb-0">
                    <i class="fas fa-university text-primary"></i>
                    Control Bancario
                </h2>
                <div>
                    <a href="{{ route('bancos.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        Nueva Cuenta
                    </a>
                    <button class="btn btn-success" onclick="mostrarModalDeposito()">
                        <i class="fas fa-arrow-down"></i>
                        Depósito
                    </button>
                    <button class="btn btn-warning" onclick="mostrarModalRetiro()">
                        <i class="fas fa-arrow-up"></i>
                        Retiro
                    </button>
                    <button class="btn btn-info" onclick="mostrarModalTransferencia()">
                        <i class="fas fa-exchange-alt"></i>
                        Transferencia
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Estadísticas -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="text-success mb-2">
                        <i class="fas fa-dollar-sign fa-2x"></i>
                    </div>
                    <h4 class="text-success">${{ number_format($estadisticas['total_efectivo'], 2) }}</h4>
                    <p class="text-muted mb-0">Total en Bancos</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="text-primary mb-2">
                        <i class="fas fa-university fa-2x"></i>
                    </div>
                    <h4 class="text-primary">{{ $estadisticas['cuentas_activas'] }}</h4>
                    <p class="text-muted mb-0">Cuentas Activas</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="text-info mb-2">
                        <i class="fas fa-arrow-down fa-2x"></i>
                    </div>
                    <h4 class="text-info">${{ number_format($estadisticas['ingresos_mes'], 2) }}</h4>
                    <p class="text-muted mb-0">Ingresos del Mes</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="text-warning mb-2">
                        <i class="fas fa-arrow-up fa-2x"></i>
                    </div>
                    <h4 class="text-warning">${{ number_format($estadisticas['egresos_mes'], 2) }}</h4>
                    <p class="text-muted mb-0">Egresos del Mes</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Cuentas Bancarias -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-credit-card"></i>
                        Cuentas Bancarias
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($cuentas_bancarias as $cuenta)
                        <div class="col-md-4 mb-3">
                            <div class="card border-left-primary">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                {{ $cuenta['banco'] }}
                                            </div>
                                            <div class="h6 mb-0 font-weight-bold text-gray-800">
                                                {{ $cuenta['numero_cuenta'] }}
                                            </div>
                                            <div class="text-xs text-muted">
                                                {{ ucfirst($cuenta['tipo_cuenta']) }}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-university fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="text-xs text-muted">Saldo Actual</div>
                                            <div class="h5 text-success">${{ number_format($cuenta['saldo_actual'], 2) }}</div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-xs text-muted">Estado</div>
                                            <span class="badge bg-{{ $cuenta['estado'] === 'activa' ? 'success' : 'secondary' }}">
                                                {{ ucfirst($cuenta['estado']) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <a href="{{ route('bancos.show', $cuenta['id']) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i> Ver Detalle
                                        </a>
                                        <a href="{{ route('bancos.conciliar', $cuenta['id']) }}" class="btn btn-sm btn-outline-info">
                                            <i class="fas fa-check-double"></i> Conciliar
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Movimientos Recientes -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-list"></i>
                        Movimientos Recientes
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Fecha</th>
                                    <th>Cuenta</th>
                                    <th>Tipo</th>
                                    <th>Concepto</th>
                                    <th>Monto</th>
                                    <th>Saldo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($movimientos_recientes as $movimiento)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($movimiento['fecha'])->format('d/m/Y') }}</td>
                                    <td>{{ $movimiento['cuenta'] }}</td>
                                    <td>
                                        @if($movimiento['tipo'] === 'deposito')
                                            <span class="badge bg-success">
                                                <i class="fas fa-arrow-down"></i> Depósito
                                            </span>
                                        @elseif($movimiento['tipo'] === 'retiro')
                                            <span class="badge bg-danger">
                                                <i class="fas fa-arrow-up"></i> Retiro
                                            </span>
                                        @else
                                            <span class="badge bg-info">
                                                <i class="fas fa-exchange-alt"></i> Transferencia
                                            </span>
                                        @endif
                                    </td>
                                    <td>{{ $movimiento['concepto'] }}</td>
                                    <td>
                                        <span class="text-{{ $movimiento['monto'] > 0 ? 'success' : 'danger' }}">
                                            ${{ number_format(abs($movimiento['monto']), 2) }}
                                        </span>
                                    </td>
                                    <td>
                                        <strong>${{ number_format($movimiento['saldo'], 2) }}</strong>
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

<!-- Modal Depósito -->
<div class="modal fade" id="depositoModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registrar Depósito</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('bancos.deposito') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Cuenta Bancaria</label>
                        <select class="form-select" name="cuenta_id" required>
                            <option value="">Seleccionar cuenta...</option>
                            @foreach($cuentas_bancarias as $cuenta)
                            <option value="{{ $cuenta['id'] }}">{{ $cuenta['banco'] }} - {{ $cuenta['numero_cuenta'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Monto</label>
                        <input type="number" class="form-control" name="monto" step="0.01" min="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Concepto</label>
                        <input type="text" class="form-control" name="concepto" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Referencia</label>
                        <input type="text" class="form-control" name="referencia">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Registrar Depósito</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Retiro -->
<div class="modal fade" id="retiroModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registrar Retiro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('bancos.retiro') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Cuenta Bancaria</label>
                        <select class="form-select" name="cuenta_id" required>
                            <option value="">Seleccionar cuenta...</option>
                            @foreach($cuentas_bancarias as $cuenta)
                            <option value="{{ $cuenta['id'] }}">{{ $cuenta['banco'] }} - {{ $cuenta['numero_cuenta'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Monto</label>
                        <input type="number" class="form-control" name="monto" step="0.01" min="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Concepto</label>
                        <input type="text" class="form-control" name="concepto" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Referencia</label>
                        <input type="text" class="form-control" name="referencia">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-warning">Registrar Retiro</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Transferencia -->
<div class="modal fade" id="transferenciaModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registrar Transferencia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('bancos.transferencia') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Cuenta Origen</label>
                        <select class="form-select" name="cuenta_origen_id" required>
                            <option value="">Seleccionar cuenta origen...</option>
                            @foreach($cuentas_bancarias as $cuenta)
                            <option value="{{ $cuenta['id'] }}">{{ $cuenta['banco'] }} - {{ $cuenta['numero_cuenta'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cuenta Destino</label>
                        <select class="form-select" name="cuenta_destino_id" required>
                            <option value="">Seleccionar cuenta destino...</option>
                            @foreach($cuentas_bancarias as $cuenta)
                            <option value="{{ $cuenta['id'] }}">{{ $cuenta['banco'] }} - {{ $cuenta['numero_cuenta'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Monto</label>
                        <input type="number" class="form-control" name="monto" step="0.01" min="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Concepto</label>
                        <input type="text" class="form-control" name="concepto" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-info">Registrar Transferencia</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function mostrarModalDeposito() {
    const modal = new bootstrap.Modal(document.getElementById('depositoModal'));
    modal.show();
}

function mostrarModalRetiro() {
    const modal = new bootstrap.Modal(document.getElementById('retiroModal'));
    modal.show();
}

function mostrarModalTransferencia() {
    const modal = new bootstrap.Modal(document.getElementById('transferenciaModal'));
    modal.show();
}
</script>
@endsection