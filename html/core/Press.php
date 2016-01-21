<?php 

/**
 * 
 */
 class Press extends Controller
 {
 	public function showAll( $lang ){
 		$this->addBread( array( "label"=> "Prensa" ) );
 		$this->header( $lang );

 		$sql = "SELECT * FROM gallery WHERE ";
 		$query = $this->pdo->prepare($sql);
		$rs = $query->execute();
		if($rs!==false){
			$nr = $query->rowCount();
			if( $nr > 0 ){
				$images = $query->fetchAll();
				$count = 0;
				foreach ($images as $image) {
					$count++;
				}
			}
		}
 		require $this->views."press.php";

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

 	public function detail( $lang , $slug ){
 		

 		$this->addBread( array( "label"=> "Prensa" , "url" => "/press") );
 		$this->addBread( array( "label"=> $slug ) );
 		$this->header( $lang );
 		require $this->views."press-detail.php";
 		$this->footer( $lang );

 	}

 } 

 ?>