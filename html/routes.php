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