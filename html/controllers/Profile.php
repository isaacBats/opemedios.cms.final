<?php 

use utilities\TipoPortadas;
use utilities\TipoColumnas;
use utilities\Util;
use utilities\MediaDirectory;

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
			'id' => isset($_SESSION['user']['id_empresa']) ? $_SESSION['user']['id_empresa']: 0,
			'name' => isset($_SESSION['user']['empresa']) ? $_SESSION['user']['empresa']: "", 
			'address' => isset($_SESSION['user']['direccion']) ? $_SESSION['user']['direccion']: "",
			'telephone' => isset($_SESSION['user']['tel_empresa']) ? $_SESSION['user']['tel_empresa']: "", 
			'contact' => isset($_SESSION['user']['contacto_empresa']) ? $_SESSION['user']['contacto_empresa']: "", 
			'email' => isset($_SESSION['user']['email_empresa']) ? $_SESSION['user']['email_empresa']: "", 
			'logo' => isset($_SESSION['user']['logo_empresa']) ? $_SESSION['user']['logo_empresa']: "",
			'giro' => isset($_SESSION['user']['giro']) ? $_SESSION['user']['giro']: "",
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

			$js = "<!-- Libreria jquery-bootpag --> 
					<script src='admin/js/vendors/bootstrap/jquery.bootpag.min.js'></script>
					<!-- Libreria purl --> 
					<script src='admin/js/vendors/purl/purl.min.js></script>
					<!-- Paginador con js --> 
					<script src='assets/js/panel.paginador.js'></script>";

			$css = "<!-- panel_paginator CSS -->
				    <link href='admin/css/panel.main.css' rel='stylesheet'>
				    <!-- data tables bootstrap CSS -->
				    <link href='admin/css/dataTables.bootstrap.css' rel='stylesheet'>";
			
			$asignations = $this->asignaRepo->findByThemeIdAndCompanyId($this->company['id'], $this->temasId, $search, $limit, $page);
			$count = (int)$asignations['count'];
			$ini = $page + 1;
			$end = ( (int)$page + (int)$limit >= (int)$count ) ? (int)$count : (int)$page + (int)$limit;
			if ($asignations['rows'] != 0) {
				$keys = array_column($asignations['rows'], 'id_noticia');
				$news = $this->noticiasRepo->getNewById($keys, null, true);
			} else {
				$news = $asignations['rows'];
			}
			/*$prevPage = ( ($ini - $limit) <= 0 ) ? 1: $ini-$limit;
			if($end >= $count){
				$nextUrl = "#";
			}else{
				$nextPage = isset($_GET['page']) ? (int)$_GET['page']+1: "#";
				$nextUrl = "/noticias?search={$search}&page={$nextPage}&numpp={$limit}";
			}
			$prevUrl = "/noticias?search={$search}&page={$prevPage}&numpp={$limit}";
			$pagination = "<li><a href='{$prevUrl}'>prev</a></li><li><a href='{$nextUrl}'>next</a></li>";*/
			$countAsigned = $this->asignaRepo->countNewsAsigned($this->company['id'], $this->temasId);
			$this->renderViewClient('home', 'Noticias - ' . $_SESSION['user']['empresa'] . ' - ', compact('news', 'countAsigned', 'count', 'ini', 'end', 'css', 'js'));
		}else{
            header( "Location: https://{$_SERVER["HTTP_HOST"]}/sign-in");
        }
	}

	public function detailNewView($fontType, $newId)
	{
			if ($new = $this->noticiasRepo->getNewById($newId)) {	
				$media = $this->getMediaHTML($new['tipofuente_id'], $newId);
				$tipo =  Util::tipoFuente(intval($new['tipofuente_id']) -1);
				$new['thumbnail_empresa'] = "https://{$_SERVER["HTTP_HOST"]}/" . $new['logo_fuente'];
	 			$noticiaTipoData = $this->noticiasRepo->getNewById($newId, $tipo['pref']);
	 			$new['share'] = "https://{$_SERVER["HTTP_HOST"]}/share/" . $tipo['url'] . "/" . $newId;
				$this->renderViewClient('detailNew', $new['encabezado'] . ' - ', compact('new', 'media', 'noticiaTipoData'));
				exit;

		} elseif (isset($_SESSION['user'])) {
			$new = $this->noticiasRepo->getNewById($newId);
			$media = $this->getMediaHTML($new['tipofuente_id'], $newId);
			$tipo =  Util::tipoFuente(intval($new['tipofuente_id']) -1);
			$new['thumbnail_empresa'] = "https://{$_SERVER["HTTP_HOST"]}/" . $new['logo_fuente'];
			$noticiaTipoData = $this->noticiasRepo->getNewById($newId, $tipo['pref']);
			$new['share'] = "https://{$_SERVER["HTTP_HOST"]}/share/" . $tipo['url'] . "/" . $newId;
			$this->renderViewClient('detailNew', $new['encabezado'] . ' - ', compact('new', 'media', 'noticiaTipoData'));
		}else{
            header( "Location: https://{$_SERVER["HTTP_HOST"]}/sign-in");
        }		
	}

	/*Vista al compartir */
	public function detailShare($fontType, $newId)
	{
			if ($new = $this->noticiasRepo->getNewById($newId)) {	
				$media = $this->getMediaHTML($new['tipofuente_id'], $newId);
				$tipo =  Util::tipoFuente(intval($new['tipofuente_id']) -1);
				$new['thumbnail_empresa'] = "https://{$_SERVER["HTTP_HOST"]}/" . $new['logo_fuente'];
	 			$noticiaTipoData = $this->noticiasRepo->getNewById($newId, $tipo['pref']);
	 			$new['share'] = "https://{$_SERVER["HTTP_HOST"]}/share/" . $tipo['url'] . "/" . $newId;
				$this->renderViewShare('detailNew', $new['encabezado'] . ' - ', compact('new', 'media', 'noticiaTipoData'));
				exit;
		} elseif (isset($_SESSION['user'])) {
			$new = $this->noticiasRepo->getNewById($newId);
			$media = $this->getMediaHTML($new['tipofuente_id'], $newId);
			$tipo =  Util::tipoFuente(intval($new['tipofuente_id']) -1);
			$new['thumbnail_empresa'] = "https://{$_SERVER["HTTP_HOST"]}/" . $new['logo_fuente'];
			$noticiaTipoData = $this->noticiasRepo->getNewById($newId, $tipo['pref']);
			$new['share'] = "https://{$_SERVER["HTTP_HOST"]}/share/" . $tipo['url'] . "/" . $newId;
			$this->renderViewClient('detailNew', $new['encabezado'] . ' - ', compact('new', 'media', 'noticiaTipoData'));
		}else{
            header( "Location: https://{$_SERVER["HTTP_HOST"]}/sign-in");
        }		
	}

	public function primerasPlanas ()
	{
		if( isset( $_SESSION['user'] ) ){
			$js = "<script src='assets/assets_client/js/lightbox.min.js'></script>
			<script src='//code.jquery.com/jquery-3.3.1.min.js'></script>
<script src='https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js'></script>
			";
			$css = "<link href='assets/assets_client/css/lightbox.min.css' rel='stylesheet'>
			<link rel='stylesheet' href='https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css' />
			";
			$date = isset($_GET['fecha']) ? $_GET['fecha'] : date('Y-m-d');

			$title = 'Primeras Planas';
			$tipo_portada = TipoPortadas::PRIMERAS_PLANAS;
			$adminColumns = new AdminColumns();
			$covers = $adminColumns->getCovers($tipo_portada, 'portada', $date);

			$this->renderViewClient('covers', $title . ' - ', compact('title', 'covers'), $css, $js);
		}else{
            header( "Location: https://{$_SERVER["HTTP_HOST"]}/sign-in");
        }	
	}

	public function portadasFinancieras ()
	{
		if( isset( $_SESSION['user'] ) ){
			$js = "<script src='assets/assets_client/js/lightbox.min.js'></script>
			<script src='//code.jquery.com/jquery-3.3.1.min.js'></script>
<script src='https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js'></script>";
			$css = "<link href='assets/assets_client/css/lightbox.min.css' rel='stylesheet'>
			<link rel='stylesheet' href='https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css' />";
			$date = isset($_GET['fecha']) ? $_GET['fecha'] : date('Y-m-d');

			$title = 'Portadas Financieras';
			$tipo_portada = TipoPortadas::PORTADAS_FINANCIERAS;
			$adminColumns = new AdminColumns();
			$covers = $adminColumns->getCovers($tipo_portada, 'portada', $date);

			$this->renderViewClient('covers', $title . ' - ', compact('title', 'covers'), $css, $js);
		}else{
            header( "Location: https://{$_SERVER["HTTP_HOST"]}/sign-in");
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
            header( "Location: https://{$_SERVER["HTTP_HOST"]}/sign-in");
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
            header( "Location: https://{$_SERVER["HTTP_HOST"]}/panel/login");
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
            header( "Location: https://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}

	public function detailColumn ($type, $columnId) 
	{
		if( isset( $_SESSION['user'] ) ){
			$column = $this->portadasRepo->getColumna($columnId);

			$font = $this->fuentesRepo->getFontById($column['fuente_id']);

			$this->renderViewClient('columnDetail', $column['titulo'] . ' - ', compact('column', 'font'));
		}else{
            header( "Location: https://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}

}