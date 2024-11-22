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
        $result = $this->mysqli->query($sql);

        // Obtengo un objeto de la clase mysqli_result
        // Devuelvo dicho objeto
        return $result;

    }
}
