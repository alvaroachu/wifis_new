<?php
require (__DIR__.'/../utils/bootstrap.php');

if($_SERVER['REQUEST_METHOD'] ==  'POST'){
    $nombre = $_POST['nombre'];
    $color = $_POST['color'];
    session_start();
    $_SESSION['ncolor'] = $color;
    $_SESSION['footer'] = $nombre;
    echo '<script>window.location = "guardar.php";</script>';
}else{
    echo '<script>alert("Error al guardar incidencia");</script>';
}