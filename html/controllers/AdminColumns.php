<?php 

/**
* Controlador para las columnas financieras, primeras planas, columnas politicas y demas 
* @author Isaac Daniel < @codeisaac >
*/
class AdminColumns extends Controller
{
	
	private $fuentesRepo;

	function __construct()
	{
		$this->fuentesRepo = new FuentesRepository();
	}

	public function primerasPlanas()
	{
		if( isset( $_SESSION['admin'] ) ){
			
			$css = '
					<!-- Select2 CSS -->
				    <link href="/assets/css/select2.min.css" rel="stylesheet">
				   ';

			$js = '
					<!-- Select2 JavaScript -->
				    <script src="/assets/js/select2.min.js"></script>
				  ';

			$getFuentes = $this->fuentesRepo->getFontsByTipeFont([3,]);
			
			$fuentes = ( $getFuentes->exito ) ? $getFuentes->rows : $getFuentes->error[2];
			
			$this->header_admin( 'Primeras Planas - ', $css );
				require $this->adminviews . 'primerasPlanasView.php';
			$this->footer_admin( $js );
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }

	}
}