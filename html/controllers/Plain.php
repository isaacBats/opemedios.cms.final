<?php 

	
	/**
	* 
	*/
	class Plain extends Controller
	{
		
		
		public function  homeView( $lang = "es" ){
			
			$this->header('Inicio - ');
			require $this->views.'home.php';
			$this->footer();

		}

		public function  about( ){
			
			$this->header('Quiénes Somos - ');
			require $this->views.'about.php';
			$this->footer();

		}
		
		

		public function no_found(){
			header("HTTP/1.0 404 Not Found");
			require_once($this->views.'404.php' );
		}

	}

 ?>