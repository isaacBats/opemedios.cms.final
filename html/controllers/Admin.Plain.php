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
			
			$idHome = 0;
			$idGallery = 0;
			foreach ($rows as $r) {
				
				if($r['slug'] == 'home'){
					$idHome = $r['id'];
					$queryGallery = $this->pdo->prepare("SELECT id FROM gallery WHERE slug like '{$r['slug']}'");
					if( $queryGallery->execute() ){
						$idGallery = $queryGallery->fetch(\PDO::FETCH_ASSOC);						
					}
				}
			}

			require $this->adminviews . "list-pages.php";
		}
		$this->footer_admin();
	}
	
	/**
	 * Edit a page
	 * @return A View
	 */
	public function editPageAction($lang = "es", $id){
		$this->header_admin($lang);

		$query = $this->pdo->prepare("SELECT * FROM pages WHERE id = :id");
		$query->bindParam(":id", $id, \PDO::PARAM_INT);

		if( $query->execute() ){
			$page = $query->fetch(\PDO::FETCH_ASSOC);
			require $this->adminviews . "edit-page.php";
		}

		$this->footer_admin($lang);

	}

	/**
	 * Update a page
	 */
	public function updatePage(){

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

	        $_POST['imagen'] = $_FILES['imagen']['name'];
	        if( !$this->put($_POST) ){
	            echo "Error al actualizar el producto";
	        }else{
	            header("Location: /panel/plain/list");
	        }        

	    }else{
	        if( !$this->put($_POST) ){
	            echo "Error al actualizar el producto";
	        }else{
	            header("Location: /panel/plain/list");
	        }
	    }		
	}

	/**
	 * Update a row in data base
	 * @param  array  $page the contend a page
	 * @return boolean true if updated row
	 */
	private function put($page = []){
		$sql = "UPDATE pages SET titulo 		= :titulo,
								 titulo_en		= :titulo_en,
								 slug			= :slug,
								 contenido  	= :contenido,
								 contenido_en	= :contenido_en,
								 imagen			= :imagen,
								 comentario 	= :comentario,
								 coment 		= :coment
						WHERE	 id				= :id
						LIMIT 1;
		";

		$query = $this->pdo->prepare($sql);

		$query->bindParam(":titulo", $page['titulo'], \PDO::PARAM_STR);
		$query->bindParam(":titulo_en", $page['titulo_en'], \PDO::PARAM_STR);
		$query->bindParam(":slug", $page['slug'], \PDO::PARAM_STR);
		$query->bindParam(":contenido", $page['contenido'], \PDO::PARAM_STR);
		$query->bindParam(":contenido_en", $page['contenido_en'], \PDO::PARAM_STR);
		$query->bindParam(":imagen", $page['imagen'], \PDO::PARAM_STR);
		$query->bindParam(":comentario", $page['comentario'], \PDO::PARAM_STR);
		$query->bindParam(":coment", $page['coment'], \PDO::PARAM_STR);
		$query->bindParam(":id", $page['id'], \PDO::PARAM_STR);

		return $query->execute();

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
				$imagen  = "default.jpg";
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

	public function remove($lang="es"){

        if( !empty($_POST) ){
            $resultado = new stdClass();
            $sql = "DELETE FROM pages WHERE id = :id";
            $query = $this->pdo->prepare($sql);
            $query->bindParam(':id', $_POST['id_borrar'], \PDO::PARAM_INT);
            $rs = $query->execute();
            $resultado->mensaje = $rs;
            if($rs!=false){
                $resultado->exito = true;
            }
            else{
                $resultado->exito = false;
            }
            header('Content-type: text/json');
            echo json_encode($resultado); 
        }
    }

    public function viewPageAction( $lang = "es", $id){

        // $this->header_admin();

        // $query = $this->pdo->prepare( "SELECT * FROM pages WHERE id = $id;" );

        // if($query->execute()){
        //     $page = $query->fetch(\PDO::FETCH_ASSOC);
        //     require $this->adminviews . "view-page.php";
        // }

        // $this->footer_admin();
        
        if( $id == "about-us" ){
        	header("Location: /acerca-de/quienes-somos");
        }elseif( $id == "factory-alfonso-marina" ){
        	header("Location: /acerca-de/fabrica-alfonso-marina");
        }elseif( $id == "product-care" ){
        	header("Location: /catalog/product-care");
        }elseif( $id == "home"){
        	header("Location: /");
        }else{
			header("HTTP/1.0 404 Not Found");
			$this->header( $lang, "404 Not Found - " );
			require_once($this->views.'404.php' );
			$this->footer( $lang );
        }
    }


}