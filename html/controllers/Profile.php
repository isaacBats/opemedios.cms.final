<?php 

class Profile extends Controller{

	public function accountStatusAction($lang = "es"){
		if( isset($_SESSION["user"])){
				$this->addbread( array("url"=>"/profile/acount" , "label"=>"Estado de Cuenta") );
				$this->header($lang);

				$sqlUser = "SELECT * FROM usuarios WHERE id_registro = :id";
				$query = $this->pdo->prepare($sqlUser);
				$query->bindParam(
					':id', 
					$_SESSION['user']['id_registro'], 
					\PDO::PARAM_INT
				);

				$rs = $query->execute();
				$user =  $query->fetch();

				$contentd = 'Hello contentd';
				

				require $this->views."profile.php";
				$this->footer( $lang );	
			}
			else{
				header('Location: ./login');
			}
	}

	public function pricesListAction($lang = "es"){
		if( isset($_SESSION["user"])){
				$this->addbread( array("url"=>"/profile/prices-list" , "label"=>"Lista de precios") );
				$this->header($lang);

				$sqlUser = "SELECT * FROM usuarios WHERE id_registro = :id";
				$query = $this->pdo->prepare($sqlUser);
				$query->bindParam(
					':id', 
					$_SESSION['user']['id_registro'], 
					\PDO::PARAM_INT
				);

				$rs = $query->execute();
				$user =  $query->fetch();

				$contentd = 'Hello contentd';
				

				require $this->views."profile.php";
				$this->footer( $lang );	
			}
			else{
				header('Location: ./login');
			}
	}

	public function downloadCatalogAction($lang = "es"){
		if( isset($_SESSION["user"])){
				$this->addbread( array("url"=>"/profile/download-catalog" , "label"=>"Descargar Catálogo") );
				$this->header($lang);

				$sqlUser = "SELECT * FROM usuarios WHERE id_registro = :id";
				$query = $this->pdo->prepare($sqlUser);
				$query->bindParam(
					':id', 
					$_SESSION['user']['id_registro'], 
					\PDO::PARAM_INT
				);

				$rs = $query->execute();
				$user =  $query->fetch();

				$contentd = 'Hello contentd';
				

				require $this->views."profile.php";
				$this->footer( $lang );	
			}
			else{
				header('Location: ./login');
			}	}

	public function myQuoteAction($lang = "es"){
		if( isset($_SESSION["user"])){
				$this->addbread( array("url"=>"/profile/my-quote" , "label"=>"Mis cotizaciones") );
				$this->header($lang);

				$sqlUser = "SELECT * FROM usuarios WHERE id_registro = :id";
				$query = $this->pdo->prepare($sqlUser);
				$query->bindParam(
					':id', 
					$_SESSION['user']['id_registro'], 
					\PDO::PARAM_INT
				);

				$rs = $query->execute();
				$user =  $query->fetch();

				$contentd = 'Hello contentd';				

				require $this->views."profile.php";
				$this->footer( $lang );	
			}
			else{
				header('Location: ./login');
			}
	}

}