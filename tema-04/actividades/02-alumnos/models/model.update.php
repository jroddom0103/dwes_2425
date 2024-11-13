<?php

    /*
        Modelo: model.update.php
        Descripción: actualiza los datos del registro a partir de los detalles del formulario

        Método POST:
            - id
            - nombre
            - apellidos
            - email
            - f_nacimiento
            - curso
            - asignaturas
        Método GET
            - indice (indice de la tabla correspondiente a dicho registro)    
    */

    # Símbolo monetario local
    setlocale(LC_MONETARY,"es_ES");

    # Cargo los detalles del  formulario
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $f_nacimiento = $_POST['f_nacimiento'];
    $curso = $_POST['curso'];
    $asignaturas = $_POST['asignaturas'];

    # Crear un objeto de la clase alumnos a partir de los detalles del formulario
    $alumno = new Class_alumno(
        $id,
        $nombre,
        $apellidos,
        $email,
        $f_nacimiento,
        $curso,
        $asignaturas
    );

    # Cargo el índice de la tabla donde se encuentra el alumno
    $indice = $_GET['indice'];

    # Creo un objeto de la clase tabla alumnos
    $obj_tabla_alumnos = new Class_tabla_alumnos();

    # Cargo los datos en el objeto de la clase tabla de alumnos
    $obj_tabla_alumnos->getDatos();

    # Actualizo la tabla
    $obj_tabla_alumnos->update($alumno, $indice);

    # Extraer la tabla para la vista
    $array_alumnos = $obj_tabla_alumnos->getTabla();

    # Extraer array de marcas para la vista
    $asignaturas = $obj_tabla_alumnos->getAsignaturas();