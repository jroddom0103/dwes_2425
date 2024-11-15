<?php

class Class_profesor
{

    public $id;
    public $nombre;
    public $apellidos;
    public $nrp;
    public $fecha_nacimiento;
    public $poblacion;
    public $especialidad;
    public $asignaturas;

    public function __construct(

        $id = null,
        $nombre = null,
        $apellidos = null,
        $nrp = null,
        $fecha_nacimiento = null,
        $poblacion = null,
        $especialidad = null,
        $asignaturas = []
    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->nrp = $nrp;
        $this->fecha_nacimiento = $fecha_nacimiento;
        $this->poblacion = $poblacion;
        $this->especialidad = $especialidad;
        $this->asignaturas = $asignaturas;
    }


    public function getEdad($fecha_nacimiento)
    {
        $fecha_nacimiento = new DateTime($fecha_nacimiento);
        $hoy = new DateTime();
        $edad = $hoy->diff($fecha_nacimiento);

        return $edad->y;
    }


}