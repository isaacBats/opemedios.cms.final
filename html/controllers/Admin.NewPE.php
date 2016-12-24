<?php 

include_once('Admin.News.php');

use utilities\MediaDirectory;
use utilities\FontType;

class AdminNewPE extends AdminNews{

	private $peRepository;	
	private $fuente;
	private $urlArchivo;
	private $bloqueRepo;

	public function __construct(){

		$this->peRepository 		= new PeriodicoRepository();		
		$this->bloqueRepo 			= new BloqueRepository();
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
			$_POST['usuario'] = $_SESSION['admin']['id_usuario'];
			$_POST['slug'] = $slug = $this->getUrlArchivo();
			$_POST['principal'] = 0;				
			
			$fil = array();
			if( $_FILES['primario']['name'][0] != '' ){
				$fil = array_map(function ($name, $type, $tmp_name, $error, $size) use ($slug){
					return ['name' => $name, 'type' => $type, 'tmp_name' => $tmp_name, 'error' => $error, 'size' => $size, 'slug' => $_POST['slug'], 'principal' => '0'];
				}, $_FILES['primario']['name'], $_FILES['primario']['type'], $_FILES['primario']['tmp_name'], $_FILES['primario']['error'], $_FILES['primario']['size']);
			}
			$_POST['archivos'] = $fil;

			// $ubicacion = [];
			// for ($i=1; $i <= 12 ; $i++) { 
			// 	if ( isset( $_POST['ubicacion'. $i] ) ){
			// 		$ub = 1;
			// 		array_push($ubicacion, $ub);
			// 	}else{

			// 		$ub = 0;
			// 		array_push($ubicacion, $ub);
			// 	}
			// }

			// $_POST['ubicacion'] = $ubicacion;

			$notice = $this->peRepository->addNewPE( $_POST );

			if( $notice->exito ){

				/* guarda archivos */
				foreach ($notice->fileName as $file) {
					foreach ($fil as &$origin) {
						if( $origin['name'] == $file->originName && $origin['size'] == $file->size ){
							$origin['createdName'] = $file->name;
							if( $this->guardaArchivo( $origin, $this->getUrlArchivo() ) ){
								echo 'Archivo guardado en '. $this->getUrlArchivo();
							}							
						}
					}
				}

				// Para agregar a un bloque
				if( $_POST['bloque'] != '' && $_POST['tema'] != '' ){
					
					$bloque['bloque'] = $_POST['bloque'];
					$bloque['noticia'] = $notice->idNew;
					$bloque['tema'] = $_POST['tema'];

					$this->bloqueRepo->insertNewToBlock( $bloque );
				}

				header('Location: /panel/news');
			}else{
				echo 'No se agrego a la tabla noticia_ped  <pre>';
				print_r($notice->error);
			}
			
		}else{
			header('Location: /panel/new/add/new-periodico');
		}

	}
}