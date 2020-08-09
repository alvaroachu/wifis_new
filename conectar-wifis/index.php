<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
    <title>Conexion WIFIS MySQL</title>
    <!----     CSS y JS       ------>
</head>
<body>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style>
    .header{
        border-top: 3px solid #28a745;
        background: #495057;
        color: #fff;
        width: 70%;
        padding: 1%;
    }
    .header-left i{
        margin-left: 5%;
    }
    .header-right h4{
        text-align: right;
        margin-right: 10%;
        line-height: 2;
    }
    .content{
        background: #28a745;
        width: 70%;
    }
    .content .form-content{
        padding:10%;
    }
    .content .form-content .input-group .input-group-text{
        background:#333;
        color:#fff;
        border:none;
        border-radius:0;
        font-weight: 600;
    }
    .content .form-content .input-group input{
        border-radius: 0;
    }
    .content .form-content .input-group input:focus{
        border-color: transparent;
    }
    .content .form-content h4{
        margin-bottom:5%;
    }
    .content .form-content button{
        background: #333;
        color: #fff;
        border-radius: 0;
        font-weight: 600;
    }
</style>
<!------ Include the above in your HEAD tag ---------->
<div class="container header">
    <div class="row">
        <div class="col-md-6 header-left">
            <i class="fas fa-lock fa-3x"></i>
        </div>
        <div class="col-md-6 header-right">
            <h4>Conexion a Wifis MYSQL.</h4>
        </div>
    </div>
</div>
<div class="container content">
    <?php
    if(isset($_SESSION['vacio'])){
        ?>
        <style>
            .bg-warning{
                text-align: center;
                font-weight: bold;
                padding: 10px;
            }
        </style>
        <p class="bg-warning">¡Ingresar datos en los campos vacios!</p>
        <?php
        unset($_SESSION["vacio"]);
    }
    if(isset($_SESSION['error'])){
        ?>
        <style>
            .bg-danger{
                text-align: center;
                font-weight: bold;
                padding: 10px;
            }
        </style>
        <p class="bg-danger">¡Los datos estan incorrectos porfavor revice sus datos de acceso!</p>
        <?php
        unset($_SESSION["error"]);
    }
    ?>
    <form action="validacion.php" method="POST">
    <div class="form-content">
        <h5>A continuacion introduce los detalles de conexion a la base de datos, si no estas seguro de esta informacion contacta con tu prooveedor de servicios web.</h5>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Base de datos</span>
            </div>
            <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="namebd"  placeholder="Ingresar nombre de la base de datos">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Nombre de usuario</span>
            </div>
            <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="nameu" placeholder="Ingrese el nombre de usuario de su base de datos">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon2">Contraseña</span>
            </div>
            <input type="password" class="form-control" aria-label="Password" aria-describedby="basic-addon2" name="password" placeholder="Ingrese la contraseña de su base de datos">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Servidor web</span>
            </div>
            <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="servname" placeholder="Ingrese el nombre de servidor web">
        </div>
        <div class="input-group mb-3">
            <button type="submit" class="btn btn-default">Acceder al sistema</button>
        </div>
    </div>
    </form>
</div>
</body>
</html>
