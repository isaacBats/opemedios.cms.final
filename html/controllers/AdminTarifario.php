<?php 

/**
* Controlador de Tarifario 
* @author Isaac Daniel < @codeisaac >
*/
class AdminTarifario extends Controller
{
	
	public function tarifariosAdmin()
	{
		if( isset( $_SESSION['admin'] ) ){
			
			$this->header_admin( 'Bloque de Noticias - ' );
				require $this->adminviews . 'tarifarioAdminView.php';
			$this->footer_admin(  );
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}
}