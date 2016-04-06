<?php 

include_once(__DIR__.'/../Repositories/NoticiasRepository.php');
include_once(__DIR__.'/../Repositories/FuentesRepository.php');
include_once(__DIR__.'/../Repositories/TipoFuenteRepository.php');
include_once(__DIR__.'/../Repositories/TipoAutorRepository.php');
include_once(__DIR__.'/../Repositories/GeneroRepository.php');
include_once(__DIR__.'/../Repositories/SectorRepository.php');
include_once(__DIR__.'/../Repositories/SeccionRepository.php');


class AdminNews extends Controller{

	private $noticiasRepository;
	

	public function __construct(){
		$this->noticiasRepository = new NoticiasRepository();
	}

	// public function showNews(){

	// 	$this->header_admin('Noticias de Hoy - ' );
	// 	$noticias = $this->noticiasRepository->showAllNews();
	// 	$html = '';
	// 	foreach ($noticias as $noticia) {
	// 		$html .= '
	// 				<tr>
 //                        <td></td>
 //                        <td>'.$noticia['nombre'].'</td>
 //                        <td>'.$noticia['empresa'].'</td>
 //                        <td>'.$noticia['logo'].'</td>
 //                        <td>
 //          					<a class="btn btn-default btn-sm" href="javascript:void(0);">Ver</a>
 //          					<a class="btn btn-danger btn-sm" href="javascript:void(0);">Eliminar</a>
 //          				</td>
 //                    </tr>
	// 		';
	// 	}

	// 	require $this->adminviews . 'showNews.php';
	// 	$this->footer_admin();
	// }

	protected function addNew( $campos, $fuente ){

		$fuentesRepository    = new FuentesRepository();
		$generoRepository     = new GeneroRepository();
		$sectorRepository     = new SectorRepository();
		$seccionRepository    = new SeccionRepository();
		$tipoFuenteRepository = new TipoFuenteRepository();
		$tipoAutorRepository  = new TipoAutorRepository();

		$genero		= '';
		$optionFont = '';
		$sector		= '';
		$seccion	= '';
		$tipoAutor	= '';

		$css = '
				<!-- Select2 CSS -->
			    <link href="/assets/css/select2.min.css" rel="stylesheet">
			    <link href="/admin/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
		';

		$js = '
				<!-- Select2 JavaScript -->
			    <script src="/admin/js/bootstrap-datetimepicker.min.js"></script>
			    <script src="/assets/js/select2.min.js"></script>
			    <script src="/assets/js/i18n/es.js"></script>
			    <script src="/assets/js/admin.js"></script>
		';
		
		if($fuente === 'Television'){
            $nomFuente = 'tele';
       	}elseif($fuente === 'Periodico'){
            $nomFuente = 'peri';
        }else{
			$nomFuente = strtolower($fuente);        	
        }

		$idFuente = $tipoFuenteRepository->findIdByName( $nomFuente );
		
		$fuentes   = $fuentesRepository->showAllFonts( $idFuente );
		$autores   = $tipoAutorRepository->allAuthors();
		$generos   = $generoRepository->allGeneros();
		$sectores  = $sectorRepository->allSectors( 1 );
		$secciones = $seccionRepository->allSecciones( 1 );

		foreach ($fuentes as $f) {
			$optionFont .= '<option value="'.$f['id_fuente'].'">'.$f['nombre'].'</option>';
		}

		foreach ($autores as $a) {
			$tipoAutor .= '<option value="'.$a['id_tipo_autor'].'">'.$a['descripcion'].'</option>';
		}

		foreach ($generos as $g) {
			$genero .= '<option value="'.$g['id_genero'].'">'.$g['descripcion'].'</option>';
		}

		foreach ($sectores as $s) {
			$sector .= '<option value="'.$s['id_sector'].'">'.$s['nombre'].'</option>';
		}

		foreach ($secciones as $secc) {
			$seccion .= '<option value="'.$secc['id_seccion'].'">'.$secc['nombre'].'</option>';
		}

		$this->header_admin( 'Agregar Noticia de '.$fuente.' - ', $css );
		require $this->adminviews . 'addNew.php';
		$this->footer_admin( $js );

	}
}