<?php 

class AdminSeccion extends Controller{

	private $sectionRepository;
	private $fuente;

	public function __construct()
	{
		$this->sectionRepository 	= new SeccionRepository();
	}

	public function getSectionsByFontId ( $id ){
		
		$sections = null;
		if( isset( $_SESSION['admin'] ) ){
			$sections = $this->sectionRepository->getByFontId( $id );
			header('Content-type: text/json');
	        echo json_encode($sections);		
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
		
	}

	
}