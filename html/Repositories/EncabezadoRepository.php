<?php 

include_once('BaseRepository.php');

class EncabezadoRepository extends BaseRepository
{
	private $table = 'encabezados';

	public function add( array $encabezado )
	{
		$qry = "INSERT INTO {$this->table} (id_adjunto, logo, impactos, costo_cm, costo_nota, fecha, fraccion, num_pagina, porcentaje, seccion, tamanio, tiraje) VALUES (:id_adjunto, :logo, :impactos, :costo_cm, :costo_nota, :fecha, :fraccion, :num_pagina, :porcentaje, :seccion, :tamanio, :tiraje)";

		$stmt = $this->pdo->prepare( $qry );
		$stmt->bindParam(':id_adjunto', $encabezado['id_adjunto']);
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
		return $this->pdo->query('SELECT * FROM ' . $this->table . ' WHERE id_adjunto = ' . $adjuntoId )->fetch();	
	}
}

