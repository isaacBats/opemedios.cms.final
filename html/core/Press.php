<?php 

/**
 * 
 */
 class Press extends Controller
 {
 	

 	public function showAll( $lang ){
 		$this->addBread( array( "label"=> "Prensa" ) );
 		$this->header( $lang );

 		require $this->views."press.php";
 	}

 	public function detail( $lang , $slug ){
 			
 		$this->addBread( array( "label"=> "Prensa" , "url" => "/press") );
 		$this->addBread( array( "label"=> $slug ) );
 		$this->header( $lang );
 		require $this->views."press-detail.php";

 	}

 } 

 ?>