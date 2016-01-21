<?php 

	/**
	* 
	*/
	class Controller
	{
		public $pdo = null;
		public $bread = array();
		public $views = "views/";

		public function url( $lang , $url = ""){
			if( $url == ""){
				return "/".$lang.$_SERVER["REQUEST_URI"];
			}else{
				return "/".$lang.$url;	
			}
			
		}

		function __construct()
		{
			$dsn = 'mysql:host=localhost;dbname=amarinados';
			$nombre_usuario = 'adanzilla';
			$password = 'campanitas';
			$opciones = array(
			    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
			);
			$this->pdo = new PDO($dsn, $nombre_usuario, $password, $opciones);
		}

		public function bread( $lang ){
			$out = "<a href=\"/\">Inicio</a>";
			$size = sizeof( $this->bread );
			$outc = 1;
			foreach( $this->bread  as $step ){
				if( $out != ""){
					$out .= ' <span class="breadPipe">|</span> ';
				}
				if( $size == $outc){
					$out .= $step["label"];
				}else{
					$out .= '<a href="'.$this->url( $lang , $step["url"]).'">'.$step["label"].'</a>';
				}
				$outc++;
			}

			echo $out;
		}

		public function addBread( $array ){
			array_push( $this->bread  , $array );
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