<?php

class Class_tabla_profesores{

    public $tabla;

    public function __construct(){
        $this->tabla = [];
    }

    public function create(Class_profesor $profesor){
        $this->tabla[] = $profesor;
    }

    public function read($indice){
        return $this->tabla[$indice];
    }

    public function update(Class_profesor $profesor, $indice){
        $this->tabla[$indice] = $profesor;
    }

    public function delete($indice){   

        unset($this->tabla[$indice]);

    }

    public function getDatos(){

        $profesor = new Class_profesor(
            1,
            'Juan',
            'García López',
            'NP12345',
            '1990-05-15',
            'Madrid',
            8,
            [0,3,4,7]

        );

        $this->tabla[] = $profesor;

        $profesor = new Class_profesor(
            2,
            'María',
            'Rodríguez García',
            'NP67890',
            '1988-02-28',
            'Barcelona',
            0,
            [16,17,18]

        );

        $this->tabla[] = $profesor;

        $profesor = new Class_profesor(
            3,
            'Ana',
            'Martínez Salguero',
            'NP24680',
            '1992-01-10',
            'Valencia',
            2,
            [13,14,15]

        );

        $this->tabla[] = $profesor;

        $profesor = new Class_profesor(
            4,
            'Carlos',
            'González Paz',
            'NP13579',
            '1985-03-25',
            'Sevilla',
            5,
            [19,20]

        );

        $this->tabla[] = $profesor;

        $profesor = new Class_profesor(
            5,
            'Eva',
            'Eva Sánchez Román',
            'NP35784',
            '1995-08-02',
            'Granada',
            8,
            [1,2,5]

        );

        $this->tabla[] = $profesor;
    }

    public function getEspecialidades(){

        $especialidades = [

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
            'Inglés'

        ];

        asort($especialidades);
        return $especialidades;
    }

    public function getAsignaturas(){

        $asignaturas = [

            'Sistemas Informáticos',
            'Bases de datos',
            'Programación',
            'Lenguajes de marcas y sistemas de gestión de información',
            'Entornos de desarrollo',
            'Desarrollo web en entorno cliente (JavaScript, HTML, CSS)',
            'Desarrollo web en entorno servidor (PHP, Node.js u otros)',
            'Despliegue de aplicaciones web',
            'Diseño de interfaces web',
            'Empresa e iniciativa emprendedora',
            'Formación y orientación laboral (FQL)',
            'Proyecto de desarrollo de aplicaciones web (normalmente al final del ciclo)',
            'Inglés técnico',
            'Álgebra',
            'Cálculo Diferencial',
            'Aritmética',
            'Historia de la Literatura Española',
            'Literatura del Barroco español',
            'Literatura Greco-Latina',
            'Dibujo Técnico',
            'Montaje'
        ];

        asort($asignaturas);
        return $asignaturas;

    }

    public function mostrar_nombre_asignaturas($indice_asignaturas = [])
    {
        # creo array de nombre de categorías vacío
        $nombre_asignaturas = [];

        # cargo el array de categorias de los artículos
        $asignaturas_profesores = $this->getAsignaturas();

        foreach ($indice_asignaturas as $indice_asignatura) {
            $nombre_asignaturas[] = $asignaturas_profesores[$indice_asignatura];
        }

        # Ordeno
        asort($nombre_asignaturas);
        return $nombre_asignaturas;
    }

    
}