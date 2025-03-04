<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
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

// 12.3
// Creamos Controlador con parámetro resource
// php artisan make:controller ProductController --resource

// Generamos rutas para el controlador ProductController creado con --resource
Route::resource('products',ProductController::class);

// Sólo hay que poner return y entre comillas simples el nombre del método

// Creamos Controlador con parámetro invokable
// php artisan make:controller HomeController --invokable
// Generamos ruta para el controlador ProductController creado con método invokable
Route::get('/home',HomeController::class);