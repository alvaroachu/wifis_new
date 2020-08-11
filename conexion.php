<?php
session_start();
$conex = mysqli_connect($_SESSION['servname'], $_SESSION['nameu'], $_SESSION['password'], $_SESSION['namebd']) or die("Estamos en mantenimiento preventivo");
