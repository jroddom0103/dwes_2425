<?php

/*
    clase: class.tabla_alumnos.php
    descripcion: define la clase que va a contener el array de objetos de la clase alumnos.
*/

class Class_tabla_alumnos extends Class_conexion
{

    public function getAlumnos()
    {
        $sql = "
        select
            alumnos.id,
            alumnos.nombre,
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
        on
            alumnos.id_curso = cursos.id
    ";

        // Ejecuto el comando sql
        $result = $this->db->query($sql);

        // Obtengo un objeto de la clase mysqli_result
        // Devuelvo dicho objeto
        return $result;

    }

    /*
        método: create()
        descripcion: permite añadir un objeto de la clase alumno a la tabla

        parámetros:

            - $alumno - objeto de la clase alumno
    */

    public function create(Class_alumno $alumno)
    {
        // Crear la sentencia preparada
        $sql = "
        INSERT INTO
            alumnos(
                nombre,
                apellidos,
                email,
                telefono,
                nacionalidad,
                dni,
                fechaNac,
                id_curso
            )
        VALUES  (?, ?, ?, ?, ?, ?, ?, ?)        
        ";

        // ejecuto la sentencia preparada
        $stmt = $this->db->prepare($sql);

        // verifico la sentencia
        if (!$stmt) {
            die("Error al preparar sql " . $this->db->error);
        }

        // vinculación de parámetros
        $stmt->bind_param(
            'sssisssi',
            $nombre,
            $apellidos,
            $email,
            $telefono,
            $nacionalidad,
            $dni,
            $fechaNac,
            $id_curso
        );

        // asignar valores
        $nombre = $alumno->nombre;
        $apellidos = $alumno->apellidos;
        $email = $alumno->email;
        $telefono = $alumno->telefono;
        $nacionalidad = $alumno->nacionalidad;
        $dni = $alumno->dni;
        $fechaNac = $alumno->fechaNac;
        $id_curso = $alumno->id_curso;

        $stmt->execute();
    }

    /*
        getCursos()

        Método que me devuelve todos los cursos en un array assoc de cursos
    */

    public function getCursos(){
        $sql = "
            SELECT 
                    id, 
                    nombreCorto as curso
            FROM 
                    cursos
            ORDER BY 
                    nombreCorto ASC                
        
        ";
    
        $result = $this->db->query($sql);

        // devuelvo todos los valores de la tabla cursos
        return $result->fetch_all(MYSQLI_ASSOC);
    
    }
}
