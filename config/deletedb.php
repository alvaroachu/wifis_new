<?php

require(__DIR__ . '/../utils/bootstrap.php');

// Leer los parametros
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    header('Content-Type: application/json');

    $con = ConexionMySql::getInstance();
    if (!$con->getInit()) {
        $con->init($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], $_ENV['DB_DATABASE']);
    }
    $r1 = $con->deleteConfiguration('mail_email');
    $r2 = $con->deleteConfiguration('mail_password');
    $r3 = $con->deleteConfiguration('mail_SMTP');
    $r4 = $con->deleteConfiguration('mail_security');
    $r5 = $con->deleteConfiguration('mail_port');

    if ($r1 && $r2 && $r3 && $r4 && $r5) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error']);
    }

} else {
    http_response_code(404);
}
