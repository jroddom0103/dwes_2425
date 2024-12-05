<?php

/*
    clase: class.tabla_clientes.php
    descripcion: define la clase que va a contener el array de objetos de la clase clientes.
*/

class Class_tabla_clientes extends Class_conexion
{


    /*
        método: getClientes()
        descripcion: devuelve un objeto de la clase pdostatement con los 
        detalles de los clientes
    */

    public function getClientes()
    {
        try {

            // sentencia
            $sql = "
            select 
                clientes.id,
                concat_ws(', ', clientes.apellidos, clientes.nombre) cliente,
                clientes.telefono,
                clientes.ciudad,
                clientes.dni,
                clientes.email,
                SUM(cuentas.saldo) saldo
            FROM 
                clientes 
                LEFT JOIN
                cuentas ON cuentas.id_cliente = clientes.id
            GROUP BY clientes.id    
            ORDER BY clientes.id
        ";

            // ejecuto prepare
            // obtengo objeto clase pdostatement
            $stmt = $this->pdo->prepare($sql);


            // establezco tipo de fetch
            $stmt->setFetchMode(PDO::FETCH_OBJ);

            // ejecuto 
            $stmt->execute();

            // devuelvo objeto clase pdostatement
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
        método: create()
        descripcion: permite añadir un objeto de la clase cliente a la tabla
        
        parámetros:

            - $cliente - objeto de la clase cliente

    */
    public function create(Class_cliente $cliente)
    {
        try {
        // Crear la sentencia preparada
        $sql = "
            INSERT INTO 
            clientes( 
                apellidos,
                nombre,
                telefono,
                ciudad,
                dni,
                email
            )
         VALUES    (
                :apellidos,
                :nombre,
                :telefono,
                :ciudad,
                :dni,
                :email
            )                            
        ";

        // Objeto de la clase pdostatement
        $stmt = $this->pdo->prepare($sql);

        // vinculación de parámetros con las propiedades del objeto
        $stmt->bindParam(':apellidos', $cliente->apellidos, PDO::PARAM_STR, 45);
        $stmt->bindParam(':nombre', $cliente->nombre, PDO::PARAM_STR, 20);
        $stmt->bindParam(':telefono', $cliente->telefono, PDO::PARAM_STR, 9);
        $stmt->bindParam(':ciudad', $cliente->ciudad, PDO::PARAM_STR, 20);
        $stmt->bindParam(':dni', $cliente->dni, PDO::PARAM_STR, 9);
        $stmt->bindParam(':email', $cliente->email, PDO::PARAM_STR, 45);

        // ejecutamos
        $stmt->execute();

        } catch (PDOException $e) {

            //error de base de datos
            include 'views/partials/errorDB.php';

            //cierro conexión
            $this->pdo = null;

            //cancelo ejecución programa
            exit();
        }

    }

    /*
        método: read()
        descripcion: permite obtener el objeto de la clase cliente a partir del id del cliente 

        parámetros:

            - $id - id del cliente
    */
    public function read($id)
    {
        try {
            // Crear la sentencia preparada
            $sql = "SELECT
                        id, apellidos, nombre, telefono, ciudad, dni,  email
                    FROM clientes WHERE id = :id LIMIT 1";

            // Creo la sentencia preparada objeto clase mysqli_stmt
            $stmt = $this->pdo->prepare($sql);

            // vinculación de parámetros
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            // establecemos el tipo fetch
            $stmt->setFetchMode(PDO::FETCH_OBJ);

            // ejecutamos
            $stmt->execute();

            // Devolvemos objeto de la clase Class_cliente
            return $stmt->fetch();

        } catch (PDOException $e) {

            //error de base de datos
            include '/views/partials/errorDB.php';

            //libero stmt
            $stmt = null;

            //cierro conexión
            $this->db = null;

            //cancelo ejecución programa
            exit();
        }
    }

    /*
        método: update()
        descripcion: permite actualizar los detalles de un cliente en la tabla

        parámetros:

            - $cliente - objeto de la clase cliente
            - $id - id 
    */

    public function update(Class_cliente $cliente, $id)
    {
        try {
            // sentencia
            $sql = "
        UPDATE clientes
        SET 
            apellidos = :apellidos,
            nombre = :nombre,
            telefono = :telefono,    
            ciudad = :ciudad,
            dni = :dni,
            email = :email,
            update_at = CURRENT_TIMESTAMP
        WHERE 
            id = :id
        LIMIT 1
        ";

            $stmt = $this->pdo->prepare($sql);

            // vinculación de parámetros
            $stmt->bindParam(':apellidos', $cliente->apellidos, PDO::PARAM_STR, 45);
            $stmt->bindParam(':nombre', $cliente->nombre, PDO::PARAM_STR, 20);
            $stmt->bindParam(':telefono', $cliente->telefono, PDO::PARAM_STR, 9);
            $stmt->bindParam(':ciudad', $cliente->ciudad, PDO::PARAM_STR, 20);
            $stmt->bindParam(':dni', $cliente->dni, PDO::PARAM_STR, 9);
            $stmt->bindParam(':email', $cliente->email, PDO::PARAM_STR, 45);
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);

            // Ejecuto la consulta
            $stmt->execute();

            // Devuelvo true si todo salió bien
            return true;

        } catch (PDOException $e) {
            //error de base de datos
            include '/views/partials/errorDB.php';

            $stmt = null;

            //cierro conexión
            $this->pdo = null;

            //cancelo ejecución programa
            exit();
        }
    }

    /*
        método: delete()
        descripcion: permite eliminar un cliente de la tabla

        parámetros:

            - $id - id de la tabla en la que se encuentra el cliente
    */
    public function delete($id)
    {
        try {
            // sentencia
            $sql = "
        DELETE FROM clientes
        WHERE 
            id = :id
        ";

            $stmt = $this->pdo->prepare($sql);

            // vinculación de parámetros
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);

            // Ejecuto la consulta
            $stmt->execute();

            // Devuelvo true si todo salió bien
            return true;

        } catch (PDOException $e) {

            //error de base de datos
            include '/views/partials/errorDB.php';

            $result->close();

            $stmt = null;

            //cierro conexión
            $this->pdo = null;

            //cancelo ejecución programa
            exit();
        }
    }

    /*
       método: order()
       descripcion: devuelve un objeto de la clase class_tabla_clientes con los 
       detalles de los clientes ordenador por un criterio.

       Parámetros:

           - criterio: posición de la columna en la tabla clientes
                       por la que quiero ordenar
   */

    public function order(int $criterio)
    {
        try {

            // sentencia
            $sql = "
            clientes.id,
                concat_ws(', ', clientes.apellidos, clientes.nombre) cliente,
                clientes.telefono,
                clientes.ciudad,
                clientes.dni,
                clientes.email,
                SUM(cuentas.saldo) saldo
            FROM 
                clientes 
            ORDER BY :criterio
        ";

            // ejecuto comando sql
            $stmt = $this->pdo->prepare($sql);

            // vinculación de parámetros
            $stmt->bindParam(':criterio',$criterio,PDO::PARAM_STR);


            // establezco tipo de fetch
            $stmt->setFetchMode(PDO::FETCH_OBJ);

            // ejecuto 
            $stmt->execute();

            // devuelvo objeto clase pdostatement
            return $stmt;

        } catch (PDOException $e) {
            //error de base de datos
            include '/views/partials/errorDB.php';

            //libero stmt
            $stmt = null;

            //libero result
            $result->close();

            //cierro conexión
            $this->pdo = null;

            //cancelo ejecución programa
            exit();
        }

    }

    /*
        método: filtrar()
        descripcion: devuelve un 
    */

    public function filtrar($expresion)
    {
        try {
            // Construir la consulta con un filtro LIKE
            $sql = "
        SELECT 
            clientes.id,
            clientes.nombre, 
            clientes.apellidos,
            clientes.email,
            clientes.telefono,
            clientes.nacionalidad,
            clientes.dni,
            TIMESTAMPDIFF(YEAR, clientes.fechaNac, NOW()) AS edad,
            cursos.nombreCorto AS curso
        FROM 
            clientes 
        INNER JOIN
            cursos
        ON clientes.id_curso = cursos.id
        WHERE 
            clientes.nombre LIKE ? 
            OR clientes.apellidos LIKE ? 
            OR clientes.email LIKE ?
        ORDER BY clientes.id";

            // Preparar la sentencia
            $stmt = $this->db->prepare($sql);

            // Añadir el patrón para el filtro
            $expresion = '%' . $this->db->real_escape_string($expresion) . '%';
            $stmt->bind_param('sss', $expresion, $expresion, $expresion);

            // Ejecutar la consulta
            $stmt->execute();

            $result = $stmt->get_result();

            // Crear un nuevo objeto de la clase para almacenar los datos


            // Recorrer los resultados y convertirlos en objetos de Class_alumno
            while ($row = $result->fetch_assoc()) {
                // Crear una nueva instancia de Class_alumno
                $alumno = new Class_alumno(
                    $row['id'],
                    $row['nombre'],
                    $row['apellidos'],
                    $row['email'],
                    $row['telefono'],
                    $row['nacionalidad'],
                    $row['dni'],
                    $row['edad'],
                    $row['curso']
                );

                // Añadir el objeto alumno a la tabla
                $this->create($alumno);
            }

            // Cerrar el statement
            $stmt->close();

            // Devolver la nueva tabla
            return $this;


        } catch (mysqli_sql_exception $e) {
            //error de base de datos
            include '/views/partials/errorDB.php';

            //libero result
            $result->close();

            //cierro conexión
            $this->db->close();

            //cancelo ejecución programa
            exit();
        }
    }
}