<?php 

class AdminNoticias extends Controller{

	public function addNew(){
		$this->header_admin($lang="es");
		require $this->adminviews."add-new.php";
		$this->footer_admin($lang="es");
	}

	public function saveNew(){
		if( !empty($_POST) ){

			$extensiones_permitidas = array("jpg", "jpeg", "gif", "png","JPG","JPEG","PNG");
			$explode = explode(".", $_FILES['imagen']["name"]);
			$extension = end($explode);
			if ((($_FILES['imagen']["type"] == "image/png")
				|| ($_FILES['imagen']["type"] == "image/jpeg")
				|| ($_FILES['imagen']["type"] == "image/jpg")
				|| ($_FILES['imagen']["type"] == "image/PNG"))
				&& in_array($extension, $extensiones_permitidas))
			{
				if ($_FILES['imagen']["error"] > 0)
				{
					echo "ERROR: " . $_FILES['imagen']["error"] . "<br>";
				}
				else
				{
					$_FILES['imagen']["name"]='noticia_'.uniqid().'.'.$extension;
					$path=__DIR__."/../assets/images/news/". $_FILES['imagen']["name"];
					$move = move_uploaded_file($_FILES['imagen']["tmp_name"],$path);

					if(!$move){
						throw new Exception("Error al mover el archivo", 1);
					}
				}
			}

			$explode = explode(".", $_FILES['imagen_thumbnail']["name"]);
			$extension = end($explode);
			if ((($_FILES['imagen_thumbnail']["type"] == "image/png")
				|| ($_FILES['imagen_thumbnail']["type"] == "image/jpeg")
				|| ($_FILES['imagen_thumbnail']["type"] == "image/jpg")
				|| ($_FILES['imagen_thumbnail']["type"] == "image/PNG"))
				&& in_array($extension, $extensiones_permitidas))
			{
				if ($_FILES['imagen_thumbnail']["error"] > 0)
				{
					echo "ERROR: " . $_FILES['imagen_thumbnail']["error"] . "<br>";
				}
				else
				{
					$_FILES['imagen_thumbnail']["name"]='noticia_'.uniqid().'.'.$extension;
					$path=__DIR__."/../assets/images/news/". $_FILES['imagen_thumbnail']["name"];
					$move = move_uploaded_file($_FILES['imagen_thumbnail']["tmp_name"],$path);

					if(!$move){
						throw new Exception("Error al mover el archivo", 1);
					}
				}
			}


			$sql = 'INSERT INTO noticias (titulo,titulo_en,slug,extracto,extracto_en,contenido,contenido_en,imagen_thumbnail,imagen,fecha) VALUES (:titulo,:titulo_en,:slug,:extracto,:extracto_en,:contenido,:contenido_en,:imagen_thumbnail,:imagen,:fecha)';
			$query = $this->pdo->prepare($sql);
			$query->bindParam(':titulo', $_POST['titulo']);
			$query->bindParam(':titulo_en', $_POST['titulo_en']);
			$query->bindParam(':slug', $_POST['slug']);
			$query->bindParam(':extracto', $_POST['extracto']);
			$query->bindParam(':extracto_en', $_POST['extracto_en']);
			$query->bindParam(':contenido', $_POST['contenido']);
			$query->bindParam(':contenido_en', $_POST['contenido_en']);
			// @TODO: agregar funcionalidad de tumbnails
			$query->bindParam(':imagen_thumbnail', $_FILES['imagen_thumbnail']['name']);
			$query->bindParam(':imagen', $_FILES['imagen']['name']);
			$query->bindParam(':fecha', $_POST['fecha']);
			
			$query = $query->execute();
			if( $sql!=false ){
				header("Location: /admin/news/list");
			}
		}
	}

	public function showListNews(){
		$this->header_admin($lang="es");
		
		$sql = "SELECT * FROM noticias";
		$query = $this->pdo->prepare($sql);
		$query->bindParam(':id_tabla', $id_tabla);
		$rs = $query->execute();
		if($rs!==false){
			$nr = $query->rowCount();
			if( $nr > 0 ){
				$rows = $query->fetchAll();
				require $this->adminviews."list-news.php";				
			}
		}
		$this->footer_admin($lang="es");
	}

	public function detailNew($lang="es", $id){

		$this->header_admin($lang);

		$sql = "SELECT 
					id_noticia,
					titulo, 
					titulo_en, 
					extracto, 
					extracto_en, 
					contenido, 
					contenido_en,
					imagen_thumbnail,
					imagen,
					fecha 
				FROM noticias 
				WHERE id_noticia = :id";
		$query = $this->pdo->prepare($sql);
		$query->bindParam(':id', $id, \PDO::PARAM_INT);
		$rs = $query->execute();
		if($rs !==false){
			$new = $query->fetch(\PDO::FETCH_ASSOC);
			require $this->adminviews."view-new.php";
		}
		$this->footer_admin($lang);

	}

	// @TODO: Falta crear el metodo de editNew y removeNew
	
}