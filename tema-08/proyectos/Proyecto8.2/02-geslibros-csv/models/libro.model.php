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
                libros.fecha_edicion,
                libros.isbn,
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
                    fecha_edicion,
                    isbn,
                    generos_id,
                    stock,
                    precio
                ) VALUES (
                    :titulo,
                    :autor,
                    :editorial,
                    :fecha_edicion,
                    :isbn,
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
            $stmt->bindParam(':fecha_edicion', $libro->fecha_edicion, PDO::PARAM_STR);
            $stmt->bindParam(':isbn', $libro->isbn, PDO::PARAM_INT);
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
                libros.fecha_edicion,
                libros.isbn,
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
        método: get_isbn

        descripción: obtiene el isbn correspondiente al libro

        @param: id del libro
        devuelve: isbn
    */
    public function get_isbn($isbn)
    {
        try {
            $sql = "SELECT isbn FROM libros WHERE isbn = :isbn";
            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':isbn', $isbn, PDO::PARAM_INT);
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
                        fecha_edicion = :fecha_edicion,
                        isbn = :isbn,
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
            $stmt->bindParam(':fecha_edicion', $libro->fecha_edicion, PDO::PARAM_STR);
            $stmt->bindParam(':isbn', $libro->isbn, PDO::PARAM_INT);
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
        método: get_genero_id

        Extrae todos los géneros de las editoriales
    */
    public function get_genero_id($genero_id)
{
    try {
        // sentencia sql
        $sql = "SELECT id FROM generos WHERE id = :genero_id";

        // conectamos con la base de datos
        $conexion = $this->db->connect();

        // ejecuto prepare
        $stmt = $conexion->prepare($sql);

        // bindeo el parámetro
        $stmt->bindParam(':genero_id', $genero_id, PDO::PARAM_INT);

        // ejecutamos
        $stmt->execute();

        // devuelvo el resultado
        return $stmt->fetch() !== false;
    } catch (PDOException $e) {
        // error base de datos
        require 'template/partials/errorDB.partial.php';
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
        método: validateIdLibro

        descripción: valida el id del libro. Que exista en la base de datos

        @param: 
            - id del libro

    */
    public function validateIdLibro(int $id)
    {

        try {

            $sql = "
                SELECT 
                    id
                FROM 
                    libros
                WHERE
                    id = :id
            ";

            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() == 1) {
                return TRUE;
            }

            return FALSE;


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

        descripción: filtra los libros por una expresión

        @param: expresión a buscar
    */
    public function filter($expresion)
    {
        try {
            $sql = "
            SELECT 
                libros.id,
                libros.titulo,
                autores.nombre as autor,
                editoriales.nombre as editorial,
                libros.fecha_edicion,
                libros.isbn,
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
            HAVING
                CONCAT_WS(
                    ', ',
                    libros.id,
                    libros.titulo,
                    autor,
                    editorial,
                    libros.fecha_edicion,
                    libros.isbn,
                    generos,
                    libros.stock,
                    libros.precio
                ) LIKE :expresion
            ORDER BY
                libros.id";

            # Conectar con la base de datos
            $conexion = $this->db->connect();

            $stmt = $conexion->prepare($sql);

            $stmt->bindValue(':expresion', '%' . $expresion . '%', PDO::PARAM_STR);
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $stmt->execute();
            return $stmt->fetchAll();
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

        descripción: ordena los libros por un campo

        @param: campo por el que ordenar
    */
    public function order(int $criterio)
    {
        // Lista de columnas permitidas para ordenar
        $columnasPermitidas = ['id', 'titulo', 'autor', 'editorial', 'fecha_edicion', 'isbn', 'generos', 'stock', 'precio'];

        // Validar el criterio de ordenación
        if ($criterio < 1 || $criterio > 9) {
            throw new InvalidArgumentException('Criterio de ordenación no válido');
        }

        // Obtener el nombre de la columna correspondiente al índice
        $columnaOrden = $columnasPermitidas[$criterio - 1];

        try {
            // comando sql
            $sql = "SELECT 
                libros.id,
                libros.titulo,
                autores.nombre as autor,
                editoriales.nombre as editorial,
                libros.fecha_edicion,
                libros.isbn,
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
                $columnaOrden";

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecutamos mediante prepare
            $stmt = $conexion->prepare($sql);

            // establecemos tipo fetch
            $stmt->setFetchMode(PDO::FETCH_OBJ);

            // ejecutamos 
            $stmt->execute();

            // devuelvo objeto stmtatement
            return $stmt->fetchAll();
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
        método: validateUniqueDni

        descripción: valida el DNI de un libro. Que no exista en la base de datos

        @param: 
            - dni del libro

    */
    public function validateUniqueDNI($dni) {

        try {

            $sql = "
                SELECT 
                    dni
                FROM 
                    libros
                WHERE
                    dni = :dni
            ";

            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':dni', $dni, PDO::PARAM_STR, 9);
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return FALSE;
            } 

            return TRUE;
            

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
        método: validateUniqueEmail

        descripción: valida el email de un libro. Que no exista en la base de datos

        @param: 
            - email del libro

    */
    public function validateUniqueEmail($email) {

        try {

            $sql = "
                SELECT 
                    email
                FROM 
                    libros
                WHERE
                    email = :email
            ";

            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR, 50);
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return FALSE;
            } 

            return TRUE;
            

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
        método: validateForeignKeyCurso($id_curso)

        descripción: valida el id_curso seleccionado. Que exista en la tabla cursos

        @param: 
            - $id_curso

    */
    public function validateForeignKeyCurso(int $id_curso) {

        try {

            $sql = "
                SELECT 
                    id
                FROM 
                    cursos
                WHERE
                    id = :id_curso
            ";

            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $stmt->execute();

            if ($stmt->rowCount() == 1) {
                return TRUE;
            } 

            return FALSE;
            

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
        método: get()

        Extre los detalles de la tabla libros
    */
    public function get_csv()
    {

        try {

            // sentencia sql
            $sql = "SELECT 
                libros.id,
                CONCAT_WS(', ', libros.apellidos, libros.nombre) as libro,
                libros.email,
                libros.telefono,
                libros.nacionalidad,
                libros.dni,
                timestampdiff(YEAR, libros.fechaNac, now()) as edad,
                cursos.nombreCorto as curso
            FROM 
                libros 
            INNER JOIN
                cursos
            ON libros.id_curso = cursos.id
            ORDER BY libros.id";

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // establezco tipo fetch
            $stmt->setFetchMode(PDO::FETCH_NUM);

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
        método: import

        descripción: importa un fichero csv con los datos de los libros

        @param: 

            - $libros array con los datos del fichero csv

    */
    public function import($libros) {

        try {

            $sql = "INSERT INTO libros (
                    nombre,
                    apellidos,
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

            foreach ($libros as $libro) {

                $stmt->bindParam(':nombre', $libro[0], PDO::PARAM_STR, 30);
                $stmt->bindParam(':apellidos', $libro[1], PDO::PARAM_STR, 50);
                $stmt->bindParam(':email', $libro[2], PDO::PARAM_STR, 50);
                $stmt->bindParam(':telefono', $libro[3], PDO::PARAM_STR, 13);
                $stmt->bindParam(':nacionalidad', $libro[4], PDO::PARAM_STR, 30);
                $stmt->bindParam(':dni', $libro[5], PDO::PARAM_STR, 9);
                $stmt->bindParam(':fechaNac', $libro[6], PDO::PARAM_STR);
                $stmt->bindParam(':id_curso', $libro[7], PDO::PARAM_INT);

                // añado libro
                $stmt->execute();
            }

            // devuelvo el número de libros importados
            return count($libros);

        } catch (PDOException $e) {
            // error base de datos
            require_once 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }


}
