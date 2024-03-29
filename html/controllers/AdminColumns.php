<?php 
date_default_timezone_set('America/Mexico_City');

use utilities\Image;
use utilities\TipoPortadas;
use utilities\TipoColumnas;
use utilities\Util;

/**
* Controlador para las columnas financieras, primeras planas, columnas politicas y demas 
* @author Isaac Daniel < @codeisaac >
*/
class AdminColumns extends Controller
{
	
	private $css;
	private $getFuentes;
	private $fuentes;
	private $fuentesRepo;
	private $js;
	private $portadasRepo;
	private $filesPdfRepo;

	function __construct()
	{
		$this->fuentesRepo = new FuentesRepository();
		$this->portadasRepo = new PortadasRepository();
		$this->filesPdfRepo = new FilesPdfRepo();

		$this->css = '';
		$this->js = '
				<script src="/admin/lib/jquery-form/jquery.form.min.js"></script>
			  ';
		$this->getFuentes = $this->fuentesRepo->getFontsByTipeFont([3,]);
			
		$this->fuentes = ( $this->getFuentes->exito ) ? $this->getFuentes->rows : $this->getFuentes->error[2];

	}

	public function primerasPlanas()
	{
		if( isset( $_SESSION['admin'] ) ){
			$titulo = 'Primeras Planas';
			$action = '/panel/prensa/guardar-portada';
			$tipo_portada = TipoPortadas::PRIMERAS_PLANAS;
			$type = Util::tipoPortada($tipo_portada);
			$pdf = $this->filesPdfRepo->getToday($type);

			$covers = $this->getCovers($tipo_portada, 'portada', date('Y-m-d'));

			$this->header_admin( $titulo . ' - ', $this->css );
			require $this->adminviews . 'portadasView.php';
			$this->footer_admin( $this->js );
		}else{
      header( "Location: https://{$_SERVER["HTTP_HOST"]}/panel/login");
    }

	}

	public function portadasFinancieras()
	{
		if( isset( $_SESSION['admin'] ) ){

			$titulo = 'Portadas Financieras';
			$action = '/panel/prensa/guardar-portada';
			$tipo_portada = TipoPortadas::PORTADAS_FINANCIERAS;
			$type = Util::tipoPortada($tipo_portada);
			$pdf = $this->filesPdfRepo->getToday($type);
			
			$covers = $this->getCovers($tipo_portada, 'portada', date('Y-m-d'));

			$this->header_admin( $titulo . ' - ', $this->css );
				require $this->adminviews . 'portadasView.php';
			$this->footer_admin( $this->js );
		}else{
            header( "Location: https://{$_SERVER["HTTP_HOST"]}/panel/login");
        }

	}

	public function cartones()
	{
		if( isset( $_SESSION['admin'] ) ){

			$titulo = 'Cartones';
			$action = '/panel/prensa/guardar-portada';
			$tipo_portada = TipoPortadas::CARTONES;
			$type = Util::tipoPortada($tipo_portada);
			$pdf = $this->filesPdfRepo->getToday($type);

			$covers = $this->getCovers($tipo_portada, 'portada', date('Y-m-d'));

			$this->header_admin( $titulo . ' - ', $this->css );
				require $this->adminviews . 'portadasView.php';
			$this->footer_admin( $this->js );
		}else{
            header( "Location: https://{$_SERVER["HTTP_HOST"]}/panel/login");
        }

	}

	public function columnasPoliticas()
	{
		if( isset( $_SESSION['admin'] ) ){
			$titulo = 'Columnas Politicas';
			$action = '/panel/prensa/guardar-columna';
			$tipo_columna = TipoColumnas::COLUMNAS_POLITICAS;
			$type = Util::tipoColumna($tipo_columna);
			$pdf = $this->filesPdfRepo->getToday($type);

			$covers = $this->getCovers($tipo_columna, 'columna', date('Y-m-d'));
			
			$this->header_admin( $titulo . ' - ', $this->css );
				require $this->adminviews . 'columnasView.php';
			$this->footer_admin( $this->js );
		}else{
            header( "Location: https://{$_SERVER["HTTP_HOST"]}/panel/login");
        }

	}

	public function columnasFinancieras()
	{
		if( isset( $_SESSION['admin'] ) ){
			$titulo = 'Columnas Financieras';
			$action = '/panel/prensa/guardar-columna';
			$tipo_columna = TipoColumnas::COLUMNAS_FINANCIERAS;
			$type = Util::tipoColumna($tipo_columna);
			$pdf = $this->filesPdfRepo->getToday($type);

			$covers = $this->getCovers($tipo_columna, 'columna', date('Y-m-d'));
			
			$this->header_admin( $titulo . ' - ', $this->css );
				require $this->adminviews . 'columnasView.php';
			$this->footer_admin( $this->js );
		}else{
            header( "Location: https://{$_SERVER["HTTP_HOST"]}/panel/login");
        }

	}

	public function getCovers ($tipo, $article, $date)
	{
		
		if ($article == 'portada')
			$getcovers = $this->portadasRepo->getCovers ($date, Util::tipoPortada($tipo));
		elseif ($article == 'columna')
			$getcovers = $this->portadasRepo->getCoversColumnas ($date, Util::tipoColumna($tipo));

		$covers = array();

		if ($getcovers->exito && is_array($getcovers->rows)) {
			foreach ($getcovers->rows as &$cover) {
				$font = $this->fuentesRepo->getFontById( $cover['fuente_id'] );
				if (is_array ($font)) {
					$cover['nombre_fuente'] = $font['nombre']; 
				}
				$createdAt = new DateTime( $cover['created_at'] );
				$cover['created_at'] = $createdAt->format('Y-m-d');
			}
			$covers = $getcovers->rows;
		}

		return $covers;
	}

	public function guardarPortada()
	{
		if( isset( $_SESSION['admin'] ) ){
			$path = $this->getPath( 'portadas', $_POST['tipo_portada'] );
			$nameImages = $this->saveImages($_FILES['file'], $path);
			$saveRow = $this->portadasRepo->create([
				'fuente' => $_POST['fuente'], 
				'imagen' => $nameImages['originName'], 
				'thumb' => $nameImages['thumbName'], 
				'tipo_portada' => $_POST['tipo_portada']
				]);

			$_SESSION['alerts']['portada'] = $saveRow;
			header( 'Location: ' . $_SERVER['HTTP_REFERER'] );
		}else{
            header( "Location: https://{$_SERVER["HTTP_HOST"]}/panel/login");
        }		
	}

	public function guardarColumna()
	{
		if( isset( $_SESSION['admin'] ) ){
			$path = $this->getPath( 'columnas', $_POST['tipo_columna'] );
			// echo '<pre>'; print_r(['path' => $path, 'post' => $_POST, 'files' => $_FILES]); exit;
			$nameImages = $this->saveImages($_FILES['file'], $path);
			$saveRow = $this->portadasRepo->saveColumna([
				'fuente' => $_POST['fuente'], 
				'imagen' => $nameImages['originName'], 
				'thumb' => $nameImages['thumbName'], 
				'tipo_columna' => $_POST['tipo_columna'],
				'titulo' => $_POST['title'],
				'autor' => $_POST['author'],
				'contenido' => $_POST['contenido'],
				]);

			$_SESSION['alerts']['columnas'] = $saveRow;
			header( 'Location: ' . $_SERVER['HTTP_REFERER'] );
		}else{
            header( "Location: https://{$_SERVER["HTTP_HOST"]}/panel/login");
        }		
	}

	private function getPath ( $tipo, $subtipo )
	{
		$path = 'assets/data/'.$tipo.'/';

		if( $tipo == 'portadas' ){
			if( $subtipo == TipoPortadas::PRIMERAS_PLANAS ){

				$path .= 'primeras_planas/';

			}elseif( $subtipo == TipoPortadas::PORTADAS_FINANCIERAS ){

				$path .= 'portadas_financieras/';

			}elseif( $subtipo == TipoPortadas::CARTONES ){

				$path .= 'cartones/';

			}
		}elseif( $tipo == 'columnas' ){
			if( $subtipo == TipoColumnas::COLUMNAS_POLITICAS ){

				$path .= 'columnas_politicas/';

			}elseif( $subtipo == TipoColumnas::COLUMNAS_FINANCIERAS ){

				$path .= 'columnas_financieras/';
			}
		}
		
		$time = new DateTime();

		$folderMes = $time->format('m-Y');
		$folderDia = $time->format('d-m-Y');

		$path .= $folderMes.'/'.$folderDia.'/';

		if( !is_dir( $path ) ){
			mkdir( $path, 0755, true);
		}

		return $path;

	}

	public function saveImages( $file, $path )
	{
		$im = new Image();

		$explode = explode('.', $file['name']);
		$name = $this->url_slug($explode[0]).'_'.uniqid();
		$file['createdName'] = $name.'.'.end($explode);
		
		$im->CreateThumb( $file['tmp_name'], $path, $name, 360, 480);
		$im->saveFile( $file, $path, $file['type'] );

		return [
			'originName' => $path.$file['createdName'],
			'thumbName'  => $path.$name.'_thumb.png',
		];
	}

	public function editColumn ($typeColumn, $id)
	{
		if( isset( $_SESSION['admin'] ) ){
			$this->css .= '<link rel="stylesheet" href="/admin/lib/summernote/summernote.css">';
			$this->js .= '<script src="/admin/lib/summernote/summernote.js"></script>';
			
			$column = $this->portadasRepo->getColumna($id);
			$titulo = ucfirst(str_replace('-', ' ', $typeColumn));			

			$this->header_admin( $titulo . ' - ', $this->css );
			require $this->adminviews . 'editColumnView.php';
			$this->footer_admin( $this->js );
		}else{
            header( "Location: https://{$_SERVER["HTTP_HOST"]}/panel/login");
        }				
	}

	public function showColumn($typeColumn, $id)
	{
		if( isset( $_SESSION['admin'] ) ){
			
			$column = $this->portadasRepo->getColumna($id);
			$titulo = ucfirst(str_replace('-', ' ', $typeColumn));
			$fuente = $this->fuentesRepo->getFontById($column['fuente_id']);

			$this->header_admin( $titulo . ' - ', $this->css );
			require $this->adminviews . 'columnView.php';
			$this->footer_admin( $this->js );
		}else{
            header( "Location: https://{$_SERVER["HTTP_HOST"]}/panel/login");
        }	
	}

	public function updateColumn ($typeColumn, $id)
	{
		if( isset( $_SESSION['admin'] ) ){
			
			$column = $this->portadasRepo->getColumna($id);
			$tipoColumna = ($typeColumn === 'columnas-politicas') 
						 ? TipoColumnas::COLUMNAS_POLITICAS 
						 : TipoColumnas::COLUMNAS_FINANCIERAS;
			$data = [
						'fuente_id' => $_POST['fuente_id'],
						'tipo_columna' => $column['tipo_columna'],
						'titulo' => $_POST['title'],
						'autor' => $_POST['author'],
						'contenido' => $_POST['contenido']
					];
			if (!empty($_FILES['imagen']['name']) && $_FILES['imagen']['error'] == 0) {
				$path = $this->getPath( 'columnas', $tipoColumna );
				$newsImages = $this->saveImages($_FILES['imagen'], $path);
				$data['imagen'] = $newsImages['originName'];
				$data['thumb'] = $newsImages['thumbName'];
				$im = new Image();
				$column['imagen'] = $column['imagen'];
				$column['thumb'] = $column['thumb'];
				$imagesDelete = $im->deleteImage([$column['imagen'], $column['thumb']]);
			} else {
				$data['imagen'] = $column['imagen'];
				$data['thumb'] = $column['thumb'];
			}

			$data['id'] = $id;

			$result = new stdClass();
			$updateColumn = $this->portadasRepo->editColumna($data);
			$rs = new stdClass();
			if ($updateColumn->exito) {
				$rs->tipo = 'alert-info';
				$rs->mensaje = 'Se ha actualizado al columna con <strong>exito</strong>';
			} else {
				$rs->tipo = 'alert-warning';
				$rs->mensaje = 'Hubo error al actualizar la columna';
			}

			$_SESSION['alerts']['columnas'] = $rs;
			header( 'Location: /panel/prensa/show/' . $typeColumn . '/' . $id);

		}else{
            header( "Location: https://{$_SERVER["HTTP_HOST"]}/panel/login");
        }

	}

	public function deleteColumn ($id) 
	{
		if( isset( $_SESSION['admin'] ) ){
			$column = $this->portadasRepo->getColumna($id);
			$rs = new stdClass();

			$deleteColumn = $this->portadasRepo->deleteColumna($id);
			if ($deleteColumn->exito) {
				$im = new Image();
				$column['imagen'] = $column['imagen'];
				$column['thumb'] = $column['thumb'];
				$imagesDelete = $im->deleteImage([$column['imagen'], $column['thumb']]);
				$rs->exito = true;
				$rs->tipo = 'alert-info';
				$rs->mensaje ='Se a eliminado la columna exitosamente!!!';
			} else {
				$rs->exito = false;
				$rs->tipo = 'alert-warning';
				$rs->mensaje ='No se pudo eliminar la columna';
				$rs->error[2] = $deleteColumn->error;
			}
			$typeColumn = ($column['tipo_columna'] == 'COLUMNA_FINANCIERA') ? 'columnas-financieras' : 'columnas-politicas';
			$rs->url = '/panel/prensa/' . $typeColumn;
			
			header('Content-type: text/json');
			echo json_encode($rs); 

		}else{
            header( "Location: https://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}

	public function deleteCover ($id) 
	{
		if( isset( $_SESSION['admin'] ) ){
			$cover = $this->portadasRepo->getPortada($id);
			$rs = new stdClass();

			$deleteCover = $this->portadasRepo->deletePortada($id);
			if ($deleteCover->exito) {
				$im = new Image();
				$cover['imagen'] = $cover['imagen'];
				$cover['thumb'] = $cover['thumb'];
				$imagesDelete = $im->deleteImage([$cover['imagen'], $cover['thumb']]);
				$rs->exito = true;
				$rs->tipo = 'alert-info';
				$rs->mensaje ='Se a eliminado la portada exitosamente!!!';
			} else {
				$rs->exito = false;
				$rs->tipo = 'alert-warning';
				$rs->mensaje ='No se pudo eliminar la portada';
				$rs->error[2] = $deleteCover->error;
			}
			$typeCover = ($cover['tipo_portada'] == 'PRIMERAS_PLANAS') ? 'primeras-planas' : ($cover['tipo_portada'] == 'PORTADA_FINANCIERA') ? 'portadas-financieras' : 'cartones';
			$rs->url = '/panel/prensa/' . $typeCover;
			
			header('Content-type: text/json');
			echo json_encode($rs); 

		}else{
            header( "Location: https://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}

	public function createPDF ()
	{
		if (isset($_SESSION['admin'])) {
			$type = Util::tipoPortada((int)$_POST['tipo_portada']);
			
			if (sizeof($_POST) > 1) {
				unset($_POST['tipo_portada']);
				$coverIds = array();
				foreach ($_POST as $key => $value) {
					array_push($coverIds, (int)explode('_', $key)[1]);
				}
				$covers = $this->portadasRepo->getCovers(null, $type, $coverIds);
			} else {
				$covers = $this->portadasRepo->getCovers(date('Y-m-d'), $type);
			}

			$itemsPiority =  $this->fuentesRepo->getOrderPriority($type);

			$filterCovers = [];
			foreach ($covers->rows as $key => $cover) {
			  if (in_array($cover['fuente_id'], $itemsPiority)) {
			    //echo "se encontro: " . $cover['id'] . "\t" .  "en la posicion: " . $key . "\r";
			    array_push($filterCovers, $cover);
			    unset($covers->rows[$key]);
			  }
			}
			$mergeCovers = [];
			  //ordenar los de prioridad
			foreach($itemsPiority as $clave => $id){
				foreach($filterCovers as $key => $item) {
					if ($item['fuente_id'] == $id) {
						array_push($mergeCovers, $item);
						array_splice($filterCovers, $key, 1);
					}
				}
			}
			//agregar los restantes
			foreach($covers->rows as $key => $cover) {
				array_push($mergeCovers, $cover);
			}
			$covers->rows = $mergeCovers;
			ob_start();
			require $this->views . 'media/covers_pdf.php';
			$body = ob_get_clean();
			
			$path = $covers->rows[0]['imagen'];
			$explode = explode('/', $path);
			$fileName = "{$type}_Diarias_" . date('Ymd'). ".pdf";
			$explode[sizeof($explode) -1] = $fileName;
			$pathName = implode('/',$explode);
			
			$this->generarPdfFromHtml($body, $pathName);
			$file = $this->filesPdfRepo->create(['name' => $fileName, 'path_image' => $pathName, 'type' => $type]);
			if(is_array($file)) {
				return json_response(['exito' => true]);
			} else {
				return json_response(['exito' => false, 'error' => $file]);
			}

		} else {
      header( "Location: https://{$_SERVER["HTTP_HOST"]}/panel/login");
    }	
	}

	public function createPDFColumns ()
	{
		if (isset($_SESSION['admin'])) {
			$type = Util::tipoColumna((int)$_POST['tipo_columna']);
			
			if (sizeof($_POST) > 1) {
				unset($_POST['tipo_columna']);
				$coverIds = array();
				foreach ($_POST as $key => $value) {
					array_push($coverIds, (int)explode('_', $key)[1]);
				}
				$covers = $this->portadasRepo->getCoversColumnas(null, $type, $coverIds);
			} else {
				$covers = $this->portadasRepo->getCoversColumnas(date('Y-m-d'), $type);
			}

			// vdd([$typw,$covers]);
			ob_start();
			require $this->views . 'media/covers_pdf_columns.php';
			$body = ob_get_clean();
			
			$path = $covers->rows[0]['imagen'];
			$explode = explode('/', $path);
			$fileName = "{$type}_Diarias_" . date('Ymd'). ".pdf";
			$explode[sizeof($explode) -1] = $fileName;
			$pathName = implode('/',$explode);
			
			$this->generarPdfFromHtml($body, $pathName);
			$file = $this->filesPdfRepo->create(['name' => $fileName, 'path_image' => $pathName, 'type' => $type]);
			if(is_array($file)) {
				return json_response(['exito' => true]);
			} else {
				return json_response(['exito' => false, 'error' => $file]);
			}

		} else {
      header( "Location: https://{$_SERVER["HTTP_HOST"]}/panel/login");
    }	
	}
}