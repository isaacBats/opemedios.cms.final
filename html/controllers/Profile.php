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

	public function myQuoteAction($lang = "es"){

			if( isset($_SESSION["user"])){
				$this->addbread( array("url"=>"/profile" , "label"=>$this->trans($lang ,"Usuario" , "User" )) );
				$this->addbread( array("label"=>$this->trans($lang , "Mis cotizaciones" , "My quotes ")) );
				$this->header($lang);
				require $this->views."profile.quotes.php";
				$this->footer( $lang );	
			}
			else{
				header( "Location: http://{$_SERVER["HTTP_HOST"]}/login");
			}
		
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