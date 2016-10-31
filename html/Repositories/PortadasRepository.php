<?php 

use utilities\Util;
include_once("BaseRepository.php");

class PortadasRepository extends BaseRepository{

	public function create ( array $portada ){	

		$sql = 'INSERT INTO portadas (fuente_id, imagen, thumb, tipo_portada, orden, created_at) 
								VALUES(:fuente, :imagen, :thumb, :tipo, :orden, :created)';

		$createdAt = new DateTime();

		$query = $this->pdo->prepare($sql);
		$query->bindParam(':fuente',$portada['fuente']);
		$query->bindParam(':imagen',$portada['imagen']);
		$query->bindParam(':thumb',$portada['thumb']);
		$query->bindParam(':tipo',Util::tipoPortada($portada['tipo_portada']));
		$query->bindParam(':orden',$this->getOrden( $createdAt->format('Y-m-d') ));
		$query->bindParam(':created',$createdAt);
		
		$result = new stdClass();

		if($query->execute()){
			$result->exito = true;
			$result->mesaage = 'Se agregado un nuevo elemento';
			$result->class = 'alert-info';
		}else{
			$result->exito = false;
			$result->message = 'No se pude agregar el elemento';
			$result->error = $query->errorInfo();
			$result->class = 'alert-danger';
		}

		return $result;
	}

	private function getOrden ( $day )
	{
		$ultimo = $this->pdo->query("SELECT MAX(orden) as 'orden' FROM portadas WHERE DATE_FORMAT(created_at, '%Y-%m-%d') = '{$day}'")->fetch( \PDO::FETCH_ASSOC );

		$orden = 0;
		if( $ultimo['orden'] != NULL ){
			$orden = $ultimo['orden'] + 1;
		}else{
			$orden = 1;
		}

		return $orden;
	}

}