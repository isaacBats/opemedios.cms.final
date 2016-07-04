<?php 

include_once(__DIR__.'/../Repositories/NoticiasRepository.php');
include_once(__DIR__.'/../Repositories/FuentesRepository.php');
include_once(__DIR__.'/../Repositories/TipoFuenteRepository.php');
include_once(__DIR__.'/../Repositories/TipoAutorRepository.php');
include_once(__DIR__.'/../Repositories/GeneroRepository.php');
include_once(__DIR__.'/../Repositories/SectorRepository.php');
include_once(__DIR__.'/../Repositories/SeccionRepository.php');

include 'Image.php';

class AdminNews extends Controller{

	private $noticiasRepository;		

	public function __construct(){
		$this->noticiasRepository = new NoticiasRepository();
	}

	public function showNews(){
		$noticias = $this->noticiasRepository->showNewsToDay();
		if ( is_array($noticias) ){

			$html = '';
			foreach ($noticias as $noticia) {

				$asigna = $this->noticiasRepository->asignaByIdNoticia( $noticia['id'] );
				$enviado = ( is_array( $asigna ) ) ? $asigna['empresa'] : 'No enviado';

				$html .= '
						<tr>
	                        <td></td>
	                        <td>
	                        	<span>' . $noticia['id'] . '</span>
	                        	<p>' . $noticia['encabezado'] . '</p>
	                        </td>
	                        <td>'.$noticia['nameFont'].'</td>
	                        <td>' .$enviado. '</td>
	                        <td>
								<a href="/panel/new/view/' . $noticia['id'] . '"><i class="fa fa-eye"></i></a>	
								<a href="/panel/new/edit/' . $noticia['id'] . '"><i class="fa fa-pencil"></i></a>	
								<a href=""><i class="fa fa-envelope-o"></i></a>	
								<a href=""><i class="fa fa-trash-o"></i></a>	
	                        </td>
	                    </tr>
				';
			}
		}

		$this->header_admin('Noticias de Hoy - ' );
		require $this->adminviews . 'showNews.php';
		$this->footer_admin();
	}

	public function viewNew ( $id ){

		$fr = new FuentesRepository();
		$newSelected = $this->noticiasRepository->getNewById( $id ); 
		$relatedNew = null ;
		$html = '';
		switch ($newSelected['tipofuente_id']) {
			case '1':
				$font = 'tel';
				$relatedNew = $this->noticiasRepository->getNewById( $id, $font );
				if( is_array( $relatedNew ) ){
					$html = '
								<p>Hora: <strong>' . $relatedNew['hora'] . '</strong></p>
								<p>Duración: <strong>' . $relatedNew['duracion'] . '</strong></p>
					';					
				}
				break;
			case '2':
				$font = 'rad';
				$relatedNew = $this->noticiasRepository->getNewById( $id, $font );
				if( is_array( $relatedNew ) ){
					$html = '
								<p>Hora: <strong>' . $relatedNew['hora'] . '</strong></p>
								<p>Duración: <strong>' . $relatedNew['duracion'] . '</strong></p>
					';					
				}
				break;
			case '3':
				$font = 'per';
				$relatedNew = $this->noticiasRepository->getNewById( $id, $font );
				if( is_array( $relatedNew ) ){
					$html = '
								<p>Página: <strong>' . $relatedNew['pagina'] . '</strong></p>
								<p>Tamaño(%): <strong>' . $relatedNew['porcentaje_pagina'] . '</strong></p>
					';					
				}
				break;
			case '4':
				$font = 'rev';
				$relatedNew = $this->noticiasRepository->getNewById( $id, $font );
				if( is_array( $relatedNew ) ){
					$html = '
								<p>Página: <strong>' . $relatedNew['pagina'] . '</strong></p>
								<p>Tamaño(%): <strong>' . $relatedNew['porcentaje_pagina'] . '</strong></p>
					';					
				}
				break;
			case '5':
				$font = 'int';
				$relatedNew = $this->noticiasRepository->getNewById( $id, $font );
				if( is_array( $relatedNew ) ){
					$html = '
								<p>Hora de captura: <strong>' . $relatedNew['hora_publicacion'] . '</strong></p>
								<p>URL: <a href="' . $relatedNew['url'] . '" target="_blank" >' . $relatedNew['url'] . '</a></p>							
					';					
				}
				break;
		}
		
		$this->header_admin('Noticias de Hoy: ' . $newSelected['encabezado'] . ' - ' );
		require $this->adminviews . 'viewNew.php';
		$this->footer_admin();
	}

	public function editNewView( $id ){

		$newSelected = $this->noticiasRepository->getNewById( $id ); 
		
		$this->header_admin('Editar noticias: ' . $newSelected['encabezado'] . ' - ' );
		require $this->adminviews . 'editNew.php';
		$this->footer_admin();	
	}

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
			    <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet">
			    <link rel="stylesheet" type="text/css" media="screen" href="http://tarruda.github.com/bootstrap-datetimepicker/assets/css/bootstrap-datetimepicker.min.css">    			
		';

		$js = '
				<!-- Select2 JavaScript -->
			    <script type="text/javascript" src="/assets/bower_components/moment/min/moment.min.js"></script>
			    <script src="/admin/js/bootstrap-datetimepicker.min.js"></script>
			    <script src="/assets/js/select2.min.js"></script>
			    <script src="/assets/js/i18n/es.js"></script>
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

	protected static function guardaArchivo( $principal, $ruta ){

		/*
		
			audio/x-ms-wma          
			application/pdf         
			video/x-ms-wmv          
			application/msword      
			audio/mpeg3             
			video/mpeg4             
			audio/mp3               
			audio/wav               
			image/pjpeg             
			audio/mpeg              
			application/vnd.ms-wpl  
			application/octet-stream
			video/3gpp              
			image/bmp               
			video/vnd.rn-realvideo  
			video/mpeg              
			image/png               
			audio/mp4               
			video/x-ms-wma          
			image/gif               
			image/x-png             
			video/quicktime         

		 */

		$extencionesPermitidas = ['pdf', 'jpg', 'jpeg', 'gif', 'png', 'JPG', 'JPEG', 'PNG', 'mp4', 'wma', 'wmv', 'mp3', 'avi'];
		$explode = explode(".", $principal["name"]);
		$extension = end($explode);
		if ((($principal['type'] == 'image/png')
			|| ($principal['type'] == 'image/jpeg')
			|| ($principal['type'] == 'image/jpg')
			|| ($principal['type'] == 'image/PNG')
			|| ($principal['type'] == 'audio/x-ms-wma')
			|| ($principal['type'] == 'audio/mpeg')
			|| ($principal['type'] == 'audio/mp3')
			|| ($principal['type'] == 'video/avi')
			|| ($principal['type'] == 'application/pdf')
			|| ($principal['type'] == 'video/mp4'))
			&& in_array($extension, $extencionesPermitidas))
		{
			if ($principal["error"] > 0)
			{
				echo "ERROR: " . $principal["error"] . "<br>";
			}
			else
			{
				$path=__DIR__ . '/../' . $ruta . $principal["name"];
				$move = move_uploaded_file($principal["tmp_name"],$path);

				if(!$move){
					throw new Exception("Error al mover el archivo", 1);
				}else{
					return true;
				}
			}
		}else{
			return false;
		}
	}

	public function createImage( $id ){

		// $new = $this->noticiasRepository->getNewById( $id );
		// print_r($new); exit();
		
		$new = [
			'pagina'	=> '35',
			'seccion' 	=> 'CULTURA Y ENTRETENIMIENTO',
			'cm2'		=> '34',
			'tiraje'	=> '50,072',
			'impactos'	=> '150,216',
			'fraccion'	=> '1/25',
			'porcentaje'=> '4.00%',
			'cost/Cm2'	=> '$126',
			'costoNota' => '$4,420'
		];

		$imagen = new Image( $new );

		header('Content-Type: image/jpeg');
		$nueva = $imagen->createImage();		
		imagejpeg($nueva);
		imagedestroy($nueva);
	}
}