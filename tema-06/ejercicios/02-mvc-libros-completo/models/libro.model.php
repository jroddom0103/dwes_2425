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

        Extrae los detalles de la tabla libros
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
                autores ON libros.autor_id = autores.id
            INNER JOIN
                editoriales ON libros.editorial_id = editoriales.id
            LEFT JOIN
                generos ON FIND_IN_SET(generos.id, libros.generos_id)
            GROUP BY 
                libros.id, libros.titulo, autores.nombre, editoriales.nombre, libros.stock, libros.precio
            ORDER BY 
                libros.id";

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // establezco tipo fetch
            $stmt->setFetchMode(PDO::FETCH_OBJ);

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
        método: get_generos

        Extrae todos los géneros
    */
    public function get_generos()
    {
        try {
            $sql = "SELECT 
                        id,
                        tema 
                    FROM 
                        generos 
                    ORDER BY 
                        tema 
                    ASC";
            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
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
        $sql = "INSERT INTO libros (
                    titulo,
                    autor_id,
                    editorial_id,
                    generos_id,
                    stock,
                    precio
                ) VALUES (
                    :titulo,
                    :autor,
                    :editorial,
                    :generos_id,
                    :stock,
                    :precio
                )";

        # Conectar con la base de datos
        $conexion = $this->db->connect();
        $stmt = $conexion->prepare($sql);

        $stmt->bindParam(':titulo', $libro->titulo, PDO::PARAM_STR);
        $stmt->bindParam(':autor', $libro->autor, PDO::PARAM_INT);
        $stmt->bindParam(':editorial', $libro->editorial, PDO::PARAM_INT);
        $stmt->bindParam(':generos_id', $libro->generos, PDO::PARAM_STR);
        $stmt->bindParam(':stock', $libro->stock, PDO::PARAM_INT);
        $stmt->bindParam(':precio', $libro->precio, PDO::PARAM_STR);

        // Añadir libro
        $stmt->execute();
    } catch (PDOException $e) {
        // Error base de datos
        require_once 'template/partials/errorDB.partial.php';
        $stmt = null;
        $conexion = null;
        $this->db = null;
    }
}
    /*
         método: read

         Extrae los detalles de un libro por su ID
     */
    public function read($id)
    {
        try {
            // sentencia sql
            $sql = "SELECT 
                libros.id,
                libros.titulo,
                autores.nombre as autor,
                editoriales.nombre as editorial,
                libros.stock,
                libros.precio
            FROM 
                libros
            INNER JOIN
                autores ON libros.autor_id = autores.id
            INNER JOIN
                editoriales ON libros.editorial_id = editoriales.id
            WHERE 
                libros.id = :id";

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // bindeo el parámetro
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            // establezco tipo fetch
            $stmt->setFetchMode(PDO::FETCH_OBJ);

            // ejecutamos
            $stmt->execute();

            // devuelvo el resultado
            return $stmt->fetch();
        } catch (PDOException $e) {
            // error base de datos
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }
    /*
        método: get_generos_by_libro

        descripción: obtiene los géneros del libro correspondiente

        @param: id del libro
        devuelve: array asociativo con los generos del libro
    */
    public function get_generos_by_libro($libro_id)
    {
        try {
            $sql = "SELECT 
            GROUP_CONCAT(generos.tema ORDER BY generos.tema ASC SEPARATOR ', ') as generos
        FROM 
            generos
        INNER JOIN
            libros
        ON FIND_IN_SET(generos.id, libros.generos_id)
        WHERE 
            libros.id = :libro_id";

            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':libro_id', $libro_id, PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();

            return $stmt->fetch();
        } catch (PDOException $e) {
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }

    /*
        método: get_generos_ids

        descripción: obtiene los IDs de los géneros del libro correspondiente

        @param: id del libro
        devuelve: array con los IDs de los géneros del libro
    */
    public function get_generos_ids($libro_id)
    {
        try {
            $sql = "SELECT 
                        generos.id
                    FROM 
                        generos
                    INNER JOIN
                        libros
                    ON FIND_IN_SET(generos.id, libros.generos_id)
                    WHERE 
                        libros.id = :libro_id";

            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':libro_id', $libro_id, PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_COLUMN, 0);
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (PDOException $e) {
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }

    /*
        método: get_autor_id

        descripción: obtiene el ID del autor correspondiente al libro

        @param: id del libro
        devuelve: ID del autor
        */
    public function get_autor_id($libro_id)
    {
        try {
            $sql = "SELECT autor_id FROM libros WHERE id = :libro_id";
            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':libro_id', $libro_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }

    /*
        método: get_editorial_id

        descripción: obtiene el ID de la editorial correspondiente al libro

        @param: id del libro
        devuelve: ID de la editorial
    */
    public function get_editorial_id($libro_id)
    {
        try {
            $sql = "SELECT editorial_id FROM libros WHERE id = :libro_id";
            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':libro_id', $libro_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }


    /*
        método: update

        descripción: actualiza los detalles de un libro

        @param:
            - objeto de classLibro
            - id del libro
    */

    public function update($libro, $id)
    {
        try {
            $sql = "UPDATE libros SET
                        titulo = :titulo,
                        autor_id = :autor,
                        editorial_id = :editorial,
                        generos_id = :generos_id,
                        stock = :stock,
                        precio = :precio,
                        update_at = CURRENT_TIMESTAMP
                    WHERE id = :id";
    
            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
    
            $stmt->bindParam(':titulo', $libro->titulo, PDO::PARAM_STR);
            $stmt->bindParam(':autor', $libro->autor, PDO::PARAM_INT);
            $stmt->bindParam(':editorial', $libro->editorial, PDO::PARAM_INT);
            $stmt->bindParam(':generos_id', $libro->generos, PDO::PARAM_STR);
            $stmt->bindParam(':stock', $libro->stock, PDO::PARAM_INT);
            $stmt->bindParam(':precio', $libro->precio, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

        } catch (PDOException $e) {
            // Mostrar el error de la base de datos
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }
    /*
        método: get_autores

        Extrae todos los nombres de los autores
    */
    public function get_autores()
    {
        try {
            // sentencia sql
            $sql = "SELECT 
                        id,
                        nombre 
                    FROM 
                        autores 
                    ORDER BY 
                        nombre 
                    ASC";

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // establezco tipo fetch
            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            // ejecutamos
            $stmt->execute();

            // devuelvo el resultado como un array
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
        método: get_editoriales

        Extrae todos los nombres de las editoriales
    */
    public function get_editoriales()
    {
        try {
            // sentencia sql
            $sql = "SELECT 
                        id,
                        nombre 
                    FROM 
                        editoriales 
                    ORDER BY 
                        nombre 
                    ASC";

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // establezco tipo fetch
            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            // ejecutamos
            $stmt->execute();

            // devuelvo el resultado como un array
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
