<?php

$pagina_actual = "Services";

//Nombre de la página
echo $pagina_actual.'<br>';

// Iniciar o reanudar sesión
session_start();

// Comprobador por si no estaba iniciada la sesión
if(!isset($_SESSION['vecesTotal'])){
    // Guardar momento de inicio de sesión
    $_SESSION['hora_inicio'] = time();
    // Inicialización de variable de sesión una vez iniciada sesión 
    $_SESSION['vecesPagina'] = [];
    $_SESSION['vecesTotal'] = 0;

}

// Mostrar id de sesión
echo session_id().'<br>';

// Mostrar nombre de sesión
echo session_name().'<br>';

// Mostrar el momento en el que se inició la sesión
echo date('H:i:s',$_SESSION['hora_inicio']).'<br>';

// Inicialización de variable de contador de la página a cero
if(!isset($_SESSION['vecesPagina'][$pagina_actual])){
$_SESSION['vecesPagina'][$pagina_actual] = 0;
}
// Incrementar variables de sesión de veces de visita
$_SESSION['vecesPagina'][$pagina_actual]++;
$_SESSION['vecesTotal']++;

// Mostrar número de visitas de la página
echo $_SESSION['vecesPagina'][$pagina_actual];