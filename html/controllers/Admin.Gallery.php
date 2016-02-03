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
		print_r($galleries);
		require $this->adminviews."add-image.php";
		$this->footer_admin($lang);
		//Query para sacar el nombre de la galeria y el nombre de la imagen
		//SELECT g.nombre, gi.imagen 
		//FROM gallery_image gi 
		//INNER JOIN gallery g 
		//ON gi.gallery_id = g.id 
		//WHERE g.id = 1;

	}

	private function getGalleries(){

		$sql = "SELECT id, nombre, contexto FROM gallery";
		$query = $this->pdo->prepare($sql);
		$rs = $query->execute();
		if( $rs !== false)
			return $query->fetchAll(\PDO::FETCH_ASSOC);
	}

}