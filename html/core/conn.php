<?php
$dsn = 'mysql:host=localhost;dbname=alfonso_marina';
$nombre_usuario = 'alfonso';
$password = 'alfonso';
$opciones = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
); 

$pdo = new PDO($dsn, $nombre_usuario, $password, $opciones);
?>