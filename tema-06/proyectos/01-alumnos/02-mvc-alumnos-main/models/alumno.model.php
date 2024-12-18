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

        Extre los detalles de la tabla alumnos
    */
    public function get()
    {

        try {

            // sentencia sql
            $sql = "SELECT 
                alumnos.id,
                CONCAT_WS(', ', alumnos.apellidos, alumnos.nombre) as alumno,
                alumnos.email,
                alumnos.telefono,
                alumnos.nacionalidad,
                alumnos.dni,
                timestampdiff(YEAR, alumnos.fechaNac, now()) as edad,
                cursos.nombreCorto as curso
            FROM 
                alumnos 
            INNER JOIN
                cursos
            ON alumnos.id_curso = cursos.id
            ORDER BY alumnos.id";

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // establezco tipo fetch
            $stmt->setFetchMode(PDO::FETCH_OBJ);

            // ejecutamos
            $stmt->execute();

            // devuelvo objeto pdostatement
            return $stmt;


        } catch (PDOException $e) {

            // error base de datos
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }

    }

    /*
       método: get_cursos()

       Extre los detalles de los cursos para generar lista desplegable 
       dinámica
   */
    public function get_cursos()
    {

        try {

            // sentencia sql
            $sql = "SELECT 
                        id,
                        nombre as curso
                    FROM 
                        cursos
                    ORDER BY
                        2
            ";

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // establezco tipo fetch
            $stmt->setFetchMode(PDO::FETCH_KEY_PAIR);

            // ejecutamos
            $stmt->execute();

            // devuelvo objeto pdostatement
            return $stmt->fetchAll();


        } catch (PDOException $e) {

            // error base de datos
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }

    }

    /*
        método: create()
        descripción: añade nuevo alumno
    */

    public function create(Class_alumno $alumno)
    {

        try {

            $sql = "INSERT INTO alumnos (
            nombre, apellidos, email, telefono, dni, nacionalidad, fechaNac, id_curso
        ) VALUES (
            :nombre, :apellidos, :email, :telefono, :dni, :nacionalidad, :fechaNac, :id_curso
        )";

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare 
            $stmt = $conexion->prepare($sql);

            // hago el bind_param
            $stmt->bindParam(':nombre', $alumno->nombre, PDO::PARAM_STR, 30);
            $stmt->bindParam(':apellidos', $alumno->apellidos, PDO::PARAM_STR, 50);
            $stmt->bindParam(':email', $alumno->email, PDO::PARAM_STR, 50);
            $stmt->bindParam(':telefono', $alumno->telefono, PDO::PARAM_STR, 13);
            $stmt->bindParam(':dni', $alumno->dni, PDO::PARAM_STR, 9);
            $stmt->bindParam(':nacionalidad', $alumno->nacionalidad, PDO::PARAM_STR, 30);     
            $stmt->bindParam(':fechaNac', $alumno->fechaNac, PDO::PARAM_STR);
            $stmt->bindParam(':id_curso', $alumno->id_curso, PDO::PARAM_INT);

            // ejecutamos 
            $stmt->execute();

        } catch (PDOException $e) {

            // error base de datos
            require "template/partials/errorDB.partial.php";
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }

    }


}