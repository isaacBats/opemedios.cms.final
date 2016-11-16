<?php 

include_once("BaseRepository.php");

class CoberturaRepository extends BaseRepository{

	public function findIdByDescription($cobertura){
		
		$query = $this->pdo->prepare("SELECT * FROM cobertura WHERE descripcion LIKE '$cobertura' LIMIT 1;");
		
		if($query->execute()){
			$cobertura = $query->fetch();
			return $cobertura['id_cobertura'];
		}else{
			echo 'No se pudo ejecutar la consulta para buscar el id de la fuente Televisón';
		}
	}

	public function getCoberturaById( $id )
	{
		$cobertura = $this->pdo->query( "SELECT * FROM cobertura WHERE id_cobertura = $id" );

		$result = new stdClass();

		if( $cobertura ){
			$result->exito = TRUE;
			$result->rows = ( sizeof( $cobertura ) > 0 ) ? $cobertura->fetch( \PDO::FETCH_ASSOC )['descripcion'] : 'No se encontro la cobertura';	
		}else{
			$result->exito = FALSE;
			$result->error = $this->pdo->errorInfo();
		}

		return $result;
	}

	
}