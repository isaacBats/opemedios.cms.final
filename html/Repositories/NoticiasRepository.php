<?php 

include_once("BaseRepository.php");

class NoticiasRepository extends BaseRepository{

	public function showAllNews(){
		
		$query = $this->pdo->prepare("SELECT * FROM noticia ORDER BY id_noticia DESC LIMIT 30;");
		
		if($query->execute()){
			return $query->fetchAll(\PDO::FETCH_ASSOC);
		}else{
			echo 'No se pudo ejecutar la consulta para buscar todas las Noticias';
		}
	}

}