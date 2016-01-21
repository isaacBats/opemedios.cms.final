<?php 

class Catalog extends Controller{

	public function showLifestyles($lang="es"){

		
		
		$html = "";

		if ($lang == "es"){	
			$this->addBread( array( "url"=>"/catalog", "label"=>"Catalogo" ));
			$this->addBread( array( "label"=>"Estílo de vida" ));

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
		}else if($lang == "en") {
			$html .= 'Devuelve en inglés';
			$this->addBread( array( "url"=>"/catalog", "label"=>"Catalog" ));
			$this->addBread( array( "label"=>"Lifestyles" ));
		}else{
				$html .= 'No existe lang';
		}	
			$this->header( $lang );
			$html .= $this->footer();
			echo $html;
		
	}



	
	public function showListProducts($lang="es" ,$slug ){
		
		$html = "";

		$sqlCatalogo = "select * from catalogo WHERE estilo like '%".strtolower($slug)."%' GROUP by grupo ";
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
		$html .= $this->footer();

		echo $html;
	}


	public function detailProduct( $lang = "es" , $slug){
		$this->header( $lang );

		if( $lang == "es"){
			echo "producto español";
		}else{
			echo "producto ingles";
		}

	}


	public function footer(){
		$html = '
				<br class="clear"/>
	            </div>
						<footer id="main-footer">
							<footer id="inner-footer">
								<form >    
									<div id="newsletter">
						        		<input type="email" value="" placeholder="Email" name="Email" id="Email" data-val-required="The Email field is required." data-val-regex-pattern="^(([A-Za-z0-9]+_+)|([A-Za-z0-9]+\-+)|([A-Za-z0-9]+\.+)|([A-Za-z0-9]+\++))*[A-Za-z0-9]+@((\w+\-+)|(\w+\.))*\w{1,63}\.[a-zA-Z]{2,6}$" data-val-regex="*" data-val="true" class="text-label">
						        		<input type="submit" id="news-submit" value="Suscribir" name="Submit">
						    		</div><!-- #newsletter --> 
								</form>
						        <p>&copy;Alfonso Marina Ebanista. Derechos Reservados 2015.</p>
						        <div id="social-media">
						        	<span class="tagline">Síguenos:</span>
				                    <a class="btn-social facebook" href="https://www.facebook.com/pages/Alfonso-Marina-Ebanista/216426771801026?ref=aymt_homepage_panel" target="_blank">Facebook</a>
				                    <a class="btn-social twitter" href="https://twitter.com/alfonsomarinamx" target="_blank">Twitter</a>
				                    <a class="btn-social pinterest" href="http://pinterest.com/alfonsomarina/boards/" target="_blank">Pinterest</a>
				                    <a class="btn-social instagram" href="http://instagram.com/alfonsomarinamx" target="_blank">Instagram</a>
				                    <a class="btn-social dh" href="http://www.deringhall.com/designers/Alfonso-marina-ebanista" target="_blank">Dering Hall</a>
				                </div><!-- #social-media -->
				            </footer><!-- #main-footer -->
				        </footer><!-- #inner-footer -->
				</div><!-- #body -->
				</body>
				</html>';
		return $html;
	}

	

}