<?php 

class Catalog extends Controller{
	
	// Check numbers 
	private function nmb( $number ){
		return number_format(str_replace( ",",".", $number ),1);
	}

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

	public function removeProductFavorite($lang){

		$resultado = new stdClass();
		
		if( !empty($_POST) ){
			if( !isset($_SESSION['favoritos']) ){
				$_SESSION['favoritos'] = array();
			}
			
			if (($key = array_search($_POST['id'], $_SESSION['favoritos'])) !== false) {
			    unset($_SESSION['favoritos'][$key]);
			}

			$resultado->exito = true;
			$resultado->log = "Se removió el ID al contenedor de FAVORITOS";
			$resultado->mensaje = $this->trans($lang , 'Añadir a Favoritos' , 'Add to Favorites' );
		}
		else{
			$resultado->exito = false;
		}

		header('Content-type: text/json');
		echo json_encode($resultado);
	}

	public function addProductFavorite($lang){

		$resultado = new stdClass();
		
		if( !empty($_POST) ){
			if( !isset($_SESSION['favoritos']) ){
				$_SESSION['favoritos'] = array();
			}
			array_push($_SESSION['favoritos'], $_POST['id']);
			$resultado->exito = true;
			$resultado->log = "Se agregó el ID al contenedor de FAVORITOS";
			$resultado->mensaje = $this->trans($lang , 'Eliminar de Favoritos' , 'Remove from Favorites' );
		}
		else{
			$resultado->exito = false;
		}

		header('Content-type: text/json');
		echo json_encode($resultado);
	}

	public function showFavs( $lang ){


		$this->addBread( array("label" => $this->trans($lang , "Mis Favoritos" , "My Favorites") ) );
		$this->header( $lang );

		if( isset($_SESSION['favoritos']) && sizeof($_SESSION['favoritos']) > 0 ){
			
			
			$ids = implode(",", $_SESSION['favoritos']);

			$sql = "SELECT * FROM product WHERE id in (".$ids.")";
	 		$query = $this->pdo->prepare($sql);
			$rs = $query->execute();
			if($rs!==false){
				$nr = $query->rowCount();
				if( $nr > 0 ){
					$productList = $query->fetchAll();
					$count = 0;
					require $this->views."favs.php";
				}

			}
		}
		else{
			echo "<h3>No cuentas con favoritos</h3>";
			
		}
		$this->footer( $lang );
	}

	public function showAll( $lang ){
		header("Location: ./catalog/product");
	}

	public function types($lang="es"){

		$html = "";
		if ($lang == "es"){	
			$this->addBread( array( "url"=>"/catalog", "label"=>"Catalogo" ));
			$this->addBread( array( "label"=>"Productos" ));
		}else if($lang == "en") {
			$this->addBread( array( "url"=>"/catalog", "label"=>"Catalog" ));
			$this->addBread( array( "label"=>"Products" ));
		}else{
				$html .= 'No existe lang';
		}	
			$this->header( $lang );
			
			$sqlCatalogo = "SELECT * FROM product GROUP BY ".$this->trans($lang , "grupo" , "_group")." ORDER BY ".$this->trans($lang , "tipo" , "_type")." DESC";
			
			$queryCatalogo = $this->pdo->prepare($sqlCatalogo);
			$rsCatalogo = $queryCatalogo->execute();
			$catalogo = $queryCatalogo->fetchAll();
			$html .= '<div id="content-press">';
			$tipo = "";
			foreach ($catalogo as $product) {
				if( $tipo != $product[$this->trans($lang , "tipo" , "_type")]){
					$tipo = $product[$this->trans($lang , "tipo" , "_type")];
					$html .= '<div class="tituloSeccion clear">'.ucfirst(strtolower($tipo)).'</div>';
				}
				$html .= '<article class="item4Col">
						        <a href="'.$this->url($lang, "/catalog/".strtolower($tipo)."/".strtolower(str_replace(" " , "-" , $product[$this->trans($lang , "grupo" , "_group")]))).'">
						        	<div class="imageHolder">
							            <img 
							            alt="'.$product["nombre"].'" 
							            src="http://www.alfonsomarinaebanista.com/images/'.$product["ur"].'/'.$product["ur"].'_alta1.jpg">
							         </div>
						            <br class="clear">
						            <br class="clear">
						            <p>
						            '.$product[$this->trans($lang , "grupo" , "_group")].'
						            </p>
						        </a>
						    </article>';
			}
			$html .= "</div><!-- .product-list -->";
			echo $html;
			$this->footer( $lang );
	}
	
	public function showListProducts($lang="es" , $style = "", $type = "" , $group  = ""){

		$ostyle =  $style; 
		$otype =  $type; 
		$ogroup  = $group;

		$this->addBread( array("label" => $this->trans($lang , "Catalogo" , "Catalog") , "url" => "/catalog/products") );

		if( $style != "casual" && $style != "metro" ){
			$ogroup  = $type ;
			$otype = $style ;
			$group  = $type ;
			$type = $style ;

			if( $type != "")
				$this->addBread( array(  "label"=>ucwords(strtolower($type)) , "url"=> "/catalog/".$style )  );
			if( $group != "")
				$this->addBread( array(  "label"=>ucwords(strtolower(str_replace("-" , " " , urldecode($group))))  ) );	
			
		}else{

			$this->addBread( array(  "label"=>ucwords(strtolower($style)), "url"=> "/catalog/".$style  ) );
			if( $type != "")
				$this->addBread( array(  "label"=>ucwords(strtolower($type)) , "url"=> "/catalog/".implode( "/" , array( $style , $type )  ) ) );
			if( $group != "")
				$this->addBread( array(  "label"=>ucwords(strtolower(str_replace("-" , " " , urldecode($group))))  ) );	
		}

		$html = "";
		$style =  $style == "casual" || $style == "metro" ? $this->trans($lang , "estilo" , "style")." LIKE '{$style}' " :" 1=1 ";
		$type =  $type != ""?$this->trans($lang , "tipo" , "_type")." LIKE '{$type}' ":" 1=1 ";
		$group =  $group != ""?"LOWER( ".$this->trans($lang , "grupo" , "_group")." ) LIKE '%".str_replace("-" , " " , urldecode($group))."%' ":" 1=1 ";
		$where = implode( " AND " , array( $style , $type ,  $group ) );
		

		$groupBy = ( $group == " 1=1 " )?" GROUP BY ".$this->trans($lang , "grupo" , "_group")." ":"";



		$grouping = ($groupBy!="")?$this->trans($lang , "grupo" , "_group"):false;


		$sqlCatalogo = "SELECT * FROM product WHERE {$where} {$groupBy} ";
		
		$queryCatalogo = $this->pdo->prepare($sqlCatalogo);
		$rsCatalogo = $queryCatalogo->execute();


		// CHECK IN OTHER LANGUEJAS
		if( $queryCatalogo->rowCount() == "0" ){
			
			$lang = $lang=="es"?"en":"es";
			$style =  $ostyle == "casual" || $ostyle == "metro" ? $this->trans($lang , "estilo" , "style")." LIKE '{$ostyle}' " :" 1=1 ";
			$type =  $otype != ""?$this->trans($lang , "tipo" , "_type")." LIKE '{$otype}' ":" 1=1 ";
			$group =  $ogroup != ""?"LOWER( ".$this->trans($lang , "grupo" , "_group")." ) LIKE '%".str_replace("-" , " " , urldecode($ogroup))."%' ":" 1=1 ";
			$where = implode( " AND " , array( $style , $type ,  $group ) );
			$lang = $lang=="en"?"es":"en";
			$sqlCatalogo = "SELECT * FROM product WHERE {$where} {$groupBy}";
			$queryCatalogo = $this->pdo->prepare($sqlCatalogo);
			$rsCatalogo = $queryCatalogo->execute();
		}




		if( $rsCatalogo !== false ){
			$pr = $queryCatalogo->rowCount();
			if($pr > 0){
				$catalogo = $queryCatalogo->fetchAll();
				$html .= '<div id="content-press">';
				$html .= '<p class="tituloSeccion">'.str_replace( "-" , " " , urldecode( ucfirst( end( $this->bread )["label"] ) ) ).'</p>';

				if($grouping){
					foreach ($catalogo as $product) {
						$stype = strtolower($this->trans( $lang , $product["tipo"] , $product["_type"]));
						$product["imagen"] = $product["imagen"] != "null"?"/assets/images/product/".$product["imagen"]:"http://placehold.it/200x200/f4f4f4/ccc?text=product";
						$html .= '
								<article class="item4Col">
							        <a href="'.$this->url($lang, "/catalog/".$stype."/".strtolower(str_replace(" ", "-" ,$product[$grouping] )) ).'">
							        	<div class="imageHolder">
								            <img 
								            alt="'.$product["nombre"].'" 
								            src="http://www.alfonsomarinaebanista.com/images/'.$product["ur"].'/'.$product["ur"].'_alta1.jpg">
								         </div>
							            <br class="clear">
							            <br class="clear">
							            <p>
							            '.$product[$grouping].'
							            </p>
							        </a>
							    </article>
								';

					}
				}else{
					foreach ($catalogo as $product) {
						$product["imagen"] = $product["imagen"] != "null"?"/assets/images/product/".$product["imagen"]:"http://placehold.it/200x200/f4f4f4/ccc?text=product";
						$html .= '
								<article class="item4Col">
							        <a href="'.$this->url($lang, "/product/".$product['ur']).'">
							        	<div class="imageHolder">
								            <img 
								            alt="'.$product["nombre"].'" 
								            src="http://www.alfonsomarinaebanista.com/images/'.$product["ur"].'/'.$product["ur"].'_alta1.jpg">
								         </div>
							            <br class="clear">
							            <br class="clear">
							            <p>
							            '.$product["nombre"].'
							            </p>
							        </a>
							    </article>
								';

					}
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
		// TODO: @Catalogo Crear slugs optimizadas para seo(5)
		// TODO: @Catalogo Agregar la vista de dos productos en el mismo (1)
		// TODO: @Catalogo Agrega vista de variaciones del producto (3)
		
		if ( !empty($slug) ){

			$this->addBread( array(  "label"=>$this->trans( $lang  , "Catalogo" , "Catalog") , "url"=>"/catalog/products" ) );
			$this->addBread( array(  "label"=>$this->trans( $lang  , "Productos" , "Products") , "url"=>"/catalog/products" ) );

			$sql = "SELECT * FROM product WHERE ur LIKE '$slug'";
			$query = $this->pdo->prepare($sql);
			$rs = $query->execute();
			if( $rs ){
				$product = $query->fetch();

				$t = $this->trans( $lang  , $product["tipo"] , $product["_type"] );
				$g = $this->trans( $lang  , $product["grupo"] , $product["_group"] );
				$u = $this->trans( $lang  , $product["nombre"] , $product["_name"] );

				$this->addBread( array(  "label"=>ucwords(strtolower($t)) , "url"=>"/catalog/".strtolower($t) ) );
				$this->addBread( array(  "label"=>ucwords(strtolower($g)) , "url"=>"/catalog/".strtolower($t)."/".strtolower(str_replace(" ", "-" , $g)) ) );
				$this->addBread( array(  "label"=>ucwords(strtolower($u)) ) );



				$this->header( $lang , false , $product );
				require $this->views."detalle-producto.php";
			}
		}		
		$this->footer( $lang );
	}

	public function searchProductByName($lang="es"){
		
		$this->addBread( array("label" => $this->trans($lang, "Buscador", "Search"), "url" => "/search"));

		$html = "";
		if( !empty($_POST) ){


			$sql = "SELECT * FROM product WHERE nombre LIKE :name OR _name LIKE :name";
			$query = $this->pdo->prepare($sql);
			$name = "%{$_POST["q"]}%";
	 		$query->bindParam(':name',$name, \PDO::PARAM_STR);

			$rs = $query->execute();
			
			$products = $query->fetchAll();
			$html .= '<div id="content-press">';
			foreach ($products as $product) {
				$product["imagen"] = $product["imagen"] != "null"?"/images/product/".$product["imagen"]:"http://placehold.it/200x200/f4f4f4/ccc?text=product";
				$html .= '
						<article class="item4Col">
					        <a href="'.$this->url($lang, "/product/".$product['ur']).'">
					        	<div class="imageHolder">
						            <img 
						            alt="'.$product["nombre"].'" 
						            src="http://www.alfonsomarinaebanista.com/images/'.$product["ur"].'/'.$product["ur"].'_alta2.jpg">
						         </div>
					            <br class="clear">
					            <br class="clear">
					            <p>
					            '.$product["nombre"].'
					            </p>
					        </a>
					    </article>
						';

				}
				$html .= "</div>";
		}else{
			$html .= '
						<div id="content-press">
							<h3>Buscar Muebles</h3>
						</div>
					';
		}

		$this->header( $lang );
		echo $html;
		$this->footer( $lang );
	}

	public function searchProductByName_Json($lang="es"){
		
		if( !empty($_POST) ){
			$table = "product";
			$database = "amarinados";

			$lastWhere = $this->describe($database, $table, $_POST["q"]);
			$where = substr($lastWhere, 0, -3);

			$sql = "SELECT nombre, ur FROM $table WHERE ".$where." LIMIT 10";
			$query = $this->pdo->prepare($sql);
			
			$rs = $query->execute();
			$this->lang = $lang;
			$products = $query->fetchAll(\PDO::FETCH_ASSOC);
			$products = array_map(function($element){
				$element["url"] = $this->url($this->lang , "/product/".$element["ur"]);
				return $element;
			}, $products);
			header('Content-type: application/json; charset=utf-8');
			echo json_encode($products);
		}
	}	

}