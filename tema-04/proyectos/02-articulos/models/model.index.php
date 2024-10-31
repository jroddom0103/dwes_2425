<?php

/*
    Modelo: model.index.php
    Descripción: genera array objetos de la clase artículos
*/

# Símbolo monetario local
setlocale(LC_MONETARY,"es_ES");

#Creo un objeto de la  clase tabla artículos
$articulos = new Class_tabla_articulos();

# Cargo tabla de marcas
$marcas = $articulos->getMarcas();

# Cargo tabla de categorías
$categorias = $articulos->getCategorias();

# Relleno el array de objetos
$articulos->getDatos();

# Obtener tabla de artículos
$t_articulos = $articulos->getTabla();