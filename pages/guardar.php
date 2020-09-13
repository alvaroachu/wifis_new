<?php
session_start();
if(isset($_SESSION['conectado'])){
    require_once (__DIR__ . '/../conectar/conexionMySql.php');
}else{
    header('Location: /conectar-wifis/');
}
$con = ConexionMySql::getInstance();
if(!$con->getInit()){
  $con->init($_SESSION['servname'], $_SESSION['nameu'], $_SESSION['password'], $_SESSION['namebd']);
}
$result = $con->registroStatus(1);
$i = 1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="es" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <style>body{padding:10px}img{border:3px solid black;border-radius:15px}</style>
        <title>Informacion wifis</title>
        <!----     CSS        ------>
        <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <!----     JS        ------>
        <script src="../vendor/bootstrap/js/jquery.min.js"></script>
        <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="../assets/js/clipboard.min.js"></script>
    </head>
    <body>
        <?php if(isset($_SESSION['mensaje'])){ ?>
        <style>
            .bg-danger{text-align: center;font-weight: bold;padding: 30px;}
        </style>
        <p class="bg-danger">¡No ha selecionado un fichero a importar!</p>
        <?php
            unset($_SESSION["mensaje"]);
        }
        ?>
        <!-- Esto es mi codigo -->
        <div id="header">
            <h3 style="text-align: center;font-family: Comic Sans Ms;text-decoration: underline;">Información wifis:</h3>
            <p style="text-align: center;"><img src="../img/router.jpg" alt="Router Wifi"></p>
            <br>
        </div>
        <!-- Fin  Esto es mi codigo -->
        <div class="container">
            <div class="row">
                <div class="login-panel panel panel-default">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col col-xs-6">
                                    <h3 class="panel-title"><b>CONSULTAR REGISTROS</b></h3>
                                </div>
                                <div class="col col-xs-3 text-right">
                                    <a title="Incidencias" data-toggle="modal" data-target="modal-incidencias" href="xls-registro.php" target="_blank" class="btn btn-sm btn-primary btn-create">
                                        <i class="fa fa-pencil-square-o"></i> Incidencias
                                    </a>
                                </div>
                                <div class="col col-xs-3 text-right">
                                    <a href="xls-registro.php" target="_blank" class="btn btn-sm btn-primary btn-create">
                                        Exportar en Excel
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div id="lista_u">
                            <table id='tablaList' class="table table-bordered table-hover table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th class="text-center">Nro. Registro</th>
                                        <th class="text-center">Codigo</th>
                                        <th class="text-center">
                                            <input type="text" id="ssids" placeholder="Buscar Nombre SSID"><br>
                                            Nombre SSID</th>
                                        <th class="text-center">Contraseña SSID</th>
                                        <th class="text-center">Copiar contraseña</th>
                                        <th class="text-center">
                                            <input type="text" id="comments" placeholder="Buscar Comentario"><br>
                                            Comentario</th>
                                        <th class="text-center"><i class="fa fa-cog" aria-hidden="true"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $result->fetch_assoc()) { ?>
                                    <tr>
                                        <td class="col1 text-center"><?php echo $row['id_codigo']; ?></td>
                                        <td class="col2 text-center"><?php echo $row['codigo']; ?></td>
                                        <td class="col3 text-center"><?php echo $row['nombre_ssid']; ?></td>
                                        <td class="col4 text-center" id="codigo2<?php echo $i; ?>"><?php echo $row['contrasena_ssid']; ?></td>
                                        <td class="col5 text-center">
                                            <!-- Codigo usado en este ejemplo -->
                                            <button type="button" class="bt1" data-clipboard-target="#codigo2<?php echo $i; ?>">Copiar contraseña</button>
                                            <script>
                                                var clipboard2 = new Clipboard('.bt1');
                                                var clipboard3 = new Clipboard('.bt2');
                                            </script>
                                        </td>
                                        <td class="col6 text-center"><?php echo $row['comentario']; ?></td>
                                        <td class="col7 text-center">
                                            <div class="btn-group">
                                                <a data-toggle="modal" data-target="modal-consultar" class="btn btn-default btn-sm" title="Modificar" id="<?php echo $row['id_codigo'] ?>"><i class="fa fa-pencil-square-o"></i></a>
                                                <a data-toggle="modal" data-target="modal-eliminar" class="btn btn-danger btn-sm" title="Eliminar" id="<?php echo $row['id_codigo'] ?>"><i class="fa fa-trash-o"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                        $i++;
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col col-xs-6">
                                    <div><a href="registro.php"><i class="fa fa-pencil fa-2x" aria-hidden="true"></i>
                                            <b>Nuevo reporte</b></a>
                                    </div>
                                </div>
                                <div class="col col-xs-6 text-right">
                                    <form action="validacion.php" method="post" enctype="multipart/form-data">
                                        <input type="file" name="filex" id="filex">
                                        <input class="btn btn-sm btn-primary btn-create" type="submit" value="Importar en Excel" name="submit">
                                        <input type="hidden" name="val" value="2">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-------------------Modal Modificar-------------------------------------->
        <div id="modal-consultar" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Modificar Registro</h4>
                    </div>
                    <div class="modal-body">
                        <div id="consulta"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-----------------------------------fin Modal-->
        <!-------------------Modal Incidencias-------------------------------------->
        <div id="modal-incidencias" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Registro de Incidencias</h4>
                    </div>
                    <div class="modal-body">
                        <div id="incidencias_div"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-----------------------------------fin Modal-->
        <!-------------------Modal Eliminar------------------------------>
        <div id="modal-eliminar" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Desactivar Registro</h4>
                    </div>
                    <div class="modal-body">
                        <div id="eliminar"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-----------------------------------fin Modal-->
        <!--Esto es mi codigo-->
        <footer>
            <h4 style="text-align: center;background-color: <?php echo $_SESSION['ncolor'] ?>;"> <?php echo $_SESSION['nameu'] ?> &copy;</h4>
        </footer>
        <!----     JS        ------>
        <script src="../assets/js/jsguardar.js"></script>
    </body>
</html>
