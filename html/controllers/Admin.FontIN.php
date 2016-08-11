<?php 

include_once('Admin.Fonts.php');
include_once(__DIR__.'/../Repositories/InternetRepository.php');
include_once(__DIR__.'/../Repositories/CoberturaRepository.php');

class AdminFontIN extends AdminFonts{

	private $internetRepository;
	private $coberturaRepository;
	private $fuente;

	public function __construct(){

		$this->internetRepository 	= new InternetRepository();
		$this->coberturaRepository 	= new CoberturaRepository();
		$this->fuente 				= 'Internet';
	}

	public function add(){
		
		if( isset( $_SESSION['admin'] ) ){
			$campos = '';
			require $this->adminviews . 'addFontIN.php';
			$this->addFont($campos, $this->fuente );
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
		
	}

	public function save(){

		if( !empty($_POST) ){

			$id_internet = $this->internetRepository->idFuenteIN();
			$id_cobertura = $this->coberturaRepository->findIdByDescription($_POST['cobertura']);
			$_POST['tipoFuente'] = $id_internet;
			$_POST['cobertura'] = $id_cobertura;
			$_POST['logo'] = 'default.jpg';
			if(isset($_POST['activo'])){
				$_POST['activo'] = 1;
			}else{
				$_POST['activo'] = 0;
			}
			
			if($this->internetRepository->addFontIN($_POST)){
				header('Location: /panel/fonts/show-list');
				// echo 'Se ha agregado una fuente de TV correctamente';
			}else{
				echo 'No se agrego a la tabla fuente_int';
			}
			
		}else{
			header('Location: /panel/font/add/font-internet');
		}

	}
}