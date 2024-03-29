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

$collection->attachRoute(new Route('/archivos/generados/pdf/:key', array(
    '_controller' => 'Plain::createdFiles',
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

// Usuario Perfil
    //Noticias
$collection->attachRoute(new Route('/noticias', array(
    '_controller' => 'Profile::showNews',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/noticia/:fontType/:id', array(
    '_controller' => 'Profile::detailNewView',
    'methods' => 'GET'
)));

    //Compartir Noticia
$collection->attachRoute(new Route('/share/:fontType/:id', array(
    '_controller' => 'Profile::detailShare',
    'methods' => 'GET'
)));

    //Portadas
$collection->attachRoute(new Route('/primeras-planas', array(
    '_controller' => 'Profile::primerasPlanas',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/portadas-financieras', array(
    '_controller' => 'Profile::portadasFinancieras',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/cartones', array(
    '_controller' => 'Profile::Cartones',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/columnas-financieras', array(
    '_controller' => 'Profile::columnasFinancieras',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/columnas-politicas', array(
    '_controller' => 'Profile::columnasPoliticas',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/columnas/:type/:id', array(
    '_controller' => 'Profile::detailColumn',
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

$collection->attachRoute(new Route('/panel/font/delete/:id', array(
    '_controller' => 'AdminFonts::deleteFont',
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

$collection->attachRoute(new Route('/panel/font/edit/:id', array(
    '_controller' => 'AdminFonts::update',
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
//reemplazar un archivo adjunto
$collection->attachRoute(new Route('/panel/new/replace-attached', array(
    '_controller' => 'AdminNews::replaceFile',
    'methods' => 'POST'
)));

// viewNew # 54 form for add file comment
// $collection->attachRoute(new Route('/panel/new/adjunto-add/:publicId', array(
//     '_controller' => 'AdminNews::addAttachment',
//     'methods' => 'POST'
// )));

$collection->attachRoute(new Route('/panel/new/send/:id', array(
    '_controller' => 'AdminNews::sendMailView',
    'methods' => 'GET'
)));
//delete a new
$collection->attachRoute(new Route('/panel/new/remove', array(
    '_controller' => 'AdminNews::removeNew',
    'methods' => 'POST'
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

$collection->attachRoute(new Route('/panel/new/preview/:idnoticia/:idempresa', array(
    '_controller' => 'AdminNews::previewMail',
    'methods' => 'GET'
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

/*Joz*/

$collection->attachRoute(new Route('/panel/news/records', array(
    '_controller' => 'AdminNews::blockNewsRecords',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/news/blocks/records/:id', array(
    '_controller' => 'AdminNews::detailBlockRecordsView',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/news/block/records/send', array(
    '_controller' => 'AdminNews::sendBlockRecords',
    'methods' => 'POST'
)));

/*/joz*/

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

$collection->attachRoute(new Route('/panel/news/blocks/delete', array(
    '_controller' => 'AdminNews::rmBlock',
    'methods' => 'POST'
)));

$collection->attachRoute(new Route('/panel/news/blocks/preview/:id', array(
    '_controller' => 'AdminNews::mailPreviewBlock',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/newsletters/historic', array(
    '_controller' => 'Newsletters::index',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/newsletter/contacts', array(
    '_controller' => 'Newsletters::getContacts',
    'methods' => 'POST'
)));

$collection->attachRoute(new Route('/panel/newsletter/resend', array(
    '_controller' => 'Newsletters::resend',
    'methods' => 'POST'
)));

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

$collection->attachRoute(new Route('/panel/font/section/edit/:id', array(
    '_controller' => 'AdminFonts::editSection',
    'methods' => 'POST'
)));

$collection->attachRoute(new Route('/panel/font/section/delete/:id', array(
    '_controller' => 'AdminFonts::deleteSection',
    'methods' => 'GET'
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

$collection->attachRoute(new Route('/panel/client/remove/:id', array(
    '_controller' => 'AdminEmpresa::deleteClient',
    'methods' => 'POST'
)));

$collection->attachRoute(new Route('/panel/client/tema/add', array(
    '_controller' => 'AdminEmpresa::addThemeAction',
    'methods' => 'POST'
)));

$collection->attachRoute(new Route('/panel/client/tema/edit', array(
    '_controller' => 'AdminEmpresa::editTopic',
    'methods' => 'POST'
)));

$collection->attachRoute(new Route('/panel/client/cuenta/add', array(
    '_controller' => 'AdminEmpresa::addAccountAction',
    'methods' => 'POST'
)));

$collection->attachRoute(new Route('/panel/client/cuenta/change-state', array(
    '_controller' => 'AdminEmpresa::changeStateAcount',
    'methods' => 'GET'
)));
//remove account from company
$collection->attachRoute(new Route('/panel/client/cuenta/rm-account', array(
    '_controller' => 'AdminEmpresa::rmAccount',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/client/cuenta/rm-theme', array(
    '_controller' => 'AdminEmpresa::rmTheme',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/client/cuenta/get/:id', array(
    '_controller' => 'AdminEmpresa::getAcountJsonById',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/client/cuenta/update/:id', array(
    '_controller' => 'AdminEmpresa::updateAcount',
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

$collection->attachRoute(new Route('/panel/user/delete/:id', array(
    '_controller' => 'AdminUsuario::deleteUser',
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

$collection->attachRoute(new Route('/panel/prensa/show/:tipo/:id', array(
    '_controller' => 'AdminColumns::showColumn',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/prensa/editar/:tipo/:id', array(
    '_controller' => 'AdminColumns::editColumn',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/prensa/delete/column/:id', array(
    '_controller' => 'AdminColumns::deleteColumn',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/prensa/delete/cover/:id', array(
    '_controller' => 'AdminColumns::deleteCover',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/prensa/editar/:tipo/:id', array(
    '_controller' => 'AdminColumns::updateColumn',
    'methods' => 'POST'
)));

$collection->attachRoute(new Route('/panel/prensa/guardar-portada', array(
    '_controller' => 'AdminColumns::guardarPortada',
    'methods' => 'POST'
)));

$collection->attachRoute(new Route('/panel/prensa/guardar-columna', array(
    '_controller' => 'AdminColumns::guardarColumna',
    'methods' => 'POST'
)));

$collection->attachRoute(new Route('/panel/prensa/generar-pdf', array(
    '_controller' => 'AdminColumns::createPDF',
    'methods' => 'POST'
)));

$collection->attachRoute(new Route('/panel/prensa/generar-pdf-columns', array(
    '_controller' => 'AdminColumns::createPDFColumns',
    'methods' => 'POST'
)));

// Reportes
$collection->attachRoute(new Route('/panel/reports/clients', array(
    '_controller' => 'AdminReports::reportClientView',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/reports/clients', array(
    '_controller' => 'AdminReports::getReportClient',
    'methods' => 'POST'
)));

$collection->attachRoute(new Route('/panel/reports/today', array(
    '_controller' => 'AdminReports::reportTodayView',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/panel/asignacion/noticias-por-cliente', array(
  '_controller' => 'AdminReports::getNewsByClient',
  'methods'     => 'GET'
)));

$collection->attachRoute(new Route('/panel/asignacion/noticias-por-cliente', array(
    '_controller'   => 'AdminReports::searchNewsByClient',
    'methods'       => 'POST' 
)));

//acciones para cambiar [Tema o Tendencia de una noticia], eliminar noticia del portal.
$collection->attachRoute(new Route('/panel/asignacion/change-trend-theme/', array(
    '_controller'   => 'AdminNews::updateThemeTrend',
    'methods'       => 'POST' 
)));

$collection->attachRoute(new Route('/reporte/cliente/', array(
    '_controller'   => 'ClientReports::reportClientView',
    'methods'       => 'GET' 
)));

$collection->attachRoute(new Route('/reporte/cliente/', array(
    '_controller'   => 'ClientReports::getReportClient',
    'methods'       => 'POST' 
)));
// Reutas de prueba
// $collection->attachRoute(new Route('/calcula-fraccion', array(
//     '_controller' => 'Image::obtieneCifras',
//     'parameters' => ['new' => 'hola'],
//     'methods' => 'GET'
// )));
//
$collection->attachRoute(new Route('/test/mail-block', array(
    '_controller' => 'AdminNews::testSendMail',
    'methods' => 'GET'
)));

