<?php

/*
    Clase: class.vehiculo.php
    Descripcion: definición de la clase vehículo
    Autor:
    Versión: 
    Fecha:
*/

class Class_vehiculo
{

    # Propiedades o atributos de la clase
    public $matricula;
    public $velocidad;

    # Métodos o funciones
    // Constructor.
    // Método que se ejecuta automáticamente cuando se crea un objeto a partir de dicha clase
    public function __construct(
        $matricula = null,
        $velocidad = null
    )
    {
        $this->matricula = $matricula;
        $this->velocidad = $velocidad;
    }

    # Método que devuelve la propiedad matrícula
    public function getMatricula()
    {
        return $this->matricula;
    }

    # Método que devuelve la propiedad velocidad
    public function getVelocidad()
    {
        return $this->velocidad;
    }

    # Método que establece la propiedad matrícula
    public function setMatricula($matricula)
    {
        $this->matricula = $matricula;
    }

    # Método que establece la propiedad velocidad
    public function setVelocidad($velocidad)
    {
        $this->velocidad = $velocidad;
    }

    # Método que aumenta la velocidad
    public function aumentarVelocidad()
    {
        $this->velocidad++;
    }

    # Método que disminuye la velocidad
    public function disminuirVelocidad()
    {
        $this->velocidad--;
    }

    public function parar()
    {
        $this->velocidad = 0;
    }

     # Método destructor
    // No se suele utilizar. PHP gestiona bastante bien la liberación de recursos una vez que ofrece la respuesta.
    public  function __destruct(){
        echo "Objeto destruido correctamente...";
    }
}