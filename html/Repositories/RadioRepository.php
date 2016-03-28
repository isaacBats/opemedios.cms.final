<?php 

include_once("BaseRepository.php");

class RadioRepository extends BaseRepository{

	public function idFuenteRD(){
		
		$query = $this->pdo->prepare('SELECT * FROM tipo_fuente WHERE descripcion LIKE \'radio\' LIMIT 1;');
		
		if($query->execute()){
			$tipoFuente = $query->fetch();
			return $fuente_id = $tipoFuente['id_tipo_fuente'];
		}else{
			echo 'No se pudo ejecutar la consulta para buscar el id de la fuente Televisón';
		}
	}

	public function addFontRD( $font ){

		$idNewFont = $this->addFont($font);
		$sql = 'INSERT INTO fuente_rad (id_fuente, conductor, estacion, horario) 
								VALUES(:idFuente, :conductor, :estacion, :horario)';

		$query = $this->pdo->prepare($sql);
		$query->bindParam(':idFuente',$idNewFont);
		$query->bindParam(':conductor',$font['conductor']);
		$query->bindParam(':estacion',$font['estacion']);
		$query->bindParam(':horario',$font['horario']);
		
		if($query->execute()){
			return true;
			// echo 'se ejecuto correctamente la segunda sentencia';
		}else{
		 	return false;
		 	// echo 'No se ejecuto la segunda sentencia';
		}

	}
}