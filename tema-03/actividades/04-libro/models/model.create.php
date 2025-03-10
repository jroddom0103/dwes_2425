<?php

    /*

        Modelo:  model.create.php
        Descripción: añade un nuevo libro a la taba

        Método POST:
            - titulo
            - autor
            - editorial
            - genero
            - precio
    */

    # Extraemos los valores del formulario
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $editorial = $_POST['editorial'];
    $genero = $_POST['genero'];
    $precio = $_POST['precio'];

    # Cargar tabla libros
    $libros = get_tabla_libros();


    # Creo un array asociativo con los detalles del nuevo alumno
    $registro = [
        'id' => count($libros)+1,
        'titulo' => $titulo,
        'autor' => $autor,
        'editorial' => $editorial,
        'genero'=> $genero,
        'precio'=> $precio
    ];

    # Añadir nuevo libro a la tabla
    $libros[] = $registro;


