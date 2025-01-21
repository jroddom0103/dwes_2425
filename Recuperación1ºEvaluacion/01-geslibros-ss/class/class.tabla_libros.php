<?php

/*
    clase: class.tabla_libros.php
    descripcion: define la clase que va a contener el array de objetos de la clase libro.
*/


class Class_tabla_libros extends Class_conexion
{


    /*
        método: getLibros()
        descripcion: devuelve un objeto pdostatement con los detalles de los libros
    */

    public function get_libros()
    {
        try {

            $sql = "SELECT 
                libros.id,
                libros.titulo,
                autores.nombre AS autor,
                editoriales.nombre AS editorial,
                libros.fecha_edicion,
                libros.generos_id,
                libros.stock,
                libros.precio
                   FROM 
                libros 
                   INNER JOIN
                autores ON libros.autor_id = autores.id   
                   INNER JOIN 
                editoriales ON libros.editorial_id = editoriales.id   
                   ORDER BY libros.id
            ";

            $stmt = $this->pdo->prepare($sql);

            $stmt->setFetchMode(PDO::FETCH_OBJ);

            $stmt->execute();

            return $stmt;

        } catch (PDOException $e) {

            //error de base de datos
            include 'views/partials/errorDB.php';

            //libero pdostatement
            $stmt = null;

            //cierro conexión
            $this->pdo = null;

            //cancelo ejecución programa
            exit();
        }
    }

    /*
        método: get_generos()
        descripcion: devuelve un array clave valor con la tabla géneros
    */

    public function get_generos()
    {
        try {

            $sql = "
        SELECT 
            id, 
            tema as genero
        FROM 
            generos
        ORDER BY
            id
    ";

            $result = $this->pdo->query($sql);

            $result->setFetchMode(PDO::FETCH_ASSOC);

            $generos = [];
            while ($row = $result->fetch()) {
                $generos[$row['id']] = $row['genero'];
            }

            return $generos;


        } catch (PDOException $e) {

            //error de base de datos
            include 'views/partials/errorDB.php';

            //libero pdostatement
            $stmt = null;

            //cierro conexión
            $this->pdo = null;

            //cancelo ejecución programa
            exit();

        }

    }


    /*
        método: get_generos_asociados()
        descripcion: devuelve un array con los géneros asociados a un libro

        Parámetros:
        - $generos_id - lista indice de géneros asociados a un libro
    */

    public function get_generos_asociados($generos_id)
    {
        try {
            $sql = "SELECT 
                    id, 
                    tema AS genero
                FROM 
                    generos
                WHERE 
                    FIND_IN_SET(id, :generos_id)
                ";

            $stmt = $this->pdo->prepare($sql);

            $stmt->bindParam(':generos_id', $generos_id, PDO::PARAM_STR);

            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            $stmt->execute();

            $generos_asociados = [];
            while ($row = $stmt->fetch()) {
                $generos_asociados[$row['id']] = $row['genero'];
            }

            return $generos_asociados;

        } catch (PDOException $e) {

            //error de base de datos
            include 'views/partials/errorDB.php';

            //libero pdostatement
            $stmt = null;

            //cierro conexión
            $this->pdo = null;

            //cancelo ejecución programa
            exit();

        }
    }

    /*
        método: get_autores()
        descripcion: devuelve un pdostatement par clave valor
    */

    public function get_autores()
    {
        try {

            $sql = "
        SELECT 
            id, 
            autores.nombre AS autor
        FROM 
            autores
        ORDER BY
            id
    ";

            $result = $this->pdo->query($sql);

            $result->setFetchMode(PDO::FETCH_ASSOC);

            $autores = [];
            while ($row = $result->fetch()) {
                $autores[$row['id']] = $row['autor'];
            }

            return $autores;


        } catch (PDOException $e) {

            //error de base de datos
            include 'views/partials/errorDB.php';

            //libero pdostatement
            $stmt = null;

            //cierro conexión
            $this->pdo = null;

            //cancelo ejecución programa
            exit();

        }
    }

    /*
        método: get_editoriales()
        descripcion: devuelve un pdostatement par clave valor
    */

    public function get_editoriales()
    {
        try {

            $sql = "SELECT 
            id, 
            editoriales.nombre AS editorial
        FROM 
            editoriales
        ORDER BY
            id
    ";

            $result = $this->pdo->query($sql);

            $result->setFetchMode(PDO::FETCH_ASSOC);

            $editoriales = [];
            while ($row = $result->fetch()) {
                $editoriales[$row['id']] = $row['editorial'];
            }

            return $editoriales;


        } catch (PDOException $e) {

            //error de base de datos
            include 'views/partials/errorDB.php';

            //libero pdostatement
            $stmt = null;

            //cierro conexión
            $this->pdo = null;

            //cancelo ejecución programa
            exit();

        }
    }

    /*
        método: create()
        descripcion: permite añadir un nuevo libro a la tabla
        
        parámetros:

            - $libro - objeto de la clase libro

    */
    public function create($libro)
    {
        try {
            $sql = "INSERT INTO 
            libros( 
                id,
                titulo,
                precio,
                stock,
                fecha_edicion,
                isbn,
                autor_id,
                editorial_id,
                generos_id
            )
         VALUES    (
                :id,
                :titulo,
                :precio,
                :stock,
                :fecha_edicion,
                :isbn,
                :autor_id,
                :editorial_id,
                :generos_id
            )                            
        ";

            // Objeto de la clase pdostatement
            $stmt = $this->pdo->prepare($sql);

            // vinculación de parámetros con las propiedades del objeto
            $stmt->bindParam(':id', $libro->id, PDO::PARAM_STR, 20);
            $stmt->bindParam(':titulo', $libro->titulo, PDO::PARAM_STR);
            $stmt->bindParam(':precio', $libro->precio, PDO::PARAM_STR);
            $stmt->bindParam(':stock', $libro->stock, PDO::PARAM_STR);
            $stmt->bindParam(':fecha_edicion', $libro->fecha_edicion, PDO::PARAM_STR);
            $stmt->bindParam(':isbn', $libro->isbn, PDO::PARAM_INT);
            $stmt->bindParam(':autor_id', $libro->autor_id, PDO::PARAM_INT);
            $stmt->bindParam(':editorial_id', $libro->editorial_id, PDO::PARAM_INT);
            $stmt->bindParam(':generos_id', $libro->generos_id, PDO::PARAM_INT);

            // ejecutamos
            $stmt->execute();


        } catch (PDOException $e) {

            //error de base de datos
            include 'views/partials/errorDB.php';

            //libero pdostatement
            $stmt = null;

            //cierro conexión
            $this->pdo = null;

            //cancelo ejecución programa
            exit();

        }
    }

    /*
        método: read($indice)
        descripcion: devuelve un objeto de la clase pdostatement con los 
        detalles del libro correspondiente al índice pasado por parámetros.

        Parámetros:

            - indice: índice del libro a leer
    */

    public function read($indice)
    {

        try {

            $sql = "SELECT
                        libros.id,
                        libros.titulo,
                        libros.precio,
                        libros.stock,
                        libros.fecha_edicion,
                        libros.isbn,
                        autores.nombre AS autor,
                        editoriales.nombre AS editorial,
                        generos_id
                    FROM libros
                    INNER JOIN
                autores ON libros.autor_id = autores.id  
                    INNER JOIN 
                editoriales ON libros.editorial_id = editoriales.id   
                    WHERE libros.id = $indice
                    LIMIT 1;"
            ;

            $stmt = $this->pdo->prepare($sql);

            $stmt->setFetchMode(PDO::FETCH_OBJ);

            $stmt->execute();

            return $stmt->fetch();


        } catch (PDOException $e) {

            //error de base de datos
            include 'views/partials/errorDB.php';

            //libero pdostatement
            $stmt = null;

            //cierro conexión
            $this->pdo = null;

            //cancelo ejecución programa
            exit();
        }

    }

    /*
        método: update()
        descripcion: actualiza los datos del libro
    */

    public function update($libro, $id)
    {
        try {

            $sql = "UPDATE libros SET
                titulo = :titulo,
                autor_id = :autor_id,
                editorial_id = :editorial_id,
                fecha_edicion = :fecha_edicion,
                isbn = :isbn,
                precio = :precio,
                stock = :stock,
                generos_id = :generos_id
                
                where id = :id;
            ";

            $stmt = $this->pdo->prepare($sql);

            // vinculación de parámetros con las propiedades del objeto
            $stmt->bindParam(':id', $id, PDO::PARAM_INT, 20);
            $stmt->bindParam(':titulo', $libro->titulo, PDO::PARAM_STR);
            $stmt->bindParam(':autor_id', $libro->autor_id, PDO::PARAM_INT);
            $stmt->bindParam(':editorial_id', $libro->editorial_id, PDO::PARAM_INT);
            $stmt->bindParam(':fecha_edicion', $libro->fecha_edicion, PDO::PARAM_STR);
            $stmt->bindParam(':isbn', $libro->isbn, PDO::PARAM_INT);     
            $stmt->bindParam(':precio', $libro->precio, PDO::PARAM_STR);
            $stmt->bindParam(':stock', $libro->stock, PDO::PARAM_INT);
            $stmt->bindParam(':generos_id', $libro->generos_id, PDO::PARAM_STR);

            if ($stmt->execute()) {
                return true;
            } else {
                // Aquí podrías mostrar un mensaje de error
                return false;
            }
        } catch (PDOException $e) {

            //error de base de datos
            include 'views/partials/errorDB.php';

            //libero pdostatement
            $stmt = null;

            //cierro conexión
            $this->pdo = null;

            //cancelo ejecución programa
            exit();
        }
    }

    /*
       método: delete($indice)
       descripcion: elimina el libro correspondiete al índice enviado

       Parámetros:

           - indice: indice del libro a eliminar
   */

    public function delete($indice)
    {

        try {

            $sql = "DELETE
                    FROM libros
                    WHERE libros.id = $indice;"
            ;

            $stmt = $this->pdo->prepare($sql);


            $stmt->execute();


        } catch (PDOException $e) {

            //error de base de datos
            include 'views/partials/errorDB.php';

            //libero pdostatement
            $stmt = null;

            //cierro conexión
            $this->pdo = null;

            //cancelo ejecución programa
            exit();
        }

    }

    /*
        método: order()
        descripcion: devuelve un objeto de la clase pdostatement con los 
        detalles de los libros  ordenados por un criterio.

        Parámetros:

            - criterio: posición de la columna en la tabla libros
                        por la que quiero ordenar
    */

    public function order($criterio)
    {

        $criterios = array(
            1 => "id",
            2 => "titulo",
            3 => "autor",
            4 => "editorial",
            5 => "generos_id",
            6 => "stock",
            7 => "precio"
        );

        $valor = $criterios[$criterio];

        try {

            $sql = "SELECT 
                libros.id,
                libros.titulo,
                autores.nombre AS autor,
                editoriales.nombre AS editorial,
                libros.fecha_edicion,
                libros.generos_id,
                libros.stock,
                libros.precio
                   FROM 
                libros 
                   INNER JOIN
                autores ON libros.autor_id = autores.id   
                   INNER JOIN 
                editoriales ON libros.editorial_id = editoriales.id   
                   ORDER BY $valor;
            ";

            $stmt = $this->pdo->prepare($sql);

            $stmt->setFetchMode(PDO::FETCH_OBJ);

            $stmt->execute();

            return $stmt;

        } catch (PDOException $e) {

            //error de base de datos
            include 'views/partials/errorDB.php';

            //libero pdostatement
            $stmt = null;

            //cierro conexión
            $this->pdo = null;

            //cancelo ejecución programa
            exit();
        }


    }

    /*
        método: filter()
        descripcion: devuelve los libros que coincidan con la expresión de búsqueda
        
        Parámetros:
        
            - expresión: expresión por la que se busca libro
    */

    public function filter($expresion)
    {
        try {

            $sql = "
            SELECT 
                libros.id,
                libros.titulo,
                autores.nombre AS autor,
                editoriales.nombre AS editorial,
                libros.fecha_edicion,
                libros.generos_id,
                libros.stock,
                libros.precio
            FROM 
                libros 
            LEFT JOIN
                autores ON libros.autor_id = autores.id 
            LEFT JOIN
                editoriales ON libros.editorial_id = editoriales.id       
            WHERE 
                CONCAT_WS(' ', 
                          libros.id,
                          libros.titulo,
                          autores.nombre,
                          editoriales.nombre, 
                          libros.fecha_edicion,
                          libros.generos_id,
                          libros.stock,
                          libros.precio
                ) LIKE :expresion   
            ORDER BY libros.id
        ";

            // Preparar la sentencia
            $stmt = $this->pdo->prepare($sql);

            $expresion = '%' . $expresion . '%';

            // vinculación de parámetros
            $stmt->bindParam(':expresion', $expresion, PDO::PARAM_STR);

            // tipo de fetch
            $stmt->setFetchMode(PDO::FETCH_OBJ);

            // Ejecutar la consulta
            $stmt->execute();

            return $stmt;

        } catch (PDOException $e) {
            //error de base de datos
            include 'views/partials/errorDB.php';

            //libero stmt
            $stmt = null;

            //cierro conexión
            $this->pdo = null;

            //cancelo ejecución programa
            exit();
        }
    }

}