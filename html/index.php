<?php
	require_once( __DIR__.'/vendor/autoload.php' );
	require_once( __DIR__.'/core/controller.php' );
	require_once( __DIR__.'/core/noticias.php' );
	require_once( __DIR__.'/core/gallery.php' );

	use PHPRouter\RouteCollection;
	use PHPRouter\Config;
	use PHPRouter\Router;
	use PHPRouter\Route;

	$lang = isset($_GET["lang"])?$_GET["lang"]:"es";

	$_SERVER["REQUEST_URI"] = str_replace( "/".$lang ,"",$_SERVER["REQUEST_URI"] );
	$collection = new RouteCollection();
	
	$collection->attachRoute(new Route('/news', array(
	    '_controller' => 'Noticias::mostrarTodas',
	    'parameters' => array("lang" => $lang) ,
	    'methods' => 'GET'
	)));

	$collection->attachRoute(new Route('/gallery', array(
	    '_controller' => 'Gallery::showGallery',
	    'parameters' => array("lang" => $lang) ,
	    'methods' => 'GET'
	)));


	
	$router = new Router($collection);
	$router->setBasePath('/');
	$route = $router->matchCurrentRequest();


?>