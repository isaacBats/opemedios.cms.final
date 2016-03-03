<?php 

	
	class Controller
	{
		public $pdo = null;
		public $bread = array();
		public $views = "views/";
		public $adminviews = "admin/";

		
		public function url( $lang , $url = ""){
			if( $url == ""){
				return "/".$lang.$_SERVER["REQUEST_URI"];
			}else{
				$ur = explode( "/" , $url );
				$url = implode( "/" , array_map( function($s){return urlencode($s); } , $ur ) );
				return "/".$lang.$url;
			}

		}

		public function personCase($text){

			$words = [
				" Y "    =>  " y ",
				" La "   =>  " la ",
				" De "   =>  " de ",
				" Él "   =>  " él ",
				" Ii "   =>  " II ",
				" Xiii " =>  " XIII ",
				" S.n. " =>  " S.N. ",
				" Ii "   =>  " II ",
				" Ii"    =>  " II",
				" S.n."  =>  " S.N.",
				"(b"     =>  "(B",
				"Xvi"    =>  "XVI"
			];
			$text = mb_strtolower($text , 'utf8');
			$aux = "";
			foreach ($words as $key => $word) {
				
				if(stripos($text, $key)){
					return $aux = str_replace($key, $word, ucwords($text));
					exit;
				}
			}

			return ucwords($text);
		}


		function describe($database, $table , $value){
			$sql = "SELECT column_name , column_type
			FROM information_schema.columns
			WHERE  table_name = '{$table}'
			   AND table_schema = '{$database}'";
			
			$query = $this->pdo->prepare($sql);
			$rs = $query->execute();
			$fields = $query->fetchAll(\PDO::FETCH_ASSOC);
			$end = "";
			foreach( $fields as $f){

				if( str_replace("varchar", "", $f["column_type"]) != $f["column_type"]){
					$end .= " {$f['column_name']} LIKE '%{$value}%' OR ";	
				}
				
			}

			return $end;

		}

		function __construct()
		{
			session_start();
			global $_config;
			$this->pdo = new PDO($_config->db["dsn"], $_config->db["nombre_usuario"], $_config->db["password"], $_config->db["opciones"]);
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
						array_push( $tiposOut , array( $t => $this->categorias( $estilo , $t , $lang ) )  );
					}
					return $tiposOut;
				}
			}
		}

		private function categorias($estilo = "" , $tipo = "" , $lang){
			$grp = $this->trans($lang , "categoria" , "_category");
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
					$categorias = $query->fetchAll(PDO::FETCH_COLUMN);
					return $categorias;
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
									

		public function header( $lang, $title = "", $nobeard = false , $product = false , $bread_class = ""){
			
			$menuNewProduct = $this->menuNewsProducts();
			$titleTab = $this->titleTab($title);
			require $this->views."header.php";
		}


		public function menuNewsProducts($lang = "es"){

	        $dataReleases = $this->dataNewReleases();
	        $html = '<ul>';
	        if (count($dataReleases) > 0){
	            foreach ($dataReleases as $data) {
	                $html .= '<li><a href="/catalog/new-products/'.strtolower(str_replace(" ","-", $data["_date"])).'">'.$data["_date"].'</a></li>';
	            }
	            $html .= '</ul>';

	            return $html; 
	        }
	    }

	    private  function dataNewReleases(){

	        $query = $this->pdo->prepare("SELECT DISTINCT DATE_FORMAT( DATE(created),'%M %Y') as _date". 
	                                      " FROM product WHERE created <>'-' ORDER BY DATE(created) DESC;"
	                                    );
	        if($query->execute()){
	            if($query->rowCount() > 0){
	                return $query->fetchAll(\PDO::FETCH_ASSOC);
	            }else{
	                return "No hay resultados en la busqueda";
	            }
	        }else{
	            return "Hay problemas al ejecutar la consulta";
	        }

	    }

	    /**
	     * The name the secction
	     * @return string  A title
	     */
	    private function titleTab($title = ""){

	    	$title .= " Alfonso Marina";

	    	return $title;
	    }


		public function footer( $lang ){
			require  $this->views."footer.php";	
		}

		//  TODO: Put this on admin controller
		public function header_admin(){
			require  $this->adminviews."header.php";	
		}

		public function footer_admin(){
			require  $this->adminviews."footer.php";	
		}
	}

	//  AUTOLOAD CONTROLLERS
	foreach( scandir( __DIR__ ) as $class ){
		$buffer = explode("." , $class);
		if( end( $buffer ) == "php"){
			require_once( __DIR__.'/'.$class );
		}
	}
	
?>