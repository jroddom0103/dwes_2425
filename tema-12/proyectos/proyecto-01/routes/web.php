<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hola', function () {
    return 'Hola mundo';
});

// Ruta con parámetros
// Route::get('/saludo/{nombre}', function ($nombre) {
//     return 'Hola '.$nombre;
// });

// Ruta con varios parámetros
Route::get('/post/{id}/comments/{comment_id}', function($id, $comment_id){
    return 'Post: ' . $id . ' - Comment: ' . $comment_id;
});

// Ruta con parámetros opcionales
Route::get('/saludo/{name}/{nickname?}', function($name, $nickname = null){
    if ($nickname){
        return "Bienvenido {$name}, tu apodo es {$nickname}";
    }else{
        return "Hola " . $name;
    }
});