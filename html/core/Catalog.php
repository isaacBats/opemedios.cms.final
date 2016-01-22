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
									<a href="'.$this->url($lang , "/product/".$c["nombre"] ).'">
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
	function detailProduct($lang="es", $slug){
		$this->header( $lang );
		if ( !empty($slug) ){

			$html = '';

			$sql = "SELECT * FROM product WHERE nombre like '%".strtolower($slug)."%'";
			$query = $this->pdo->prepare($sql);
			$rs = $query->execute();
			if( $rs ){
				$product = $query->fetch();
				if( $lang == "es" ){
					$html .= '<div class="product">
			<div id="product-image">
				<img src="images/'.product['imagen'].'">
			</div><!-- #product-image-->
			<div id="product-info">
				<div class="detail-nav">
					<a href="javascript:void(0);">Anterior</a>
					<span>|</span>
					<a href="javascript:void(0);">Siguiente</a>
					<a href="javascript:void(0);" class="see-all">Ver Todos</a>
					<br class="clear">
				</div><!-- .detail-nav -->
				<h2 class="product-title">'.product['nombre'].'</h2>
				<div class="features">
					<p><strong>'.product['ur'].'</strong><br>
					<strong>Medidas cm:</strong> W '.product['frente'].' D '.product['fondo'].' H '.product['altura'].' cm<br>
					<strong>Medidas in:</strong> W '.product['frente_plg'].' D '.product['fondo_plg'].' H '.product['altura_plg'].' in<br>
					<strong>Carácter:</strong> '.product['caracter'].'<br>
					<strong>Como se muestra:</strong> '.product['como_se_mestra'].'<br>
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
					$html .= '<div class="product">
			<div id="product-image">
				<img src="images/product-bargueno-espanol.jpg">
			</div><!-- #product-image-->
			<div id="product-info">
				<div class="detail-nav">
					<a href="javascript:void(0);">Anterior</a>
					<span>|</span>
					<a href="javascript:void(0);">Siguiente</a>
					<a href="javascript:void(0);" class="see-all">Ver Todos</a>
					<br class="clear">
				</div><!-- .detail-nav -->
				<h2 class="product-title">Bargueño Español</h2>
				<div class="features">
					<p><strong>501-325-02</strong><br>
					<strong>Medidas cm:</strong> W 212 D 104 H 102 cm<br>
					<strong>Medidas in:</strong> W 83 1/2 D 41 H 40 in<br>
					<strong>Carácter:</strong> Antiqued<br>
					<strong>Como se muestra:</strong> 31 FRANZ MAYER<br>
					<strong>Precio:</strong> <a href="javascript:void(0);" class="general-link">Iniciar sesión</a></p>
				</div><!-- .features -->
				<a href="javascript:void(0);" class="general-btn">Añadir a Favoritos</a>
				<div class="sec-features">
					<h2 class="product-title">Base para Bargueño Español</h2>
					<div class="features">
						<p><strong>507-209-03</strong><br>
						<strong>Medidas cm:</strong> W 69 D 45 H 58 cm <br>
						<strong>Medidas in:</strong> W 27 1/4 D 17 3/4 H 22 3/4 in<br>
						<strong>Carácter:</strong> Rústico<br>
						<strong>Como se muestra:</strong> 02 FRUTAL<br>
						<strong>Precio:</strong> <a href="javascript:void(0);" class="general-link">Iniciar sesión</a></p>
						
					</div><!-- .features -->
				</div><!-- .sec-features -->
				
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
			}
			$this->header($lang);

			
		}
		else{

		}
		
		echo $html;
		$this->footer( $lang );
	}
	

	}


	

	

}