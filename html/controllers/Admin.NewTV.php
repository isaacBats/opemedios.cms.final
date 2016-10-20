<?php 

include_once('Admin.News.php');

use utilities\MediaDirectory;
use utilities\FontType;


class AdminNewTV extends AdminNews{

	private $tvRepository;	
	private $fuente;
	private $urlArchivo;
	private $bloqueRepo;

	public function __construct(){

		$this->tvRepository 		= new TelevisionRepository();		
		$this->bloqueRepo 			= new BloqueRepository();
		$this->fuente 				= FontType::FONT_TELEVISION['fuente'];
		$this->urlArchivo			= MediaDirectory::MEDIA_TELEVISION;
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
			require $this->adminviews . 'addNewTV.php';
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

			$id_television = $this->tvRepository->idFuenteTV();
			$_POST['tipoFuente'] = $id_television;
			$_POST['usuario'] = 1;
			$_POST['slug'] = $slug = $this->getUrlArchivo();
			$_POST['principal'] = 0;				
			
			$fil = array();
			if( $_FILES['primario']['name'][0] != '' ){
				$fil = array_map(function ($name, $type, $tmp_name, $error, $size) use ($slug){
					return ['name' => $name, 'type' => $type, 'tmp_name' => $tmp_name, 'error' => $error, 'size' => $size, 'slug' => $_POST['slug'], 'principal' => '0'];
				}, $_FILES['primario']['name'], $_FILES['primario']['type'], $_FILES['primario']['tmp_name'], $_FILES['primario']['error'], $_FILES['primario']['size']);
			}
			$_POST['archivos'] = $fil;
			
			$notice = $this->tvRepository->addNewTV( $_POST );

			if( $notice->exito ){

				/* guarda archivo */
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
				echo 'No se agrego a la tabla noticia_tel';
			}
			
		}else{
			header('Location: /panel/new/add/new-television');
		}

	}
}