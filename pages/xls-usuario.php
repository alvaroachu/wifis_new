<?php
require '../vendor/PhpSpreadsheet-master/vendor/autoload.php';
require '../conexion.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
// Establecemos la ruta 
$param = $_GET['token'];
$params = explode('$', $param);
$filename = $params[1];
$rut_serv = getcwd();
$rserv = str_replace('\\', '/', $rut_serv);
$ruta = substr($rserv, 0, strlen($rserv) - 5) . 'import/';
$inputFileType = 'Xlsx';
$inputFileName = $ruta . $filename;
// para extension especifica 
$reader = IOFactory::createReader($inputFileType);
$archivo = $reader->load($inputFileName);
$hoja = $archivo->getActiveSheet();
$flag = true;
foreach ($hoja->getRowIterator() as $row) {
    if ($flag) {
        $flag = false;
        continue;
    }
    $cellIterator = $row->getCellIterator();
    $sql = 'INSERT INTO registro (codigo,nombre_ssid,contrasena_ssid,comentario) values (';
    foreach ($cellIterator as $cell) {
        if (!is_null($cell)) {
            $value = $cell->getCalculatedValue();
            $sql .= '\'' . $value . '\',';
        }
    }
    $sql = substr($sql, 0, strlen($sql) - 1);
    $sql .= ');';
    mysqli_query($conex, $sql);
    if (mysqli_error($conex)) {
        echo '<script>alert("Error al modificar el registro");</script>';
    } else {
        echo 'Mensaje de usuario modificado con exito';
        echo '<script>window.location = "guardar.php";</script>';
    }
}