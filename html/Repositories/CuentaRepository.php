<?php 

include_once("BaseRepository.php");

class CuentaRepository extends BaseRepository{

	public function getAcountsByCompany ( $company ){

		$sql = "SELECT * FROM cuenta WHERE id_empresa = $company";

		$query = $this->pdo->prepare($sql);
		
		$acounts = ( $query->execute() ) ? $query->fetchAll(\PDO::FETCH_ASSOC) : 'No se encontraron cuentas con ese criterio';

		return $acounts;
	}

	public function getAcountsActivesByCompany ( $company ){

		$sql = "SELECT * FROM cuenta WHERE activo != 0 AND id_empresa = $company";

		$query = $this->pdo->prepare($sql);
		
		$acounts = ( $query->execute() ) ? $query->fetchAll(\PDO::FETCH_ASSOC) : 'No se encontraron cuentas con ese criterio';

		return $acounts;
	}

	/**
	 * Crea una cuenta para un cliente
	 * @param  array  $cuenta Datos de la cuenta
	 * @return stdClass Object  Retorna informacion sobre la ejecucion de la sentencia en la base de datos
	 */
	public function create( array $cuenta )
	{
		$result = new stdClass();
		$qry = "INSERT INTO cuenta ( nombre, apellidos, telefono1, telefono2, email, cargo, comentario, username, password, activo, id_empresa ) VALUES( :nombre, :apellidos, :tel_casa, :tel_cel, :email, :cargo, :comentario, :username, :password, :activo, :empresa );";
		
		$data = [
					':nombre' 	  => $cuenta['nombre'],
					':apellidos'  => $cuenta['apellidos'],
					':tel_casa'   => $cuenta['tel_casa'],
					':tel_cel' 	  => $cuenta['celular'],
					':email' 	  => $cuenta['correo'],
					':cargo' 	  => $cuenta['cargo'],
					':comentario' => $cuenta['comentarios'],
					':username'   => $cuenta['username'],
					':password'   => $cuenta['password'],
					':activo'     => $cuenta['activo'],
					':empresa'=> $cuenta['empresaId'],
				];

		$stmt = $this->pdo->prepare( $qry );

		if( $stmt->execute( $data )){
			$result->exito = true;
			$result->tipo = 'alert-info';
			$result->mensaje = '<strong>Exito: </strong> Se ha creado la cuenta ' . $cuenta['nombre'] . ' ' . $cuenta['apellidos'] . ' exitosamente !!!';
			$result->row = $this->pdo->query('SELECT * FROM cuenta WHERE id_cuenta = ' . $this->pdo->lastInsertId())->fetch(\PDO::FETCH_ASSOC);
		}else{
			$result->exito = false;
			$result->tipo = 'alert-danger';
            $result->mensaje = 'No se pudo crear la cuenta';
            $result->error = $stmt->errorInfo()[2];;
		}
		
		return $result;
	}

	public function changeActive( $cuentaId )
	{
		$result = new stdClass();

		if( $this->pdo->exec( "UPDATE cuenta SET activo = NOT activo WHERE id_cuenta = $cuentaId;" ) === 1 ){
			$result->exito = TRUE;
		}else{
			$result->exito = FALSE;
			$result->error = $this->pdo->errorInfo()[2];
		}
		
		return $result;
	}

	public function get($id)
	{	
		return  $this->pdo->query("SELECT * FROM cuenta WHERE id_cuenta = $id")->fetch(PDO::FETCH_ASSOC);
	}

	public function getByEmail($email)
	{	
		return  $this->pdo->query("SELECT * FROM cuenta WHERE email = '{$email}'")->fetch(PDO::FETCH_ASSOC);
	}

	public function updateAcount($data)
	{
		$stmt = $this->pdo->prepare("UPDATE cuenta SET nombre = :nombre, apellidos = :apellidos, cargo = :cargo, telefono1 = :telefono1, telefono2 = :telefono2, email = :email, comentario = :comentario, username = :username, password = :password, id_empresa = :id_empresa, activo = :activo WHERE id_cuenta = :id_cuenta");

		$result = new stdClass;
		
		if ($stmt->execute($data)) {
			$result->exito = TRUE;
		}else{
			$result->exito = FALSE;
			$result->error = $this->pdo->errorInfo()[2];
		}
		
		return $result;	
	}
}