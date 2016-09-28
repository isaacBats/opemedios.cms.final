<?php 

include_once("BaseRepository.php");

class EmpresaRepository extends BaseRepository{

	public function filterEmpresas ( $criterio ){

		$sql = "SELECT * FROM empresa WHERE nombre like '%$criterio%' OR contacto like '%$criterio%' OR email like '%$criterio%' OR giro like '%$criterio%'";

		$query = $this->pdo->prepare($sql);
		
		$filter = ( $query->execute() ) ? $query->fetchAll(\PDO::FETCH_ASSOC) : 'No se encontraron empresas con ese criterio';

		return $filter;
	}

	public function getEmpresaById ( $id ){

		$sql = "SELECT * FROM empresa WHERE id_empresa = $id LIMIT 1";

		$query = $this->pdo->prepare($sql);
		
		$company = ( $query->execute() ) ? $query->fetch(\PDO::FETCH_ASSOC) : 'No se encontraron empresas con ese criterio';

		return $company;
	}

	public function all(){
		
		$empresas = new stdClass();

		$query = $this->pdo->prepare('SELECT * FROM empresa;');
		
		if($query->execute()){
			$empresas->exito = true;
			$empresas->rows = ( $query->rowCount() > 0 ) ? $query->fetchAll( \PDO::FETCH_ASSOC) : 'No hay empresas';
			$empresas->error = 0;
		}else{
			$empresas->exito = false;
			$empresas->error = $query->errorInfo();
		}

		return $empresas;
	}
}