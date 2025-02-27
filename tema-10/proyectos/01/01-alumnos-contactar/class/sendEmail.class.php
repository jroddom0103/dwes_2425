<?php

// Configuración de la cuenta de correo
require_once 'config/smtp_brevo.php';

// Cargar la librería PHPMailer
require_once 'extensions/PHPMailer/src/PHPMailer.php';
require_once 'extensions/PHPMailer/src/SMTP.php';
require_once 'extensions/PHPMailer/src/Exception.php';

class SendEmail
{
    public static function enviarEmail($name, $email, $subject, $message)
    {

        // Crear una nueva instancia de PHPMailer
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);

        try {

            // Configuración juego caracteres
            $mail->CharSet = "UTF-8";
            $mail->Encoding = "quoted-printable";

            // Servidor SMTP
            $mail->isSMTP();
            $mail->Host = SMTP_HOST;
            $mail->SMTPAuth = true;
            $mail->Username = SMTP_USER;
            $mail->Password = SMTP_PASS;
            $mail->Port = SMTP_PORT;
            $mail->SMTPSecure = 'tls';

            // Configurar el email
            $mail->setFrom($email, $name);
            $mail->addAddress(SMTP_USER);
            $mail->Subject = $subject;
            $mail->Body = $message;

            // Enviar email
            $mail->send();
        } catch (Exception $e) {
            throw new Exception("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        }
    }
}