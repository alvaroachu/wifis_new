<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';

if($_SERVER['REQUEST_METHOD'] ==  'POST'){
    header('Content-Type: application/json');
    $mail_email = $_POST['email'];
    $mail_password = $_POST['password'];
    $mail_SMTP = $_POST['servidorsmtp'];
    $mail_security = $_POST['security'];
    switch($mail_security){
        case 1:
            $mail_security = 'tls';
            break;
        case 2:
            $mail_security = 'ssl';
            break;
        case 3:
        default;
            $mail_security = false;
    }
    $mail_port = $_POST['puerto'];

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
        $mail->Subject = 'Test';
        $mail->Body    = 'Body <b>Test!</b>';
        $mail->AltBody = 'Email test';

        if($mail->send()){
            echo json_encode(['status'=>'success']);
        }else{
            echo json_encode(['status'=>'error',
            'message' => 'Message could not be sent. Mailer Error: {'.$mail->ErrorInfo.'}']);
        }
    } catch (Exception $e) {
        echo json_encode(['status'=>'error',
        'message' => 'Message could not be sent. Mailer Error: {'.$mail->ErrorInfo.'}']);
    }
}else{
    http_response_code(404);
}