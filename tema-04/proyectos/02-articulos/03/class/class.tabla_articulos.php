<?php

/*
    clase: class.tabla_articulos.php
    descripcion: define la clase que va a contener el array de objetos de la clase artículos.
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
            'Racer'
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
            'Almacenamiento'
        ];

        asort($categorias);

        return $categorias;
    }

    /*
        método: getDatos()
        descripcion: devuelve un array de objetos
    */

    public function getDatos()
    {

        # Articulo 1
        $articulo = new Class_articulo(
            1,
            'Portátil HP MD12345',
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
            [2, 3, 5],
            300,
            55.50
        );

        # Añadir artículo a la tabla
        $this->tabla[] = $articulo;

        # Articulo 3
        $articulo = new Class_articulo(
            3,
            'Impresora multifunción - HP',
            'DeskJet 3762',
            4,
            [2, 4, 1],
            2000,
            69
        );

        # Añadir artículo a la tabla
        $this->tabla[] = $articulo;

        # Articulo 4
        $articulo = new Class_articulo(
            4,
            'TV LED 40" - Thomson 40FE5606 - Full HD',
            'Thomson 40FE5606',
            3,
            [1, 3, 4],
            300,
            259
        );

        # Añadir artículo a la tabla
        $this->tabla[] = $articulo;

        # Articulo 5
        $articulo = new Class_articulo(
            5,
            'PC Sobremesa - Acer Aspire XC-830',
            'Acer Aspire XC-830',
            1,
            [3, 5],
            20,
            329
        );

        # Añadir artículo a la tabla
        $this->tabla[] = $articulo;
    }

    /*
        método: mostrar_nombre_categorias()
        descripción: devuelve un array con el nombre de las categorías
        parámetros:
            - indice_categorias
    */

    public function mostrar_nombre_categorias($indice_categorias = [])
    {
        # creo array de nombre de categorías vacío
        $nombre_categorias = [];

        # cargo el array de categorias de los artículos
        $categorias_articulos = $this->getCategorias();

        foreach ($indice_categorias as $indice_categoria) {
            $nombre_categorias[] = $categorias_articulos[$indice_categoria];
        }

        # Ordeno
        asort($nombre_categorias);
        return $nombre_categorias;
    }

    /*
        método: create()
        descripcion: permite añadir un objeto de la clase artículo a la tabla
        parámetros:

            - $articulo - objeto de la clase artículos

    */
    public function create(Class_articulo $articulo)
    {
        $this->tabla[] = $articulo;
    }

    /*
        método: read()
        descripcion: permite obtener el objeto de la clase artículo correspondiente a un índice de la tabla
        
        parámetros:

            - $indice - índice de la tabla

    */

    public function read($indice)
    {
        return $this->tabla[$indice];
    }

    /*
        método: update()
        descripcion: permite actualizar los detalles de un artículo en la tabla

        parámetros:
            - $articulo - objeto de la clase artículo, con los detalles actualizados de dicho artículo
            - $indice - índice de la tabla
    */
    public function update(Class_articulo $articulo, $indice){
        $this->tabla[$indice] = $articulo;
    }

    /*
        método: delete()
        descripcion: permite eliminar un artículo de la tabla

        parámetros:
            - $indice - índice de la tabla en la que se encuentra el artículo
    */
    public function delete($indice){
        unset($this->tabla[$indice]);
    }
}
