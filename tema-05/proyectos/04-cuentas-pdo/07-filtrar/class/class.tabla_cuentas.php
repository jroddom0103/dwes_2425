<?php

/*
    clase: class.tabla_cuentas.php
    descripcion: define la clase que va a contener el array de objetos de la clase cuentas.
*/

class Class_tabla_cuentas extends Class_conexion
{


    /*
        método: getCuentas()
        descripcion: devuelve un objeto de la clase pdostatement con los 
        detalles de los cuentas
    */

    public function getCuentas()
    {
        try {

            // sentencia
            $sql = "
            select 
                cuentas.id,
                cuentas.num_cuenta,
                concat_ws(', ', clientes.apellidos, clientes.nombre) cliente,
                cuentas.fecha_alta,
                cuentas.fecha_ul_mov,
                cuentas.num_movtos,
                cuentas.saldo
            FROM 
                cuentas 
                INNER JOIN
                clientes ON cuentas.id_cliente = clientes.id   
            ORDER BY cuentas.id
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
        descripcion: permite añadir un objeto de la clase cuenta a la tabla
        
        parámetros:

            - $cuenta - objeto de la clase cuenta

    */
    public function create(Class_cuenta $cuenta)
    {
        try {
            // Crear la sentencia preparada
            $sql = "
            INSERT INTO 
            cuentas( 
                num_cuenta,
                id_cliente,
                fecha_alta,
                fecha_ul_mov,
                num_movtos,
                saldo
            )
         VALUES    (
                :num_cuenta,
                :id_cliente,
                :fecha_alta,
                :fecha_ul_mov,
                :num_movtos,
                :saldo
            )                            
        ";

            // Objeto de la clase pdostatement
            $stmt = $this->pdo->prepare($sql);

            // vinculación de parámetros con las propiedades del objeto
            $stmt->bindParam(':num_cuenta', $cuenta->num_cuenta, PDO::PARAM_INT);
            $stmt->bindParam(':id_cliente', $cuenta->id_cliente, PDO::PARAM_INT);
            $stmt->bindParam(':fecha_alta', $cuenta->fecha_alta, PDO::PARAM_STR);
            $stmt->bindParam(':fecha_ul_mov', $cuenta->fecha_ul_mov, PDO::PARAM_STR);
            $stmt->bindParam(':num_movtos', $cuenta->num_movtos, PDO::PARAM_INT);
            $stmt->bindParam(':saldo', $cuenta->saldo, PDO::PARAM_STR);

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
        descripcion: permite obtener el objeto de la clase cuenta a partir del id de la cuenta 

        parámetros:

            - $id - id de la cuenta
    */
    public function read($id)
    {
        try {
            // Crear la sentencia preparada
            $sql = "SELECT
                        id, num_cuenta, id_cliente, fecha_alta, fecha_ul_mov, num_movtos, saldo
                    FROM cuentas WHERE id = :id LIMIT 1";

            // Creo la sentencia preparada objeto clase mysqli_stmt
            $stmt = $this->pdo->prepare($sql);

            // vinculación de parámetros
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            // establecemos el tipo fetch
            $stmt->setFetchMode(PDO::FETCH_OBJ);

            // ejecutamos
            $stmt->execute();

            // Devolvemos objeto de la clase Class_cuenta
            return $stmt->fetch();

        } catch (PDOException $e) {

            //error de base de datos
            include 'views/partials/errorDB.php';

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
        descripcion: permite actualizar los detalles de una cuenta en la tabla

        parámetros:

            - $cuenta - objeto de la clase cuenta
            - $id - id 
    */

    public function update(Class_cuenta $cuenta, $id)
    {
        try {
            // sentencia
            $sql = "
        UPDATE cuentas
        SET 
            num_cuenta = :num_cuenta,
            id_cliente = :id_cliente,
            saldo = :saldo,
            update_at = CURRENT_TIMESTAMP
        WHERE 
            id = :id
        LIMIT 1
        ";

            $stmt = $this->pdo->prepare($sql);

            // vinculación de parámetros
            $stmt->bindParam(':num_cuenta', $cuenta->num_cuenta, PDO::PARAM_INT);
            $stmt->bindParam(':id_cliente', $cuenta->id_cliente, PDO::PARAM_INT);
            $stmt->bindParam(':saldo', $cuenta->saldo, PDO::PARAM_INT);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            // Ejecuto la consulta
            $stmt->execute();

            // Devuelvo true si todo salió bien
            return true;

        } catch (PDOException $e) {
            //error de base de datos
            include 'views/partials/errorDB.php';

            $stmt = null;

            //cierro conexión
            $this->pdo = null;

            //cancelo ejecución programa
            exit();
        }
    }

    /*
        método: delete()
        descripcion: permite eliminar un cuenta de la tabla

        parámetros:

            - $id - id de la tabla en la que se encuentra el cuenta
    */
    public function delete($id)
    {
        try {
            // sentencia
            $sql = "
        DELETE FROM cuentas
        WHERE 
            id = :id
        ";

            $stmt = $this->pdo->prepare($sql);

            // vinculación de parámetros
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            // Ejecuto la consulta
            $stmt->execute();

            // Devuelvo true si todo salió bien
            return true;

        } catch (PDOException $e) {

            //error de base de datos
            include 'views/partials/errorDB.php';

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
       descripcion: devuelve un objeto de la clase class_tabla_cuentas con los 
       detalles de los cuentas ordenador por un criterio.

       Parámetros:

           - criterio: posición de la columna en la tabla cuentas
                       por la que quiero ordenar
   */

    public function order($criterio)
    {
        try {

            $columnas = [
                1 => 'cuentas.id',
                2 => 'cuentas.num_cuenta',
                3 => 'cliente.apellidos',
                4 => 'cuentas.fecha_alta',
                5 => 'cuentas.fecha_ul_mov',
                6 => 'cuentas.num_movtos',
                7 => 'cuentas.saldo',
            ];

            $columna = $columnas[$criterio];

            // sentencia
            $sql = "
           SELECT
           cuentas.id,
           cuentas.num_cuenta,
           concat_ws(', ', clientes.apellidos, clientes.nombre) cliente,
           cuentas.fecha_alta,
           cuentas.fecha_ul_mov,
           cuentas.num_movtos,
           cuentas.saldo
           FROM 
               cuentas
           INNER JOIN
               clientes ON cuentas.id_cliente = clientes.id 
           GROUP BY cuentas.id 
           ORDER BY $columna  
       ";

            // ejecuto comando sql
            $stmt = $this->pdo->prepare($sql);

            // tipo de fetch
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
        método: filtrar()
        descripcion: devuelve los registros de cuentas que contengan la expresión
                     de búsqueda
        
        Parámetros:
        
            - expresión: 
    */

    public function filtrar($expresion)
    {
        try {
            // sentencia sql
            $sql = "
            SELECT 
                cuentas.id,
                cuentas.num_cuenta,
                CONCAT_WS(', ', clientes.apellidos, clientes.nombre) AS cliente,
                cuentas.fecha_alta,
                cuentas.fecha_ul_mov,
                cuentas.num_movtos,
                cuentas.saldo
            FROM 
                cuentas 
            LEFT JOIN
                clientes ON cuentas.id_cliente = clientes.id 
            WHERE 
                CONCAT_WS(' ', 
                          clientes.nombre,
                          clientes.apellidos,
                          cuentas.id,
                          cuentas.num_cuenta, 
                          cuentas.id_cliente,
                          cuentas.fecha_alta,
                          cuentas.fecha_ul_mov,
                          cuentas.num_movtos,
                          cuentas.saldo
                ) LIKE :expresion   
            ORDER BY cuentas.id
        ";

            // Preparar la sentencia
            $stmt = $this->pdo->prepare($sql);

            // Añadir el patrón para el filtro
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

    public function getCuentaById($id)
    {
        try {
            $sql = "SELECT * FROM cuentas WHERE id = :id";

            $stmt = $this->pdo->prepare($sql);

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $stmt->execute();

            return $stmt;

        } catch (PDOException $e) {

            include 'views/partials/errorDB.php';

            //libero stmt
            $stmt = null;

            //cierro conexión
            $this->pdo = null;

            exit();
        }
    }
}