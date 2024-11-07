@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Actualizar Cuenta</h2>

        <form action="{{ route('accounts.update', $account->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Campo para el código de cuenta -->
            <div class="form-group">
                <label for="code">Código</label>
                <input type="text" name="code" id="code" class="form-control" value="{{ $account->code }}" required>
            </div>

            <!-- Campo para la descripción -->
            <div class="form-group">
                <label for="description">Descripción</label>
                <input type="text" name="description" id="description" class="form-control" value="{{ $account->description }}" required>
            </div>

            <!-- Tipo de cuenta -->
            <div class="form-group">
                <label for="type_account">Tipo de cuenta</label>
                <select name="type_account" id="type_account" class="form-control" required>
                    <option value="activo" {{ $account->type_account == 'activo' ? 'selected' : '' }}>Activo</option>
                    <option value="pasivo" {{ $account->type_account == 'pasivo' ? 'selected' : '' }}>Pasivo</option>
                    <option value="patrimonio" {{ $account->type_account == 'patrimonio' ? 'selected' : '' }}>Patrimonio</option>
                    <option value="ingreso" {{ $account->type_account == 'ingreso' ? 'selected' : '' }}>Ingreso</option>
                    <option value="gasto" {{ $account->type_account == 'gasto' ? 'selected' : '' }}>Gasto</option>
                </select>
            </div>

            <!-- Naturaleza de la cuenta -->
            <div class="form-group">
                <label for="type_naturaled">Naturaleza</label>
                <select name="type_naturaled" id="type_naturaled" class="form-control" required>
                    <option value="deudora" {{ $account->type_naturaled == 'deudora' ? 'selected' : '' }}>Deudora</option>
                    <option value="acreedora" {{ $account->type_naturaled == 'acreedora' ? 'selected' : '' }}>Acreedora</option>
                </select>
            </div>

            <!-- Grupo -->
            <div class="form-group">
                <label for="group">Grupo</label>
                <select name="group" id="group" class="form-control" required>
                    <option value="Balance" {{ $account->group == 'Balance' ? 'selected' : '' }}>Balance</option>
                    <option value="Resultados" {{ $account->group == 'Resultados' ? 'selected' : '' }}>Resultados</option>
                </select>
            </div>

            <!-- Acepta transacciones -->
            <div class="form-group">
                <label for="accept_transaction">¿Acepta transacciones?</label>
                <select name="accept_transaction" id="accept_transaction" class="form-control" required>
                    <option value="S" {{ $account->accept_transaction == 'S' ? 'selected' : '' }}>Sí</option>
                    <option value="N" {{ $account->accept_transaction == 'N' ? 'selected' : '' }}>No</option>
                </select>
            </div>

            
            <button type="submit" class="btn btn-primary">Actualizar Cuenta</button>
        </form>
    </div>
@endsection
