<?php 

include_once("BaseRepository.php");

class TemaRepository extends BaseRepository{

	public function getThemaByEmpresaID( $id ){
		
		$issues = null;

		$query = $this->pdo->prepare('SELECT * FROM tema WHERE id_empresa = ' . $id);
		
		if($query->execute()){
			$issues = ( $query->rowCount() > 0 ) ? $query->fetchAll(\PDO::FETCH_ASSOC) : 'No hay temas disponibles';
		}else{
			$error = $query->errorInfo();
			$issues = 'Error al consultar las secciones para la fuente con id ' . $fontId . PHP_EOL;
			$issues .= 'Code Error: ' . $error[1] . ' Error: ' . $error[2];
		}

		return $issues;
	}

	public function where(array $array)
	{
		return [
			[0, 'Titulo del tema', 'Descripcion'],
			[1, 'Titulo del tema 1', 'Descripcion'],
			[2, 'Titulo del tema 2', 'Descripcion'],
		];
	}
}