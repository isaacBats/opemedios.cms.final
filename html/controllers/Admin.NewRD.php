<?php 

include_once('Admin.News.php');
include_once(__DIR__.'/../Repositories/RadioRepository.php');


class AdminNewRD extends AdminNews{

	private $rdRepository;	
	private $fuente;
	private $urlArchivo;

	public function __construct(){

		$this->rdRepository 		= new RadioRepository();		
		$this->fuente 				= 'Radio';
		$this->urlArchivo			= 'assets/data/noticias/radio/';
	}

	public function getUrlArchivo(){

		return $this->urlArchivo;
	}

	public function setUrlArchivo( $slug ){

		$this->urlArchivo = $slug;
	}

	public function add(){

		ob_start();
		require $this->adminviews . 'addNewRD.php';
		$campos = ob_get_clean();
		$this->addNew($campos, $this->fuente );
	}

	public function save(){

		if( !empty($_POST) ){
			
			$id_radio = $this->rdRepository->idFuenteRD();
			$_POST['tipoFuente'] = $id_radio;
			$_POST['usuario'] = 1;
			$_POST['slug'] = $this->getUrlArchivo();
			$_POST['files'] = $_FILES;
			if ( isset($_FILES['primario']) && !empty($_FILES['primario']) ) {
				
				$_POST['principal'] = 1;
				/* guarda archivo */
				if( $this->guardaArchivo( $_FILES['primario'], $this->getUrlArchivo() ) ){
					echo 'Archivo guardado en '. $this->getUrlArchivo();
				}				
				
			}else{

				$_POST['principal'] = 0;				
			}

			if($this->rdRepository->addNewRD( $_POST )){
				//header('Location: /panel/fonts/show-list');
				 echo 'Se ha agregado una noticia de Radio correctamente';
			}else{
				echo 'No se agrego a la tabla noticia_rad';
			}
			
		}else{
			header('Location: /panel/new/add/new-radio');
		}

	}
}