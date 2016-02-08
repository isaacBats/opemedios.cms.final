<?php 

class AdminPress extends Controller{

	public function showListPress($lang="es"){

		$this->header_admin($lang);
		
		$sql = "SELECT * FROM gallery WHERE contexto in ('brochure', 'publicity')";
		$query = $this->pdo->prepare($sql);
		$rs = $query->execute();
		if($rs!==false){
			$press = $query->fetchAll();
			require $this->adminviews."list-press.php";				
		}
		$this->footer_admin($lang);
	}

	public function addGalleryAction($lang="es"){
		$this->header_admin($lang);
		require $this->adminviews."add-gallery.php";
		$this->footer_admin($lang);
	}

	public function saveGalleryAction($lang="es"){
		if(!empty($_POST)){
			if($this->newPressDirectory($_POST['slug'])){
				$pathname = __DIR__."/../assets/images/press/".$_POST['slug']."/";
				$extensiones_permitidas = array("jpg", "jpeg", "gif", "png","JPG","JPEG","PNG");
				$explode = explode(".", $_FILES['imagen']["name"]);
				$extension = end($explode);
				if ((($_FILES['imagen']["type"] == "image/png")
					|| ($_FILES['imagen']["type"] == "image/jpeg")
					|| ($_FILES['imagen']["type"] == "image/jpg")
					|| ($_FILES['imagen']["type"] == "image/PNG"))
					&& in_array($extension, $extensiones_permitidas)){
					if ($_FILES['imagen']["error"] > 0){
						echo "ERROR: " . $_FILES['imagen']["error"] . "<br>";
					}
					else{
						$path = __DIR__."/../assets/images/press/cover/".$_FILES['imagen']["name"];
						$move = move_uploaded_file($_FILES['imagen']["tmp_name"],$path);
						if(!$move){
							throw new Exception("Error al mover el archivo", 1);
						}
					}
				}
				$sql = "INSERT INTO gallery (nombre, slug, contexto, imagen)
								   VALUES  (:nombre, :slug, :contexto, :imagen)";
				$query = $this->pdo->prepare($sql);
				$query->bindParam(':nombre', $_POST['nombre']);
				$query->bindParam(':slug', $_POST['slug']);
				$query->bindParam(':contexto', $_POST['contexto']);
				$query->bindParam(':imagen', $_FILES['imagen']['name']);
				$newGallery = $query->execute();
				if($newGallery != false){
					header("Location: /panel/press/list");
				}



			}
		}
	}

	private function newPressDirectory($slug){
		if(!empty($slug)){
			if(file_exists(__DIR__."/../assets/images/press/".$slug)){
				return true;
			}else{
				$pathname = __DIR__."/../assets/images/press/".$slug;
				if(!mkdir($pathname, 0777)){
					die('Fallo al crear las carpetas...');
					return false;
				}else{
					return true;
				}
			}
		}
	}
}