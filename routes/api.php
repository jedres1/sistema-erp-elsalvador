<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AccountCatalogController;

// Define el conjunto completo de rutas RESTful para account-catalogs
Route::get('/accounts', [AccountCatalogController::class, 'index']);
Route::get('accounts/{id}', [AccountCatalogController::class, 'show']); // Para obtener una cuenta por ID
Route::put('/accounts/{id}', [AccountCatalogController::class, 'update']); // Para actualizar una cuenta

//Route::apiResource('account-catalogs', AccountCatalogController::class);

