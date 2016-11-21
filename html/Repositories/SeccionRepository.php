<?php 

include_once("BaseRepository.php");

class SeccionRepository extends BaseRepository{

	public function getSeccionById($id){
		
		$query = $this->pdo->prepare("SELECT * FROM seccion WHERE id_seccion = '$id' LIMIT 1;");
		
		$rs = ($query->execute()) ? $query->fetch() : 'No se pudo ejecutar la consulta para buscar la sección';
		return $rs;
	}

	public function allSecciones( $activo = 0 ){
		
		if($activo == 1 ){
			$query = $this->pdo->prepare("SELECT * FROM seccion WHERE activo = $activo ORDER BY id_seccion DESC LIMIT 150;");		
		}else{
			$query = $this->pdo->prepare("SELECT * FROM seccion ORDER BY id_seccion DESC LIMIT 150;");			
		}
		
		if($query->execute()){
			return $query->fetchAll(\PDO::FETCH_ASSOC);
		}else{
			echo 'No se pudo ejecutar la consulta para buscar todos las Secciones';
		}
	}

	public function getByFontId ($fontId, $active = 1)
	{
		$sections = null;

		$query = $this->pdo->prepare(' SELECT * FROM seccion WHERE activo = :active AND id_fuente = :fuenteid');
		$query->bindParam( ':active', $active, \PDO::PARAM_INT);
		$query->bindParam( ':fuenteid', $fontId, \PDO::PARAM_INT);

		if( $query->execute() ){
			$sections = ( $query->rowCount() > 0 ) ? $query->fetchAll(\PDO::FETCH_ASSOC) : 'No hay secciones disponibles';
		}else{
			$error = $query->errorInfo();
			$sections = 'Error al consultar las secciones para la fuente con id ' . $fontId . PHP_EOL;
			$sections .= 'Code Error: ' . $error[1] . ' Error: ' . $error[2];
		}

		return $sections;
	}

	public function getSectionsByFont( $id )
	{
		$sections = $this->pdo->prepare( "SELECT * FROM seccion WHERE id_fuente = :id" );

		$result = new stdClass();

		if( $sections->execute([ ':id' => $id ]) ){
			$result->exito = TRUE;
			$result->rows = ( $sections->rowCount() > 0 ) ? $sections->fetchAll( \PDO::FETCH_ASSOC ) : 'No se encontraron secciones';	
		}else{
			$result->exito = FALSE;
			$result->error = $sections->errorInfo();
		}

		return $result;
	}

	public function changeActive( $sectionId )
	{
		$result = new stdClass();

		if( $this->pdo->exec( "UPDATE seccion SET activo = NOT activo WHERE id_seccion = $sectionId;" ) === 1 ){
			$result->exito = TRUE;
		}else{
			$result->exito = FALSE;
			$result->error = $this->pdo->errorInfo()[2];
		}
		
		return $result;
	}
}