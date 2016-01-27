<?php 

class AdminNoticias extends Controller{

	public function showForm(){
		$this->header_admin($lang="es");
		$html = '';
          echo $html;
          $this->footer_admin($lang="es");
	}

	public function showNews(){
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
	
}

?>