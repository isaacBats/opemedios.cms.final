<?php 

include_once('Admin.News.php');

use utilities\MediaDirectory;
use utilities\FontType;

class AdminNewPE extends AdminNews{

	private $peRepository;	
	private $fuente;
	private $urlArchivo;

	public function __construct(){

		$this->peRepository 		= new PeriodicoRepository();		
		$this->fuente 				= FontType::FONT_PERIODICO['fuente'];
		$this->urlArchivo			= MediaDirectory::MEDIA_PERIODICO;
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
			$tipos = $this->peRepository->getTiposPagina();
			foreach ($tipos as $t) {
				$tipoPaginacion .= '<option value="'.$t['id_tipo_pagina'].'">'.$t['descripcion'].'</option>';
			}
			ob_start();
			require $this->adminviews . 'addNewPE.php';
			$campos = ob_get_clean();
			$this->addNew($campos, $this->fuente );
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}

	public function save(){

		if( !empty($_POST) ){

			// si no existe un folder con el mes y el año se crea
			$createdAt = new DateTime();
			$folder = $createdAt->format('m-Y');
			$this->setUrlArchivo( $this->getUrlArchivo() . $folder . '/');
			if( !is_dir( $this->getUrlArchivo() ) ){
				mkdir( $this->getUrlArchivo(), 0755, true);
			}
			
			$id_periodico = $this->peRepository->idFuentePE();
			$_POST['tipoFuente'] = $id_periodico;
			$_POST['usuario'] = 1;
			$_POST['slug'] = $this->getUrlArchivo();
			$_POST['files'] = $_FILES;
			if ( $_FILES['primario']['error'] == 0 && !empty($_FILES['primario']) ) {
				
				$_POST['principal'] = 1;				
				
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

			$notice = $this->peRepository->addNewPE( $_POST );

			if( $notice->exito ){

				/* guarda archivo */
				$_FILES['primario']['createdName'] = $notice->fileName;
				if( $this->guardaArchivo( $_FILES['primario'], $this->getUrlArchivo() ) ){
					echo 'Archivo guardado en '. $this->getUrlArchivo();
				}

				header('Location: /panel/news');
			}else{
				echo 'No se agrego a la tabla noticia_ped';
			}
			
		}else{
			header('Location: /panel/new/add/new-periodico');
		}

	}
}