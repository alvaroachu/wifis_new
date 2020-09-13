<?php
require (__DIR__.'/../utils/bootstrap.php');

session_start();
$con = ConexionMySql::getInstance();
if(!$con->getInit()){
  $con->init($_SESSION['sn'], $_SESSION['nu'], $_SESSION['pw'], $_SESSION['bd']);
}
$result = $con->registroStatus(1);
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title>WiFi Guardar</title>
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="dist/js/bootstrap.min.js"></script>
  </head>
  <body>
    <style>
      .form1 {margin-top: 3%;width: 700px;}
    </style>
    <div class="container form1">
      <div class="row">
        <div class="login-panel panel panel-default">
          <div class="panel panel-default">
            <div class="panel-heading">
              <div class="row">
                <div class="col col-xs-6">
                  <h3 class="panel-title text-center"><b>CONSULTAR REGISTROS</b></h3>
                </div>
              </div>
            </div>
            <div id="lista_u">
              <table class="table table-bordered table-hover table-striped table-condensed">
                <thead class="thead-dark">
                  <tr>
                    <th class="text-center">Nro. Registro</th>
                    <th class="text-center">Codigo</th>
                    <th class="text-center">Nombre SSID</th>
                    <th class="text-center">Contraseña SSID</th>
                    <th class="text-center">Comentario</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                      <td class="text-center"><?php echo $row['id_codigo']; ?></td>
                      <td class="text-center"><?php echo $row['codigo']; ?></td>
                      <td class="text-center"><?php echo $row['nombre_ssid']; ?></td>
                      <td class="text-center"><?php echo $row['contrasena_ssid']; ?></td>
                      <td class="text-center"><?php echo $row['comentario']; ?></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>