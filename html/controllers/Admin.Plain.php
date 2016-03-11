<?php 

Class AdminPlain extends Controller{

	/**
	 * Show list of pages
	 * @return A View
	 */
	public function showAction(){

		$this->header_admin();

		$query = $this->pdo->prepare("SELECT id, titulo, slug FROM pages");
		
		if( $query->execute() ){
			$rows = $query->fetchAll(\PDO::FETCH_ASSOC);
			require $this->adminviews . "list-pages.php";
		}
		$this->footer_admin();
	}
	
	/**
	 * Edit a page
	 * @return A View
	 */
	public function editWhoAreWeAction(){
		$this->header_admin();
		require $this->adminviews . "edit-who-are-we.php";
		$this->footer_admin();

	}

	/**
	 * Show form for create a new page
	 * @return A View
	 */
	public function createPageAction(){

		$this->header_admin();
		require $this->adminviews . "add-page.php";
		$this->footer_admin();
	}

	/**
	 * Save Page in Data Base 
	 * @return [type] [description]
	 */
	public function savePageAction(){

		if( $_POST['titulo'] != "" && $_POST['title'] != "" ){			

			$sql = "INSERT INTO pages (titulo, titulo_en, slug, contenido, contenido_en, imagen, comentario, coment) VALUES(:titulo, :title, :slug, :contenido, :contend, :imagen, :comentario, :coment);";

			$query = $this->pdo->prepare($sql);
			$query->bindParam(':titulo', $_POST['titulo'], \PDO::PARAM_STR);
			$query->bindParam(':title',$_POST['title'], \PDO::PARAM_STR);
			$query->bindParam(':slug', $_POST['slug'], \PDO::PARAM_STR);
			$query->bindParam(':contenido', $_POST['contenido'], \PDO::PARAM_STR);
			$query->bindParam(':contend', $_POST['contend'], \PDO::PARAM_STR);
			if( $_FILES['imagen']['name'] != "" ){

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
                        $path=__DIR__."/../assets/images/". $_FILES['imagen']["name"];
                        $move = move_uploaded_file($_FILES['imagen']["tmp_name"],$path);

                        if(!$move){
                            throw new Exception("Error al mover el archivo", 1);
                        }
                    }
                }

				$query->bindParam(':imagen', $_FILES['imagen']['name'], \PDO::PARAM_STR);				
			}else{
				$imaigen  = "default.jpg";
				$query->bindParam(':imagen', $imagen, \PDO::PARAM_STR);
			}
			$query->bindParam(':comentario', $_POST['comentario'], \PDO::PARAM_STR);
			$query->bindParam(':coment', $_POST['coment'], \PDO::PARAM_STR);
			
			$newPage = $query->execute();
            if($newPage != false){
                header("Location: /panel/plain/list");
            }
		}
	}


}