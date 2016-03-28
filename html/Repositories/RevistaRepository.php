<?php 

include_once("BaseRepository.php");

class RevistaRepository extends BaseRepository{

	public function idFuenteRE(){
		
		$query = $this->pdo->prepare('SELECT * FROM tipo_fuente WHERE descripcion LIKE \'revista\' LIMIT 1;');
		
		if($query->execute()){
			$tipoFuente = $query->fetch();
			return $fuente_id = $tipoFuente['id_tipo_fuente'];
		}else{
			echo 'No se pudo ejecutar la consulta para buscar el id de la fuente Televisón';
		}
	}

	public function addFontRE( $font ){

		$idNewFont = $this->addFont($font);
		$sql = 'INSERT INTO fuente_rev (id_fuente, tiraje) 
								VALUES(:idFuente, :tiraje)';

		$query = $this->pdo->prepare($sql);
		$query->bindParam(':idFuente',$idNewFont);
		$query->bindParam(':tiraje',$font['tiraje']);
		
		if($query->execute()){
			return true;
			// echo 'se ejecuto correctamente la segunda sentencia';
		}else{
		 	return false;
		 	// echo 'No se ejecuto la segunda sentencia';
		}

	}
}