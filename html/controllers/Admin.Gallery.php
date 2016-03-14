<?php

class AdminGallery extends Controller{
	
	public function showGalleries( $lang = "es"){

		$this->header_admin($lang);
		
		$sql = "SELECT * FROM gallery WHERE contexto = 'main'";
		$query = $this->pdo->prepare($sql);
		$rs = $query->execute();
		if($rs!==false){
			$galleries = $query->fetchAll();
			require $this->adminviews."list-galleries.php";				
		}
		$this->footer_admin($lang);
	}

	public function showImages($lang="es", $id){

		$this->header_admin($lang);
		$gallery = $this->getGalleryById($id);
		$sql = "SELECT * FROM gallery_image	WHERE gallery_id = :id AND imagen != 'AM_FotosHome_Fondo.png'";
		$query = $this->pdo->prepare($sql);
		$query->bindParam(':id', $id, \PDO::PARAM_INT);
		$rs = $query->execute();
		if($rs !==false){
			$images = $query->fetchAll(\PDO::FETCH_ASSOC);
			
			$url = ( $id == 1 )?"/assets/images/galeria/":"/assets/images/press/{$gallery['slug']}/";
			
			if( $gallery['slug'] == 'home'){
				$url = "/assets/images/".$gallery['slug']."/";
			}



			require $this->adminviews."view-image.php";
		}
		$this->footer_admin($lang);
	}

	public function addImage($lang="es" , $id_gallery = 0){

		if( $id_gallery != 0){
			$this->header_admin($lang);

			$galleries = $this->getGalleries();
			$context = "";
			foreach ($galleries as $gallery) {
				$context .= "<option value=\"{$gallery['nombre']}\">{$gallery['nombre']}</option>";
			}

			require $this->adminviews."add-image.php";
			$this->footer_admin($lang);
		}
	}

	private function getGalleries(){

		$sql = "SELECT id, nombre, contexto, slug FROM gallery";
		$query = $this->pdo->prepare($sql);
		$rs = $query->execute();
		if( $rs !== false)
			return $query->fetchAll(\PDO::FETCH_ASSOC);
	}

	private function getGalleryById($id){

		$sql = "SELECT * FROM gallery WHERE id = :id";
		$query = $this->pdo->prepare($sql);
		$query->bindParam(':id', $id, \PDO::PARAM_INT);
		$rs = $query->execute();
		if($rs)
			return $query->fetch(\PDO::FETCH_ASSOC);
	}

	public function saveImageAction($lang = "es"){
		 if( !empty($_POST) ){
			if($_POST['gallery_id'] == '1'){
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
						$path=__DIR__."/../assets/images/galeria/". $_FILES['imagen']["name"];
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
						$path=__DIR__."/../assets/images/galeria/". $_FILES['imagen_thumbnail']["name"];
						$move = move_uploaded_file($_FILES['imagen_thumbnail']["tmp_name"],$path);

						if(!$move){
							throw new Exception("Error al mover el archivo", 1);
						}
					}
				}


				$gallery_id = $_POST['gallery_id'];
				$sql = 'INSERT INTO gallery_image (gallery_id,imagen,thumb) 
				             VALUES              (:gallery_id,:imagen,:thumb);
				       ';
				$query = $this->pdo->prepare($sql);
				$query->bindParam(':gallery_id', $gallery_id);
				$query->bindParam(':thumb', $_FILES['imagen_thumbnail']['name']);
				$query->bindParam(':imagen', $_FILES['imagen']['name']);
				$newImagen = $query->execute();
				if( $newImagen != false ){
					header("Location: /panel/gallery/list");
				}
			}elseif($_POST['gallery_id'] == '62'){
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
						$path=__DIR__."/../assets/images/home/". $_FILES['imagen']["name"];
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
						$path=__DIR__."/../assets/images/home/". $_FILES['imagen_thumbnail']["name"];
						$move = move_uploaded_file($_FILES['imagen_thumbnail']["tmp_name"],$path);

						if(!$move){
							throw new Exception("Error al mover el archivo", 1);
						}
					}
				}


				$gallery_id = $_POST['gallery_id'];
				$sql = 'INSERT INTO gallery_image (gallery_id,imagen,thumb) 
				             VALUES              (:gallery_id,:imagen,:thumb);
				       ';
				$query = $this->pdo->prepare($sql);
				$query->bindParam(':gallery_id', $gallery_id);
				$query->bindParam(':thumb', $_FILES['imagen_thumbnail']['name']);
				$query->bindParam(':imagen', $_FILES['imagen']['name']);
				$newImagen = $query->execute();
				if( $newImagen != false ){
					header("Location: /panel/plain/list");
				}
			}else{		// En caso de que se quiera agregar una nueva imagen de prensa...
				$gallery = $this->getGalleryById($_POST['gallery_id']);
				//print_r($gallery);
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
						$path=__DIR__."/../assets/images/press/".$gallery['slug']."/".$_FILES['imagen']["name"];
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
						$path=__DIR__."/../assets/images/press/".$gallery['slug']."/".$_FILES['imagen_thumbnail']["name"];
						$move = move_uploaded_file($_FILES['imagen_thumbnail']["tmp_name"],$path);

						if(!$move){
							throw new Exception("Error al mover el archivo", 1);
						}
					}
				}


				$gallery_id = $_POST['gallery_id'];
				$sql = 'INSERT INTO gallery_image (gallery_id,imagen,thumb) 
				             VALUES              (:gallery_id,:imagen,:thumb);
				       ';
				$query = $this->pdo->prepare($sql);
				$query->bindParam(':gallery_id', $gallery_id);
				$query->bindParam(':thumb', $_FILES['imagen_thumbnail']['name']);
				$query->bindParam(':imagen', $_FILES['imagen']['name']);
				$newImagen = $query->execute();
				if( $newImagen != false ){
					header("Location: /panel/gallery/$gallery_id");
				}
			}	
				
		 }
	}

	public  function remove( $lang = "es", $id ){
		
		$sql = 'DELETE FROM gallery_image WHERE id = :id LIMIT 1;';
		$query = $this->pdo->prepare($sql);
		$query->bindParam(':id',$id, \PDO::PARAM_INT);
		if( $query->execute() ){
			header("Location: {$_SERVER['HTTP_REFERER']}");
		}
	}

}