<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cuenta</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Crear Nueva Cuenta</h1>
        
        <form action="{{ route('accounts.store') }}" method="POST">
            @csrf

            <div class="mb-3 row">
                <div class="col-md-6">
                    <label for="code" class="form-label">Código</label>
                    <input type="text" name="code" id="code" class="form-control" value="{{ old('code') }}" required placeholder="0-0-00-00-00-00-00">
                    @error('code')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="description" class="form-label">Descripción</label>
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

            <button type="submit" class="btn btn-primary">Crear Cuenta</button>
        </form>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
    <script>
        document.getElementById('code').addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, ''); // Eliminar cualquier carácter que no sea dígito
            let paddedValue = value.padEnd(12, '0'); // Rellenar con ceros hasta tener 12 dígitos

            let formattedValue = paddedValue.substring(0, 1) + '-' +
                                 paddedValue.substring(1, 2) + '-' +
                                 paddedValue.substring(2, 4) + '-' +
                                 paddedValue.substring(4, 6) + '-' +
                                 paddedValue.substring(6, 8) + '-' +
                                 paddedValue.substring(8, 10) + '-' +
                                 paddedValue.substring(10, 12);
            
            e.target.value = formattedValue;
        });
    </script>
</body>
</html>
