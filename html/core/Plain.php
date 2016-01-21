<?php 

	
	/**
	* 
	*/
	class Plain extends Controller
	{
		
		
		public function  homeView( $lang = "es" ){
			$this->header($lang , true );
			require  $this->views."home.php";	

		}

		public function  whoWeAreView( $lang = "es" ){
			
			$this->addBread( array( "label" => "Acerca de" , "url" => "/acerca-de/quienes-somos") );
			$this->addBread( array( "label"=> "Quiénes Somos"  ) );

			$this->header($lang);

			
		}

		public function  fabricView( $lang = "es" ){
			
			$this->addBread( array( "label"=> "Acerca de" , "url"=> "/acerca-de/fabrica-alfonso-marina" ) );
			$this->addBread( array( "label" => "F&aacute;brica Alfonso Marina" , "url" => "/acerca-de/quienes-somos") );
			

			$this->header($lang);
		}

	}

 ?>