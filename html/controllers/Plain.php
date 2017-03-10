<?php 

	
	/**
	* 
	*/
	class Plain extends Controller
	{
		
		
		public function homeView()
		{			
			$this->renderView('home', 'Inicio - ');
		}

		public function about()
		{			
			$this->renderView('about', 'Quiénes Somos - ');			
		}

		public function clients()
		{
			$this->renderView('clients', 'Clientes - ');
		}

		public function contact()
		{
			$js = '
				<!-- Google Maps -->
				<script src="https://maps.googleapis.com/maps/api/js?key=&amp;sensor=false&amp;extension=.js"></script> 
				<script src="assets/js/google-map.js"></script>
			';
			$this->renderView('contact', 'Contacto - ', $data = [], '', $js);
		}

		public function signin()
		{
			$this->renderView('ingresar', 'Ingresar - ');
		}

		public function no_found()
		{
			header("HTTP/1.0 404 Not Found");
			require_once($this->views.'404.php' );
		}

	}

 ?>