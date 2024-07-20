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

$routes->get('/about', 'LoginController::about');
$routes->get('/trivias', 'LoginController::trivias');
$routes->get('/reports', 'LoginController::reports');
$routes->get('/trainings', 'LoginController::trainings');

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


// profile
$routes->get('/farmerprofiles', 'DashboardController::farmerprofiles');
$routes->post('/addfarmerprofile', 'DashboardController::addfarmerprofile');
$routes->post('/farmer/edit/(:num)', 'DashboardController::editfarmer/$1');
$routes->post('/farmer/update', 'DashboardController::updatefarmer');
$routes->post('farmer/delete/(:num)', 'DashboardController::deletefarmer/$1');
$routes->post('/searchProfiles', 'DashboardController::searchProfiles');
$routes->get('/myprofile', 'DashboardController::myprofile');


//damages
$routes->get('/damages', 'DashboardController::damages', ['filter' => 'authGuard']);
$routes->post('/adddamage', 'DashboardController::addnewdamage');
$routes->post('/damage/edit/(:num)', 'DashboardController::editdamage/$1');
$routes->post('/damage/update', 'DashboardController::updatedamage');
$routes->post('damage/delete/(:num)', 'DashboardController::deletedamage/$1');

// maps
$routes->get('/map', 'DashboardController::map');
$routes->get('/eq', 'DashboardController::eq');
$routes->get('/maps', 'DashboardController::farmermap');
$routes->get('/eq', 'DashboardController::eq');

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
$routes->get('/adminexpense', 'DashboardController::adminexpense');
$routes->get('/admindamage', 'DashboardController::admindamages');
$routes->get('/adminviewcharts', 'DashboardController::admincharts');

$routes->get('/map', 'DashboardController::map');
$routes->get('/eq', 'DashboardController::eq');


$routes->get('/maps', 'DashboardController::farmermap');
$routes->get('/eq', 'DashboardController::eq');

//farmer stats
$routes->get('/farmerstats', 'LoginController::farmerstats');
$routes->post('/searchFarmerProfiles', 'LoginController::searchFarmerProfiles');

//manage accounts

$routes->get('/manageaccounts', 'LoginController::manageaccounts');
$routes->post('/updatepassword/edit/(:num)', 'LoginController::editpassword/$1');
$routes->post('/updatepassword/update', 'LoginController::updatepassword');
$routes->get('/restrict-account/(:num)', 'LoginController::restrictAccount/$1');
$routes->get('/unrestrict-account/(:num)', 'LoginController::unrestrictAccount/$1');
$routes->post('/updateaccount/edit/(:num)', 'LoginController::editaccount/$1');
$routes->post('/updateaccount/update', 'LoginController::updateaccount');


// search functions

$routes->post('/searchfields', 'DashboardController::searchFields');
$routes->post('/searchexpense', 'DashboardController::searchExpense');
$routes->post('/searchharvest', 'DashboardController::searchHarvest');
$routes->post('/searchdamage', 'DashboardController::searchDamage');
$routes->post('/searchfarmerprofiles', 'DashboardController::searchfarmerprofiles');
$routes->post('/searchadminfields', 'DashboardController::searchadminFields');
$routes->post('/searchadmincropplanting', 'DashboardController::searchadminCropplanting');
$routes->post('/searchadminexpense', 'DashboardController::searchadminExpense');
$routes->post('/searchadmindamage', 'DashboardController::searchadminDamage');
$routes->post('/searchadminharvest', 'DashboardController::searchadminHarvest');
$routes->post('/searchadminmanageaccounts', 'DashboardController::searchadminmanageaccounts');
$routes->post('/searchtrivia', 'DashboardController::searchTrivia');
$routes->post('/searchreports', 'DashboardController::searchReports');
$routes->post('/searchtrainings', 'DashboardController::searchTrainings');
$routes->post('/searchusertrivia', 'DashboardController::searchUserTrivia');
$routes->post('/searchpest', 'DashboardController::searchPest');
$routes->post('/searchdisease', 'DashboardController::searchDisease');
$routes->post('/searchuserpest', 'DashboardController::searchuserPest');
$routes->post('/searchuserdisease', 'DashboardController::searchuserDisease');


// export
$routes->get('/exportToExcel', 'DashboardController::exportToExcel');
$routes->post('/upload-excel', 'DashboardController::importExcel');
$routes->get('/exportToExceldamage', 'DashboardController::exportToExceldamage');
$routes->get('/exportToExcelplanting', 'DashboardController::exportToExcelplanting');
$routes->get('/exportToExcelharvest', 'DashboardController::exportToExcelharvest');
$routes->get('/exportToExcelexpense', 'DashboardController::exportToExcelexpense');
$routes->get('/exportToExcelfarmerprofiles', 'DashboardController::exportToExcelfarmerprofiles');
$routes->get('/exportToExceladminfields', 'DashboardController::exportToExceladminfields');
$routes->get('/exportToExceladminplanting', 'DashboardController::exportToExceladminplanting');
$routes->get('/exportToExceldamage', 'DashboardController::exportToExceldamage');
$routes->get('/exportToExceladminexpense', 'DashboardController::exportToExceladminexpense');
$routes->get('/exportToExceladmindamage', 'DashboardController::exportToExceladmindamage');
$routes->get('/exportToExceladminharvest', 'DashboardController::exportToExceladminharvest');

// charts
$routes->get('/viewcharts', 'DashboardController::charts');

//adtrivias
$routes->get('/adtrivias', 'DashboardController::adtrivias');
$routes->post('/addtrivia', 'DashboardController::addnewtrivia');
$routes->post('/adtrivias/edit/(:num)', 'DashboardController::edittrivia/$1');
$routes->post('/adtrivias/update', 'DashboardController::updatetrivia');
$routes->post('adtrivias/delete/(:num)', 'DashboardController::deletetrivia/$1');
$routes->get('/triviareadmore/(:num)', 'LoginController::triviareadmore/$1');

//trainings
$routes->get('/adtrainings', 'DashboardController::adtrainings');

//adreports
$routes->get('/adreports', 'DashboardController::adreports');
$routes->post('/addreport', 'DashboardController::addnewreport');
$routes->post('/adreports/edit/(:num)', 'DashboardController::editreport/$1');
$routes->post('/reports/update', 'DashboardController::updatereport');
$routes->post('adreports/delete/(:num)', 'DashboardController::deletereport/$1');
$routes->get('/reportsreadmore/(:num)', 'LoginController::reportsreadmore/$1');

//adtrainings
$routes->get('/adtrainings', 'DashboardController::adtrainings');
$routes->post('/addtraining', 'DashboardController::addnewtraining');
$routes->post('/adtrainings/edit/(:num)', 'DashboardController::edittraining/$1');
$routes->post('/trainings/update', 'DashboardController::updatetraining');
$routes->post('adtrainings/delete/(:num)', 'DashboardController::deletetraining/$1');
$routes->get('/trainingreadmore/(:num)', 'LoginController::trainingreadmore/$1');

//adpest
$routes->get('/adpest', 'DashboardController::adpest');
$routes->post('/addpest', 'DashboardController::addnewpest');
$routes->post('/adpest/edit/(:num)', 'DashboardController::editpest/$1');
$routes->post('/adpest/update', 'DashboardController::updatepest');
$routes->post('adpest/delete/(:num)', 'DashboardController::deletepest/$1');
$routes->get('/pestreadmore/(:num)', 'LoginController::pestreadmore/$1');

//addiseases
$routes->get('/addisease', 'DashboardController::addisease');
$routes->post('/adddisease', 'DashboardController::addnewdisease');
$routes->post('/addisease/edit/(:num)', 'DashboardController::editdisease/$1');
$routes->post('/addisease/update', 'DashboardController::updatedisease');
$routes->post('addisease/delete/(:num)', 'DashboardController::deletedisease/$1');
$routes->get('/diseasereadmore/(:num)', 'LoginController::diseasereadmore/$1');

//userreports
$routes->get('/userreports', 'DashboardController::userreports');
$routes->post('/useraddeports', 'DashboardController::addnewuserreport');
$routes->post('/edituserreport/edit/(:num)', 'DashboardController::edituserreport/$1');
$routes->post('/updateuserreport/update', 'DashboardController::updateuserreport');
$routes->post('deleteuserreport/delete/(:num)', 'DashboardController::deleteuserreport/$1');
$routes->get('/userreportsreadmore/(:num)', 'DashboardController::userreportsreadmore/$1');

//usertrivias
$routes->get('/usertrivias', 'DashboardController::usertrivias');

//usertrainings
$routes->get('/usertrainings', 'DashboardController::usertrainings');
$routes->post('/addusertrainings', 'DashboardController::addusertrainings');
$routes->post('/usertrainings/edit/(:num)', 'DashboardController::editusertraining/$1');
$routes->post('/usertrainings/update', 'DashboardController::updateusertraining');
$routes->post('usertrainings/delete/(:num)', 'DashboardController::deleteusertraining/$1');

//userpest
$routes->get('/userpest', 'DashboardController::userpest');

//userdisease
$routes->get('/userdisease', 'DashboardController::userdisease');

$routes->get('/trivias', 'LoginController::trivias');

$routes->get('/disease', 'LoginController::disease');
$routes->get('/pest', 'LoginController::pest');


// PDF
$routes->get('exportToPDFadminfields', 'DashboardController::exportToPDF');
$routes->get('exportToPDFadminplanting', 'DashboardController::exportToPDFplanting');
$routes->get('exportToPDFadminexpenses', 'DashboardController::exportToPDFexpenses');
$routes->get('exportToPDFadmindamage', 'DashboardController::exportToPDFdamage');
$routes->get('exportToPDFadminharvest', 'DashboardController::exportToPDFharvest');
$routes->get('/exportToPDFusers', 'LoginController::exportToPDFusers');

$routes->get('/showFieldDetails/(:num)', 'DashboardController::showFieldDetails/$1');
