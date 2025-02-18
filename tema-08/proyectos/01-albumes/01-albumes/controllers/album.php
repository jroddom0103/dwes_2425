<?php

class Album extends Controller
{

    function __construct()
    {

        parent::__construct();
    }

    /*
        Método principal

        Se  carga siempre que la url contenga sólo el primer parámetro

        url: /album
    */
    public function render()
    {
        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje de error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        } // Comprobar si el usuario tiene permisos
        else if (!in_array($_SESSION['role_id'], $GLOBALS['album']['main'])) {
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'auth/login');
            exit();
        }

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

        // Actualizar el número de fotos en cada álbum
        $albumes = $this->model->get();
        foreach ($albumes as $album) {
            $uploadDir = __DIR__ . '/../uploads/albumes/' . $album->carpeta . '/';
            $numFotos = 0;
            if (is_dir($uploadDir)) {
                $files = scandir($uploadDir);
                foreach ($files as $file) {
                    if (in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif'])) {
                        $numFotos++;
                    }
                }
            }
            $this->model->actualizarNumFotos($album->id, $numFotos);
        }

        // Creo la propiedad title de la vista
        $this->view->title = "Gestión de Álbumes";

        // Creo la propiedad albumes para usar en la vista
        $this->view->albumes = $this->model->get();

        $this->view->render('album/main/index');
    }

    /*
        Método nuevo()

        Muestra el formulario que permite añadir nuevo album

        url asociada: /album/nuevo
    */
    public function nuevo()
    {
        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }
        // Comprobar si el usuario tiene permisos
        else if (!in_array($_SESSION['role_id'], $GLOBALS['album']['nuevo'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'album');
            exit();
        }

        // Creo un token CSRF
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

        // Crear un objeto vacío de la clase album
        $this->view->album = new classAlbum();

        // Comrpuebo si hay errores en la validación
        if (isset($_SESSION['error'])) {

            // Creo la propiedad error en la vista
            $this->view->error = $_SESSION['error'];

            // Creo la propiedad album en la vista
            $this->view->album = $_SESSION['album'];

            // Creo la propiedad mensaje de error
            $this->view->mensaje_error = 'Error en el formulario';

            // Elimino la variable de sesión error
            unset($_SESSION['error']);

            // Elimino la variable de sesión album
            unset($_SESSION['album']);
        }

        // Creo la propiead título
        $this->view->title = "Añadir - Gestión de Álbumes";

        // Creo la propiedad categorias en la vista
        $this->view->categorias = $this->model->get_categorias();

        // Cargo la vista asociada a este método
        $this->view->render('album/nuevo/index');
    }

    /*
        Método create()

        Permite añadir nuevo album al formulario

        url asociada: /album/create
        POST: detalles del album
    */
    public function create()
    {

        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }
        // Comprobar si el usuario tiene permisos
        else if (!in_array($_SESSION['role_id'], $GLOBALS['album']['nuevo'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'album');
            exit();
        }

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            // require_once 'controllers/error.php';
            // $controller = new Errores('Petición no válida');
            // exit();
            header('location:' . URL . 'errores');
            exit();
        }

        // Recogemos los detalles del formulario saneados
        // Prevenir ataques XSS
        $titulo = filter_var($_POST['titulo'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $descripcion = filter_var($_POST['descripcion'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $autor = filter_var($_POST['autor'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $fecha = filter_var($_POST['fecha'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $lugar = filter_var($_POST['lugar'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $categoria = filter_var($_POST['categoria'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $etiquetas = filter_var($_POST['etiquetas'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $carpeta = filter_var($_POST['carpeta'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);

        // Creamos un objeto de la clase album con los detalles del formulario
        $album = new classAlbum(
            null,
            $titulo,
            $descripcion,
            $autor,
            $fecha,
            $lugar,
            $categoria,
            $etiquetas,
            0,
            0,
            $carpeta,
        );

        // Validación de los datos

        // Creo un array para almacenar los errores
        $error = [];

        // Validación del título
        // Reglas: obligatorio, menos de 100 caracteres
        if (empty($titulo)) {
            $error['titulo'] = 'El título es obligatorio';
        } else if (strlen($titulo) > 100) {
            $error['titulo'] = 'El título no puede tener más de 100 caracteres';
        }

        // Validación de la descripción
        // Reglas: obligatorio
        if (empty($descripcion)) {
            $error['descripcion'] = 'La descripción es obligatoria';
        }

        // Validación del autor
        // Reglas: obligatorio
        if (empty($autor)) {
            $error['autor'] = 'El autor es obligatorio';
        }

        // Validación de la fecha
        // Reglas: obligatorio, formato fecha
        if (empty($fecha)) {
            $error['fecha'] = 'La fecha es obligatoria';
        } else {
            $fecha = DateTime::createFromFormat('Y-m-d', $fecha);
            if (!$fecha) {
                $error['fecha'] = 'El formato de la fecha no es correcto';
            }
        }

        // Validación del lugar
        // Reglas: obligatorio
        if (empty($lugar)) {
            $error['lugar'] = 'El lugar es obligatorio';
        }

        // Validación de la categoría
        // Reglas: obligatorio
        if (empty($categoria)) {
            $error['categoria'] = 'La categoría es obligatoria';
        }

        // Validación de las etiquetas
        // Reglas: obligatorio
        if (empty($etiquetas)) {
            $error['etiquetas'] = 'Las etiquetas son obligatorias';
        }

        // Validación de la carpeta
        // Reglas: obligatorio, sin espacios, única
        if (empty($carpeta)) {
            $error['carpeta'] = 'La carpeta es obligatoria';
        } else if (strpos($carpeta, ' ') !== false) {
            $error['carpeta'] = 'La carpeta no puede contener espacios';
        } else if (!$this->model->validateUniqueCarpeta($carpeta)) {
            $error['carpeta'] = 'La carpeta ya existe';
        }

        // Si hay errores
        if (!empty($error)) {

            // Formulario no ha sido validado
            // Tengo que redireccionar al formulario de nuevo

            // Creo la variable de sessión album con los datos del formulario
            $_SESSION['album'] = $album;

            // Creo la variable de sessión error con los errores
            $_SESSION['error'] = $error;

            // redireciona al formulario de nuevo
            header('location:' . URL . 'album/nuevo');
            exit();
        }

        // Añadimos album a la tabla
        $this->model->create($album);

        // Creación de directorio con control de errores
        $rutaBase = __DIR__ . '/../uploads/albumes/';
        $rutaDirectorio = $rutaBase . $carpeta;

        if (!is_dir($rutaDirectorio) && !mkdir($rutaDirectorio, 0777, true)) {
            $_SESSION['mensaje_error'] = "Error al crear la carpeta.";
            header('location:' . URL . 'album/nuevo');
            exit();
        }

        // Genero mensaje de éxito
        $_SESSION['mensaje'] = 'Álbum añadido con éxito';

        // redireciona al main de album
        header('location:' . URL . 'album');
        exit();
    }

    /*
        Método editar()

        Muestra el formulario que permite editar los detalles de un album

        url asociada: /album/editar/id/csrf_token

        @param
            - int $id: id del album a editar
            - string $csrf_token: token CSRF

    */
    function editar($param = [])
    {
        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }
        // Comprobar si el usuario tiene permisos
        else if (!in_array($_SESSION['role_id'], $GLOBALS['album']['editar'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'album');
            exit();
        }

        # obtengo el id del album que voy a editar
        // album/edit/4
        $this->view->id = htmlspecialchars($param[0]);

        # obtengo el token CSRF
        $this->view->csrf_token = $param[1];

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $this->view->csrf_token)) {
            require_once 'controllers/error.php';
            $controller = new Errores('Petición no válida');
            exit();
        }

        # obtener objeto de la clase album con el id asociado
        $this->view->album = $this->model->read($this->view->id);

        // Comrpuebo si hay errores en la validación
        if (isset($_SESSION['error'])) {

            // Creo la propiedad error en la vista
            $this->view->error = $_SESSION['error'];

            // Creo la propiedad album en la vista
            $this->view->album = $_SESSION['album'];

            // Creo la propiedad mensaje de error
            $this->view->mensaje_error = 'Error en el formulario';

            // Elimino la variable de sesión error
            unset($_SESSION['error']);

            // Elimino la variable de sesión album
            unset($_SESSION['album']);
        }

        # obtener los cursos
        $this->view->cursos = $this->model->get_cursos();

        # title
        $this->view->title = "Formulario Editar Álbum";

        # cargo la vista
        $this->view->render('album/editar/index');
    }

    /*
        Método update()

        Actualiza los detalles de un album

        url asociada: /album/update/id

        POST: detalles del album

        @param int $id: id del album a editar
    */
    public function update($param = [])
    {
        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }
        // Comprobar si el usuario tiene permisos
        else if (!in_array($_SESSION['role_id'], $GLOBALS['album']['editar'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'album');
            exit();
        }

        // obtengo el id del album que voy a editar
        $id = htmlspecialchars($param[0]);

        // obtengo el token CSRF
        $csrf_token = $param[1];

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
            require_once 'controllers/error.php';
            $controller = new Errores('Petición no válida');
            exit();
        }

        // Recogemos los detalles del formulario saneados
        // Prevenir ataques XSS
        $nombre = filter_var($_POST['nombre'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $apellidos = filter_var($_POST['apellidos'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $fechaNac = filter_var($_POST['fechaNac'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $dni = filter_var($_POST['dni'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL);
        $telefono = filter_var($_POST['telefono'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $nacionalidad = filter_var($_POST['nacionalidad'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $id_curso = filter_var($_POST['id_curso'] ??= '', FILTER_SANITIZE_NUMBER_INT);

        // Creo un objeto de la clase album con los detalles del formulario
        // Actualizo los detalles del album
        $album_form = new classAlbum(
            $id,
            $nombre,
            $apellidos,
            $email,
            $telefono,
            null,
            null,
            null,
            $nacionalidad,
            $dni,
            $fechaNac,
            $id_curso
        );

        // Obtengo los detalles del album de la base de datos
        $album = $this->model->read($id);

        // Validación de los datos
        // Valido en caso de que haya sufrido modificaciones el campo correspondiente
        $error = [];

        // Control de cambios en los campos
        $cambios = false;

        // Validación del nombre
        // Reglas: obligatorio
        if (strcmp($nombre, $album->nombre) != 0) {
            $cambios = true;
            if (empty($nombre)) {
                $error['nombre'] = 'El nombre es obligatorio';
            }
        }

        // Validación de los apellidos
        // Reglas: obligatorio
        if (strcmp($apellidos, $album->apellidos) != 0) {
            $cambios = true;
            if (empty($apellidos)) {
                $error['apellidos'] = 'Los apellidos son obligatorios';
            }
        }

        // Validación de la fecha de nacimiento
        // Reglas: obligatorio, formato fecha
        if (strcmp($fechaNac, $album->fechaNac) != 0) {
            $cambios = true;
            if (empty($fechaNac)) {
                $error['fechaNac'] = 'La fecha de nacimiento es obligatoria';
            } else {
                $fecha = DateTime::createFromFormat('Y-m-d', $fechaNac);
                if (!$fecha) {
                    $error['fechaNac'] = 'El formato de la fecha de nacimiento no es correcto';
                }
            }
        }

        // Validación del DNI
        // Reglas: obligatorio, formato DNI y clave secundaria
        if (strcmp($dni, $album->dni) != 0) {
            $cambios = true;
            // Expresión regular para validar el DNI
            // 8 números seguidos de una letra
            $options = [
                'options' => [
                    'regexp' => '/^(\d{8})([A-Za-z])$/'
                ]
            ];

            if (empty($dni)) {
                $error['dni'] = 'El DNI es obligatorio';
            } else if (!filter_var($dni, FILTER_VALIDATE_REGEXP, $options)) {
                $error['dni'] = 'Formato DNI no es correcto';
            } else if (!$this->model->validateUniqueDNI($dni)) {
                $error['dni'] = 'El DNI ya existe';
            }
        }

        // Validación del email
        // Reglas: obligatorio, formato email y clave secundaria
        if (strcmp($email, $album->email) != 0) {
            $cambios = true;
            if (empty($email)) {
                $error['email'] = 'El email es obligatorio';
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error['email'] = 'El formato del email no es correcto';
            } else if (!$this->model->validateUniqueEmail($email)) {
                $error['email'] = 'El email ya existe';
            }
        }

        // Validación del teléfono
        // Reglas: obligatorio, formato teléfono
        if (strcmp($telefono, $album->telefono) != 0) {
            $cambios = true;
            if (empty($telefono)) {
                $error['telefono'] = 'El teléfono es obligatorio';
            } else if (!preg_match('/^\d{9}$/', $telefono)) {
                $error['telefono'] = 'El formato del teléfono no es correcto';
            }
        }

        // Validación de la nacionalidad
        // Reglas: No obligatorio

        // Validación id_curso
        // Reglas: obligatorio, entero, clave ajena
        if ($id_curso = !$album->id_curso) {
            $cambios = true;
            if (empty($id_curso)) {
                $error['id_curso'] = 'El curso es obligatorio';
            } else if (!filter_var($id_curso, FILTER_VALIDATE_INT)) {
                $error['id_curso'] = 'El formato del curso no es correcto';
            } else if (!$this->model->validateForeignKeyCurso($id_curso)) {
                $error['id_curso'] = 'El curso no existe';
            }
        }

        // Si hay errores
        if (!empty($error)) {

            // Formulario no ha sido validado
            // Tengo que redireccionar al formulario de nuevo

            // Creo la variable de sessión album con los datos del formulario
            $_SESSION['album'] = $album_form;

            // Creo la variable de sessión error con los errores
            $_SESSION['error'] = $error;

            // redireciona al formulario de nuevo
            header('location:' . URL . 'album/editar/' . $id . '/' . $csrf_token);
            exit();
        }

        // Compruebo si ha habido cambios
        if (!$cambios) {
            // Genero mensaje de éxito
            $_SESSION['mensaje'] = 'No se han realizado cambios';

            // redireciona al main de album
            header('location:' . URL . 'album');
            exit();
        }
        // Necesito crear el método update en el modelo
        $this->model->update($album_form, $id);

        // Genero mensaje de éxito
        $_SESSION['mensaje'] = 'Álbum actualizado con éxito';

        # Cargo el controlador principal de album
        header('location:' . URL . 'album');
        exit();
    }

    /*
    Método eliminar()

    Borra un álbum de la base de datos

    url asociada: /album/eliminar/id

    @param
        :int $id: ID del álbum a eliminar
*/
    public function eliminar($param = [])
    {
        session_start();

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }

        // Comprobar si el usuario tiene permisos
        if (!in_array($_SESSION['role_id'], $GLOBALS['album']['eliminar'])) {
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'album');
            exit();
        }

        // Validar ID
        $id = (int) $param[0];  // Convertimos el parámetro en un entero seguro
        $csrf_token = $param[1];

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
            require_once 'controllers/error.php';
            $controller = new Errores('Petición no válida');
            exit();
        }

        try {
            // Verificar si el álbum existe
            $album = $this->model->read($id);
            if (!$album) {
                $_SESSION['mensaje_error'] = 'El álbum no existe o ya ha sido eliminado';
                header('location:' . URL . 'album');
                exit();
            }

            // Intentar eliminar el álbum de la base de datos
            if ($this->model->delete($id)) {
                throw new Exception('Error al eliminar el álbum');
            }

            // Eliminar la carpeta y archivos asociados
            $rutaDirectorio = __DIR__ . '/../uploads/albumes/' . $album->carpeta;
            if (is_dir($rutaDirectorio)) {
                $archivos = scandir($rutaDirectorio);
                foreach ($archivos as $archivo) {
                    if ($archivo !== '.' && $archivo !== '..') {
                        unlink("$rutaDirectorio/$archivo");
                    }
                }
                rmdir($rutaDirectorio);
            }

            $_SESSION['mensaje'] = 'Álbum eliminado con éxito';
        } catch (Exception $e) {
            $_SESSION['mensaje_error'] = 'Error: ' . $e->getMessage();
        }

        // Redireccionar al listado de álbumes
        header('location:' . URL . 'album');
        exit();
    }


    /*
        Método mostrar()

        Muestra los detalles de un album

        url asociada: /album/mostrar/id

        @param
            :int $id: id del album a mostrar
    */
    /*
       Método mostrar()

       Muestra los detalles de un album

       url asociada: /album/mostrar/id

       @param
           :int $id: id del album a mostrar
   */
    public function mostrar($param = [])
    {
        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }
        // Comprobar si el usuario tiene permisos
        else if (!in_array($_SESSION['role_id'], $GLOBALS['album']['mostrar'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'album');
            exit();
        }

        // obtengo el id del album que voy a mostrar
        $id = htmlspecialchars($param[0]);

        // obtengo el token CSRF
        $csrf_token = $param[1];

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
            require_once 'controllers/error.php';
            $controller = new Errores('Petición no válida');
            exit();
        }

        // Validar id del album
        if (!$this->model->validateIdAlbum($id)) {
            // Genero mensaje de error
            $_SESSION['error'] = 'ID no válido';

            // redireciona al main de album
            header('location:' . URL . 'album');
            exit();
        }

        // Obtengo los detalles del album mediante el método read del modelo
        $this->view->album = $this->model->read($id);

        // Obtener las fotos del álbum
        $albumDir = __DIR__ . '/../uploads/albumes/' . $this->view->album->carpeta;
        $fotos = [];
        if (is_dir($albumDir)) {
            $files = scandir($albumDir);
            foreach ($files as $file) {
                if (in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif'])) {
                    $fotos[] = $file;
                }
            }
        }
        $this->view->fotos = $fotos;

        // Cargo el título
        $this->view->title = "Mostrar - Gestión de Álbumes";

        // Cargo la vista
        $this->view->render('album/mostrar/index');
    }

    /*
        Método filtrar()

        Busca un album en la base de datos

        url asociada: /album/filtrar/expresion

        GET: 
            - expresion de búsqueda

        DEVUELVE:
            - PDOStatement con los albumes que coinciden con la expresión de búsqueda
    */
    public function filtrar()
    {
        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }
        // Comprobar si el usuario tiene permisos
        else if (!in_array($_SESSION['role_id'], $GLOBALS['album']['filtrar'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'album');
            exit();
        }

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
        $this->view->title = "Filtrar por: {$expresion} - Gestión de Álbumes";

        # Obtengo los álbumes que coinciden con la expresión de búsqueda
        $this->view->albumes = $this->model->filter($expresion);

        # Cargo la vista
        $this->view->render('album/main/index');
    }

    /*
        Método ordenar()

        Ordena los albumes de la base de datos

        url asociada: /album/ordenar/id

        @param
            :int $id: id del campo por el que se ordenarán los albumes
    */
    public function ordenar($param = [])
    {
        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }
        // Comprobar si el usuario tiene permisos
        else if (!in_array($_SESSION['role_id'], $GLOBALS['album']['ordenar'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'album');
            exit();
        }

        // Obtener criterio
        $id = (int) htmlspecialchars($param[0]);

        // Obtener csrf_token
        $csrf_token = $param[1];

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
            require_once 'controllers/error.php';
            $controller = new Errores('Petición no válida');
            exit();
        }

        # Criterios de ordenación
        $criterios = [
            1 => 'ID',
            2 => 'Título',
            3 => 'Descripción',
            4 => 'Autor',
            5 => 'Fecha',
            6 => 'Lugar',
            7 => 'Categoria',
            8 => 'Etiquetas',
            9 => 'Número de fotos',
            10 => 'Número de visitas',
            11 => 'Carpeta'
        ];

        # Validar criterio de ordenación
        if (!array_key_exists($id, $criterios)) {
            $_SESSION['mensaje_error'] = 'Criterio de ordenación no válido';
            header('location:' . URL . 'album');
            exit();
        }

        # Cargo el título
        $this->view->title = "Ordenar por {$criterios[$id]} - Gestión de Álbumes";

        # Obtengo los álbumes ordenados por el campo id
        $this->view->albumes = $this->model->order($id);

        # Cargo la vista
        $this->view->render('album/main/index');
    }

    public function subir()
    {
        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }
        // Comprobar si el usuario tiene permisos
        else if (!in_array($_SESSION['role_id'], $GLOBALS['album']['subir'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'album');
            exit();
        }

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            header('location:' . URL . 'errores');
            exit();
        }

        // Validar ID del álbum
        $album_id = (int) $_POST['album_id'];
        if (!$this->model->validateIdAlbum($album_id)) {
            $_SESSION['mensaje_error'] = 'ID de álbum no válido';
            header('location:' . URL . 'album');
            exit();
        }

        // Directorio de subida
        $album = $this->model->read($album_id);
        $uploadDir = __DIR__ . '/../uploads/albumes/' . $album->carpeta . '/';

        // Comprobar si el directorio existe
        if (!is_dir($uploadDir)) {
            $_SESSION['mensaje_error'] = 'El directorio de subida no existe';
            header('location:' . URL . 'album');
            exit();
        }

        // Validar y procesar cada archivo subido
        $allowedTypes = ['image/png', 'image/jpeg', 'image/gif'];
        $maxFileSize = 5242880; // 5MB
        $numFotosSubidas = 0;
        foreach ($_FILES['imagenes']['tmp_name'] as $key => $tmp_name) {
            $fileName = basename($_FILES['imagenes']['name'][$key]);
            $filePath = $uploadDir . $fileName;
            $fileSize = $_FILES['imagenes']['size'][$key];
            $fileType = mime_content_type($tmp_name);

            // Validar tipo de archivo
            if (!in_array($fileType, $allowedTypes)) {
                $_SESSION['mensaje_error'] = 'Tipo de archivo no permitido: ' . $fileType;
                header('location:' . URL . 'album');
                exit();
            }

            // Validar tamaño de archivo
            if ($fileSize > $maxFileSize) {
                $_SESSION['mensaje_error'] = 'El archivo ' . $fileName . ' excede el tamaño máximo permitido de 5MB';
                header('location:' . URL . 'album');
                exit();
            }

            // Comprobar si el archivo ya existe
            if (file_exists($filePath)) {
                $_SESSION['mensaje_error'] = 'El archivo ' . $fileName . ' ya existe en el álbum';
                header('location:' . URL . 'album');
                exit();
            }

            // Mover el archivo al directorio de subida
            if (!move_uploaded_file($tmp_name, $filePath)) {
                $_SESSION['mensaje_error'] = 'Error al subir el archivo: ' . $fileName;
                header('location:' . URL . 'album');
                exit();
            }

            $numFotosSubidas++;
        }

        // Actualizar el número de fotos en el álbum
        if ($numFotosSubidas > 0) {
            $this->model->actualizarNumFotos($album_id, $numFotosSubidas);
        }

        // Genero mensaje de éxito
        $_SESSION['mensaje'] = 'Imágenes subidas con éxito';

        // Redireccionar al listado de álbumes
        header('location:' . URL . 'album');
        exit();
    }
}
