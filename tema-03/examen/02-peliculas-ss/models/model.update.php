<?php

/*
        model: model.update.php
        descripción: permite actualizar los detalles de una película

        Método GET:
            - indice: el índice de la tabla en la que se encuentra la película
        
        Métod POST:
            - id
            - titulo
            - pais
            - director
            - genero
            - año 
    */

# Extracción indice método GET    
$indice = $_GET['indice'];

# Extracción datos método POST
$id = $_POST['id'];
$titulo = $_POST['titulo'];
$pais = $_POST['pais'];
$director = $_POST['director'];
$genero = $_POST['genero'];
$año = $_POST['año'];

# Generar tabla
$tabla = generar_tabla();

# Creación de registro con datos
$registro = [
    'id' => $id,
    'titulo' => $titulo,
    'pais' => $pais,
    'director' => $director,
    'genero' => $genero,
    'año' => $año
];

$tabla[$indice] = $registro;