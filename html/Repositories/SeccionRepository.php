<?php 

include_once("BaseRepository.php");

class SeccionRepository extends BaseRepository{

	public function getSeccionById($id){
		
		$query = $this->pdo->prepare("SELECT * FROM seccion WHERE id_seccion = '$id' LIMIT 1;");
		
		$rs = ($query->execute()) ? $query->fetch(PDO::FETCH_ASSOC) : 'No se pudo ejecutar la consulta para buscar la sección';
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

	public function addSection( stdClass $seccion )
	{
		$result = new stdClass();
		$activo = 1;

		$stmt = $this->pdo->prepare( ' INSERT INTO seccion ( nombre, autor, descripcion, activo, id_fuente ) VALUES ( :nombre, :autor, :descripcion, :activo, :fuente); ' );
		$stmt->bindParam(':nombre', 	 $seccion->nombre, 		\PDO::PARAM_STR);
		$stmt->bindParam(':autor', 		 $seccion->autor, 		\PDO::PARAM_STR);
		$stmt->bindParam(':descripcion', $seccion->descripcion, \PDO::PARAM_STR);
		$stmt->bindParam(':activo', 	 $activo,				\PDO::PARAM_INT);
		$stmt->bindParam(':fuente',  	 $seccion->fuenteId, 	\PDO::PARAM_INT);

		if( $stmt->execute() ){
			$result->exito = TRUE;
		}else{
			$result->exito = FALSE;
			$result->error = $this->pdo->errorInfo()[2];
		}
		
		return $result;
	}

	public function getAuthor( $id_seccion )
	{
		$stmt = $this->pdo->prepare(' SELECT autor FROM seccion WHERE id_seccion = ?');
		$rs = new stdClass();

		if( $stmt->execute([ $id_seccion, ]) )
		{
			$rs->exito = TRUE;
			$rs->row = ( $stmt->rowCount() > 0 ) ? $stmt->fetch(PDO::FETCH_COLUMN) : '';
		}
		else
		{
			$rs->exito = FALSE;
			$rs->error = $stmt->errorInfo()[2];	
		}

		return $rs;
	}

	public function update(array $section) 
	{
		$res = new stdClass;
		$stmt = $this->pdo->prepare("UPDATE seccion SET nombre = :nombre, descripcion = :descripcion, autor = :autor, activo = :activo, id_fuente = :id_fuente WHERE id_seccion = :id_seccion LIMIT 1");

		if ($stmt->execute($section)) {
			$res->exito = true;
			$res->row = $this->pdo->query("SELECT * FROM seccion WHERE id_seccion = " . $section['id_seccion'])->fetch(PDO::FETCH_ASSOC);
		} else {
			$res->exito = false;
			$res->error = $stmt->errorInfo()[2];
		}

		return $res;
	}

	public function delete ($id) 
	{
		if ($this->pdo->exec("DELETE FROM seccion WHERE id_seccion = $id LIMIT 1")) 
			return true;
		else {
			throw new Exception("Error al borrar la seccion $id ");
		}
	}

	public function deleteByFontId ($fontId) 
	{
		if ($rows = $this->pdo->exec("DELETE FROM seccion WHERE id_fuente = $fontId")) 
			return $rows;
		else
			new Exception("Error al borrar las secciones el la fuente con el id: $fontId ");
		
		return false;
	}
}