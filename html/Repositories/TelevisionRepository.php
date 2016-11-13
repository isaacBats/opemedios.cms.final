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
		$sql = 'INSERT INTO fuente_tel (id_fuente, conductor, canal, desde, hasta, id_senal) 
								VALUES(:idFuente, :conductor, :canal, :desde, :hasta, :idSenal)';

		$desde = new \DateTime( $font['desde'] );
		$hasta = new \DateTime( $font['hasta'] );

		$query = $this->pdo->prepare($sql);
		$query->bindParam(':idFuente',$idNewFont);
		$query->bindParam(':conductor',$font['conductor']);
		$query->bindParam(':canal',$font['canal']);
		$query->bindParam(':desde', $desde->format('H:i:s'));
		$query->bindParam(':hasta', $hasta->format('H:i:s'));
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

		$adjuntoRepo = new AdjuntoRepository();
		
		$adjunto = array();
		foreach ($new['archivos'] as $file) {
			$adjunto[] = $adjuntoRepo->add( $file, $idNew );
		}
		$error = 0;
		$fallidos = array();
		foreach ($adjunto as $adj) {
			if(!$adj->exito){
				$error++;
				array_push($fallidos, $adj);
			}
		}
		
		if( $error === 0 && sizeof( $fallidos ) == 0 ){

			$sql = 'INSERT INTO noticia_tel (id_noticia, hora, duracion, costo)
								VALUES(:idNoticia, :hora, :duracion, :costo);';

			$query = $this->pdo->prepare( $sql );
			$query->bindParam(':idNoticia', $idNew);
			$query->bindParam(':hora', 		$new['hora']);
			$query->bindParam(':duracion', 	$new['duracion']);
			$query->bindParam(':costo', 	$new['costoBeneficio']);

			$result = new stdClass();

			if($query->execute()){
				$result->exito = true;
				$result->fileName = $adjunto;
				$result->idNew = $idNew;
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