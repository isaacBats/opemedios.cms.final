<?php 

/**
 * 
 */
 class Press extends Controller
 {
 	

 	public function showAll( $lang ){
 		$this->addBread( array( "label"=> "Prensa" ) );
 		$this->header( $lang );
 	}

 } 

 ?>