<?php

/*
    libroModel.php

    Modelo del controlador libro

    Métodos:

        - get()
*/

class libroModel extends Model
{

    /*
        método: get()

        Extre los detalles de la tabla libros
    */
    public function get()
    {

        try {

            // sentencia sql
            $sql = "SELECT 
                libros.id,
                libros.titulo,
                autores.nombre as autor,
                editoriales.nombre as editorial,
                GROUP_CONCAT(generos.tema ORDER BY generos.tema ASC SEPARATOR ', ') as generos,
                libros.stock,
                libros.precio
            FROM 
                libros
            INNER JOIN
                autores
            ON libros.autor_id = autores.id
            INNER JOIN
                editoriales
            ON libros.editorial_id = editoriales.id
            LEFT JOIN
                generos
            ON FIND_IN_SET(generos.id, libros.generos_id)
            GROUP BY libros.id
            ORDER BY libros.id";

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // establezco tipo fetch
            $stmt->setFetchMode(PDO::FETCH_OBJ);

            // ejecutamos
            $stmt->execute();

            // devuelvo objeto stmtatement
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
       método: get_generos()

       Extre los detalles de los generos para generar lista desplegable 
       dinámica
   */
    public function get_generos()
    {

        try {

            // sentencia sql
            $sql = "SELECT 
                        id,
                        tema as genero
                    FROM 
                        generos
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

            // devuelvo objeto stmtatement
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
        método: create

        descripción: añade nuevo libro
        parámetros: objeto de classLibro
    */

    public function create(classLibro $libro)
    {

        try {
            $sql = "INSERT INTO Libros (
                    id,
                    titulo,
                    email,
                    telefono,
                    nacionalidad,
                    dni,
                    fechaNac,
                    id_curso
                )
                VALUES (
                    :nombre,
                    :apellidos,
                    :email,
                    :telefono,
                    :nacionalidad,
                    :dni,
                    :fechaNac,
                    :id_curso
                )
            ";
            # Conectar con la base de datos
            $conexion = $this->db->connect();


            $stmt = $conexion->prepare($sql);

            $stmt->bindParam(':nombre', $libro->nombre, PDO::PARAM_STR, 30);
            $stmt->bindParam(':apellidos', $libro->apellidos, PDO::PARAM_STR, 50);
            $stmt->bindParam(':email', $libro->email, PDO::PARAM_STR, 50);
            $stmt->bindParam(':telefono', $libro->telefono, PDO::PARAM_STR, 13);
            $stmt->bindParam(':nacionalidad', $libro->nacionalidad, PDO::PARAM_STR, 30);
            $stmt->bindParam(':dni', $libro->dni, PDO::PARAM_STR, 9);
            $stmt->bindParam(':fechaNac', $libro->fechaNac, PDO::PARAM_STR);
            $stmt->bindParam(':id_curso', $libro->id_curso, PDO::PARAM_INT);


            // añado alumno
            $stmt->execute();
        } catch (PDOException $e) {
            // error base de datos
            require_once 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }

    /*
        método: read

        descripción: obtiene los detalles de un libro
        parámetros: id del libro
        devuelve: objeto con los detalles del libro
        
    */

    public function read(int $id)
    {

        try {
            $sql = "SELECT 
                libros.id,
                libros.titulo, 
                autores.nombre as autor,
                editoriales.nombre as editorial,
                libros.generos_id,
                libros.stock,
                libros.precio
            FROM 
                libros
            INNER JOIN
                autores
            ON libros.autor_id = autores.id
            INNER JOIN
                editoriales
            ON libros.editorial_id = editoriales.id
            WHERE
                libros.id = :id
            GROUP BY 
                libros.id
            LIMIT 1";

            # Conectar con la base de datos
            $conexion = $this->db->connect();

            $stmt = $conexion->prepare($sql);

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $stmt->execute();

            return $stmt->fetch();
        } catch (PDOException $e) {
            // // error base de datos
            require_once 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
            exit();

        }
    }

    /*
        método: update

        descripción: actualiza los detalles de un libro

        @param:
            - objeto de classLibro
            - id del libro
    */

    public function update(classLibro $libro, $id)
    {

        try {

            $sql = "
            
            UPDATE libros
            SET
                    nombre = :nombre,
                    apellidos = :apellidos,
                    email = :email,
                    telefono = :telefono,
                    nacionalidad = :nacionalidad,
                    dni = :dni,
                    fechaNac = :fechaNac,
                    id_curso = :id_curso
            WHERE
                    id = :id
            LIMIT 1
            ";

            $conexion = $this->db->connect();

            $stmt = $conexion->prepare($sql);

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $stmt->bindParam(':nombre', $libro->nombre, PDO::PARAM_STR, 30);
            $stmt->bindParam(':apellidos', $libro->apellidos, PDO::PARAM_STR, 50);
            $stmt->bindParam(':email', $libro->email, PDO::PARAM_STR, 50);
            $stmt->bindParam(':telefono', $libro->telefono, PDO::PARAM_STR, 9);
            $stmt->bindParam(':nacionalidad', $libro->nacionalidad, PDO::PARAM_STR, 30);
            $stmt->bindParam(':dni', $libro->dni, PDO::PARAM_STR, 9);
            $stmt->bindParam(':fechaNac', $libro->fechaNac, PDO::PARAM_STR);
            $stmt->bindParam(':id_curso', $libro->id_curso, PDO::PARAM_INT);

            $stmt->execute();
        } catch (PDOException $e) {
            // error base de datos
            require_once 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
            exit();
        }
    }

    /*
        método: delete

        descripción: elimina un libro

        @param: id del libro
    */

    public function delete(int $id)
    {

        try {

            $sql = "
                DELETE FROM libros
                WHERE id = :id
                LIMIT 1
            ";

            $conexion = $this->db->connect();

            $stmt = $conexion->prepare($sql);

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $stmt->execute();
        } catch (PDOException $e) {
            // error base de datos
            require_once 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
            exit();
        }
    }

    /*
        método: filter

        descripción: filtra los alumnos por una expresión

        @param: expresión a buscar
    */
    public function filter($expresion)
    {
        try {
            $sql = "

            SELECT 
                alumnos.id,
                concat_ws(', ', alumnos.apellidos, alumnos.nombre) alumno,
                alumnos.email,
                alumnos.telefono,
                alumnos.nacionalidad,
                alumnos.dni,
                timestampdiff(YEAR,  alumnos.fechaNac, NOW() ) edad,
                cursos.nombreCorto curso
            FROM
                libros
            INNER JOIN
                autores
            ON 
                autores.id = libros.autor_id
            INNER JOIN
                editoriales
            ON
                editoriales.id = libros.editorial_id
            INNER JOIN
                generos
            ON
                FIND_IN_SET(generos.id, libros.generos_id) > 0
            GROUP BY
                libros.id
            HAVING
                CONCAT_WS(
                    ', ',
                    libros.id,
                    libros.titulo,
                    autor,
                    editorial,
                    generos_nombres,
                    libros.stock,
                    libros.precio,
                    libros.fecha_edicion,
                    libros.isbn
                
                
                )            
                LIKE :expresion
            ORDER BY
                libros.id               
            ";

            # Conectar con la base de datos
            $conexion = $this->db->connect();

            $stmt = $conexion->prepare($sql);

            $stmt->bindValue(':expresion', '%' . $expresion . '%', PDO::PARAM_STR);
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {

            // error base de datos
            require_once 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
            exit();
        }
    }

    /*
        método: order

        descripción: ordena los alumnos por un campo

        @param: campo por el que ordenar
    */
    public function order(int $criterio)
    {

        try {

            # comando sql
            $sql = "
            SELECT 
                alumnos.id,
                concat_ws(', ', alumnos.apellidos, alumnos.nombre) alumno,
                alumnos.email,
                alumnos.telefono,
                alumnos.nacionalidad,
                alumnos.dni,
                timestampdiff(YEAR,  alumnos.fechaNac, NOW() ) edad,
                cursos.nombreCorto curso
            FROM
                libros
            INNER JOIN
                cursos
            ON 
                alumnos.id_curso = cursos.id
            ORDER BY 
                :criterio
            ";

            # conectamos con la base de datos

            // $this->db es un objeto de la clase database
            // ejecuto el método connect de esa clase

            $conexion = $this->db->connect();

            # ejecutamos mediante prepare
            $stmt = $conexion->prepare($sql);

            $stmt->bindParam(':criterio', $criterio, PDO::PARAM_INT);

            # establecemos  tipo fetch
            $stmt->setFetchMode(PDO::FETCH_OBJ);

            #  ejecutamos 
            $stmt->execute();

            # devuelvo objeto stmtatement
            return $stmt;

        } catch (PDOException $e) {

            // error base de datos
            require_once 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
            exit();

        }
    }
}
