@extends('layouts.app')

@section('title', 'Editar Cuenta')

@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="mb-4">
        <div class="bg-white shadow-sm rounded-lg p-4">
            <div class="d-flex align-items-center">
                <div class="me-3">
                    <span style="font-size: 2rem;">✏️</span>
                </div>
                <div>
                    <h1 class="h3 mb-1">Editar Cuenta</h1>
                    <p class="text-muted mb-0">Modifica la información de la cuenta <strong class="text-primary">{{ $account->code }}</strong></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulario -->
    <div class="bg-white shadow-sm rounded-lg">
        <div class="card-header bg-light">
            <h5 class="mb-0">📄 Información de la Cuenta</h5>
        </div>
        
        <form action="{{ route('accounts.update', $account->id) }}" method="POST" class="p-4">
            @csrf
            @method('PUT')

            <div class="row g-4">
                <!-- Código -->
                <div class="col-md-6">
                    <label for="code" class="form-label fw-bold">
                        # Código de Cuenta <span class="text-danger">*</span>
                    </label>
                    <input type="text" 
                           name="code" 
                           id="code" 
                           class="form-control @error('code') is-invalid @enderror" 
                           value="{{ old('code', $account->code) }}" 
                           required 
                           placeholder="Ej: 1.1.01.001"
                           maxlength="20">
                    @error('code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">
                        Formato: nivel.subnivel.cuenta.subcuenta
                    </small>
                </div>

                <!-- Tipo de Cuenta -->
                <div class="col-md-6">
                    <label for="type_account" class="form-label fw-bold">
                        🏷️ Tipo de Cuenta <span class="text-danger">*</span>
                    </label>
                    <select name="type_account" 
                            id="type_account" 
                            class="form-select @error('type_account') is-invalid @enderror" 
                            required>
                        <option value="">Seleccionar tipo...</option>
                        <option value="ACTIVO" {{ old('type_account', $account->type_account) == 'ACTIVO' ? 'selected' : '' }}>
                            �� Activo
                        </option>
                        <option value="PASIVO" {{ old('type_account', $account->type_account) == 'PASIVO' ? 'selected' : '' }}>
                            �� Pasivo
                        </option>
                        <option value="PATRIMONIO" {{ old('type_account', $account->type_account) == 'PATRIMONIO' ? 'selected' : '' }}>
                            🏛️ Patrimonio
                        </option>
                        <option value="INGRESOS" {{ old('type_account', $account->type_account) == 'INGRESOS' ? 'selected' : '' }}>
                            📈 Ingresos
                        </option>
                        <option value="GASTOS" {{ old('type_account', $account->type_account) == 'GASTOS' ? 'selected' : '' }}>
                            📉 Gastos
                        </option>
                        <option value="COSTOS" {{ old('type_account', $account->type_account) == 'COSTOS' ? 'selected' : '' }}>
                            🔧 Costos
                        </option>
                    </select>
                    @error('type_account')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Descripción -->
                <div class="col-12">
                    <label for="description" class="form-label fw-bold">
                        📝 Descripción de la Cuenta <span class="text-danger">*</span>
                    </label>
                    <input type="text" 
                           name="description" 
                           id="description" 
                           class="form-control @error('description') is-invalid @enderror" 
                           value="{{ old('description', $account->description) }}" 
                           required 
                           placeholder="Ej: Efectivo en Caja"
                           maxlength="255">
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Naturaleza -->
                <div class="col-md-4">
                    <label for="type_naturaled" class="form-label fw-bold">
                        ⚖️ Naturaleza <span class="text-danger">*</span>
                    </label>
                    <select name="type_naturaled" 
                            id="type_naturaled" 
                            class="form-select @error('type_naturaled') is-invalid @enderror" 
                            required>
                        <option value="">Seleccionar...</option>
                        <option value="D" {{ old('type_naturaled', $account->type_naturaled) == 'D' ? 'selected' : '' }}>
                            ➕ Deudora
                        </option>
                        <option value="A" {{ old('type_naturaled', $account->type_naturaled) == 'A' ? 'selected' : '' }}>
                            ➖ Acreedora
                        </option>
                    </select>
                    @error('type_naturaled')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Acepta Transacciones -->
                <div class="col-md-4">
                    <label for="accept_transaction" class="form-label fw-bold">
                        🔄 Acepta Transacciones <span class="text-danger">*</span>
                    </label>
                    <select name="accept_transaction" 
                            id="accept_transaction" 
                            class="form-select @error('accept_transaction') is-invalid @enderror" 
                            required>
                        <option value="S" {{ old('accept_transaction', $account->accept_transaction) == 'S' ? 'selected' : '' }}>
                            ✅ Sí
                        </option>
                        <option value="N" {{ old('accept_transaction', $account->accept_transaction) == 'N' ? 'selected' : '' }}>
                            ❌ No
                        </option>
                    </select>
                    @error('accept_transaction')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">
                        Las cuentas padre no suelen aceptar transacciones
                    </small>
                </div>

                <!-- Grupo -->
                <div class="col-md-4">
                    <label for="group" class="form-label fw-bold">
                        📁 Grupo <small class="text-muted">(Opcional)</small>
                    </label>
                    <input type="text" 
                           name="group" 
                           id="group" 
                           class="form-control @error('group') is-invalid @enderror" 
                           value="{{ old('group', $account->group) }}" 
                           placeholder="Ej: Disponible"
                           maxlength="100">
                    @error('group')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Información adicional -->
            <div class="alert alert-warning mt-4">
                <h6 class="alert-heading">⚠️ Importante al editar cuentas</h6>
                <ul class="mb-0 small">
                    <li>Cambiar el código puede afectar las transacciones existentes</li>
                    <li>Si la cuenta tiene transacciones registradas, verifique la naturaleza</li>
                    <li>No cambie una cuenta transaccional a agrupadora si tiene movimientos</li>
                </ul>
            </div>

            <!-- Botones de acción -->
            <div class="d-flex justify-content-between align-items-center mt-4 pt-4 border-top">
                <a href="{{ route('accounts.index') }}" class="btn btn-outline-secondary">
                    ⬅️ Volver al Catálogo
                </a>
                
                <div class="d-flex gap-2">
                    <button type="reset" class="btn btn-outline-secondary">
                        🔄 Restaurar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        💾 Guardar Cambios
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Auto-sugerir naturaleza basada en tipo de cuenta
document.getElementById('type_account').addEventListener('change', function() {
    const typeNatured = document.getElementById('type_naturaled');
    const value = this.value;
    
    // No sobrescribir si ya hay un valor
    if (typeNatured.value) return;
    
    // Sugerir naturaleza basada en el tipo
    if (['ACTIVO', 'GASTOS', 'COSTOS'].includes(value)) {
        typeNatured.value = 'D'; // Deudora
    } else if (['PASIVO', 'PATRIMONIO', 'INGRESOS'].includes(value)) {
        typeNatured.value = 'A'; // Acreedora
    }
});

// Validación en tiempo real del código
document.getElementById('code').addEventListener('input', function() {
    const code = this.value;
    const isValid = /^[\d.]+$/.test(code);
    
    if (!isValid && code.length > 0) {
        this.classList.add('is-invalid');
    } else {
        this.classList.remove('is-invalid');
    }
});
</script>
@endsection
