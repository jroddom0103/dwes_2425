<?php

/*
        archivo:class.libro.php
        descripcion: define la clase alumno sin encapsulamiento
    */

class Class_alumno
{

        public $id;
        public $nombre;
        public $apellido;
        public $email;
        public $telefono;
        public $nacionalidad;
        public $dni;
        public $fechaNac;
        public $id_curso;

        public function __construct(
                $id = null,
                $nombre = null,
                $apellido = null,
                $email = null,
                $telefono = null,
                $nacionalidad = null,
                $dni = [],
                $fechaNac = null,
                $id_curso = null
        ) {
                $this->id = $id;
                $this->nombre = $nombre;
                $this->apellido = $apellido;
                $this->email = $email;
                $this->telefono = $telefono;
                $this->nacionalidad = $nacionalidad;
                $this->dni = $dni;
                $this->fechaNac = $fechaNac;
                $this->id_curso = $id_curso;
        }

        public function edad(){
                $fechaActual = new DateTime();
                $fechaNacimiento = new DateTime($this->fechaNac);
                $edad = $fechaNacimiento->diff($fechaActual);
                return $edad->y;
        }

}