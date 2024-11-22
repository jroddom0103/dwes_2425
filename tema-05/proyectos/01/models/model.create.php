<?php
    /*
        autor: model.create.php
        descripción: añade el nuevo artículo a la tabla
        
        Métod POST:
            - id
            - titulo
            - autor
            - fecha_edicion
            - materia (indice)
            - etiquetas (array)
            - precio
    */

    # Cargo los detalles del  formulario
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $editorial = $_POST['editorial'];
    $fecha_edicion = $_POST['fecha_edicion'];
    $materia = $_POST['materia'];
    $etiquetas = $_POST['etiquetas'];
    $precio = $_POST['precio'];
    

    # Validación

    # Crear un objeto de la clase tabla_libros
    $obj_tabla_alumnos = new Class_tabla_alumnos();

    # Cargo los libros
    $obj_tabla_alumnos->getDatos();

    # Obtengo el array de materias
    $materia = $obj_tabla_alumnos->getMaterias();

    # Obtengo el  array de etiquetas
    $array_etiquetas = $obj_tabla_alumnos->getEtiquetas();

    # Crear un objeto de la clase artículos a partir de los detalles del formulario
    $libro = new Class_alumno(
        $id,
        $titulo,
        $autor,
        $editorial,
        $fecha_edicion,
        $materia,
        $etiquetas,
        $precio
    );

    # Añadir el artículo a la tabla
    $obj_tabla_alumnos->create($libro);
    
    # Forma alternativa ya que la propueda tabla es pública
    //$obj_tabla_alumnos->tabla[] = $libro;

    # Obtener la array artículos
    $array_alumnos = $obj_tabla_alumnos->tabla;