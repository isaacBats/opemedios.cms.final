<?php 


class AdminFontTV extends Controller{

	public function add(){

		$this->header_admin('Agregar fuente TV - ' );
		require $this->adminviews . "addFontTV.php";
		$this->footer_admin();
	}

	public function save(){

		print_r($_POST);
	}
}