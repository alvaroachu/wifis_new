<?php
if (isset($_POST['namebd']) && !empty ($_POST['namebd']) &&
    isset($_POST['nameu']) && !empty ($_POST['nameu']) &&
    isset($_POST['password']) &&
    isset($_POST['servname']) && !empty ($_POST['servname'])) {
    $bd = $_POST['namebd'];
    $nu = $_POST['nameu'];
    $pw = $_POST['password'];
    $sn = $_POST['servname'];
    $conex = mysqli_connect($sn, $nu, $pw, $bd);
    if(!$conex){
        session_start();
        $_SESSION['error'] = 'Los datos estan incorrectos porfavor revice sus datos de acceso';
        echo '<script>window.location = "index.php";</script>';
    }else{
        session_start();
        $_SESSION['conectado'] = 'Acceso autorizado';
        header('Location: /pages/guardar.php');
    }
} else {
    session_start();
    $_SESSION['vacio'] = 'Ingresar datos en los campos vacios';
    echo '<script>window.location = "index.php";</script>';
}
?>

