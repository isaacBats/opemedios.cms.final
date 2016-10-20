<?php 

include_once("BaseRepository.php");

class AdjuntoRepository extends BaseRepository{

	public function add ( $adjunto, $idNoticia ){
	
		$nombreArchivo = 'ID'.$idNoticia.'_'.uniqid().str_replace( ' ', '-', $adjunto['name'] );	

		$sql = 'INSERT INTO adjunto (nombre, tipo, carpeta, principal, id_noticia, nombre_archivo) 
								VALUES(:nombre, :tipo, :carpeta, :principal, :idNoticia, :nombreArchivo)';

		$query = $this->pdo->prepare($sql);
		$query->bindParam(':nombre',$adjunto['name']);
		$query->bindParam(':tipo',$adjunto['type']);
		$query->bindParam(':carpeta',$adjunto['slug']);
		$query->bindParam(':principal',$adjunto['principal']);
		$query->bindParam(':idNoticia',$idNoticia);
		$query->bindParam(':nombreArchivo',$nombreArchivo);
		
		$result = new stdClass();

		if($query->execute()){
			$result->exito = true;
			$result->name = $nombreArchivo;
			$result->size = $adjunto['size'];
			$result->originName = $adjunto['name'];
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