<?php 

use utilities\Util;
include_once("BaseRepository.php");

class PortadasRepository extends BaseRepository{

	public function create ( array $portada ){	

		$sql = 'INSERT INTO portadas (fuente_id, imagen, thumb, tipo_portada, orden, created_at) 
								VALUES(:fuente, :imagen, :thumb, :tipo, :orden, :created)';

		$createdAt = new DateTime();

		$query = $this->pdo->prepare($sql);
		$query->bindParam(':fuente',$portada['fuente']);
		$query->bindParam(':imagen',$portada['imagen']);
		$query->bindParam(':thumb',$portada['thumb']);
		$query->bindParam(':tipo',Util::tipoPortada($portada['tipo_portada']));
		$query->bindParam(':orden',$this->getOrden( $createdAt->format('Y-m-d'), Util::tipoPortada($portada['tipo_portada']) ));
		$query->bindParam(':created',$createdAt->format('Y-m-d H:i:s'));
		
		$result = new stdClass();

		if($query->execute()){
			$result->exito = true;
			$result->mensaje = 'Se agregado un nuevo elemento';
			$result->tipo = 'alert-info';
		}else{
			$result->exito = false;
			$result->mensaje = 'No se pude agregar el elemento';
			$result->error = $query->errorInfo();
			$result->tipo = 'alert-danger';
		}

		return $result;
	}

	public function saveColumna ( array $columna )
	{
		$sql = 'INSERT INTO columnas (fuente_id, tipo_columna, titulo, autor, contenido, imagen, thumb) 
								VALUES(:fuente, :tipo, :titulo, :autor, :contenido, :imagen, :thumb)';

		$query = $this->pdo->prepare($sql);
		$query->bindParam(':fuente',$columna['fuente']);
		$query->bindParam(':imagen',$columna['imagen']);
		$query->bindParam(':thumb',$columna['thumb']);
		$query->bindParam(':tipo',Util::tipoColumna($columna['tipo_columna']));
		$query->bindParam(':titulo', $columna['titulo']);
		$query->bindParam(':autor', $columna['autor']);
		$query->bindParam(':contenido', $columna['contenido']);
		$result = new stdClass();

		if($query->execute()){
			$result->exito = true;
			$result->mensaje = 'Se agregado un nuevo elemento';
			$result->tipo = 'alert-info';
		}else{
			$result->exito = false;
			$result->mensaje = 'No se pude agregar el elemento';
			$result->error = $query->errorInfo();
			$result->tipo = 'alert-danger';
		}

		return $result;
	}

	private function getOrden ( $day, $type )
	{
		$ultimo = $this->pdo->query("SELECT MAX(orden) as 'orden' FROM portadas WHERE DATE_FORMAT(created_at, '%Y-%m-%d') = '{$day}' AND tipo_portada = '{$type}'")->fetch( \PDO::FETCH_ASSOC );

		$orden = 0;
		if( $ultimo['orden'] != NULL ){
			$orden = $ultimo['orden'] + 1;
		}else{
			$orden = 1;
		}

		return $orden;
	}

	public function getCovers($day, $type, $ids = array())
	{
		$qry = "SELECT * FROM portadas WHERE DATE_FORMAT(created_at, '%Y-%m-%d') = '{$day}' AND tipo_portada = '{$type}' ORDER BY orden DESC";
		
		if (sizeof($ids) > 0) {
			$implode = implode(',', $ids);
			$qry = "SELECT * FROM portadas WHERE id IN ({$implode}) AND tipo_portada = '{$type}' ORDER BY orden DESC";
		}

		$portadas = $this->pdo->query($qry);
		
		$result = new stdClass();

		if( $portadas ){
			$result->exito = TRUE;
			$result->rows = ( sizeof( $portadas ) > 0 ) ? $portadas->fetchAll( \PDO::FETCH_ASSOC ) : 'No hay elementos aun';			
		}else{
			$result->exito = FALSE;
			$result->error = $this->pdo->errorInfo()[2];
		}

		return $result;
	}

	public function getCoversColumnas ($day, $type, $ids = array())
	{
		$qry = "SELECT * FROM columnas WHERE DATE_FORMAT(created_at, '%Y-%m-%d') = '{$day}' AND tipo_columna = '{$type}' ORDER BY created_at DESC";

		if (sizeof($ids) > 0) {
			$implode = implode(',', $ids);
			$qry = "SELECT * FROM columnas WHERE id IN ({$implode}) AND tipo_columna = '{$type}' ORDER BY created_at DESC";
		}

		$columnas = $this->pdo->prepare($qry);

		$result = new stdClass();

		if ($columnas->execute()) {
			$result->exito = TRUE;
			$result->rows = ($columnas->rowCount() > 0) ? $columnas->fetchAll(\PDO::FETCH_ASSOC) : 'No hay elementos aun';			
		}else{
			$result->exito = FALSE;
			$result->error = $columnas->errorInfo()[2];
		}

		return $result;
	}

	public function getColumna($id)
	{
		return $this->pdo->query("SELECT * FROM columnas WHERE id = $id")->fetch(\PDO::FETCH_ASSOC);
	}

	public function getPortada ($id)
	{
		return $this->pdo->query("SELECT * FROM portadas WHERE id = $id")->fetch(\PDO::FETCH_ASSOC);
	}

	public function editColumna($data)
	{
		$rs = new stdClass();

		$stmt = $this->pdo->prepare("UPDATE columnas SET fuente_id = :fuente_id, 
														 tipo_columna = :tipo_columna, 
														 titulo = :titulo, 
														 autor = :autor, 
														 contenido = :contenido, 
														 imagen = :imagen, 
														 thumb = :thumb 
									WHERE id = :id");
		
		if ($stmt->execute($data)) {
			$rs->exito = true;
			$rs->column = $this->getColumna($data['id']);
		} else {
			$rs->exito = false;
			$rs->error = $stmt->errorInfo()[2];
			$rs->data = $data;
		}

		return $rs;	
	}

	public function deleteColumna($id)
	{
		$rs = new stdClass();

		$stmt = $this->pdo->prepare("DELETE FROM columnas WHERE id = :id");
		
		if ($stmt->execute([':id' => $id])) {
			$rs->exito = true;
		} else {
			$rs->exito = false;
			$rs->error = $stmt->errorInfo()[2];
		}

		return $rs;
	}

	public function deletePortada($id)
	{
		$rs = new stdClass();

		$stmt = $this->pdo->prepare("DELETE FROM portadas WHERE id = :id");
		
		if ($stmt->execute([':id' => $id])) {
			$rs->exito = true;
		} else {
			$rs->exito = false;
			$rs->error = $stmt->errorInfo()[2];
		}

		return $rs;
	}	

}