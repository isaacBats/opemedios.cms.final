<?php 
use utilities\Util;

class AdminFonts extends Controller{

	private $fuentesRepository;
	private $sectionRepository;

	public function __construct(){
		$this->fuentesRepository = new FuentesRepository();
		$this->sectionRepository 	= new SeccionRepository();
	}

	public function showFonts(){

		if( isset( $_SESSION['admin'] ) ){

			$this->header_admin('Fuentes - ' );
			$fuentes = $this->fuentesRepository->showAllFonts();
			$html = '';
			foreach ($fuentes as $fuente) {
				$html .= '
						<tr>
	                        <td style="text-align: center;">
	                        	<i class="fa ' . Util::tipoFuente($fuente['id_tipo_fuente'] - 1)['icon'] . ' fa-3" style="font-size:40px;"></i>
	                        </td>
	                        <td>'.$fuente['nombre'].'</td>
	                        <td>'.$fuente['empresa'].'</td>
	                        <td><img src="/'.$fuente['logo'].'" alt="'.$fuente['nombre'].'" width="150" /></td>
	                        <td width="170">
	          					<a class="btn btn-default" href="/panel/fonts/detail/'.$fuente['id_tipo_fuente'].'-'.$fuente['id_fuente'].'">Ver</a>
	          					<a class="btn btn-danger" href="javascript:void(0);">Dar de baja</a>
	          				</td>
	                    </tr>
				';
			}

			require $this->adminviews . 'showFonts.php';
			$this->footer_admin();
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}

	public function fontDetail( $id )
	{
		if( isset( $_SESSION['admin'] ) ){

			$explode = explode('-', $id);
			// $font = $this->fuentesRepository->getFontById( $id );
			$font = $this->fuentesRepository->getFontById( $explode[1], Util::tipoFuente($explode[0] - 1 )['pref']);
			// echo '<pre>';print_r($font);
			
			$this->header_admin('Detalle - ' . $font['nombre'] . ' - ' );
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
}