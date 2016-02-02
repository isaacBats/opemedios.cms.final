<?php

	/****************************************/
	//		   __ 							//
	//		  / / _   _ _ __   __ _ 		//
	//		 / / | | | | '_ \ / _` |		//
	//		/ /__| |_| | | | | (_| |		//
	//		\____/\__,_|_| |_|\__,_|		//
	// 										//
	//				Framework				//
	/****************************************/

	// VENDORS 
	require_once( __DIR__.'/vendor/autoload.php' );
	
	
	// LANG  MANNAGER
	$lang = isset($_GET["lang"])?$_GET["lang"]:"es";
	if( str_replace( "/".$lang ,"",$_SERVER["REQUEST_URI"] ) != $_SERVER["REQUEST_URI"] ){
		$_SERVER["REQUEST_URI"] = substr( $_SERVER["REQUEST_URI"], 3 );	
	}
	

	// CONFIG
	require_once( __DIR__.'/config.php' );

	//  REQUIRE CONTROLLERS
	require_once( __DIR__.'/controllers/Controller.php' );

	//  REQUIRE RUTES
	require ( __DIR__.'/routes.php' );

	use PHPRouter\Router;

	//  TROW 404
	$router = new Router($collection);
	$router->setBasePath('/');
	$route = $router->matchCurrentRequest();

	if( !$route ){
		$notfound = new Plain();
		$notfound->no_found( $lang );
	}

?>