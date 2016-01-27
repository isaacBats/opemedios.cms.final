<?php 

class Admin extends Controller{
	public function dashboard(){
		header( "Location: ./panel/contacts/list");
	}
}
?>