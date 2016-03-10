<?php 

require (__DIR__."/../models/Page.php");

Class AdminPlain extends Controller{

	public function editWhoAreWeAction(){
		$this->header_admin();
		require $this->adminviews . "edit-who-are-we.php";
		$this->footer_admin();

	}

	public function createPageAction(){

		$this->header_admin();
		require $this->adminviews . "add-page.php";
		$this->footer_admin();
	}

	public function savePageAction(){

		if( $_POST['titulo'] != "" && $_POST['title'] != "" ){
			
			$page = new Page($_POST['titulo']);
			$page->setTitle($_POST['title']);

			echo $page->getTitulo();
		}
	}


}