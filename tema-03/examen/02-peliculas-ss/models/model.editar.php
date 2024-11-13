<?php

/*
    model: model.editar.php
    descripción: carga los datos de una película para mostrarlos en modo edición en el formulario

    Parámetros GET:

        - indice: indice de la tabla en la que se encuentra la película

*/

$indice = $_GET['indice'];

$tabla = generar_tabla();

$registro = $tabla[$indice];