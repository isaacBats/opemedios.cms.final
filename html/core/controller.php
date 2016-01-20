<?php 

	/**
	* 
	*/
	class Controller
	{
		
		public $pdo = null;
		public $views = __DIR__."/../views/";
		
		public function url( $lang , $url){
			return "/".$lang."/".$url;
		}

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

		public function bread( $bread = array()){
			$out = "";
			foreach( $bread  as $step ){
				if( $out != ""){
					$out .= ' <span class="breadPipe">|</span>';
				}
				$out .= '<a href="'.$step["url"].'">'.$step["label"].'</a>';
			}
			//echo '<a href="index.html">Inicio</a> <span class="breadPipe">|</span> Noticias'	
		}

		public function header( $lang ){
			if( $lang == "es"){
				require  $this->views."header.php";	
			}else{
				require  $this->views."header_en.php";	
			}
			
		}
	}


?>