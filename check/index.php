<?php
/*************************************************************/
// Funciones
function return_bytes($val) {
    $val = trim($val);
    $last = strtolower($val[strlen($val)-1]);
    switch($last) {
        // El modificador 'G' está disponble desde PHP 5.1.0
        case 'g':
            $val *= 1024;
        case 'm':
            $val *= 1024;
        case 'k':
            $val *= 1024;
        break;
        default:
        break;
    }
    return $val;
}

/*************************************************************/
// Configuraciones Minimas Requeridas
$versionMinima = '7.2.21';
$displayError = false;
$registerGlobals = false;
$postMaxSize = 52428800;
$memoryLimit = 268435456;
$uploadMaxFileSize = 52428800;
$extensiones = [
    ['name' => 'date', 'status' => false],
    ['name' => 'dom', 'status' => false],
    ['name' => 'ctype', 'status' => false],
    ['name' => 'gd', 'status' => false],
    ['name' => 'intl', 'status' => false],
    ['name' => 'mbstring', 'status' => false],
    ['name' => 'mysqli', 'status' => false],
    ['name' => 'pdo_mysql', 'status' => false]
];
/*************************************************************/
// Constantes
$lit1 = 'glyphicon glyphicon-ok green';
$lit2 = 'glyphicon glyphicon-remove';
$lit3 = 'background-color:#dff0d8';
$lit4 = 'background-color:#ebcccc';
$EL = '<br/>';
/*************************************************************/
// Iniciando Flags y literales
$flagVersion = true;
$flagConiguracion = true;
$flagExtension = true;
$postMaxSizeLiteral = '50M';
$memoryLimitLiteral = '256M';
$uploadMaxFileSizeLiteral = '50M';

/*************************************************************/
// Configuraciones Actuales
$versionActual = phpversion();
$displayErrorActual = ini_get('display_errors');
$registerGlobalsActual = ini_get('register_globals');
$postMaxSizeActual = return_bytes(ini_get('post_max_size'));
$memoryLimitActual = return_bytes(ini_get('memory_limit'));
$uploadMaxFileSizeActual = return_bytes(ini_get('upload_max_filesize'));

/*************************************************************/
// Version de PHP 7.2.21
$flagVersion = (strcmp($versionMinima,$versionActual)==0)?true:false;
if(!$flagVersion){
    $verM = explode('.',$versionMinima);
    $verA = explode('.',$versionActual);
    if($verM[0] <= $verA[0] && $verM[1] <= $verA[1] && $verM[2] <= $verA[2]){
        $flagVersion = true;
    }
}

/*************************************************************/
// Configuracion de PHP
$flagConiguracion &= ( $displayError == $displayErrorActual )?true:false;
$flagConiguracion &= ( $registerGlobals == $registerGlobalsActual )?true:false;
$flagConiguracion &= ( $postMaxSize <= $postMaxSizeActual )?true:false;
$flagConiguracion &= ( $memoryLimit <= $memoryLimitActual )?true:false;
$flagConiguracion &= ( $uploadMaxFileSize <= $uploadMaxFileSizeActual )?true:false;

/*************************************************************/
// Extensiones
foreach($extensiones as &$e){
    $e['status'] = boolval(extension_loaded($e['name']));
    $flagExtension &= $e['status'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Check</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
</head>
<body>
    <div class="container">
        <div class="row">
            <h1 class="page-header">
                <div class="crush">Control de preparación</div>
            </h1>
        </div>
        <div class="row">
            <div class="col-md-10">
                <div class="table-responsive">
                    <table class="table table-sm table-hover">
                        <thead class="thead-default">
                            <tr class="add-category-row">
                                <th id="col1" style="width: 30px;"></th>
                                <th id="col2" colspan="2">
                                    <?php
                                        if($flagVersion && $flagConiguracion && $flagExtension){
                                    ?>
                                        Todo Ok
                                    <?php
                                        }else{
                                    ?>
                                        Revisa tus configuraciones<br/>
                                    <?php
                                            if(!$flagVersion){
                                                ?>
                                                La version minima requerida es PHP
                                                <?php 
                                                echo $versionMinima.$EL;
                                            }
                                            if(!$flagConiguracion){
                                                ?>
                                                Revisa las siguientes configuracines en el archivo php.ini<br/>
                                                <?php
                                                echo ( $displayError == $displayErrorActual )?'':'- display_errors = '.boolval($displayError).$EL;
                                                echo ( $registerGlobals == $registerGlobalsActual )?'':'- register_globals = '.boolval($registerGlobals).$EL;
                                                echo ( $postMaxSize <= $postMaxSizeActual )?'':'- post_max_size minima '.$postMaxSizeLiteral.$EL;
                                                echo ( $memoryLimit <= $memoryLimitActual )?'':'- memory_limit minima '.$memoryLimitLiteral.$EL;
                                                echo ( $uploadMaxFileSize <= $uploadMaxFileSizeActual )?'':'- upload_max_filesize minima '.$uploadMaxFileSizeLiteral.$EL;
                                            }
                                            if(!$flagExtension){
                                                ?>
                                                Validar las extensiones<br/>
                                                <?php
                                            }
                                        }
                                    ?>
                                </th>
                                <th id="col3" style="width: 70px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <button class="btn-view-fund btn btn-default btn-xs  pull-left" style="<?php echo $flagVersion?$lit3:$lit4; ?>" type="button">
                                        <span class="<?php echo $flagVersion?$lit1:$lit2; ?>" aria-hidden="true"></span>
                                    </button>
                                </td>
                                <td colspan="3">Versión de PHP <?php echo $versionActual; ?>
                            </td>
                            </tr>
                            <tr>
                                <td>
                                    <button class="btn-view-fund btn btn-default btn-xs  pull-left" style="<?php echo $flagConiguracion?$lit3:$lit4; ?>" type="button">
                                        <span class="<?php echo $flagConiguracion?$lit1:$lit2; ?>" aria-hidden="true"></span>
                                    </button>
                                </td>
                                <td colspan="3">Configuraciones de PHP</td>
                            </tr>
                            <tr>
                                <td>
                                    <button class="btn-view-fund btn btn-default btn-xs  pull-left" style="<?php echo $flagExtension?$lit3:$lit4; ?>" type="button">
                                        <span class="<?php echo $flagExtension?$lit1:$lit2; ?>" aria-hidden="true"></span>
                                    </button>
                                </td>
                                <td colspan="2">Extensiones de PHP</td>
                            </tr>
                            <?php
                            foreach($extensiones as $k => $v){
                            ?>
                                <tr class="<?php echo $v['status']?'success':'danger'; ?>">
                                    <td colspan="3">
                                        <div class="row q_row">
                                            <div class="col-lg-1"></div>
                                            <div class="col-lg-9">
                                                <span>Extension <?php echo $v['name']; ?></span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</body>
</html>