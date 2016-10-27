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

	private function readFile( $file )
	{
		if( is_array( $file ) ){

		}else{
			$f = fopen( $file, 'r' );
			$f = utf8_encode(file_get_contents($f));
			$data = str_getcsv( $f , '\n' );

		}
	} 

	public function addTariff()
	{
		if( isset( $_SESSION['admin'] ) && !empty($_POST) ){
			
			$name = $_POST['nombre'];
			$columns = [ explode( ',', $_POST['columnas'] ) ];
			
			$file = $_FILES['file'];
			$explode = explode(".", $file["name"]);
			$extension = end($explode);
			$file['createdName'] = $explode[0] . '_' . time() . '.' . $extension;
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
			
			if( $tarifarioSaved->exito ){
				$tariff = $tarifarioSaved->row;

				// if( $open = fopen( $tariff['path_file'], 'r') != FALSE ){
				// 	$excel = fgetcsv($open, 1000, ','); 
				// }

				// print_r('Tu excel es: '.$excel); exit;

				// fclose($excel);
			}

			// echo '<pre>'; var_dump($); echo '</pre>'; exit;
			
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}
}