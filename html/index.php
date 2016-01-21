<?php
	require_once( __DIR__.'/vendor/autoload.php' );
	require_once( __DIR__.'/core/controller.php' );
	require_once( __DIR__.'/core/noticias.php' );
	require_once( __DIR__.'/core/gallery.php' );
	require_once( __DIR__.'/core/plain.php' );
	require_once( __DIR__.'/core/Press.php' );
	require_once( __DIR__.'/core/catalog.php' );
	require_once( __DIR__.'/core/contacto.php' );
	require_once( __DIR__.'/core/User.php' );


	use PHPRouter\RouteCollection;
	use PHPRouter\Config;
	use PHPRouter\Router;
	use PHPRouter\Route;

	$lang = isset($_GET["lang"])?$_GET["lang"]:"es";

	$_SERVER["REQUEST_URI"] = str_replace( "/".$lang ,"",$_SERVER["REQUEST_URI"] );
	$collection = new RouteCollection();
	

	// Noticias

	$collection->attachRoute(new Route('/news', array(
	    '_controller' => 'Noticias::mostrarTodas',
	    'parameters' => array("lang" => $lang) ,
	    'methods' => 'GET'
	)));

	$collection->attachRoute(new Route('/news/:slug', array(
	    '_controller' => 'Noticias::mostrarDetalle',
	    'parameters' => array("lang" => $lang) ,
	    'methods' => 'GET'
	)));

	//  Galerias 

	$collection->attachRoute(new Route('/gallery', array(
	    '_controller' => 'Gallery::allGalleries',
	    'parameters' => array("lang" => $lang) ,
	    'methods' => 'GET'
	)));

	$collection->attachRoute(new Route('/gallery/:slug', array(
	    '_controller' => 'Gallery::showGallery',
	    'parameters' => array("lang" => $lang) ,
	    'methods' => 'GET'
	)));

	// Catalogo

	$collection->attachRoute(new Route('/catalog/lifestyles', array(
		'_controller' => 'Catalog::showLifestyles',
		'parameters' => array("lang" => $lang),
		'methods' => 'GET'
		)));

	$collection->attachRoute(new Route('/catalog/:slug', array(
		'_controller' => 'Catalog::showListProducts',
		'parameters' => array("lang" => $lang),
		'methods' => 'GET'
		)));

	$collection->attachRoute(new Route('/product/:slug', array(
		'_controller' => 'Catalog::detailProduct',
		'parameters' => array("lang" => $lang),
		'methods' => 'GET'
		)));


	

	// Press

	$collection->attachRoute(new Route('/press', array(
		'_controller' => 'Press::showAll',
		'parameters' => array("lang" => $lang),
		'methods' => 'GET'
		)));

	$collection->attachRoute(new Route('/press/:slug', array(
		'_controller' => 'Press::detail',
		'parameters' => array("lang" => $lang),
		'methods' => 'GET'
		)));
	
	$collection->attachRoute(new Route('/press/publicity/:slug', array(
		'_controller' => 'Press::detail',
		'parameters' => array("lang" => $lang , "category"=>"publicity"),
		'methods' => 'GET'
		)));
	$collection->attachRoute(new Route('/press/brochures/:slug', array(
		'_controller' => 'Press::detail',
		'parameters' => array("lang" => $lang , "category"=>"brochures"),
		'methods' => 'GET'
		)));

	// User

	$collection->attachRoute(new Route('/login', array(
		'_controller' => 'User::login',
		'parameters' => array("lang" => $lang),
		'methods' => 'GET'
		)));

	$collection->attachRoute(new Route('/register', array(
		'_controller' => 'User::showForm',
		'parameters' => array("lang" => $lang),
		'methods' => 'GET'
		)));

	$collection->attachRoute(new Route('/register', array(
		'_controller' => 'User::saveRegistro',
		'parameters' => array("lang" => $lang),
		'methods' => 'POST'
	)));

	// Vistas estaticas

	$collection->attachRoute(new Route('/acerca-de/quienes-somos', array(
		'_controller' => 'Plain::whoWeAreView',
		'parameters' => array("lang" => $lang),
		'methods' => 'GET'
		)));

	$collection->attachRoute(new Route('/acerca-de/fabrica-alfonso-marina', array(
		'_controller' => 'Plain::fabricView',
		'parameters' => array("lang" => $lang),
		'methods' => 'GET'
		)));

	$collection->attachRoute(new Route('/', array(
		'_controller' => 'Plain::homeView',
		'parameters' => array("lang" => $lang),
		'methods' => 'GET'
	)));

	$collection->attachRoute(new Route('/contact', array(
		'_controller' => 'Contacto::showForm',
		'parameters' => array("lang" => $lang),
		'methods' => 'GET'
		)));

	$collection->attachRoute(new Route('/contact', array(
		'_controller' => 'Contacto::saveForm',
		'parameters' => array("lang" => $lang),
		'methods' => 'POST'
	)));


	
	$router = new Router($collection);
	$router->setBasePath('/');
	$route = $router->matchCurrentRequest();

	if( !$route ){
		$notfound = new Plain();
		$notfound->no_found( $lang );
	}

?>