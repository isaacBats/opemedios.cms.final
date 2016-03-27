<?php 

require (__DIR__.'/../Repositories/FuentesRepository.php');


class AdminFonts extends Controller{

	private $fuentesRepository;

	public function __construct(){
		$this->fuentesRepository = new FuentesRepository();
	}

	public function showFonts(){

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
	}
}