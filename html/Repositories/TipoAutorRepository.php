<?php 

include_once("BaseRepository.php");

class TipoAutorRepository extends BaseRepository{

	public function allAuthors(){
		
		$query = $this->pdo->prepare('SELECT * FROM tipo_autor;');
		
		if($query->execute()){
			return $query->fetchAll(\PDO::FETCH_ASSOC);
		}else{
			echo 'No se pudo ejecutar la consulta para buscar todos los Tipos de Autor';
		}
	}

	public function get($id)
	{
		return $this->pdo->query("SELECT * FROM tipo_autor WHERE id_tipo_autor = {$id}")->fetch(\PDO::FETCH_ASSOC);
	}
}