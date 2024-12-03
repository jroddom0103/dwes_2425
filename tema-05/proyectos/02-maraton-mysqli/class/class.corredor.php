<?php

/*
    archivo: class.corredor.php
    título: define la clase corredor sin encapsulamiento
*/

class Class_corredor
{
    public $id;
    public $nombre;
    public $apellidos;
    public $ciudad;
    public $fechaNacimiento;
    public $sexo;
    public $email;
    public $dni;
    public $edad;
    public $id_categoria;
    public $id_club;

    public function __construct(
        $id = null,
        $nombre = null,
        $apellidos = null,
        $ciudad = null,
        $fechaNacimiento = null,
        $sexo = null,
        $email = null,
        $dni = null,
        $edad = null,
        $id_categoria,
        $id_club = null
    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->ciudad = $ciudad;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->sexo = $sexo;
        $this->email = $email;
        $this->dni = $dni;
        $this->edad = null; 
        $this->id_categoria = $id_categoria;
        $this->id_club = $id_club;
    }

    // Método para calcular la edad
    public function calcularEdad()
    {
        $fechaActual = new DateTime(); // Fecha actual
        $fechaNacimiento = new DateTime($this->fechaNacimiento); // Fecha de nacimiento
        $edad = $fechaNacimiento->diff($fechaActual); // Diferencia entre las fechas
        return $edad->y; // Devuelve solo los años
    }
}