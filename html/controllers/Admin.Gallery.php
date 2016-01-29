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
}