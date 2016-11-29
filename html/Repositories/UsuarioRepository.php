<?php 

include_once("BaseRepository.php");

class UsuarioRepository extends BaseRepository{

	private $result;

	function __construct()
	{
		$this->result = new stdClass();
		parent::__construct();
	}

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

	public function get( $id )
	{
		return $this->pdo->query( "SELECT * FROM usuario WHERE id_usuario = $id" )->fetch(\PDO::FETCH_ASSOC);
	}

	public function getUsersTypes()
	{
		return $this->pdo->query( "SELECT * FROM tipo_usuario" )->fetchAll( \PDO::FETCH_ASSOC );
	}
}