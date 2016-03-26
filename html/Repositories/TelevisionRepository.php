<?php 

include_once("BaseRepository.php");

class TelevisionRepository extends BaseRepository{

	public function idFuenteTV(){
		
		$query = $this->pdo->prepare('SELECT * FROM tipo_fuente WHERE descripcion LIKE \'tele%\' LIMIT 1;');
		
		if($query->execute()){
			$tipoFuente = $query->fetch();
			return $fuente_id = $tipoFuente['id_tipo_fuente'];
		}else{
			echo 'No se pudo ejecutar la consulta para buscar el id de la fuente Televisón';
		}
	}

	public function mensaje(){

		return 'Hola este es un mensaje';
	}
}