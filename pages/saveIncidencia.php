<?php
require (__DIR__.'/../utils/bootstrap.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Leer los parametros
if($_SERVER['REQUEST_METHOD'] ==  'POST'){
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $date = $_POST['date'];
    $asunto = $_POST['asunto'];
    $comentarios = $_POST['comentarios'];

    $con = ConexionMySql::getInstance();
    if(!$con->getInit()){
        $con->init($_ENV['DB_HOST'],$_ENV['DB_USER'],$_ENV['DB_PASSWORD'],$_ENV['DB_DATABASE']);
    }
    
    $value = $con->insertIncidencia($codigo,$nombre,$date,$asunto,$comentarios);

    if( $value ){
        $mail_email = $con->getConfiguration('mail_email')->fetch_assoc()['value'];
        $mail_password = $con->getConfiguration('mail_password')->fetch_assoc()['value'];
        $mail_SMTP = $con->getConfiguration('mail_SMTP')->fetch_assoc()['value'];
        $mail_security = $con->getConfiguration('mail_security')->fetch_assoc()['value'];
        $mail_port = $con->getConfiguration('mail_port')->fetch_assoc()['value'];

        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = SMTP::DEBUG_OFF;                             // Enable verbose debug output
        $mail->SMTPAuth   = true;                                       // Enable SMTP authentication

        try {
            //Server settings
            $mail->Host       = $mail_SMTP;                             // Set the SMTP server to send through
            $mail->Username   = $mail_email;                            // SMTP username
            $mail->Password   = $mail_password;                         // SMTP password
            $mail->SMTPSecure = $mail_security;                         // PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = $mail_port;                             // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom($mail_email, 'Mailer');
            $mail->addAddress($mail_email, 'Mailer');

            // Content
            $mail->isHTML(true);                                        // Set email format to HTML
            $mail->Subject = $asunto;
            $mail->Body    = 'Mensaje: '.$comentarios;
            $mail->AltBody = 'Mensaje: '.$comentarios;

            if($mail->send()){
                echo '<script>window.location = "guardar.php";</script>';
            }else{
                echo '<script>alert("Message could not be sent. Mailer Error: {'.$mail->ErrorInfo.'}");</script>';
            }
        } catch (Exception $e) {
            echo '<script>alert("Message could not be sent. Mailer Error: {'.$mail->ErrorInfo.'}");</script>';
        }
    }else{
        echo '<script>alert("Error al guardar incidencia");</script>';
    }

}else{
    echo '<script>alert("Error al guardar incidencia");</script>';
}
