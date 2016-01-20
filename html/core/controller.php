<?php 

	/**
	* 
	*/
	class Controller
	{
		
		public $pdo = null;

		function __construct()
		{
			$dsn = 'mysql:host=localhost;dbname=amarinados';
			$nombre_usuario = 'root';
			$password = 'root';
			$opciones = array(
			    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
			); 
			
			$this->pdo = new PDO($dsn, $nombre_usuario, $password, $opciones);
		}
	}


?>