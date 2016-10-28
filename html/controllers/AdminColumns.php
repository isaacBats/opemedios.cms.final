<?php 

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
			$action = '';

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
			$action = '';

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
			$action = '';

			$this->header_admin( $titulo . ' - ', $this->css );
				require $this->adminviews . 'portadasView.php';
			$this->footer_admin( $this->js );
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }

	}
}