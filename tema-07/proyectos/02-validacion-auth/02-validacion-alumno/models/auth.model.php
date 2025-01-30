<?php

/*
    auth.model.php

    Modelo del controlador auth

    Métodos:

        - get()
*/

class authModel extends Model
{

    /*
        método: validateUniqueName()

        Valida el name de usuario, devuelve verdadero si el nombre no existe en la tabla
    */
    public function validateUniqueName($name)
    {

        try {

            // sentencia sql
            $sql = "SELECT * FROM users WHERE name = :name";

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // vinculamos parámetros
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);

            // ejecutamos
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return FALSE;
            }

            return TRUE;

        } catch (PDOException $e) {

            // error base de datos
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }

    /*
        método: validateUniqueEmail()

        descripción: comprueba si un email ya existe en la base de datos, devuelve
        verdadero si es un valor único

        @param: email del usuario
    */
    public function validateUniqueEmail($email)
    {

        try {

            // sentencia sql
            $sql = "SELECT * FROM Users WHERE email = :email";

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // vinculamos parámetros
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);

            // ejecutamos
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return FALSE;
            }

            return TRUE;

        } catch (PDOException $e) {

            // error base de datos
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }

    /*
    método: create()

    descripción: crea un nuevo usuario en la base de datos

    @param: name del usuario, email del usuario, password del usuario
*/
    public function create($name, $email, $password)
    {
        try {

            // encriptamos la contraseña
            $password = password_hash($password, PASSWORD_DEFAULT);

            // sentencia sql
            $sql = "INSERT INTO Users (name, email, password)
        VALUES (:name, :email, :password)";

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // vinculamos parámetros
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':email', $name, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);

            // ejecutamos
            $stmt->execute();

            return $conexion->lastInsertId();

        } catch (PDOException $e) {

            // error base de datos
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }

    /*
        método: assignRol(int $id, int $role)

        descripción: asigna un rol a un usuario

        @param: id del usuario, role del usuario
    */

    public function assignRole($id, $role)
    {
        try {

            // sentencia sql
            $sql = "INSERT INTO userRoles(id, role) VALUES (:id, :role)";

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // vinculamos parámetros
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->bindParam(':role', $role, PDO::PARAM_STR);
    
            // ejecutamos
            $stmt->execute();

        } catch (PDOException $e) {

            // error base de datos
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }

    /*
        método: getUserEmail()

        descripción: obtiene un usuario por email

        @param: email del usuario
    */

    public function getUserEmail($email){

        $sql = "SELECT * FROM Users WHERE email = :email LIMIT 1";

        // conectamos con la base de datos
        $conexion = $this->db->connect();

        // ejecuto prepare
        $stmt = $conexion->prepare();

        $stmt->

        $stmt->bindParam(':email',$email,PDO::PARAM_STR);

        // ejecutamos
        $stmt->execute();

        return $stmt->fetch();
    }

}


