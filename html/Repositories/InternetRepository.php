<?php 

include_once("BaseRepository.php");

class InternetRepository extends BaseRepository{

	public function idFuenteIN(){
		
		$query = $this->pdo->prepare('SELECT * FROM tipo_fuente WHERE descripcion LIKE \'internet\' LIMIT 1;');
		
		if($query->execute()){
			$tipoFuente = $query->fetch();
			return $fuente_id = $tipoFuente['id_tipo_fuente'];
		}else{
			echo 'No se pudo ejecutar la consulta para buscar el id de la fuente Televisón';
		}
	}

	public function addFontIN( $font ){

		$idNewFont = $this->addFont($font);
		$sql = 'INSERT INTO fuente_int (id_fuente, url) 
								VALUES(:idFuente, :url)';

		$query = $this->pdo->prepare($sql);
		$query->bindParam(':idFuente',$idNewFont);
		$query->bindParam(':url',$font['urlPortal']);
		
		if($query->execute()){
			return true;
			// echo 'se ejecuto correctamente la segunda sentencia';
		}else{
		 	return false;
		 	// echo 'No se ejecuto la segunda sentencia';
		}

	}

	public function addNewIN( $new ){

		$idNew = $this->addNews( $new );

		$adjunto = new AdjuntoRepository();
		if( $adjunto->add( $new, $idNew ) ){

			$sql = 'INSERT INTO noticia_int (id_noticia, url, hora_publicacion, costo)
								VALUES(:idNoticia, :url, :horaPub, :costo);';

			$query = $this->pdo->prepare( $sql );
			$query->bindParam(':idNoticia', $idNew);
			$query->bindParam(':url', 	$new['url']);
			$query->bindParam(':horaPub', 		$new['hora']);
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