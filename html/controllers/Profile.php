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

}