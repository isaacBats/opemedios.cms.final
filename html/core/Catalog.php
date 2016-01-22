<?php 

class Catalog extends Controller{

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

	/*
			$sql = "SELECT * FROM lifestyles";
			$query = $this->pdo->prepare($sql);
			$rs = $query->execute();

			$html .= '<div class="products-cover">';

			if($rs !==false ){
				$lr = $query->rowCount();
				if( $lr > 0 ){
					$styles = $query->fetchAll();
						foreach ($styles as $style) {
							$html .= '<div class="category">
											<a href="'.$this->url($lang , "/catalog/".$style['name']).'">
												<img src="/images/'.$style['image'].'"><br>
													'.$style['name'].'
											</a>
										</div><!-- .category -->
										<br class="clear">';
						}
				}
			}
			$html .= '</div><!-- .products-cover -->';

	*/



	
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
	function navegacion($lang="es",$slug){
		
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
		$this->header( $lang );
		if ( !empty($slug) ){

			$html = '';

			$sql = "SELECT * FROM product WHERE id = $slug";
			$query = $this->pdo->prepare($sql);
			$rs = $query->execute();
			if( $rs ){
				$product = $query->fetch();
				if( $lang == "es" ){
					$html .= '<div class="product">
								<div id="product-image">
									<img src="images/'.$product['imagen'].'">
								</div><!-- #product-image-->
								<div id="product-info">
									<div class="nav-detalle">
						            '.$this->navegacion($lang,$product['id']).'
						            <a href="'.$this->url($lang,'/catalog/finishes').'" class="ver-todos">Show all</a>
						        </div>
									<h2 class="product-title">'.$product['nombre'].'</h2>
									<div class="features">
										<p><strong>'.$product['ur'].'</strong><br>
										<strong>Medidas cm:</strong> W '.$product['frente'].' D '.$product['fondo'].' H '.$product['altura'].' cm<br>
										<strong>Medidas in:</strong> W '.$product['frentre_plg'].' D '.$product['fondo_plg'].' H '.$product['altura_plg'].' in<br>
										<strong>Carácter:</strong> '.$product['caracter'].'<br>
										<strong>Como se muestra:</strong> '.$product['como_se_muestra'].'<br>
										<strong>Precio:</strong> <a href="javascript:void(0);" class="general-link">Iniciar sesión</a></p>
									</div><!-- .features -->
									<a href="javascript:void(0);" class="general-btn">Añadir a Favoritos</a>
									<div class="sec-features related">
										<h2>Productos Relacionados</h2>
										<a href="javascript:void(0);" class="rel"><img src="images/relacionado1.jpg"></a>
										<a href="javascript:void(0);" class="rel"><img src="images/relacionado2.jpg"></a>
										<a href="javascript:void(0);" class="rel"><img src="images/relacionado3.jpg"></a>
									</div><!-- .sec-features -->
									<div class="share-product">
										<a href="javascript:void(0);"><img src="images/share-it.png"></a>
										<a href="javascript:void(0);"><img src="images/tweet-it.png"></a>
										<a href="javascript:void(0);"><img src="images/pin-it.png"></a>
									</div><!-- .share-product -->
									<div class="product-note">
										<p><strong>NOTA:</strong> Debido a variaciones en los monitores, los colores como se muestran no pueden representar la calidad y el tono exacto.</p>
										<p>Si desea más información, favor de contactar a nuestra área de Servicio al Clientes.</p>
									</div><!-- .product-note -->
									<div class="post-actions">
										<a href="javascript:void(0);"><i class="fa fa-envelope-o fa-lg"></i> Enviar por correo</a>
										<a href="javascript:void(0);"><i class="fa fa-print fa-lg"></i> Imprimir</a>
										<a href="javascript:void(0);"><i class="fa fa-file-o fa-lg"></i> Imprimir hoja de catálogo</a>
									</div><!-- .post-actions -->
								</div><!-- #product-info -->
								<br class="clear">
							</div><!-- .product-->';
				}
				else{
					$html .= 'echo "producto ingles";';
				}
			}
		}		
		echo $html;
		$this->footer( $lang );

	}


	

	

}