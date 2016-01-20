<?php 

	require __DIR__.'/vendor/autoload.php';
	require __DIR__.'/core/hello.php';

	use PHPRouter\RouteCollection;
	use PHPRouter\Config;
	use PHPRouter\Router;
	use PHPRouter\Route;

	

	$lang = $_GET["lang"];

	$_SERVER["REQUEST_URI"] = str_replace( "/".$lang ,"",$_SERVER["REQUEST_URI"] );
	

	$collection = new RouteCollection();

	$collection->attachRoute(new Route('/gallery', array(
	    '_controller' => 'Languages::showGallery',
	    'parameters' => array("lang" => $lang) ,
	    'methods' => 'GET'
	)));

	
	
	$router = new Router($collection);
	$router->setBasePath('/');
	$route = $router->matchCurrentRequest();


?>