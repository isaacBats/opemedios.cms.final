<?php 

	
	/**
	* 
	*/
	class Gallery extends Controller
	{
		
		

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
							<a href="/assets/images/galeria/'.$image["imagen"].'" 
							original="/assets/images/galeria/'.$image["imagen"].'" 
							href="#'.$image["id"].'" rel="history" >
							<img src="/assets/images/galeria/'.$image["thumb"].'" alt="image'.$count.'" data-id="'.$image["id"].'"/></a>
							</li>'."\n";
					}
				}
			}
		}

		/**
		 * Return related Products
		 * 
		 * @param  string $imagen Image name
		 * @return Array[]        Return result set of query
		 */
		private function getRelatedProductsId($imagen){

			$sql = "SELECT pro.product_id  
					FROM gallery_image_product as pro, 
					     gallery_image as img 
					WHERE img.imagen like :imagen 
					AND pro.gallery_image_id = img.id;
				   ";

			$query = $this->pdo->prepare($sql);
			$query->bindParam(':imagen',$imagen, \PDO::PARAM_STR);
			$rs = $query->execute();
			if($rs){
				return $query->fetchAll(\PDO::FETCH_ASSOC);
			}
		}

		/**
		 * showing products
		 * 
		 * @param  string $lang   language
		 * @param  string $imagen image name 
		 */
		public function showRelatedAction($lang = "es", $imagen){

			//$("#slideshow").find("img").attr("src").split("/").pop()

			$related = $this->getRelatedProductsId($imagen);
			if( !empty($related) ){
				$productsID = array_column($related, 'product_id');
				$products = $this->getRelated($productsID);
				
				// require $this->views."relacionados.php";
				header('Content-type: text/json');
				echo json_encode($products);
			}
		}

		/**
		 * Return detail of related product
		 * 
		 * @param  Array[] $productsID Id's of related products
		 * @return Array[]             Detail of related products
		 */
		private function getRelated($productsID){
			$where = "WHERE id IN (";
			$where .= implode(",", $productsID);
			$where .=");";

			$query = $this->pdo->prepare("SELECT ur, nombre, imagen FROM product $where");
			$rs = $query->execute();
			if($rs){
				return $query->fetchAll(\PDO::FETCH_ASSOC);
			}
		}

		public function allGalleries( $lang = "en" ){

			if( $lang == "es"){
				$this->addBread( array("url"=>"/gallery" , "label" => "Galeria"));
			}else{
				$this->addBread( array("url"=>"/gallery" , "label" => "Gallery"));	
			}
			$this->header( $lang , true );

			

			require $this->views."gallery.php";
			$this->footer( $lang );
		}
	}

?>