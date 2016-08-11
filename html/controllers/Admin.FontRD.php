<?php 

include_once('Admin.Fonts.php');
include_once(__DIR__.'/../Repositories/RadioRepository.php');
include_once(__DIR__.'/../Repositories/CoberturaRepository.php');

class AdminFontRD extends AdminFonts{

	private $radioRepository;
	private $coberturaRepository;
	private $fuente;

	public function __construct(){

		$this->radioRepository 		= new RadioRepository();
		$this->coberturaRepository 	= new CoberturaRepository();
		$this->fuente 				= 'Radio';
	}

	public function add(){
		
		if( isset( $_SESSION['admin'] ) ){
			$campos = '';
			require $this->adminviews . 'addFontRD.php';
			$this->addFont($campos, $this->fuente );
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
		
	}

	public function save(){

		if( !empty($_POST) ){

			$id_radio = $this->radioRepository->idFuenteRD();
			$id_cobertura = $this->coberturaRepository->findIdByDescription($_POST['cobertura']);
			$_POST['tipoFuente'] = $id_radio;
			$_POST['cobertura'] = $id_cobertura;
			$_POST['logo'] = 'default.jpg';
			if(isset($_POST['activo'])){
				$_POST['activo'] = 1;
			}else{
				$_POST['activo'] = 0;
			}
			if($this->radioRepository->addFontRD($_POST)){
				header('Location: /panel/fonts/show-list');
				// echo 'Se ha agregado una fuente de TV correctamente';
			}else{
				echo 'No se agrego a la tabla fuente_rad';
			}
			
		}else{
			header('Location: /panel/font/add/font-radio');
		}

	}
}