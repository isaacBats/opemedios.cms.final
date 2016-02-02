<?php

require_once(__DIR__.'/../admin/ForceUTF8/Encoding.php');
use ForceUTF8\Encoding; 


class AdminUsuario extends Controller{

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

	public function showUsers(){
		$this->header_admin($lang="es");
		
        $sql = "SELECT * FROM usuarios";
		$query = $this->pdo->prepare($sql);
		$rs = $query->execute();
		if($rs!==false){
			$nr = $query->rowCount();
			if( $nr > 0 ){
				$rows = $query->fetchAll();
				require $this->adminviews."list-users.php";
			}
		}
		$this->footer_admin($lang="es");
	}

	public function detailUser($lang="es", $id){

		$this->header_admin($lang);

		$sql = "SELECT 
					id_registro,
					nombre,        
					apellidos,     
					nombreusuario, 
					pass,          
					email,         
					empresa,       
					puesto,        
					website,       
					direccion1,    
					direccion2,    
					pais,          
					estado,        
					codigopostal,  
					movil,         
					telefono,      
					organizacion,  
					status,        
					fecha 
				FROM usuarios 
				WHERE id_registro = :id";
		$query = $this->pdo->prepare($sql);
		$query->bindParam(':id', $id, \PDO::PARAM_INT);
		$rs = $query->execute();
		if($rs !==false){
			$user = $query->fetch(\PDO::FETCH_ASSOC);
			require $this->adminviews."view-user.php";
		}
		$this->footer_admin($lang);

	}
	
}
