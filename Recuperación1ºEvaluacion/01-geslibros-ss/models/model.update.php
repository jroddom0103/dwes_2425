<?php
/*
    autor_id: model.update.php
    descripción: actualiza los datos del libro
    
    Método GET:
        - id

    Métod POST (libro):
        - titulo
        - autor_id
        - editorial_id
        - precio
        - stock
        - fecha_edicion
        - isbn
        - generos_id    
        
*/

$id = $_GET['id'];

# Cargo los detalles del  formulario
$titulo = $_POST['titulo'];
$autor_id = $_POST['autor_id'];
$editorial_id = $_POST['editorial_id'];
$precio = $_POST['precio'];
$stock = $_POST['stock'];
$fecha_edicion = $_POST['fecha_edicion'];
$isbn = $_POST['isbn'];

// convertimos los géneros en string
$generos_id = implode(',', $_POST['generos_id']);

# Validación

# Creamos objeto de la clase Class_libro
$libro = new Class_libro(
    null,
    $titulo,
    $precio,
    $stock,
    $fecha_edicion,
    $isbn,
    $autor_id,
    $editorial_id,
    $generos_id
);

# Acualizamos el libro mediante el método update
$conexion = new Class_tabla_libros();

$conexion->update($libro, $id);

$stmt_libros = $conexion->get_libros();