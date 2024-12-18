<?php

class Alumno extends Controller
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

        // Creo la propiedad title de la vista
        $this->view->title = "Home - Panel de control de Alumnos";

        // Creo la propiedad alumnos para usar en la vista
        $this->view->alumnos = $this->model->get();

        $this->view->render('alumno/main/index');

    }

    /*
        Método nuevo()

        Muestra el formulario que permite añadir nuevo alumno

        url asociada: /alumno/nuevo
    */
    public function nuevo()
    {

        // Creo la propiead título
        $this->view->title = "Nuevo Alumno - Gestión FP";

        // Creo la propiedad cursos en la vista
        $this->view->cursos = $this->model->get_cursos();

        // Cargo la vista asociada a este método
        $this->view->render('alumno/nuevo/index');

    }

    /*
        Método create()

        Permite añadir nuevo alumno al formulario

        url asociada: /alumno/create
        POST: detalles del alumno
    */
    public function create()
    {

        // Creo la propiedad title de la vista
        $this->view->title = "Home - Panel de control de Alumnos";

        // Recogemos los detalles del formulario
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $fechaNac = $_POST['fechaNac'];
        $dni = $_POST['dni'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];
        $nacionalidad = $_POST['nacionalidad'];
        $id_curso = $_POST['id_curso'];

        // Creamos un objeto de la clase alumno
        $alumno = new Class_alumno(null,$nombre,$apellidos,$email,$telefono,$nacionalidad,$dni,$fechaNac,$id_curso);

        $this->model->create($alumno);

        // Redirecciona al main de alumno
        header('location:'.URL.'alumno');

    }

}