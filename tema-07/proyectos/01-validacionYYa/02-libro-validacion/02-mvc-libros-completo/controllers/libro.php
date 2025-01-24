<?php

class Libro extends Controller
{

    function __construct()
    {

        parent::__construct();
    }

    /*
        Método principal

        Se  carga siempre que la url contenga sólo el primer parámetro

        url: /libro
    */
    public function render()
    {

        // Inicio o continuo la sesión
        session_start();

        // Compruebo si hay un mensaje de éxito
        if (isset($_SESSION['mensaje'])) {
        
            // Creo la propiedad mensaje de la vista
            $this->view->mensaje = $_SESSION['mensaje'];

            // Borro la variable de la sesión
            unset($_SESSION['mensaje']);
        
        }

        // Creo la propiedad title de la vista
        $this->view->title = "Gestión de Libros";

        // Creo la propiedad libros para usar en la vista
        $this->view->libros = $this->model->get();

        $this->view->render('libro/main/index');
    }

    /*
        Método nuevo()

        Muestra el formulario que permite añadir nuevo libro

        url asociada: /libro/nuevo
    */
    public function nuevo()
    {

        // Inicio o continuo la sesión
        session_start();

        // Crear un objeto vacío de la clase libro
        $this->view->libro = new classLibro();

        // Creo la propiead título
        $this->view->title = "Nuevo Libro - Gestión de libros";

        // Crear un token CSRF
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

        // Compruebo si hay errores en la validación
        if (isset($_SESSION['error'])) {
        
            // Creo la propiedad error en la vista
            $this->view->error = $_SESSION['error'];

            // Creo la propiedad libro en la vista
            $this->view->libro = $_SESSION['libro'];

            // Creo la propiedad mensaje de error
            $this->view->mensaje_error = 'Error en el formulario.';

            // Elimino la variable de sesión error
            unset($_SESSION['error']);

            // Elimino la variable de sesión libro
            unset($_SESSION['libro']);
        
        }

        // Creo la propiedad generos en la vista
        $this->view->generos = $this->model->get_generos();

        # obtengo todos los autores
        $this->view->autores = $this->model->get_autores();

        # obtengo todas las editoriales
        $this->view->editoriales = $this->model->get_editoriales();

        # obtengo todos los generos
        $this->view->generos = $this->model->get_generos();

        // Cargo la vista asociada a este método
        $this->view->render('libro/nuevo/index');
    }

    /*
        Método create()

        Permite añadir nuevo libro al formulario

        url asociada: /libro/create
        POST: detalles del libro
    */
    public function create()
    {

        // Inicio o continuo la sesión
        session_start();

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            die('Petición no válida');
        }

        // Recogemos los detalles del formulario
        $titulo = $_POST['titulo'];
        $autor = $_POST['autor'];
        $editorial = $_POST['editorial'];
        $generos_id = isset($_POST['generos']) ? implode(',', $_POST['generos']) : '';
        $stock = $_POST['stock'];
        $precio = $_POST['precio'];

        // Creamos un objeto de la clase libro
        $libro = new classlibro(
            null,
            $titulo,
            $autor,
            $editorial,
            $generos_id,
            $stock,
            $precio
        );

        // Validación de los datos

        // Creo un array para almacenar los errores
        $error = [];

        // Validación del título
        // Reglas: obligatorio
        if (empty($titulo)) {
            $error['titulo'] = 'El título es obligatorio';
        }

        // Validación del autor
        // Reglas: Validación Clave Ajena: Obligatorio, numérico, id de autor existe en la tabla autores
        if (empty($autor)) {
            $error['autor'] = 'El autor es obligatorio';
        } elseif (!is_numeric($autor)) {
            $error['autor'] = 'El autor debe ser un número';
        } elseif (!$this->model->get_autor_id($autor)) {
            $error['autor'] = 'El autor no existe';
        }

        // Validación de la editorial
        // Reglas: Validación Clave Ajena, numérico, id de editorial existe en la tabla editoriales
        if (empty($editorial)) {
            $error['editorial'] = 'La editorial es obligatoria';
        } elseif (!is_numeric($editorial)) {
            $error['editorial'] = 'La editorial debe ser un número';
        } elseif (!$this->model->get_editorial_id($editorial)) {
            $error['editorial'] = 'La editorial no existe';
        }

        // Validación del precio
        // Reglas: Obligatorio, numérico
        if (empty($precio)) {
            $error['precio'] = 'El precio es obligatorio';
        } elseif (!is_numeric($precio)) {
            $error['precio'] = 'El precio debe ser un número';
        }

        // Validación de unidades
        // Reglas: Opcional
        if (!empty($stock) && !is_numeric($stock)) {
            $error['stock'] = 'Las unidades deben ser un número';
        }

        // Fecha Edición
        // Reglas: Obligatorio, formato tipo fecha
        if (empty($fecha_edicion)) {
            $error['fecha_edicion'] = 'La fecha de edición es obligatoria';
        } elseif (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha_edicion)) {
            $error['fecha_edicion'] = 'La fecha de edición debe tener el formato YYYY-MM-DD';
        }

        // ISBN
        // Reglas: Obligatorio, formato ISBN (13 dígitos numéricos) y valor único
        if (empty($isbn)) {
            $error['isbn'] = 'El ISBN es obligatorio';
        } elseif (!preg_match('/^\d{13}$/', $isbn)) {
            $error['isbn'] = 'El ISBN debe tener 13 dígitos';
        } elseif ($this->model->get_isbn($isbn)) {
            $error['isbn'] = 'El ISBN ya existe';
        }

        // Validación de los géneros
        // Reglas: Obligatorio (tengo que elegir al menos 1), valores numéricos, valores existentes en la tabla géneros
        if (empty($generos_id)) {
            $error['generos'] = 'Debes elegir al menos un género';
        } else {
            $generos = explode(',', $generos_id);
            foreach ($generos as $genero) {
                if (!is_numeric($genero) || !$this->model->get_genero_id($genero)) {
                    $error['generos'] = 'El género no existe';
                    break;
                }
            }
        }

        // Añadimos libro a la tabla
        $this->model->create($libro);

        // redireciona al main de libro
        header('location:' . URL . 'libro');
    }

    /*
        Método editar()

        Muestra el formulario que permite editar los detalles de un libro

        url asociada: /libro/editar/id

        @param int $id: id del libro a editar

    */
    function editar($param = [])
    {

        # obtengo el id del libro que voy a editar
        // libro/edit/4
        // -- libro es el nombre del controlador
        // -- edit es el nombre del método
        // -- $param es un array porque puedo pasar varios parámetros a un método

        $id = $param[0];

        # asigno id a una propiedad de la vista
        $this->view->id = $id;

        # title
        $this->view->title = "Formulario Editar - Gestión de libros";

        // Necesito crear el método read en el modelo
        $this->view->libro = $this->model->read($id);

        # obtengo los datos del libro
        $this->view->autor_id = $this->model->get_autor_id($id);
        $this->view->editorial_id = $this->model->get_editorial_id($id);
        $this->view->libro_generos = $this->model->get_generos_ids($id);

        # obtengo todos los autores
        $this->view->autores = $this->model->get_autores();

        # obtengo todas las editoriales
        $this->view->editoriales = $this->model->get_editoriales();

        # obtengo todos los generos
        $this->view->generos = $this->model->get_generos();

        # cargo la vista
        $this->view->render('libro/editar/index');
    }

    /*
        Método update()

        Actualiza los detalles de un libro

        url asociada: /libro/update/id

        POST: detalles del libro

        @param int $id: id del libro a editar
    */
    public function update($param = [])
    {

        # Cargo id del libro
        $id = $param[0];

        // Recogemos los detalles del formulario
        $titulo = $_POST['titulo'];
        $autor = $_POST['autor'];
        $editorial = $_POST['editorial'];
        $generos_id = isset($_POST['generos']) ? implode(',', $_POST['generos']) : '';
        $stock = $_POST['stock'];
        $precio = $_POST['precio'];

        # Con los detalles formulario creo objeto libro
        $libro = new classlibro(

            null,
            $titulo,
            $autor,
            $editorial,
            $generos_id,
            $stock,
            $precio

        );

        # Actualizo base  de datos
        // Necesito crear el método update en el modelo
        $this->model->update($libro, $id);

        # Cargo el controlador principal de libro
        header('location:' . URL . 'libro');
    }

    /*
        Método eliminar()

        Borra un libro de la base de datos

        url asociada: /libro/eliminar/id

        @param
            :int $id: id del libro a eliminar
    */
    public function eliminar($param = [])
    {

        # Cargo id del libro
        $id = $param[0];

        # Elimino libro de la base de datos
        $this->model->delete($id);

        # Cargo el controlador principal de libro
        header('location:' . URL . 'libro');
    }

    /*
        Método mostrar()

        Muestra los detalles de un libro

        url asociada: /libro/mostrar/id

        @param
            :int $id: id del libro a mostrar
    */
    public function mostrar($param = [])
    {

        # Cargo id del libro
        $id = $param[0];

        # Cargo el título
        $this->view->title = "Mostrar - Gestión de libros";

        # Obtengo los detalles del libro mediante el método read del modelo
        $this->view->libro = $this->model->read($id);

        $this->view->generos = $this->model->get_generos_by_libro($id);

        # Cargo la vista
        $this->view->render('libro/mostrar/index');
    }

    /*
        Método filtrar()

        Busca un libro en la base de datos

        url asociada: /libro/filtrar/expresion

        GET: 
            - expresion de búsqueda

        DEVUELVE:
            - PDOStatement con los libros que coinciden con la expresión de búsqueda
    */
    public function filtrar()
    {

        # Obtengo la expresión de búsqueda
        $expresion = $_GET['expresion'];

        # Cargo el título
        $this->view->title = "Filtrar por: {$expresion} - Gestión de libros";



        # Obtengo los libros que coinciden con la expresión de búsqueda
        $this->view->libros = $this->model->filter($expresion);

        # Cargo la vista
        $this->view->render('libro/main/index');
    }

    /*
        Método ordenar()

        Ordena los libros de la base de datos

        url asociada: /libro/ordenar/id

        @param
            :int $id: id del campo por el que se ordenarán los libros
    */
    public function ordenar($param = [])
    {

        # Criterios de ordenación
        $criterios = [
            1 => 'ID',
            2 => 'libro',
            3 => 'Email',
            4 => 'Teléfono',
            5 => 'Nacionalidad',
            6 => 'DNI',
            7 => 'Curso',
            8 => 'Edad'
        ];

        # Obtengo el id del campo por el que se ordenarán los libros
        $id = $param[0];


        # Cargo el título
        $this->view->title = "Ordenar por {$criterios[$id]} - Gestión de libros";

        # Obtengo los libros ordenados por el campo id
        $this->view->libros = $this->model->order($id);

        # Cargo la vista
        $this->view->render('libro/main/index');
    }
}
