<?php 

include_once("BaseRepository.php");

use utilities\UserState;

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

	public function showAllCompanies( $limit, $offset )
	{
		$empresas = new stdClass();

		$stmt = $this->pdo->prepare(" SELECT * FROM empresa ORDER BY id_empresa DESC LIMIT $limit OFFSET $offset;");
		if($stmt->execute()){
			$empresas->exito = true;
			$empresas->rows = ( $stmt->rowCount() > 0 ) ? $stmt->fetchAll( \PDO::FETCH_ASSOC) : 0;
			$empresas->count = $this->pdo->query(' SELECT COUNT(*) AS count FROM empresa; ')->fetch()['count'];
		}else{
			$empresas->exito = false;
			$empresas->error = $stmt->errorInfo()[2];
		}

		return $empresas;	
	}

	public function getContactsbyEmpresaId( $empresa_id )
	{
		$sql = "SELECT e.id_empresa AS empresaid, e.nombre AS empresa, t.id_tema AS temaid, t.nombre AS tema, c.id_cuenta AS cuentaid, CONCAT(c.nombre, ' ', c.apellidos) AS nombre_cuenta, c.email AS correo FROM empresa_tema_cuenta etc INNER JOIN empresa e ON etc.id_empresa = e.id_empresa INNER JOIN tema t ON etc.id_tema = t.id_tema INNER JOIN cuenta c ON etc.id_cuenta = c.id_cuenta WHERE c.activo = " . UserState::ACTIVE . " AND e.id_empresa = " . $empresa_id;

		$contacts = new stdClass();
		$query = $this->pdo->prepare( $sql );
		
		if($query->execute()){
			$contacts->exito = true;
			$contacts->rows = ( $query->rowCount() > 0 ) ? $query->fetchAll( \PDO::FETCH_ASSOC) : 'No hay contactos';
			$contacts->error = 0;
		}else{
			$contacts->exito = false;
			$contacts->error = $query->errorInfo();
		}

		return $contacts;
	}
}