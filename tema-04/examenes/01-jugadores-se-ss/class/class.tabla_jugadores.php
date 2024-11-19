<?php

/*
    clase: class.tabla_jugadores.php
    descripcion: define la clase que va a contener el array de objetos de la clase jugadores.
*/

class Class_tabla_jugadores
{

    public $tabla;

    public function __construct()
    {
        $this->tabla = [];
    }

    public function create($jugador)
    {

    }

    public function read($id)
    {
        foreach($this->tabla as $indice=>$valor){
            if($valor['id']==$indice){
                return $valor;
            }
        }
    }

    public function getEquipos()
    {
        $equipos = [
            'Barcelona',
            'Real Madrid',
            'Atlético de Madrid',
            'Sevilla FC',
            'Valencia CF',
            'Athletic Club',
            'Levante UD',
            'Granada CF',
            'Cádiz CF',
            'Elche CF',
            'Málaga CF',
            'Alavés',
            'Celta Vigo',
            'Villarreal CF',
            'Getafe CF',
        ];
        asort($equipos);
        return $equipos;
    }

    public function getPosiciones()
    {
        $posiciones = [
            'Portero',
            'Defensa Central',
            'Lateral Derecho',
            'Lateral Izquierdo',
            'Mediocentro Defensivo',
            'Volante Ofensivo',
            'Delantero Centro',
            'Punta Derecha',
            'Punta Izquierda'
        ];
        asort($posiciones);
        return $posiciones;

    }

    public function get_Datos()
    {

        $jugador1 = [
            'id' => 1,
            'nombre' => 'Lionel Messi',
            'f_nacimiento' => '1987-06-24',
            'altura' => 1.70,
            'peso' => 72,
            'nacionalidad' => 'Argentina',
            'num_camiseta' => 10,
            'valor_mercado' => 50000000,
            'equipo_id' => 1,
            'posiciones_id' => [1, 2]
        ];
        $this->tabla[] = $jugador1;

        $jugador1 = [
            'id' => 2,
            'nombre' => 'Cristiano Ronaldo',
            'f_nacimiento' => '1985-02-05',
            'altura' => 1.87,
            'peso' => 85,
            'nacionalidad' => 'Portugal',
            'num_camiseta' => 7,
            'valor_mercado' => 45000000,
            'equipo_id' => 2,
            'posiciones_id' => [3,4]
        ];
        $this->tabla[] = $jugador1;

        $jugador1 = [
            'id' => 3,
            'nombre' => 'Kylian Mbappé',
            'f_nacimiento' => '1998-12-20',
            'altura' => 175,
            'peso' => 70,
            'nacionalidad' => 'Francia',
            'num_camiseta' => 10,
            'valor_mercado' => 20000000,
            'equipo_id' => 3,
            'posiciones_id' => [6,7]
        ];
        $this->tabla[] = $jugador1;

        $jugador1 = [
            'id' => 4,
            'nombre' => 'Neymar Jr.',
            'f_nacimiento' => '1992-02-05',
            'altura' => 1.75,
            'peso' => 68,
            'nacionalidad' => 'Brasil',
            'num_camiseta' => 10,
            'valor_mercado' => 30000000,
            'equipo_id' => 4,
            'posiciones_id' => [5,4]
        ];
        $this->tabla[] = $jugador1;

        $jugador1 = [
            'id' => 5,
            'nombre' => 'Robert Lewandowski',
            'f_nacimiento' => '1998-08-21',
            'altura' => 1.85,
            'peso' => 80,
            'nacionalidad' => 'Polonia',
            'num_camiseta' => 9,
            'valor_mercado' => 40000000,
            'equipo_id' => 5,
            'posiciones_id' => [7,8]
        ];
        $this->tabla[] = $jugador1;
        return $this->tabla;


    }

    public function mostrar_nombre_posiciones($posiciones)
    {
        $texto_posiciones = "";
        $array_posiciones = $this->getPosiciones();
        foreach ($array_posiciones as $indice => $valor_mercado) {
            if ($posiciones[$indice] == $indice) {
                $texto_posiciones . $valor_mercado . ', ';
            }
        }
        return $texto_posiciones;
    }
}