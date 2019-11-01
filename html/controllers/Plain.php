<?php 

	class Plain extends Controller
	{
		
		
		public function homeView()
		{			
			$this->renderNewView('home', 'Inicio - ');
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
			$js = '';
			$this->renderView('contact', 'Contacto - ', $data = [], '', $js);
		}

		public function signin()
		{
			$this->renderView('ingresar', 'Ingresar - ');
		}

		public function createdFiles ($keyPdf)
		{
			$explode = explode('_', base64_decode($keyPdf));
			$id = $explode[0];
			$filesPdfRepo = new FilesPdfRepo();
			$pdfFile = $filesPdfRepo->get($id);

			header("Content-type:application/pdf");
			
			header( "Content-Disposition: filename={$pdfFile['path_image']}");
			$file = $pdfFile['path_image'];
			$filename = $pdfFile['name'];
			header('Content-type: application/pdf');
			header('Content-Disposition: inline; filename="' . $filename . '"');
			header('Content-Transfer-Encoding: binary');
			header('Content-Length: ' . filesize($file));
			header('Accept-Ranges: bytes');
			@readfile($file);
		}

		public function no_found()
		{
			header("HTTP/1.0 404 Not Found");
			require_once($this->views.'404.php' );
		}

	}

 ?>