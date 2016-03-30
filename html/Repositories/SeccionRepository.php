<?php 

include_once("BaseRepository.php");

class SeccionRepository extends BaseRepository{

	// public function findById($id){
		
	// 	$query = $this->pdo->prepare("SELECT * FROM sector WHERE id_sector = '$id' LIMIT 1;");
		
	// 	if($query->execute()){
	// 		return  $query->fetch();
	// 	}else{
	// 		echo 'No se pudo ejecutar la consulta para buscar el Sector';
	// 	}
	// }

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

	public function allSecciones( $activo = 0 ){
		
		if($activo == 1 ){
			$query = $this->pdo->prepare("SELECT * FROM seccion WHERE activo = $activo ORDER BY id_seccion DESC LIMIT 150;");		
		}else{
			$query = $this->pdo->prepare("SELECT * FROM seccion ORDER BY id_seccion DESC LIMIT 150;");			
		}
		
		if($query->execute()){
			return $query->fetchAll(\PDO::FETCH_ASSOC);
		}else{
			echo 'No se pudo ejecutar la consulta para buscar todos las Secciones';
		}
	}
}