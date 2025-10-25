@extends('layouts.app')

@section('title', 'Estado de Resultados')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h3 mb-0">
                    <i class="fas fa-chart-line text-primary"></i>
                    Estado de Resultados
                </h2>
                <span class="badge bg-info fs-6">
                    <i class="fas fa-calendar-alt"></i>
                    {{ date('d/m/Y') }}
                </span>
            </div>
        </div>
    </div>

    <!-- Estado de Resultados -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-gradient" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-line"></i>
                        Estado de Resultados
                    </h5>
                </div>
                <div class="card-body">
                    <!-- Ingresos -->
                    <div class="mb-4">
                        <h6 class="text-success fw-bold mb-3">
                            <i class="fas fa-arrow-up"></i>
                            INGRESOS
                        </h6>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <tbody>
                                    @forelse($ingresos as $cuenta)
                                    <tr>
                                        <td class="ps-3">{{ $cuenta['code'] }}</td>
                                        <td>{{ $cuenta['name'] }}</td>
                                        <td class="text-end text-success fw-bold">
                                            ${{ number_format($cuenta['balance'], 2) }}
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted py-3">
                                            <i class="fas fa-info-circle"></i>
                                            No hay cuentas de ingresos con movimientos
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="border-top pt-2">
                            <div class="row">
                                <div class="col-8">
                                    <strong>TOTAL INGRESOS</strong>
                                </div>
                                <div class="col-4 text-end">
                                    <strong class="text-success">
                                        ${{ number_format($totalIngresos, 2) }}
                                    </strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Gastos -->
                    <div class="mb-4">
                        <h6 class="text-danger fw-bold mb-3">
                            <i class="fas fa-arrow-down"></i>
                            GASTOS
                        </h6>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <tbody>
                                    @forelse($gastos as $cuenta)
                                    <tr>
                                        <td class="ps-3">{{ $cuenta['code'] }}</td>
                                        <td>{{ $cuenta['name'] }}</td>
                                        <td class="text-end text-danger fw-bold">
                                            ${{ number_format($cuenta['balance'], 2) }}
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted py-3">
                                            <i class="fas fa-info-circle"></i>
                                            No hay cuentas de gastos con movimientos
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="border-top pt-2">
                            <div class="row">
                                <div class="col-8">
                                    <strong>TOTAL GASTOS</strong>
                                </div>
                                <div class="col-4 text-end">
                                    <strong class="text-danger">
                                        (${{ number_format($totalGastos, 2) }})
                                    </strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Resultado Final -->
                    <div class="border-top pt-3">
                        <div class="row">
                            <div class="col-8">
                                <h5 class="mb-0 fw-bold">
                                    @if($utilidadNeta >= 0)
                                        <i class="fas fa-trophy text-warning"></i>
                                        UTILIDAD NETA
                                    @else
                                        <i class="fas fa-exclamation-triangle text-warning"></i>
                                        PÉRDIDA NETA
                                    @endif
                                </h5>
                            </div>
                            <div class="col-4 text-end">
                                <h5 class="mb-0 fw-bold {{ $utilidadNeta >= 0 ? 'text-success' : 'text-danger' }}">
                                    @if($utilidadNeta >= 0)
                                        ${{ number_format($utilidadNeta, 2) }}
                                    @else
                                        (${{ number_format(abs($utilidadNeta), 2) }})
                                    @endif
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Resumen -->
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card border-success">
                <div class="card-body text-center">
                    <h6 class="card-title text-success">
                        <i class="fas fa-arrow-up"></i>
                        Total Ingresos
                    </h6>
                    <h4 class="text-success mb-0">
                        ${{ number_format($totalIngresos, 2) }}
                    </h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-danger">
                <div class="card-body text-center">
                    <h6 class="card-title text-danger">
                        <i class="fas fa-arrow-down"></i>
                        Total Gastos
                    </h6>
                    <h4 class="text-danger mb-0">
                        ${{ number_format($totalGastos, 2) }}
                    </h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-{{ $utilidadNeta >= 0 ? 'success' : 'danger' }}">
                <div class="card-body text-center">
                    <h6 class="card-title text-{{ $utilidadNeta >= 0 ? 'success' : 'danger' }}">
                        <i class="fas fa-{{ $utilidadNeta >= 0 ? 'trophy' : 'exclamation-triangle' }}"></i>
                        {{ $utilidadNeta >= 0 ? 'Utilidad' : 'Pérdida' }} Neta
                    </h6>
                    <h4 class="text-{{ $utilidadNeta >= 0 ? 'success' : 'danger' }} mb-0">
                        @if($utilidadNeta >= 0)
                            ${{ number_format($utilidadNeta, 2) }}
                        @else
                            (${{ number_format(abs($utilidadNeta), 2) }})
                        @endif
                    </h4>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
}

.card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.card-header {
    border-radius: 15px 15px 0 0 !important;
    border-bottom: none;
}

.table td {
    border: none;
    padding: 8px 12px;
}

.table tr:hover {
    background-color: rgba(0, 123, 255, 0.05);
}

.border-top {
    border-top: 2px solid #dee2e6 !important;
}
</style>
@endsection