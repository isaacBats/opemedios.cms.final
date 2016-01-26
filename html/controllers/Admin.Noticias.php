<?php 

class AdminNoticias extends Controller{

	public function showNews(){
		$this->header_admin($lang="es");
		echo 'Noticias';
		$this->footer_admin($lang="es");
	}
	
}

?>