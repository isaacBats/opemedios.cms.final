<?php 

include_once('Admin.News.php');

use utilities\MediaDirectory;
use utilities\FontType;
use utilities\Util;

class AdminNewPE extends AdminNews{

	private $peRepository;	
	private $fuente;
	private $urlArchivo;
	private $bloqueRepo;
	private $fuenteRepo;
	private $seccionRepo;
	private $encabezadoRepo;
	private $adjuntoRepo;
	private $noticiaRepo;

	public function __construct(){

		$this->peRepository 		= new PeriodicoRepository();		
		$this->bloqueRepo 			= new BloqueRepository();
		$this->fuente 				= FontType::FONT_PERIODICO['fuente'];
		$this->urlArchivo			= MediaDirectory::MEDIA_PERIODICO;
		$this->fuenteRepo			= new FuentesRepository();
		$this->seccionRepo			= new SeccionRepository();
		$this->encabezadoRepo	    = new EncabezadoRepository();
		$this->adjuntoRepo	        = new AdjuntoRepository();
		$this->noticiaRepo	        = new NoticiasRepository();
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

		if( !empty($_POST) ) {
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
			// Se preparan los datos para el encabezado de la noticia
			$tiraje = intval( $this->peRepository->getTirajeById( $_POST['fuente'] )['tiraje'] );
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
				echo 'No se agrego a la tabla noticia_per  <pre>';
				print_r($notice);
			}
		}else{
			header('Location: /panel/new/add/new-periodico');
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

	// /panle/new/encabezado/:fuente/:adjuntoId
	public function previewHeader( $fuente, $adjuntoId )
	{
		if( isset( $_SESSION['admin'] ) )
		{
			$encabezado = $this->encabezadoRepo->findByAdjuntoId( $adjuntoId );
			$adjunto = $this->adjuntoRepo->findById( $adjuntoId );

			$noticiaId = $adjunto['id_noticia'];

			$new = $this->noticiaRepo->getNewById( $noticiaId );

			$fuentes   = $this->fuenteRepo->showAllFonts( 0, 0, $new['tipofuente_id'] );
			$seccion = $this->seccionRepo->getSeccionById( $encabezado['id_seccion'] );

			$fraccion = unserialize($encabezado['fraccion']);
			$date = new \DateTime();
			$fecha = $date->setTimestamp( $encabezado['fecha'] ); 

			$this->header_admin('Vista previa adjunto de ' . ucfirst( $fuente ) . ' - ' );
			require $this->adminviews . 'previewHeaderView.php';
			$this->footer_admin();
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}

	public function editHeaderAction()
	{
		$encabezado = $this->encabezadoRepo->findById( $_POST['encabezadoId'] );	

		$fuente   = $this->fuenteRepo->getFontById( $_POST['fuente'], substr( $_POST['tipo_fuente'], 0, 3 ) );
		$seccion = $this->seccionRepo->getSeccionById( $_POST['seccion'] );
		$tiraje = intval( $fuente['tiraje'] );
		$updateEncabezado = [
							'id'		 => $_POST['encabezadoId'],
							'logo'       => $fuente['logo'],
							'impactos'   => $tiraje * 3,
							'fraccion'   => serialize( $this->validaFraccion( Util::percentToFraction( $_POST['porcentaje'] ) ) ),
							'num_pagina' => $_POST['num_pagina'],
							'porcentaje' => $_POST['porcentaje'],
							'seccion'    => $seccion['nombre'],
							'tiraje'     => $tiraje,
							'costo_cm'	 => $_POST['costocm2'],
							'costo_nota' => $_POST['costonota'],
							'tamanio'	 => $_POST['cm2'],
							'id_fuente'  => $_POST['fuente'],
							'id_seccion'  => $_POST['seccion'],
					     ];

		$alert = new stdClass();
		$update = $this->encabezadoRepo->edit( $updateEncabezado );
		if( $update->exito )
		{
			$alert->tipo = 'alert-info';
			$alert->mensaje = 'Se agrego actualizado la información  Correctamente!!!';
			$_SESSION['alerts']['update-header'] = $alert;
			header('Location: /panel/new/encabezado/'.$_POST['tipo_fuente'].'/'.$encabezado['id_adjunto']);
		}
		else
		{
			$alert->tipo = 'alert-danger';
			$alert->mensaje = 'No se pudo actualizar la informacion';
			$_SESSION['alerts']['update-header'] = $alert;
			header( 'Location: ' . $_SERVER['HTTP_REFERER'] );
		}

	}

	public function deleteHeaderAction()
	{		
		$alert = new stdClass();
		$deleteHeader = $this->encabezadoRepo->delete( $_POST['id_encabezado'] );
		if( $deleteHeader->exito )
		{
			$deleteAdjunto = $this->adjuntoRepo->delete( $_POST['id_adjunto'] );
			if( $deleteAdjunto->exito )
			{
				$alert->tipo = 'alert-info';
				$alert->mensaje = 'Se ha eliminado el archivo Correctamente!!!';
				$alert->ruta = '/panel/new/view/' . $_POST['id_noticia'];				
			}
			else
			{
				$alert->tipo = 'alert-danger';
				$alert->mensaje = 'No se pudo eliminar el archivo';
				$alert->ruta = $_SERVER['HTTP_REFERER'];
			}

		}
		else
		{
			$alert->tipo = 'alert-danger';
			$alert->mensaje = 'No se pudo eliminar el archivo';
			$alert->ruta = $_SERVER['HTTP_REFERER'];
		}

		header('Content-type: text/json');
		echo json_encode($alert); 		
	}

	// TODO: @AdminNewPE Falta el metodo para agregar un archivo con encabezados.
}