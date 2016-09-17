<?php 

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
	                        <td></td>
	                        <td>'.$fuente['nombre'].'</td>
	                        <td>'.$fuente['empresa'].'</td>
	                        <td>'.$fuente['logo'].'</td>
	                        <td>
	          					<a class="btn btn-default btn-sm" href="javascript:void(0);">Ver</a>
	          					<a class="btn btn-danger btn-sm" href="javascript:void(0);">Eliminar</a>
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

	protected function addFont( $campos, $fuente ){

		$this->header_admin('Agregar Fuente de '.$fuente.' - ');
		require $this->adminviews . 'addFont.php';
		$this->footer_admin();

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