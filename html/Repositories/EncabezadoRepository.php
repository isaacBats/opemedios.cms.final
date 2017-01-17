<?php 

include_once('BaseRepository.php');

class EncabezadoRepository extends BaseRepository
{
	private $table = 'encabezados';

	public function add( array $encabezado )
	{
		$qry = "INSERT INTO {$this->table} (id_adjunto, id_fuente, id_seccion, logo, impactos, costo_cm, costo_nota, fecha, fraccion, num_pagina, porcentaje, seccion, tamanio, tiraje) VALUES (:id_adjunto, :id_fuente, :id_seccion, :logo, :impactos, :costo_cm, :costo_nota, :fecha, :fraccion, :num_pagina, :porcentaje, :seccion, :tamanio, :tiraje)";

		$stmt = $this->pdo->prepare( $qry );
		$stmt->bindParam(':id_adjunto', $encabezado['id_adjunto']);
		$stmt->bindParam(':id_fuente', $encabezado['id_fuente']);
		$stmt->bindParam(':id_seccion', $encabezado['id_seccion']);
		$stmt->bindParam(':logo', $encabezado['logo']);
		$stmt->bindParam(':impactos', $encabezado['impactos']);
		$stmt->bindParam(':costo_cm', $encabezado['costo_cm']);
		$stmt->bindParam(':costo_nota', $encabezado['costo_nota']);
		$stmt->bindParam(':fecha', $encabezado['fecha']);
		$stmt->bindParam(':fraccion', $encabezado['fraccion']);
		$stmt->bindParam(':num_pagina', $encabezado['num_pagina']);
		$stmt->bindParam(':porcentaje', $encabezado['porcentaje']);
		$stmt->bindParam(':seccion', $encabezado['seccion']);
		$stmt->bindParam(':tamanio', $encabezado['tamanio']);
		$stmt->bindParam(':tiraje', $encabezado['tiraje']);

		$result = new stdClass();

		if( $stmt->execute() )
		{
			$result->exito = true;
			$result->encabezado = $this->pdo->query( "SELECT * FROM {$this->table} WHERE id = " . $this->pdo->lastInsertId() )->fetch(\PDO::FETCH_ASSOC);
		}
		else
		{
			$result->exito = false;
			$result->error = $stmt->errorInfo()[2];
		}

		return $result;
	}

	public function findByAdjuntoId( $adjuntoId )
	{
		try
		{
			return $this->pdo->query('SELECT * FROM ' . $this->table . ' WHERE id_adjunto = ' . $adjuntoId )->fetch();	
		}
		catch( PDOException $error )
		{
			echo 'Error: ' . $error;
		}
	}

	public function findById( $id )
	{
		try
		{
			return $this->pdo->query('SELECT * FROM ' . $this->table . ' WHERE id = ' . $id )->fetch();				
		}
		catch( PDOException $error )
		{
			echo 'Error: ' . $error;
		}
	}

	public function edit( array $encabezado )
	{
		$qry = "UPDATE {$this->table} SET logo = :logo,
										  impactos = :impactos,
										  costo_cm = :costo_cm,
										  costo_nota = :costo_nota,
										  fraccion = :fraccion,
										  num_pagina = :num_pagina,
										  porcentaje = :porcentaje,
										  seccion = :seccion,
										  tamanio = :tamanio,
										  tiraje = :tiraje,
										  id_fuente = :id_fuente,
										  id_seccion = :id_seccion
				WHERE id = :id";

		$stmt = $this->pdo->prepare( $qry );
		
		$result = new stdClass();

		if( $stmt->execute( $encabezado ) )
		{
			$result->exito = true;
			$result->encabezado = $this->pdo->query( "SELECT * FROM {$this->table} WHERE id = " . $encabezado['id'] )->fetch(\PDO::FETCH_ASSOC);
		}
		else
		{
			$result->exito = false;
			$result->error = $stmt->errorInfo()[2];
		}

		return $result;
	}


}

