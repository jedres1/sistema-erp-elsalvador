<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AccountCatalogController;
use App\Http\Controllers\JournalEntryController;
use App\Http\Controllers\LedgerController;


// Ruta de bienvenida - redirige al catálogo de cuentas
Route::get('/', function () {
    return redirect()->route('accounts.index');
});

// Redirección de entries al libro diario
Route::get('/entries', function () {
    return redirect()->route('journal.index');
});

// Rutas para las cuentas
Route::get('/accounts', [AccountCatalogController::class, 'welcome'])->name('accounts.index');
Route::get('/accounts/create', [AccountCatalogController::class, 'create'])->name('accounts.create');
Route::post('/accounts', [AccountCatalogController::class, 'store'])->name('accounts.store');
Route::get('/accounts/{id}/edit', [AccountCatalogController::class, 'edit'])->name('accounts.edit'); // Ruta para editar
Route::put('/accounts/{id}', [AccountCatalogController::class, 'update'])->name('accounts.update'); // Ruta para actualizar
Route::delete('/accounts/{id}', [AccountCatalogController::class, 'destroy'])->name('accounts.destroy'); // Ruta para eliminar

// Rutas para el sistema contable
// Funciones de partidas (sin mostrar en navegación, solo para operaciones internas)
Route::prefix('entries')->name('entries.')->group(function () {
    Route::get('/create', [JournalEntryController::class, 'create'])->name('create');
    Route::post('/', [JournalEntryController::class, 'store'])->name('store');
    Route::get('/{id}', [JournalEntryController::class, 'show'])->name('show');
    Route::delete('/{id}', [JournalEntryController::class, 'destroy'])->name('destroy');
    Route::patch('/{id}/mayorize', [JournalEntryController::class, 'mayorize'])->name('mayorize');
});

// Ruta API para obtener cuentas que aceptan transacciones
Route::get('/api/entries/accounts', [JournalEntryController::class, 'getTransactionAccounts'])->name('entries.api.accounts');

Route::prefix('journal')->name('journal.')->group(function () {
    Route::get('/', [JournalEntryController::class, 'index'])->name('index'); // Libro Diario
});

Route::prefix('ledger')->name('ledger.')->group(function () {
    Route::get('/', [LedgerController::class, 'index'])->name('index');
    Route::get('/account/{id}', [LedgerController::class, 'show'])->name('account');
    Route::get('/balance', [LedgerController::class, 'balanceSheet'])->name('balance');
});

Route::prefix('balance')->name('balance.')->group(function () {
    Route::get('/', [App\Http\Controllers\BalanceController::class, 'index'])->name('index');
});

Route::prefix('estado-resultados')->name('estado-resultados.')->group(function () {
    Route::get('/', [App\Http\Controllers\EstadoResultadosController::class, 'index'])->name('index');
});

Route::prefix('parametros')->name('parametros.')->group(function () {
    Route::get('/', [App\Http\Controllers\ParametrosContablesController::class, 'index'])->name('index');
    Route::get('/create', [App\Http\Controllers\ParametrosContablesController::class, 'create'])->name('create');
    Route::post('/', [App\Http\Controllers\ParametrosContablesController::class, 'store'])->name('store');
    Route::get('/{id}', [App\Http\Controllers\ParametrosContablesController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [App\Http\Controllers\ParametrosContablesController::class, 'edit'])->name('edit');
    Route::put('/{id}', [App\Http\Controllers\ParametrosContablesController::class, 'update'])->name('update');
    Route::delete('/{id}', [App\Http\Controllers\ParametrosContablesController::class, 'destroy'])->name('destroy');
    Route::get('/{id}/toggle', [App\Http\Controllers\ParametrosContablesController::class, 'toggle'])->name('toggle');
});

// Rutas para Documentos Electrónicos
Route::prefix('documentos-electronicos')->name('documentos-electronicos.')->group(function () {
    Route::get('/', [App\Http\Controllers\DocumentosElectronicosController::class, 'index'])->name('index');
    Route::get('/create', [App\Http\Controllers\DocumentosElectronicosController::class, 'create'])->name('create');
    Route::post('/', [App\Http\Controllers\DocumentosElectronicosController::class, 'store'])->name('store');
    Route::get('/{id}', [App\Http\Controllers\DocumentosElectronicosController::class, 'show'])->name('show');
    Route::post('/{id}/timbrar', [App\Http\Controllers\DocumentosElectronicosController::class, 'timbrar'])->name('timbrar');
    Route::post('/{id}/cancelar', [App\Http\Controllers\DocumentosElectronicosController::class, 'cancelar'])->name('cancelar');
    Route::get('/{id}/xml', [App\Http\Controllers\DocumentosElectronicosController::class, 'descargarXml'])->name('xml');
    Route::get('/{id}/pdf', [App\Http\Controllers\DocumentosElectronicosController::class, 'descargarPdf'])->name('pdf');
    Route::get('/configuracion', [App\Http\Controllers\DocumentosElectronicosController::class, 'configuracion'])->name('configuracion');
});

// Rutas para gestión de clientes (independientes)
Route::prefix('clientes')->name('clientes.')->group(function () {
    Route::get('/', [App\Http\Controllers\DocumentosElectronicosController::class, 'clientesIndex'])->name('index');
    Route::get('/create', [App\Http\Controllers\DocumentosElectronicosController::class, 'clientesCreate'])->name('create');
    Route::post('/', [App\Http\Controllers\DocumentosElectronicosController::class, 'clientesStore'])->name('store');
    Route::post('/ajax', [App\Http\Controllers\DocumentosElectronicosController::class, 'clientesStoreAjax'])->name('store.ajax');
    Route::get('/{id}', [App\Http\Controllers\DocumentosElectronicosController::class, 'clientesShow'])->name('show');
    Route::get('/{id}/edit', [App\Http\Controllers\DocumentosElectronicosController::class, 'clientesEdit'])->name('edit');
    Route::put('/{id}', [App\Http\Controllers\DocumentosElectronicosController::class, 'clientesUpdate'])->name('update');
    Route::delete('/{id}', [App\Http\Controllers\DocumentosElectronicosController::class, 'clientesDestroy'])->name('destroy');
    Route::get('/buscar/{term}', [App\Http\Controllers\DocumentosElectronicosController::class, 'clientesBuscar'])->name('buscar');
});

// Rutas para Cuentas por Cobrar
Route::prefix('cuentas-por-cobrar')->name('cuentas-por-cobrar.')->group(function () {
    Route::get('/', [App\Http\Controllers\CuentasPorCobrarController::class, 'index'])->name('index');
    Route::get('/{id}', [App\Http\Controllers\CuentasPorCobrarController::class, 'show'])->name('show');
    Route::post('/{id}/pago', [App\Http\Controllers\CuentasPorCobrarController::class, 'registrarPago'])->name('registrar-pago');
    Route::get('/reportes/antiguedad', [App\Http\Controllers\CuentasPorCobrarController::class, 'reporteAntiguedad'])->name('reporte-antiguedad');
    Route::get('/exportar/excel', [App\Http\Controllers\CuentasPorCobrarController::class, 'exportarExcel'])->name('exportar-excel');
    Route::post('/{id}/recordatorio', [App\Http\Controllers\CuentasPorCobrarController::class, 'enviarRecordatorio'])->name('enviar-recordatorio');
    
    // Rutas para gestión de proveedores
    Route::prefix('proveedores')->name('proveedores.')->group(function () {
        Route::get('/', [App\Http\Controllers\CuentasPorCobrarController::class, 'proveedoresIndex'])->name('index');
        Route::get('/create', [App\Http\Controllers\CuentasPorCobrarController::class, 'proveedoresCreate'])->name('create');
        Route::post('/', [App\Http\Controllers\CuentasPorCobrarController::class, 'proveedoresStore'])->name('store');
        Route::post('/ajax', [App\Http\Controllers\CuentasPorCobrarController::class, 'proveedoresStoreAjax'])->name('store.ajax');
        Route::get('/{id}', [App\Http\Controllers\CuentasPorCobrarController::class, 'proveedoresShow'])->name('show');
        Route::get('/{id}/edit', [App\Http\Controllers\CuentasPorCobrarController::class, 'proveedoresEdit'])->name('edit');
        Route::put('/{id}', [App\Http\Controllers\CuentasPorCobrarController::class, 'proveedoresUpdate'])->name('update');
        Route::delete('/{id}', [App\Http\Controllers\CuentasPorCobrarController::class, 'proveedoresDestroy'])->name('destroy');
        Route::get('/buscar/{term}', [App\Http\Controllers\CuentasPorCobrarController::class, 'proveedoresBuscar'])->name('buscar');
    });
});

// Rutas para Inventario

// Rutas para Inventario
Route::prefix('inventario')->name('inventario.')->group(function () {
    Route::get('/', [App\Http\Controllers\InventarioController::class, 'index'])->name('index');
    Route::get('/create', [App\Http\Controllers\InventarioController::class, 'create'])->name('create');
    Route::post('/', [App\Http\Controllers\InventarioController::class, 'store'])->name('store');
    Route::get('/kardex', [App\Http\Controllers\InventarioController::class, 'kardex'])->name('kardex');
    Route::get('/{id}', [App\Http\Controllers\InventarioController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [App\Http\Controllers\InventarioController::class, 'edit'])->name('edit');
    Route::put('/{id}', [App\Http\Controllers\InventarioController::class, 'update'])->name('update');
    Route::delete('/{id}', [App\Http\Controllers\InventarioController::class, 'destroy'])->name('destroy');
    Route::post('/entrada', [App\Http\Controllers\InventarioController::class, 'entrada'])->name('entrada');
    Route::post('/salida', [App\Http\Controllers\InventarioController::class, 'salida'])->name('salida');
});

// Rutas para Compras
Route::prefix('compras')->name('compras.')->group(function () {
    Route::get('/', [App\Http\Controllers\ComprasController::class, 'index'])->name('index');
    Route::get('/create', [App\Http\Controllers\ComprasController::class, 'create'])->name('create');
    Route::post('/', [App\Http\Controllers\ComprasController::class, 'store'])->name('store');
    Route::get('/{id}', [App\Http\Controllers\ComprasController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [App\Http\Controllers\ComprasController::class, 'edit'])->name('edit');
    Route::put('/{id}', [App\Http\Controllers\ComprasController::class, 'update'])->name('update');
    Route::delete('/{id}', [App\Http\Controllers\ComprasController::class, 'destroy'])->name('destroy');
    Route::post('/{id}/recibir', [App\Http\Controllers\ComprasController::class, 'recibir'])->name('recibir');
    Route::post('/{id}/aprobar', [App\Http\Controllers\ComprasController::class, 'aprobar'])->name('aprobar');
    Route::post('/{id}/cancelar', [App\Http\Controllers\ComprasController::class, 'cancelar'])->name('cancelar');
});

// Rutas para Cuentas por Pagar
Route::prefix('cuentas-por-pagar')->name('cuentas-por-pagar.')->group(function () {
    Route::get('/', [App\Http\Controllers\CuentasPorPagarController::class, 'index'])->name('index');
    Route::get('/{id}', [App\Http\Controllers\CuentasPorPagarController::class, 'show'])->name('show');
    Route::post('/{id}/pago', [App\Http\Controllers\CuentasPorPagarController::class, 'registrarPago'])->name('registrar-pago');
    Route::post('/{id}/programar', [App\Http\Controllers\CuentasPorPagarController::class, 'programarPago'])->name('programar-pago');
    Route::get('/reportes/antiguedad', [App\Http\Controllers\CuentasPorPagarController::class, 'reporteAntiguedad'])->name('reporte-antiguedad');
    Route::get('/exportar/excel', [App\Http\Controllers\CuentasPorPagarController::class, 'exportarExcel'])->name('exportar-excel');
    Route::post('/{id}/aprobar', [App\Http\Controllers\CuentasPorPagarController::class, 'aprobarPago'])->name('aprobar-pago');
});

// Rutas para Control Bancario
Route::prefix('bancos')->name('bancos.')->group(function () {
    Route::get('/', [App\Http\Controllers\BancosController::class, 'index'])->name('index');
    Route::get('/create', [App\Http\Controllers\BancosController::class, 'create'])->name('create');
    Route::post('/', [App\Http\Controllers\BancosController::class, 'store'])->name('store');
    Route::get('/{id}', [App\Http\Controllers\BancosController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [App\Http\Controllers\BancosController::class, 'edit'])->name('edit');
    Route::put('/{id}', [App\Http\Controllers\BancosController::class, 'update'])->name('update');
    Route::delete('/{id}', [App\Http\Controllers\BancosController::class, 'destroy'])->name('destroy');
    Route::post('/deposito', [App\Http\Controllers\BancosController::class, 'deposito'])->name('deposito');
    Route::post('/retiro', [App\Http\Controllers\BancosController::class, 'retiro'])->name('retiro');
    Route::post('/transferencia', [App\Http\Controllers\BancosController::class, 'transferencia'])->name('transferencia');
    Route::get('/{id}/conciliar', [App\Http\Controllers\BancosController::class, 'conciliar'])->name('conciliar');
});