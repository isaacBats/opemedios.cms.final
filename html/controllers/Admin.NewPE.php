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
								'costo_nota' => 0,
								'tamanio'	 => 0,
						     ];				
			
			$fil = array();
			if( $_FILES['primario']['name'][0] != '' ){
				$fil = array_map(function ($name, $type, $tmp_name, $error, $size) use ( $slug, $encabezado ){
					return ['name' => $name, 'type' => $type, 'tmp_name' => $tmp_name, 'error' => $error, 'size' => $size, 'slug' => $_POST['slug'], 'principal' => '0', 'encabezado' => $encabezado, ];
				}, $_FILES['primario']['name'], $_FILES['primario']['type'], $_FILES['primario']['tmp_name'], $_FILES['primario']['error'], $_FILES['primario']['size']);
			}
			$_POST['archivos'] = $fil;

			// vdd($_POST);

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
			$seccion = $this->seccionRepo->getSeccionById( $new['seccion_id'] );

			$fraccion = unserialize($encabezado['fraccion']);
			  // new DateTimeZone('America/Mexico_City')
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
		$fuente   = $this->fuenteRepo->getFontById( $_POST['fuente'] );
		$seccion = $this->seccionRepo->getSeccionById( $_POST['seccion'] );

		// $tiraje = intval( $this->peRepository->getTirajeById( $_POST['fuente'] )['tiraje'] );
		// $encabezado = [
		// 					'logo'       => $this->fuenteRepo->getLogoById( $_POST['fuente'] )['logo'],
		// 					'impactos'   => $tiraje * 3,
		// 					'fecha'	     => Util::getUnixDate(),
		// 					'fraccion'   => serialize( $this->validaFraccion( Util::percentToFraction( $_POST['tamano'] ) ) ),
		// 					'num_pagina' => $_POST['pagina'],
		// 					'porcentaje' => $_POST['tamano'],
		// 					'seccion'    => $this->seccionRepo->getSeccionById( $_POST['seccion'] )['nombre'],
		// 					'tiraje'     => $tiraje,
		// 					'costo_cm'	 => 0,
		// 					'costo_nota' => 0,
		// 					'tamanio'	 => 0,
		// 			     ];

		vdd($_POST);
	}
}