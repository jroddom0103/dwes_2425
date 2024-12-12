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

            $sql = 
            "SELECT
                libros.id,
                libros.titulo,
                autores.nombre as autor,
                editoriales.nombre as editorial,
                libros.fecha_edicion,
                libros.generos_id,
                libros.stock,
                libros.precio

             FROM
             libros
			 INNER JOIN autores ON libros.autor_id = autores.id
		     INNER JOIN editoriales ON libros.editorial_id = editoriales.id
             ORDER BY libros.id
            
            ";

            $stmt = $this->pdo->prepare($sql);

            $stmt->setFetchMode(PDO::FETCH_OBJ);

            $stmt->execute();

            return $stmt;

            
        } catch (PDOException $e) {

            include 'views/partials/errorDB.php';

            $this->pdo = null;

            $stmt = null;
            
        }
    }

    /*
        método: get_generos()
        descripcion: devuelve un array clave valor con la tabla géneros
    */

    public function get_generos()
    {
        try {

            $sql = 
            "SELECT
                id,
                tema
             FROM
             generos
            ";

            $stmt = $this->pdo->prepare($sql);

            $stmt->setFetchMode(PDO::FETCH_KEY_PAIR);

            $stmt->execute();

            return $stmt->fetchAll();

        } catch (PDOException $e) {

            include 'views/partials/errorDB.php';

            $this->pdo = null;

            $stmt = null;
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

        $generos_id = explode(',',$generos_id);

        $generos_libros = $this->get_generos();

        $generos_nominativos = [];

        foreach ($generos_libros as $id => $genero_libro) {
            
        }

        return $generos_nominativos;

        } catch (PDOException $e) {

            include 'views/partials/errorDB.php';

            $this->pdo = null;

            $stmt = null;
        }
    }

    /*
        método: get_autores()
        descripcion: devuelve un pdostatement par clave valor
    */

    public function get_autores()
    {
        try {

            try {

                $sql = 
                "SELECT
                    id,
                    nombre
                 FROM
                 autores
                ";
    
                $stmt = $this->pdo->prepare($sql);
    
                $stmt->setFetchMode(PDO::FETCH_KEY_PAIR);
    
                $stmt->execute();
    
                return $stmt->fetchAll();
    
            } catch (PDOException $e) {
    
                include 'views/partials/errorDB.php';
    
                $this->pdo = null;
    
                $stmt = null;
            }

        } catch (PDOException $e) {

            include 'views/partials/errorDB.php';

            $this->pdo = null;

            $stmt = null;
        }
    }

    /*
        método: get_editoriales()
        descripcion: devuelve un pdostatement par clave valor
    */

    public function get_editoriales()
    {
        try {

            try {

                $sql = 
                "SELECT
                    id,
                    nombre
                 FROM
                 editoriales
                ";
    
                $stmt = $this->pdo->prepare($sql);
    
                $stmt->setFetchMode(PDO::FETCH_KEY_PAIR);
    
                $stmt->execute();
    
                return $stmt->fetchAll();
    
            } catch (PDOException $e) {
    
                include 'views/partials/errorDB.php';
    
                $this->pdo = null;
    
                $stmt = null;
            }

        } catch (PDOException $e) {
            include 'views/partials/errorDB.php';

            $this->pdo = null;

            $stmt = null;
           
        }
    }

    /*
        método: create()
        descripcion: permite añadir un nuevo libro a la tabla
        
        parámetros:

            - $libro - objeto de la clase libro

    */
    public function create()
    {
        try {

            $sql = 
            "INSERT INTO libros VALUES
            (
                id=:null,
                titulo=:titulo,
                precio=:precio,
                stock=:stock,
                fecha_edicion=:fecha_edicion,
                isbn=:isbn,
                autor_id=:autor_id,
                editorial_id=:editorial_id,
                generos_id=:generos_id
            )
            ";

            $stmt = $this->pdo->prepare($sql);

            $stmt->bindParam(':titulo',$titulo,PDO::PARAM_STR);
            $stmt->bindParam(':precio',$precio,PDO::PARAM_STR);
            $stmt->bindParam(':stock',$stock,PDO::PARAM_INT);
            $stmt->bindParam(':fecha_edicion',$fecha_edicion,PDO::PARAM_STR);
            $stmt->bindParam(':isbn',$isbn,PDO::PARAM_STR);
            $stmt->bindParam(':autor_id',$autor_id,PDO::PARAM_INT);
            $stmt->bindParam(':editorial_id',$editorial_id,PDO::PARAM_INT);
            $stmt->bindParam(':generos_id',$generos_id,PDO::PARAM_INT);
            
            $stmt->setFetchMode(PDO::FETCH_OBJ);

            $stmt->fetch();

            $stmt->execute();

            return $stmt;
            
        } catch (PDOException $e) {

            include 'views/partials/errorDB.php';

            $this->pdo = null;

            $stmt = null;
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

    public function order()
    {
        try{
       
        } catch (PDOException $e) {

            include 'views/partials/errorDB.php';

            $this->pdo = null;

            $stmt = null;
        }
    }

}