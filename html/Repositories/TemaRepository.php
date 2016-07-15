<?php 

include_once("BaseRepository.php");

class TemaRepository extends BaseRepository{

	public function getThemaByEmpresaID( $id ){
		
		$query = $this->pdo->prepare('SELECT * FROM tema WHERE id_empresa = ' . $id);
		
		if($query->execute()){
			return $query->fetch(\PDO::FETCH_ASSOC);
		}else{
			echo 'No se pudo ejecutar la consulta en la tabla Tema';
		}
	}
}