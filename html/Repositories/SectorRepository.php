<?php 

include_once("BaseRepository.php");

class SectorRepository extends BaseRepository{

	public function findById($id){
		
		$query = $this->pdo->prepare("SELECT * FROM sector WHERE id_sector = '$id' LIMIT 1;");
		
		if($query->execute()){
			return  $query->fetch();
		}else{
			echo 'No se pudo ejecutar la consulta para buscar el Sector';
		}
	}

	public function addSector( $font ){

		$sql = 'INSERT INTO sector (nombre, descripcion, activo) 
								VALUES(:nombre, :descripcion, :activo)';

		$query = $this->pdo->prepare($sql);
		$query->bindParam(':nombre',$font['nombre']);
		$query->bindParam(':descripcion',$font['descripcion']);
		$query->bindParam(':activo',$font['activo']);
		
		if($query->execute()){
			return true;
			// echo 'se ejecuto correctamente la segunda sentencia';
		}else{
		 	return false;
		 	// echo 'No se ejecuto la segunda sentencia';
		}

	}

	public function allSectors(){
		
		$query = $this->pdo->prepare("SELECT * FROM sector ORDER BY id_sector DESC;");
		
		if($query->execute()){
			return $query->fetchAll(\PDO::FETCH_ASSOC);
		}else{
			echo 'No se pudo ejecutar la consulta para buscar todos los Sectores';
		}
	}
}