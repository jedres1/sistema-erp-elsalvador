@extends('layouts.app')

@section('title', 'Libro Mayor')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4 text-primary">
        <i class="fas fa-book-open"></i> Libro Mayor
    </h1>
    
    <!-- Controles superiores -->
    <div class="row mb-3">
        <div class="col-md-4">
            <div class="d-flex gap-2">
                <button class="btn btn-success">
                    <i class="fas fa-file-export"></i> Exportar
                </button>
                <button class="btn btn-info">
                    <i class="fas fa-print"></i> Imprimir
                </button>
            </div>
        </div>
        
        <!-- Selector de cuenta -->
        <div class="col-md-4">
            <select class="form-control" id="accountSelect" onchange="loadAccountLedger()">
                <option value="">Seleccionar cuenta para ver mayor...</option>
                <!-- Las cuentas se cargarían dinámicamente -->
            </select>
        </div>
        
        <!-- Filtros de fecha -->
        <div class="col-md-4">
            <div class="d-flex gap-2">
                <input type="date" class="form-control" id="dateFrom" placeholder="Desde">
                <input type="date" class="form-control" id="dateTo" placeholder="Hasta">
                <button class="btn btn-outline-primary" onclick="filterByDate()">
                    <i class="fas fa-filter"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Resumen de cuentas -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body text-center">
                    <h6>Total Cuentas</h6>
                    <h3 id="totalAccounts">0</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body text-center">
                    <h6>Cuentas con Saldo</h6>
                    <h3 id="accountsWithBalance">0</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body text-center">
                    <h6>Total Movimientos</h6>
                    <h3 id="totalMovements">0</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body text-center">
                    <h6>Período</h6>
                    <h6 id="currentPeriod">Todo el tiempo</h6>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenido principal -->
    <div class="row">
        <!-- Lista de cuentas -->
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-header bg-secondary text-white">
                    <h6 class="mb-0">
                        <i class="fas fa-list"></i> Cuentas del Mayor
                    </h6>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush" id="accountsList">
                        <div class="list-group-item text-center py-4">
                            <i class="fas fa-search fa-3x text-muted mb-3"></i>
                            <h6 class="text-muted">No hay cuentas con movimientos</h6>
                            <p class="text-muted small">
                                Las cuentas aparecerán aquí una vez que tengan movimientos registrados.
                            </p>
                        </div>
                        
                        <!-- Ejemplo de como se verían las cuentas:
                        <a href="#" class="list-group-item list-group-item-action" onclick="selectAccount('1000000000000')">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">1000000000000 - Caja</h6>
                                <small class="text-success">$5,000.00</small>
                            </div>
                            <p class="mb-1 small text-muted">Balance: Deudor</p>
                            <small>3 movimientos</small>
                        </a>
                        -->
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Detalle del mayor de la cuenta seleccionada -->
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-dark text-white">
                    <h6 class="mb-0">
                        <i class="fas fa-calculator"></i> 
                        <span id="selectedAccountTitle">Mayor General - Seleccionar una cuenta</span>
                    </h6>
                </div>
                <div class="card-body" id="ledgerContent">
                    <div class="text-center py-5">
                        <i class="fas fa-mouse-pointer fa-4x text-muted mb-3"></i>
                        <h5 class="text-muted">Selecciona una cuenta</h5>
                        <p class="text-muted">
                            Elige una cuenta de la lista de la izquierda para ver su libro mayor detallado.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function loadAccountLedger() {
    const accountSelect = document.getElementById('accountSelect');
    const selectedAccount = accountSelect.value;
    
    if (!selectedAccount) return;
    
    // Actualizar título
    const accountText = accountSelect.options[accountSelect.selectedIndex].text;
    document.getElementById('selectedAccountTitle').textContent = `Mayor de: ${accountText}`;
    
    // Cargar el detalle del mayor (simulado)
    loadLedgerDetail(selectedAccount);
}

function selectAccount(accountCode) {
    // Marcar como seleccionada en la lista
    document.querySelectorAll('#accountsList .list-group-item').forEach(item => {
        item.classList.remove('active');
    });
    event.target.closest('.list-group-item').classList.add('active');
    
    // Cargar detalle
    loadLedgerDetail(accountCode);
}

function loadLedgerDetail(accountCode) {
    const ledgerContent = document.getElementById('ledgerContent');
    
    // Simulación de carga del mayor de una cuenta
    ledgerContent.innerHTML = `
        <div class="mb-3">
            <div class="row">
                <div class="col-md-6">
                    <h6>Cuenta: ${accountCode} - Caja</h6>
                    <p class="text-muted mb-0">Naturaleza: Deudora</p>
                </div>
                <div class="col-md-6 text-end">
                    <h6>Saldo Actual: <span class="text-success">$5,000.00</span></h6>
                    <p class="text-muted mb-0">Último movimiento: 15/10/2024</p>
                </div>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table table-sm table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Fecha</th>
                        <th>No. Partida</th>
                        <th>Concepto</th>
                        <th class="text-end">Debe</th>
                        <th class="text-end">Haber</th>
                        <th class="text-end">Saldo</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>01/10/2024</td>
                        <td>PT-001</td>
                        <td>Apertura de ejercicio</td>
                        <td class="text-end">$10,000.00</td>
                        <td class="text-end">-</td>
                        <td class="text-end text-success">$10,000.00</td>
                    </tr>
                    <tr>
                        <td>05/10/2024</td>
                        <td>PT-002</td>
                        <td>Pago de servicios</td>
                        <td class="text-end">-</td>
                        <td class="text-end">$3,000.00</td>
                        <td class="text-end text-success">$7,000.00</td>
                    </tr>
                    <tr>
                        <td>10/10/2024</td>
                        <td>PT-003</td>
                        <td>Venta de mercancía</td>
                        <td class="text-end">$2,000.00</td>
                        <td class="text-end">-</td>
                        <td class="text-end text-success">$9,000.00</td>
                    </tr>
                    <tr>
                        <td>15/10/2024</td>
                        <td>PT-004</td>
                        <td>Pago de nómina</td>
                        <td class="text-end">-</td>
                        <td class="text-end">$4,000.00</td>
                        <td class="text-end text-success">$5,000.00</td>
                    </tr>
                </tbody>
                <tfoot class="table-secondary">
                    <tr class="fw-bold">
                        <td colspan="3">TOTALES:</td>
                        <td class="text-end">$12,000.00</td>
                        <td class="text-end">$7,000.00</td>
                        <td class="text-end text-success">$5,000.00</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        
        <div class="mt-3">
            <div class="row">
                <div class="col-md-6">
                    <small class="text-muted">
                        <i class="fas fa-info-circle"></i> 
                        Total de movimientos: 4
                    </small>
                </div>
                <div class="col-md-6 text-end">
                    <small class="text-muted">
                        Saldo anterior: $0.00
                    </small>
                </div>
            </div>
        </div>
    `;
}

function filterByDate() {
    const dateFrom = document.getElementById('dateFrom').value;
    const dateTo = document.getElementById('dateTo').value;
    
    if (!dateFrom || !dateTo) {
        alert('Por favor selecciona ambas fechas para filtrar');
        return;
    }
    
    if (dateFrom > dateTo) {
        alert('La fecha inicial no puede ser mayor que la fecha final');
        return;
    }
    
    // Actualizar período mostrado
    document.getElementById('currentPeriod').textContent = `${dateFrom} a ${dateTo}`;
    
    console.log('Filtrando libro mayor:', { dateFrom, dateTo });
    alert('Funcionalidad en desarrollo: Filtrar por fechas');
}

// Simular carga inicial de cuentas con saldo
document.addEventListener('DOMContentLoaded', function() {
    // Simulación de cuentas con movimientos
    const sampleAccounts = [
        { code: '1000000000000', name: 'Caja', balance: 5000, movements: 4, nature: 'Deudora' },
        { code: '1100000000000', name: 'Bancos', balance: 25000, movements: 8, nature: 'Deudora' },
        { code: '2000000000000', name: 'Proveedores', balance: -15000, movements: 5, nature: 'Acreedora' },
        { code: '3000000000000', name: 'Capital Social', balance: -50000, movements: 1, nature: 'Acreedora' }
    ];
    
    // Actualizar contadores
    document.getElementById('totalAccounts').textContent = sampleAccounts.length;
    document.getElementById('accountsWithBalance').textContent = sampleAccounts.filter(acc => acc.balance !== 0).length;
    document.getElementById('totalMovements').textContent = sampleAccounts.reduce((sum, acc) => sum + acc.movements, 0);
    
    // Llenar lista de cuentas
    const accountsList = document.getElementById('accountsList');
    accountsList.innerHTML = '';
    
    sampleAccounts.forEach(account => {
        const balanceClass = account.balance >= 0 ? 'text-success' : 'text-danger';
        const balanceText = account.balance >= 0 ? `$${account.balance.toLocaleString()}.00` : `($${Math.abs(account.balance).toLocaleString()}.00)`;
        
        const item = document.createElement('a');
        item.href = '#';
        item.className = 'list-group-item list-group-item-action';
        item.onclick = () => selectAccount(account.code);
        item.innerHTML = `
            <div class="d-flex w-100 justify-content-between">
                <h6 class="mb-1">${account.code} - ${account.name}</h6>
                <small class="${balanceClass}">${balanceText}</small>
            </div>
            <p class="mb-1 small text-muted">Naturaleza: ${account.nature}</p>
            <small>${account.movements} movimiento${account.movements !== 1 ? 's' : ''}</small>
        `;
        accountsList.appendChild(item);
    });
    
    // Llenar selector de cuentas
    const accountSelect = document.getElementById('accountSelect');
    sampleAccounts.forEach(account => {
        const option = document.createElement('option');
        option.value = account.code;
        option.textContent = `${account.code} - ${account.name}`;
        accountSelect.appendChild(option);
    });
});
</script>

<style>
.list-group-item.active {
    background-color: #0d6efd;
    border-color: #0d6efd;
}

@media print {
    .col-md-4:first-child {
        display: none !important;
    }
    
    .col-md-8 {
        width: 100% !important;
        max-width: 100% !important;
    }
    
    .btn, .card-header {
        display: none !important;
    }
}
</style>
@endsection