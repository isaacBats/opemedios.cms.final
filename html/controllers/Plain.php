<?php 

	
	/**
	* 
	*/
	class Plain extends Controller
	{
		
		
		public function  homeView( $lang = "es" ){
			$this->header($lang, "", true );
			require  $this->views."home.php";	
			$this->footer( $lang );

		}
		// TODO: Agregar panel de administracion para contenidos estaticos
		public function  whoWeAreView( $lang = "es" ){

			$this->addBread( array( "label"=> $this->trans($lang,"Acerca de","About") , "url"=> "/acerca-de/quienes-somos" ) );
			$this->addBread( array( "label" => $this->trans($lang,"Quiénes Somos","About Us") , "url" => "/acerca-de/quienes-somos") );

			$this->header($lang, $this->trans($lang,"Quiénes Somos - ","About Us - "), false , false , "who" );

			require $this->views."who-are-we.php";

			$this->footer( $lang );
		}

		public function  terminos( $lang = "es" ){

			$this->addBread( array( "label"=> $this->trans($lang,"Terminos y condiciones","Terms & conditions ") , ) );

			$this->header($lang, $this->trans($lang,"Terminos y condiciones - ","Terms & conditions - "), false , false , "who" );

			require $this->views."terminos.php";

			$this->footer( $lang );
		}

		public function  fabricView( $lang = "es" ){
			
			$this->addBread( array( "label"=> $this->trans($lang,"Acerca de","About") , "url"=> "/acerca-de/fabrica-alfonso-marina" ) );
			$this->addBread( array( "label" => $this->trans($lang,"F&aacute;brica","Factory")." Alfonso Marina" , "url" => "/acerca-de/quienes-somos") );

			$this->header($lang, $this->trans($lang,"F&aacute;brica Alfonso Marina - ","Factory Alfonso Marina - "), false , false , "fabric");

			require $this->views."fabric.php";

			$this->footer( $lang );
		}

		public function no_found( $lang ){
			header("HTTP/1.0 404 Not Found");
			require_once($this->views.'404.php' );
		}

	}

 ?>