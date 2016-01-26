<?php 
	global $_config;
	$_config = new stdClass();

	$_config->db = array(
		"dsn"			 => 'mysql:host=localhost;dbname=amarinados',
		"nombre_usuario" => 'adanzilla',
		"password" 		 => 'campanitas',
		"opciones" 		 => array(
		    				 PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
						  )
	);

?>