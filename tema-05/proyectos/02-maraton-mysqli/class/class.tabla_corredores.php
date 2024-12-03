<?php

/*
    clase: class.tabla_corredores.php
    descripcion: define la clase que va a contener el array de objetos de la clase corredores.
*/

class Class_tabla_corredores extends Class_conexion
{


    /*
        método: getcorredores()
        descripcion: devuelve un objeto de la clase mysqli_result con los 
        detalles de los corredores
    */

    public function getCorredores()
    {
        try {

            // sentencia sql
            $sql = "
            SELECT 
                corredores.id,
                concat_ws(', ', corredores.apellidos, corredores.nombre) as corredor,
                corredores.ciudad,
                corredores.sexo,
                corredores.email,
                corredores.dni,
                corredores.edad,
                categorias.nombre AS categoria,
                clubs.nombre AS club
            FROM 
                corredores 
            INNER JOIN categorias ON corredores.id_categoria = categorias.id
            INNER JOIN clubs ON corredores.id_club = clubs.id
            ORDER BY corredores.id    

        ";

            // ejecuto comando sql
            $result = $this->db->query($sql);

            // obtengo un objeto de la clase mysqli_result
            return $result;

        } catch (mysqli_sql_exception $e) {

            // error de  base de datos
            include 'views/partials/errorDB.php';

            // libero result
            $result->close();

            // cierro conexión
            $this->db->close();

            // cancelo ejecución programa
            exit();
        }
    }

    /*
        método: create()
        descripcion: permite añadir un objeto de la clase corredor a la tabla
        
        parámetros:

            - $corredor - objeto de la clase corredor

    */
    public function create(Class_corredor $corredor)
{
    try {
        // Crear la sentencia preparada
        $sql = "
            INSERT INTO corredores( 
                    nombre,
                    apellidos,
                    ciudad,
                    fechaNacimiento,
                    sexo,
                    email,
                    dni,
                    id_categoria,
                    id_club,
                    edad  -- Añadido el campo edad
                   )
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)  -- Añadido el ? para la edad
        ";

        // ejecuto la sentencia preparada
        $stmt = $this->db->prepare($sql);

        // Calcular la edad
        $edad = $corredor->calcularEdad();

        // vinculación de parámetros
        $stmt->bind_param(
            'ssssssiiis', 
            $nombre,
            $apellidos,
            $ciudad,
            $fechaNacimiento,
            $sexo,
            $email,
            $dni,
            $id_categoria,
            $id_club,
            $edad   
        );

        // Asignar valores a los parámetros
        $nombre = $corredor->nombre;
        $apellidos = $corredor->apellidos;
        $ciudad = $corredor->ciudad;
        $fechaNacimiento = $corredor->fechaNacimiento;
        $sexo = $corredor->sexo;
        $email = $corredor->email;
        $dni = $corredor->dni;
        $id_categoria = $corredor->id_categoria;
        $id_club = $corredor->id_club;

        // Ejecutamos la sentencia
        $stmt->execute();
    } catch (mysqli_sql_exception $e) {
        // Error de base de datos
        include 'views/partials/errorDB.php';
        $stmt->close();
        $this->db->close();
        exit();
    }
}

    /*
        método: read()
        descripcion: permite obtener el objeto de la clase corredor a partir del id del corredor 

        parámetros:

            - $id - id del corredor
    */
    public function read($id)
    {
        try {

            // Crear la sentencia sql
            $sql = "SELECT * FROM corredores WHERE id = ? LIMIT 1";

            // Creo la sentencia preprada objeto clase mysqli_stmt
            $stmt = $this->db->prepare($sql);

            // vinculación de parámetros
            $stmt->bind_param(
                'i',
                $id
            );

            // ejecutamos
            $stmt->execute();

            // Devolvemos objeto de la clase  mysqli_result
            $result = $stmt->get_result();

            // Devolvemos un objeto de la clase corredor
            return $result->fetch_object();
        } catch (mysqli_sql_exception $e) {

            // error de  base dedatos
            include 'views/partials/errorDB.php';

            // libero sentencia preprada
            $stmt->close();

            // libero result
            $result->close();

            // cierro conexión
            $this->db->close();

            // cancelo ejecución programa
            exit();
        }
    }

    /*
        método: update()
        descripcion: permite actualizar los detalles de un corredor en la tabla

        parámetros:

            - $corredor - objeto de Class_corredor
            - $id - id del corredor
    */
    
    public function update(Class_corredor $corredor)
    {
        try {
            // Asignar los valores a las variables antes de la preparación de la consulta
            $id = $corredor->id;
            $nombre = $corredor->nombre;
            $apellidos = $corredor->apellidos;
            $ciudad = $corredor->ciudad;
            $fechaNacimiento = $corredor->fechaNacimiento;
            $sexo = $corredor->sexo;
            $email = $corredor->email;
            $dni = $corredor->dni;
            $id_categoria = $corredor->id_categoria;
            $id_club = $corredor->id_club;

            // Crear la sentencia preparada
            $sql = "
        UPDATE corredores SET 
                nombre = ?,
                apellidos = ?,
                ciudad = ?,
                fechaNacimiento = ?,
                sexo = ?,
                email = ?,
                dni = ?, 
                id_categoria = ?,
                id_club = ?
        WHERE 
                id = ?
        LIMIT 1
        ";

            // Ejecuto la sentencia preparada
            $stmt = $this->db->prepare($sql);

            // Vinculación de parámetros
            $stmt->bind_param(
                'sssssssiii',
                $nombre,
                $apellidos,
                $ciudad,
                $fechaNacimiento,
                $sexo,
                $email,
                $dni,
                $id_categoria,
                $id_club,
                $id
            );

            // Ejecutamos
            $stmt->execute();

            // Cierro el statement
            $stmt->close();
        } catch (mysqli_sql_exception $e) {
            // Error de base de datos
            include 'views/partials/errorDB.php';

            // Libero el result
            $stmt->close();

            // Cierro la conexión
            $this->db->close();

            // Cancelo la ejecución del programa
            exit();
        }
    }

    /*
        getCategorias()

        Método que me devuelve todas las categorías en un array assoc de categorías
    */

    public function getCategorias()
    {
        $sql = "
        SELECT 
            id, 
            nombre as categoria
        FROM 
            categorias
        ORDER BY
            nombre ASC
    ";

        $result = $this->db->query($sql);

        $categorias = [];
        while ($row = $result->fetch_assoc()) {
            $categorias[$row['id']] = $row['categoria'];
        }

        return $categorias;
    }


    /*
        getClubs()

        Método que me devuelve todos los clubs en un array assoc de clubs
    */

    public function getClubs()
    {
        $sql = "
            SELECT 
                    id, 
                    nombre as club
            FROM 
                    clubs
            ORDER BY
                    nombre ASC
        ";

        $result = $this->db->query($sql);

        $clubs = [];
        while ($row = $result->fetch_assoc()) {
            $clubs[$row['id']] = $row['club'];
        }

        return $clubs;
    }

    /*
        método: order()
        descripcion: devuelve un objeto de la clase mysqli_result con los 
        detalles de los corredores ordenados por un criterio.

        Parámetros:

            - criterio: posición de la columna en la tabla corredores
                        por la que quiero ordenar
    */

    public function order(int $criterio)
    {
        try {

            $criterios_validos = [
                1 => 'corredores.id',  
                2 => 'corredores.nombre',    
                3 => 'corredores.apellidos',     
                4 => 'corredores.ciudad',       
                5 => 'corredores.email',      
                6 => 'corredores.edad',       
                7 => 'categoria',       
                8 => 'club',     
            ];

            $campo_criterio = $criterios_validos[$criterio];

            // sentencia sql
            $sql = "
            SELECT 
                corredores.id,
                concat_ws(', ', corredores.apellidos, corredores.nombre) as corredor,
                corredores.ciudad,
                corredores.sexo,
                corredores.email,
                corredores.dni,
                corredores.edad,
                categorias.nombre AS categoria,
                clubs.nombre AS club
            FROM 
                corredores 
            INNER JOIN categorias ON corredores.id_categoria = categorias.id 
            INNER JOIN clubs ON corredores.id_club = clubs.id
 
            ORDER BY $campo_criterio

        ";

            // ejecuto prepare
            $stmt = $this->db->prepare($sql);

            // ejecutamos
            $stmt->execute();

            // Devolvemos objeto de la clase mysqli_result
            $result = $stmt->get_result();

            // Devolvemos mysqli_result
            return $result;
        } catch (mysqli_sql_exception $e) {

            // error de  base dedatos
            include 'views/partials/errorDB.php';

            // libero stmt
            $stmt->close();

            // libero result
            $result->close();

            // cierro conexión
            $this->db->close();

            // cancelo ejecución programa
            exit();
        }
    }

    /*
        método: filter()
        descripcion: devuelve un objeto de la clase mysqli_result con los 
        detalles de los corredores según la expresión.

        Parámetros:

            - expresion: expresión por la que buscaré un dato del corredor
*/

public function filter($expresion)
{
    try {
     
        $sql = "
        SELECT 
            corredores.id,
            concat_ws(', ', corredores.apellidos, corredores.nombre) as corredor,
            corredores.ciudad,
            corredores.sexo,
            corredores.email,
            corredores.dni,
            corredores.edad,
            categorias.nombre AS categoria,
            clubs.nombre AS club
        FROM 
            corredores 
        INNER JOIN categorias ON corredores.id_categoria = categorias.id 
        INNER JOIN clubs ON corredores.id_club = clubs.id
        WHERE 
            concat_ws(', ', corredores.apellidos, corredores.nombre) LIKE ? OR 
            corredores.ciudad LIKE ? OR
            corredores.sexo LIKE ? OR
            corredores.email LIKE ? OR
            corredores.dni LIKE ? OR
            corredores.edad LIKE ? OR 
            categorias.nombre LIKE ? OR 
            clubs.nombre LIKE ? 
        ORDER BY 
            corredores.id
        ";

        // Preparamos la consulta
        $stmt = $this->db->prepare($sql);

        $expresion = '%' . $expresion . '%';

        $stmt->bind_param('ssssssss', $expresion, $expresion, $expresion, $expresion,$expresion, $expresion, $expresion, $expresion);

        // Ejecutamos la consulta
        $stmt->execute();

        // Devolvemos el objeto mysqli_result
        $result = $stmt->get_result();

        // Devolvemos el resultado
        return $result;

    } catch (mysqli_sql_exception $e) {
        // Manejo de errores de base de datos
        include 'views/partials/errorDB.php';

        // Liberamos recursos
        $stmt->close();
        if (isset($result)) $result->close();

        // Cerramos la conexión
        $this->db->close();

        // Terminamos la ejecución del programa
        exit();
    }
}

    /*
        método: delete()
        descripcion: borra un objeto de la clase corredor mediante el id

        Parámetros:

            - id: id del corredor que se quiere eliminar
    */

    public function delete(int $id)
    {
        try {

            // Iniciar transacción
            $this->db->begin_transaction();

            // primera sentencia sql
            $sql = "DELETE FROM registros WHERE id_corredor = ? LIMIT 1";

            // ejecuto prepare
            $stmt = $this->db->prepare($sql);

            // vincular parámetros
            $stmt->bind_param(
                'i',
                $id
            );

            // ejecutamos
            $stmt->execute();

            // segunda sentencia sql
            $sql = "DELETE FROM corredores WHERE id = ? LIMIT 1";

            // ejecuto prepare
            $stmt = $this->db->prepare($sql);

            // vincular parámetros
            $stmt->bind_param(
                'i',
                $id
            );

            // ejecutamos
            $stmt->execute();

            // Confirmar transacción
            $this->db->commit();



        } catch (mysqli_sql_exception $e) {

            // error de  base dedatos
            include 'views/partials/errorDB.php';

            // libero stmt
            $stmt->close();

            // libero result
            $result->close();

            // cierro conexión
            $this->db->close();

            // cancelo ejecución programa
            exit();
        }
    }


}
