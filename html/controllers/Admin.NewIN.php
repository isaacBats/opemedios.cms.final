<?php 

include_once('Admin.News.php');

class AdminNewIN extends AdminNews{

	private $inRepository;	
	private $fuente;
	private $urlArchivo;

	public function __construct(){

		$this->inRepository 		= new InternetRepository();		
		$this->fuente 				= 'Internet';
		$this->urlArchivo			= 'assets/data/noticias/internet/';
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
			
			$id_internet = $this->inRepository->idFuenteIN();
			$_POST['tipoFuente'] = $id_internet;
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
			
			if($this->inRepository->addNewIN( $_POST )){
				header('Location: /panel/fonts/show-list');
			}else{
				echo 'No se agrego a la tabla noticia_int';
			}
			
		}else{
			header('Location: /panel/new/add/new-internet');
		}

	}
}