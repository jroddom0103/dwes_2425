<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    // Declaro los métodos del controlador User
    public function index()
    {
        return 'Listado de usuarios';
    }

    // Declaramos el método show
    public function show($id){
        return 'Detalles de Usuario: '.$id;
    }

    // Declaramos el método create
    public function create(){
        return 'Crear Usuario';
    }

    

    // Declaramos el método edit
    public function edit($id){
        return 'Editar Usuario: '.$id;
    }

    // Declaramos el método store
    public function store(Request $request){
        return 'Guardar Usuario';
    }

    // Declaramos el método update
    public function update(Request $request, $id){
        return 'Actualizar Usuario: '.$id;
    }

    // Declaramos el método destroy
    public function destroy($id){
        return 'Eliminar Usuario: '.$id;
    }
}
