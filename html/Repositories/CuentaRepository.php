<?php 

include_once("BaseRepository.php");

class CuentaRepository extends BaseRepository{

	public function getAcountsByCompany ( $company ){

		$sql = "SELECT id_cuenta, nombre, apellidos, email FROM cuenta WHERE id_empresa = $company";

		$query = $this->pdo->prepare($sql);
		
		$acounts = ( $query->execute() ) ? $query->fetchAll(\PDO::FETCH_ASSOC) : 'No se encontraron cuentas con ese criterio';

		return $acounts;
	}
}