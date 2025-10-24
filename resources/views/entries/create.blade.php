@extends('layouts.app')

@section('title', 'Nueva Partida de Diario')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-plus-circle me-2"></i>Nueva Partida de Diario</h2>
    <a href="{{ route('journal.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i>Volver
    </a>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('entries.store') }}" method="POST" id="journalForm">
    @csrf
    
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Información General</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="date_register" class="form-label">Fecha <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('date_register') is-invalid @enderror" 
                               id="date_register" name="date_register" 
                               value="{{ old('date_register', date('Y-m-d')) }}" required>
                        @error('date_register')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="description" class="form-label">Descripción <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="2" 
                                  placeholder="Descripción del asiento contable" required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-list me-2"></i>Detalle de la Partida</h5>
            <button type="button" class="btn btn-sm btn-primary" onclick="addLine()">
                <i class="fas fa-plus me-1"></i>Agregar Línea
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="linesTable">
                    <thead class="table-dark">
                        <tr>
                            <th width="40%">Cuenta Contable</th>
                            <th width="20%">Débito</th>
                            <th width="20%">Crédito</th>
                            <th width="15%">Balance</th>
                            <th width="5%">Acción</th>
                        </tr>
                    </thead>
                    <tbody id="linesTableBody">
                        <!-- Las líneas se agregan dinámicamente -->
                    </tbody>
                    <tfoot>
                        <tr class="table-info">
                            <th>TOTALES:</th>
                            <th class="text-end" id="totalDebits">0.00</th>
                            <th class="text-end" id="totalCredits">0.00</th>
                            <th class="text-end" id="totalBalance">0.00</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
            <div id="balanceAlert" class="alert alert-warning d-none mt-3">
                <i class="fas fa-exclamation-triangle me-2"></i>
                Los débitos y créditos deben estar balanceados para guardar la partida.
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end mt-4">
        <a href="{{ route('journal.index') }}" class="btn btn-secondary me-2">
            <i class="fas fa-times me-1"></i>Cancelar
        </a>
        <button type="submit" class="btn btn-primary" id="submitBtn" disabled>
            <i class="fas fa-save me-1"></i>Guardar Partida
        </button>
    </div>
</form>

<!-- Modal para seleccionar cuenta -->
<div class="modal fade" id="accountModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Seleccionar Cuenta Contable</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <input type="text" class="form-control" id="accountSearch" 
                           placeholder="Buscar por código o descripción...">
                </div>
                <div class="table-responsive">
                    <table class="table table-hover" id="accountsTable">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Descripción</th>
                                <th>Tipo</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody id="accountsTableBody">
                            <!-- Se carga dinámicamente -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
let lineCounter = 0;
let currentLineIndex = null;
let accounts = @json($accounts);

// Agregar líneas iniciales
document.addEventListener('DOMContentLoaded', function() {
    addLine();
    addLine();
    calculateTotals();
});

function addLine() {
    lineCounter++;
    const tbody = document.getElementById('linesTableBody');
    const row = document.createElement('tr');
    row.innerHTML = `
        <td>
            <div class="input-group">
                <input type="text" class="form-control account-display" 
                       placeholder="Seleccionar cuenta..." readonly>
                <input type="hidden" name="lines[${lineCounter}][account_id]" class="account-id">
                <button type="button" class="btn btn-outline-secondary" 
                        onclick="openAccountModal(${lineCounter})">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </td>
        <td>
            <input type="number" class="form-control debit-amount" 
                   name="lines[${lineCounter}][debit_amount]" 
                   step="0.01" min="0" placeholder="0.00"
                   onchange="updateBalance(this)" onkeyup="updateBalance(this)">
        </td>
        <td>
            <input type="number" class="form-control credit-amount" 
                   name="lines[${lineCounter}][credit_amount]" 
                   step="0.01" min="0" placeholder="0.00"
                   onchange="updateBalance(this)" onkeyup="updateBalance(this)">
        </td>
        <td class="text-end line-balance">0.00</td>
        <td>
            <button type="button" class="btn btn-sm btn-outline-danger" 
                    onclick="removeLine(this)" ${lineCounter <= 2 ? 'disabled' : ''}>
                <i class="fas fa-trash"></i>
            </button>
        </td>
    `;
    tbody.appendChild(row);
}

function removeLine(button) {
    const tbody = document.getElementById('linesTableBody');
    if (tbody.children.length > 2) {
        button.closest('tr').remove();
        calculateTotals();
    }
}

function openAccountModal(lineIndex) {
    currentLineIndex = lineIndex;
    loadAccounts();
    const modal = new bootstrap.Modal(document.getElementById('accountModal'));
    modal.show();
}

function loadAccounts(search = '') {
    const tbody = document.getElementById('accountsTableBody');
    tbody.innerHTML = '';
    
    accounts.filter(account => {
        return account.code.toLowerCase().includes(search.toLowerCase()) ||
               account.description.toLowerCase().includes(search.toLowerCase());
    }).forEach(account => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${account.code.replace(/\./g, '')}</td>
            <td>${account.description}</td>
            <td>
                <span class="badge bg-secondary">${account.type_account}</span>
            </td>
            <td>
                <button type="button" class="btn btn-sm btn-primary" 
                        onclick="selectAccount(${account.id}, '${account.code.replace(/\./g, '')}', '${account.description}')">
                    Seleccionar
                </button>
            </td>
        `;
        tbody.appendChild(row);
    });
}

function selectAccount(accountId, code, description) {
    const rows = document.querySelectorAll('#linesTableBody tr');
    rows.forEach((row, index) => {
        const accountIdInput = row.querySelector('.account-id');
        const accountDisplay = row.querySelector('.account-display');
        
        if (accountIdInput.name.includes(`[${currentLineIndex}]`)) {
            accountIdInput.value = accountId;
            accountDisplay.value = `${code} - ${description}`;
        }
    });
    
    const modal = bootstrap.Modal.getInstance(document.getElementById('accountModal'));
    modal.hide();
}

function updateBalance(input) {
    const row = input.closest('tr');
    const debitInput = row.querySelector('.debit-amount');
    const creditInput = row.querySelector('.credit-amount');
    const balanceCell = row.querySelector('.line-balance');
    
    const debit = parseFloat(debitInput.value) || 0;
    const credit = parseFloat(creditInput.value) || 0;
    
    // Solo uno puede tener valor
    if (input.classList.contains('debit-amount') && debit > 0) {
        creditInput.value = '';
    } else if (input.classList.contains('credit-amount') && credit > 0) {
        debitInput.value = '';
    }
    
    const balance = debit - credit;
    balanceCell.textContent = balance.toFixed(2);
    
    calculateTotals();
}

function calculateTotals() {
    let totalDebits = 0;
    let totalCredits = 0;
    
    document.querySelectorAll('.debit-amount').forEach(input => {
        totalDebits += parseFloat(input.value) || 0;
    });
    
    document.querySelectorAll('.credit-amount').forEach(input => {
        totalCredits += parseFloat(input.value) || 0;
    });
    
    const totalBalance = totalDebits - totalCredits;
    
    document.getElementById('totalDebits').textContent = totalDebits.toFixed(2);
    document.getElementById('totalCredits').textContent = totalCredits.toFixed(2);
    document.getElementById('totalBalance').textContent = totalBalance.toFixed(2);
    
    const balanceAlert = document.getElementById('balanceAlert');
    const submitBtn = document.getElementById('submitBtn');
    
    if (Math.abs(totalBalance) < 0.01 && totalDebits > 0) {
        balanceAlert.classList.add('d-none');
        submitBtn.disabled = false;
        submitBtn.classList.remove('btn-secondary');
        submitBtn.classList.add('btn-primary');
    } else {
        balanceAlert.classList.remove('d-none');
        submitBtn.disabled = true;
        submitBtn.classList.remove('btn-primary');
        submitBtn.classList.add('btn-secondary');
    }
}

// Búsqueda de cuentas
document.getElementById('accountSearch').addEventListener('input', function() {
    loadAccounts(this.value);
});

// Validación del formulario
document.getElementById('journalForm').addEventListener('submit', function(e) {
    const rows = document.querySelectorAll('#linesTableBody tr');
    let hasValidLines = false;
    
    rows.forEach(row => {
        const accountId = row.querySelector('.account-id').value;
        const debit = parseFloat(row.querySelector('.debit-amount').value) || 0;
        const credit = parseFloat(row.querySelector('.credit-amount').value) || 0;
        
        if (accountId && (debit > 0 || credit > 0)) {
            hasValidLines = true;
        }
    });
    
    if (!hasValidLines) {
        e.preventDefault();
        alert('Debe agregar al menos una línea válida con cuenta y monto.');
        return false;
    }
    
    const totalDebits = parseFloat(document.getElementById('totalDebits').textContent);
    const totalCredits = parseFloat(document.getElementById('totalCredits').textContent);
    
    if (Math.abs(totalDebits - totalCredits) >= 0.01) {
        e.preventDefault();
        alert('Los débitos y créditos deben estar balanceados.');
        return false;
    }
});
</script>
@endsection