<?php

use PHPRouter\RouteCollection;
use PHPRouter\Route;

$collection = new RouteCollection();

// Noticias
$collection->attachRoute(new Route('/news', array(
    '_controller' => 'Noticias::mostrarTodas',
    'parameters' => array("lang" => $lang),
    'methods' => 'GET'
)));
$collection->attachRoute(new Route('/news/:slug', array(
    '_controller' => 'Noticias::mostrarDetalle',
    'parameters' => array("lang" => $lang),
    'methods' => 'GET'
)));



//  Galerias 
$collection->attachRoute(new Route('/menu', array(
    '_controller' => 'Catalog::menuCatalog',
    'parameters' => array("lang" => $lang),
    'methods' => 'GET'
)));
$collection->attachRoute(new Route('/gallery', array(
    '_controller' => 'Gallery::allGalleries',
    'parameters' => array("lang" => $lang),
    'methods' => 'GET'
)));
$collection->attachRoute(new Route('/gallery/:slug', array(
    '_controller' => 'Gallery::showGallery',
    'parameters' => array("lang" => $lang),
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
    'parameters' => array("lang" => $lang, "type" => "painted"),
    'methods' => 'GET'
)));
$collection->attachRoute(new Route('/catalog/wood', array(
    '_controller' => 'Finish::filterFinishes',
    'parameters' => array("lang" => $lang, "type" => "wood"),
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
    '_controller' => 'Catalog::categoriesByType',
    'parameters' => array("lang" => $lang),
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/catalog/products/:type', array(
    '_controller' => 'Catalog::categoriesByType',
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
$collection->attachRoute(new Route('/favs', array(
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
    'parameters' => array("lang" => $lang, "category" => "publicity"),
    'methods' => 'GET'
)));
$collection->attachRoute(new Route('/press/brochure/:slug', array(
    '_controller' => 'Press::detail',
    'parameters' => array("lang" => $lang, "category" => "brochure"),
    'methods' => 'GET'
)));

// User

$collection->attachRoute(new Route('/login', array(
    '_controller' => 'User::login',
    'parameters' => array("lang" => $lang),
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/login/resetPass', array(
    '_controller' => 'User::resetPass',
    'parameters' => array("lang" => $lang),
    'methods' => 'POST'
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


// Profile User
$collection->attachRoute(new Route('/profile', array(
    '_controller' => 'User::getProfile',
    'parameters' => array("lang" => $lang),
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/profile/update', array(
    '_controller' => 'User::updateProfile',
    'parameters' => array("lang" => $lang),
    'methods' => 'POST'
)));

$collection->attachRoute(new Route('/profile/account', array(
    '_controller' => 'Profile::accountStatusAction',
    'parameters' => array("lang" => $lang),
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/profile/prices-list', array(
    '_controller' => 'Profile::pricesListAction',
    'parameters' => array("lang" => $lang),
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/profile/download-catalog', array(
    '_controller' => 'Profile::downloadCatalogAction',
    'parameters' => array("lang" => $lang),
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/profile/my-quote', array(
    '_controller' => 'Profile::myQuoteAction',
    'parameters' => array("lang" => $lang),
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/profile/my-quote/detail/:session', array(
    '_controller' => 'Profile::detailQuoteAction',
    'parameters' => array("lang" => $lang),
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/profile/my-quote/detail-session', array(
    '_controller' => 'Profile::detailSessionQuoteAction',
    'parameters' => array("lang" => $lang),
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/profile/my-quote/detail-session/save', array(
    '_controller' => 'Profile::detailSessionSaveQuoteAction',
    'parameters' => array("lang" => $lang),
    'methods' => 'POST'
)));

$collection->attachRoute(new Route('/profile/add-quote', array(
    '_controller' => 'Profile::addProductQuoteAction',
    'parameters' => array("lang" => $lang),
    'methods' => 'POST'
)));

$collection->attachRoute(new Route('/profile/remove-quote', array(
    '_controller' => 'Profile::removeProductQuoteAction',
    'parameters' => array("lang" => $lang),
    'methods' => 'POST'
)));



// Vistas estaticas

$collection->attachRoute(new Route('/acerca-de/quienes-somos', array(
    '_controller' => 'Plain::whoWeAreView',
    'parameters' => array("lang" => $lang),
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/terms', array(
    '_controller' => 'Plain::terminos',
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

$collection->attachRoute(new Route('/panel/contact/remove', array(
    '_controller' => 'AdminContacto::removeContact',
    'parameters' => array("lang" => $lang),
    'methods' => 'POST'
)));

$collection->attachRoute(new Route('/panel/users/list', array(
    '_controller' => 'AdminUsuario::showUsers',
    'parameters' => array("lang" => $lang),
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/users/updateStatus', array(
    '_controller' => 'AdminUsuario::updateStatus',
    'parameters' => array("lang" => $lang),
    'methods' => 'POST'
)));

$collection->attachRoute(new Route('/panel/user/:id', array(
    '_controller' => 'AdminUsuario::detailUser',
    'parameters' => array("lang" => $lang),
    'methods' => 'GET'
)));

// Admin news
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
    '_controller' => 'AdminNoticias::editNewAction',
    'parameters' => array("lang" => $lang),
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/news/save-changes', array(
    '_controller' => 'AdminNoticias::saveNewChangesAction',
    'parameters' => array("lang" => $lang),
    'methods' => 'POST'
)));

$collection->attachRoute(new Route('/panel/new/remove/:id', array(
    '_controller' => 'AdminNoticias::removeNew',
    'parameters' => array("lang" => $lang),
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/gallery/list', array(
    '_controller' => 'AdminGallery::showImages',
    'parameters' => array("lang" => $lang, "id" => 1),
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/gallery/:id', array(
    '_controller' => 'AdminGallery::showImages',
    'parameters' => array("lang" => $lang),
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/galleries/add/:id_gallery', array(
    '_controller' => 'AdminGallery::addImage',
    'parameters' => array("lang" => $lang),
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/galleries/save', array(
    '_controller' => 'AdminGallery::saveImageAction',
    'parameters' => array("lang" => $lang),
    'methods' => 'POST'
)));

// Admin Catalog
$collection->attachRoute(new Route('/panel/catalog/export', array(
    '_controller' => 'Catalog::export',
    'parameters' => array("lang" => $lang),
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/catalog/import', array(
    '_controller' => 'Catalog::import',
    'parameters' => array("lang" => $lang),
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/catalog/import', array(
    '_controller' => 'Catalog::import',
    'parameters' => array("lang" => $lang),
    'methods' => 'POST'
)));

// $collection->attachRoute(new Route('/update', array(
// 	'_controller' => 'Catalog::updateProducts',
// 	'parameters' => array("lang" => $lang),
// 	'methods' => 'GET'
// )));





$collection->attachRoute(new Route('/panel/catalog/categories/list', array(
    '_controller' => 'AdminCatalog::listCategoriesAction',
    'parameters' => array("lang" => $lang),
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/catalog/:category/:name', array(
    '_controller' => 'AdminCatalog::listRelatedProductAction',
    'parameters' => array("lang" => $lang),
    'methods' => 'GET'
)));
$collection->attachRoute(new Route('/panel/catalog/mainproductbycat', array(
    '_controller' => 'AdminCatalog::mainProductByCat',
    'parameters' => array("lang" => $lang),
    'methods' => 'POST'
)));
//Admin Press
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

$collection->attachRoute(new Route('/panel/add/gallery', array(
    '_controller' => 'AdminPress::addGalleryAction',
    'parameters' => array("lang" => $lang),
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/save/gallery', array(
    '_controller' => 'AdminPress::saveGalleryAction',
    'parameters' => array("lang" => $lang),
    'methods' => 'POST'
)));

//TEMP Relacionados link temporal
$collection->attachRoute(new Route('/gallery/relatedImgs', array(
    '_controller' => 'Gallery::showRelatedAction',
    'parameters' => array("lang" => $lang),
    'methods' => 'POST'
)));
?>