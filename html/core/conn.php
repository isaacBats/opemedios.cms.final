<?php
$dsn = 'mysql:host=localhost;dbname=amarinados';
$nombre_usuario = 'adanzilla';
$password = 'campanitas';
$opciones = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
); 
global $pdo;
$pdo = new PDO($dsn, $nombre_usuario, $password, $opciones);
?>