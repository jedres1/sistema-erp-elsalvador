<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AccountCatalogController;


// Ruta de bienvenida
Route::get('/', function () {
    return view('welcome');
});

// Rutas para las cuentas
Route::get('/accounts', [AccountCatalogController::class, 'welcome'])->name('accounts.index');
Route::get('/accounts/create', [AccountCatalogController::class, 'create'])->name('accounts.create');
Route::post('/accounts', [AccountCatalogController::class, 'store'])->name('accounts.store');
Route::get('/accounts/{id}/edit', [AccountCatalogController::class, 'edit'])->name('accounts.edit'); // Ruta para editar
Route::put('/accounts/{id}', [AccountCatalogController::class, 'update'])->name('accounts.update'); // Ruta para actualizar
Route::delete('/accounts/{id}', [AccountCatalogController::class, 'destroy'])->name('accounts.destroy'); // Ruta para eliminar

// Rutas para las nuevas secciones del sistema contable
Route::prefix('entries')->name('entries.')->group(function () {
    Route::get('/', function () {
        return view('entries.index');
    })->name('index');
});

Route::prefix('journal')->name('journal.')->group(function () {
    Route::get('/', function () {
        return view('journal.index');
    })->name('index');
});

Route::prefix('ledger')->name('ledger.')->group(function () {
    Route::get('/', function () {
        return view('ledger.index');
    })->name('index');
});

Route::prefix('balance')->name('balance.')->group(function () {
    Route::get('/', function () {
        return view('balance.index');
    })->name('index');
});