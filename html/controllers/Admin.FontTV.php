<?php 

include_once('Admin.Fonts.php');
include_once(__DIR__.'/../Repositories/TelevisionRepository.php');
include_once(__DIR__.'/../Repositories/CoberturaRepository.php');
include_once(__DIR__.'/../Repositories/SenalRepository.php');

class AdminFontTV extends AdminFonts{

	private $tvRepository;
	private $coberturaRepository;
	private $senalRepository;
	private $fuente;

	public function __construct(){

		$this->tvRepository 		= new TelevisionRepository();
		$this->coberturaRepository 	= new CoberturaRepository();
		$this->senalRepository 		= new SenalRepository();
		$this->fuente 				= 'Television';
	}

	public function add(){

		if( isset( $_SESSION['admin'] ) ){
			$campos = '';
			require $this->adminviews . 'addFontTV.php';
			$this->addFont($campos, $this->fuente );
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}

	public function save(){

		if( !empty($_POST) ){

			$id_television = $this->tvRepository->idFuenteTV();
			$id_cobertura = $this->coberturaRepository->findIdByDescription($_POST['cobertura']);
			$_POST['tipoFuente'] = $id_television;
			$_POST['cobertura'] = $id_cobertura;
			$_POST['logo'] = 'default.jpg';
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
				header('Location: /panel/fonts/show-list');
				// echo 'Se ha agregado una fuente de TV correctamente';
			}else{
				echo 'No se agrego a la tabla fuente_tel';
			}
			
		}else{
			header('Location: /panel/font/add/font-television');
		}

	}
}