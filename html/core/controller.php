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
			session_start();
			$dsn = 'mysql:host=localhost;dbname=amarinados';
			$nombre_usuario = 'root';
			$password = 'root';
			$opciones = array(
			    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
			);
			$this->pdo = new PDO($dsn, $nombre_usuario, $password, $opciones);
		}

		/**
		 * Devuelve el string correcto dependiendo el LANG recibido
		 * @param string $lang 
		 * @param string $es 
		 * @param string $en 
		 * @return string
		 */
		public function trans($lang="es",$es,$en){
			if ($lang == "en" ){
				return $en;
			}
			else{
				return $es;
			}
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

		private function tipos($estilo = "" , $lang ){

			if( $estilo != ""){
				$sql = "SELECT distinct(".$this->trans($lang , "tipo" , "_type").") FROM product WHERE estilo = :estilo ";
			}else{
				$sql = "SELECT distinct(".$this->trans($lang , "tipo" , "_type").") FROM product";
			}

			$query = $this->pdo->prepare($sql);
			$query->bindParam(':estilo', $estilo);
			$rs = $query->execute();
			if($rs!==false){
				$nr = $query->rowCount();
				if( $nr > 0 ){
					$tipos = $query->fetchAll(PDO::FETCH_COLUMN);
					$tiposOut = array();
					foreach( $tipos as $t ){
						array_push( $tiposOut , array( $t => $this->grupos( $estilo , $t , $lang ) )  );
					}
					return $tiposOut;
				}
			}
		}

		private function grupos($estilo = "" , $tipo = "" , $lang){
			$grp = $this->trans($lang , "grupo" , "_group");
			$tp = $this->trans($lang , "tipo" , "_type");
			if( $estilo != ""){
				$sql = "SELECT distinct(".$grp.") FROM product WHERE $grp NOT LIKE \"%,%\" AND estilo = :estilo && {$tp} LIKE '{$tipo}'";
			}else{
				$sql = "SELECT distinct(".$grp.") FROM product WHERE $grp NOT LIKE \"%,%\" AND {$tp} LIKE '{$tipo}' ";
			}
			
			$query = $this->pdo->prepare($sql);
			$query->bindParam(':estilo', $estilo);
			$rs = $query->execute();
			if($rs!==false){
				$nr = $query->rowCount();
				if( $nr > 0 ){
					$grupos = $query->fetchAll(PDO::FETCH_COLUMN);
					return $grupos;
				}
			}
		}	


		public function catMenu( $lang , $style ){
			$tipos = $this->tipos( $style , $lang );
			$style = $style != "" ?$style.'/':$style;
			if ( !empty($tipos) ){
				$html = '<ul>';
				foreach ($tipos as $tipo) {
					foreach ($tipo as $key => $value) {
						$html .= '<li><a href="'.$this->url($lang, '/catalog/'.$style.strtolower($key)).'">'.ucwords(strtolower($key)).'</a><ul>';
						foreach ($value as $subvalue) {
							$html .= '<li><a href="'.$this->url($lang, '/catalog/'.$style.strtolower($key)."/".strtolower(str_replace(" ", "-" , $subvalue))).'">'.ucwords(strtolower($subvalue)).'</a></li>';
						}
						$html .= '</ul></li>';
					}
				}
				$html .= '</ul>';

				return $html;
			}
				
		}					
									

		public function header( $lang , $nobeard = false){
			if( $lang == "es"){
				// require  $this->views."header.php";	
				
				require $this->views."header-catalogo.php";
			}else{
				require  $this->views."header_en.php";	
			}
			
		}
		public function footer( $lang ){
			
			require  $this->views."footer.php";	
		}
	}


?>