<?php 

include_once('Admin.News.php');

use utilities\MediaDirectory;
use utilities\FontType;

class AdminNewIN extends AdminNews{

	private $inRepository;	
	private $fuente;
	private $urlArchivo;

	public function __construct(){

		$this->inRepository 		= new InternetRepository();		
		$this->fuente 				= FontType::FONT_INTERNET['fuente'];
		$this->urlArchivo			= MediaDirectory::MEDIA_INTERNET;
	}

	public function getUrlArchivo(){

		return $this->urlArchivo;
	}

	public function setUrlArchivo( $slug ){

		$this->urlArchivo = $slug;
	}

	public function add(){

		if( isset( $_SESSION['admin'] ) ){
			ob_start();
			require $this->adminviews . 'addNewIN.php';
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

			$id_internet = $this->inRepository->idFuenteIN();
			$_POST['tipoFuente'] = $id_internet;
			$_POST['usuario'] = 1;
			$_POST['slug'] = $this->getUrlArchivo();
			$_POST['files'] = $_FILES;
			

			if ( $_FILES['primario']['error'] == 0 && !empty($_FILES['primario']) ) {
				
				$_POST['principal'] = 1;				
				
			}else{

				$_POST['principal'] = 0;				
			}
			
			$notice = $this->inRepository->addNewIN( $_POST );

			if( $notice->exito ){

				/* guarda archivo */
				$_FILES['primario']['createdName'] = $notice->fileName;
				if( $this->guardaArchivo( $_FILES['primario'], $this->getUrlArchivo() ) ){
					echo 'Archivo guardado en '. $this->getUrlArchivo();
				}

				header('Location: /panel/news');
			}else{
				echo 'No se agrego a la tabla noticia_int';
			}
			
		}else{
			header('Location: /panel/new/add/new-internet');
		}

	}
}