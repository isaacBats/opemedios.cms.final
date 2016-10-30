<?php 

use utilities\Image;

/**
* Controlador para las columnas financieras, primeras planas, columnas politicas y demas 
* @author Isaac Daniel < @codeisaac >
*/
class AdminColumns extends Controller
{
	
	private $css;
	private $getFuentes;
	private $fuentes;
	private $fuentesRepo;
	private $js;

	function __construct()
	{
		$this->fuentesRepo = new FuentesRepository();
		$this->css = '
				<!-- Select2 CSS -->
			    <link href="/assets/css/select2.min.css" rel="stylesheet">
			   ';

		$this->js = '
				<!-- Select2 JavaScript -->
			    <script src="/assets/js/select2.min.js"></script>
			  ';
		$this->getFuentes = $this->fuentesRepo->getFontsByTipeFont([3,]);
			
		$this->fuentes = ( $this->getFuentes->exito ) ? $this->getFuentes->rows : $this->getFuentes->error[2];

	}

	public function primerasPlanas()
	{
		if( isset( $_SESSION['admin'] ) ){

			$titulo = 'Primeras Planas';
			$action = '/panel/prensa/guardar-portada';

			$this->header_admin( $titulo . ' - ', $this->css );
				require $this->adminviews . 'portadasView.php';
			$this->footer_admin( $this->js );
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }

	}

	public function portadasFinancieras()
	{
		if( isset( $_SESSION['admin'] ) ){

			$titulo = 'Portadas Financieras';
			$action = '/panel/prensa/guardar-portada';

			$this->header_admin( $titulo . ' - ', $this->css );
				require $this->adminviews . 'portadasView.php';
			$this->footer_admin( $this->js );
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }

	}

	public function cartones()
	{
		if( isset( $_SESSION['admin'] ) ){

			$titulo = 'Cartones';
			$action = '/panel/prensa/guardar-portada';

			$this->header_admin( $titulo . ' - ', $this->css );
				require $this->adminviews . 'portadasView.php';
			$this->footer_admin( $this->js );
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }

	}

	public function columnasPoliticas()
	{
		if( isset( $_SESSION['admin'] ) ){

			$this->css .= '<link rel="stylesheet" href="/admin/lib/summernote/summernote.css">';
			$this->js .= '<script src="/admin/lib/summernote/summernote.js"></script>';


			$titulo = 'Columnas Politicas';
			$action = '/panel/prensa/guardar-columna';

			$this->header_admin( $titulo . ' - ', $this->css );
				require $this->adminviews . 'columnasView.php';
			$this->footer_admin( $this->js );
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }

	}

	public function columnasFinancieras()
	{
		if( isset( $_SESSION['admin'] ) ){

			$this->css .= '<link rel="stylesheet" href="/admin/lib/summernote/summernote.css">';
			$this->js .= '<script src="/admin/lib/summernote/summernote.js"></script>';

			$titulo = 'Columnas Financieras';
			$action = '/panel/prensa/guardar-columna';

			$this->header_admin( $titulo . ' - ', $this->css );
				require $this->adminviews . 'columnasView.php';
			$this->footer_admin( $this->js );
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }

	}

	public function guardarPortada()
	{
		if( isset( $_SESSION['admin'] ) ){

			$fecha = new \DateTime();
			echo '<pre>'; print_r(['post' => $_POST, 'files' => $_FILES, 'fecha' => $fecha]); exit;
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }		
	}

	private function saveImages( $file )
	{
		$im = new Image();

		$explode = explode('.', $file['name']);
		$file['createdName'] = $explode[0].'_'.uniqid().'.'.end($explode);
	}
}