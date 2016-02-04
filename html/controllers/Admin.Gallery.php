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

		$sql = "SELECT * FROM gallery_image	WHERE gallery_id = :id";
		$query = $this->pdo->prepare($sql);
		$query->bindParam(':id', $id, \PDO::PARAM_INT);
		$rs = $query->execute();
		if($rs !==false){
			$images = $query->fetchAll(\PDO::FETCH_ASSOC);
			$url = ( $id == 1 )?"/assets/images/galeria/":"/assets/images/press/";
			require $this->adminviews."view-image.php";
		}
		$this->footer_admin($lang);
	}

	public function addImage($lang="es"){

		$this->header_admin($lang);

		$galleries = $this->getGalleries();
		$context = "";
		foreach ($galleries as $gallery) {
			$context .= "<option value=\"{$gallery['nombre']}\">{$gallery['nombre']}</option>";
		}
		require $this->adminviews."add-image.php";
		$this->footer_admin($lang);
	}

	private function getGalleries(){

		$sql = "SELECT id, nombre, contexto FROM gallery";
		$query = $this->pdo->prepare($sql);
		$rs = $query->execute();
		if( $rs !== false)
			return $query->fetchAll(\PDO::FETCH_ASSOC);
	}

	private function getGalleryId($nombre){

		$sql = "SELECT id FROM gallery WHERE nombre = :nombre";
		$query = $this->pdo->prepare($sql);
		$query->bindParam(':nombre', $nombre, \PDO::PARAM_STR);
		$rs = $query->execute();
		if($rs)
			return $query->fetch(\PDO::FETCH_ASSOC);
	}

	public function saveImageAction($lang = "es"){
		 if( !empty($_POST) ){

		 	print_r($gallery_id = $this->getGalleryId($_POST['contexto'])); 
		 	print_r($gallery_id['id']);
			if($_POST['contexto'] == 'Gallery'){
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


				$gallery_id = $this->getGalleryId($_POST['contexto']);
				$sql = 'INSERT INTO gallery_image (gallery_id,imagen,thumb) 
				             VALUES              (:gallery_id,:imagen,:thumb);
				       ';
				$query = $this->pdo->prepare($sql);
				$query->bindParam(':gallery_id', $gallery_id['id']);
				$query->bindParam(':thumb', $_FILES['imagen_thumbnail']['name']);
				$query->bindParam(':imagen', $_FILES['imagen']['name']);
				$newImagen = $query->execute();
				if( $newImagen != false ){
					header("Location: /panel/gallery/list");
				}
			}	
				
		 }
	}

}