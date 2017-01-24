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

			$planas = $this->portadasRepo->getCovers( date( 'Y-m-d' ), Util::tipoPortada( $tipo_portada ) );
			
			if( $planas->exito && is_array( $planas->rows ) ){
				foreach ($planas->rows as &$cover) {
					$font = $this->fuentesRepo->getFontById( $cover['fuente_id'] );
					if( is_array ( $font ) ){
						$cover['nombre_fuente'] = $font['nombre']; 
					}
					$createdAt = new DateTime( $cover['created_at'] );
					$cover['created_at'] = $createdAt->format('Y-m-d');
				}
				$covers = $planas->rows;
			}

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

			$planas = $this->portadasRepo->getCovers( date( 'Y-m-d' ), Util::tipoPortada( $tipo_portada ) );
			
			if( $planas->exito && is_array( $planas->rows ) ){
				foreach ($planas->rows as &$cover) {
					$font = $this->fuentesRepo->getFontById( $cover['fuente_id'] );
					if( is_array ( $font ) ){
						$cover['nombre_fuente'] = $font['nombre']; 
					}
					$createdAt = new DateTime( $cover['created_at'] );
					$cover['created_at'] = $createdAt->format('Y-m-d');
				}
				$covers = $planas->rows;
			}

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

			$planas = $this->portadasRepo->getCovers( date( 'Y-m-d' ), Util::tipoPortada( $tipo_portada ) );
			
			if( $planas->exito && is_array( $planas->rows ) ){
				foreach ($planas->rows as &$cover) {
					$font = $this->fuentesRepo->getFontById( $cover['fuente_id'] );
					if( is_array ( $font ) ){
						$cover['nombre_fuente'] = $font['nombre']; 
					}
					$createdAt = new DateTime( $cover['created_at'] );
					$cover['created_at'] = $createdAt->format('Y-m-d');
				}
				$covers = $planas->rows;
			}

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

			$this->header_admin( $titulo . ' - ', $this->css );
				require $this->adminviews . 'columnasView.php';
			$this->footer_admin( $this->js );
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }

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
			echo '<pre>'; print_r(['path' => $path, 'post' => $_POST, 'files' => $_FILES]); exit;
			// $nameImages = $this->saveImages($_FILES['file'], $path);
			// $saveRow = $this->portadasRepo->create([
			// 	'fuente' => $_POST['fuente'], 
			// 	'imagen' => $nameImages['originName'], 
			// 	'thumb' => $nameImages['thumbName'], 
			// 	'tipo_portada' => $_POST['tipo_portada']
			// 	]);

			// $_SESSION['alerts']['columnas'] = $saveRow;
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
		$name = $explode[0].'_'.uniqid();
		$file['createdName'] = $name.'.'.end($explode);
		
		$im->CreateThumb( $file['tmp_name'], $path, $name, 360, 480);
		$im->saveFile( $file, $path, $file['type'] );

		return [
			'originName' => $path.$file['createdName'],
			'thumbName'  => $path.$name.'_thumb.png',
		];
	}
}