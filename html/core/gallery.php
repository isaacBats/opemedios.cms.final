<?php 

	
	/**
	* 
	*/
	class Gallery extends Controller
	{
		
		function __construct()
		{
			
		}

		public function showGallery( $lang = "en" , $slug ){

			if( $lang == "es"){
				$this->addBread( array("url"=>"/gallery" ,"label" => "Galeria" ));
				$this->addBread( array( "label" => $slug ) );

						
			}else{
				$this->addBread( array("url"=>"/gallery" ,"label" => "Gallery" ));
				$this->addBread( array( "label" => $slug ) );
			}
			$this->header( $lang );
		}

		public function allGalleries( $lang = "en" ){

			if( $lang == "es"){
				$this->addBread( array("url"=>"/gallery" , "label" => "Galeria"));
			}else{
				$this->addBread( array("url"=>"/gallery" , "label" => "Gallery"));	
			}
			$this->header( $lang );
		}
	}

?>