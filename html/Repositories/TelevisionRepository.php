<?php 

include_once("BaseRepository.php");
include_once("AdjuntoRepository.php");

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

	public function addFontTV( $font ){

		$idNewFont = $this->addFont($font);
		$sql = 'INSERT INTO fuente_tel (id_fuente, conductor, canal, horario, id_senal) 
								VALUES(:idFuente, :conductor, :canal, :horario, :idSenal)';

		$query = $this->pdo->prepare($sql);
		$query->bindParam(':idFuente',$idNewFont);
		$query->bindParam(':conductor',$font['conductor']);
		$query->bindParam(':canal',$font['canal']);
		$query->bindParam(':horario',$font['horario']);
		$query->bindParam(':idSenal',$font['senal']);
		
		if($query->execute()){
			return true;
			// echo 'se ejecuto correctamente la segunda sentencia';
		}else{
		 	return false;
		 	// echo 'No se ejecuto la segunda sentencia';
		}

	}

	public function addNewTV( $new ){

		$idNew = $this->addNews( $new );

		$adjunto = new AdjuntoRepository();
		if( $adjunto->add( $new, $idNew ) ){

			$sql = 'INSERT INTO noticia_tel (id_noticia, hora, duracion, costo)
								VALUES(:idNoticia, :hora, :duracion, :costo);';

			$query = $this->pdo->prepare( $sql );
			$query->bindParam(':idNoticia', $idNew);
			$query->bindParam(':hora', 		$new['hora']);
			$query->bindParam(':duracion', 	$new['duracion']);
			$query->bindParam(':costo', 	$new['costoBeneficio']);

			if($query->execute()){
				return true;
			}else{
			 	return false;
			}
		}else{
			echo 'No se pude agregar el archivo adjunton :(';
		}
	}
}