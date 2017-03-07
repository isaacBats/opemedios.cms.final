<?php 
use utilities\FontType;
use utilities\Util;

class AdminFonts extends Controller{

	private $fuentesRepository;
	private $sectionRepository;
	private $coberturaRepository;
	private $senalRepository;

	public function __construct(){
		$this->fuentesRepository = new FuentesRepository();
		$this->sectionRepository 	= new SeccionRepository();
		$this->coberturaRepository 	= new CoberturaRepository();
		$this->senalRepository 	= new SenalRepository();
	}

	public function showFonts(){

		if( isset( $_SESSION['admin'] ) ){

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

			$limit = isset($_GET['numpp'] ) ? $_GET['numpp'] : 10;
			$page = isset($_GET['page'] ) ? ( $_GET['page'] * $limit ) - $limit : 0;
			$search = isset($_GET['font_name']) ? $_GET['font_name'] : '';

			$fuentes = $this->fuentesRepository->showAllFonts( $limit, $page, -1, $search);

			$count = $this->fuentesRepository->getCountAllFonts($search);
			$ini = $page + 1;
			$end = ( $page + $limit >= $count ) ? $count : $page + $limit;

			$this->header_admin('Fuentes - ', $css);
			require $this->adminviews . 'showFonts.php';
			$this->footer_admin( $js );
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}

	public function fontDetail( $id )
	{
		if( isset( $_SESSION['admin'] ) ){

			$explode = explode('-', $id);
			$fontId = $explode[1];
			$font = $this->fuentesRepository->getFontById( $fontId, Util::tipoFuente($explode[0] - 1 )['pref']);
			$font['tipo fuente'] = Util::tipoFuente( $explode[0] -1 )['fuente'];
			$cobertura = $this->coberturaRepository->getCoberturaById( $font['id_cobertura'] );
			$font['cobertura'] = ($cobertura->exito) ? $cobertura->rows : 'Covertura no especificada';
			if( $explode[0] == 1 && isset( $font['id_senal'] ) ){
				$senal = $this->senalRepository->getSenalById( $font['id_senal'] );				
				$font['señal'] = ($senal->exito) ? $senal->rows : 'Señal no especificada';
				$desde = new DateTime( $font['desde'] );
				$hasta = new DateTime( $font['hasta'] );
				$font['desde'] = $desde->format('H:i');
				$font['hasta'] = $hasta->format('H:i');
			}
			$font['activo'] = ( $font['activo'] ) ? 'Si' : 'No';

			$getSections = $this->sectionRepository->getSectionsByFont( $fontId );	
			$sections = ( $getSections->exito ) ? $getSections->rows : $getSections->error[2];
			if(is_array( $sections ) ){
				$sections = array_map( function( $s ){
					$s['activo'] = ( $s['activo'] ) ? ['class' => 'fa-check-circle green', 'activo' => TRUE] : ['class' => 'fa-times-circle red', 'activo' => FALSE];
					return $s;
				}, $sections);
			}
			// echo '<pre>';print_r($font);
			
			$this->header_admin('Detalle - ' . $font['nombre'] . ' - ');
				require $this->adminviews . 'detailFontView.php';
			$this->footer_admin();
					
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}

	protected function addFont( $campos, $fuente ){

		if( isset( $_SESSION['admin'] ) ){

			$css = '
					<link href="/admin/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
				   ';

			$js = '
					<!-- Select2 JavaScript -->
				    <script type="text/javascript" src="/assets/bower_components/moment/min/moment.min.js"></script>
				    <script src="/admin/js/datetimepicker.js"></script>
				  ';
			

			$this->header_admin('Agregar Fuente de '.$fuente.' - ', $css);
			require $this->adminviews . 'addFont.php';
			$this->footer_admin( $js );
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }

	}

	/**
	 *Return sections by font id
	 * @param int $id
	 * @return JSON
	 */
	public function getSectionsByFontId ( $id ){
		
		$sections = null;
		if( isset( $_SESSION['admin'] ) ){
			$sections = $this->sectionRepository->getByFontId( $id );
			header('Content-type: text/json');
	        echo json_encode($sections);		
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
		
	}

	public function changeState()
	{
		if( isset( $_SESSION['admin'] ) ){
			$sectionId = $_GET['section'];
			$action = $_GET['action'];
			$res = new stdClass();
			$state = $this->sectionRepository->changeActive( $sectionId );
			if( $state->exito ){
				$res->exito = TRUE;
				$res->class = 'alert-info';
				$res->text = 'Se ha ' . $action . ' la seccion con exito!!!';
			}else{
				$res->exito = FALSE;
				$res->class = 'alert-warning';
				$res->text = $state->error;
			}
			header('Content-type: text/json');
	        echo json_encode($res);		
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}

	public function addSection()
	{
		if( isset( $_SESSION['admin'] ) ){
			
			$section = new stdClass();
			$section->nombre = $_POST['nombre'];
			$section->autor = $_POST['autor'];
			$section->descripcion = ( !empty( $_POST['decripcion'] ) ) ? $_POST['decripcion'] : 'Sin descripción';
			$section->fuenteId = $_POST['fuenteId'];

			// vdd($section);
			$res = new stdClass();
			$state = $this->sectionRepository->addSection( $section );
			if( $state->exito ){
				$res->exito = TRUE;
				$res->class = 'alert-info';
				$res->text = 'Se ha agregado la seccion con exito!!!';
			}else{
				$res->exito = FALSE;
				$res->class = 'alert-warning';
				$res->text = $state->error;
			}

			header('Content-type: text/json');
	        echo json_encode($res);		
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }	
	}

	public function getAuthor( $id_seccion )
	{
		$autor = $this->sectionRepository->getAuthor( $id_seccion );

		$autor = $autor->exito ? $autor->row : '';
		
		header('Content-type: text/json');
	    echo json_encode( $autor );
	}

	public function getFontsByTypeFont($idTypeFont)
	{
		$tFonts = array();
		$fonts = array();

		if($idTypeFont == 0){
			$tFonts = [FontType::FONT_TELEVISION['key'],
							FontType::FONT_RADIO['key'],
							FontType::FONT_PERIODICO['key'],
							FontType::FONT_REVISTA['key'],
							FontType::FONT_INTERNET['key']];
		}else
			$tFonts = [$idTypeFont,];

		$getFonts = $this->fuentesRepository->getFontsByTipeFont($tFonts);
		
		if($getFonts->exito)
			$fonts = $getFonts->rows;
		else
			$fonts = ['No se encontraron fuentes para este medio'];

		header('Content-type: text/json');
		echo json_encode($fonts);
		
	}

	//TODO: @Adminfonts Falta Editar una fuente
	//TODO: @AdminFonts Falta borrar una fuente
}