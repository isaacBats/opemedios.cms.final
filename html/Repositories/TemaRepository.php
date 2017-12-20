<?php 

include_once("BaseRepository.php");

class TemaRepository extends BaseRepository{

	/**
	 * Table name
	 * @var string $table
	 */
	private $table = 'tema';

	public function getThemaByEmpresaID( $id ){
		
		$issues = null;

		$query = $this->pdo->prepare('SELECT * FROM tema WHERE id_empresa = ' . $id);
		
		if($query->execute()){
			$issues = ( $query->rowCount() > 0 ) ? $query->fetchAll(\PDO::FETCH_ASSOC) : 'No hay temas disponibles';
		}else{
			$error = $query->errorInfo();
			$issues = 'Error al consultar las secciones para la fuente con id ' . $fontId . PHP_EOL;
			$issues .= 'Code Error: ' . $error[1] . ' Error: ' . $error[2];
		}

		return $issues;
	}

	public function get($id) 
	{
		try {
			$stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id_tema = :idTema");
			if ($stmt->execute([':idTema' => $id])) {
				return $stmt->fetch(\PDO::FETCH_ASSOC);
			} else {
				return false;
			}
		} catch (Exception $e) {
			$message = 'No se pudo obtener el tema. ' . PHP_EOL . 'Error: ' . $e->getMessage();
			error_log($message, 0);
			echo $message;
		}
	}

	public function where(array $array)
	{
		return [
			[0, 'Titulo del tema', 'Descripcion'],
			[1, 'Titulo del tema 1', 'Descripcion'],
			[2, 'Titulo del tema 2', 'Descripcion'],
		];
	}

	/**
	 * Delete Theme
	 * @param  integer $empresa Id of the Company
	 * @return boolean	true = if remove, false = if error in the execution
	 */
	public function deleteFromEmpresa($empresa)
	{
		if ($this->pdo->exec("DELETE FROM {$this->table} WHERE id_empresa = {$empresa}"))
			return true;
		else 
			return false;
	}
}