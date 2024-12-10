<?php

/*
    Modelo: model.ordenar.php
    Descripción: ordena las cuentas por criterios

    Parámetros:
        - criterio: el número que identifica la posición de la columna en
        el select de getcuentas()
*/

# Símbolo monetario local
setlocale(LC_MONETARY, "es_ES");

# Obtener el criterio de ordenación
$criterio = $_GET['criterio'];

# Creo un objeto de la clase tabla alumnos
$conexion = new Class_tabla_cuentas();

# Ejecuto el método order() y devuelve objeto de la clase
# mysqli_result
$stmt_cuentas = $conexion->order($criterio);