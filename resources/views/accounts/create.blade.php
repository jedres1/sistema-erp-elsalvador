@extends('layouts.app')

@section('title', 'Crear Nueva Cuenta')

@section('content')
<div class="container">
    <h1 class="mb-4 text-primary">
        <i class="fas fa-plus-circle"></i> Crear Nueva Cuenta
    </h1>
    
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-file-alt"></i> Información de la Cuenta</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('accounts.store') }}" method="POST">
                        @csrf

                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <label for="code" class="form-label"><i class="fas fa-code"></i> Código</label>
                                <input type="text" name="code" id="code" class="form-control" value="{{ old('code') }}" required placeholder="1000000000000">
                                @error('code')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="description" class="form-label"><i class="fas fa-file-alt"></i> Descripción</label>
                                <input type="text" name="description" id="description" class="form-control" value="{{ old('description') }}" required>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

            <div class="mb-3">
                <label for="type_account" class="form-label">Tipo de Cuenta</label>
                <select name="type_account" id="type_account" class="form-control" required>
                    <option value="activo" {{ old('type_account') == 'activo' ? 'selected' : '' }}>Activo</option>
                    <option value="pasivo" {{ old('type_account') == 'pasivo' ? 'selected' : '' }}>Pasivo</option>
                    <option value="patrimonio" {{ old('type_account') == 'patrimonio' ? 'selected' : '' }}>Patrimonio</option>
                    <option value="ingreso" {{ old('type_account') == 'ingreso' ? 'selected' : '' }}>Ingreso</option>
                    <option value="gasto" {{ old('type_account') == 'gasto' ? 'selected' : '' }}>Gasto</option>
                </select>
                @error('type_account')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="type_naturaled" class="form-label">Naturaleza de la Cuenta</label>
                <select name="type_naturaled" id="type_naturaled" class="form-control" required>
                    <option value="deudora" {{ old('type_naturaled') == 'deudora' ? 'selected' : '' }}>Deudora</option>
                    <option value="acreedora" {{ old('type_naturaled') == 'acreedora' ? 'selected' : '' }}>Acreedora</option>
                </select>
                @error('type_naturaled')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="group" class="form-label">Grupo</label>
                <select name="group" id="group" class="form-control" required>
                    <option value="Balance" {{ old('group') == 'Balance' ? 'selected' : '' }}>Balance</option>
                    <option value="Resultados" {{ old('group') == 'Resultados' ? 'selected' : '' }}>Resultados</option>
                </select>
                @error('group')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="accept_transaction" class="form-label">Aceptar Transacciones</label>
                <select name="accept_transaction" id="accept_transaction" class="form-control" required>
                    <option value="S" {{ old('accept_transaction') == 'S' ? 'selected' : '' }}>Sí</option>
                    <option value="N" {{ old('accept_transaction') == 'N' ? 'selected' : '' }}>No</option>
                </select>
                @error('accept_transaction')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                
                <label for="type_naturaled" class="form-label">Naturaleza tipo</label>
                <select name="type_naturaled" id="type_naturaled" class="form-control" required>
                    <option value="D" {{ old('type_naturaled') == 'D' ? 'selected' : '' }}>DEBITO</option>
                    <option value="C" {{ old('type_naturaled') == 'C' ? 'selected' : '' }}>CREDITO</option>
                </select>
                @error('status')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

                        <div class="mb-3">
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Crear Cuenta
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
