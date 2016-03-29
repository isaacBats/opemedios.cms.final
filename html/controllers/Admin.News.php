<?php 

require (__DIR__.'/../Repositories/NoticiasRepository.php');


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

		$this->header_admin('Agregar Noticia de '.$fuente.' - ');
		require $this->adminviews . 'addNew.php';
		$this->footer_admin();

	}
}