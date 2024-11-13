<?php

/*
    clase: class.tabla_libros.php
    descripcion: define la clase que va a contener el array de objetos de la clase libros.
*/

class Class_tabla_libros
{

    public $tabla;

    public function __construct()
    {
        $this->tabla = [];
    }

    public function getMaterias()
    {
        $materias = [
            'Literatura Española',
            'Ciencias Sociales',
            'Matemáticas',
            'Ciencias de la Salud',
            'Ingeniería',
            'Tecnología',
            'Humanidades',
            'Artes',
            'Informática',
            'Religión',
            'Otros'
        ];

        asort($materias);
        return $materias;
    }
    public function getEtiquetas()
    {
        $etiquetas = [
            'Antropología',
            'Sociología',
            'Psicología',
            'Economía',
            'Ciencia Política',
            'Derecho',
            'Educación',
            'Geografía',
            'Historia',
            'Ingeniería Civil',
            'Ingeniería Eléctrica',
            'Ingeniería Mecánica',
            'Ingeniería de Sistemas y Computación',
            'Robótica',
            'Inteligencia Artificial',
            'Telecomunicaciones',
            'Filosofía',
            'Teología',
            'Literatura',
            'Lingüística',
            'Historia del Arte',
            'Música',
            'Cine y Medios Audiovisuales',
            'Idiomas y Filología'
        ];

        asort($etiquetas);

        return $etiquetas;
    }

    /*
        método: getDatos()
        descripcion: devuelve un array de objetos
    */

    public function getDatos()
    {

        # Libro 1
        $libro = new Class_libro(
            1,
            'El Principito',
            'Antoine de Saint-Exupéry',
            'Seix Barral',
            1943,
            1,
            [1, 2],
            10.99
        );

        # Añado el objeto a la tabla
        $this->tabla[] = $libro;

        # Libro 2
        $libro = new Class_libro(
            2,
            'El Ingenioso Hidalgo Don Quijote de la Mancha',
            'Miguel de Cervantes',
            'Alianza Editorial',
            2004,
            0,
            [18],
            18.50
        );

        # Añado el objeto a la tabla
        $this->tabla[] = $libro;

        # Libro 3
        $libro = new Class_libro(
            3,
            'La Sombra del Ciprés',
            'Carlos Ruiz Zafón',
            'Planeta',
            2001,
            0,
            [18],
            12.99
        );

        # Añado el objeto a la tabla
        $this->tabla[] = $libro;

        # Libro 4
        $libro = new Class_libro(
            4,
            'Fundamentos de la Economía',
            'Luis Pérez',
            'Pearson',
            2019 - 03 - 20,
            2,
            [3, 4, 5],
            25.50
        );

        # Añado el objeto a la tabla
        $this->tabla[] = $libro;

        # Libro 5
        $libro = new Class_libro(
            5,
            'Historia de la Filosofía',
            'María García',
            'Planeta',
            2018 - 11 - 03,
            2,
            [8, 9, 12],
            39.95
        );

        # Añado el objeto a la tabla
        $this->tabla[] = $libro;
    }

    /*
        método: mostrar_nombre_categorias()
        descripción: devuelve un array con el nombre de las categorías
        parámetros:
            - indice_categorias
    */

    public function mostrar_nombre_etiquetas($indice_etiquetas = [])
    {
        # creo array de nombre de categorías vacío
        $nombre_etiquetas = [];

        # cargo el array de categorias de los artículos
        $etiquetas_libros = $this->getEtiquetas();

        foreach ($indice_etiquetas as $indice_etiqueta) {
            $nombre_etiquetas[] = $etiquetas_libros[$indice_etiqueta];
        }

        # Ordeno
        asort($nombre_etiquetas);
        return $nombre_etiquetas;
    }

    /*
        método: create()
        descripcion: permite añadir un objeto de la clase artículo a la tabla
        parámetros:

            - $articulo - objeto de la clase artículos

    */
    public function create(Class_libro $libro)
    {
        $this->tabla[] = $libro;
    }

    /*
        método: read()
        descripcion: permite obtener el objeto de la clase libro a partir de un índice
        de la tabla

        parámetros:

            - $indice - índice de la tabla
    */
    public function read($indice)
    {
        return $this->tabla[$indice];
    }

    /*
        método: update()
        descripcion: permite actualizar los detalles de un libro en la tabla

        parámetros:

            - $libro - objeto de la clase libro, con los detalles actualizados de dicho artículo
            - $indice - índice de la tabla
    */
    public function update(Class_libro $libro, $indice)
    {
        $this->tabla[$indice] = $libro;
    }


    /*
        método: delete()
        descripcion: permite eliminar un libro de la tabla

        parámetros:

            - $indice - índice de la tabla en la que se encuentra el libro
    */
    public function delete($indice)
    {
        unset($this->tabla[$indice]);
    }
}
