<?php 

include_once("BaseRepository.php");
use utilities\Util;

class PeriodicoRepository extends BaseRepository{

	public function idFuentePE(){
		
		$query = $this->pdo->prepare('SELECT * FROM tipo_fuente WHERE descripcion LIKE \'peri%\' LIMIT 1;');
		
		if($query->execute()){
			$tipoFuente = $query->fetch();
			return $fuente_id = $tipoFuente['id_tipo_fuente'];
		}else{
			echo 'No se pudo ejecutar la consulta para buscar el id de la fuente Televisón';
		}
	}

	public function addFontPE( $font ){

		$idNewFont = $this->addFont($font);
		$sql = 'INSERT INTO fuente_per (id_fuente, tiraje) 
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

	public function getTirajeById( $fontId )
	{
		return $this->pdo->query("SELECT tiraje FROM fuente_per WHERE id_fuente = " . $fontId)->fetch(PDO::FETCH_ASSOC);
	}

	public function addNewPE( $new ){

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

			$sql = 'INSERT INTO noticia_per (id_noticia, pagina, id_tipo_pagina, id_tamano_nota, porcentaje_pagina, costo, ubicacion)
								VALUES(:idNoticia, :pagina, :id_tipo_pagina, :id_tamano_nota, :porcentaje, :costo, :ubicacion);';

			$tamano = 0;
			$query = $this->pdo->prepare( $sql );
			$query->bindParam(':idNoticia', 		$idNew);
			$query->bindParam(':pagina', 			$new['pagina']);
			$query->bindParam(':id_tipo_pagina',	$new['tipoPagina']);
			$query->bindParam(':id_tamano_nota', 	$tamano);
			$query->bindParam(':porcentaje', 		$new['tamano']);
			$query->bindParam(':costo', 			$new['costoBeneficio']);
			$query->bindParam(':ubicacion', 		Util::ubicationNew( $new['ubicacion'] ) );

			$result = new stdClass();

			if( $query->execute() ){
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
			$result->exito = false;
			$result->adjunto = $adjunto;
			$result->error = 'No se pudo inserta en noticia_per por errores en la tabla adjunto';
			return $result;
		}
	}


}