<?php 

class BaseRepository {

	protected $pdo = null;

	function __construct()
		{
			global $_config;
			$this->pdo = new PDO($_config->db["dsn"], $_config->db["nombre_usuario"], $_config->db["password"], $_config->db["opciones"]);
		}

	public function addFont( $font ){
		$sql = "INSERT INTO fuente (nombre, empresa, comentario, logo, activo, id_tipo_fuente, id_cobertura) 
							VALUES(:nombre, :empresa, :comentario, :logo, :activo, :tipoFuente, :cobertura)";
		$query = $this->pdo->prepare($sql);
		$query->bindParam(':nombre',$font['nombre']);
		$query->bindParam(':empresa',$font['empresa']);
		$query->bindParam(':comentario',$font['comentario']);
		$query->bindParam(':logo',$font['logo']);
		$query->bindParam(':activo',$font['activo']);
		$query->bindParam(':tipoFuente',$font['tipoFuente']);
		$query->bindParam(':cobertura',$font['cobertura']);
			
		if($query->execute()){
			$lastInsert = $this->pdo->prepare('SELECT LAST_INSERT_ID() AS id;');
			if($lastInsert->execute()){
				$lastInsertID = $lastInsert->fetch();
				return $lastInsertID['id'];
			}
		}

	}
}