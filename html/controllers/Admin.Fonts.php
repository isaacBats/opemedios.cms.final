<?php 
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
			$font = $this->fuentesRepository->getFontById( $explode[1], Util::tipoFuente($explode[0] - 1 )['pref']);
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

			$getSections = $this->sectionRepository->getSectionsByFont( $explode[1] );	
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
}