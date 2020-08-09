<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="es" xmlns="http://www.w3.org/1999/xhtml">
<?php
require '../conexion.php';
?>
    <head>
        <style>
            body {
                padding: 10px;
            }
            img {
                border-radius: 15px;
                border: 3px solid black;
            }
        </style>
        <title>Informacion wifis</title>
        <!----     CSS        ------>
        <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <!----     JS        ------>
        <script src="../vendor/bootstrap/js/jquery.min.js"></script>
        <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="../conectar/dist/js/clipboard.min.js"></script>
        <!------- NUEVO ----->
    </head>
    <body>
        <!-- Esto es mi codigo -->
        <div id="header">
            <h3 style="text-align: center;font-family: Comic Sans Ms;text-decoration: underline;">Información wifis:</h3>
            <p style="text-align: center;"><img src="../img/router.jpg"></p>
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
                                <div class="col col-xs-6 text-right">
                                    <a href="xls-registro.php" target="_blank" class="btn btn-sm btn-primary btn-create">
                                        Exportar en Excel
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div id="lista_u">
                            <table class="table table-bordered table-hover table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th class="text-center">Nro. Registro</th>
                                        <th class="text-center">Codigo</th>
                                        <th class="text-center">
                                            <input type="text" id="inputUno" placeholder="Buscar Nombre SSID"><br>
                                            Nombre SSID</th>
                                        <th class="text-center">Contraseña SSID</th>
                                        <th class="text-center">Copiar contraseña</th>
                                        <th class="text-center">
                                            <input type="text" id="inputDos" placeholder="Buscar Comentario"><br>
                                            Comentario</th>
                                        <th class="text-center"><i class="fa fa-cog" aria-hidden="true"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "select * from registro where status = '1'";
                                    $query = mysqli_query($conex, $sql);
                                    $num = mysqli_num_rows($query);
                                    $i = 1;
                                    while ($row = mysqli_fetch_array($query)) {
                                    ?>
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
        <script>
            $('.btn').on('click', function() {
                var titulo = $(this).attr('title');
                var idc = $(this).attr('id');
                switch (titulo) {
                    case 'Modificar':
                        $(function() {
                            $('#modal-consultar').modal();
                            $.ajax({
                                url: 'action/registro.editar.php',
                                type: 'post',
                                data: 'id=' + idc,
                            }).done(function(data) {
                                $("#consulta").html(data);
                            });
                        });
                        break;
                    case 'Eliminar':
                        $(function() {
                            $('#modal-eliminar').modal();
                            $.ajax({
                                url: 'action/registro.eliminar.php',
                                type: 'post',
                                data: 'id=' + idc,
                            }).done(function(data) {
                                $("#eliminar").html(data);
                            });
                        });
                        break;
                }
            });
        </script>
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
            <h4 style="text-align: center;background-color: red;">Alvaro &copy;</h4>
        </footer>
    </body>
</html>