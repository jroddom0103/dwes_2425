<?php

/*
    clase: class.tabla_articulos.php
    descripción: define la clase que va a contener el array de objetos de la clase artículos.
*/

class Class_tabla_articulos
{

    private $tabla;

    public function __construct()
    {
        $this->tabla = [];
    }

    /**
     * Get the value of tabla
     */
    public function getTabla()
    {
        return $this->tabla;
    }

    /**
     * Set the value of tabla
     */
    public function setTabla($tabla): self
    {
        $this->tabla = $tabla;

        return $this;
    }

    public function getMarcas()
    {
        $marcas = [
            'Xiaomi',
            'Acer',
            'Aoc',
            'Nokia',
            'Apple',
            'Lenovo',
            'IBM',
        ];
        asort($marcas);
        return $marcas;
    }

    public function getCategorias()
    {
        $categorias = [
            'Portátiles',
            'PCs sobremesa',
            'Componentes',
            'Pantallas',
            'Impresoras',
            'Tablets',
            'Móviles',
            'Fotografía',
            'Imagen',
            'Almacenamiento',
        ];
        asort($categorias);
        return $categorias;
    }

    /*
        método: getDatos()
        descripcion: devuelve un array de objetos de la clase Class_
    */
    public function getDatos()
    {

        # Articulo 1
        $articulo = new Class_articulo(
            1,
            'Portátil',
            'HP 1234',
            0,
            [1, 2, 3],
            12,
            560.56
        );

        # Añado el objeto a la tabla
        $this->tabla[] = $articulo;

        # Articulo 2
        $articulo = new Class_articulo(
            2,
            'Tablet - Samsung Galaxy Tab A (2019)',
            'Exynos',
            5,
            [2, 3,5],
            300,
            55.50
        );

        # Añado el objeto a la tabla
        $this->tabla[] = $articulo;

        # Articulo 3
        $articulo = new Class_articulo(
            3,
            'Impresora multifunción - HP',
            'DeskJet 3762',
            4,
            [2,4,1],
            2000,
            69
        );

        # Añado el objeto a la tabla
        $this->tabla[] = $articulo;

        # Articulo 4
        $articulo = new Class_articulo(
            4,
            'Smartphone - iPhone 13 Pro',
            'A15 Bionic',
            4,
            [1,2,3],
            1500,
            999.99
        );

        # Añado el objeto a la tabla
        $this->tabla[] = $articulo;

        # Articulo 5
        $articulo = new Class_articulo(
            5,
            'Laptop - Dell XPS 13',
            'Intel Core i7',
            2,
            [1,4,2],
            200,
            1299.99
        );

        # Añado el objeto a la tabla
        $this->tabla[] = $articulo;


    }
}