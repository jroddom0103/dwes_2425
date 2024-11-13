<?php
    /*
        modelo: model.create.php
        descripción: añade el nuevo alumno a la tabla
        
        Métod POST:
            - id
            - nombre
            - apellidos
            - email
            - f_nacimiento
            - curso
            - asignaturas[]
    */

    # Cargo los detalles del  formulario
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $f_nacimiento = $_POST['f_nacimiento'];
    $curso = $_POST['curso'];
    $asignaturas = $_POST['asignaturas'];

    # Validación

    # Crear un objeto de la clase tabla_alumnos
    $obj_tabla_alumnos = new Class_tabla_alumnos();

    # Cargo los alumnos
    $obj_tabla_alumnos->getDatos();

    # Obtengo el array de cursos
    $cursos = $obj_tabla_alumnos->getCursos();

    # Obtengo el  array de categorias
    $array_asignaturas = $obj_tabla_alumnos->getAsignaturas();

    # Crear un objeto de la clase alumnos a partir de los detalles del formulario
    $alumno = new Class_alumno(
        $id,
        $nombre,
        $apellidos,
        $email,
        $f_nacimiento,
        $curso,
        $asignaturas
    );

    # Añadir el alumno a la tabla
    $obj_tabla_alumnos->create($alumno);

    # Obtener la array alumnos
    $array_alumnos = $obj_tabla_alumnos->getTabla();