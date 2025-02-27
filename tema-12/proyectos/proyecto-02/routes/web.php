<?php

use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

// Rutas del controlador UserController
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);

Route::get('/users/create', [UserController::class, 'create']);
Route::get('/users/{id}/edit', [UserController::class, 'edit']);
Route::get('/users', [UserController::class, 'store']);
Route::get('/users/{id}', [UserController::class, 'update']);
Route::get('/users/{id}', [UserController::class, 'destroy']);

// Generamos rutas para el controlador ClientController creado con --resource
Route::resource('clients',ClientController::class);

