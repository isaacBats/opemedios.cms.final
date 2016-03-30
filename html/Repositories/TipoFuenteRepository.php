<?php 

include_once("BaseRepository.php");

class TipoFuenteRepository extends BaseRepository{

	public function findIdByName( $name ){
		
		if( $name == 'tele' || $name == 'peri' ){
			$query = $this->pdo->prepare("SELECT * FROM tipo_fuente WHERE descripcion LIKE '$name%' LIMIT 1;");
		}else{
			$query = $this->pdo->prepare("SELECT * FROM tipo_fuente WHERE descripcion LIKE '$name' LIMIT 1;");			
		}
		
		if($query->execute()){
			$tipo = $query->fetch();
			return $tipo['id_tipo_fuente'];
		}else{
			echo 'No se pudo ejecutar la consulta para buscar el id de un tipo de fuente';
		}
	}

	
}