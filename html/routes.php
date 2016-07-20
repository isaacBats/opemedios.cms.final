<?php

use PHPRouter\RouteCollection;
use PHPRouter\Route;

$collection = new RouteCollection();

$collection->attachRoute(new Route('/', array(
    '_controller' => 'Plain::homeView',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/quienes-somos', array(
    '_controller' => 'Plain::about',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/clientes', array(
    '_controller' => 'Plain::clients',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/contacto', array(
    '_controller' => 'Plain::contact',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/sign-in', array(
    '_controller' => 'Plain::signin',
    'methods' => 'GET'
)));


//  ADMIN
$collection->attachRoute(new Route('/panel/logout', array(
    '_controller' => 'AdminController::logout',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/login', array(
    '_controller' => 'AdminController::login',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/login', array(
    '_controller' => 'AdminController::saveLogin',
    'methods' => 'POST'
)));

$collection->attachRoute(new Route('/panel', array(
    '_controller' => 'AdminController::dashboard',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/dashboard', array(
    '_controller' => 'AdminHome::dashboard',
    'methods' => 'GET'
)));

//Show Fonts list
$collection->attachRoute(new Route('/panel/fonts/show-list', array(
    '_controller' => 'AdminFonts::showFonts',
    'methods' => 'GET'
)));


//Fonts Television 
$collection->attachRoute(new Route('/panel/font/add/font-television', array(
    '_controller' => 'AdminFontTV::add',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/font/add/font-television', array(
    '_controller' => 'AdminFontTV::save',
    'methods' => 'POST'
)));

//Fonts Radio 
$collection->attachRoute(new Route('/panel/font/add/font-radio', array(
    '_controller' => 'AdminFontRD::add',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/font/add/font-radio', array(
    '_controller' => 'AdminFontRD::save',
    'methods' => 'POST'
)));

//Fonts Periodico
$collection->attachRoute(new Route('/panel/font/add/font-periodico', array(
    '_controller' => 'AdminFontPE::add',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/font/add/font-periodico', array(
    '_controller' => 'AdminFontPE::save',
    'methods' => 'POST'
)));

//Fonts Revista
$collection->attachRoute(new Route('/panel/font/add/font-revista', array(
    '_controller' => 'AdminFontRE::add',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/font/add/font-revista', array(
    '_controller' => 'AdminFontRE::save',
    'methods' => 'POST'
)));

//Fonts Internet
$collection->attachRoute(new Route('/panel/font/add/font-internet', array(
    '_controller' => 'AdminFontIN::add',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/font/add/font-internet', array(
    '_controller' => 'AdminFontIN::save',
    'methods' => 'POST'
)));

//Agregar Sector
$collection->attachRoute(new Route('/panel/sector/add', array(
    '_controller' => 'AdminSector::add',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/sector/add', array(
    '_controller' => 'AdminSector::save',
    'methods' => 'POST'
)));

$collection->attachRoute(new Route('/panel/sector/show-list', array(
    '_controller' => 'AdminSector::showSectors',
    'methods' => 'GET'
)));

//News Television 
$collection->attachRoute(new Route('/panel/new/add/new-television', array(
    '_controller' => 'AdminNewTV::add',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/new/television/save', array(
    '_controller' => 'AdminNewTV::save',
    'methods' => 'POST'
)));

//News Radio 
$collection->attachRoute(new Route('/panel/new/add/new-radio', array(
    '_controller' => 'AdminNewRD::add',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/new/radio/save', array(
    '_controller' => 'AdminNewRD::save',
    'methods' => 'POST'
)));

//News Periodico 
$collection->attachRoute(new Route('/panel/new/add/new-periodico', array(
    '_controller' => 'AdminNewPE::add',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/new/periodico/save', array(
    '_controller' => 'AdminNewPE::save',
    'methods' => 'POST'
)));

//News Revista 
$collection->attachRoute(new Route('/panel/new/add/new-revista', array(
    '_controller' => 'AdminNewRE::add',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/new/revista/save', array(
    '_controller' => 'AdminNewRE::save',
    'methods' => 'POST'
)));

//News Internet 
$collection->attachRoute(new Route('/panel/new/add/new-internet', array(
    '_controller' => 'AdminNewIN::add',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/new/internet/save', array(
    '_controller' => 'AdminNewIN::save',
    'methods' => 'POST'
)));

//Show News list
$collection->attachRoute(new Route('/panel/news', array(
    '_controller' => 'AdminNews::showNews',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/new/view/:id', array(
    '_controller' => 'AdminNews::viewNew',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/new/edit/:id', array(
    '_controller' => 'AdminNews::editNewView',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/new/send/:id', array(
    '_controller' => 'AdminNews::sendMailView',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/new/send/client/filter', array(
    '_controller' => 'AdminNews::filterClient',
    'methods' => 'POST'
)));

$collection->attachRoute(new Route('/panel/new/send/:noticia/:idcontacto', array(
    '_controller' => 'AdminNews::searchContacts',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/new/send', array(
    '_controller' => 'AdminNews::sendAction',
    'methods' => 'POST'
)));

$collection->attachRoute(new Route('/panel/new/update-new', array(
    '_controller' => 'AdminNews::updateNew',
    'methods' => 'POST'
)));

$collection->attachRoute(new Route('/panel/news/advanced-search', array(
    '_controller' => 'AdminNews::advancedSearch',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/news/send-news-block', array(
    '_controller' => 'AdminNews::sendBlock',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/news/send-blocksss', array(
    '_controller' => 'AdminNews::sendBlockAction',
    'methods' => 'GET'
)));


$collection->attachRoute(new Route('/create-image/:id', array(
    '_controller' => 'AdminNews::createImage',
    'methods' => 'GET'
)));