@extends('layouts.app')

@section('title', 'Actualizar Cuenta')

@section('content')
<div class="container">
    <h1 class="mb-4 text-primary">
        <i class="fas fa-edit"></i> Actualizar Cuenta
    </h1>
    
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="fas fa-file-alt"></i> Editar Información de la Cuenta</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('accounts.update', $account->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Campo para el código de cuenta -->
                        <div class="form-group mb-3">
                            <label for="code"><i class="fas fa-code"></i> Código</label>
                            <input type="text" name="code" id="code" class="form-control" value="{{ str_replace('.', '', $account->code) }}" required>
                        </div>

                        <!-- Campo para la descripción -->
                        <div class="form-group mb-3">
                            <label for="description"><i class="fas fa-file-alt"></i> Descripción</label>
                            <input type="text" name="description" id="description" class="form-control" value="{{ $account->description }}" required>
                        </div>

                        <!-- Tipo de cuenta -->
                        <div class="form-group mb-3">
                            <label for="type_account"><i class="fas fa-tag"></i> Tipo de cuenta</label>
                            <select name="type_account" id="type_account" class="form-control" required>
                                <option value="activo" {{ $account->type_account == 'activo' ? 'selected' : '' }}>Activo</option>
                                <option value="pasivo" {{ $account->type_account == 'pasivo' ? 'selected' : '' }}>Pasivo</option>
                                <option value="patrimonio" {{ $account->type_account == 'patrimonio' ? 'selected' : '' }}>Patrimonio</option>
                                <option value="ingreso" {{ $account->type_account == 'ingreso' ? 'selected' : '' }}>Ingreso</option>
                                <option value="gasto" {{ $account->type_account == 'gasto' ? 'selected' : '' }}>Gasto</option>
                            </select>
                        </div>

                        <!-- Naturaleza de la cuenta -->
                        <div class="form-group mb-3">
                            <label for="type_naturaled"><i class="fas fa-balance-scale"></i> Naturaleza</label>
                            <select name="type_naturaled" id="type_naturaled" class="form-control" required>
                                <option value="deudora" {{ $account->type_naturaled == 'deudora' ? 'selected' : '' }}>Deudora</option>
                                <option value="acreedora" {{ $account->type_naturaled == 'acreedora' ? 'selected' : '' }}>Acreedora</option>
                            </select>
                        </div>

                        <!-- Grupo -->
                        <div class="form-group mb-3">
                            <label for="group"><i class="fas fa-layer-group"></i> Grupo</label>
                            <select name="group" id="group" class="form-control" required>
                                <option value="Balance" {{ $account->group == 'Balance' ? 'selected' : '' }}>Balance</option>
                                <option value="Resultados" {{ $account->group == 'Resultados' ? 'selected' : '' }}>Resultados</option>
                            </select>
                        </div>

                        <!-- Acepta transacciones -->
                        <div class="form-group mb-3">
                            <label for="accept_transaction"><i class="fas fa-exchange-alt"></i> ¿Acepta transacciones?</label>
                            <select name="accept_transaction" id="accept_transaction" class="form-control" required>
                                <option value="S" {{ $account->accept_transaction == 'S' ? 'selected' : '' }}>Sí</option>
                                <option value="N" {{ $account->accept_transaction == 'N' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-save"></i> Actualizar Cuenta
                                </button>
                                <a href="{{ route('accounts.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Volver
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('code').addEventListener('input', function (e) {
        let value = e.target.value.replace(/\D/g, ''); // Eliminar cualquier carácter que no sea dígito
        let paddedValue = value.padEnd(13, '0'); // Rellenar con ceros hasta tener 13 dígitos

        // Solo mostrar números sin formato
        e.target.value = paddedValue;
    });
</script>
@endsection
