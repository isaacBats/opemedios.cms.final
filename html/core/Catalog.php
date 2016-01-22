<?php 

class Catalog extends Controller{



	//  PLAIN
	public function menuCatalog( $lang, $estilo = ""){
			$tipos = $this->tipos($estilo);
			
			/*echo "<pre>";
			print_r($tipos);*/

			require $this->views."header-catalogo.php";

	}
	
	private function tipos($estilo = ""){
		if( $estilo != ""){
			$sql = "SELECT distinct(tipo) FROM product WHERE estilo = :estilo ";
		}else{
			$sql = "SELECT distinct(tipo) FROM product";
		}

		$query = $this->pdo->prepare($sql);
		$query->bindParam(':estilo', $estilo);
		$rs = $query->execute();
		if($rs!==false){
			$nr = $query->rowCount();
			if( $nr > 0 ){
				$tipos = $query->fetchAll(PDO::FETCH_COLUMN);
				$tiposOut = array();
				foreach( $tipos as $t ){
					array_push( $tiposOut , array( $t => $this->grupos( $estilo , $t ) )  );
				}
				return $tiposOut;
			}
		}
	}

	private function grupos($estilo = "" , $tipo = ""){
		if( $estilo != ""){
			$sql = "SELECT distinct(grupo) FROM product WHERE estilo = :estilo && tipo LIKE '{$tipo}'";
		}else{
			$sql = "SELECT distinct(grupo) FROM product WHERE tipo LIKE '{$tipo}' ";
		}
		
		$query = $this->pdo->prepare($sql);
		$query->bindParam(':estilo', $estilo);
		$rs = $query->execute();
		if($rs!==false){
			$nr = $query->rowCount();
			if( $nr > 0 ){
				$grupos = $query->fetchAll(PDO::FETCH_COLUMN);
				return $grupos;
			}
		}
	}	



	public function productCare($lang = "es"){

		$this->updateProducts();
		$this->addBread( array(  "label"=>$this->trans( $lang  , "Cuidado de productos" , "Product Care") ));
		$this->header( $lang );
		require $this->views."product-care.php";
		$this->footer( $lang );
	}

	public function updateProducts(){
			$images = scandir( "images/product" );
			foreach ($images as $image) {
				$ur = explode( "_", $image );
				$sql = "UPDATE `amarinados`.`product` SET `imagen` = '{$image}' WHERE `product`.`ur` LIKE '{$ur[0]}';";
				$query = $this->pdo->prepare($sql);
				$rs = $query->execute();
			}
			
			exit;

	}

	//  FINISHES

	private function codigos(){
		$sql = "SELECT codigo FROM acabados";
		$query = $this->pdo->prepare($sql);
		$rs = $query->execute();
		if($rs!==false){
			$nr = $query->rowCount();
			if( $nr > 0 ){
				$codigos = $query->fetchAll(PDO::FETCH_COLUMN);
				return $codigos;
			}
		}
	}

	function navegacion($lang="es",$codigo){
		
		$codigos = $this->codigos();

		/************************************************************************************/
		$key_actual = array_search($codigo, $codigos);	
		$key_final = key( array_slice( $codigos, -1, 1, TRUE ) );
		/************************************************************************************/

		$anterior = ( ($key_actual-1) < 0 ) ? '<a href="'.$codigos[$key_final].'">'.$this->trans($lang,'Anterior','Previous').'</a>' : '<a href="'.$codigos[$key_actual-1].'">'.$this->trans($lang,'Anterior','Previous').'</a>';
		$siguiente = ( ($key_actual+1) > $key_final ) ? '<a href="'.$codigos[0].'">'.$this->trans($lang,'Siguiente','Next').'</a>' : '<a href="'.$codigos[$key_actual+1].'">'.$this->trans($lang,'Siguiente','Next').'</a>';
		
		$html =  $anterior.' | '.$siguiente;
		
		return $html;
	}

	public function detailFinish($lang,$codigo){
		

 		$sql = "SELECT * FROM acabados WHERE codigo = :codigo";
		$query = $this->pdo->prepare($sql);
		$query->bindParam(':codigo', $codigo);
		$rs = $query->execute();
		if( $rs ){
			$acabado = $query->fetch();
		}

		$this->addBread( array( "label"=> $acabado['codigo'].' '.$acabado['nombre'] ) );
 		$this->header( $lang );
		
		require $this->views."detalle-finish.php";
		
		$this->footer($lang);
	}
	

	public function showFinishes($lang){
		$this->addBread( array( "label"=> "Prensa" ) );
 		$this->header( $lang );

 		$sql = "SELECT * FROM acabados";
 		$query = $this->pdo->prepare($sql);
		$rs = $query->execute();
		if($rs!==false){
			$nr = $query->rowCount();
			if( $nr > 0 ){
				$acabados = $query->fetchAll();
				$count = 0;
				require $this->views."acabados.php";
			}
		}
 		
 		$this->footer($lang);

	}




	//  CATALOG


	public function showAll( $lang ){

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




	
	public function showListProducts($lang="es" ,$slug ){
		
		$html = "";

		$sqlCatalogo = "select * from product WHERE estilo like '%".strtolower($slug)."%' GROUP by grupo ";
		$queryCatalogo = $this->pdo->prepare($sqlCatalogo);
		$rsCatalogo = $queryCatalogo->execute();
		if ($lang == "es"){
			if( $rsCatalogo !== false ){
				$pr = $queryCatalogo->rowCount();
				if($pr > 0){
					$catalogo = $queryCatalogo->fetchAll();
					foreach ($catalogo as $c) {
						$html .= '
								<div class="product-list">
									<h2>'.$c['tipo'].'</h2>
									<a href="'.$this->url($lang , "/product/".$c["id"] ).'">
										<img src="/images/'.$c['imagen'].'"><br>
										'.$c['nombre'].'
									</a>
								</div><!-- .product-list -->
								';
					}
				}


			}
		}else if ($lang == "en") {
			if( $rsCatalogo !== false ){
				$pr = $queryCatalogo->rowCount();
				if($pr > 0){
					$catalogo = $queryCatalogo->fetchAll();
					foreach ($catalogo as $c) {
						$html .= '
								<div class="product-list">
									<h2>'.$c['tipo'].'</h2>
									<a href="'.$this->url($lang , "/product/".$c["name"] ).'">
										<img src="/images/'.$c['imagen'].'"><br>
										'.$c['name'].'
									</a>
								</div><!-- .product-list -->
								';
					}
				}


			}
		}
		else
		{
			$html .= 'No existe lang';
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