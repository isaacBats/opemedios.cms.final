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

	function __construct()
	{
		$this->perfilRepository = new PefilRepository ();
		$this->asignaRepo = new AsignaRepository ();
		$this->noticiasRepo = new NoticiasRepository ();
		$this->portadasRepo = new PortadasRepository ();
		$this->fuentesRepo = new FuentesRepository ();
		$this->temasId = array_map(function($theme) {
			return $theme['id_tema'];
		}, $_SESSION['user']['temas']);
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

	public function getCompany()
	{
		return $this->company;
	}


	public function showNews()
	{
		if( isset( $_SESSION['user'] ) ){			
			
			$limit = (isset($_GET['numpp'])) ? $_GET['numpp'] : 10;
			$page = (isset($_GET['page'])) ? ( $_GET['page'] * $limit ) - $limit : 0;
			$search = (isset($_GET['search'])) ? $_GET['search'] : '';

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
			
			$asignations = $this->asignaRepo->findByThemeIdAndCompanyId($this->company['id'], $this->temasId, $limit, $page);

			$count = $asignations['count'];
			$ini = $page + 1;
			$end = ( $page + $limit >= $count ) ? $count : $page + $limit;

			$news = array_map(function ($asigna) use ($search){				
				
				$new = $this->noticiasRepo->getNewById($asigna['id_noticia']);
				$new['adjunto'] = $this->getMediaHTML($new['tipofuente_id'], $new['id']);
				return $new;

			}, $asignations['rows']);

			$newsMonth = array_filter($news, function($row) {
				
				return substr($row['fecha'], 0, 7) == date('Y-m');

			});

			$newsToday = array_filter($news, function($row) {
				
				return $row['fecha'] == date('Y-m-d');

			});


			$this->renderViewClient('home', 'Noticias - ' . $_SESSION['user']['empresa'] . ' - ', compact('news', 'newsMonth', 'newsToday', 'count', 'ini', 'end', 'css', 'js'));
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/sign-in");
        }

	}

	public function detailNewView($fontType, $newId)
	{
		if( isset( $_SESSION['user'] ) ){


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

			$title = 'Primeras Planas';
			$tipo_portada = TipoPortadas::PRIMERAS_PLANAS;
			$adminColumns = new AdminColumns();
			$covers = $adminColumns->getCovers($tipo_portada, 'portada', date('Y-m-d'));

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

			$title = 'Portadas Financieras';
			$tipo_portada = TipoPortadas::PORTADAS_FINANCIERAS;
			$adminColumns = new AdminColumns();
			$covers = $adminColumns->getCovers($tipo_portada, 'portada', date('Y-m-d'));

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

			$title = 'Cartones';
			$tipo_portada = TipoPortadas::CARTONES;
			$adminColumns = new AdminColumns();
			$covers = $adminColumns->getCovers($tipo_portada, 'portada', date('Y-m-d'));

			$this->renderViewClient('covers', $title . ' - ', compact('title', 'covers'), $css, $js);
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/sign-in");
        }	
	}

	public function columnasPoliticas()
	{
		if( isset( $_SESSION['user'] ) ){

			$title = 'Columnas Politicas';
			$tipo_columna = TipoColumnas::COLUMNAS_POLITICAS;
			$segment = 'politicas';
			$adminColumns = new AdminColumns();
			$covers = $adminColumns->getCovers($tipo_columna, 'columna', date('Y-m-d'));
			
			$this->renderViewClient('columns', $title . ' - ', compact('title', 'covers', 'segment'));
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}

	public function columnasFinancieras()
	{
		if( isset( $_SESSION['user'] ) ){

			$title = 'Columnas Financieras';
			$tipo_columna = TipoColumnas::COLUMNAS_FINANCIERAS;
			$segment = 'financieras';
			$adminColumns = new AdminColumns();
			$covers = $adminColumns->getCovers($tipo_columna, 'columna', date('Y-m-d'));
			
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