<?php 

/**
 * 
 */
 class Press extends Controller
 {
 	

 	public function showAll( $lang ){
 		$this->addBread( array( "label"=> "Prensa" ) );
 		$this->header( $lang );

 		$sql = "SELECT * FROM gallery WHERE contexto != 'main' ";
 		$query = $this->pdo->prepare($sql);
		$rs = $query->execute();
		if($rs!==false){
			$nr = $query->rowCount();
			if( $nr > 0 ){
				$galleries = $query->fetchAll();
				$count = 0;
				require $this->views."press.php";
			}
		}
 		
 		$this->footer($lang);

 	}

 	public function createDB(){

 		$sql = "SELECT * FROM gallery WHERE contexto != 'main' ";
 		$query = $this->pdo->prepare($sql);
		$rs = $query->execute();
		if($rs!==false){
			$nr = $query->rowCount();
			if( $nr > 0 ){
				$galleries = $query->fetchAll();
				echo "<pre>";
				echo "INSERT INTO `gallery_image` (`id`, `gallery_id`, `imagen`, `thumb`) VALUES<br>";
				foreach ($galleries as $gal) {
					$images = scandir( "images/press/".$gal["slug"] );
					foreach( $images as $img ){
						if( strlen( $img ) > 2 ){
							echo  "(NULL,".$gal["id"].",\"".$gal["slug"]."/".$img."\" , \"\" ),<br>";
						}
					}
					
				}
				
			}
		}


 	}

 	
 	public function detail( $lang , $slug , $slug2 = ""){

 		$this->addBread( array( "label"=> $this->trans($lang , "Prensa" , "Press") , "url" => "/press") );


 		

 		if( $slug2 != "" ){

 			$this->addBread( array( "url" => "/press/".$slug, "label"=> ucfirst( $slug ) ) );
 			$this->addBread( array( "label"=> ucfirst( $slug2 ) ) );

 			$this->header( $lang );
	 		$sqlGallery = "SELECT * FROM gallery WHERE slug LIKE '".(($slug2!="")?$slug2:$slug)."' ";
	 		$queryGallery = $this->pdo->prepare($sqlGallery);
			$rs = $queryGallery->execute();
			$gallery = $queryGallery->fetchAll();
			
	 		$sql = "SELECT * FROM gallery_image WHERE gallery_id = ".$gallery[0]["id"];
			$query = $this->pdo->prepare($sql);
			$rs = $query->execute();
			if($rs!==false){
				$nr = $query->rowCount();
				if( $nr > 0 ){
					$images = $query->fetchAll();
					$count = 0;
					
				}
			}
	 		require $this->views."press-detail.php";
 		}else{

 			$this->addBread( array( "label"=> ucfirst( $slug ) ) );	
 			$this->header( $lang );
 			$sqlGallery = "SELECT * FROM gallery WHERE contexto LIKE '".$slug."' ";
	 		$queryGallery = $this->pdo->prepare($sqlGallery);
			$rs = $queryGallery->execute();
			$galleries = $queryGallery->fetchAll();
			$count = 0;
			require $this->views."press.php";

 		}
 		


 		
 		$this->footer( $lang );

 	}

 } 

 ?>