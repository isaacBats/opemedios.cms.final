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
	$_SERVER["REQUEST_URI"] = str_replace( "/".$lang ,"",$_SERVER["REQUEST_URI"] );

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