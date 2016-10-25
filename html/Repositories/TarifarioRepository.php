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
		}else{
			$rs->exito = false;
			$rs->error = $query->errorInfo();
		}

		return $rs;
	}
}