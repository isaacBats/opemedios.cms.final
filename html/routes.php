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
	$collection->attachRoute(new Route('/search', array(
		'_controller' => 'Catalog::searchProductByName',
		'parameters' => array("lang" => $lang),
		'methods' => 'POST'
		)));

	$collection->attachRoute(new Route('/search/json', array(
		'_controller' => 'Catalog::searchProductByName_Json',
		'parameters' => array("lang" => $lang),
		'methods' => 'POST'
		)));
	
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
	$collection->attachRoute(new Route('/catalog/products', array(
		'_controller' => 'Catalog::types',
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
	
	//  ADMIN
	$collection->attachRoute(new Route('/panel/logout', array(
		'_controller' => 'AdminController::logout',
		'parameters' => array("lang" => $lang),
		'methods' => 'GET'
	)));

	$collection->attachRoute(new Route('/panel/login', array(
		'_controller' => 'AdminController::login',
		'parameters' => array("lang" => $lang),
		'methods' => 'GET'
	)));

		$collection->attachRoute(new Route('/panel/login', array(
			'_controller' => 'AdminController::saveLogin',
			'parameters' => array("lang" => $lang),
			'methods' => 'POST'
		)));

	$collection->attachRoute(new Route('/panel', array(
		'_controller' => 'AdminController::dashboard',
		'parameters' => array("lang" => $lang),
		'methods' => 'GET'
	)));

	$collection->attachRoute(new Route('/panel/contacts/list', array(
		'_controller' => 'AdminContacto::showContacts',
		'parameters' => array("lang" => $lang),
		'methods' => 'GET'
	)));

	$collection->attachRoute(new Route('/panel/contact/:id', array(
		'_controller' => 'AdminContacto::detailContact',
		'parameters' => array("lang" => $lang),
		'methods' => 'GET'
	)));

	$collection->attachRoute(new Route('/panel/contacts/export', array(
		'_controller' => 'AdminContacto::exportContacts',
		'parameters' => array("lang" => $lang),
		'methods' => 'GET'
	)));

	$collection->attachRoute(new Route('/panel/contact/remove/:id', array(
		'_controller' => 'AdminContacto::removeContact',
		'parameters' => array("lang" => $lang),
		'methods' => 'GET'
	)));

	$collection->attachRoute(new Route('/panel/users/list', array(
		'_controller' => 'AdminUsuario::showUsers',
		'parameters' => array("lang" => $lang),
		'methods' => 'GET'
	)));

	$collection->attachRoute(new Route('/panel/user/:id', array(
		'_controller' => 'AdminUsuario::detailUser',
		'parameters' => array("lang" => $lang),
		'methods' => 'GET'
	)));

	$collection->attachRoute(new Route('/panel/news/list', array(
		'_controller' => 'AdminNoticias::showListNews',
		'parameters' => array("lang" => $lang),
		'methods' => 'GET'
	)));

	$collection->attachRoute(new Route('/panel/news/add', array(
		'_controller' => 'AdminNoticias::addNew',
		'parameters' => array("lang" => $lang),
		'methods' => 'GET'
	)));


	$collection->attachRoute(new Route('/panel/news/add', array(
		'_controller' => 'AdminNoticias::saveNew',
		'parameters' => array("lang" => $lang),
		'methods' => 'POST'
	)));

	$collection->attachRoute(new Route('/panel/new/:id_noticia', array(
		'_controller' => 'AdminNoticias::detailNew',
		'parameters' => array("lang" => $lang),
		'methods' => 'GET'
	)));

	$collection->attachRoute(new Route('/panel/new/edit/:id', array(
		'_controller' => 'AdminNoticias::editNew',
		'parameters' => array("lang" => $lang),
		'methods' => 'GET'
	)));

	$collection->attachRoute(new Route('/panel/new/remove/:id', array(
		'_controller' => 'AdminNoticias::removeNew',
		'parameters' => array("lang" => $lang),
		'methods' => 'GET'
	)));

	$collection->attachRoute(new Route('/panel/gallery/list', array(
		'_controller' => 'AdminGallery::showImages',
		'parameters' => array("lang" => $lang , "id" => 1),
		'methods' => 'GET'
	)));
	
	$collection->attachRoute(new Route('/panel/gallery/:id', array(
		'_controller' => 'AdminGallery::showImages',
		'parameters' => array("lang" => $lang),
		'methods' => 'GET'
	)));

	$collection->attachRoute(new Route('/panel/galleries/add', array(
		'_controller' => 'AdminGallery::addImage',
		'parameters' => array("lang" => $lang),
		'methods' => 'GET'
	)));

	$collection->attachRoute(new Route('/panel/press/list', array(
		'_controller' => 'AdminPress::showListPress',
		'parameters' => array("lang" => $lang),
		'methods' => 'GET'
	)));

	$collection->attachRoute(new Route('/panel/press/list/:id', array(
		'_controller' => 'AdminGallery::showImages',
		'parameters' => array("lang" => $lang),
		'methods' => 'GET'
	)));



?>