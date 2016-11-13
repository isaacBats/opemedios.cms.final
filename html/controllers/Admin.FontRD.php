<?php 

include_once('Admin.Fonts.php');
use utilities\MediaDirectory;

class AdminFontRD extends AdminFonts{

	private $radioRepository;
	private $coberturaRepository;
	private $fuente;
	private $urlLogo;

	public function __construct(){

		$this->radioRepository 		= new RadioRepository();
		$this->coberturaRepository 	= new CoberturaRepository();
		$this->fuente 				= 'Radio';
		$this->urlLogo				= MediaDirectory::LOGO_FUENTES;
	}

	public function add(){
		
		if( isset( $_SESSION['admin'] ) ){
			ob_start();
				require $this->adminviews . 'addFontRD.php';
			$campos = ob_get_clean();
			$this->addFont($campos, $this->fuente );
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
		
	}

	public function save(){

		if( !empty($_POST) ){

			$logo = $_FILES['logo'];
			$id_radio = $this->radioRepository->idFuenteRD();
			$id_cobertura = $this->coberturaRepository->findIdByDescription($_POST['cobertura']);
			$_POST['tipoFuente'] = $id_radio;
			$_POST['cobertura'] = $id_cobertura;
			
			$adminColumn = new AdminColumns();
			$guardarLogo = $adminColumn->saveImages( $logo, $this->urlLogo );

			$_POST['logo'] = $guardarLogo['originName'];
			if(isset($_POST['activo'])){
				$_POST['activo'] = 1;
			}else{
				$_POST['activo'] = 0;
			}
			if($this->radioRepository->addFontRD($_POST)){
				$alert = new stdClass();
				$alert->tipo = 'alert-info';
				$alert->mensaje = 'Se agrego la fuente <strong>' . $_POST['nombre'] . '</strong> Correctamente!!!';
				$_SESSION['alerts']['fuentes'] = $alert;
				header('Location: /panel/fonts/show-list');
				// echo 'Se ha agregado una fuente de TV correctamente';
			}else{
				$alert = new stdClass();
				$alert->tipo = 'alert-danger';
				$alert->mensaje = 'No se agrego la fuente <strong>' . $_POST['nombre'] . '</strong> :(';
				$_SESSION['alerts']['fuentes'] = $alert;
				header( 'Location: ' . $_SERVER['HTTP_REFERER'] );
			}
			
		}else{
			header('Location: /panel/font/add/font-radio');
		}

	}
}