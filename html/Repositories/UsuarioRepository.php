<?php 

include_once("BaseRepository.php");

class UsuarioRepository extends BaseRepository{

	public function showAllUsers( $limit, $offset )
	{
		$users = new stdClass();

		$stmt = $this->pdo->prepare(" SELECT * FROM usuario ORDER BY id_usuario DESC LIMIT $limit OFFSET $offset;");
		if($stmt->execute()){
			$users->exito = true;
			$users->rows = ( $stmt->rowCount() > 0 ) ? $stmt->fetchAll( \PDO::FETCH_ASSOC) : 0;
			$users->count = $this->pdo->query(' SELECT COUNT(*) AS count FROM usuario; ')->fetch()['count'];
		}else{
			$users->exito = false;
			$users->error = $stmt->errorInfo()[2];
		}

		return $users;	
	}
}