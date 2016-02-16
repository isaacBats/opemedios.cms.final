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

		$ids = implode(",", $_SESSION['cotizacion']);
		$sqlQuoteProduct = "SELECT * FROM product WHERE id in (".$ids.")";
		$queryQuoteProduct = $this->pdo->prepare($sqlQuoteProduct);
		$rsQuoteProduct = $queryQuoteProduct->execute();
		if($rsQuoteProduct){
			$products = $queryQuoteProduct->fetchAll(\PDO::FETCH_ASSOC);
		}

		require $this->views."detail_quote.php";

		$this->footer( $lang );
	}

	/**
	 * Add a product to the user session to list quote 
	 * @param string $lang language
	 */
	public function addProductQuoteAction( $lang="es" ){

		$resultado = new stdClass();
		if( !empty($_POST) ){
			if( !isset($_SESSION['cotizacion']) ){
				$_SESSION['cotizacion'] = array();
			}
			array_push($_SESSION['cotizacion'], $_POST['id']);
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
			
			if (($key = array_search($_POST['id'], $_SESSION['cotizacion'])) !== false) {
			    unset($_SESSION['cotizacion'][$key]);
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