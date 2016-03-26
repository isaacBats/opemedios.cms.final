<?php 

include_once("BaseRepository.php");

class CoberturaRepository extends BaseRepository{

	public function idCobertura($cobertura){
		
		$query = $this->pdo->prepare("SELECT * FROM cobertura WHERE descripcion LIKE '$cobertura' LIMIT 1;");
		
		if($query->execute()){
			$cobertura = $query->fetch();
			return $cobertura['id_cobertura'];
		}else{
			echo 'No se pudo ejecutar la consulta para buscar el id de la fuente Televisón';
		}
	}

	public function mensaje(){

		return 'Hola este es un mensaje';
	}
}