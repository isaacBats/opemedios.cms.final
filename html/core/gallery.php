<?php 

	
	/**
	* 
	*/
	class Gallery extends Controller
	{
		
		

		public function showGallery( $lang = "en" , $slug ){

			if( $lang == "es"){
				$this->addBread( array("url"=>"/gallery" ,"label" => "Galeria" ));
				$this->addBread( array( "label" => $slug ) );

						
			}else{
				$this->addBread( array("url"=>"/gallery" ,"label" => "Gallery" ));
				$this->addBread( array( "label" => $slug ) );
			}


			$this->addBread(array("label"=>"Noticias"));
			
			$this->header( $lang );


		}

		public function displayTumbs(){
			$sql = "SELECT * FROM gallery_image WHERE gallery_id = 1 ";
			
			$query = $this->pdo->prepare($sql);
			$rs = $query->execute();
			if($rs!==false){
				$nr = $query->rowCount();
				if( $nr > 0 ){
					$images = $query->fetchAll();
					$count = 0;
					foreach ($images as $image) {
						$count++;
						echo '<li style="float:left;">
							<a href="/images/galeria/'.$image["imagen"].'" 
							original="/images/galeria/'.$image["imagen"].'" 
							href="#'.$count.'" rel="history">
							<img src="/images/galeria/'.$image["thumb"].'" alt="image'.$count.'" /></a>
							</li>'."\n";
					}
				}
			}
		}

		public function allGalleries( $lang = "en" ){

			if( $lang == "es"){
				$this->addBread( array("url"=>"/gallery" , "label" => "Galeria"));
			}else{
				$this->addBread( array("url"=>"/gallery" , "label" => "Gallery"));	
			}
			$this->header( $lang );

			
			require $this->views."gallery.php";
			$this->footer( $lang );
		}
	}

?>