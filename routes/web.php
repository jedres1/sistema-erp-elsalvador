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