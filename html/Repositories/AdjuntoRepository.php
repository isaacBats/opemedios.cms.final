<?php 

include_once("BaseRepository.php");

class AdjuntoRepository extends BaseRepository{

	private $table = 'adjunto';
	
	public function add ( $adjunto, $idNoticia ){

		$encabezadoRepo = new EncabezadoRepository();
	
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
			$lastInsertId = $this->pdo->lastInsertId();
			$adjunto['encabezado']['id_adjunto'] = $lastInsertId;
			$result->exito = true;
			$result->encabezado = $encabezadoRepo->add( $adjunto['encabezado'] );
			$result->name = $nombreArchivo;
			$result->size = $adjunto['size'];
			$result->originName = $adjunto['name'];
			$result->adjunto = $this->pdo->query( "SELECT * FROM adjunto WHERE id_adjunto = " . $lastInsertId )->fetch(\PDO::FETCH_ASSOC);
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

		$exito = ( $query->execute() ) ? $query->fetchAll(\PDO::FETCH_ASSOC) : 'No se pudo ejecutar la consulta para buscar el archivo adjunto';

		return $exito;
	}

	public function findById( $adjuntoId )
	{
		return $this->pdo->query('SELECT * FROM adjunto WHERE id_adjunto = ' . $adjuntoId )->fetch();	
	}

	public function delete( $id )
	{
		$result = new stdClass();

		if( $this->pdo->exec( "DELETE FROM {$this->table} WHERE id_adjunto = $id LIMIT 1;" ) === 1 ){
			$result->exito = TRUE;
		}else{
			$result->exito = FALSE;
			$result->error = $this->pdo->errorInfo()[2];
		}
		
		return $result;
	}

	public function updateAdjunto($adjuntoId, $fileAttached)
	{
		$result = new stdClass();

		$stmt = $this->pdo->prepare( "UPDATE adjunto SET nombre = :name, tipo = :fileType, nombre_archivo = :fileName WHERE id_adjunto = :aid LIMIT 1" );

		$stmt->bindParam(':name', $fileAttached['name'], PDO::PARAM_STR);
		$stmt->bindParam(':fileType', $fileAttached['type'], PDO::PARAM_STR);
		$stmt->bindParam(':fileName', $fileAttached['createdName'], PDO::PARAM_STR);
		$stmt->bindParam(':aid', $adjuntoId, PDO::PARAM_INT);
		return $stmt->execute();
		
	}
}