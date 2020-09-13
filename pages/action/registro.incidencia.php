<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

use Dotenv\Dotenv;
require_once (__DIR__.'/../../vendor/autoload.php');
$dotenv = Dotenv::createImmutable('../../');
$dotenv->load();

require_once (__DIR__.'/../../conectar/conexionMySql.php');
$con = ConexionMySql::getInstance();
if(!$con->getInit()){
    $con->init($_ENV['DB_HOST'],$_ENV['DB_USER'],$_ENV['DB_PASSWORD'],$_ENV['DB_DATABASE']);
}
$result = $con->getIdIncidencia($_ENV['DB_DATABASE']);
$id = $result->fetch_array()[0];
$codigo = str_pad($id,7,0,STR_PAD_LEFT);
?>  
  <form class='form-horizontal' role='form' action='saveIncidencia.php' method='post'>
    <div class='form-group'>
      <label for='cedula' class='col-lg-2 control-label'>Codigo:</label>
      <div class='col-lg-10'>
        <input type='text' class='form-control' value='INC<?php echo $codigo; ?>' disabled>
        <input type='hidden' id='codigo' name='codigo' value='INC<?php echo $codigo; ?>'>
      </div>
    </div>
    <div class='form-group'>
      <label for='nombre' class='col-lg-2 control-label'>Nombre:</label>
      <div class='col-lg-10'>
        <input type='text' class='form-control' value='<?PHP echo $_SESSION['nameu']; ?>' disabled>
        <input type='hidden' id='nombre' name='nombre' value='<?PHP echo $_SESSION['nameu']; ?>'>
      </div>
    </div>
    <div class='form-group'>
      <label for='apellido' class='col-lg-2 control-label'>Fecha y hora:</label>
      <div class='col-lg-10'>
        <input type='text' class='form-control' value='<?php echo date('d/m/Y H:m:s'); ?>' disabled>
        <input type='hidden' id='date' name='date' value='<?php echo date('d/m/Y H:m:s'); ?>'>
      </div>
    </div>
    <div class='form-group'>
      <label for='apellido' class='col-lg-2 control-label'>Asunto:</label>
      <div class='col-lg-10'>
        <input type='text' class='form-control' value='Incidencia de <?PHP echo $_SESSION['nameu']; ?>' disabled>
        <input type='hidden'id='asunto' name='asunto' value='Incidencia de <?PHP echo $_SESSION['nameu']; ?>'>
      </div>
    </div>
    <div class='form-group'>
      <label for='apellido' class='col-lg-2 control-label'>Comentarios:</label>
      <div class='col-lg-10'>
        <textarea class='form-control' id='comentarios' name='comentarios' ></textarea>
      </div>
    </div>
    <div class='modal-footer'>
      <input type='submit' class='btn btn-primary' name='submit' value='Mandar incidencia' />
      <button class='btn btn-danger' data-dismiss='modal'>Cancelar</button>
    </div>
  </form>