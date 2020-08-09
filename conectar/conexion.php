<?php
session_start();
$conex = mysqli_connect($_SESSION['sn'], $_SESSION['nu'], $_SESSION['pw'], $_SESSION['bd']) or die("Datos Incorrectos, revisar los campos ingresados.");
