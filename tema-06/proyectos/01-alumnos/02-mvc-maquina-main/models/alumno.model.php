<?php

/*
    alumnoModel.php

    Modelo del controlador alumno

    Métodos:

        - get() 

*/

class alumnoModel extends Model
{

    /*
        método: get()
        Entre los detalles de la tabla alumnos
    */

    public function get()
    {

        try {

            $sql = "SELECT
            alumnos.id,
            CONCAT_WS(', ', alumnos.apellidos, alumnos.nombre) AS alumno,
            alumnos.apellidos,
            alumnos.email,
            alumnos.telefono,
            alumnos.nacionalidad,
            alumnos.dni,
            TIMESTAMPDIFF(YEAR, alumnos.fechaNac, NOW()) as edad,
            cursos.nombreCorto as curso
        from
            alumnos
        inner join
            cursos
        on alumnos.id_curso = cursos.id
        ORDER BY alumnos.id";

        // conectamos con la base de datos
        $conexion = $this->db->connect();

        // ejecuto prepare 
        $stmt = $conexion->prepare($sql);

        // establezco el tipo de fetch
        $stmt->setFetchMode(PDO::FETCH_OBJ);

        // ejecutamos 
        $stmt->execute();

        // devuelvo objeto pdostatement
        return $stmt;

        } catch (PDOException $e) {
            
            // error base de datos
            require "template/partials/errorDB.partial.php";
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }

    }

}