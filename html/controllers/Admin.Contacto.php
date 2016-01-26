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
				
				$header = "NOMBRE\tEMAIL\tEMPRESA\tPUESTO\tPAIS\tESTADO\tCODIGO POSTAL\tTELEFONO\tEMAIL\tCOMO SE ENTERO\tFECHA\t";
				$line = '';
				
				$rows = $query->fetchAll();
				foreach ($rows as $row) {
					$nombre = str_replace('"', '""', $row['nombre']);
				    $nombre = '"' . $nombre . '"' . "\t";
				}

				$line .= $nombre."\n";
			}

		$data = str_replace("\r", "", $line);
		$data = Encoding::toUTF8($data);
		//$data = Encoding::toISO8859($data);
		}
		
		header("Content-type: application/vnd.ms-excel; charset=utf-8");
		header("Content-Disposition: attachment; filename=exporta_contactos_".date('y-m-d').".xls");
		header("Pragma: no-cache");
		header("Expires: 0");

		echo $header."\n".$data;
		
	}

	public function showContacts(){
		$this->header_admin($lang="es");
		$html = '<div class="table-responsive">
              <table class="table table-bordered table-default table-striped nomargin">
                <thead class="success">
                  <tr>
                    <th>Nombre</th>
                    <th>Empresa</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th class="text-right">Acciones</th>
                  </tr>
                </thead>
                <tbody>';
        $sql = "SELECT * FROM contactos";
		$query = $this->pdo->prepare($sql);
		$query->bindParam(':id_tabla', $id_tabla);
		$rs = $query->execute();
		if($rs!==false){
			$nr = $query->rowCount();
			if( $nr > 0 ){
				$rows = $query->fetchAll();
				foreach ($rows as $row) {
					$html .= '
					<tr>
                     <td>'.$row['nombre'].'</td>
                     <td>'.$row['empresa'].'</td>
                     <td>'.$row['telefono'].'</td>
                     <td>'.$row['email'].'</td>
                     <td class="text-right">
                     	<button class="btn btn-default btn-sm">Ver</button>
                     </td>
                   </tr>';
				}
			}
		}
                  
		$html .= '</tbody>
              </table>
            </div>';
        echo $html;
		$this->footer_admin($lang="es");
	}
	
}

?>