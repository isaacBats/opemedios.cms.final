<?php 

include_once("BaseRepository.php");

class FuentesRepository extends BaseRepository{

	public function showAllFonts(){
		
		$query = $this->pdo->prepare("SELECT * FROM fuente ORDER BY id_fuente DESC LIMIT 30;");
		
		if($query->execute()){
			return $query->fetchAll(\PDO::FETCH_ASSOC);
		}else{
			echo 'No se pudo ejecutar la consulta para buscar todas las Fuentes';
		}
	}

}