<?php

/*
    albumModel.php

    Modelo del controlador album

    Métodos:

        - get()
*/

class albumModel extends Model
{

    /*
        método: get()

        Extre los detalles de la tabla albumes
    */
    public function get()
    {

        try {

            // sentencia sql
            $sql = "SELECT 
                id,
                titulo,
                descripcion,
                autor,
                fecha,
                lugar,
                categoria,
                etiquetas,
                num_fotos,
                num_visitas,
                carpeta
            FROM 
                albumes 
            ORDER BY id";

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
       método: get_categorias()

       Extre los detalles de las categorías para generar lista desplegable 
       dinámica
   */
    public function get_categorias()
    {

        try {

            // sentencia sql
            $sql = "SELECT 
                        id,
                        categoria 
                    FROM 
                        categorias
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

        descripción: añade nuevo album
        parámetros: objeto de classAlbum
    */

    public function create(classAlbum $album)
    {

        try {
            $sql = "INSERT INTO Albumes (
                    titulo,
                    descripcion,
                    autor,
                    fecha,
                    lugar,
                    categoria,
                    etiquetas,
                    num_fotos,
                    num_visitas,
                    carpeta
                )
                VALUES (
                    :titulo,
                    :descripcion,
                    :autor,
                    :fecha,
                    :lugar,
                    :categoria,
                    :etiquetas,
                    0,
                    0,
                    :carpeta
                )
            ";
            # Conectar con la base de datos
            $conexion = $this->db->connect();


            $stmt = $conexion->prepare($sql);

            $stmt->bindParam(':titulo', $album->titulo, PDO::PARAM_STR);
            $stmt->bindParam(':descripcion', $album->descripcion, PDO::PARAM_STR);
            $stmt->bindParam(':autor', $album->autor, PDO::PARAM_STR);
            $stmt->bindParam(':fecha', $album->fecha, PDO::PARAM_STR);
            $stmt->bindParam(':lugar', $album->lugar, PDO::PARAM_STR);
            $stmt->bindParam(':categoria', $album->categoria, PDO::PARAM_STR);
            $stmt->bindParam(':etiquetas', $album->etiquetas, PDO::PARAM_STR);
            $stmt->bindParam(':carpeta', $album->carpeta, PDO::PARAM_STR);


            // añado álbum
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

        descripción: obtiene los detalles de un album
        parámetros: id del album
        devuelve: objeto con los detalles del album
        
    */

    public function read(int $id)
    {

        try {
            $sql = "
                    SELECT 
                            id,
                            titulo, 
                            descripcion,
                            autor,
                            fecha,
                            lugar,
                            categoria,
                            etiquetas,
                            num_fotos,
                            num_visitas,
                            carpeta
                    FROM 
                            albumes
                    WHERE
                            id = :id
                    LIMIT 1
            ";

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

        descripción: actualiza los detalles de un album

        @param:
            - objeto de classAlbum
            - id del album
    */

    public function update(classAlbum $album, $id)
    {

        try {

            $sql = "
            
            UPDATE albumes
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

            $stmt->bindParam(':nombre', $album->nombre, PDO::PARAM_STR, 30);
            $stmt->bindParam(':apellidos', $album->apellidos, PDO::PARAM_STR, 50);
            $stmt->bindParam(':email', $album->email, PDO::PARAM_STR, 50);
            $stmt->bindParam(':telefono', $album->telefono, PDO::PARAM_STR, 9);
            $stmt->bindParam(':nacionalidad', $album->nacionalidad, PDO::PARAM_STR, 30);
            $stmt->bindParam(':dni', $album->dni, PDO::PARAM_STR, 9);
            $stmt->bindParam(':fechaNac', $album->fechaNac, PDO::PARAM_STR);
            $stmt->bindParam(':id_curso', $album->id_curso, PDO::PARAM_INT);

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

        descripción: elimina un album

        @param: id del album
    */

    public function delete(int $id)
    {

        try {

            $sql = "
                DELETE FROM albumes
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
        método: validateIdAlbum

        descripción: valida el id de un album. Que exista en la base de datos

        @param: 
            - id del album

    */

    public function validateIdAlbum(int $id)
    {

        try {

            $sql = "
                SELECT 
                    id
                FROM 
                    albumes
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

        descripción: filtra los álbumes por una expresión

        @param: expresión a buscar
    */
    public function filter($expresion)
    {
        try {
            $sql = "

            SELECT 
                id,
                titulo,
                descripcion,
                autor,
                fecha,
                lugar,
                categoria,
                etiquetas,
                num_fotos,
                num_visitas,
                carpeta
            FROM
                albumes
            WHERE

                CONCAT_WS(  ', ', 
                            id,
                            titulo,
                            descripcion,
                            autor,
                            fecha,
                            lugar,
                            categoria,
                            etiquetas,
                            num_fotos,
                            num_visitas,
                            carpeta) 
                like :expresion

            ORDER BY 
                id
            
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

        descripción: ordena los álbumes por un campo

        @param: campo por el que ordenar
    */
    public function order(int $criterio)
    {
        try {
            // Mapeo de criterios a columnas
            $criterios = [
                1 => 'id',
                2 => 'titulo',
                3 => 'descripcion',
                4 => 'autor',
                5 => 'fecha',
                6 => 'lugar',
                7 => 'categoria',
                8 => 'etiquetas',
                9 => 'num_fotos',
                10 => 'num_visitas',
                11 => 'carpeta'
            ];

            // Verificar si el criterio es válido
            if (!array_key_exists($criterio, $criterios)) {
                throw new Exception('Criterio de ordenación no válido');
            }

            // Obtener el nombre de la columna
            $columna = $criterios[$criterio];

            // Comando SQL
            $sql = "
        SELECT 
            id,
            titulo,
            descripcion,
            autor,
            fecha,
            lugar,
            categoria,
            etiquetas,
            num_fotos,
            num_visitas,
            carpeta
        FROM
            albumes
        ORDER BY 
            $columna
        ";

            // Conectamos con la base de datos
            $conexion = $this->db->connect();

            // Ejecutamos mediante prepare
            $stmt = $conexion->prepare($sql);

            // Establecemos tipo fetch
            $stmt->setFetchMode(PDO::FETCH_OBJ);

            // Ejecutamos 
            $stmt->execute();

            // Devolvemos objeto statement
            return $stmt;

        } catch (PDOException $e) {
            // Error base de datos
            require_once 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
            exit();
        }
    }


    /*
        método: validateUniqueCarpeta($carpeta)

        descripción: valida que la carpeta de un álbum sea única

        @param: 
            - $album: string con la carpeta del álbum

    */
    public function validateUniqueCarpeta(string $carpeta)
    {

        try {

            $sql = "
                SELECT 
                    carpeta
                FROM 
                    albumes
                WHERE
                    carpeta = :carpeta
            ";

            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':carpeta', $carpeta, PDO::PARAM_STR, 50);
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

    public function actualizarNumFotos($album_id, $numFotos)
    {
        try {
            $sql = "UPDATE albumes SET num_fotos = :numFotos WHERE id = :album_id";
            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':numFotos', $numFotos, PDO::PARAM_INT);
            $stmt->bindParam(':album_id', $album_id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            // Manejar error
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }

}
