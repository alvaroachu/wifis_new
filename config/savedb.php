<?php
require '../conectar/conexionMySql.php';

// Leer los parametros
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

    $con = ConexionMySql::getInstance();
    if(!$con->getInit()){
        $con->init('192.168.56.1','admin','secret','database');
    }
    $r1 = $con->updateConfiguration('mail_email',$mail_email);
    $r2 = $con->updateConfiguration('mail_password',$mail_password);
    $r3 = $con->updateConfiguration('mail_SMTP',$mail_SMTP);
    $r4 = $con->updateConfiguration('mail_security',$mail_security);
    $r5 = $con->updateConfiguration('mail_port',$mail_port);

    if($r1 && $r2 && $r3 && $r4 && $r5){
        echo json_encode(['status'=>'success']);
    }else{
        echo json_encode(['status'=>'error']);
    }

}else{
    http_response_code(404);
}
