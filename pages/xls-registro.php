<?php
require_once ( __DIR__.'/../utils/bootstrap2.php' );
session_start();
$con = ConexionMySql::getInstance();
if(!$con->getInit()){
  $con->init($_SESSION['servname'], $_SESSION['nameu'], $_SESSION['password'], $_SESSION['namebd']);
}
$result = $con->registroStatus(1);

$archivo = new Spreadsheet();
$hoja = $archivo->getActiveSheet();
$hoja->setCellValueByColumnAndRow(1, 1, 'id_codigo');
$hoja->setCellValueByColumnAndRow(2, 1, 'codigo');
$hoja->setCellValueByColumnAndRow(3, 1, 'nombre_ssid');
$hoja->setCellValueByColumnAndRow(4, 1, 'contrasena_ssid');
$hoja->setCellValueByColumnAndRow(5, 1, 'comentario');
$registro = 2;
while ($row = $result->fetch_assoc()) {
    $hoja->setCellValueByColumnAndRow(1, $registro, $row['id_codigo']);
    $hoja->setCellValueByColumnAndRow(2, $registro, $row['codigo']);
    $hoja->setCellValueByColumnAndRow(3, $registro, $row['nombre_ssid']);
    $hoja->setCellValueByColumnAndRow(4, $registro, $row['contrasena_ssid']);
    $hoja->setCellValueByColumnAndRow(5, $registro, $row['comentario']);
    $registro++;
}
$writer = new Xlsx($archivo);
$nombrearchivo = '../export/' . date('Y-m-d') . '_export.xlsx';
$writer->save($nombrearchivo);
header('Location: ' . $nombrearchivo);
exit;
