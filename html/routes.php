<?php

use PHPRouter\RouteCollection;
use PHPRouter\Route;

$collection = new RouteCollection();


// User

$collection->attachRoute(new Route('/login', array(
    '_controller' => 'User::login',
    'parameters' => array("lang" => 'hola'),
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/login/resetPass', array(
    '_controller' => 'User::resetPass',
    'parameters' => array("lang" => 'hola'),
    'methods' => 'POST'
)));

$collection->attachRoute(new Route('/logout', array(
    '_controller' => 'User::logout',
    'parameters' => array("lang" => 'hola'),
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/login', array(
    '_controller' => 'User::loginAction',
    'parameters' => array("lang" => 'hola'),
    'methods' => 'POST'
)));

$collection->attachRoute(new Route('/register', array(
    '_controller' => 'User::showForm',
    'parameters' => array("lang" => 'hola'),
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/register', array(
    '_controller' => 'User::saveRegistro',
    'parameters' => array("lang" => 'hola'),
    'methods' => 'POST'
)));



$collection->attachRoute(new Route('/', array(
    '_controller' => 'Plain::homeView',
    'parameters' => array("lang" => 'hola'),
    'methods' => 'GET'
)));


//  ADMIN
$collection->attachRoute(new Route('/panel/logout', array(
    '_controller' => 'AdminController::logout',
    'parameters' => array("lang" => 'hola'),
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/login', array(
    '_controller' => 'AdminController::login',
    'parameters' => array("lang" => 'hola'),
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/login', array(
    '_controller' => 'AdminController::saveLogin',
    'parameters' => array("lang" => 'hola'),
    'methods' => 'POST'
)));

$collection->attachRoute(new Route('/panel', array(
    '_controller' => 'AdminController::dashboard',
    'parameters' => array("lang" => 'hola'),
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/dashboard', array(
    '_controller' => 'AdminHome::dashboard',
    'parameters' => array("lang" => 'hola'),
    'methods' => 'GET'
)));

//Fots 
$collection->attachRoute(new Route('/panel/font/add/font/tv', array(
    '_controller' => 'AdminFontTV::add',
    'methods' => 'GET'
)));

