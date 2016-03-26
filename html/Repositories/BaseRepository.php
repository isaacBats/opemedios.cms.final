<?php 

class BaseRepository extends Controller{

	public function addFont($font = ''){
		$sql = "INSERT INTO fuente (nombre, empresa, comentario, logo, activo, id_tipo_fuente, id_cobertura) 
							VALUES(:nombre, :empresa, :comentario, :logo, :activo, :tipoFuente, :cobertura)";
		$query = $this->pdo->prepare($sql);
		return $query;
	}
}