<?php 

	
	/**
	* 
	*/
	class Plain extends Controller
	{
		
		
		public function homeView(){
			
			$this->header('Inicio - ');
			require $this->views.'home.php';
			$this->footer();

		}

		public function about(){
			
			$this->header('Quiénes Somos - ');
			require $this->views.'about.php';
			$this->footer();

		}

		public function clients(){
			$this->header('Clientes - ');
			require $this->views . 'clients.php';
			$this->footer();
		}

		public function contact(){
			$this->header('Contacto - ');
			require $this->views . 'contact.php';
			$this->footer();
		}

		public function signin(){
			$this->header('Ingresar - ');
			require $this->views . 'ingresar.php';
			$this->footer();
		}
		
		

		public function no_found(){
			header("HTTP/1.0 404 Not Found");
			require_once($this->views.'404.php' );
		}

	}

 ?>