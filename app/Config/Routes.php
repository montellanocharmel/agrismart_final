<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'LoginController::index');
$routes->get('/dashboards', 'DashboardController::dashboards', ['filter' => 'authGuard']);
$routes->post('/register', 'LoginController::register');
$routes->get('/registerview', 'LoginController::registerview');
$routes->get('/sign_ins', 'LoginController::login');
$routes->post('/loginauth', 'LoginController::loginauth');
$routes->match(['post', 'get'], '/dashboards', 'LoginController::dashboards', ['filter' => 'authGuard']);

//admin

$routes->get('/manageaccounts', 'DashboardController::manageaccounts');

//fields

$routes->get('/viewfields', 'DashboardController::viewfields');
$routes->post('/addfield', 'DashboardController::addnewfield');
$routes->post('/viewfields/edit/(:num)', 'DashboardController::edit/$1');
$routes->post('/viewfields/update', 'DashboardController::update');
$routes->post('viewfields/delete/(:num)', 'DashboardController::deleteProduct/$1');


// crop planting
$routes->get('/cropplanting', 'DashboardController::cropplanting');
$routes->post('/addplanting', 'DashboardController::addnewplanting');
$routes->post('/cropplanting/edit/(:num)', 'DashboardController::editplanting/$1');
$routes->post('/cropplanting/update', 'DashboardController::updateplanting');
$routes->post('cropplanting/delete/(:num)', 'DashboardController::deleteplanting/$1');


//expenses
$routes->get('/expenses', 'DashboardController::expenses', ['filter' => 'authGuard']);
$routes->post('/addexpenses', 'DashboardController::addnewjob');
$routes->post('/expenses/edit/(:num)', 'DashboardController::editexpenses/$1');
$routes->post('/expenses/update', 'DashboardController::updateexpenses');
$routes->post('expensess/delete/(:num)', 'DashboardController::deleteexpenses/$1');


//harvest
$routes->get('/harvest', 'DashboardController::harvest', ['filter' => 'authGuard']);
$routes->post('/addharvest', 'DashboardController::addnewharvest');
$routes->post('/harvest/edit/(:num)', 'DashboardController::editharvest/$1');
$routes->post('/harvest/update', 'DashboardController::updateharvest');
$routes->post('harvest/delete/(:num)', 'DashboardController::deleteHarvest/$1');
/*
// worker
$routes->get('/workers', 'DashboardController::worker', ['filter' => 'authGuard']);
$routes->post('/addworker', 'DashboardController::addnewworker');
$routes->post('/workers/edit/(:num)', 'DashboardController::editworker/$1');
$routes->post('/workers/update', 'DashboardController::updateworker');
$routes->post('workers/delete/(:num)', 'DashboardController::deleteworker/$1');

// crop variety 
$routes->get('/cropvariety', 'DashboardController::cropvariety', ['filter' => 'authGuard']);
$routes->post('/addvariety', 'DashboardController::addnewvariety');

// fertilizers
$routes->get('/fertilizers', 'DashboardController::fertilizers', ['filter' => 'authGuard']);
$routes->post('/addfertilizers', 'DashboardController::addnewfertilizers');

// equipment
$routes->get('/equipment', 'DashboardController::equipment', ['filter' => 'authGuard']);
$routes->post('/addequipment', 'DashboardController::addnewequipment');

// chart
$routes->get('/getChartData', 'LoginController::getChartData');

// profile
$routes->get('/addprofile', 'DashboardController::addprofile');
$routes->post('/addfarmerprofile', 'DashboardController::addfarmerprofile');



// admin register and email verification
$routes->post('/adminloginauth', 'LoginController::adminloginauth');
$routes->get('/registeradmin', 'LoginController::registeradmin');
$routes->match(['get', 'post'], '/signups', 'LoginController::signups');
$routes->match(['get', 'post'], 'verify/(:any)', 'LoginController::verify/$1');
$routes->get('/signinadmin', 'LoginController::loginadmin');
$routes->match(['post', 'get'], '/admindashboard', 'LoginController::admindashboard');



// admin dashboard
$routes->get('/adminfields', 'DashboardController::adminfields');
$routes->get('/admincropplanting', 'DashboardController::admincropplanting');
$routes->get('/adminharvest', 'DashboardController::adminharvest');

$routes->get('/map', 'DashboardController::map');
$routes->get('/eq', 'DashboardController::eq');


$routes->get('/maps', 'DashboardController::farmermap');
$routes->get('/eq', 'DashboardController::eq');
*/