<?php 

include_once('Admin.Fonts.php');
use utilities\MediaDirectory;

class AdminFontTV extends AdminFonts{

	private $tvRepository;
	private $coberturaRepository;
	private $senalRepository;
	private $fuente;
	private $urlLogo;

	public function __construct(){

		$this->tvRepository 		= new TelevisionRepository();
		$this->coberturaRepository 	= new CoberturaRepository();
		$this->senalRepository 		= new SenalRepository();
		$this->fuente 				= 'Television';
		$this->urlLogo				= MediaDirectory::LOGO_FUENTES;
	}

	public function add(){

		if( isset( $_SESSION['admin'] ) ){
			ob_start();
				require $this->adminviews . 'addFontTV.php';
			$campos = ob_get_clean();
			$this->addFont($campos, $this->fuente );
		}else{
            header( "Location: https://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}

	public function save(){

		if( !empty($_POST) ){

			$logo = $_FILES['logo'];
			$id_television = $this->tvRepository->idFuenteTV();
			$id_cobertura = $this->coberturaRepository->findIdByDescription($_POST['cobertura']);
			$_POST['tipoFuente'] = $id_television;
			$_POST['cobertura'] = $id_cobertura;

			$adminColumn = new AdminColumns();
			$guardarLogo = $adminColumn->saveImages( $logo, $this->urlLogo );

			$_POST['logo'] = $guardarLogo['originName'];
			if(isset($_POST['activo'])){
				$_POST['activo'] = 1;
			}else{
				$_POST['activo'] = 0;
			}
			if(empty($_POST['senal'])){
				echo 'Señal esta vacia';
			}else{
				$id_senal = $this->senalRepository->findIdByDescription($_POST['senal']);
				$_POST['senal'] = $id_senal;
			}
			if($this->tvRepository->addFontTV($_POST)){
				
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
			header('Location: /panel/font/add/font-television');
		}

	}
}