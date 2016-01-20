<?php

require_once('conn.php');

//var_dump($pdo);

if( !empty($_GET['lang']) ){
	$lang = $_GET['lang'];
	funcion($lang);
}

/**
 * Este es el template base para las funciones
 * @param string $lang 
 * @param array $args 
 * @return type
 */
function funcion($lang,$args){

	$default = array(
		'valor' => 'valor',
		'valordos' => $valordos,
		'valortres' => 3
		);
	
	$args = array_merge($default,$args);

	if ($lang == "es"){
		//Devuelve en español
	}
	elseif ($lang == "en") {
		//Devuelve en inglés
	}
	else
	{
		//No existe lang
	}
}
