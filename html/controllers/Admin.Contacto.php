<?php 

class AdminContacto extends Controller{

	public function showContacts(){
		$this->header_admin($lang="es");
		echo 'Contactos';
		$this->footer_admin($lang="es");
	}
	
}

?>