<?php
/*
    Ejemplo uso de la función mail

    @param

    - destinatario: dirección de correo del destinatario
    - asunto: asunto del mensaje
    - mensaje: cuerpo del mensaje
    - cabecera - header - opcional: cabecera del mensaje
    - cc - con copia - opcional : 
*/

// Definir la cabecera del mensaje (header)
$header = "Mime-Version: 1.0" . "\n";
$header .= "Content-Type: text/html; charset=UTF-8"."\r\n";
$header .= "From: Juan Antonio <jroddom0103@g.educaand.es>"."\r\n";
$header .= "Cc: jroddom0103@g.educaand.es"."\r\n";
$header .= "Cco: androifireofficial@gmail.es"."\r\n";
$header .= "X-Mailer: PHP/" . phpversion();

// Definir el destinatario
$destinatario = "androifireofficial@gmail.com";
$asunto = "Prueba de envío de correo";
$mensaje = "
<h1>Esto es una prueba de envío de correo</h1>
<p>Esto es un párrafo de prueba jklsdfjklfdsajl
klfdjsfkjldaslkjfjasfasjklfkldajsfkkladsjfkldas
dlsjkkfdlañsjfdajiodasjfiadsdifjdaslfjdlsadfjk
</p>
";

// Enviar el correo

if (mail($destinatario, $asunto, $mensaje, $header)){
    echo "Mensaje enviado correctamente";
}else{
    echo "Error al enviar el mensaje";
}
