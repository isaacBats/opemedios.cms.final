<?php 

use utilities\PathFiles;

/**
* Controlador de Tarifario 
* @author Isaac Daniel < @codeisaac >
*/
class AdminTarifario extends Controller
{
	
	public function tarifariosAdmin()
	{
		if( isset( $_SESSION['admin'] ) ){			
			$this->header_admin( 'Administrador de Tarifarios - ' );
				require $this->adminviews . 'tarifarioAdminView.php';
			$this->footer_admin(  );
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}

	public function addTariff()
	{
		if( isset( $_SESSION['admin'] ) && !empty($_POST) ){
			
			$name = $_POST['nombre'];
			// $columns = [ explode( ',', $_POST['columnas'] ) ];
			
			$file = $_FILES['file'];
			$csv = array_map( 'str_getcsv', file($file['tmp_name']) );
			$columns = $csv[0];
			$secciones = array_column( $csv, 0);
			// $cabecera = array_shift( $secciones );
			// echo '<pre>'; print_r(['secciones' => $csv, ]); exit;
			$explode = explode(".", $file["name"]);
			$extension = strtolower( end($explode) );
			$file['createdName'] = str_replace( ' ', '_', $explode[0] ) . '_' . time() . '_'.$_SESSION['admin']['id_usuario'].'.' . $extension;
			$adminNews = new AdminNews();
			$pathFile = PathFiles::PATH_TARIFFS;
			// si no existe un folder con el mes y el año se crea
			$createdAt = new DateTime();
			$folder = $createdAt->format('m-Y');
			$pathFile .= $folder . '/';
			if( !is_dir( $pathFile ) ){
				mkdir( $pathFile, 0755, true);
			}			
			//save file excel
			$saveFile = $adminNews->guardaArchivo( $file, $pathFile );

			$tarifarioRepo = new TarifarioRepository();

			//insetn tariff
			$tarifarioSaved = $tarifarioRepo->addTariff( $name, serialize( $columns ), $pathFile . $file['createdName']);
			
			$result = new stdClass();
			// echo '<pre>'; print_r($csv); echo '</pre>'; exit;
			if( $tarifarioSaved->exito ){
				$tariff = $tarifarioSaved->row;
				$tariffSecciones = array();
				
				foreach ($secciones as $seccion) {
					$nuevo = $tarifarioRepo->addSections( $tarifarioSaved->lastID, $seccion); 
					array_push($tariffSecciones, $nuevo);
				}

				$valuesSections = array();
				foreach ($csv as $row) {
					foreach ($tariffSecciones as $values) {
						$valor = $tarifarioRepo->addValues( $values->lastID, serialize( $row ) );
						array_push( $valuesSections, $valor);
					}
				}
				$result->mensaje = 'Se ha agregado el tarifario correctamente';
				$result->tipo = 'alert-info';
				$result->tarifario = $tarifarioSaved;
				$result->secciones = $tariffSecciones;
				$result->values = $valuesSections;
				// echo '<pre>'; var_dump($csv); echo '</pre>'; exit;
				// $rs->mensaje = 'Se ha agregado el tarifario correctamente';
				
			}else{
				$result->mensaje = 'No se agrego el tarifario';
				$result->tipo = 'alert-danger';
			}
			
			$_SESSION['alerts']['tarifario'] = $result;
			header( 'Location: ' . $_SERVER['HTTP_REFERER'] );

			
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}
}