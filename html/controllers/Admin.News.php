<?php 

use utilities\Util;
// TODO: @Noticias Poner la url del archivo de media.
class AdminNews extends Controller{

	private $noticiasRepository;		
	private $adjuntoRepo;
	private $encabezadoRepo;		

	public function __construct(){
		$this->noticiasRepository = new NoticiasRepository();
		$this->adjuntoRepo = new AdjuntoRepository();
		$this->encabezadoRepo = new EncabezadoRepository();
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
		                        <td style="text-align: center;">
	                        		<i class="fa ' . Util::tipoFuente($noticia['id_tipo_fuente'] - 1)['icon'] . ' fa-3" style="font-size:40px; "></i>
	                        	</td>
		                        <td>
		                        	<span>' . $noticia['id'] . '</span>
		                        	<p>' . $noticia['encabezado'] . '</p>
		                        </td>
		                        <td>'.$noticia['nameFont'].'</td>
		                        <td>' .$enviado. '</td>
		                        <td>
									<a class = "p5" href="/panel/new/view/' . $noticia['id'] . '"><i class="fa fa-eye"></i></a>	
									<a class = "p5" href="/panel/new/edit/' . $noticia['id'] . '"><i class="fa fa-pencil"></i></a>	
									<a class = "p5" href="/panel/new/send/' . $noticia['id'] . '"><i class="fa fa-envelope-o"></i></a>	
									<a class = "p5" href=""><i class="fa fa-trash-o"></i></a>	
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

	public function viewNew ($id){

		if( isset( $_SESSION['admin'] ) ){
			$fr = new FuentesRepository();
			$newSelected = $this->noticiasRepository->getNewById($id);
			$relatedNew = null ;

			$adjuntos = $this->adjuntoRepo->getAdjunto( $id );
			$adjunto = $adjuntos[0];

			$htmlAdjunto = $this->getMedia($adjunto);

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
						$imageUbicacion = '<img src="'. Util::ubicationDetail( $relatedNew['ubicacion'] )['image'] .'" />'; 

						
						$htmlAdjunto .= '<ul class="adjunto-list">';
						foreach ($adjuntos as $adj) {
							$htmlAdjunto .= '<li class="adjunto-item"><a href="/panel/new/encabezado/periodico/'. $adj['id_adjunto'] .'">
									'.$this->getMedia($adj).'
								</a></li>';
						}
						$htmlAdjunto .= '</ul>';
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
						$imageUbicacion = '<img src="'. Util::ubicationDetail( $relatedNew['ubicacion'] )['image'] .'" />';

						$htmlAdjunto .= '<ul class="adjunto-list">';
						foreach ($adjuntos as $adj) {
							$htmlAdjunto .= '<li class="adjunto-item">
									'.$this->getMedia($adj).'
								</li>';
						}
						$htmlAdjunto .= '</ul>';
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

	public function addAttachment ($publicId)
	{
		$adjunto = $_FILES['adjunto'];
		vdd([$adjunto, $publicId]);
	}

	public function editNewView ($id) 
	{
		if( isset( $_SESSION['admin'] ) ){

			$fr   = new FuentesRepository();
			$gr   = new GeneroRepository();
			$sccr = new SeccionRepository();
			$tfr  = new TipoFuenteRepository();
			$tar  = new TipoAutorRepository();

			$css = '<link rel="stylesheet" href="/admin/lib/summernote/summernote.css">';
			$js = '<script src="/admin/lib/summernote/summernote.js"></script>';

			$optionFont = '';
			$genero		= '';
			$seccion	= '';
			$tipoAutor	= '';
			$tendencia  = '';
			$costo 		= '';

			$newSelected = $this->noticiasRepository->getNewById( $id );

			$fuentes   = $fr->showAllFonts( 0, 0, $newSelected['tipofuente_id'] );
			$autores   = $tar->allAuthors();
			$generos   = $gr->allGeneros();
			$seccion = $sccr->getSeccionById( $newSelected['seccion_id'] );

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

			$relatedNew = null ;
			$campos = '';
			switch ($newSelected['tipofuente_id']) {
				case '1':
					$font = 'tel';
					
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
					
					$relatedNew = $this->noticiasRepository->getNewById( $id, $font );
					if( is_array( $relatedNew ) ){
						ob_start();
						require $this->adminviews . 'editNewRD.php';
						$campos = ob_get_clean();
						$costo = $relatedNew['costo'];					
					}
					break;
				case '3':
					
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

						$ubicationSelected = Util::ubicationDetail( $relatedNew['ubicacion'] );
						$ubicationSelectedOption = '<option value="'. $ubicationSelected['id'] .'" selected >'. $ubicationSelected['label'] .'</option>';

						ob_start();
						require $this->adminviews . 'editNewPE.php';
						$campos = ob_get_clean();
						$costo = $relatedNew['costo'];					
					}
					break;
				case '4':
					
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

						$ubicationSelected = Util::ubicationDetail( $relatedNew['ubicacion'] );
						$ubicationSelectedOption = '<option value="'. $ubicationSelected['id'] .'" selected >'. $ubicationSelected['label'] .'</option>';

						ob_start();
						require $this->adminviews . 'editNewRE.php';
						$campos = ob_get_clean();
						$costo = $relatedNew['costo'];					
					}
					break;
				case '5':
					$font = 'int';
					
					$relatedNew = $this->noticiasRepository->getNewById( $id, $font );
					if( is_array( $relatedNew ) ){
						ob_start();
						require $this->adminviews . 'editNewIN.php';
						$campos = ob_get_clean();
						$costo = $relatedNew['costo'];					
					}
					break;
			}

			$this->header_admin('Editar noticias: ' . $newSelected['encabezado'] . ' - ', $css );
			require $this->adminviews . 'editNew.php';
			$this->footer_admin($js);	
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

						$updateNew['ubicacion'] = Util::ubicationNew( $updateNew['ubicacion'] );
						$updatenewson = $this->noticiasRepository->updateNewPerRev( $updateNew, $font );
						break;

					case '4':
						$font = 'rev';
						
						$updateNew['ubicacion'] = Util::ubicationNew( $updateNew['ubicacion'] );
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

	public function addFileView( $id )
	{
		if( isset( $_SESSION['admin'] ) )
		{
			$this->header_admin('Agregar nuevo archivo - ' );
			require $this->adminviews . 'addFileView.php';
			$this->footer_admin( );
		}
		else
		{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}

	public function addFileAction( $id )
	{
		if( isset( $_SESSION['admin'] ) )
		{
			$adjuntos = $this->adjuntoRepo->getAdjunto( $id );
			$encabezado = $this->encabezadoRepo->findByAdjuntoId( $adjuntos[0]['id_adjunto'] );
			$noticia = $this->noticiasRepository->getNewById( $id );

			if( $noticia['tipofuente'] === 'Revista' )
			{
				$url = 'assets/data/noticias/revista/';
			}
			else
			{
				$url = 'assets/data/noticias/periodico/';				
			}

			// si no existe un folder con el mes y el año se crea
			$createdAt = new DateTime();
			$folder = $createdAt->format('m-Y');
			$url .= $folder . '/';
			if( !is_dir( $url ) ){
				mkdir( $url, 0755, true);
			}

			$files = array();
			if( $_FILES['primario']['name'][0] != '' ){
				$files = array_map(function ($name, $type, $tmp_name, $error, $size) use ( $url, $encabezado ){
					return ['name' => $name, 'type' => $type, 'tmp_name' => $tmp_name, 'error' => $error, 'size' => $size, 'slug' => $url, 'principal' => '0', 'encabezado' => $encabezado, ];
				}, $_FILES['primario']['name'], $_FILES['primario']['type'], $_FILES['primario']['tmp_name'], $_FILES['primario']['error'], $_FILES['primario']['size']);
			}

			$adjuntoFile = array();
			foreach ($files as $file) {
				$adjuntoFile[] = $this->adjuntoRepo->add( $file, $id );
			}
			$error = 0;
			$fallidos = array();
			foreach ($adjuntoFile as $adj) {
				if(!$adj->exito){
					$error++;
					array_push($fallidos, $adj);
				}
			}

			if( $error === 0 && sizeof( $fallidos ) == 0 )
			{
				foreach ($adjuntoFile as $file) {
					foreach ($files as &$origin) {
						if( $origin['name'] == $file->originName && $origin['size'] == $file->size ){
							$origin['createdName'] = $file->name;
							if( $this->guardaArchivo( $origin, $url ) ){
								echo 'Archivo guardado en '. $url;
							}							
						}
					}
				}

				header('Location: /panel/new/view/'. $id);			
			}

			header('Location: /panel/new/view/'. $id);
		}
		else
		{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}

	protected function addNew( $campos, $fuente ){

		if( isset( $_SESSION['admin'] ) ){
			
			$css = '<link rel="stylesheet" href="/admin/lib/summernote/summernote.css">';
			$js = '<script src="/admin/lib/summernote/summernote.js"></script>';

			$fuentesRepository    = new FuentesRepository();
			$generoRepository     = new GeneroRepository();
			$tipoFuenteRepository = new TipoFuenteRepository();
			$tipoAutorRepository  = new TipoAutorRepository();
			$bloqueRepository = new BloqueRepository();
			$genero		= '';
			$optionFont = '';
			$tipoAutor	= '';

			$bloques = $bloqueRepository->all();
			$sbloques = ( $bloques->exito && !is_array($bloques->error) ) ? $bloques->rows : '<option value="">No hay bloques</option>';

			if($fuente === 'Television'){
	            $nomFuente = 'tele';
	       	}elseif($fuente === 'Periodico'){
	            $nomFuente = 'peri';
	        }else{
				$nomFuente = strtolower($fuente);        	
	        }

			$idFuente = $tipoFuenteRepository->findIdByName( $nomFuente );
			
			$fuentes   = $fuentesRepository->showAllFonts( 0, 0, $idFuente );
			$autores   = $tipoAutorRepository->allAuthors();
			$generos   = $generoRepository->allGeneros();
			
			foreach ($fuentes as $f) {
				$optionFont .= '<option value="'.$f['id_fuente'].'">'.$f['nombre'].'</option>';
			}

			foreach ($autores as $a) {
				$tipoAutor .= '<option value="'.$a['id_tipo_autor'].'">'.$a['descripcion'].'</option>';
			}

			foreach ($generos as $g) {
				$genero .= '<option value="'.$g['id_genero'].'">'.$g['descripcion'].'</option>';
			}

			$this->header_admin( 'Agregar Noticia de '.$fuente.' - ', $css );
			require $this->adminviews . 'addNew.php';
			$this->footer_admin($js);
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }

	}

	public static function guardaArchivo( $principal, $ruta ){

		// $extencionesPermitidas = ['pdf', 'jpg', 'jpeg', 'gif', 'png', 'JPG', 'JPEG', 'PNG', 'mp4', 'wma', 'wmv', 'mp3', 'avi', 'xlsx', 'csv'];
		$extencionesPermitidas = ['jpg', 'jpeg', 'gif', 'png', 'JPG', 'JPEG', 'PNG', 'mp4', 'mp3', 'csv', 'pdf', 'wma'];
		$explode = explode(".", $principal["name"]);
		$extension = end($explode);
		if ((($principal['type'] == 'image/png')
			|| ($principal['type'] == 'image/jpeg')
			|| ($principal['type'] == 'image/jpg')
			|| ($principal['type'] == 'image/PNG')
			|| ($principal['type'] == 'audio/mp3')
			|| ($principal['type'] == 'text/csv')
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
				$path=__DIR__ . '/../' . $ruta . $principal["createdName"];
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
							                  <input type="checkbox" name="' . $acount['nombre'] . ' ' . $acount['apellidos'] . '" value="' . $acount['email'] . '" ><span></span>
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
		
		$new = $this->mapNewForEmail($this->noticiasRepository->getNewById($noticiaid));
		
		$tema  = $temRep->getThemaByEmpresaID( $empresaid );
		$temaid = $tema[0]['id_tema'];

		$tendenciaid = $new['tendencia_id'];
		$relatedNew = $this->noticiasRepository->getNewById( $noticiaid, $font );

		ob_start();
		require $this->adminviews . 'viewsEmails/oneNewEmail.php';
		$body = ob_get_clean();
		// echo $body; exit;

		$mail = new Mail();
		$mail->setSubject('Noticia Operadora de medios - ' . utf8_decode(ucfirst(strtolower($new['tipofuente']))));
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
		$alert = new stdClass();
		if (count($noenviados) == 0 && $this->noticiasRepository->insertAsigna( compact('noticiaid', 'empresaid', 'temaid', 'tendenciaid'))) {
			$alert->exito = true;
			$alert->tipo = 'alert-info';
			$alert->mensaje = 'Se mando el correo correctamente';

		}else{
			$alert->exito = false;
			$alert->tipo = 'alert-warning';
			$alert->mensaje = 'No se puede mandar el correo a: ' . implode(', ', $noenviados);
		}
		$_SESSION['alerts']['sendMail'] = $alert;
		header( 'Location: /panel/news');		
	}

	public function advancedSearch(){

		if( isset( $_SESSION['admin'] ) ){
			$typeFont = '';
			$js = '';
			$css = '';

			$limit = (isset($_GET['numpp'])) ? $_GET['numpp'] : 10;
			$page = (isset($_GET['page'])) ? ( $_GET['page'] * $limit ) - $limit : 0;
			$titulo = (isset($_GET['titulo'])) ? $_GET['titulo'] : '';
			$finicio = (isset($_GET['finicio'])) ? $_GET['finicio'] : '';
			$ffin = (isset($_GET['ffin'])) ? $_GET['ffin'] : '';
			$tipoFuente = (isset($_GET['tipoFuente'])) ? intval($_GET['tipoFuente']) : '';
			
			$resultados = $this->noticiasRepository->getNewsWithFilters(compact('limit', 'page', 'titulo', 'finicio', 'ffin', 'tipoFuente'));

			$html = '';
			$count = $end = 0;
			$ini = $page + 1;
			if( $resultados->exito ){
				$count = $resultados->count;
				$end = ( $page + $limit >= $count ) ? $count : $page + $limit;
				foreach ( $resultados->rows as $noticia ) {
					$asigna = $this->noticiasRepository->asignaByIdNoticia( $noticia['id'] );
					$enviado = ( is_array( $asigna ) ) ? $asigna['empresa'] : 'No enviado';

					$html .= '	<tr>
					            	<td class="text-center"><i class="fa ' . Util::tipoFuente($noticia['tipofuente_id'] - 1)['icon'] . ' fa-3" style="font-size:40px; "></i></td>
					            	<td><a href="/panel/new/view/'.$noticia['id'].'">' . $noticia['encabezado'] . '</a></td>
					              	<td>' . $noticia['fuente'] . '</td>
					              	<td>' . $enviado . '</td>
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

			$this->header_admin( 'Busqueda Avanzada - ', $css );
			require $this->adminviews . 'advancedSearchView.php';
			$this->footer_admin( $js );
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}

	public function sendBlockAction(){

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

	}

	public function blockNewsView ()
	{
		if( isset( $_SESSION['admin'] ) ){
			
			$blockRep = new BloqueRepository();
			$empresaRep = new EmpresaRepository();
			$blocks = $blockRep->all();
			$companies = $empresaRep->all();

			$this->header_admin( 'Bloques de Noticias - ' );
			require $this->adminviews . 'blockNewsView.php';
			$this->footer_admin( );
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }		
	}

	public function detailBlockView( $id )
	{
		if( isset( $_SESSION['admin'] ) ){

			$limit = isset( $_GET['numpp'] ) ? $_GET['numpp'] : 10;
			$page = isset( $_GET['page'] ) ? ( $_GET['page'] * $limit ) - $limit : 0;
			$titulo = isset( $_GET['titulo'] ) ? $_GET['titulo'] : null;
			$tipoFuente = isset( $_GET['tipoFuente'] ) ? $_GET['tipoFuente'] : null;

			$countWithFilter = $this->noticiasRepository->getCountNews( compact('limit', 'page', 'titulo', 'tipoFuente' ) );
			$resultados = $this->noticiasRepository->getNewsWithFilters( compact('limit', 'page', 'titulo', 'tipoFuente') );
			$count = $countWithFilter;

			$ini = $page + 1;
			$end = ( $page + $limit >= $count ) ? $count : $page + $limit;

			$css = '
					<!-- Select2 CSS 
				    <link href="/assets/css/select2.min.css" rel="stylesheet"> -->
				    <!-- panel_paginator CSS -->
				    <link href="/admin/css/panel.main.css" rel="stylesheet">
				    <!-- data tables bootstrap CSS -->
				    <link href="/admin/css/dataTables.bootstrap.css" rel="stylesheet">
				   ';

			$js = '
					<!-- Select2 JavaScript 
				    <script src="/assets/js/select2.min.js"></script> 
				    <script src="/admin/js/bootstrap-datetimepicker.min.js"></script> -->
				    <!-- Libreria jquery-bootpag --> 
					<script src="/admin/js/vendors/bootstrap/jquery.bootpag.min.js"></script>
					<!-- Libreria purl --> 
					<script src="/admin/js/vendors/purl/purl.min.js"></script>
					<!-- Paginador con js --> 
					<script src="/assets/js/panel.paginador.js"></script>
					';

			
			$blockRep = new BloqueRepository();
			$themeRep = new TemaRepository();
			$empresaRep = new EmpresaRepository();
			$tfuenteRep = new TipoFuenteRepository();

			
			$tiposFuente = $tfuenteRep->all();			
			$block = $blockRep->getBlockById( $id );
			$thems = $themeRep->getThemaByEmpresaID( $block->rows['empresa_id'] );
			$news = $blockRep->getNewsOfBlock( $id );
			$themesId = array_column( $thems, 'id_tema');
			$contacts = $empresaRep->getContactsbyEmpresaId( $block->rows['empresa_id'] ); 
			
			if( $contacts->exito && is_array($contacts->rows) ){
				$emails = array_map(function( $contact ){
					return [
						'nombre' => $contact['nombre_cuenta'],
						'email'	 => $contact['correo']
					];
				}, $contacts->rows);

				$emails = array_values(array_unique($emails, SORT_REGULAR));				
			}elseif(!$contacts->exito && is_array($contacts->error)){
				$emails = '<div class="alert alert-warning">' . $contacts->error[2] . '</div>';
			}else{
				$emails = '<div class="alert alert-warning">No hay contactos para este tema y esta empresa.</div>';				
			}
			// vdd($emails);
			$companies = $empresaRep->all();

			$noticiasBloque = null;
			
			if( is_array($news->rows) ){
				foreach ($news->rows as $new) {
					if( in_array( $new['temaId'], $themesId ) ){
						$noticiasBloque[$new['tema']][] = $new;
					}
				}				
			}else{
				$noticiasBloque = $news->rows;
			}
			
			$this->header_admin( 'Bloque de Noticias - ', $css );
			require $this->adminviews . 'detailBlockView.php';
			$this->footer_admin( $js );
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }	
	}

	public function createBlock()
	{
		if( isset( $_SESSION['admin'] ) ){
			if( !empty( $_POST ) ){
				$blockRep = new BloqueRepository();				
				
				$result = new stdClass();
				$block = $blockRep->insertBlock( $_POST );
				if( $block->exito ){
					$result->exito = true;
					$result->tipo = 'alert-info';
					$result->mensaje = 'Se ha insertado satisfactoriamente el bloque';
				}else{
					$result->exito = false;
					$result->tipo = 'alert-danger';
					$result->mensaje = $block->error[2];
				}
				header('Content-type: text/json');
				echo json_encode($result);				
			}

		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}

	public function editBlock()
	{
		if( isset( $_SESSION['admin'] ) ){
			if( !empty( $_POST ) ){
				$blockRep = new BloqueRepository();				
				$result = new stdClass();
				
				$_POST['blockId'] = base64_decode( $_POST['blockId'] );
				$passBlock = $blockRep->getBlockById( $_POST['blockId'] ); 


				if( $passBlock->rows['name'] == $_POST['blockName'] && $passBlock->rows['empresa_id'] == $_POST['empresaId'] ){
					$result->exito = true;
					$result->tipo = 'alert-info';
					$result->mensaje = 'Se ha editado satisfactoriamente el bloque';

					header('Content-type: text/json');
					echo json_encode($result);
					exit;
				}
				
				$block = $blockRep->editBlock( $_POST );
				if( $block->exito ){
					$result->exito = true;
					$result->tipo = 'alert-info';
					$result->mensaje = 'Se ha editado satisfactoriamente el bloque';
				}else{
					$result->exito = false;
					$result->tipo = 'alert-danger';
					$result->mensaje = $block->error[2];
				}
				header('Content-type: text/json');
				echo json_encode($result);				
			}

		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }	
	}

	public function addNewBlock()
	{
		if( isset( $_SESSION['admin'] ) ){
			if( !empty( $_POST ) ){
				$blockRep = new BloqueRepository();				
				$result = new stdClass();
				$check = $blockRep->checkNewInBlock( $_POST['noticia'], $_POST['bloque'] ); 
				if($check->exito && $check->exist){
					$result->exito = true;
					$result->tipo = 'alert-success';
					$result->mensaje = 'La noticia ya existe en el bloque';
				}elseif( $check->exito && !$check->exist){
					if( $blockRep->insertNewToBlock( $_POST ) ){
						$result->exito = true;
						$result->tipo = 'alert-info';
						$result->mensaje = 'Agregando noticia al bloque';
					}else{
						$result->exito = false;
						$result->tipo = 'alert-danger';
						$result->mensaje = 'No se agrego la noticia';
					}	
				}				

				header('Content-type: text/json');
				echo json_encode($result);				
			}

		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}

	public function deleteNewBlock()
	{
		if( isset( $_SESSION['admin'] ) ){
			if( !empty( $_POST ) ){
				$blockRep = new BloqueRepository();				
				$result = new stdClass();
				$newid = base64_decode($_POST['bnid']);

				if( $blockRep->deleteNewBlock( $newid ) ){
					$result->exito = true;
					$result->tipo = 'alert-info';
					$result->mensaje = '<strong>Exito.</strong> Se ha eleminado la noticia';
				}else{
					$result->exito = false;
					$result->tipo = 'alert-danger';
					$result->mensaje = '<strong>No se ha podido eliminar el elemento!!!</strong>';
				}

				header('Content-type: text/json');
				echo json_encode($result);				
			}

		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}

	public function sendBlock()
	{
		if( isset( $_SESSION['admin'] ) ){
			if( !empty( $_POST ) ){
				$blockRepo = new BloqueRepository();
				$themeRep = new TemaRepository();
				$empresaRep = new EmpresaRepository();

				$blockId = base64_decode( $_POST['block'] );
				$block = $blockRepo->getBlockById( $blockId );
				$thems = $themeRep->getThemaByEmpresaID( $block->rows['empresa_id'] );
				$themesId = array_column( $thems, 'id_tema');
				$empresa = $empresaRep->getEmpresaById( $block->rows['empresa_id'] );
				
				$contacts = [];
				foreach ($_POST as $key => $contact) {
					if($key != 'block')
						array_push($contacts, ['name' => str_replace('_', ' ', $key), 'mail' => $contact]);
				}

				$news = $blockRepo->getNewsOfBlock( $blockId );
				$noticias = null;
			
				if( is_array($news->rows) ){
					$pre = $this->mapNewsForEmail($news->rows);
					foreach ($pre as $new) {
						if( in_array( $new['temaId'], $themesId ) ){
							$noticias[$new['tema']][] = $new;
						}
					}				
				}else{
					$noticias = $news->rows;
				}

				ob_start();
				require $this->adminviews . 'viewsEmails/blockNewsEmail3.php';
				$body = ob_get_clean();

				// echo $body; exit(); 
				
				$mail = new Mail();
				$mail->setSubject('Bloque de Noticias Operadora de medios');
				$mail->setBody( $body );
				
				$noenviados = [];

				foreach ($contacts as $key => $contact) {
					$exito = $mail->sendMail( $contact['mail'], $contact['name'] );
					if( !$exito ){
						$noenviado = [$contact['name'] => $contact['mail'] ];
						array_push($noenviados, $noenviado);
					}					
				}

				$result = new stdClass();

				if( count($noenviados) == 0 ){

					// $update = $blockRepo->updateBlockSend( $blockId );
					$result->exito = true;
					$result->tipo = 'alert-info';
					$result->mensaje = 'Se mando el correo correctamente';

				}else{
					$result->exito = false;
					$result->tipo = 'alert-warning';
					$result->mensaje = 'No se puede mandar el correo a: <br>';
					$result->no_enviados = $noenviados;
				}

				header('Content-type: text/json');
				echo json_encode($result);
			}

		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }	
	}

	public function testSendMail()
	{
		$qry2 = "SELECT * FROM noticia WHERE id_noticia <= 598970 ORDER BY id_noticia DESC LIMIT 30";
		$qry = "SELECT bn.id AS bnid, b.name, bn.noticia_id AS noticiaId, n.encabezado, n.sintesis, n.id_seccion, n.autor, n.id_tipo_fuente, n.id_tipo_autor, f.nombre AS fuente, f.id_fuente, bn.tema_id AS temaId, t.nombre AS tema FROM bloques_noticias bn INNER JOIN bloques b ON bn.bloque_id = b.id INNER JOIN noticia n ON bn.noticia_id = n.id_noticia INNER JOIN fuente f ON n.id_fuente = f.id_fuente INNER JOIN tema t ON bn.tema_id = t.id_tema WHERE bn.bloque_id = 3";
		$pre = $this->mapNewsForEmail($this->noticiasRepository->query($qry));
		$noticias = null;
		$themeRep = new TemaRepository();
		$blockRepo = new BloqueRepository();
		$block = $blockRepo->getBlockById( 3 );
		$thems = $themeRep->getThemaByEmpresaID( $block->rows['empresa_id'] );
		$themesId = array_column( $thems, 'id_tema');
		foreach ($pre as $new) {
			if( in_array( $new['temaId'], $themesId ) ){
				$noticias[$new['tema']][] = $new;
			}
		}				
		// echo '<pre>'; print_r($noticias); exit;
		
		ob_start();
		require $this->adminviews . 'viewsEmails/blockNewsEmail3.php';
		$body = ob_get_clean();

		echo $body; exit(); 
	}

	private function mapNewsForEmail ($data)
	{
		return array_map(function($row){
			$fuenteRepo = new FuentesRepository();
			$tipoFuenteRepo = new TipoFuenteRepository();
			$tipoAutorRepo = new TipoAutorRepository();	
			$seccionRepo = new SeccionRepository(); 		
			$tipoFuente = $tipoFuenteRepo->get($row['id_tipo_fuente']);		
			$tipoAutor = $tipoAutorRepo->get($row['id_tipo_autor']);
			$seccion = $seccionRepo->getSeccionById($row['id_seccion']);

			return [
				'id_new' => $row['noticiaId'],
				'title' => $row['encabezado'],
				'extract' => $row['sintesis'],
				'autor' => $row['autor'],
				'fuente' => $row['fuente'],
				'logo_font' => $fuenteRepo->getLogoById($row['id_fuente'])['logo'],
				'tipoFuente' => $tipoFuente['descripcion'],
				'tipoAutor' => $tipoAutor['descripcion'],
				'seccion' => $seccion['nombre'],
				'autor_seccion' => $seccion['autor'],
				'temaId' => $row['temaId'],
				'tema' => $row['tema'],
				'nombre_bloque' => $row['name']
			];
		}, $data);	
	}

	public function testOneMail($newId)
	{
		$new = $this->mapNewForEmail($this->noticiasRepository->getNewById($newId));

		ob_start();
		require $this->adminviews . 'viewsEmails/oneNewEmail.php';
		$body = ob_get_clean();

		echo $body;
	}

	private function mapNewForEmail($data)
	{
		setlocale(LC_TIME, 'es_ES');
		$date = new DateTime($data['fecha']);
		$fecha = ucfirst(strftime('%B %d, %G', $date->getTimestamp()));
		$urlOpemedios = "http://{$_SERVER['HTTP_HOST']}/noticia/".without_accents(strtolower($data['tipofuente']))."/{$data['id']}";
		$complement = $this->noticiasRepository->getComplement($data['id'], $data['tipofuente_id']);
		$costo = is_array($complement) ? $complement['costo'] : 0;
		$url = is_array($complement) ? (isset($complement['url']) ? $complement['url'] : '') : '';
		$adjunto = current($this->adjuntoRepo->getAdjunto($data['id']));
		$file = "/{$adjunto['carpeta']}{$adjunto['nombre_archivo']}";
		return [
			'tipoFuente' => $data['tipofuente'],
			'fecha' => $fecha,
			'titulo' => $data['encabezado'],
			'sintesis' => $data['sintesis'],
			'sintesisCorta' => cortarTexto($data['sintesis'], 50),
			'urlOpemedios' => $urlOpemedios,
			'cb' => $costo,
			'alcance' => $data['alcance'],
			'autor' => $data['autor'],
			'genero' => $data['genero'],
			'tendencia' => $data['tendencia'],
			'url' => $url,
			'fuente' => $data['fuente'],
			'path_archivo' => $file,
		];
	}
}