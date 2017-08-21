<?php 

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

	function __construct()
	{
		$this->fuentesRepo = new FuentesRepository();
		$this->portadasRepo = new PortadasRepository();

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

			$covers = $this->getCovers($tipo_portada, 'portada', date('Y-m-d'));

			$this->header_admin( $titulo . ' - ', $this->css );
			require $this->adminviews . 'portadasView.php';
			$this->footer_admin( $this->js );
		}else{
      header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
    }

	}

	public function portadasFinancieras()
	{
		if( isset( $_SESSION['admin'] ) ){

			$titulo = 'Portadas Financieras';
			$action = '/panel/prensa/guardar-portada';
			$tipo_portada = TipoPortadas::PORTADAS_FINANCIERAS;

			$covers = $this->getCovers($tipo_portada, 'portada', date('Y-m-d'));

			$this->header_admin( $titulo . ' - ', $this->css );
				require $this->adminviews . 'portadasView.php';
			$this->footer_admin( $this->js );
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }

	}

	public function cartones()
	{
		if( isset( $_SESSION['admin'] ) ){

			$titulo = 'Cartones';
			$action = '/panel/prensa/guardar-portada';
			$tipo_portada = TipoPortadas::CARTONES;

			$covers = $this->getCovers($tipo_portada, 'portada', date('Y-m-d'));

			$this->header_admin( $titulo . ' - ', $this->css );
				require $this->adminviews . 'portadasView.php';
			$this->footer_admin( $this->js );
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }

	}

	public function columnasPoliticas()
	{
		if( isset( $_SESSION['admin'] ) ){

			$this->css .= '<link rel="stylesheet" href="/admin/lib/summernote/summernote.css">';
			$this->js .= '<script src="/admin/lib/summernote/summernote.js"></script>';

			$titulo = 'Columnas Politicas';
			$action = '/panel/prensa/guardar-columna';
			$tipo_columna = TipoColumnas::COLUMNAS_POLITICAS;

			$covers = $this->getCovers($tipo_columna, 'columna', date('Y-m-d'));
			
			$this->header_admin( $titulo . ' - ', $this->css );
				require $this->adminviews . 'columnasView.php';
			$this->footer_admin( $this->js );
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }

	}

	public function columnasFinancieras()
	{
		if( isset( $_SESSION['admin'] ) ){

			$this->css .= '<link rel="stylesheet" href="/admin/lib/summernote/summernote.css">';
			$this->js .= '<script src="/admin/lib/summernote/summernote.js"></script>';

			$titulo = 'Columnas Financieras';
			$action = '/panel/prensa/guardar-columna';
			$tipo_columna = TipoColumnas::COLUMNAS_FINANCIERAS;

			$covers = $this->getCovers($tipo_columna, 'columna', date('Y-m-d'));
			
			$this->header_admin( $titulo . ' - ', $this->css );
				require $this->adminviews . 'columnasView.php';
			$this->footer_admin( $this->js );
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
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
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
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
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
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
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
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
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
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
				$column['imagen'] = __APP__ . $column['imagen'];
				$column['thumb'] = __APP__ .  $column['thumb'];
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
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
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
				$column['imagen'] = __APP__ . '/' .$column['imagen'];
				$column['thumb'] = __APP__ . '/' .$column['thumb'];
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
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
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
				$cover['imagen'] = __APP__ . '/' .$cover['imagen'];
				$cover['thumb'] = __APP__ . '/' .$cover['thumb'];
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
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}

	public function createPDF ()
	{
		if (isset($_SESSION['admin'])) {
			$type = (int)$_POST['tipo_portada'];
			
			if (sizeof($_POST) > 1) {
				unset($_POST['tipo_portada']);
				$coverIds = array();
				foreach ($_POST as $key => $value) {
					array_push($coverIds, (int)explode('_', $key)[1]);
				}
			}
			

			vdd($_POST);
		} else {
      header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
    }	
	}
}