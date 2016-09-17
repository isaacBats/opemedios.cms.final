<?php 

include 'Image.php';

require_once('Mail.php');

class AdminNews extends Controller{

	private $noticiasRepository;		

	public function __construct(){
		$this->noticiasRepository = new NoticiasRepository();
	}

	public function showNews(){
		if( isset( $_SESSION['admin'] ) ){
			
			$js = '';
			$css = '';

			$limit = isset( $_GET['numpp'] ) ? $_GET['numpp'] : 10;
			$page = isset( $_GET['page'] ) ? ( $_GET['page'] * $limit ) - $limit : 0;
			
			$countWithFilter = $this->noticiasRepository->getCountNews($data = [], $hoy = 'hoy');

			$count = $countWithFilter;

			$ini = $page + 1;
			$end = ( $page + $limit >= $count ) ? $count : $page + $limit;

			$noticias = $this->noticiasRepository->showNewsToDay( compact( 'limit', 'page' ) );
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
									<a href="/panel/new/send/' . $noticia['id'] . '"><i class="fa fa-envelope-o"></i></a>	
									<a href=""><i class="fa fa-trash-o"></i></a>	
		                        </td>
		                    </tr>
					';
				}
			}

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

			$this->header_admin('Noticias de Hoy - ', $css );
			require $this->adminviews . 'showNews.php';
			$this->footer_admin( $js );
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}

	public function viewNew ( $id ){

		if( isset( $_SESSION['admin'] ) ){
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
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}

	public function editNewView( $id ){

		if( isset( $_SESSION['admin'] ) ){

			$css = '
					<!-- Select2 CSS -->
				    <link href="/assets/css/select2.min.css" rel="stylesheet">
				    <link href="/admin/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
			';

			$js = '
					<!-- Select2 JavaScript -->
				    <script type="text/javascript" src="/assets/bower_components/moment/min/moment.min.js"></script>
				    <script src="/admin/js/bootstrap-datetimepicker.min.js"></script>
				    <script src="/assets/js/select2.min.js"></script>
				    <script src="/assets/js/i18n/es.js"></script>
			';

			$fr   = new FuentesRepository();
			$gr   = new GeneroRepository();
			$secr = new SectorRepository();
			$sccr = new SeccionRepository();
			$tfr  = new TipoFuenteRepository();
			$tar  = new TipoAutorRepository();

			$optionFont = '';
			$genero		= '';
			$sector		= '';
			$seccion	= '';
			$tipoAutor	= '';
			$tendencia  = '';
			$costo 		= '';

			$newSelected = $this->noticiasRepository->getNewById( $id );

			$fuentes   = $fr->showAllFonts( $newSelected['tipofuente_id'] );
			$autores   = $tar->allAuthors();
			$generos   = $gr->allGeneros();
			$sectores  = $secr->allSectors( 1 );
			$secciones = $sccr->allSecciones( 1 );
			$tendencias = $this->noticiasRepository->getTendencias();

			foreach ($tendencias as $t) {
				if ( $t['id_tendencia'] == $newSelected['tendencia_id'] ){
					$tendencia .= '<option value="'.$t['id_tendencia'].'" selected >'.$t['descripcion'].'</option>';				
				}else{
					$tendencia .= '<option value="'.$t['id_tendencia'].'">'.$t['descripcion'].'</option>';
				}
			}

			foreach ($fuentes as $f) {
				if ( $f['id_fuente'] == $newSelected['fuente_id'] ){
					$optionFont .= '<option value="'.$f['id_fuente'].'" selected >'.$f['nombre'].'</option>';				
				}else{
					$optionFont .= '<option value="'.$f['id_fuente'].'">'.$f['nombre'].'</option>';
				}
			}

			foreach ($autores as $a) {
				if( $a['id_tipo_autor'] == $newSelected['tipoautor_id'] ){
					$tipoAutor .= '<option value="'.$a['id_tipo_autor'].'" selected >'.$a['descripcion'].'</option>';				
				}else{
					$tipoAutor .= '<option value="'.$a['id_tipo_autor'].'">'.$a['descripcion'].'</option>';				
				}
			}

			foreach ($generos as $g) {
				if( $g['id_genero'] == $newSelected['genero_id'] ){
					$genero .= '<option value="'.$g['id_genero'].'" selected >'.$g['descripcion'].'</option>';				
				}else{
					$genero .= '<option value="'.$g['id_genero'].'">'.$g['descripcion'].'</option>';				
				}
			}

			foreach ($sectores as $s) {
				if( $s['id_sector'] == $newSelected['sector_id'] ){
					$sector .= '<option value="'.$s['id_sector'].'" selected >'.$s['nombre'].'</option>';				
				}else{
					$sector .= '<option value="'.$s['id_sector'].'">'.$s['nombre'].'</option>';				
				}
			}

			foreach ($secciones as $secc) {
				if( $secc['id_seccion'] == $newSelected['seccion_id'] ){
					$seccion .= '<option value="'.$secc['id_seccion'].'" selected >'.$secc['nombre'].'</option>';				
				}else{
					$seccion .= '<option value="'.$secc['id_seccion'].'">'.$secc['nombre'].'</option>';				
				}
			}

			$relatedNew = null ;
			$campos = '';
			switch ($newSelected['tipofuente_id']) {
				case '1':
					$font = 'tel';
					$css .= '
							<link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet">
						    <link rel="stylesheet" type="text/css" media="screen" href="http://tarruda.github.com/bootstrap-datetimepicker/assets/css/bootstrap-datetimepicker.min.css">    			
					';
					$relatedNew = $this->noticiasRepository->getNewById( $id, $font );
					if( is_array( $relatedNew ) ){
						ob_start();
						require $this->adminviews . 'editNewTV.php';
						$campos = ob_get_clean();
						$costo = $relatedNew['costo'];					
					}
					break;
				case '2':
					$font = 'rad';
					$css .= '
							<link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet">
						    <link rel="stylesheet" type="text/css" media="screen" href="http://tarruda.github.com/bootstrap-datetimepicker/assets/css/bootstrap-datetimepicker.min.css">    			
					';
					$relatedNew = $this->noticiasRepository->getNewById( $id, $font );
					if( is_array( $relatedNew ) ){
						ob_start();
						require $this->adminviews . 'editNewRD.php';
						$campos = ob_get_clean();
						$costo = $relatedNew['costo'];					
					}
					break;
				case '3':
					$ub1 = '';
					$ub2 = '';
					$ub3 = '';
					$ub4 = '';

					$font = 'per';
					$relatedNew = $this->noticiasRepository->getNewById( $id, $font );
					if( is_array( $relatedNew ) ){

						$tipoPaginacion = '';
						$tipos = $this->noticiasRepository->getTiposPagina();
						foreach ($tipos as $t) {
							if( $t['id_tipo_pagina'] == $relatedNew['id_tipo_pagina'] ){
								$tipoPaginacion .= '<option value="'.$t['id_tipo_pagina'].'" selected>'.$t['descripcion'].'</option>';							
							}else{
								$tipoPaginacion .= '<option value="'.$t['id_tipo_pagina'].'">'.$t['descripcion'].'</option>';							
							}
						}

						$ubicaciones = $this->noticiasRepository->getUbicacionByNoticiaId( $id );
						for ($i=1; $i <= 3; $i++) { 
							if( $ubicaciones[$i] == '1' ){
								$ub1 .= '
										<label class="checkbox-inline">
								            <input name="ubicacion' . $i . '" type="checkbox" checked >
								        </label>
								';
							}else{
								$ub1 .= '
										<label class="checkbox-inline">
								            <input name="ubicacion' . $i . '" type="checkbox" >
								        </label>
								';
							}
						}

						for ($i=4; $i <= 6; $i++) { 
							if( $ubicaciones[$i] == '1' ){
								$ub2 .= '
										<label class="checkbox-inline">
								            <input name="ubicacion' . $i . '" type="checkbox" checked >
								        </label>
								';
							}else{
								$ub2 .= '
										<label class="checkbox-inline">
								            <input name="ubicacion' . $i . '" type="checkbox" >
								        </label>
								';
							}
						}

						for ($i=7; $i <= 9; $i++) { 
							if( $ubicaciones[$i] == '1' ){
								$ub3 .= '
										<label class="checkbox-inline">
								            <input name="ubicacion' . $i . '" type="checkbox" checked >
								        </label>
								';
							}else{
								$ub3 .= '
										<label class="checkbox-inline">
								            <input name="ubicacion' . $i . '" type="checkbox" >
								        </label>
								';
							}
						}

						for ($i=10; $i <= 12; $i++) { 
							if( $ubicaciones[$i] == '1' ){
								$ub4 .= '
										<label class="checkbox-inline">
								            <input name="ubicacion' . $i . '" type="checkbox" checked >
								        </label>
								';
							}else{
								$ub4 .= '
										<label class="checkbox-inline">
								            <input name="ubicacion' . $i . '" type="checkbox" >
								        </label>
								';
							}
						}

						ob_start();
						require $this->adminviews . 'editNewPE.php';
						$campos = ob_get_clean();
						$costo = $relatedNew['costo'];					
					}
					break;
				case '4':
					$ub1 = '';
					$ub2 = '';
					$ub3 = '';
					$ub4 = '';

					$font = 'rev';
					$relatedNew = $this->noticiasRepository->getNewById( $id, $font );
					if( is_array( $relatedNew ) ){
						$tipoPaginacion = '';
						$tipos = $this->noticiasRepository->getTiposPagina();
						foreach ($tipos as $t) {
							if( $t['id_tipo_pagina'] == $relatedNew['id_tipo_pagina'] ){
								$tipoPaginacion .= '<option value="'.$t['id_tipo_pagina'].'" selected>'.$t['descripcion'].'</option>';							
							}else{
								$tipoPaginacion .= '<option value="'.$t['id_tipo_pagina'].'">'.$t['descripcion'].'</option>';							
							}
						}

						$ubicaciones = $this->noticiasRepository->getUbicacionByNoticiaId( $id );
						for ($i=1; $i <= 3; $i++) { 
							if( $ubicaciones[$i] == '1' ){
								$ub1 .= '
										<label class="checkbox-inline">
								            <input name="ubicacion' . $i . '" type="checkbox" checked >
								        </label>
								';
							}else{
								$ub1 .= '
										<label class="checkbox-inline">
								            <input name="ubicacion' . $i . '" type="checkbox" >
								        </label>
								';
							}
						}

						for ($i=4; $i <= 6; $i++) { 
							if( $ubicaciones[$i] == '1' ){
								$ub2 .= '
										<label class="checkbox-inline">
								            <input name="ubicacion' . $i . '" type="checkbox" checked >
								        </label>
								';
							}else{
								$ub2 .= '
										<label class="checkbox-inline">
								            <input name="ubicacion' . $i . '" type="checkbox" >
								        </label>
								';
							}
						}

						for ($i=7; $i <= 9; $i++) { 
							if( $ubicaciones[$i] == '1' ){
								$ub3 .= '
										<label class="checkbox-inline">
								            <input name="ubicacion' . $i . '" type="checkbox" checked >
								        </label>
								';
							}else{
								$ub3 .= '
										<label class="checkbox-inline">
								            <input name="ubicacion' . $i . '" type="checkbox" >
								        </label>
								';
							}
						}

						for ($i=10; $i <= 12; $i++) { 
							if( $ubicaciones[$i] == '1' ){
								$ub4 .= '
										<label class="checkbox-inline">
								            <input name="ubicacion' . $i . '" type="checkbox" checked >
								        </label>
								';
							}else{
								$ub4 .= '
										<label class="checkbox-inline">
								            <input name="ubicacion' . $i . '" type="checkbox" >
								        </label>
								';
							}
						}

						ob_start();
						require $this->adminviews . 'editNewRE.php';
						$campos = ob_get_clean();
						$costo = $relatedNew['costo'];					
					}
					break;
				case '5':
					$font = 'int';
					$css .= '
							<link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet">
						    <link rel="stylesheet" type="text/css" media="screen" href="http://tarruda.github.com/bootstrap-datetimepicker/assets/css/bootstrap-datetimepicker.min.css">    			
					';
					$relatedNew = $this->noticiasRepository->getNewById( $id, $font );
					if( is_array( $relatedNew ) ){
						ob_start();
						require $this->adminviews . 'editNewIN.php';
						$campos = ob_get_clean();
						$costo = $relatedNew['costo'];					
					}
					break;
			}

			// echo $newSelected['seccion_id']; exit();
			
			$this->header_admin('Editar noticias: ' . $newSelected['encabezado'] . ' - ', $css );
			require $this->adminviews . 'editNew.php';
			$this->footer_admin( $js );	
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}

	public function updateNew(){

		if( isset( $_SESSION['admin'] ) ){
			$updateNew = $_POST;
			// print_r($updateNew); exit();
			// Actualizando noticia general
			$mupdatenew = $this->noticiasRepository->updateNew( $updateNew );
			$updatenewson = false;
			if($mupdatenew){
				// Actualizando parte especifica de la noticia dependiendo el tipo de noticia 
				switch ($updateNew['tipofuente_id']) {
					case '1':
						$font = 'tel';
						$updatenewson = $this->noticiasRepository->updateNewRadTel( $updateNew, $font );
						break;

					case '2':
						$font = 'rad';
						$updatenewson = $this->noticiasRepository->updateNewRadTel( $updateNew, $font );
						break;

					case '3':
						$font = 'per';
						$ubicacion = [];
						for ($i=1; $i <= 12 ; $i++) { 
							if ( isset( $updateNew['ubicacion'. $i] ) ){
								$ub = 1;
								array_push($ubicacion, $ub);
							}else{

								$ub = 0;
								array_push($ubicacion, $ub);
							}
						}

						$updateNew['ubicacion'] = $ubicacion;
						$this->noticiasRepository->updateUbicacion( $updateNew['ubicacion'], $updateNew['noticia_id']);
						$updatenewson = $this->noticiasRepository->updateNewPerRev( $updateNew, $font );
						break;

					case '4':
						$font = 'rev';
						$ubicacion = [];
						for ($i=1; $i <= 12 ; $i++) { 
							if ( isset( $updateNew['ubicacion'. $i] ) ){
								$ub = 1;
								array_push($ubicacion, $ub);
							}else{

								$ub = 0;
								array_push($ubicacion, $ub);
							}
						}

						$updateNew['ubicacion'] = $ubicacion;
						$this->noticiasRepository->updateUbicacion( $updateNew['ubicacion'], $updateNew['noticia_id']);
						$updatenewson = $this->noticiasRepository->updateNewPerRev( $updateNew, $font );
						break;

					case '5':
						$font = 'int';
						$updatenewson = $this->noticiasRepository->updateNewInt( $updateNew, $font );
						break;
				}
				
			}

			if( $updatenewson ){

				header('Location: /panel/news');
			}else{
				echo 'Ocurrio un error';
			}
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }

	}

	protected function addNew( $campos, $fuente ){

		if( isset( $_SESSION['admin'] ) ){
			$fuentesRepository    = new FuentesRepository();
			$generoRepository     = new GeneroRepository();
			// $sectorRepository     = new SectorRepository();
			// $seccionRepository    = new SeccionRepository();
			$tipoFuenteRepository = new TipoFuenteRepository();
			$tipoAutorRepository  = new TipoAutorRepository();

			$genero		= '';
			$optionFont = '';
			//$sector		= '';
			// $seccion	= '';
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
			//$sectores  = $sectorRepository->allSectors( 1 );
			
			foreach ($fuentes as $f) {
				$optionFont .= '<option value="'.$f['id_fuente'].'">'.$f['nombre'].'</option>';
			}

			foreach ($autores as $a) {
				$tipoAutor .= '<option value="'.$a['id_tipo_autor'].'">'.$a['descripcion'].'</option>';
			}

			foreach ($generos as $g) {
				$genero .= '<option value="'.$g['id_genero'].'">'.$g['descripcion'].'</option>';
			}

			// foreach ($sectores as $s) {
			// 	$sector .= '<option value="'.$s['id_sector'].'">'.$s['nombre'].'</option>';
			// }

			$this->header_admin( 'Agregar Noticia de '.$fuente.' - ', $css );
			require $this->adminviews . 'addNew.php';
			$this->footer_admin( $js );
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }

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

	public function sendMailView( $id ){

		if( isset( $_SESSION['admin'] ) ){
			$new = $this->noticiasRepository->getNewById( $id );
			
			$this->header_admin( 'Enviar Noticia - ' );
			require $this->adminviews . 'sendView.php';
			$this->footer_admin();
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}

	public function filterClient() {
		$html = '';
		$resultado = new stdClass();

		$criterio = $_POST['criterio'];
		$noticia = ( isset( $_POST['noticiaid'] ) ) ? $_POST['noticiaid'] : 'block';

		$emr = new EmpresaRepository();
		$empresas = $emr->filterEmpresas( $criterio );
		if( is_array( $empresas ) ){
			foreach ( $empresas as $empresa ) {
				$html .= '	<tr>
				            	<td>'.$empresa['nombre'].'</td>
				              	<td><a href="/panel/new/send/' . $noticia . '/' . $empresa['id_empresa'] . '">Seleccionar</a></td>
				           	</tr>';
			}
			$resultado->html = $html;
			$resultado->exito = true;
		}
		else{
			$resultado->html = '<tr><td>no hay resultados con ese criterio</td></tr>';
			$resultado->exito = true;
		}

		header('Content-type: text/json');
		echo json_encode($resultado); 
	}

	public function searchContacts( $noticiaid, $empresaid ){
		
		if( isset( $_SESSION['admin'] ) ){
			$title = '';
			$sintesis = '';

			if( $noticiaid != 'block' ){
				$new = $this->noticiasRepository->getNewById( $noticiaid );			
				$title = $new['encabezado'];
				$sintesis = '<p>' . $new['sintesis'] . '</p>';

			}elseif( $noticiaid === 'block' && ( isset( $_SESSION['noticias'] ) && count( $_SESSION['noticias'] ) > 0 ) ){
				
				$noticias = $_SESSION['noticias'];
				
				$title = 'Enviar bloque de noticias.';
				$sintesis = '<div class="table-responsive">
			        <table class="table table-bordered table-inverse nomargin">
				        <thead>
				            <tr>
				              	<th class="text-center">Noticia</th>
				              	<th class="text-center">Tipo de Fuente</th>
				            </tr>
				        </thead>
			          	<tbody>';
				foreach ($noticias as $key => $noticia) {
					$sintesis .='<tr>
					            	<td>' . $noticia['encabezado'] . '</td>
					              	<td>' . $noticia['tipofuente'] . '</td>
					           	</tr>';
				}
			    $sintesis .= '</tbody>
			        </table>
		      </div>';
			}

			$cuentarep = new CuentaRepository();
				$acounts = $cuentarep->getAcountsByCompany( $empresaid );

				$html = '';

				if( is_array($acounts) ){
					foreach ( $acounts as $acount ) {
						$html .= '	<tr>
						            	<td class="text-center">
							                <label class="ckbox">
							                  <input type="checkbox" name="' . $acount['nombre'] . ' ' . $acount['apellidos'] . '" value="' . $acount['email'] . '" checked ><span></span>
							                </label>
							            </td>
						            	<td>' . $acount['nombre'] . ' ' . $acount['apellidos'] . '</td>
						              	<td>' . $acount['email'] . '</td>
						           	</tr>';
					}
				}

				$emr = new EmpresaRepository();
				$company = $emr->getEmpresaById( $empresaid );


			$this->header_admin( 'Enviar Noticia - ' );
			require $this->adminviews . 'sendActionView.php';
			$this->footer_admin();
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }

	}

	public function sendAction(){

		$temRep = new TemaRepository();
		$adjuntoRepo = new AdjuntoRepository();

		$usuarios = $_POST;
		$resultado = $usuarios;
		
		$noticiaid = array_shift($resultado);
		$empresaid = array_shift($resultado);
		
		$new = $this->noticiasRepository->getNewById( $noticiaid ); 	
		$adjunto = $adjuntoRepo->getAdjunto( $noticiaid );

		$tema  = $temRep->getThemaByEmpresaID( $empresaid );

		$temaid = null;
		if( is_array($tema) )
			$temaid = $tema['id_tema'];

		$tendenciaid = $new['tendencia_id'];

		$file = '';

		switch ($new['tipofuente_id']) {
			case '1':
				$font = 'tel';
				$relatedNew = $this->noticiasRepository->getNewById( $noticiaid, $font );
				$file = '<embed src="/assets/data/noticias/television/' . $adjunto['nombre_archivo'] . '" width="600" height="300" align="center" border="3"></embed>';
				break;
			case '2':
				$font = 'rad';
				$relatedNew = $this->noticiasRepository->getNewById( $noticiaid, $font );
				$file = '<embed src="/assets/data/noticias/radio/' . $adjunto['nombre_archivo'] . '" width="600" height="300" align="center" border="3"></embed>';
				break;
			case '3':
				$font = 'per';
				$relatedNew = $this->noticiasRepository->getNewById( $noticiaid, $font );
				$file = '<img src="/assets/data/noticias/periodico/' . $adjunto['nombre_archivo'] . '" width="600" alt="' . $new['encabezado'] . '" border="0" align="center" style="width: 100%; max-width: 600px;">';
				break;
			case '4':
				$font = 'rev';
				$relatedNew = $this->noticiasRepository->getNewById( $noticiaid, $font );
				$file = '<img src="/assets/data/noticias/revista/' . $adjunto['nombre_archivo'] . '" width="600" alt="' . $new['encabezado'] . '" border="0" align="center" style="width: 100%; max-width: 600px;">';
				break;
			case '5':
				$font = 'int';
				$relatedNew = $this->noticiasRepository->getNewById( $noticiaid, $font );
				//$file = '<embed src="/assets/data/noticias/internet/' . $adjunto['nombre_archivo'] . '" width="600" height="300" align="center" border="3"></embed>';
				$file = '<embed src="http://sistema.opemedios.com.mx/data/noticias/internet/' . $adjunto['nombre_archivo'] . '" width="600" height="300" align="center" border="3"></embed>';
				break;
		}

		ob_start();
		require $this->adminviews . 'viewsEmails/oneNewEmail2.php';
		$body = ob_get_clean();

		$mail = new Mail();
		$mail->setSubject('Noticia Operadora de medios - ' . strtoupper($new['tipofuente']));
		$mail->setBody( $body );
		// exit();
		$noenviados = [];

		foreach ($usuarios as $key => $email) {
			if( $key != 'noticiaid' ){
				if ($key != 'empresaid' ){
					$key = str_replace('_', ' ', $key);
					$exito = $mail->sendMail( $email, $key );
					if( !$exito ){
						$noenviado = [$key => $email ];
						array_push($noenviados, $noenviado);
					}					
				}
			}
		}
		if( count($noenviados) == 0 && $this->noticiasRepository->insertAsigna( compact('noticiaid', 'empresaid', 'temaid', 'tendenciaid') ) ){
			
			echo 'Se mando el correo correctamente';

		}else{
			echo 'No se puede mandar el correo a: <br>';
			echo '<pre>';
			print_r($noenviados);
		}
	}

	public function sendBlockNewsAction(){

		if( isset( $_SESSION['noticias'] ) && count( $_SESSION['noticias'] ) > 0 )
		{
			$noticias = $_SESSION['noticias'];

			$usuarios = $_POST;
			$resultado = $usuarios;

			$noticiaPrincipal =  current($noticias);
			
			$empresaid = array_shift($resultado);

			ob_start();
			require $this->adminviews . 'viewsEmails/blockNewsEmail3.php';
			$body = ob_get_clean();

			/*echo '<pre>'; print_r( $noticias ); print_r($_POST); exit();*/
			echo $body; exit(); 
			//echo '<pre>'; print_r($noticiaPrincipal); exit();

			$mail = new Mail();
			$mail->setSubject('Bloque de Noticias Operadora de medios');
			$mail->setBody( $body );
			// exit();
			$noenviados = [];

			foreach ($usuarios as $key => $email) {
				if( $key != 'empresaid' ){
					$key = str_replace('_', ' ', $key);
					$exito = $mail->sendMail( $email, $key );
					if( !$exito ){
						$noenviado = [$key => $email ];
						array_push($noenviados, $noenviado);
					}					
				}
			}
			if( count($noenviados) == 0 ){
				
				unset($_SESSION['noticias']);
				echo 'Se mando el correo correctamente';

			}else{
				echo 'No se puede mandar el correo a: <br>';
				echo '<pre>';
				print_r($noenviados);
			}
		}
	}

	public function advancedSearch(){

		if( isset( $_SESSION['admin'] ) ){
			$this->header_admin( 'Busqueda Avanzada - ' );
			require $this->adminviews . 'advancedSearchView.php';
			$this->footer_admin();
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}

	public function sendBlock(){

		if( isset( $_SESSION['admin'] ) ){
			$typeFont = '';
			$js = '';
			$css = '';

			$limit = isset( $_GET['numpp'] ) ? $_GET['numpp'] : 10;
			$page = isset( $_GET['page'] ) ? ( $_GET['page'] * $limit ) - $limit : 0;
			$titulo = isset( $_GET['titulo'] ) ? $_GET['titulo'] : null;
			$finicio = isset( $_GET['finicio'] ) ? $_GET['finicio'] : null;
			$ffin = isset( $_GET['ffin'] ) ? $_GET['ffin'] : null;
			$tipoFuente = isset( $_GET['tipoFuente'] ) ? $_GET['tipoFuente'] : null;

			$countWithoutFilter = $this->noticiasRepository->getCountNews();

			$countWithFilter = null;
			$resultados = null;

			if( $finicio === $ffin || ( $finicio != null && empty($ffin) ) ){
				
				$countWithFilter = $this->noticiasRepository->getCountNews( compact('limit', 'page', 'titulo', 'tipoFuente',  'finicio') );
				$resultados = $this->noticiasRepository->getNewsWithFilters( compact('limit', 'page', 'titulo', 'tipoFuente',  'finicio') );
			
			}else{

				$countWithFilter = $this->noticiasRepository->getCountNews( compact('limit', 'page', 'titulo', 'tipoFuente',  'finicio', 'ffin') );
				$resultados = $this->noticiasRepository->getNewsWithFilters( compact('limit', 'page', 'titulo', 'tipoFuente',  'finicio', 'ffin') );
			}

			$count = $countWithFilter;

			$ini = $page + 1;
			$end = ( $page + $limit >= $count ) ? $count : $page + $limit;

			$html = '';

			if( is_array($resultados) ){
				foreach ( $resultados as $noticia ) {
					$html .= '	<tr>
					            	<td class="text-center">
						                <label class="ckbox">
						                  <input type="checkbox" name="' . $noticia['id'] . '" value="' . $noticia['encabezado'] . '"><span></span>
						                </label>
						            </td>
					            	<td>' . $noticia['tipofuente'] . '</td>
					            	<td>' . $noticia['encabezado'] . '</td>
					              	<td>' . $noticia['fuente'] . '</td>
					              	<td>Enviado a</td>
					           	</tr>';
				}
			}

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

			$tipoFuenteRepository = new TipoFuenteRepository();

			$tiposFuente = $tipoFuenteRepository->all(); 

			foreach ($tiposFuente as $tf) {
				$typeFont .= '<option value="'.$tf['id_tipo_fuente'].'">'.$tf['descripcion'].'</option>';							
			}
			
			$this->header_admin( 'Enviar Bloque Noticia - ', $css );
			require $this->adminviews . 'sendBlockView.php';
			$this->footer_admin( $js );
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}

	public function sendBlockAction(){

		//echo '<pre>';print_r($_POST);

		if( isset( $_SESSION['admin'] ) ){
			$data = $_POST;
			$noticiasid = array_keys($data);

			$noticias = [];

			foreach ($noticiasid as $new) {
				
				$noticias[ $new ] = $this->noticiasRepository->getNewById( $new );

			}

			$_SESSION['noticias'] = $noticias;

			$this->header_admin( 'Enviar Bloque de Noticias - ' );
			require $this->adminviews . 'sendBlockAcountView.php';
			$this->footer_admin();
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }

		// ob_start();
		// require $this->adminviews . 'viewsEmails/blockNewsEmail.php';
		// $body = ob_get_clean();

		// echo $body;
		
		// echo '<pre>';print_r($noticias); die('Fin');

	}

}