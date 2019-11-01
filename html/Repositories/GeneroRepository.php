<?php

include_once("BaseRepository.php");

class GeneroRepository extends BaseRepository{

	 public function findById($id){

	 	$query = $this->pdo->prepare("SELECT * FROM genero WHERE id_genero = '$id' LIMIT 1;");

	 	if($query->execute()){
	 		return  $query->fetch(\PDO::FETCH_ASSOC);
	 	}else{
	 		echo 'No se pudo ejecutar la consulta para buscar el Genero';
	 	}
	 }

	// public function addSector( $font ){

	// 	$sql = 'INSERT INTO sector (nombre, descripcion, activo)
	// 							VALUES(:nombre, :descripcion, :activo)';

	// 	$query = $this->pdo->prepare($sql);
	// 	$query->bindParam(':nombre',$font['nombre']);
	// 	$query->bindParam(':descripcion',$font['descripcion']);
	// 	$query->bindParam(':activo',$font['activo']);

	// 	if($query->execute()){
	// 		return true;
	// 		// echo 'se ejecuto correctamente la segunda sentencia';
	// 	}else{
	// 	 	return false;
	// 	 	// echo 'No se ejecuto la segunda sentencia';
	// 	}

	// }

	public function allGeneros(){

		$query = $this->pdo->prepare('SELECT * FROM genero;');

		if($query->execute()){
			return $query->fetchAll(\PDO::FETCH_ASSOC);
		}else{
			echo 'No se pudo ejecutar la consulta para buscar todos los Generos';
		}
	}
}
