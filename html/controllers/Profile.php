<?php 

class Profile extends Controller{

	public function accountStatusAction($lang = "es"){
		if( isset($_SESSION["user"])){
			$this->addbread( array("url"=>"/profile" , "label"=>$this->trans($lang , "Usuario" , "User")) );
			$this->addbread( array( "label"=>$this->trans($lang ,"Estado de Cuenta" , "Statement") ) );
			$this->header($lang);
			require $this->views."profile.account.php";
			$this->footer( $lang );	
		}
		else{
			header( "Location: http://{$_SERVER["HTTP_HOST"]}/login");
		}
	}

	public function pricesListAction($lang = "es"){
		if( isset($_SESSION["user"])){
				$this->addbread( array("url"=>"/profile" , "label"=>$this->trans($lang , "Usuario" , "User")) );
				$this->addbread( array( "label"=>$this->trans($lang , "Lista de precios" , "Price List")) );
				$this->header($lang);
				require $this->views."profile.price-list.php";
				$this->footer( $lang );	
			}
			else{
				header( "Location: http://{$_SERVER["HTTP_HOST"]}/login");
			}


	}

	public function downloadCatalogAction($lang = "es"){
		if( isset($_SESSION["user"])){
				$this->addbread( array("url"=>"/profile" , "label"=>$this->trans($lang ,"Usuario" , "User" )) );
				$this->addbread( array( "label"=>$this->trans($lang , "Descargar Catálogo" , "Download Catalog")) );
				$this->header($lang);
				require $this->views."profile.catalog.php";
				$this->footer( $lang );	
			}
			else{
				header( "Location: http://{$_SERVER["HTTP_HOST"]}/login");
			}

	}

	/**
	 * View my quotes list
	 * @param  string $lang language
	 */
	public function myQuoteAction($lang = "es"){
			if( isset($_SESSION["user"])){
				
				$this->addbread( array("url"=>"/profile" , "label"=>$this->trans($lang ,"Usuario" , "User" )) );
				$this->addbread( array("label"=>$this->trans($lang , "Mis cotizaciones" , "My quotes ")) );
				$this->header($lang);

				$quote = "";
				$cotizaciones = "";

				if(isset($_SESSION["cotizacion"])){
					$fecha = date('d/m/Y');
					$quote = '
								<table>
							        <thead>
							            <tr>
							                <th>
							                    Fecha
							                </th>
							                <th>
							                    Detalle
							                </th>
							            </tr>
							        </thead>
							        <tbody>					
										<tr>
						                    <td>
						                        '.$fecha.'
						                    </td>
						                    <td ><a href="/profile/my-quote/detail-session">Ver Detalles</a></td>
						                </tr>
						            </tbody>
						        </table>
					';
				}
				
				$sqlCotizaciones = "SELECT * FROM usuarios_cotizacion WHERE usuarios_id = :user_id;";
				$queryCotizacion = $this->pdo->prepare($sqlCotizaciones);
				$queryCotizacion->bindParam(':user_id', $_SESSION['user']['id_registro']);
				$rsCotizacion = $queryCotizacion->execute();
				if($rsCotizacion){
					$cotizaciones = $queryCotizacion->fetchAll(\PDO::FETCH_ASSOC);
				}

				require $this->views."profile.quotes.php";
				$this->footer( $lang );	
			}
			else{
				header( "Location: http://{$_SERVER["HTTP_HOST"]}/login");
			}
		
	}

	/**
	 * Show detail quotes stored
	 * @param  string 	$lang 		language
	 * @param  int 	  	$id   		id of quote
	 * @return Array[]  $products   products
	 */
	public function detailQuoteAction( $lang = "es", $id ){

		$this->addbread( array("url"=>"/profile" , "label"=>$this->trans($lang ,"Usuario" , "User" )) );
		$this->addbread( array("label"=>$this->trans($lang , "Detalle cotización" , "Quote Detail")) );
		$this->header( $lang );

		$sql = "
				SELECT 	p.nombre, 
						p.ur, 
						p.acabado, 
						p.precio as 'Precion producto', 
						cu.price as 'Precio cotizado', 
						cu.field,
						cu.quantity 
				FROM product p 
				INNER JOIN usuarios_cotizacion_producto cu 
				ON p.id = cu.product_id 
				WHERE cotizacion_id = :id;
		";

		$query = $this->pdo->prepare($sql);
		$query->bindParam(':id', $id);
		$rs = $query->execute();
		if( $rs ){
			$products = $query->fetchAll(\PDO::FETCH_ASSOC);
		}

		require $this->views."detail_quote.php";

		$this->footer( $lang );
	}

	/**
	 * Show detail of session quote
	 * @param  string $lang language
	 */
	public function detailSessionQuoteAction( $lang = "es" ){

		$this->addbread( array("url"=>"/profile" , "label"=>$this->trans($lang ,"Usuario" , "User" )) );
		$this->addbread( array("label"=>$this->trans($lang , "Detalle cotización" , "Quote Detail")) );
		$this->header( $lang );

		// $ids = implode(",", $_SESSION['cotizacion']);
		// $sqlQuoteProduct = "SELECT * FROM product WHERE id in (".$ids.")";
		// $queryQuoteProduct = $this->pdo->prepare($sqlQuoteProduct);
		// $rsQuoteProduct = $queryQuoteProduct->execute();
		// if($rsQuoteProduct){
		// 	$products = $queryQuoteProduct->fetchAll(\PDO::FETCH_ASSOC);
		// }
		// 
		
		$products = $_SESSION['cotizacion'];

		require $this->views."detail_session_quote.php";

		$this->footer( $lang );
	}

	public function detailSessionSaveQuoteAction( $lang = "es" ){
		if( isset( $_SESSION["user"] ) && isset( $_SESSION["cotizacion"] ) ){
			$id_user = $_SESSION["user"]["id_registro"];
			// if($this->addQuote($id_user)){

			// 	$id_quote = $this->maxQuote();
			// 	$sql = "INSERT INTO usuarios_cotizacion_producto( usuarios_id, cotizacion_id, product_id, price, field, quantity )
			// 					VALUES ( :id_user, :id_quote, :id_product, :price, :field, :quantity )";

			// 	$query = $this->pdo->prepare($sql);
			// 	$query->bindParam(':id_user', $id_user);
			// 	$query->bindParam(':id_quote', $id_quote);
			// 	$query->bindParam(':id_product', $_SESSION['cotizacion'][$c]);
			// 	$query->bindParam(':price', $price);
			// 	$query->bindParam(':field', $_SESSION['user']["precio"]);
			// 	$query->bindParam(':quantity', $quantity);

			// }
		}
	}

	/**
	 * Add a new Quote
	 * 
	 * @param int $idUser User identified
	 */
	private function addQuote( $idUser ){
		$query = $this->pdo->prepare( "INSERT INTO usuarios_cotizacion( usuarios_id ) VALUES($idUser);" );
		$rs = $query->execute();
		( $rs == true )? $exito = true : $exito = false;		
		return $exito;
	}

	/**
	 * Return the last quote
	 * 
	 * @return int id of quote
	 */
	private function maxQuote(){

		$query = $this->pdo->prepare( "SELECT MAX(id) FROM usuarios_cotizacion;" );
		$rs = $query->execute();

		return current($query->fetch(\PDO::FETCH_ASSOC));
	}

	/**
	 * Add a product to the user session to list quote 
	 * 
	 * @param string $lang language
	 */
	public function addProductQuoteAction( $lang="es" ){

		$resultado = new stdClass();
		if( !empty($_POST) ){
			if( !isset($_SESSION['cotizacion']) ){
				$_SESSION['cotizacion'] = array();
			}

			$sql = "SELECT * FROM product WHERE id = :id;";
			$query = $this->pdo->prepare($sql);
			$query->bindParam(':id', $_POST['id']);
			$rs = $query->execute();
			if( $rs )
				$product = $query->fetch(\PDO::FETCH_ASSOC);

			$cotizacion = array(
						'id'		=> $_POST['id'],
						'idUser' 	=> $_SESSION['user']['id_registro'],
						'field'  	=> $_SESSION['user']['precio'], 
						'quantity'	=> 1 ,
						'product'	=> $product,
					);
			array_push($_SESSION['cotizacion'], $cotizacion);
			$resultado->exito = true;
			$resultado->log = "Se agregó el ID al contenedor de Cotizaciones";
			$resultado->mensaje = $this->trans($lang , 'Eliminar de Cotizacion' , 'Remove from Quotes' );
		}
		else{
			$resultado->exito = false;
		}

		header('Content-type: text/json');
		echo json_encode($resultado);
	}

	/**
	 * Remove a product to the user session to list quote
	 * @param  string $lang language
	 */
	public function removeProductQuoteAction( $lang="es" ){

		$resultado = new stdClass();
		if( !empty($_POST) ){
			if( !isset($_SESSION['cotizacion']) ){
				$_SESSION['cotizacion'] = array();
			}

			$cotizaciones = $_SESSION['cotizacion'];

			$numCotizaciones= count($cotizaciones);
			for ($c=0; $c < $numCotizaciones; $c++) { 
				if( $_SESSION['cotizacion'][$c]['id'] == $_POST['id']){
					unset($_SESSION['cotizacion'][$c]);
				}
			}	

			$resultado->exito = true;
			$resultado->log = "Se removió el ID de la Cotización";
			$resultado->mensaje = $this->trans($lang , 'Agregar a cotización' , 'Add to Quote' );
		}
		else{
			$resultado->exito = false;
		}

		header('Content-type: text/json');
		echo json_encode($resultado);	
	}

}