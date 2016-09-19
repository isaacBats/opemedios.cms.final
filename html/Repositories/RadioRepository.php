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

	public function addNewRD( $new ){

		$idNew = $this->addNews( $new );

		$adjuntoRepo = new AdjuntoRepository();
		$adjunto = $adjuntoRepo->add( $new, $idNew );
		if( $adjunto->exito ){

			$sql = 'INSERT INTO noticia_rad (id_noticia, hora, duracion, costo)
								VALUES(:idNoticia, :hora, :duracion, :costo);';

			$query = $this->pdo->prepare( $sql );
			$query->bindParam(':idNoticia', $idNew);
			$query->bindParam(':hora', 		$new['hora']);
			$query->bindParam(':duracion', 	$new['duracion']);
			$query->bindParam(':costo', 	$new['costoBeneficio']);

			$result = new stdClass();

			if($query->execute()){
				$result->exito = true;
				$result->fileName = $adjunto->name;
			}else{
			 	$error = $query->errorInfo();
				$result->exito = false;
				$result->fileName = 'No se inserto la noticia';
				$result->errorCode = $error[1];
				$result->error = $error[2];
			}
			return $result;
		}else{
			echo $adjunto->name;
		}
	}
}