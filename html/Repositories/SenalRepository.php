<?php 

include_once("BaseRepository.php");

class SenalRepository extends BaseRepository{

	public function findIdByDescription( $senal ){
		
		$query = $this->pdo->prepare("SELECT * FROM senal WHERE descripcion LIKE '$senal' LIMIT 1;");
		
		if($query->execute()){
			$senal = $query->fetch();
			return $senal['id_senal'];
		}else{
			echo 'No se pudo ejecutar la consulta para buscar el id de la fuente Televisón';
		}
	}

	public function getSenalById( $id )
	{
		$senal = $this->pdo->query( "SELECT * FROM senal WHERE id_senal = $id" );

		$result = new stdClass();

		if( $senal ){
			$result->exito = TRUE;
			$result->rows = ( sizeof( $senal ) > 0 ) ? $senal->fetch( \PDO::FETCH_ASSOC )['descripcion'] : 'No se encontro la señal';	
		}else{
			$result->exito = FALSE;
			$result->error = $this->pdo->errorInfo();
		}

		return $result;
	}

	public function all () 
	{
		return $this->pdo->query("SELECT * FROM senal")->fetchAll(\PDO::FETCH_ASSOC);
	}

}