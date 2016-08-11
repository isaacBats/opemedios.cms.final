<?php 

class AdminController extends Controller{
	

	function __construct()
	{
		session_start();
		
		if( !isset($_SESSION["admin"] ) && $_SERVER["REQUEST_URI"] != "/panel/login"){
			header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
		}

		global $_config;
		$this->pdo = new PDO($_config->db["dsn"], $_config->db["nombre_usuario"], $_config->db["password"], $_config->db["opciones"]);
	}


	public function login(){
		require $this->adminviews."login.php";
	}


	public function logout(){
		unset( $_SESSION[ "admin"] );
		header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
	}

	public function saveLogin(){

		$user = $this->pdo->quote( $_POST["username"] );
 		$pass = $_POST["password"];
 			
		$sql =  "SELECT * FROM usuario WHERE username LIKE LOWER(".$user.") ";
		$query = $this->pdo->prepare($sql);
		if( $query->execute() ){
			$nr = $query->rowCount();
			if( $nr > 0 ){
				$user = $query->fetchAll(PDO::FETCH_ASSOC);
				if( isset( $user[0]["username"] ) ){
					if($user[0]["password"] == $pass){
						$_SESSION[ "admin"] = $user[0];	
						header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel");
					}else{
						header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
					}
				}else{
					header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
				}
			}else{
				header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
			}
		}else{
			header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
		}

		require $this->adminviews."login.php";
	}

	public function dashboard(){
		if( isset( $_SESSION['admin'] ) ){
			header( "Location: ./panel/dashboard");			
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}
}
?>