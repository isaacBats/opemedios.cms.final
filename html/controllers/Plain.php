<?php 

	
	/**
	* 
	*/
	class Plain extends Controller
	{
		
		
		public function  homeView( $lang = "es" ){
			$this->header($lang, "", true );

			$getGallery = $this->pdo->prepare("SELECT * FROM gallery WHERE contexto = 'home';");

			$gallery = [];
			$image   = [];
			$fondo = "";
			if( $getGallery->execute() ){
				$gallery = $getGallery->fetch(\PDO::FETCH_ASSOC);
				$query = $this->pdo->prepare("SELECT imagen FROM gallery_image WHERE gallery_id =  62 ");
				if( $query->execute() ){
					$image = $query->fetchAll(\PDO::FETCH_ASSOC);
					foreach ($image as $im) {
						if($im['imagen'] === 'AM_FotosHome_Fondo.png')
							$fondo = $im['imagen'];
					}
				}

			}else{
				echo "No se obtuvo la galeria";
			}
			require  $this->views."home.php";	

			$this->footer( $lang );

		}
		
		public function  whoWeAreView( $lang = "es" ){

			$this->addBread( array( "label"=> $this->trans($lang,"Acerca de","About") , "url"=> "/acerca-de/quienes-somos" ) );
			$this->addBread( array( "label" => $this->trans($lang,"Quiénes Somos","About Us") , "url" => "/acerca-de/quienes-somos") );

			$this->header($lang, $this->trans($lang,"Quiénes Somos - ","About Us - "), false , false , "who" );

			$query = $this->pdo->prepare("SELECT * FROM pages WHERE slug = 'about-us'");
			if( $query->execute() ){
				$about = $query->fetch(\PDO::FETCH_ASSOC);
				require $this->views."who-are-we.php";
			}
			


			$this->footer( $lang );
		}

		public function  terminos( $lang = "es" ){

			$this->addBread( array( "label"=> $this->trans($lang,"Términos y condiciones","Terms & conditions ") , ) );

			$this->header($lang, $this->trans($lang,"Términos y condiciones - ","Terms & conditions - "), false , false , "who" );

			require $this->views."terminos.php";

			$this->footer( $lang );
		}

		public function  fabricView( $lang = "es" ){
			
			$this->addBread( array( "label"=> $this->trans($lang,"Acerca de","About") , "url"=> "/acerca-de/fabrica-alfonso-marina" ) );
			$this->addBread( array( "label" => $this->trans($lang,"F&aacute;brica","Factory")." Alfonso Marina" , "url" => "/acerca-de/quienes-somos") );

			$this->header($lang, $this->trans($lang,"F&aacute;brica Alfonso Marina - ","Factory Alfonso Marina - "), false , false , "fabric");

			$query = $this->pdo->prepare("SELECT * FROM pages WHERE slug = 'factory-alfonso-marina'");
			if( $query->execute() ){
				$fabric = $query->fetch(\PDO::FETCH_ASSOC);
				require $this->views."fabric.php";
			}

			$this->footer( $lang );
		}

		public function no_found(){
			header("HTTP/1.0 404 Not Found");
			$this->header( "404 Not Found - " );
			require_once($this->views.'404.php' );
			$this->footer();
		}

	}

 ?>