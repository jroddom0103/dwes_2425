<?php

class Contactar extends Controller
{

    function __construct()
    {

        parent::__construct();
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

    function render()
    {
        // Crear token csrf
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

        // Inicializo las variables para los campos del formulario
        $this->view->name = '';
        $this->view->email = '';
        $this->view->subject = '';
        $this->view->message = '';

        // Valida los datos del formulario de contacto
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Verifica el token csrf
            if ($_POST['csrf_token'] != $_SESSION['csrf_token']) {
                $this->view->error['csrf_token'] = 'Token inválido';
            }

            // Verifica el campo name
            if (empty($_POST['name'])) {
                $this->view->error['name'] = 'El campo name es obligatorio';
            } else {
                $this->view->name = $_POST['name'];
            }

            // Verifica el campo email
            if (empty($_POST['email'])) {
                $this->view->error['email'] = 'El campo email es obligatorio';
            } else {
                $this->view->email = $_POST['email'];
            }

            // Verifica el campo subject
            if (empty($_POST['subject'])) {
                $this->view->error['subject'] = 'El campo subject es obligatorio';
            } else {
                $this->view->subject = $_POST['subject'];
            }

            // Verifica el campo message
            if (empty($_POST['message'])) {
                $this->view->error['message'] = 'El campo message es obligatorio';
            } else {
                $this->view->message = $_POST['message'];
            }

            // Si no hay errores, envía el formulario
            if (empty($this->view->error)) {
                // Envía el formulario
                $this->view->mensaje = 'Formulario enviado';
            }
        }

        $this->view->render('contactar/index');

    }

    function validar(){

        // Validar token
        $this->checkTokenCsrf($_POST['csrf_token']);

        // Recuperar los datos del formulario
        $name = filter_var($_POST['name'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL);
        $subject = filter_var($_POST['subject'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $message = filter_var($_POST['message'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);

        $error = [];


        // Validar los datos

        // Comprobar que el nombre no está vacío
        if (empty($name)) {
            $error['name'] = 'El campo name es obligatorio';
        }

        // Comprobar que el email no está vacío
        if (empty($email)) {
            $error['email'] = 'El campo email es obligatorio';
        }

        // Comprobar que el asunto no está vacío
        if (empty($subject)){
            $error['subject'] = 'El campo subject es obligatorio';
        }

        // Comprobar que el mensaje no está vacío
        if (empty($message)){
            $error['message'] = 'El campo message es obligatorio';
        }

        // Si hay errores, los muestro
        if (!empty($error)) {
            $this->view->error = $error;
            $this->view->name = $name;
            $this->view->email = $email;
            $this->view->subject = $subject;
            $this->view->message = $message;
            $this->view->render('contactar/index');
            exit();
        }
    
    }

    
}