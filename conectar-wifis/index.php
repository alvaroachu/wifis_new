<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Conexion WIFIS MySQL</title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
        <style>
            .bg-danger {
                text-align: center;
                font-weight: bold;
                padding: 10px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <br>
            <?php
            if (isset($_SESSION['error'])) {
            ?>
                <p class="bg-danger">¡Los datos estan incorrectos porfavor revice sus datos de acceso!</p>
            <?php
                unset($_SESSION["error"]);
            }
            ?>
            <hr>
            <div class="card bg-light">
                <article class="card-body mx-auto" style="max-width: 400px;">
                    <h4 class="card-title mt-3 text-center"><em class="fas fa-lock fa"></em> Conexion a Wifis MYSQL.</h4>
                    <p class="text-center">A continuacion introduce los detalles de conexion a la base de datos, si no estas seguro de esta informacion contacta con tu prooveedor de servicios web.</p>
                    <form action="validacion.php" method="POST">
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <em class="fa fa-database"></em> </span>
                            </div>
                            <input name="namebd" class="form-control" placeholder="Ingresar nombre de la base de datos" type="text" required="on">
                        </div>
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <em class="fa fa-user"></em> </span>
                            </div>
                            <input name="nameu" class="form-control" placeholder="Ingrese el usuario de base de datos" type="text" required="on">
                        </div>
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <em class="fa fa-key"></em> </span>
                            </div>
                            <input name="password" class="form-control" placeholder="Ingrese la contraseña de base de datos" type="password" required="on">
                        </div>
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <em class="fa fa-server"></em> </span>
                            </div>
                            <input name="servname" class="form-control" placeholder="Ingrese el nombre de servidor web" type="text" required="on">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block"> Acceder al sistema </button>
                        </div>
                    </form>
                </article>
            </div>
            <br>
        </div>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </body>
</html>