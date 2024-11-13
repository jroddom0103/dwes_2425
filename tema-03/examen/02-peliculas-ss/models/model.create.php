<?php
/*
    model: model.create.php
    descripcion: permite añadir una película a la tabla

    Método POST:
        - id
        - titulo
        - pais
        - director
        - genero
        - año
*/

# Recogida de datos del formulario mediante método POST
$id = $_POST['id'];
$titulo = $_POST['titulo'];
$pais = $_POST['pais'];
$director = $_POST['director'];
$genero = $_POST['genero'];
$año = $_POST['año'];

# Cargo tabla de datos
$tabla = generar_tabla();

# Creación de registro con datos
$registro = [
    'id' => $id,
    'titulo' => $titulo,
    'pais' => $pais,
    'director' => $director,
    'genero' => $genero,
    'año' => $año,
];

# Añadir registro a la tabla
$tabla[] = $registro;