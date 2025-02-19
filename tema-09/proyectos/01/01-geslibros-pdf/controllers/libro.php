<?php

class Libro extends Controller
{

    function __construct()
    {

        parent::__construct();
    }

    /*
        Método checkLogin()

        Permite checkear si el usuario está logueado, si no está logueado 
        redirecciona a la página de login

    */
    public function checkLogin()
    {

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }
    }

    /*
        Método checkPermissions()

        Permite checkear si el usuario tiene permisos suficientes para acceder a una página

        @param
            - array $roles: roles permitidos
    */
    public function checkPermissions($priviliges)
    {

        // Comprobar si el usuario tiene permisos
        if (!in_array($_SESSION['role_id'], $priviliges)) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'libro');
            exit();
        }
    }

    /*
        Método checkTokenCsrf()

        Permite checkear si el token CSRF es válido

        @param
            - string $csrf_token: token CSRF
    */
    public function checkTokenCsrf($csrf_token)
    {

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
            require_once 'controllers/error.php';
            $controller = new Errores('Petición no válida');
            exit();
        }
    }

    /*
        Método principal

        Se  carga siempre que la url contenga sólo el primer parámetro

        url: /libro
    */
    public function render()
    {
        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['libro']['main']);

        // Creo un token CSRF
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

        // Compruebo si hay mensaje de éxito
        if (isset($_SESSION['mensaje'])) {

            // Creo la propiedad mensaje en la vista
            $this->view->mensaje = $_SESSION['mensaje'];

            // Elimino la variable de sesión mensaje
            unset($_SESSION['mensaje']);
        }

        // Compruebo si hay mensaje de error
        if (isset($_SESSION['mensaje_error'])) {

            // Creo la propiedad mensaje en la vista
            $this->view->mensaje_error = $_SESSION['mensaje_error'];

            // Elimino la variable de sesión mensaje
            unset($_SESSION['mensaje_error']);
        }


        // Compruebo validación errónea de formulario
        if (isset($_SESSION['error'])) {

            // Creo la propiedad mensaje_error en la vista
            $this->view->mensaje_error = $_SESSION['error'];

            // Elimino la variable de sesión error
            unset($_SESSION['error']);
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
        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['libro']['nuevo']);

        // Creo un token CSRF
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

        // Crear un objeto vacío de la clase libro
        $this->view->libro = new classLibro();

        // Comrpuebo si hay errores en la validación
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

        // Creo la propiead título
        $this->view->title = "Nuevo Libro - Gestión de libros";


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
        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['libro']['nuevo']);

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            // Manejar error de token CSRF
            $_SESSION['mensaje_error'] = 'Token CSRF inválido.';
            header('location:' . URL . 'libro/nuevo');
            exit();
        }

        // Recogemos los detalles del formulario saneados
        $titulo = filter_var($_POST['titulo'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
        $autor = filter_var($_POST['autor'] ?? '', FILTER_VALIDATE_INT);
        $editorial = filter_var($_POST['editorial'] ?? '', FILTER_VALIDATE_INT);
        $fecha_edicion = filter_var($_POST['fecha_edicion'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $isbn = filter_var($_POST['isbn'] ?? '', FILTER_VALIDATE_INT);
        $generos_id = isset($_POST['generos']) ? $_POST['generos'] : [];
        $generos_id = array_filter($generos_id, function ($genero) {
            return filter_var($genero, FILTER_VALIDATE_INT);
        });
        $generos_id = implode(',', $generos_id);
        $stock = filter_var($_POST['stock'], FILTER_SANITIZE_NUMBER_INT);
        $precio = filter_var($_POST['precio'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

        // Creamos un objeto de la clase libro
        $libro = new classLibro(
            null,
            $titulo,
            $precio,
            $stock,
            $fecha_edicion,
            $isbn,
            $autor,
            $editorial,
            $generos_id
        );

        // Validación de los datos
        $error = [];

        // Validación del título
        if (empty($titulo)) {
            $error['titulo'] = 'El título es obligatorio';
        }

        // Validación del autor
        if (empty($autor)) {
            $error['autor'] = 'El autor es obligatorio';
        } elseif (!is_numeric($autor)) {
            $error['autor'] = 'El autor debe ser un número';
        } elseif (!$this->model->autorExiste($autor)) {
            $error['autor'] = 'El autor no existe';
        }

        // Validación de la editorial
        if (empty($editorial)) {
            $error['editorial'] = 'La editorial es obligatoria';
        } elseif (!is_numeric($editorial)) {
            $error['editorial'] = 'La editorial debe ser un número';
        } elseif (!$this->model->editorialExiste($editorial)) {
            $error['editorial'] = 'La editorial no existe';
        }

        // Validación de la fecha de edición
        if (empty($fecha_edicion)) {
            $error['fecha_edicion'] = 'La fecha de edición es obligatoria';
        } elseif (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha_edicion)) {
            $error['fecha_edicion'] = 'La fecha de edición debe tener el formato YYYY-MM-DD';
        }

        // Validación del ISBN
        if (empty($isbn)) {
            $error['isbn'] = 'El ISBN es obligatorio';
        } elseif (!preg_match('/^\d{13}$/', $isbn)) {
            $error['isbn'] = 'El ISBN debe tener 13 dígitos';
        } elseif ($this->model->get_isbn($isbn)) {
            $error['isbn'] = 'El ISBN ya existe';
        }

        // Validación del precio
        if (empty($precio)) {
            $error['precio'] = 'El precio es obligatorio';
        } elseif (!is_numeric($precio)) {
            $error['precio'] = 'El precio debe ser un número';
        }

        // Validación de unidades
        if (!empty($stock) && !is_numeric($stock)) {
            $error['stock'] = 'El stock debe ser un número';
        }

        // Validación de los géneros
        if (empty($generos_id)) {
            $error['generos'] = 'Debes elegir al menos un género';
        } else {
            $generos = explode(',', $generos_id);
            foreach ($generos as $genero) {
                if (!$this->model->get_genero_id($genero)) {
                    $error['generos'] = 'Uno o más géneros no existen';
                    break;
                }
            }
        }

        // Si hay errores
        if (!empty($error)) {
            $_SESSION['error'] = $error;
            $_SESSION['libro'] = $libro;
            header('location:' . URL . 'libro/nuevo');
            exit();
        }

        // Añadimos libro a la tabla
        $this->model->create($libro);

        // Genero mensaje de éxito
        $_SESSION['mensaje'] = 'Libro añadido con éxito.';

        // redireciona al main de libro
        header('location:' . URL . 'libro');
        exit();
    }

    /*
        Método editar()

        Muestra el formulario que permite editar los detalles de un libro

        url asociada: /libro/editar/id/csrf_token

        @param
            - int $id: id del libro a editar
            - string $csrf_token: token CSRF

    */
    function editar($param = [])
    {
        // inicio o continuo la sesión
        session_start();

        // Validar token
        $this->checkTokenCsrf($param[1]);

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['libro']['editar']);

        # obtengo el id del libro que voy a editar
        // libro/edit/4
        $this->view->id = htmlspecialchars($param[0]);

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

        # title
        $this->view->title = "Formulario Editar - Gestión de libros";

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
        // inicio o continuo la sesión
        session_start();

        var_dump('Hola');
        exit();

        // obtengo el token CSRF para pasarlo luego al formulario editar en caso de error
        $csrf_token = $param[1];

        // Validar token
        $this->checkTokenCsrf($csrf_token);

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['libro']['editar']);

        // obtengo el id del libro que voy a editar
        $id = htmlspecialchars($param[0]);

        // Recogemos los detalles del formulario
        // Prevenir ataques XSS
        $titulo = filter_var($_POST['titulo'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
        $autor = filter_var($_POST['autor'] ?? '', FILTER_SANITIZE_NUMBER_INT);
        $editorial = filter_var($_POST['editorial'] ?? '', FILTER_SANITIZE_NUMBER_INT);
        $fecha_edicion = filter_var($_POST['fecha_edicion'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $isbn = filter_var($_POST['isbn'] ?? '', FILTER_VALIDATE_INT);
        $generos_id = isset($_POST['generos']) ? $_POST['generos'] : [];
        $generos_id = array_filter($generos_id, function ($genero) {
            return filter_var($genero, FILTER_VALIDATE_INT);
        });
        $generos_id = implode(',', $generos_id);
        $stock = filter_var($_POST['stock'], FILTER_SANITIZE_NUMBER_INT);
        $precio = filter_var($_POST['precio'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

        // Creo un objeto de la clase libro con los detalles del formulario
        $libro = new classlibro(
            $id,
            $titulo,
            $precio,
            $stock,
            $fecha_edicion,
            $isbn,
            $autor,
            $editorial,
            $generos_id
        );

        // Obtengo los detalles del libro de la base de datos
        $libro_db = $this->model->read($id);

        // Validación de los datos
        // Valido en caso de que haya sufrido modificaciones el campo correspondiente
        $error = [];
        $cambios = false;

        // Validación del título
        if (strcmp($titulo, $libro_db->titulo) !== 0) {
            $cambios = true;
            if (empty($titulo)) {
                $error['titulo'] = 'El título es obligatorio';
            }
        }

        // Validación del autor
        if (strcmp($autor, $libro_db->autor) !== 0) {
            $cambios = true;
            if (empty($autor)) {
                $error['autor'] = 'El autor es obligatorio';
            } elseif (!filter_var($autor, FILTER_VALIDATE_INT)) {
                $error['autor'] = 'El autor debe ser un número';
            } elseif (!$this->model->get_autor_id($autor)) {
                $error['autor'] = 'El autor no existe';
            }
        }

        // Validación de la editorial
        if (strcmp($editorial, $libro_db->editorial) !== 0) {
            $cambios = true;
            if (empty($editorial)) {
                $error['editorial'] = 'La editorial es obligatoria';
            } elseif (!filter_var($editorial, FILTER_VALIDATE_INT)) {
                $error['editorial'] = 'La editorial debe ser un número';
            } elseif (!$this->model->get_editorial_id($editorial)) {
                $error['editorial'] = 'La editorial no existe';
            }
        }

        // Validación de la fecha de edición
        if (strcmp($fecha_edicion, $libro_db->fecha_edicion) !== 0) {
            $cambios = true;
            if (empty($fecha_edicion)) {
                $error['fecha_edicion'] = 'La fecha de edición es obligatoria';
            } elseif (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha_edicion)) {
                $error['fecha_edicion'] = 'La fecha de edición debe tener el formato YYYY-MM-DD';
            }
        }

        // Validación del ISBN
        if (strcmp($isbn, $libro_db->isbn) !== 0) {
            $cambios = true;
            if (empty($isbn)) {
                $error['isbn'] = 'El ISBN es obligatorio';
            } elseif (!preg_match('/^\d{13}$/', $isbn)) {
                $error['isbn'] = 'El ISBN debe tener 13 dígitos';
            } elseif ($this->model->get_isbn($isbn)) {
                $error['isbn'] = 'El ISBN ya existe';
            }
        }

        // Validación de unidades
        if (strcmp($stock, $libro_db->stock) !== 0) {
            $cambios = true;
            if (!empty($stock) && !filter_var($stock, FILTER_VALIDATE_INT)) {
                $error['stock'] = 'Las unidades deben ser un número';
            }
        }

        // Validación del precio
        if (strcmp($precio, $libro_db->precio) !== 0) {
            $cambios = true;
            if (empty($precio)) {
                $error['precio'] = 'El precio es obligatorio';
            } elseif (!filter_var($precio, FILTER_VALIDATE_FLOAT)) {
                $error['precio'] = 'El precio debe ser un número';
            }
        }

        // Validación de los géneros
        if (strcmp($generos_id, $libro_db->generos_id) !== 0) {
            $cambios = true;
            if (empty($generos_id)) {
                $error['generos'] = 'Debes elegir al menos un género';
            } else {
                $generos = explode(',', $generos_id);
                foreach ($generos as $genero) {
                    if (!filter_var($genero, FILTER_VALIDATE_INT) || !$this->model->get_generos_by_libro($genero)) {
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

            header('location:' . URL . 'libro/editar/' . $id . '/' . $csrf_token);
            exit();
        }

        // Si hay cambios, actualizo el libro
        if (!$cambios) {
            // Genero mensaje de éxito
            $_SESSION['mensaje'] = 'No se han realizado cambios.';

            // redireciona al main de libro
            header('location:' . URL . 'libro');
            exit();
        }

        // Necesito crear el método update en el modelo
        $this->model->update($libro, $id);

        // Genero mensaje de éxito
        $_SESSION['mensaje'] = 'Libro actualizado con éxito';

        // Redirecciono al main de libro
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

        // inicio o continuo la sesión
        session_start();

        // Validar token
        $this->checkTokenCsrf($param[1]);

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['libro']['eliminar']);

        // obtengo el id del libro que voy a eliminar
        $id = htmlspecialchars($param[0]);

        // Validar id del libro
        // validateIdlibro($id) si existe devuelve TRUE
        if (!$this->model->validateIdlibro($id)) {
            // Genero mensaje de error
            $_SESSION['error'] = 'ID no válido';

            // redireciona al main de libro
            header('location:' . URL . 'libro');
            exit();
        }

        // Id ha sido validado
        // Elimino al libro de la base de datos
        $this->model->delete($id);

        // Genero mensaje de éxito
        $_SESSION['mensaje'] = 'libro eliminado con éxito';

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
        // inicio o continuo la sesión
        session_start();

        // Validar token
        $this->checkTokenCsrf($param[1]);

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['libro']['mostrar']);

        // obtengo el id del libro que voy a eliminar
        $id = htmlspecialchars($param[0]);

        // Validar id del libro
        // validateIdlibro($id) si existe devuelve TRUE
        if (!$this->model->validateIdlibro($id)) {
            // Genero mensaje de error
            $_SESSION['error'] = 'ID no válido';

            // redireciona al main de libro
            header('location:' . URL . 'libro');
            exit();
        }

        # Cargo el título
        $this->view->title = "Mostrar - Gestión de libros";

        # Obtengo los detalles del libro mediante el método read del modelo
        $this->view->libro = $this->model->read($id);

        # obtener los cursos
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
        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['libro']['filtrar']);

        # Obtengo la expresión de búsqueda
        $expresion = htmlspecialchars($_GET['expresion']);

        // obtengo el token CSRF
        $csrf_token = htmlspecialchars($_GET['csrf_token']);

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
            require_once 'controllers/error.php';
            $controller = new Errores('Petición no válida');
            exit();
        }

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
        // inicio o continuo la sesión
        session_start();

        // Validar token
        $this->checkTokenCsrf($param[1]);

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['libro']['ordenar']);

        // Obtener criterio
        $id = (int) htmlspecialchars($param[0]);

        # Criterios de ordenación
        $criterios = [
            1 => 'ID',
            2 => 'Título',
            3 => 'Autor',
            4 => 'Editorial',
            5 => 'Géneros',
            6 => 'Stock',
            7 => 'Precio',
            8 => 'Fecha de Edición',
            9 => 'ISBN'
        ];

        # Cargo el título
        $this->view->title = "Ordenar por {$criterios[$id]} - Gestión de libros";

        # Obtengo los libros ordenados por el campo id
        $this->view->libros = $this->model->order($id);

        # Cargo la vista
        $this->view->render('libro/main/index');
    }

    /*
        Método exportar()

        Permite exportar los libros a un archivo CSV

        url asociada: /libro/exportar/csv

        @param
            :string $format: formato de exportación
    */
    public function exportar($param = [])
    {
        // inicio o continuo la sesión
        session_start();

        // Validar token
        $this->checkTokenCsrf($param[1]);

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['libro']['exportar']);

        // Obtener formato
        // en nuestro caso no haría falta puesto que solo tenemos disponible csv
        $formato = $param[0];

        // Obtener libros
        $libros = $this->model->get_csv();

        // Crear archivo CSV
        $file = 'libros.csv';

        // Limpiar buffer antes de enviar headers
        if (ob_get_length())
            ob_clean();

        // Enviamos las cabeceras al navegador para empezar a descargar el archivo
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $file);
        header('Pragma: no-cache');
        header('Expires: 0');

        // Abrimos el archivo csv, con permisos de escritura
        $fichero = fopen('php://output', 'w');

        // Escribir BOM UTF-8 para compatibilidad con Excel
        fprintf($fichero, chr(0xEF) . chr(0xBB) . chr(0xBF));

        // Escribimos los datos del fichero csv
        foreach ($libros as $libro) {
            fputcsv($fichero, $libro, ';');
        }
        // Cerramos el fichero
        fclose($fichero);

        // Cerramos el buffer de salida y enviamos al cliente el archivo csv
        ob_end_flush();
        exit;
    }

    /*
        Método importar()

        Permite importar los libros desde un archivo CSV

        url asociada: /libro/importar/csv

        @param
            :string $format: formato de importación
    */
    public function importar($param = [])
    {
        // inicio o continuo la sesión
        session_start();

        // Validar token
        $this->checkTokenCsrf($param[1]);

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['libro']['importar']);

        // Comrpuebo si hay errores en la validación
        if (isset($_SESSION['mensaje_error'])) {

            // Creo la propiedad mensaje de error
            $this->view->mensaje_error = $_SESSION['mensaje_error'];

            // Elimino la variable de sesión error
            unset($_SESSION['mensaje_error']);
        }

        // Generar propiedad title
        $this->view->title = "Importar libros desde fichero CSV";

        // Cargar la vista
        $this->view->render('libro/importar/index');
    }

    public function validar($param = [])
    {
        // inicio o continuo la sesión
        session_start();

        // Validar token
        $this->checkTokenCsrf($_POST['csrf_token']);

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['libro']['importar']);

        // Comprobar si se ha subido un archivo
        if (!isset($_FILES['file'])) {
            $_SESSION['mensaje_error'] = 'No se ha subido ningún archivo';
            header('location:' . URL . 'libro/importar/csv/' . $_POST['csrf_token']);
            exit();
        }

        // Comprobar si el archivo se ha subido correctamente
        if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            $_SESSION['mensaje_error'] = 'Error al subir el archivo';
            header('location:' . URL . 'libro/importar/csv/' . $_POST['csrf_token']);
            exit();
        }

        // Verificar la extensión del archivo
        $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        if ($extension !== 'csv') {
            $_SESSION['mensaje_error'] = "El archivo debe tener extensión .csv";
            header('location:' . URL . 'libro/importar/csv/' . $_POST['csrf_token']);
            exit;
        }



        // Comprobar si el archivo es válido
        $file = $_FILES['file']['tmp_name'];

        // Abrir el archivo
        $fichero = fopen($file, 'r');

        // Leer el archivo
        $libros = [];

        while (($linea = fgetcsv($fichero, 0, ';')) !== FALSE) {
            $libros[] = $linea;

            // Validar ISBN
            if (!$this->model->validateUniqueISBN($linea[5])) {
                $_SESSION['mensaje_error'] = 'El ISBN ' . $linea[5] . ' ya existe';
                header('location:' . URL . 'libro/importar/csv/' . $_POST['csrf_token']);
                exit();
            }

            // Validar el autor
            if (!$this->model->autorNombreExiste($linea[2])) {
                $_SESSION['mensaje_error'] = 'El autor ' . $linea[2] . ' no existe';
                header('location:' . URL . 'libro/importar/csv/' . $_POST['csrf_token']);
                exit();
            }

            // Validar la editorial
            if (!$this->model->editorialNombreExiste($linea[3])) {
                $_SESSION['mensaje_error'] = 'La editorial ' . $linea[7] . ' no existe';
                header('location:' . URL . 'libro/importar/csv/' . $_POST['csrf_token']);
                exit();
            }
        }

        // Cerrar el archivo
        fclose($fichero);

        // Importar los libros
        $count = $this->model->import($libros);

        // Genero mensaje de éxito
        $_SESSION['mensaje'] = $count . ' libros importados con éxito';

        // redireciona al main de libro
        header('location:' . URL . 'libro');
        exit();
    }

    /*
       Método eliminar()

       Muestra el pdf con los datos de todos los libros

       url asociada: /libro/pdf

   */
    public function pdf($param = [])
    {

        // inicio o continuo la sesión
        session_start();

        // Validar token
        $this->checkTokenCsrf($param[0]);

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['libro']['pdf']);

        // Incluimos la librería fpdf
        require('fpdf186/fpdf_utf8.php');

        // Incluimos la clase pdf_libros
        require('class/pdf_libros.php');

        // Creo objeto pdf_libros
        $pdf = new Pdf_libros('P', 'mm', 'A4');

        // Imprimir número página actual
        $pdf->AliasNbPages();

        // Añadimos una página
        $pdf->AddPage();

        // Añado el título
        $pdf->titulo();

        // Cabecera del listado
        $pdf->cabecera();

        // Cuerpo listado
        $pdf->SetFont('Courier', '', 8);

        // Fondo
        $pdf->SetFillColor(205, 205, 205);

        // Establecemos el color de letra
        $pdf->SetTextColor(0,0,0);

        // Color de fondo
        $fondo = false;

        // Obtengo los libros
        $libros = $this->model->get();

        // Escribimos los datos de los libros en el pdf
        foreach ($libros as $libro) {
            $pdf->Cell(10, 10, $libro->id, 'T,B', 0, 'C', $fondo);
            $pdf->Cell(55, 10, $libro->titulo, 'T,B', 0, 'L', $fondo);
            $pdf->Cell(55, 10, $libro->autor, 'T,B', 0, 'L', $fondo);
            $pdf->Cell(55, 10, $libro->editorial, 'T,B', 0, 'L', $fondo);
            $pdf->Cell(15, 10, $libro->precio, 'T,B', 1, 'R', $fondo);

            // Cambio de color de fondo
            $fondo = !$fondo;
        }


        // Cerramos pdf
        $pdf->Output('I', 'listado_libros.pdf', true);
    }
}
