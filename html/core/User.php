<?php 

/**
 * 
 */
 class User extends Controller
 {
 	

 	public function login( $lang ){
 		$this->addBread( array( "label"=> "Login" ) );
 		$this->header( $lang );

 		require $this->views."login.php";
 	}

 	public function register( $lang ){
 		$this->addBread( array( "label"=> "Register" ) );
 		$this->header( $lang );
 	}

 } 

 ?>