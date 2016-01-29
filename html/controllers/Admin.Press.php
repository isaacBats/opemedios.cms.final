<?php 

class AdminPress extends Controller{

	public function showListPress(){

		$this->header_admin($lang="es");
		
		$sql = "SELECT * FROM gallery WHERE contexto in ('brochure', 'publicity')";
		$query = $this->pdo->prepare($sql);
		$rs = $query->execute();
		if($rs!==false){
			$press = $query->fetchAll();
			require $this->adminviews."list-press.php";				
		}
		$this->footer_admin($lang="es");
	}
}