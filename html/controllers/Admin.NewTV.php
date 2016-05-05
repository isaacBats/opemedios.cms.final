<?php 

include_once('Admin.News.php');
include_once(__DIR__.'/../Repositories/TelevisionRepository.php');


class AdminNewTV extends AdminNews{

	private $tvRepository;	
	private $fuente;
	private $urlArchivo;

	public function __construct(){

		$this->tvRepository 		= new TelevisionRepository();		
		$this->fuente 				= 'Television';
		$this->urlArchivo			= 'assets/data/noticias/television/';
	}

	public function getUrlArchivo(){

		return $this->urlArchivo;
	}

	public function setUrlArchivo( $slug ){

		$this->urlArchivo = $slug;
	}

	public function add(){

		ob_start();
		require $this->adminviews . 'addNewTV.php';
		$campos = ob_get_clean();
		$this->addNew($campos, $this->fuente );
	}

	public function save(){

		if( !empty($_POST) ){
			
			$id_television = $this->tvRepository->idFuenteTV();
			$_POST['tipoFuente'] = $id_television;
			$_POST['usuario'] = 1;
			$_POST['slug'] = $this->getUrlArchivo();
			$_POST['files'] = $_FILES;
			if ( isset($_FILES['primario']) && !empty($_FILES['primario']) ) {
				
				$_POST['principal'] = 1;				
				
			}else{

				$_POST['principal'] = 0;				
			}

			if($this->tvRepository->addNewTV( $_POST )){
				//header('Location: /panel/fonts/show-list');
				 echo 'Se ha agregado una noticia de TV correctamente';
			}else{
				echo 'No se agrego a la tabla noticia_tel';
			}
			
		}else{
			header('Location: /panel/new/add/new-television');
		}

	}
}