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
                            <p class="list-group-item-text">Formulario</p>
                        </a></li>
                    <li class="disabled"><a href="#step-2">
                            <h4 class="list-group-item-heading">Paso 2</h4>
                            <p class="list-group-item-text">Second step description</p>
                        </a></li>
                    <li class="disabled"><a href="#step-3">
                            <h4 class="list-group-item-heading">Paso 3</h4>
                            <p class="list-group-item-text">Third step description</p>
                        </a></li>
                </ul>
            </div>
        </div>

        <div class="row setup-content" id="step-1">
            <div class="col-xs-12">
                <div class="col-md-12 well text-center">
                    
                        <article class="card-body mx-auto" style="max-width: 400px; margin:auto">
                            <h4 class="card-title mt-3 text-center"><em class="fas fa-lock fa"></em> Conexion a Wifis MYSQL.</h4>
                            <p class="text-center">A continuacion introduce los detalles de conexion a la base de datos, si no estas seguro de esta informacion contacta con tu prooveedor de servicios web.</p>
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
                                    <input id='password' name="password" class="form-control" placeholder="Ingrese la contraseña de base de datos" type="password">
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
                    <button id="activate-step-2" class="btn btn-primary btn-lg" onclick='validation()'>Activate Step 2</button>
                </div>
            </div>
        </div>














        <div class="row setup-content" id="step-2">
            <div class="col-xs-12">
                <div class="col-md-12 well">
                    <h1 class="text-center"> STEP 2</h1>
                </div>
            </div>
        </div>
        <div class="row setup-content" id="step-3">
            <div class="col-xs-12">
                <div class="col-md-12 well">
                    <h1 class="text-center"> STEP 3</h1>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="/assets/js/jsConfig.js"></script>
</body>
</html>