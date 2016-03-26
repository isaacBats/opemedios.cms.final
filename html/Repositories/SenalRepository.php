<?php 

include_once("BaseRepository.php");

class SenalRepository extends BaseRepository{

	public function findIdByDescription( $senal ){
		
		$query = $this->pdo->prepare("SELECT * FROM senal WHERE descripcion LIKE '$senal' LIMIT 1;");
		
		if($query->execute()){
			$senal = $query->fetch();
			return $senal['id_senal'];
		}else{
			echo 'No se pudo ejecutar la consulta para buscar el id de la fuente Televisón';
		}
	}

}