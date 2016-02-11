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
			// TODO: @Noticias agregar funcionalidad de tumbnails (4)
			$query->bindParam(':imagen_thumbnail', $_FILES['imagen_thumbnail']['name']);
			$query->bindParam(':imagen', $_FILES['imagen']['name']);
			$query->bindParam(':fecha', $_POST['fecha']);
			
			$query = $query->execute();
			if( $sql!=false ){
				header("Location: /panel/news/list");
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

	public function removeNew($lang="es", $id){

		if( !empty($id) ){
			$sql = "DELETE FROM noticias WHERE id_noticia = :id";
			$query = $this->pdo->prepare($sql);
			$query->bindParam(':id', $id, \PDO::PARAM_INT);
			$rs = $query->execute();
			if( $rs != false ){
				echo "<span>Noticia eliminada</span>";
				header("Location: /panel/news/list");
			}

		}
	}

	/**
	 *  Para editar una noticia ya publicada
	 * @param  string $lang lenguaje
	 * @param  int    $id   identificador de la noticia a editar
	 */
	public function editNewAction($lang="es", $id){
		$this->header_admin($lang);
		$new = $this->findNewById($id);
		require $this->adminviews."edit-new.php";
		$this->footer_admin($lang);

	}

	/**
	 * Busca una noticia por su id
	 * @param  int $id identificador unico de la noticia
	 * @return Array[] Un array con el resultado de la consulta     
	 */
	private function findNewById($id){
		$query = $this->pdo->prepare("SELECT * FROM noticias WHERE id_noticia = :id");
		$query->bindParam(':id', $id, \PDO::PARAM_INT);
		$query->execute();

		return $query->fetch(\PDO::FETCH_ASSOC);
	}

	/*
	 * Guarda los datos que se modificaron 
	 * en la noticia a editar
	 */
	public function saveNewChangesAction(){
		if( !empty($_POST) ){
			$new = $this->findNewById($_POST['id']);
			$rs = $this->updateNew($_POST['id'], $_POST['titulo'], $new['slug'], $_POST['titulo_en'], $_POST['extracto'], $_POST['extracto_en'], $_POST['contenido'], $_POST['contenido_en'], $new['imagen_thumbnail'], $new['imagen'], $new['fecha']);
			if($rs){
				header("Location: /panel/news/list");
			}
			if( isset( $_FILES["imagen"]["name"] ) && $_FILES["imagen"]["name"] != "" ){
				echo "<br> with image";
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
				$rs = $this->updateNew($_POST['id'], $_POST['titulo'], $new['slug'], $_POST['titulo_en'], $_POST['extracto'], $_POST['extracto_en'], $_POST['contenido'], $_POST['contenido_en'], $new['imagen_thumbnail'], $_FILES['imagen']['name'], $new['fecha']);
				if($rs){
					header("Location: /panel/news/list");
				}
			}

			if(isset($_FILES["imagen_thumbnail"]["name"]) && $_FILES["imagen_thumbnail"]["name"] != ""){
				echo "<br> whit thumbnail";
				$extensiones_permitidas = array("jpg", "jpeg", "gif", "png","JPG","JPEG","PNG");
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
				$rs = $this->updateNew($_POST['id'], $_POST['titulo'], $new['slug'], $_POST['titulo_en'], $_POST['extracto'], $_POST['extracto_en'], $_POST['contenido'], $_POST['contenido_en'], $_FILES["imagen_thumbnail"]["name"], $new['imagen'], $new['fecha']);
				if($rs){
					header("Location: /panel/news/list");
				}
			}

			if($_FILES["imagen"]["name"] != "" && $_FILES["imagen_thumbnail"]["name"] != ""){
				echo "<br> whit images";
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
				$rs = $this->updateNew($_POST['id'], $_POST['titulo'], $new['slug'], $_POST['titulo_en'], $_POST['extracto'], $_POST['extracto_en'], $_POST['contenido'], $_POST['contenido_en'], $_FILES["imagen_thumbnail"]["name"], $_FILES['imagen']['name'], $new['fecha']);
				if($rs){
					header("Location: /panel/news/list");
				}
			}
		}
	}

	/**
	 * Actualiza en la base de datos un registro para una noticia nueva
	 * 
	 * @param  int $id               	Id de la noticia
	 * @param  String $titulo           El titulo en español
	 * @param  String $slug             El segmento que se usara para la URL
	 * @param  String $titulo_en        El titulo en ingles
	 * @param  String $extracto         Resumen en español
	 * @param  String $extracto_en      Resumen en ingles
	 * @param  String $contenido        El cuerpo de la noticia en español
	 * @param  String $contenido_en     El cuerpo de la noticia en ingles
	 * @param  file $imagen_thumbnail 	Se usa para la lista de noticias
	 * @param  file $imagen           	Imagen principal en el cuerpo de la nota
	 * @param  Date $fecha            	Fecha de publicacion
	 * @return Boolean                  Resultado del Query
	 */
	private function updateNew($id, $titulo, $slug, $titulo_en, $extracto, $extracto_en, $contenido, $contenido_en, $imagen_thumbnail, $imagen, $fecha){
		$sql = "UPDATE noticias SET titulo    		= :titulo,
									slug     	 	= :slug,
									titulo_en 		= :titulo_en,
									extracto		= :extracto,
									extracto_en		= :extracto_en,
									contenido		= :contenido,
									contenido_en	= :contenido_en,
									imagen_thumbnail= :imagen_thumbnail,
									imagen 			= :imagen,
									fecha			= :fecha
			                    WHERE id_noticia 	= :id
			                    LIMIT 1;				
				";
		$query = $this->pdo->prepare($sql);
		$query->bindParam(':titulo', $titulo);
		$query->bindParam(':slug', $slug);
		$query->bindParam(':titulo_en', $titulo_en);
		$query->bindParam(':extracto', $extracto);
		$query->bindParam(':extracto_en', $extracto_en);
		$query->bindParam(':contenido', $contenido);
		$query->bindParam(':contenido_en', $contenido_en);
		$query->bindParam(':imagen_thumbnail', $imagen_thumbnail);
		$query->bindParam(':imagen', $imagen);
		$query->bindParam(':fecha', $fecha);
		$query->bindParam(':id', $id);

		return $query->execute();
	}
	
}