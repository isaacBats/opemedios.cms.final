<?php 

include_once('Admin.News.php');

class AdminNewTV extends AdminNews{

	private $fuente;

	public function __construct(){

		$this->fuente 				= 'Television';
	}

	public function add(){

		$campos = '';
		require $this->adminviews . 'addNewTV.php';
		$this->addNew($campos, $this->fuente );
	}

	public function save(){

		if( !empty($_POST) ){
			print_r($_POST);
			print_r($_FILES);

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
	// 		header('Location: /panel/font/add/font-television');
		}

	}
}