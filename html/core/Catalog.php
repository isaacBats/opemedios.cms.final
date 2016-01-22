<?php 

class Catalog extends Controller{

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
		
		require $this->views."detalle-producto.php";
		
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

	public function productCare($lang = "es"){
		
		$this->addBread( array(  "label"=>$this->trans( $lang  , "Cuidado de productos" , "Product Care") ));
		$this->header( $lang );
		require $this->views."product-care.php";
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


			public function detailProduct( $lang = "es" , $slug){
				$this->header( $lang );

				if( $lang == "es"){
					echo "producto español";
				}else{
					echo "producto ingles";
				}

			}






		}