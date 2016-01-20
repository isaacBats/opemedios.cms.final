<?php 

	
	/**
	* 
	*/
	class Gallery extends Controller
	{
		
		function __construct()
		{
			
		}

		public function showGallery( $lang = "en" ){
			$this->header( $lang );
		}
	}

?>