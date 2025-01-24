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

        // Creo un token CSRF
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

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

        // Inicio o continuo la sesión
        session_start();

        $this->view->id = htmlspecialchars($param[0]);

        # asigno id a una propiedad de la vista
        $this->view->csrf_token = $param[1];

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $this->view->csrf_token)) {
            require_once 'controllers/error.php';
            $controller = new Errores('Petición no válida');
            exit();
        }

        # obtener objeto de la clase libro con el id asociado
        $this->view->libro = $this->model->read($this->view->id);

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


        # title
        $this->view->title = "Formulario Editar - Gestión de libros";

        # obtengo los datos del libro
        $this->view->autor_id = $this->model->get_autor_id($this->view->libro->id);
        $this->view->editorial_id = $this->model->get_editorial_id($this->view->libro->id);
        $this->view->libro_generos = $this->model->get_generos_ids($this->view->libro->id);

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
        // Inicio o continuo la sesión
        session_start();

        // obtengo el id del libro que voy a editar
        $id = htmlspecialchars($param[0]);

        // Obtengo el token CSRF
        $csrf_token = $param[1];

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
            require_once 'controllers/error.php';
            $controller = new Errores('Petición no válida');
            exit();
        }

        // Recogemos los detalles del formulario
        // Prevenir ataques XSS
        $titulo = filter_var($_POST['titulo'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $autor = filter_var($_POST['autor'] ??= '', FILTER_SANITIZE_NUMBER_INT);
        $editorial = filter_var($_POST['editorial'] ??= '', FILTER_SANITIZE_NUMBER_INT);
        $generos_id = isset($_POST['generos']) ? $_POST['generos'] : [];
        $generos_id = array_filter($generos_id, function($genero) {
            return filter_var($genero, FILTER_VALIDATE_INT);
        });
        $generos_id = implode(',', $generos_id);
        $stock = filter_var($_POST['stock'], FILTER_SANITIZE_NUMBER_INT);
        $precio = filter_var($_POST['precio'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

        # Creo un objeto de la clase libro con los detalles del formulario
        // Actualizo los detalles del libro
        $libro = new classlibro(
            $id,
            $titulo,
            $autor,
            $editorial,
            $generos_id,
            $stock,
            $precio
        );

        // Obtengo los detalles del libro de la base de datos
        $libro_db = $this->model->read($id);

        // Validación de los datos
        // Valido en caso de que haya sufrido modificaciones el campo correspondiente
        $error = [];

        // Validación del título
        // Reglas: obligatorio
        if(strcmp($titulo, $libro_db->titulo) !== 0) {
            $cambios = true;
            if(empty($titulo)){
                $error['titulo'] = 'El título es obligatorio';
            }
        }

        // Validación del autor
        // Reglas: Validación Clave Ajena: Obligatorio, numérico, id de autor existe en la tabla autores
        if(strcmp($autor, $libro_db->autor) !== 0) {
            $cambios = true;
            if(empty($autor)){
                $error['autor'] = 'El autor es obligatorio';
            } elseif (!filter_var($autor,FILTER_VALIDATE_INT)) {
                $error['autor'] = 'El autor debe ser un número';
            } elseif (!$this->model->get_autor_id($autor)) {
                $error['autor'] = 'El autor no existe';
            }
        }

        // Validación de la editorial
        // Reglas: Validación Clave Ajena, numérico, id de editorial existe en la tabla editoriales
        if(strcmp($editorial, $libro_db->editorial) !== 0) {
            $cambios = true;
            if(empty($editorial)){
                $error['editorial'] = 'La editorial es obligatoria';
            } elseif (!filter_var($editorial,FILTER_VALIDATE_INT)) {
                $error['editorial'] = 'La editorial debe ser un número';
            } elseif (!$this->model->get_editorial_id($editorial)) {
                $error['editorial'] = 'La editorial no existe';
            }
        }

        // Validación de unidades
        // Reglas: Opcional
        if(strcmp($stock, $libro_db->stock) !== 0) {
            $cambios = true;
            if(!empty($stock) && !filter_var($stock,FILTER_VALIDATE_INT)) {
                $error['stock'] = 'Las unidades deben ser un número';
            }
        }

        // Validación del precio
        // Reglas: Obligatorio, numérico
        if(strcmp($precio, $libro_db->precio) !== 0) {
            $cambios = true;
            if(empty($precio)){
                $error['precio'] = 'El precio es obligatorio';
            } elseif (!filter_var($precio,FILTER_VALIDATE_FLOAT)) {
                $error['precio'] = 'El precio debe ser un número';
            }
        }

        // Validación de los géneros
        // Reglas: Obligatorio (tengo que elegir al menos 1), valores numéricos, valores existentes en la tabla géneros
        if(strcmp($generos_id, $libro_db->generos_id) !== 0) {
            $cambios = true;
            if(empty($generos_id)){
                $error['generos'] = 'Debes elegir al menos un género';
            } else {
                $generos = explode(',', $generos_id);
                foreach ($generos as $genero) {
                    if (!filter_var($genero,FILTER_VALIDATE_INT) || !$this->model->get_generos_by_libro($genero)) {
                        $error['generos'] = 'El género no existe';
                        break;
                    }
                }
            }
        }

        // Si hay errores
        if (!empty($error)) {

            // Formulario no ha sido validado
            // Tengo que redireccionar al formulario de nuevo

            // Creo la variable de sesión libro con los datos del formulario
            $_SESSION['libro'] = $libro;

            // Creo la variable de sesión error con los errores
            $_SESSION['error'] = $error;
            
            header('location:' . URL . 'libro/editar/'.'/'.$csrf_token);
            exit();
        }

        // Necesito crear el método update en el modelo
        $this->model->update($libro, $id);

        // Genero mensaje de éxito
        $_SESSION['mensaje'] = 'Libro actualizado con éxito';

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
