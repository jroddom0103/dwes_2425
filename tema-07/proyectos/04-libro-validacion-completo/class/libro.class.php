<?php

    /*
        Creamos una clase para cada tabla
        las propiedades públicas y una propiedad para cada columna

        No respetará la propiedad de encapsulamiento.
    */

    class classLibro {

        public $id;
        public $titulo;
        public $autor;
        public $editorial;
        public $generos;
        public $stock;
        public $precio;

        public function __construct(
            $id = null,
            $titulo = null,
            $autor = null,
            $editorial = null,
            $generos = null,
            $stock = null,
            $precio = null
        ) {
            $this->id = $id;
            $this->titulo = $titulo;
            $this->autor = $autor;
            $this->editorial = $editorial;
            $this->generos = $generos;
            $this->stock = $stock;
            $this->precio = $precio;
        }
        
    }