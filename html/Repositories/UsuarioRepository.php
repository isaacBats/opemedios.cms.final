<?php 

include_once("BaseRepository.php");

class UsuarioRepository extends BaseRepository{

	private $result;

	function __construct()
	{
		$this->result = new stdClass();
		parent::__construct();
	}

	public function showAllUsers()
	{
		$users = new stdClass();

		/*JOZ*/
		$stmt = $this->pdo->prepare(" SELECT * FROM usuario ORDER BY id_usuario DESC");
		/*JOZ*/

		if($stmt->execute()){
			$users->exito = true;
			$users->rows = ( $stmt->rowCount() > 0 ) ? $stmt->fetchAll( \PDO::FETCH_ASSOC) : 0;
			$users->count = $this->pdo->query(' SELECT COUNT(*) AS count FROM usuario; ')->fetch()['count'];
		}else{
			$users->exito = false;
			$users->error = $stmt->errorInfo()[2];
		}

		return $users;	
	}

	public function get( $id )
	{
		return $this->pdo->query( "SELECT * FROM usuario WHERE id_usuario = $id" )->fetch(\PDO::FETCH_ASSOC);
	}

	public function getUsersTypes()
	{
		return $this->pdo->query( "SELECT * FROM tipo_usuario" )->fetchAll( \PDO::FETCH_ASSOC );
	}

	public function edit( array $user )
	{
		$qry = "UPDATE usuario SET nombre     = :nombre,
								   apellidos  = :apellidos,
								   direccion  = :direccion, 
								   telefono1  = :tel_casa,
								   telefono2  = :tel_cel,
								   email      = :email,
								   cargo      = :cargo, 
								   comentario = :comentario,
								   username   = :username,
								   password   = :password,
								   activo     = :activo,
								   id_tipo_usuario = :tipoUsuario
				WHERE id_usuario = :iduser;";

		$data = [
					':nombre' 	  => $user['nombre'],
					':apellidos'  => $user['apellidos'],
					':direccion'  => $user['direccion'],
					':tel_casa'   => $user['tel_casa'],
					':tel_cel' 	  => $user['celular'],
					':email' 	  => $user['correo'],
					':cargo' 	  => $user['cargo'],
					':comentario' => $user['comentarios'],
					':username'   => $user['username'],
					':password'   => $user['password'],
					':activo'     => $user['activo'],
					':tipoUsuario' 	  => $user['tipo_usuario'],
					':iduser'     => $user['id'],
				];
		$stmt = $this->pdo->prepare( $qry );

		if( $stmt->execute( $data )){
			$this->result->exito = true;
			$this->result->tipo = 'alert-info';
			$this->result->mensaje = 'Datos actializados <strong>Correctamente!!!</strong>';
		}else{
			$this->result->exito = false;
			$this->result->tipo = 'alert-danger';
            $this->result->mensaje = 'No se pudo actualizar tu perfil';
            $this->result->error = $stmt->errorInfo()[2];;
		}
		
		return $this->result;
	}

	public function create( array $user )
	{
		$qry = "INSERT INTO usuario ( nombre, apellidos, direccion, telefono1, telefono2, email, cargo, comentario, username, password, activo, id_tipo_usuario ) VALUES( :nombre, :apellidos, :direccion, :tel_casa, :tel_cel, :email, :cargo, :comentario, :username, :password, :activo, :tipoUsuario );";
		
		$data = [
					':nombre' 	  => $user['nombre'],
					':apellidos'  => $user['apellidos'],
					':direccion'  => $user['direccion'],
					':tel_casa'   => $user['tel_casa'],
					':tel_cel' 	  => $user['celular'],
					':email' 	  => $user['correo'],
					':cargo' 	  => $user['cargo'],
					':comentario' => $user['comentarios'],
					':username'   => $user['username'],
					':password'   => $user['password'],
					':activo'     => $user['activo'],
					':tipoUsuario'=> $user['tipo_usuario'],
				];

		$stmt = $this->pdo->prepare( $qry );

		if( $stmt->execute( $data )){
			$this->result->exito = true;
			$this->result->tipo = 'alert-info';
			$this->result->mensaje = '<strong>Exito: </strong> Se ha creado el usuario ' . $user['nombre'] . ' ' . $user['apellidos'] . ' exitosamente !!!';
			$this->result->lastID = $this->pdo->lastInsertId();
			$this->result->row = $this->pdo->query('SELECT * FROM usuario WHERE id_usuario = ' . $this->result->lastID)->fetch(\PDO::FETCH_ASSOC);
		}else{
			$this->result->exito = false;
			$this->result->tipo = 'alert-danger';
            $this->result->mensaje = 'No se pudo crear el usuario';
            $this->result->error = $stmt->errorInfo()[2];;
		}
		
		return $this->result;
	}

	public function getContactsByCompanyTheme( $company, $theme )
	{
		$qry = " SELECT c.* FROM empresa_tema_cuenta etc INNER JOIN cuenta c ON etc.id_cuenta = c.id_cuenta WHERE c.activo != 0 AND etc.id_empresa = $company AND id_tema = $theme; ";

		return $this->pdo->query( $qry )->fetchAll(PDO::FETCH_ASSOC);
	}

	/*joz*/
	public function deleteUser( $id )
	{
		$rs = new stdClass();
		$stmt = $this->pdo->prepare("DELETE FROM usuario WHERE id_usuario = :id");
		if ($stmt->execute([':id' => $id])) {
			$rs->exito = true;
		} else {
			$rs->exito = false;
			$rs->error = $stmt->errorInfo()[2];
		}
		return $rs;
	}
	/*/joz*/

}