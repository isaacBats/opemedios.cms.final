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

	public function addNews( $new ){
		$sql = "INSERT INTO noticia (encabezado, sintesis, autor, fecha, comentario, id_tipo_fuente, id_fuente, id_seccion, id_sector, id_tipo_autor, id_genero, id_tendencia_monitorista, id_usuario) 
							VALUES(:encabezado, :sintesis, :autor, :fecha, :comentario, :idTipoFuente, :idFuente, :idSeccion, :idSector, :idTipoAutor, :idGenero, :idTendenciaMonitorista, :idUsuario)";
		$query = $this->pdo->prepare($sql);
		$query->bindParam(':encabezado',$new['encabezado']);
		$query->bindParam(':sintesis',$new['sintesis']);
		$query->bindParam(':autor',$new['autor']);
		$query->bindParam(':fecha',$new['fecha']);
		$query->bindParam(':comentario',$new['comentarios']);
		$query->bindParam(':idTipoFuente',$new['tipoFuente']);
		$query->bindParam(':idFuente',$new['fuente']);
		$query->bindParam(':idSeccion',$new['seccion']);
		$query->bindParam(':idSector',$new['sector']);
		$query->bindParam(':idTipoAutor',$new['tipoAutor']);
		$query->bindParam(':idGenero',$new['genero']);
		$query->bindParam(':idTendenciaMonitorista',$new['tendencia']);
		$query->bindParam(':idUsuario',$new['usuario']);
			
		if($query->execute()){
			$lastInsert = $this->pdo->prepare('SELECT LAST_INSERT_ID() AS id;');
			if($lastInsert->execute()){
				$lastInsertID = $lastInsert->fetch();
				return $lastInsertID['id'];
			}
		}

	}
}