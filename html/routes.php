<?php
	use PHPRouter\RouteCollection;
	use PHPRouter\Router;
	use PHPRouter\Route;
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
	$collection->attachRoute(new Route('/menu', array(
	    '_controller' => 'Catalog::menuCatalog',
	    'parameters' => array("lang" => $lang) ,
	    'methods' => 'GET'
	)));
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



	//  FINISH


	$collection->attachRoute(new Route('/catalog/finishes', array(
		'_controller' => 'Finish::showFinishes',
		'parameters' => array("lang" => $lang),
		'methods' => 'GET'
		)));
	$collection->attachRoute(new Route('/catalog/painted', array(
		'_controller' => 'Finish::filterFinishes',
		'parameters' => array("lang" => $lang , "type" => "painted"),
		'methods' => 'GET'
		)));
	$collection->attachRoute(new Route('/catalog/wood', array(
		'_controller' => 'Finish::filterFinishes',
		'parameters' => array("lang" => $lang , "type" => "wood"),
		'methods' => 'GET'
		)));
	$collection->attachRoute(new Route('/catalog/finishes/:codigo', array(
		'_controller' => 'Finish::detailFinish',
		'parameters' => array("lang" => $lang),
		'methods' => 'GET'
		)));



	// CATALOG
	$collection->attachRoute(new Route('/catalog', array(
		'_controller' => 'Catalog::showAll',
		'parameters' => array("lang" => $lang),
		'methods' => 'GET'
	)));
	$collection->attachRoute(new Route('/catalog/product-care', array(
		'_controller' => 'Catalog::productCare',
		'parameters' => array("lang" => $lang),
		'methods' => 'GET'
	)));
	$collection->attachRoute(new Route('/catalog/lifestyle', array(
		'_controller' => 'Catalog::showLifestyles',
		'parameters' => array("lang" => $lang),
		'methods' => 'GET'
	)));
	$collection->attachRoute(new Route('/catalog/:style', array(
		'_controller' => 'Catalog::showListProducts',
		'parameters' => array("lang" => $lang),
		'methods' => 'GET'
		)));
	$collection->attachRoute(new Route('/catalog/:style/:type', array(
		'_controller' => 'Catalog::showListProducts',
		'parameters' => array("lang" => $lang),
		'methods' => 'GET'
		)));
	$collection->attachRoute(new Route('/catalog/:style/:type/:use', array(
		'_controller' => 'Catalog::showListProducts',
		'parameters' => array("lang" => $lang),
		'methods' => 'GET'
		)));


	//  PRODUCT
	$collection->attachRoute(new Route('/product/:slug', array(
		'_controller' => 'Catalog::detailProduct',
		'parameters' => array("lang" => $lang),
		'methods' => 'GET'
		)));
	$collection->attachRoute(new Route('/product/addFav', array(
		'_controller' => 'Catalog::addProductFavorite',
		'parameters' => array("lang" => $lang),
		'methods' => 'POST'
		)));
	$collection->attachRoute(new Route('/product/removeFav', array(
		'_controller' => 'Catalog::removeProductFavorite',
		'parameters' => array("lang" => $lang),
		'methods' => 'POST'
		)));
	$collection->attachRoute(new Route('/favs/', array(
		'_controller' => 'Catalog::showFavs',
		'parameters' => array("lang" => $lang),
		'methods' => 'GET'
		)));


	// PRESS
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
	$collection->attachRoute(new Route('/press/brochure/:slug', array(
		'_controller' => 'Press::detail',
		'parameters' => array("lang" => $lang , "category"=>"brochure"),
		'methods' => 'GET'
		)));

	// User

	$collection->attachRoute(new Route('/login', array(
		'_controller' => 'User::login',
		'parameters' => array("lang" => $lang),
		'methods' => 'GET'
		)));
	$collection->attachRoute(new Route('/logout', array(
		'_controller' => 'User::logout',
		'parameters' => array("lang" => $lang),
		'methods' => 'GET'
		)));

	$collection->attachRoute(new Route('/login', array(
		'_controller' => 'User::loginAction',
		'parameters' => array("lang" => $lang),
		'methods' => 'POST'
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
	
	$collection->attachRoute(new Route('/admin/', array(
		'_controller' => 'Admin::dashboard',
		'parameters' => array("lang" => $lang),
		'methods' => 'GET'
	)));

	$collection->attachRoute(new Route('/admin/contacts/list', array(
		'_controller' => 'AdminContacto::showContacts',
		'parameters' => array("lang" => $lang),
		'methods' => 'GET'
	)));


?>