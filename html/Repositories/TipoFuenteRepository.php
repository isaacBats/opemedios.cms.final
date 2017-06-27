<?php 

include_once("BaseRepository.php");

class TipoFuenteRepository extends BaseRepository{

	public function findIdByName( $name ){
		
		if( $name == 'tele' || $name == 'peri' ){
			$query = $this->pdo->prepare("SELECT * FROM tipo_fuente WHERE descripcion LIKE '$name%' LIMIT 1;");
		}else{
			$query = $this->pdo->prepare("SELECT * FROM tipo_fuente WHERE descripcion LIKE '$name' LIMIT 1;");			
		}
		
		if($query->execute()){
			$tipo = $query->fetch();
			return $tipo['id_tipo_fuente'];
		}else{
			echo 'No se pudo ejecutar la consulta para buscar el id de un tipo de fuente';
		}
	}

	public function all(){
		
		$query = $this->pdo->prepare('SELECT * FROM tipo_fuente');

		$resultado = ( $query->execute() ) ? $query->fetchAll() : 'No se pudo ejecutar la consulta para el tipo de fuentes';

		return $resultado;
	}

	public function get($id)
	{
		return $this->pdo->query("SELECT * FROM tipo_fuente WHERE id_tipo_fuente = $id")->fetch(\PDO::FETCH_ASSOC);
	}

	
}