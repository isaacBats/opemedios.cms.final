<?php 

	
	class Controller
	{
		public $pdo = null;
		public $bread = array();
		public $views = "views/";
		public $adminviews = "admin/";

		
		public function url( $url = ""){
			if( $url == ""){
				return "/".$_SERVER["REQUEST_URI"];
			}else{
				$ur = explode( "/" , $url );
				$url = implode( "/" , array_map( function($s){return urlencode($s); } , $ur ) );
				return "/".$url;
			}

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

											

		public function header( $title = "" ){
			
			$titleTab = $this->titleTab($title);
			require $this->views."header.php";
		}


	    /**
	     * The name the secction
	     * @return string  A title
	     */
	    private function titleTab($title = ""){

	    	$title .= " Operadora de Medios Informativos 2016";

	    	return $title;
	    }




		public function footer( $lang ){
			require  $this->views."footer.php";	
		}

		public function header_admin( $title = '', $styles = '' ){
			$titleTab = $this->titleTab($title);
			$stylesheet = $styles;
			require  $this->adminviews."header.php";	
		}

		public function footer_admin( $js = '' ){
			$javaScripts = $js;
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