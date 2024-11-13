<?php

/*
    clase: class.tabla_alumnos.php
    descripcion: define la clase que va a contener el array de objetos de la clase alumnos.
*/

class Class_tabla_alumnos
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

    public function getCursos()
    {
        $cursos = [
            '1SMR',
            '2SMR',
            '1DAW',
            '2DAW',
            '1AD',
            '2AD'
        ];

        asort($cursos);
        return $cursos;
    }
    public function getAsignaturas()
    {
        $asignaturas = [
            'DWES',
            'DWEC',
            'Despliegue Aplicaciones',
            'HLC',
            'EINEM',
            'Diseño Interfaces',
            'Bases de Datos',
            'Entornos de desarrollo',
            'Formación y orientación laboral',
            'Lenguaje de marcas y sistemas de gestión de la información',
            'Programación',
            'Sistemas Informáticos',
            'Montaje y mantenimiento de equipos',
            'Redes locales',
            'Aplicaciones ofimáticas',
            'Sistemas operativos monopuesto',
            'Aplicaciones web',
            'Formación en centros de trabajo',
            'Seguridad informática',
            'Servicios en red',
            'Sistemas operativos en red'
        ];

        asort($asignaturas);

        return $asignaturas;
    }

    /*
        método: getDatos()
        descripcion: devuelve un array de objetos
    */

    public function getDatos()
    {

        # Articulo 1
        $alumno = new Class_alumno(
            1,
            'Carlos',
            'García López',
            'carlos_garcia@gmail.com',
            '2005-04-15',
            3,
            [0,1,2,3,4,5]
        );

        # Añado el objeto a la tabla
        $this->tabla[] = $alumno;

        # Articulo 2
        $alumno = new Class_alumno(
            2,
            'Laura',
            'Martínez Sánchez',
            'laura_martinez@gmail.com',
            '2006-08-23',
            2,
            [6,7,8,9,10,11]
        );

        # Añadir artículo a la tabla
        $this->tabla[] = $alumno;

        # Articulo 3
        $alumno = new Class_alumno(
            3,
            'Miguel',
            'Fernández Ruiz',
            'miguel_fernandez@gmail.com',
            '2007-01-12',
            0,
            [8,12,13,14,15]
        );

        # Añadir artículo a la tabla
        $this->tabla[] = $alumno;

        # Articulo 4
        $alumno = new Class_alumno(
            4,
            'Ana',
            'López Gómez',
            'lopez_gomez@gmail.com',
            '2005-11-29',
            1,
            [3,4,16,17,18,19,20]
        );

        # Añadir artículo a la tabla
        $this->tabla[] = $alumno;
    }

    /*
        método: mostrar_nombre_categorias()
        descripción: devuelve un array con el nombre de las categorías
        parámetros:
            - indice_categorias
    */

    public function mostrar_nombre_asignaturas($indice_asignaturas = [])
    {
        # creo array de nombre de categorías vacío
        $nombre_asignaturas = [];

        # cargo el array de categorias de los alumnos
        $asignaturas_alumnos = $this->getAsignaturas();

        foreach ($indice_asignaturas as $indice_asignatura) {
            $nombre_asignaturas[] = $asignaturas_alumnos[$indice_asignatura];
        }

        # Ordeno
        asort($nombre_asignaturas);
        return $nombre_asignaturas;
    }

    /*
        método: create()
        descripcion: permite añadir un objeto de la clase artículo a la tabla
        parámetros:

            - $alumno - objeto de la clase alumnos

    */
    public function create(Class_alumno $alumno)
    {
        $this->tabla[] = $alumno;
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
            - $alumno - objeto de la clase artículo, con los detalles actualizados de dicho artículo
            - $indice - índice de la tabla
    */
    public function update(Class_alumno $alumno, $indice){
        $this->tabla[$indice] = $alumno;
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
