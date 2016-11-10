<?php 

include_once("BaseRepository.php"); 

/**
* Repository Tariff
*/
class TarifarioRepository extends BaseRepository
{
	
	public function addTariff( $name, $columns, $pathFile )
	{
		$query = $this->pdo->prepare( 'INSERT INTO tarifarios ( nombre, columnas, path_file) VALUES ( :name, :columns, :path_file );' );
		$rs = new stdClass();
		
		if( $query->execute([':name' => $name, ':columns' => $columns, 'path_file' => $pathFile]) ){
			$rs->exito = true;
			$rs->lastID = $this->pdo->lastInsertId();
			$rs->row = $this->pdo->query('SELECT * FROM tarifarios WHERE id = ' . $rs->lastID)->fetch(\PDO::FETCH_ASSOC);
			$rs->mensaje = 'Se han creado un nuevo Tarifario';
			$rs->tipo = 'alert-info';
		}else{
			$rs->exito = false;
			$rs->error = $query->errorInfo();
			$rs->mensaje = 'No se pude agregar el Tarifario';
			$rs->tipo = 'alert-danger';
		}

		return $rs;
	}

	public function addSections( $tarifario_id, $seccion )
	{
		$query = $this->pdo->prepare( 'INSERT INTO tarifario_secciones ( tarifario_id, seccion ) VALUES ( :tarifario_id, :seccion );' );
		$rs = new stdClass();
		
		if( $query->execute([':tarifario_id' => $tarifario_id, ':seccion' => $seccion]) ){
			$rs->exito = true;
			$rs->lastID = $this->pdo->lastInsertId();
			$rs->row = $this->pdo->query('SELECT * FROM tarifario_secciones WHERE id = ' . $rs->lastID)->fetch(\PDO::FETCH_ASSOC);
			$rs->mensaje = 'Se han agregado las secciones correctamente';
			$rs->tipo = 'alert-info';
		}else{
			$rs->exito = false;
			$rs->error = $query->errorInfo();
			$rs->mensaje = 'No se pude agregar el Tarifario';
			$rs->tipo = 'alert-danger';
		}

		return $rs;
	}

	public function addValues( $seccion, $valores )
	{
		$query = $this->pdo->prepare( 'INSERT INTO tarifario_detalles ( id_seccion, valores ) VALUES ( :seccion, :valores );' );
		$rs = new stdClass();
		
		if( $query->execute([':seccion' => $seccion, ':valores' => $valores]) ){
			$rs->exito = true;
			$rs->lastID = $this->pdo->lastInsertId();
			$rs->row = $this->pdo->query('SELECT * FROM tarifario_detalles WHERE id = ' . $rs->lastID)->fetch(\PDO::FETCH_ASSOC);
			$rs->mensaje = 'Se ha agregado el tarifario correctamente';
			$rs->tipo = 'alert-info';
		}else{
			$rs->exito = false;
			$rs->error = $query->errorInfo();
			$rs->mensaje = 'No se pude agregar el Tarifario';
			$rs->tipo = 'alert-danger';
		}

		return $rs;
	}
}