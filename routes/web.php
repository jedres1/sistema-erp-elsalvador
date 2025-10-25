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