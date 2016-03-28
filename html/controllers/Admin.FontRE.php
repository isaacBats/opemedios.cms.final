<?php 

include_once('Admin.Fonts.php');
include_once(__DIR__.'/../Repositories/RevistaRepository.php');
include_once(__DIR__.'/../Repositories/CoberturaRepository.php');

class AdminFontRE extends AdminFonts{

	private $revistaRepository;
	private $coberturaRepository;
	private $fuente;

	public function __construct(){

		$this->revistaRepository 	= new RevistaRepository();
		$this->coberturaRepository 	= new CoberturaRepository();
		$this->fuente 				= 'Revista';
	}

	public function add(){
		$campos = '';
		require $this->adminviews . 'addFontRE.php';

		$this->addFont($campos, $this->fuente );
		
	}

	public function save(){

		if( !empty($_POST) ){

			$id_revista = $this->revistaRepository->idFuenteRE();
			$id_cobertura = $this->coberturaRepository->findIdByDescription($_POST['cobertura']);
			$_POST['tipoFuente'] = $id_revista;
			$_POST['cobertura'] = $id_cobertura;
			$_POST['logo'] = 'default.jpg';
			if(isset($_POST['activo'])){
				$_POST['activo'] = 1;
			}else{
				$_POST['activo'] = 0;
			}
			
			if($this->revistaRepository->addFontRE($_POST)){
				header('Location: /panel/fonts/show-list');
				// echo 'Se ha agregado una fuente de TV correctamente';
			}else{
				echo 'No se agrego a la tabla fuente_rev';
			}
			
		}else{
			header('Location: /panel/font/add/font-revista');
		}

	}
}