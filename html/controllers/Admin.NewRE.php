<?php 

include_once('Admin.News.php');

use utilities\MediaDirectory;
use utilities\FontType;
use utilities\Util;

class AdminNewRE extends AdminNews{

	private $reRepository;	
	private $fuente;
	private $urlArchivo;
	private $bloqueRepo;
	private $fuenteRepo;
	private $seccionRepo;

	public function __construct(){

		$this->reRepository 		= new RevistaRepository();		
		$this->bloqueRepo 			= new BloqueRepository();
		$this->fuente 				= FontType::FONT_REVISTA['fuente'];
		$this->urlArchivo			= MediaDirectory::MEDIA_REVISTA;
		$this->fuenteRepo			= new FuentesRepository();
		$this->seccionRepo			= new SeccionRepository();
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
            header( "Location: https://{$_SERVER["HTTP_HOST"]}/panel/login");
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

			$id_revista = $this->reRepository->idFuenteRE();
			$_POST['tipoFuente'] = $id_revista;
			$_POST['usuario'] = $_SESSION['admin']['id_usuario'];
			$_POST['slug'] = $slug = $this->getUrlArchivo();
			$_POST['principal'] = 0;
			// Se preparan los datos para el encabezado de la noticia
			$tiraje = intval( $this->reRepository->getTirajeById( $_POST['fuente'] )['tiraje'] );
			$encabezado = [
								'logo'       => $this->fuenteRepo->getLogoById( $_POST['fuente'] )['logo'],
								'impactos'   => $tiraje * 3,
								'fecha'	     => Util::getUnixDate(),
								'fraccion'   => serialize( $this->validaFraccion( Util::percentToFraction( $_POST['tamano'] ) ) ),
								'num_pagina' => $_POST['pagina'],
								'porcentaje' => $_POST['tamano'],
								'seccion'    => $this->seccionRepo->getSeccionById( $_POST['seccion'] )['nombre'],
								'tiraje'     => $tiraje,
								'costo_cm'	 => 0,
								'costo_nota' => $_POST['costoBeneficio'],
								'tamanio'	 => 0,
								'id_fuente'  => $_POST['fuente'],
								'id_seccion'  => $_POST['seccion'],
						     ];			
			
			$fil = array();
			if( $_FILES['primario']['name'][0] != '' ){
				$fil = array_map(function ($name, $type, $tmp_name, $error, $size) use ( $slug, $encabezado ){
					return ['name' => $name, 'type' => $type, 'tmp_name' => $tmp_name, 'error' => $error, 'size' => $size, 'slug' => $_POST['slug'], 'principal' => '0', 'encabezado' => $encabezado, ];
				}, $_FILES['primario']['name'], $_FILES['primario']['type'], $_FILES['primario']['tmp_name'], $_FILES['primario']['error'], $_FILES['primario']['size']);
			}
			$_POST['archivos'] = $fil;
			$archivosGuardados = array();
			
			$notice = $this->reRepository->addNewRE( $_POST );

			$res = new stdClass();
			if( $notice->exito ){

				/* guarda archivos */
				foreach ($notice->fileName as $file) {
					foreach ($fil as &$origin) {
						if( $origin['name'] == $file->originName && $origin['size'] == $file->size ){
							$origin['createdName'] = $file->name;
							if( $this->guardaArchivo( $origin, $this->getUrlArchivo() ) ){
								$message = 'Archivo guardado en '. $this->getUrlArchivo() . $file->name;
								array_push($archivosGuardados, $message);
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
				$res->tipo = 'alert-info';
				$res->mensaje = '<strong>Éxito!. </strong> Noticia creada satisfactoriamente';
			}else{
				$res->tipo = 'alert-warning';
				$res->mensaje = "No se agregó a la tabla de {$this->fuente}";
			}
			$_SESSION['alerts']['saven'] = $res;			
			header('Location: /panel/news');
		}else{
			header('Location: /panel/new/add/new-revista');
		}
	}

	private function validaFraccion( $fraccion )
	{
		if( is_array( $fraccion ) )
			return $fraccion;

		$explode = explode('/', $fraccion );
		$float = $explode[0] / $explode[1];

		return [ 'string' => $fraccion, 'float' => $float ];
	}
}