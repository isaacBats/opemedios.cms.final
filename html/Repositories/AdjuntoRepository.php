<?php 

include_once("BaseRepository.php");

class AdjuntoRepository extends BaseRepository{

	public function add ( $adjunto, $idNoticia ){

		if ( $adjunto['principal'] == 1 ) {
		
			$nombreArchivo = 'ID'.$idNoticia.'_'.str_replace( ' ', '-', $adjunto['files']['primario']['name'] );
		
		}else{
			
			$nombreArchivo = 'ID'.$idNoticia.'_2_'.str_replace( ' ', '-', $adjunto['files']['primario']['name'] );
		}

		$sql = 'INSERT INTO adjunto (nombre, tipo, carpeta, principal, id_noticia, nombre_archivo) 
								VALUES(:nombre, :tipo, :carpeta, :principal, :idNoticia, :nombreArchivo)';

		$query = $this->pdo->prepare($sql);
		$query->bindParam(':nombre',$adjunto['files']['primario']['name']);
		$query->bindParam(':tipo',$adjunto['files']['primario']['type']);
		$query->bindParam(':carpeta',$adjunto['slug']);
		$query->bindParam(':principal',$adjunto['principal']);
		$query->bindParam(':idNoticia',$idNoticia);
		$query->bindParam(':nombreArchivo',$nombreArchivo);
		
		$result = new stdClass();

		if($query->execute()){
			$result->exito = true;
			$result->name = $nombreArchivo;
		}else{
			$error = $query->errorInfo();
			$result->exito = false;
			$result->name = 'No se pude agregar el archivo adjunton :( en la base de datos';
			$result->errorCode = $error[1];
			$result->error = $error[2];
		}

		return $result;

	}

	public function getAdjunto( $idNoticia ){

		$query = $this->pdo->prepare( "SELECT * FROM adjunto WHERE id_noticia = $idNoticia" );

		$exito = ( $query->execute() ) ? $query->fetch() : 'No se pudo ejecutar la consulta para buscar el archivo adjunto';

		return $exito;
	}
}