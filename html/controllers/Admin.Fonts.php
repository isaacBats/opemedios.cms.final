<?php 
use utilities\FontType;
use utilities\Image;
use utilities\MediaDirectory;
use utilities\Util;

class AdminFonts extends Controller{

	private $fuentesRepository;
	private $sectionRepository;
	private $coberturaRepository;
	private $senalRepository;
	private $path_media;

	public function __construct(){
		$this->fuentesRepository = new FuentesRepository();
		$this->sectionRepository 	= new SeccionRepository();
		$this->coberturaRepository 	= new CoberturaRepository();
		$this->senalRepository 	= new SenalRepository();
		$this->path_media = MediaDirectory::LOGO_FUENTES;
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
            header( "Location: https://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}

	public function fontDetail( $id )
	{
		if( isset( $_SESSION['admin'] ) ){

			$explode = explode('-', $id);
			$fontType = $explode[0];
			$fontId = $explode[1];
			$signs = $this->senalRepository->all();
			$coverage = $this->coberturaRepository->all();
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
			$font['is_active'] = $font['activo'];
			$font['activo'] = ( $font['activo'] ) ? 'Si' : 'No';

			$getSections = $this->sectionRepository->getSectionsByFont( $fontId );	
			$sections = ( $getSections->exito ) ? $getSections->rows : $getSections->error[2];
			if(is_array( $sections ) ){
				$sections = array_map( function( $s ){
					$s['activo'] = ( $s['activo'] ) ? ['class' => 'fa-check-circle green', 'activo' => TRUE] : ['class' => 'fa-times-circle red', 'activo' => FALSE];
					return $s;
				}, $sections);
			}

			$this->header_admin('Detalle - ' . $font['nombre'] . ' - ');
				require $this->adminviews . 'detailFontView.php';
			$this->footer_admin();
					
		}else{
            header( "Location: https://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}

	protected function addFont( $campos, $fuente ){

		if( isset( $_SESSION['admin'] ) ){

			$this->header_admin('Agregar Fuente de '.$fuente.' - ');
			require $this->adminviews . 'addFont.php';
			$this->footer_admin();
		}else{
            header( "Location: https://{$_SERVER["HTTP_HOST"]}/panel/login");
        }

	}

	public function deleteFont ($id)
	{
		if( isset( $_SESSION['admin'] ) ){
			try {
	            $row = new stdClass;
	            $sections = $this->sectionRepository->deleteByFontId($id);
	            $row->sectionsDeleted = $sections;
	            $logo = $this->fuentesRepository->getLogoById($id);
	            $image = __DIR__ . '/../' . $logo['logo'];
	            if(file_exists($image) && !is_dir($image)){
	            	unlink($image);
	            	$row->imageDeleted = $image;
	            }
	            $fontDelete = $this->fuentesRepository->delete($id);

	            if($fontDelete)
	            	$row->exito = true;
	            else
	            	$row->exito = false;

	            header('Content-type: text/json');
		        echo json_encode($row);
			} catch (Exception $e) {
				throw new Exception($e->getMessage());
			}
		}else{
            header( "Location: https://{$_SERVER["HTTP_HOST"]}/panel/login");
        }		
	}



	public function update ($id) 
	{
		if( isset( $_SESSION['admin'] ) ){			

			$explode = explode('-', $id);
			$font = $this->fuentesRepository->getFontById($explode[1]);
			$newCover = null;
			
			if ($_FILES['logo']['error'] == 0) {
				$adminColumn = new AdminColumns();
				$newCover = $adminColumn->saveImages($_FILES['logo'], $this->path_media);
				$im = new Image();
				$imageExplode = explode('.', $font['logo']);
				$old_image = $font['logo'];
				$old_thumb = $imageExplode[0].'_thumb.'.$imageExplode[1];
				$imagesDelete = $im->deleteImage([$old_image, $old_thumb]);
			}

			$data = array();
			$fontType = $explode[0];
			$data['id_fuente'] = $explode[1];
			$data['nombre'] = $_POST['nombre'];
			$data['empresa'] = $_POST['empresa'];
			$data['comentario'] = $_POST['comentario'];
			$data['logo'] = ($_FILES['logo']['error'] != 0) ? $font['logo'] : $newCover['originName'];
			$data['activo'] = isset($_POST['activo']) ? 1 : 0;
			$data['id_cobertura'] = $_POST['cobertura'];

			if ($fontType == FontType::FONT_TELEVISION['key']){
				$data['conductor'] = $_POST['conductor'];
				$data['canal'] = $_POST['canal'];
				$data['desde'] = $_POST['desde'];
				$data['hasta'] = $_POST['hasta'];
				$data['id_senal'] = $_POST['senal'];
			}

			if ($fontType == FontType::FONT_RADIO['key']){
				$data['conductor'] = $_POST['conductor'];
				$data['estacion'] = $_POST['estacion'];
				$data['horario'] = $_POST['horario'];
			}

			if ($fontType == FontType::FONT_REVISTA['key'] || $fontType == FontType::FONT_PERIODICO['key'])
				$data['tiraje'] = $_POST['tiraje'];

			if ($fontType == FontType::FONT_INTERNET['key'])
				$data['url'] = $_POST['url'];

			$fontUpdated = $this->fuentesRepository->updateFont($data, $fontType);
			$result = new stdClass();
			if ($fontUpdated->exito){
				$result->tipo = 'alert-info';
				$result->mensaje = 'La fuente <strong>' . $data['nombre'] . '</strong>. Se actualizo correctamente!.';
			}
			else{
				$result->tipo = 'alert-warning';
				$result->mensaje = 'La fuente <strong>' . $data['nombre'] . '</strong>. No se pudo actualizar.';
				$result->error[2] = $fontUpdated->error;
			}

			$_SESSION['alerts']['fuentes'] = $result;
			header( 'Location: /panel/fonts/show-list');

		}else{
            header( "Location: https://{$_SERVER["HTTP_HOST"]}/panel/login");
        }	
	}

	/**
	 *Return sections by font id
	 * @param int $id
	 * @return JSON
	 */
	public function getSectionsByFontId ( $id ){
		
		$sections = null;
		//if( isset( $_SESSION['admin'] ) ){
			$sections = $this->sectionRepository->getByFontId( $id );
			header('Content-type: text/json');
	        echo json_encode($sections);		
		//}else{
          //  header( "Location: https://{$_SERVER["HTTP_HOST"]}/panel/login");
        //}
		
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
            header( "Location: https://{$_SERVER["HTTP_HOST"]}/panel/login");
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
            header( "Location: https://{$_SERVER["HTTP_HOST"]}/panel/login");
        }	
	}

	public function editSection ($idSection)
	{	
		if (isset($_SESSION['admin'])) {
			$section = $this->sectionRepository->getSeccionById($idSection);
			$section['nombre'] = $_POST['nombre'];
			$section['autor'] = $_POST['autor'];
			$section['descripcion'] = $_POST['decripcion'];

			$updateSection = $this->sectionRepository->update($section);
			$res = new stdClass;
			if ($updateSection->exito) {
				$res->exito = true;
				$res->class = 'alert-info';
				$res->object = $updateSection->row;
				$res->text = 'Se ha actualizado la sección con exito';
			} else {
				$res->exito = false;
				$res->class = 'alert-warning';
				$res->error = $updateSection->error;
			}
			header('Content-type: text/json');
	        echo json_encode($res);
		} else {
            header( "Location: https://{$_SERVER["HTTP_HOST"]}/panel/login");
		}
	}

	public function deleteSection ($id)
	{
		if (isset($_SESSION['admin'])) {
			
			$row = new stdClass;
			if ($del = $this->sectionRepository->delete($id))
				$row->exito = true;
			else {
				$row->exito = false;
				$row->error = 'No se pudo borrar el elemento. Contacte con el administrador';
			}

			header('Content-type: text/json');
	        echo json_encode($row);
		} else {
            header( "Location: https://{$_SERVER["HTTP_HOST"]}/panel/login");
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

	//TODO: @AdminFonts Falta borrar una fuente
}