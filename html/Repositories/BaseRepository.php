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
		$sql = "INSERT INTO noticia (encabezado, sintesis, autor, fecha, alcanse, id_tipo_fuente, id_fuente, id_seccion, id_sector, id_tipo_autor, id_genero, id_tendencia_monitorista, id_usuario) 
							VALUES(:encabezado, :sintesis, :autor, :fecha, :alcance, :idTipoFuente, :idFuente, :idSeccion, :idSector, :idTipoAutor, :idGenero, :idTendenciaMonitorista, :idUsuario)";
		$new['sector'] = '49';
		$new['fecha'] = date('Y-m-d');

		$query = $this->pdo->prepare($sql);
		$query->bindParam(':encabezado',$new['encabezado']);
		$query->bindParam(':sintesis',$new['sintesis']);
		$query->bindParam(':autor',$new['autor']);
		$query->bindParam(':fecha',$new['fecha']);
		$query->bindParam(':alcance',$new['alcance']);
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

	protected function addUbicacion ( $new, $id ){
		
		$sql = 'INSERT INTO ubicacion (id_noticia, uno, dos, tres, cuatro, cinco, seis, siete, ocho, nueve, diez, once, doce)
				VALUES (:idNoticia, :uno, :dos, :tres, :cuatro, :cinco, :seis, :siete, :ocho, :nueve, :diez, :once, :doce);';
		
		$query = $this->pdo->prepare( $sql );
		$query->bindParam(':idNoticia', $id);
		$query->bindParam(':uno', $new[0]);
		$query->bindParam(':dos', $new[1]);
		$query->bindParam(':tres', $new[2]);
		$query->bindParam(':cuatro', $new[3]);
		$query->bindParam(':cinco', $new[4]);
		$query->bindParam(':seis', $new[5]);
		$query->bindParam(':siete', $new[6]);
		$query->bindParam(':ocho', $new[7]);
		$query->bindParam(':nueve', $new[8]);
		$query->bindParam(':diez', $new[9]);
		$query->bindParam(':once', $new[10]);
		$query->bindParam(':doce', $new[11]);

		$rs = ( $query->execute() ) ? TRUE : FALSE;

		return $rs;
	}

	public function updateUbicacion ( $new, $id ){

		$sql = 'UPDATE ubicacion SET uno 		= :uno, 
									 dos 		= :dos, 
			  						 tres 		= :tres, 
									 cuatro 	= :cuatro, 
									 cinco 		= :cinco, 
									 seis 		= :seis, 
									 siete 		= :siete, 
									 ocho 		= :ocho, 
									 nueve 		= :nueve, 
									 diez 		= :diez, 
									 once 		= :once, 
									 doce 		= :doce
				WHERE id_noticia = :noticia_id;
				';
		
		$query = $this->pdo->prepare( $sql );
		$query->bindParam(':noticia_id', $id);
		$query->bindParam(':uno', $new[0]);
		$query->bindParam(':dos', $new[1]);
		$query->bindParam(':tres', $new[2]);
		$query->bindParam(':cuatro', $new[3]);
		$query->bindParam(':cinco', $new[4]);
		$query->bindParam(':seis', $new[5]);
		$query->bindParam(':siete', $new[6]);
		$query->bindParam(':ocho', $new[7]);
		$query->bindParam(':nueve', $new[8]);
		$query->bindParam(':diez', $new[9]);
		$query->bindParam(':once', $new[10]);
		$query->bindParam(':doce', $new[11]);

		return $query->execute();
	}

	public function getTiposPagina(){

		$query = $this->pdo->prepare('SELECT * FROM tipo_pagina');
		( $query->execute() ) ? $tipos = $query->fetchAll() : $tipos = 'Error en la consulta de la tabla de Tipos de Pagina';

		return $tipos;
	}

	public function getUbicacionByNoticiaId( $id ){

		$query = $this->pdo->prepare('SELECT * FROM ubicacion WHERE id_noticia = :id');
		$query->bindParam(':id', $id, \PDO::PARAM_STR);
		$ubicacion = ( $query->execute() ) ? $query->fetch() : 'Error en la consulta de la tabla de Ubicación';

		return $ubicacion;
	}
}