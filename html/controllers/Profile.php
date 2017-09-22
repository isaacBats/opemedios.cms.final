<?php 

use utilities\TipoPortadas;
use utilities\TipoColumnas;

class Profile extends Controller{

	private $temasId;
	private $perfilRepository;
	private $asignaRepo;
	private $noticiaRepo;
	private $company;
	private $portadasRepo;
	private $fuentesRepo;
	private $acountRepo;

	function __construct()
	{
		$this->perfilRepository = new PefilRepository();
		$this->asignaRepo = new AsignaRepository();
		$this->noticiasRepo = new NoticiasRepository();
		$this->portadasRepo = new PortadasRepository();
		$this->fuentesRepo = new FuentesRepository();
		$this->acountRepo = new CuentaRepository();
		$this->temasId = $this->getTemesProfile();
		$this->company = [
			'id' => $_SESSION['user']['id_empresa'],
			'name' => $_SESSION['user']['empresa'], 
			'address' => $_SESSION['user']['direccion'],
			'telephone' => $_SESSION['user']['tel_empresa'], 
			'contact' => $_SESSION['user']['contacto_empresa'], 
			'email' => $_SESSION['user']['email_empresa'], 
			'logo' => $_SESSION['user']['logo_empresa'],
			'giro' => $_SESSION['user']['giro'],
		];
	}

	private function getTemesProfile()
	{
		if (isset($_SESSION['user']['temas'])) {
			return array_map(function($theme) {
				return $theme['id_tema'];
			}, $_SESSION['user']['temas']);
		}

		return [];
	}

	public function getCompany()
	{
		return $this->company;
	}


	public function showNews()
	{
		if( isset( $_SESSION['user'] ) ){			
			
			$limit = (isset($_GET['numpp'])) ? $_GET['numpp'] : 10;
			$page = (isset($_GET['page'])) ? ( $_GET['page'] * $limit ) - $limit : 0;
			$search = (isset($_GET['search'])) ? $_GET['search'] : NULL;

			$js = '
					<!-- Libreria jquery-bootpag --> 
					<script src="/admin/js/vendors/bootstrap/jquery.bootpag.min.js"></script>
					<!-- Libreria purl --> 
					<script src="/admin/js/vendors/purl/purl.min.js"></script>
					<!-- Paginador con js --> 
					<script src="/assets/js/panel.paginador.js"></script>
			';

			$css = '

					<!-- panel_paginator CSS -->
				    <link href="/admin/css/panel.main.css" rel="stylesheet">
				    <!-- data tables bootstrap CSS -->
				    <link href="/admin/css/dataTables.bootstrap.css" rel="stylesheet">
			';
			
			$asignations = $this->asignaRepo->findByThemeIdAndCompanyId($this->company['id'], $this->temasId, $search, $limit, $page);

			$count = $asignations['count'];
			$ini = $page + 1;
			$end = ( $page + $limit >= $count ) ? $count : $page + $limit;

			if ($asignations['rows'] != 0) {
				$news = array_map(function ($asigna){				
					
					$new = $this->noticiasRepo->getNewById($asigna['id_noticia']);
					$new['adjunto'] = $this->getMediaHTML($new['tipofuente_id'], $new['id']);
					return $new;

				}, $asignations['rows']);
			} else {
				$news = $asignations['rows'];
			}

			
			$countAsigned = $this->asignaRepo->countNewsAsigned($this->company['id'], $this->temasId);



			$this->renderViewClient('home', 'Noticias - ' . $_SESSION['user']['empresa'] . ' - ', compact('news', 'countAsigned', 'count', 'ini', 'end', 'css', 'js'));
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/sign-in");
        }

	}

	public function detailNewView($fontType, $newId)
	{
		if (isset($_GET['token'])) {
			$token = base64_decode($_GET['token']);
			$explode = explode('_', $token);
			$userID = base64_decode($explode[0]);
			if ($userget = $this->acountRepo->get($userID)) {
				$new = $this->noticiasRepo->getNewById($newId);
				$media = $this->getMediaHTML($new['tipofuente_id'], $newId);
	 			
				if ($fontType === 'internet')
					$newInternet = $this->noticiasRepo->getNewById($newId, 'int');

				$this->renderViewClient('detailNew', $new['encabezado'] . ' - ', compact('new', 'media', 'newInternet'));
				exit;
			}

		} elseif (isset($_SESSION['user'])) {
			$new = $this->noticiasRepo->getNewById($newId);
			$media = $this->getMediaHTML($new['tipofuente_id'], $newId);
 			
			if ($fontType === 'internet')
				$newInternet = $this->noticiasRepo->getNewById($newId, 'int');

			$this->renderViewClient('detailNew', $new['encabezado'] . ' - ', compact('new', 'media', 'newInternet'));
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/sign-in");
        }		
	}

	public function primerasPlanas ()
	{
		if( isset( $_SESSION['user'] ) ){
			$js = '<script src="/assets/assets_client/js/lightbox.min.js"></script>';
			$css = '<link href="/assets/assets_client/css/lightbox.min.css" rel="stylesheet">';
			$date = isset($_GET['fecha']) ? $_GET['fecha'] : date('Y-m-d');

			$title = 'Primeras Planas';
			$tipo_portada = TipoPortadas::PRIMERAS_PLANAS;
			$adminColumns = new AdminColumns();
			$covers = $adminColumns->getCovers($tipo_portada, 'portada', $date);

			$this->renderViewClient('covers', $title . ' - ', compact('title', 'covers'), $css, $js);
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/sign-in");
        }	
	}

	public function portadasFinancieras ()
	{
		if( isset( $_SESSION['user'] ) ){
			$js = '<script src="/assets/assets_client/js/lightbox.min.js"></script>';
			$css = '<link href="/assets/assets_client/css/lightbox.min.css" rel="stylesheet">';
			$date = isset($_GET['fecha']) ? $_GET['fecha'] : date('Y-m-d');

			$title = 'Portadas Financieras';
			$tipo_portada = TipoPortadas::PORTADAS_FINANCIERAS;
			$adminColumns = new AdminColumns();
			$covers = $adminColumns->getCovers($tipo_portada, 'portada', $date);

			$this->renderViewClient('covers', $title . ' - ', compact('title', 'covers'), $css, $js);
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/sign-in");
        }	
	}

	public function cartones ()
	{
		if( isset( $_SESSION['user'] ) ){
			$js = '<script src="/assets/assets_client/js/lightbox.min.js"></script>';
			$css = '<link href="/assets/assets_client/css/lightbox.min.css" rel="stylesheet">';
			$date = isset($_GET['fecha']) ? $_GET['fecha'] : date('Y-m-d');

			$title = 'Cartones';
			$tipo_portada = TipoPortadas::CARTONES;
			$adminColumns = new AdminColumns();
			$covers = $adminColumns->getCovers($tipo_portada, 'portada', $date);

			$this->renderViewClient('covers', $title . ' - ', compact('title', 'covers'), $css, $js);
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/sign-in");
        }	
	}

	public function columnasPoliticas()
	{
		if( isset( $_SESSION['user'] ) ){

			$date = isset($_GET['fecha']) ? $_GET['fecha'] : date('Y-m-d');
			$title = 'Columnas Politicas';
			$tipo_columna = TipoColumnas::COLUMNAS_POLITICAS;
			$segment = 'politicas';
			$adminColumns = new AdminColumns();
			$covers = $adminColumns->getCovers($tipo_columna, 'columna', $date);
			
			$this->renderViewClient('columns', $title . ' - ', compact('title', 'covers', 'segment'));
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}

	public function columnasFinancieras()
	{
		if( isset( $_SESSION['user'] ) ){

			$date = isset($_GET['fecha']) ? $_GET['fecha'] : date('Y-m-d');
			$title = 'Columnas Financieras';
			$tipo_columna = TipoColumnas::COLUMNAS_FINANCIERAS;
			$segment = 'financieras';
			$adminColumns = new AdminColumns();
			$covers = $adminColumns->getCovers($tipo_columna, 'columna', $date);
			
			$this->renderViewClient('columns', $title . ' - ', compact('title', 'covers', 'segment'));
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}

	public function detailColumn ($type, $columnId) 
	{
		if( isset( $_SESSION['user'] ) ){
			$column = $this->portadasRepo->getColumna($columnId);

			$font = $this->fuentesRepo->getFontById($column['fuente_id']);

			$this->renderViewClient('columnDetail', $column['titulo'] . ' - ', compact('column', 'font'));
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}

}