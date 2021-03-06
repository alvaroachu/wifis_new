<?php
use Dotenv\Dotenv;


require_once (__DIR__.'/../vendor/autoload.php');
require_once (__DIR__.'/../conectar/conexionMySql.php');

$dotenv = Dotenv::createImmutable('../');
$dotenv->load();

if(boolval($_ENV['DEBUG'])){
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}