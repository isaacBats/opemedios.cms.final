<?php 

class Catalog extends Controller{
	
	public function productCare($lang = "es"){
		$this->addBread( array(  "label"=>$this->trans( $lang  , "Cuidado de productos" , "Product Care") ));
		$this->header( $lang );
		require $this->views."product-care.php";
		$this->footer( $lang );
	}


	//  ESTO SIRVE PARA lEER LAS CARPETAS Y PONER LAS IMAGENES CORRECTAS
	// public function updateProducts(){
	// 		$images = scandir( "images/product" );
	// 		foreach ($images as $image) {
	// 			$ur = explode( "_", $image );
	// 			$sql = "UPDATE `amarinados`.`product` SET `imagen` = '{$image}' WHERE `product`.`ur` LIKE '{$ur[0]}';";
	// 			$query = $this->pdo->prepare($sql);
	// 			$rs = $query->execute();
	// 		}
	// 		exit;
	// }

	
	//  CATALOG


	public function showAll( $lang ){

		$this->addBread( array("label" => $this->trans($lang , "Catalogo" , "Catalog") ) );

		$this->header( $lang );
		$sql = "SELECT * FROM product LIMIT 50";
 		$query = $this->pdo->prepare($sql);
		$rs = $query->execute();
		if($rs!==false){
			$nr = $query->rowCount();
			if( $nr > 0 ){
				$productList = $query->fetchAll();
				$count = 0;
				require $this->views."catalog.php";
			}
		}
		$this->footer( $lang );
	}

	public function showLifestyles($lang="es"){

		$html = "";

		if ($lang == "es"){	
			$this->addBread( array( "url"=>"/catalog", "label"=>"Catalogo" ));
			$this->addBread( array( "label"=>"Estílo de vida" ));

			
		}else if($lang == "en") {
			$html .= 'Devuelve en inglés';
			$this->addBread( array( "url"=>"/catalog", "label"=>"Catalog" ));
			$this->addBread( array( "label"=>"Lifestyles" ));
		}else{
				$html .= 'No existe lang';
		}	
			$this->header( $lang );
			require $this->views."lifestyle.php";
			$this->footer( $lang );
	}
	
	public function showListProducts($lang="es" , $style = "", $type = "" , $group  = ""){

		$this->addBread( array("label" => $this->trans($lang , "Catalogo" , "Catalog") , "url" => "/catalog/lifestyle") );

		if( $style != "casual" && $style != "metro" ){
			$group  = $type ;
			$type = $style ; 
			$this->addBread( array(  "label"=>$this->trans($lang , "Catalogo" , "Catalog" ), "url"=> "/catalog/lifestyle"  ) );
			if( $type != "")
				$this->addBread( array(  "label"=>ucwords(strtolower($type)) , "url"=> "/catalog/".implode( "/" , array( $style , $type )  ) ) );
			if( $group != "")
				$this->addBread( array(  "label"=>ucwords(strtolower($group))  ) );	
			
		}else{
			$this->addBread( array(  "label"=>ucwords(strtolower($style)), "url"=> "/catalog/".$style  ) );
			if( $type != "")
				$this->addBread( array(  "label"=>ucwords(strtolower($type)) , "url"=> "/catalog/".implode( "/" , array( $style , $type )  ) ) );
			if( $group != "")
				$this->addBread( array(  "label"=>ucwords(strtolower($group))  ) );	
		}
		
		

		$html = "";
		$style =  $style == "casual" || $style == "metro" ? "estilo LIKE '{$style}' " :"1=1 ";
		$type =  $type != ""?"tipo LIKE '{$type}' ":" 1=1 ";
		$group =  $group != ""?"LOWER( grupo ) LIKE '%".str_replace("-" , " " , urldecode($group))."%' ":" 1=1 ";
		$where = implode( " AND " , array( $style , $type ,  $group ) );
		
		

		$sqlCatalogo = "SELECT * FROM product WHERE {$where} LIMIT 40";
		$queryCatalogo = $this->pdo->prepare($sqlCatalogo);
		$rsCatalogo = $queryCatalogo->execute();
		if( $rsCatalogo !== false ){
			$pr = $queryCatalogo->rowCount();
			if($pr > 0){
				$catalogo = $queryCatalogo->fetchAll();
				$html .= '<div id="content-press">';
				$html .= '<p class="tituloSeccion">'.ucfirst( end( $this->bread )["label"] ).'</p>';

				foreach ($catalogo as $product) {
					$html .= '
							<article class="item4Col">
						        <a href="'.$this->url($lang, "/product/".$product['ur']).'">
						            <img style="width: 100%" 
						            alt="'.$product["nombre"].'" 
						            src="/images/product/'.$product["imagen"].'">
						            <br class="clear">
						            <br class="clear">
						            <p>
						            '.$product["nombre"].'
						            </p>
						        </a>
						    </article>
							';

				}
				$html .= "</div><!-- .product-list -->";
			}


		}
		
		$this->header( $lang );
		echo $html;
		$this->footer( $lang );
	}

	// public function detailProduct( $lang = "es" , $slug){
	// 	$this->header( $lang );

	// 	if( $lang == "es"){
	// 		echo "producto español";
	// 	}else{
	// 		echo "producto ingles";
	// 	}
	
	/*
	| by adanzilla ...
	 */
	private function idProducts(){
		$sql = "SELECT id FROM products";
		$query = $this->pdo->prepare($sql);
		$rs = $query->execute();
		if($rs!==false){
			$nr = $query->rowCount();
			if( $nr > 0 ){
				$slugs = $query->fetchAll(PDO::FETCH_COLUMN);
				return $slugs;
			}
		}
	}


	/*
	| by adanzilla ...
	 */
	function navProduct($lang="es",$slug){
		
		$slugs = $this->idProducts();

		/************************************************************************************/
		$key_actual = array_search($slug, $slugs);	
		$key_final = key( array_slice( $slugs, -1, 1, TRUE ) );
		/************************************************************************************/

		$anterior = ( ($key_actual-1) < 0 ) ? '<a href="'.$slugs[$key_final].'">'.$this->trans($lang,'Anterior','Previous').'</a>' : '<a href="'.$slugs[$key_actual-1].'">'.$this->trans($lang,'Anterior','Previous').'</a>';
		$siguiente = ( ($key_actual+1) > $key_final ) ? '<a href="'.$slugs[0].'">'.$this->trans($lang,'Siguiente','Next').'</a>' : '<a href="'.$slugs[$key_actual+1].'">'.$this->trans($lang,'Siguiente','Next').'</a>';
		
		$html =  $anterior.' | '.$siguiente;
		
		return $html;
	}

	function detailProduct($lang="es", $slug){
		
		if ( !empty($slug) ){

			$this->addBread( array(  "label"=>$this->trans( $lang  , "Catalogo" , "Catalog") , "url"=>"" ) );
			$this->addBread( array(  "label"=>$this->trans( $lang  , "Productos" , "Products") , "url"=>"" ) );

			
			$sql = "SELECT * FROM product WHERE ur LIKE '$slug'";
			$query = $this->pdo->prepare($sql);
			$rs = $query->execute();
			if( $rs ){
				$product = $query->fetch();
				$this->addBread( array(  "label"=>ucwords(strtolower($this->trans( $lang  , $product["tipo"] , $product["_type"]))), "url"=>"" ) );
				$this->addBread( array(  "label"=>ucwords(strtolower($this->trans( $lang  , $product["grupo"] , $product["_group"]))) , "url"=>"" ) );
				$this->addBread( array(  "label"=>ucwords(strtolower($this->trans( $lang  , $product["uso"] , $product["_use"]))) , "url"=>"" ) );



				$this->header( $lang );
				require $this->views."detalle-producto.php";
			}
		}		
		$this->footer( $lang );
	}


	

	

}