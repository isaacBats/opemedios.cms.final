<?php 

include_once('Admin.News.php');
include_once(__DIR__.'/../Repositories/PeriodicoRepository.php');


class AdminNewPE extends AdminNews{

	private $peRepository;	
	private $fuente;
	private $urlArchivo;

	public function __construct(){

		$this->peRepository 		= new PeriodicoRepository();		
		$this->fuente 				= 'Periodico';
		$this->urlArchivo			= 'assets/data/noticias/periodico/';
	}

	public function getUrlArchivo(){

		return $this->urlArchivo;
	}

	public function setUrlArchivo( $slug ){

		$this->urlArchivo = $slug;
	}

	public function add(){

		ob_start();
		$tipos = $this->peRepository->getTiposPagina();
		require $this->adminviews . 'addNewPE.php';
		$campos = ob_get_clean();
		$this->addNew($campos, $this->fuente );
	}

	public function save(){

		if( !empty($_POST) ){
			
			$id_periodico = $this->peRepository->idFuentePE();
			$_POST['tipoFuente'] = $id_periodico;
			$_POST['usuario'] = 1;
			$_POST['slug'] = $this->getUrlArchivo();
			$_POST['files'] = $_FILES;
			if ( $_FILES['primario']['error'] == 0 && !empty($_FILES['primario']) ) {
				
				$_POST['principal'] = 1;
				/* guarda archivo */
				if( $this->guardaArchivo( $_FILES['primario'], $this->getUrlArchivo() ) ){
					echo 'Archivo guardado en '. $this->getUrlArchivo();
				}				
				
			}else{

				$_POST['principal'] = 0;				
			}

			if($this->peRepository->addNewPE( $_POST )){
				//header('Location: /panel/fonts/show-list');
				 echo 'Se ha agregado una noticia de '.$this->fuente.' correctamente';
			}else{
				echo 'No se agrego a la tabla noticia_ped';
			}
			
		}else{
			header('Location: /panel/new/add/new-periodico');
		}

	}
}