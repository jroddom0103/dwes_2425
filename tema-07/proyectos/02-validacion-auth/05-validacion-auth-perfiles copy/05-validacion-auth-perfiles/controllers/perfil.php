<?php

class Perfil extends Controller
{

    function __construct()
    {

        parent::__construct();
    }

    /*
        Método principal

        Se  carga siempre que la url contenga sólo el primer parámetro

        url: /alumno
    */
    public function render()
    {
        // inicio o continuo la sesión
        session_start();

        // Validación token CSRF
        if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            // require_once 'controllers/error.php';
            // $controller = new Errores('Petición no válida');
            // exit();
            header('location:' . URL . 'errores');
            exit();
        }

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje de error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }

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

        # Obtenemos los detalles completos del usuario
        $this->view->perfil = $this->model->getUserId($_SESSION['user_id']);

        // Creo la propiedad title de la vista
        $this->view->title = "Mi perfil " . $_SESSION['user_name'];

        $this->view->render('perfil/main/index');
    }

    // 
    // Método para actualizar los datos del usuario.
    // Muestra en la vista el formulario con los datos del usuario en modo edición
    // url: / 

    public function editar()
    {

        session_start();

        if (!isset($_SESSION['user_id'])) {
            $_SESSION['mensaje_error'] = 'Acceso denegado.';

            unset($_SESSION['mensaje_error']);
        }

        if (isset($_SESSION['mensaje_error'])) {

            $this->view->mensaje_error = $_SESSION['mensaje_error'];

            unset($_SESSION['mensaje_error']);
        }

        $id = $_SESSION['user_id'];

        $this->view->perfil = $this->model->getUserId($id);

        // Capa no validación del formulario
        if (isset($_SESSION['error'])) {

            // Creo la propiedad error en la vista
            $this->view->error = $_SESSION['error'];

            // Elimino la variable de sesión error
            unset($_SESSION['error']);

            // Asigno a perfil los detalles del formulario
            $this->view->perfil = $_SESSION['perfil'];

            // Creo la propiedad mensaje error
            $this->view->mensaje_error = 'Hay errores en el formulario';
        }

        $this->view->title = "Editar perfil" . $_SESSION['user_name'];

        $this->view->render('perfil/editar/index');
    }

    /*
        Método para actualizar los datos del usuario
        Actualiza los datos del usuario name y email
        
        Incluye: 
            - validación token csrf
            - validación de los datos del formulario
            - prevención ataques csrf

        url: /perfil/update    
    */

    public function update()
    {

        session_start();

        // Validación token CSRF
        if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            // require_once 'controllers/error.php';
            // $controller = new Errores('Petición no válida');
            // exit();
            header('location:' . URL . 'errores');
            exit();
        }

        if (!isset($_SESSION['user_id'])) {
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }


        $name = filter_var($_POST['name'] ??= null, FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'] ??= null, FILTER_SANITIZE_EMAIL);

        // Creo las propiedades del perfil con los detalles del usuario
        $this->view->perfil = new stdClass();
        $this->view->perfil->name = $name;
        $this->view->perfil->email = $email;

        // Obtengo los detalles del usuario
        $user = $this->model->getUserId($_SESSION['user_id']);

        // Validación de los datos del formulario
        $error = [];

        // Validación name
        // antes de validar compruebo se ha modificado
        if ($name != $user->name) {
            if (empty($name)) {
                $error['name'] = 'El nombre es obligatorio';
            } else if (strlen($name) < 5) {
                $error['name'] = 'El nombre debe tener al menos 5 caracteres';
            } else if (strlen($name) > 20) {
                $error['name'] = 'El nombre debe tener como máximo 20 caracteres';
            } else if (!$this->model->validateUniqueName($name)) {
                $error['name'] = 'Nombre existente';
            }
        }

        // Validación email
        // antes de validar compruebo si ha modificado
        if ($email != $user->email) {
            if (empty($email)) {
                $error['email'] = 'El email es obligatorio';
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error['email'] = 'El formato del email no es correcto';
            } else if (!$this->model->validateUniqueEmail($email)) {
                $error['email'] = 'El email ya existe';
            }
        }

        // Si hay errores
        if (!empty($error)) {
            $_SESSION['error'] = $error;

            $_SESSION['perfil'] = (object) [
                'name' => $name,
                'email' => $email
            ];

            header('location:' . URL . 'perfil/editar');
            exit();
        }

        // Actualizo los datos del usuario
        $this->model->update($name, $email, $_SESSION['user_id']);

        // Actualizo el posible nuevo nombre de usuario
        $_SESSION['user_name'] = $name;

        // Genero mensaje de éxito
        $_SESSION['mensaje'] = 'Perfil actualizado correctamente';

        // Redirecciono a la vista principal de perfil
        header('location:' . URL . 'perfil');

    }

    /*
        Método para cambiar la contraseña del usuario.
        Muestra en la vista el formulario para cambiar la contraseña

        url: 
    */

    public function pass()
    {

        session_start();

        // Validar token csrf
        if (!hash_equals()){

        }

        if (isset($_SESSION['error'])) {

            $this->view->error = $_SESSION['error'];

            unset($_SESSION['error']);

            $this->view->mensaje_error = 'Errores de validación';
        }
        
    }
}