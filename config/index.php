<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Configuración</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
    <link rel="stylesheet" href="/assets/css/styleConfig.css">
</head>

<body>
    <div class="container">
        <div class="row form-group">
            <div class="col-xs-12">
                <ul class="nav nav-pills nav-justified thumbnail setup-panel">
                    <li class="active"><a href="#step-1">
                            <h4 class="list-group-item-heading">Paso 1</h4>
                            <p class="list-group-item-text">Conexión al servidor de correo</p>
                        </a></li>
                    <li class="disabled"><a href="#step-2">
                            <h4 class="list-group-item-heading">Paso 2</h4>
                            <p class="list-group-item-text">Validación de la conección</p>
                        </a></li>
                    <li class="disabled"><a href="#step-3">
                            <h4 class="list-group-item-heading">Paso 3</h4>
                            <p class="list-group-item-text">Datos de conexión guardados</p>
                        </a></li>
                </ul>
            </div>
        </div>
        <div class="row setup-content" id="step-1">
            <div class="col-xs-12">
                <div class="col-md-12 well text-center">
                        <article class="card-body mx-auto" style="max-width: 400px; margin:auto">
                            <h4 class="card-title mt-3 text-center"><em class="fas fa-lock fa"></em> Conexión al servidor de correo.</h4>
                            <p class="text-center">A continuación introduce los detalles de conexion al servidor de correo electronico.</p>
                            <form action="validacion.php" method="POST">
                                <div class="form-group input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <em class="fa fa-envelope"></em> </span>
                                    </div>
                                    <input id='email' name="email" class="form-control" placeholder="Ingresar el email" type="email" required="on">
                                </div>
                                <div class="form-group input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <em class="fa fa-key"></em> </span>
                                    </div>
                                    <input id='password' name="password" class="form-control" placeholder="Ingrese la contraseña del correo" type="password">
                                </div>
                                <div class="form-group input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <em class="fa fa-server"></em> </span>
                                    </div>
                                    <input id='servidorsmtp' name="servidorsmtp" class="form-control" placeholder="Ingresar nombre del servidor SMTP" type="text" required="on">
                                </div>
                                <div class="form-group input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <em class="fa fa-lock"></em> </span>
                                    </div>
                                    <select id='security' name="security" id="security" class="form-control">
                                        <option value="1">TLS</option>
                                        <option value="2">SSL</option>
                                        <option value="3">Ninguno</option>
                                    </select>
                                </div>
                                <div class="form-group input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><em class="fas fa-door-open"></em></span>
                                    </div>
                                    <input id='puerto' name="puerto" class="form-control" placeholder="Ingresar el puerto" type="number" required="on">
                                </div>
                            </form>
                        </article>
                    <button id="activate-step-2" class="btn btn-primary btn-lg" onclick='validation()'>Validar</button>
                </div>
            </div>
        </div>
        <div class="row setup-content" id="step-2">
            <div class="col-xs-12">
                <div class="col-md-12 well text-center">
                    <article class="card-body mx-auto" style="max-width: 400px; margin:auto">
                        <h4 class="card-title mt-3 text-center"><em class="fas fa-lock fa"></em> Validacion de la conexión.</h4>
                        <table class="table table-striped table-bordered table-sm">
                            <thead>
                            <th colspan="2" style="" id="validacion"></th>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Correo:</td>
                                <td id="email_val"> prueba@gmail.com </td>
                            </tr>
                            <tr>
                                <td>Contraseña:</td>
                                <td> ******** </td>
                            </tr>
                            <tr>
                                <td>Servidor:</td>
                                <td id="server_val"> smtp.gmail.com</td>
                            </tr>
                            <tr>
                                <td>Puerto:</td>
                                <td id="port_val"> 587</td>
                            </tr>
                            <tr>
                                <td>Encriptación:</td>
                                <td id="security_val"> TLS </td>
                            </tr>
                            </tbody>
                        </table>
                    </article>
                    <button id="activate-step-3" class="btn btn-primary btn-lg" onclick='save()'>Guardar</button>
                </div>
            </div>
        </div>
        <div class="row setup-content" id="step-3">
            <div class="col-xs-12">
                <div class="col-md-12 well text-center">
                    <article class="card-body mx-auto" style="max-width: 400px; margin:auto">
                        <h4 class="card-title mt-3 text-center"><em class="fas fa-lock fa"></em> Datos de conexión guardados.</h4>
                        <p class="text-center">Sus datos han sido guardados de forma exitosa. Si desea realizar algun cambio puede
                            dar click en el boton eliminar y volver a generar la conexion al servidor de correo.</p>
                        <table class="table table-striped table-bordered table-sm">
                            <thead>
                            <th colspan="2"></th>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Correo:</td>
                                <td id="email_save"> prueba@gmail.com </td>
                            </tr>
                            <tr>
                                <td>Contraseña:</td>
                                <td> ******** </td>
                            </tr>
                            <tr>
                                <td>Servidor:</td>
                                <td id="server_save"> smtp.gmail.com</td>
                            </tr>
                            <tr>
                                <td>Puerto:</td>
                                <td id="port_save"> 587</td>
                            </tr>
                            <tr>
                                <td>Encriptación:</td>
                                <td id="security_save"> TLS </td>
                            </tr>
                            </tbody>
                        </table>
                    </article>
                    <button id="activate-step-3" class="btn btn-primary btn-lg" onclick='borrar()'>Eliminar</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="/assets/js/jsConfig.js"></script>
</body>
</html>