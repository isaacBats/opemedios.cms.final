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

$collection->attachRoute(new Route('/sign-out', array(
    '_controller' => 'User::logout',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/sign-in', array(
    '_controller' => 'User::loginAction',
    'methods' => 'POST'
)));
// Usuario noticias
$collection->attachRoute(new Route('/noticias', array(
    '_controller' => 'Profile::showNews',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/media/:fuente/:noticia', array(
    '_controller' => 'Plain::viewMedia',
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

$collection->attachRoute(new Route('/panel/fonts/detail/:id', array(
    '_controller' => 'AdminFonts::fontDetail',
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

$collection->attachRoute(new Route('/panel/new/encabezado/:fuente/:adjuntoId', array(
    '_controller' => 'AdminNewPE::previewHeader',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/new/encabezado/edit', array(
    '_controller' => 'AdminNewPE::editHeaderAction',
    'methods' => 'POST'
)));

$collection->attachRoute(new Route('/panel/new/encabezado/delete', array(
    '_controller' => 'AdminNewPE::deleteHeaderAction',
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

$collection->attachRoute(new Route('/panel/new/add-file/:id', array(
    '_controller' => 'AdminNews::addFileView',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/new/add-file/:id', array(
    '_controller' => 'AdminNews::addFileAction',
    'methods' => 'POST'
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

$collection->attachRoute(new Route('/panel/news/blocks', array(
    '_controller' => 'AdminNews::blockNewsView',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/block/create', array(
    '_controller' => 'AdminNews::createBlock',
    'methods' => 'POST'
)));

$collection->attachRoute(new Route('/panel/block/edit', array(
    '_controller' => 'AdminNews::editBlock',
    'methods' => 'POST'
)));

$collection->attachRoute(new Route('/panel/block/add-new', array(
    '_controller' => 'AdminNews::addNewBlock',
    'methods' => 'POST'
)));

$collection->attachRoute(new Route('/panel/block-new/delete', array(
    '_controller' => 'AdminNews::deleteNewBlock',
    'methods' => 'POST'
)));

$collection->attachRoute(new Route('/panel/news/blocks/:id', array(
    '_controller' => 'AdminNews::detailBlockView',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/news/block/send', array(
    '_controller' => 'AdminNews::sendBlock',
    'methods' => 'POST'
)));

// $collection->attachRoute(new Route('/panel/news/send-news-block', array(
//     '_controller' => 'AdminNews::sendBlockNewsAction',
//     'methods' => 'POST'
// )));

// $collection->attachRoute(new Route('/panel/news/send-block', array(
//     '_controller' => 'AdminNews::sendBlockAction',
//     'methods' => 'POST'
// )));

//Sections of Fonts
    // Sections
$collection->attachRoute(new Route('/panel/get/seccion/:id', array(
    '_controller' => 'AdminFonts::getSectionsByFontId',
    'methods' => 'GET'
)));

    // trae el nombre de un autor de una seccion 
$collection->attachRoute(new Route('/panel/seccion/autor/:seccion', array(
    '_controller' => 'AdminFonts::getAuthor',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/fonts/fonts-by-type/:typefont', array(
    '_controller' => 'AdminFonts::getFontsByTypeFont',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/font/section/change-state', array(
    '_controller' => 'AdminFonts::changeState',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/font/section/add', array(
    '_controller' => 'AdminFonts::addSection',
    'methods' => 'POST'
)));

//Selection of Tema
$collection->attachRoute(new Route('/panel/get/temas/:id', array(
    '_controller' => 'AdminEmpresa::getIssuesByCompanyId',
    'methods' => 'GET'
)));

//Empresas
$collection->attachRoute(new Route('/panel/companies', array(
    '_controller' => 'AdminEmpresa::showCompanies',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/company/add', array(
    '_controller' => 'AdminEmpresa::addClientView',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/company/add', array(
    '_controller' => 'AdminEmpresa::addClientAction',
    'methods' => 'POST'
)));

$collection->attachRoute(new Route('/panel/client/:id', array(
    '_controller' => 'AdminEmpresa::clientDetail',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/client/tema/add', array(
    '_controller' => 'AdminEmpresa::addThemeAction',
    'methods' => 'POST'
)));

$collection->attachRoute(new Route('/panel/client/cuenta/add', array(
    '_controller' => 'AdminEmpresa::addAccountAction',
    'methods' => 'POST'
)));

$collection->attachRoute(new Route('/panel/client/theme-acount', array(
    '_controller' => 'AdminEmpresa::relatedAccountThemeAction',
    'methods' => 'POST'
)));

$collection->attachRoute(new Route('/panel/client/edit/:id', array(
    '_controller' => 'AdminEmpresa::editCompany',
    'methods' => 'POST'
)));

$collection->attachRoute(new Route('/panel/client/logo/edit', array(
    '_controller' => 'AdminEmpresa::changeLogoAction',
    'methods' => 'POST'
)));

//Usuarios
$collection->attachRoute(new Route('/panel/users', array(
    '_controller' => 'AdminUsuario::showUsers',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/user/add', array(
    '_controller' => 'AdminUsuario::createUser',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/user/add', array(
    '_controller' => 'AdminUsuario::createUserAction',
    'methods' => 'POST'
)));

$collection->attachRoute(new Route('/panel/user/:id', array(
    '_controller' => 'AdminUsuario::userDetail',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/user/edit/:id', array(
    '_controller' => 'AdminUsuario::editUser',
    'methods' => 'POST'
)));


//Tarifario
    //admin tariff
$collection->attachRoute(new Route('/panel/tariff', array(
    '_controller' => 'AdminTarifario::tarifariosAdmin',
    'methods' => 'GET'
)));

    //Import tariff
$collection->attachRoute(new Route('/panel/tariff/add', array(
    '_controller' => 'AdminTarifario::addTariff',
    'methods' => 'POST'
)));


$collection->attachRoute(new Route('/create-image/:id', array(
    '_controller' => 'AdminNews::createImage',
    'methods' => 'GET'
)));


//Prensa
$collection->attachRoute(new Route('/panel/prensa/primeras-planas', array(
    '_controller' => 'AdminColumns::primerasPlanas',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/prensa/portadas-financieras', array(
    '_controller' => 'AdminColumns::portadasFinancieras',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/prensa/cartones', array(
    '_controller' => 'AdminColumns::cartones',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/prensa/columnas-politicas', array(
    '_controller' => 'AdminColumns::columnasPoliticas',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/prensa/columnas-financieras', array(
    '_controller' => 'AdminColumns::columnasFinancieras',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/prensa/guardar-portada', array(
    '_controller' => 'AdminColumns::guardarPortada',
    'methods' => 'POST'
)));

$collection->attachRoute(new Route('/panel/prensa/guardar-columna', array(
    '_controller' => 'AdminColumns::guardarColumna',
    'methods' => 'POST'
)));

// Reportes
$collection->attachRoute(new Route('/panel/reports/clients', array(
    '_controller' => 'AdminReports::reportClientView',
    'methods' => 'GET'
)));



// Reutas de prueba
// $collection->attachRoute(new Route('/calcula-fraccion', array(
//     '_controller' => 'Image::obtieneCifras',
//     'parameters' => ['new' => 'hola'],
//     'methods' => 'GET'
// )));