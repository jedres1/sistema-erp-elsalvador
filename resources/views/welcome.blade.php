<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
    <div id="app">
        <!-- Sidebar -->
        <sidebar-component></sidebar-component>

        <!-- Contenido principal -->
        <div class="content" style="margin-left: 150px; padding: 10px;">
            <div class="container">
                <h1>Bienvenido a la Aplicación de Contabilidad</h1>

                <h2>Cuentas Cargadas</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Descripción</th>
                            <th>Grupo</th>
                            <th>Tipo Cuenta</th>
                            <th>Naturaleza</th>
                            <th>Acepta Transacciones</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="account-table-body">
                        <!-- Aquí se cargarán los datos de la API -->
                    </tbody>
                </table>

                <a href="{{ route('accounts.create') }}" class="btn btn-primary">Crear Nueva Cuenta</a>
            </div>
        </div>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
    <script>
        // Mapeos para los valores de los campos
        const typeAccountMap = {
            'A': 'Activo',
            'P': 'Pasivo',
            'K': 'Capital',
            'I': 'Ingreso',
            'G': 'Gasto',
            'O': 'Orden'
        };

        const typeNaturaledMap = {
            'D': 'Deudor',
            'A': 'Acreedor'
        };

        const groupMap = {
            'B': 'Balance',
            'R': 'Resultado',
            'O': 'Orden'
        };

        // Función para cargar los datos desde la API y mostrarlos en la tabla
        async function loadAccounts() {
            try {
                const response = await fetch('/api/accounts');
                const accounts = await response.json();

                const tableBody = document.getElementById('account-table-body');
                tableBody.innerHTML = ''; // Limpiamos la tabla

                // Iteramos sobre las cuentas y las agregamos a la tabla con las descripciones completas
                accounts.forEach(account => {
                    const row = document.createElement('tr');

                    // Convertimos los valores a sus descripciones completas
                    const typeAccountDesc = typeAccountMap[account.type_account] || account.type_account;
                    const typeNaturaledDesc = typeNaturaledMap[account.type_naturaled] || account.type_naturaled;
                    const groupDesc = groupMap[account.group] || account.group;

                    row.innerHTML = `
                        <td>${account.code}</td>
                        <td>${account.description}</td>
                        <td>${groupDesc}</td>
                        <td>${typeAccountDesc}</td>
                        <td>${typeNaturaledDesc}</td>
                        <td>${account.accept_transaction}</td>
                        <td>
                            <a href="/accounts/${account.id}/edit" class="btn btn-warning btn-sm">Editar</a>
                        </td>
                    `;

                    tableBody.appendChild(row);
                });
            } catch (error) {
                console.error('Error al cargar las cuentas:', error);
            }
        }

        // Cargamos las cuentas al cargar la página
        document.addEventListener('DOMContentLoaded', loadAccounts);
    </script>
</body>
</html>
