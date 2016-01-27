<?php

require_once(__DIR__.'/../admin/ForceUTF8/Encoding.php');
use ForceUTF8\Encoding; 


class AdminContacto extends Controller{

	public function exportContacts(){
		
		
		$sql = "SELECT * FROM contactos";
		$query = $this->pdo->prepare($sql);
		$rs = $query->execute();
		if($rs!==false){
			$nr = $query->rowCount();
			if( $nr > 0 ){
				
				$header = "NOMBRE\tEMAIL\tEMPRESA\tPUESTO\tPAIS\tESTADO\tCODIGO POSTAL\tTELEFONO\tCOMO SE ENTERO\tFECHA\t";
				$line = '';
				
				$rows = $query->fetchAll();
				foreach ($rows as $row) {
					$nombre = str_replace('"', '""', $row['nombre']);
				    $nombre = '"' . $nombre . '"' . "\t";

				    $email = str_replace('"', '""', $row['email']);
				    $email = '"' . $email . '"' . "\t";

				    $empresa = str_replace('"', '""', $row['empresa']);
				    $empresa = '"' . $empresa . '"' . "\t";

				    $puesto = str_replace('"', '""', $row['puesto']);
				    $puesto = '"' . $puesto . '"' . "\t";

				    $pais = str_replace('"', '""', $row['pais']);
				    $pais = '"' . $pais . '"' . "\t";

				    $estado = str_replace('"', '""', $row['estado']);
				    $estado = '"' . $estado . '"' . "\t";

				    $codigopostal = str_replace('"', '""', $row['codigopostal']);
				    $codigopostal = '"' . $codigopostal . '"' . "\t";

				    $telefono = str_replace('"', '""', $row['telefono']);
				    $telefono = '"' . $telefono . '"' . "\t";

				    $comoseentero = str_replace('"', '""', $row['comoseentero']);
				    $comoseentero = '"' . $comoseentero . '"' . "\t";

				    $fecha = str_replace('"', '""', $row['fecha']);
				    $fecha = '"' . $fecha . '"' . "\t";
				}
				$line .= $nombre.$email.$empresa.$puesto.$pais.$estado.$codigopostal.$telefono.$comoseentero.$fecha."\n";
			}

		$data = str_replace("\r", "", $line);
		//$data = Encoding::toUTF8($data);
		$data = Encoding::toISO8859($data);
		}
		
		header("Content-type: application/vnd.ms-excel; charset=utf-8");
		header("Content-Disposition: attachment; filename=exporta_contactos_".date('y-m-d').".xls");
		header("Pragma: no-cache");
		header("Expires: 0");

		echo $header."\n".$data;
		
	}

	public function showContacts(){
		$this->header_admin($lang="es");
        $sql = "SELECT * FROM contactos";
		$query = $this->pdo->prepare($sql);
		$rs = $query->execute();
		if($rs!==false){
			$nr = $query->rowCount();
			if( $nr > 0 ){
				$rows = $query->fetchAll();
				require $this->adminviews."list-contacts.php";
			}
		}
		$this->footer_admin($lang="es");
	}
	
}

?>