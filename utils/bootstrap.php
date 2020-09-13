<?php
use Dotenv\Dotenv;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require (__DIR__.'/../vendor/autoload.php');
require (__DIR__.'/../conectar/conexionMySql.php');

$dotenv = Dotenv::createImmutable('../');
$dotenv->load();

if(boolval($_ENV['DEBUG'])){
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}
