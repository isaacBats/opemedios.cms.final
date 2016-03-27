<?php 

include_once('Admin.Fonts.php');
// require (__DIR__.'/../Repositories/RadioRepository.php');
// require (__DIR__.'/../Repositories/CoberturaRepository.php');

class AdminFontRD extends AdminFonts{

	// private $radioRepository;
	// private $coberturaRepository;
	private $fuente;

	public function __construct(){

		// $this->radioRepository 		= new RadioRepository();
		// $this->coberturaRepository 	= new CoberturaRepository();
		$this->fuente 				= 'Radio';
	}

	public function add(){
		$campos = '';
		require $this->adminviews . 'addFontRD.php';

		$this->addFont($campos, $this->fuente );
		
	}

	// public function save(){

	// 	if( !empty($_POST) ){

	// 		$id_television = $this->tvRepository->idFuenteTV();
	// 		$id_cobertura = $this->coberturaRepository->findIdByDescription($_POST['cobertura']);
	// 		$_POST['tipoFuente'] = $id_television;
	// 		$_POST['cobertura'] = $id_cobertura;
	// 		$_POST['logo'] = 'default.jpg';
	// 		if(isset($_POST['activo'])){
	// 			$_POST['activo'] = 1;
	// 		}else{
	// 			$_POST['activo'] = 0;
	// 		}
	// 		if(empty($_POST['senal'])){
	// 			echo 'Señal esta vacia';
	// 		}else{
	// 			$id_senal = $this->senalRepository->findIdByDescription($_POST['senal']);
	// 			$_POST['senal'] = $id_senal;
	// 		}
	// 		if($this->tvRepository->addFontTV($_POST)){
	// 			header('Location: /panel/fonts/show-list');
	// 			// echo 'Se ha agregado una fuente de TV correctamente';
	// 		}else{
	// 			echo 'No se agrego a la tabla fuente_tel';
	// 		}
			
	// 	}else{
	// 		header('Location: /panel/font/add/font-tv');
	// 	}

	// }
}