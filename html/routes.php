<?php

use PHPRouter\RouteCollection;
use PHPRouter\Route;

$collection = new RouteCollection();

$collection->attachRoute(new Route('/', array(
    '_controller' => 'Plain::homeView',
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

//Fots Television 
$collection->attachRoute(new Route('/panel/font/add/font-tv', array(
    '_controller' => 'AdminFontTV::add',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/font/add/font-tv', array(
    '_controller' => 'AdminFontTV::save',
    'methods' => 'POST'
)));

$collection->attachRoute(new Route('/panel/fonts/show-list', array(
    '_controller' => 'AdminFonts::showFonts',
    'methods' => 'GET'
)));



