<?php 

include_once('Admin.News.php');
include_once(__DIR__.'/../Repositories/RevistaRepository.php');


class AdminNewRE extends AdminNews{

	private $reRepository;	
	private $fuente;
	private $urlArchivo;

	public function __construct(){

		$this->reRepository 		= new RevistaRepository();		
		$this->fuente 				= 'Revista';
		$this->urlArchivo			= 'assets/data/noticias/revista/';
	}

	public function getUrlArchivo(){

		return $this->urlArchivo;
	}

	public function setUrlArchivo( $slug ){

		$this->urlArchivo = $slug;
	}

	public function add(){

		if( isset( $_SESSION['admin'] ) ){
			$tipoPaginacion = '';
			$tipos = $this->reRepository->getTiposPagina();
			foreach ($tipos as $t) {
				$tipoPaginacion .= '<option value="'.$t['id_tipo_pagina'].'">'.$t['descripcion'].'</option>';
			}
			ob_start();
			require $this->adminviews . 'addNewRE.php';
			$campos = ob_get_clean();
			$this->addNew($campos, $this->fuente );
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}

	public function save(){

		if( !empty($_POST) ){
			
			$id_revista = $this->reRepository->idFuenteRE();
			$_POST['tipoFuente'] = $id_revista;
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
			$ubicacion = [];
			for ($i=1; $i <= 12 ; $i++) { 
				if ( isset( $_POST['ubicacion'. $i] ) ){
					$ub = 1;
					array_push($ubicacion, $ub);
				}else{

					$ub = 0;
					array_push($ubicacion, $ub);
				}
			}

			$_POST['ubicacion'] = $ubicacion;

			if($this->reRepository->addNewRE( $_POST )){
				header('Location: /panel/news');
			}else{
				echo 'No se agrego a la tabla noticia_rev';
			}
			
		}else{
			header('Location: /panel/new/add/new-revista');
		}

	}
}