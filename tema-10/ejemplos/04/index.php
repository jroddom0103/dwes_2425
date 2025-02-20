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

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Crear una instancia de PHPMailer
$mail = new PHPMailer(true);

try {

    // Juego de caracteres
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'quoted-printable';

    // Configurar el servidor de correo
    // $mail->SMTPDebug = 2;
    // $mail->isSMTP();
    // $mail->Host = 'smtp.gmail.com';
    // $mail->SMTPAuth = true;
    // $mail->Username = '';

    // fake SMTP PAPERCUT
    $mail->isSMTP();

    // Cabecera del mensaje
    $destinatario = 'androifireofficial@gmail.com';
    $remitente = 'jroddom0103@g.educaand.es';
    $asunto = 'Prueba de envío de correo';
    $mensaje = "
    <h1>Lorem Ipsum Titulum</h1>
    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illo veritatis atque, 
    distinctio nobis quis voluptatem laudantium sit iste omnis modi aspernatur dolores 
    repellendus itaque doloremque architecto pariatur cupiditate similique nisi?
    </p>
    <img src='cid:hamburguesa_embebida' alt='Hamburguesa' width='200' height='200'>
    ";

    // remitente
    $mail->setFrom($remitente, 'Juan Antonio');

    // destinatario
    $mail->addAddress($destinatario, 'Juan Antonio 2');

    // responder a 
    $mail->addReplyTo($remitente, 'Juan Antonio');

    // Con código HTML
    $mail->isHTML(true);

    // Asunto
    $mail->Subject = $asunto;

    // Mensaje
    $mail->Body = $mensaje;

    // Enviar archivo adjunto
    $mail->addAttachment('files/archivo_pdf.pdf');

    // Adjuntar imagen
    $mail->addAttachment('files/hamburguesa.avif', 'hamburguesa');

    // Adjuntar imagen embebida
    $mail->addEmbeddedImage('files/hamburguesa.avif', 'hamburguesa_embebida');

    // Enviar el mensaje
    $mail->send();

    // Mensaje de éxito
    echo 'Mensaje enviado correctamente';

}catch(Exception $e){
    echo 'Error al enviar el mensaje: ', $mail->ErrorInfo;
}