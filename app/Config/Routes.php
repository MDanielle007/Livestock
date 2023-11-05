<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/admin/register', 'UserController::register');
$routes->get('/admin/getUserAccounts', 'UserController::getUserAccounts');
$routes->post('/loginAuth', 'UserController::loginAuth');


$routes->get('/farmer/getLivestockLastID', 'FarmerController::getLivestockLastID');
$routes->post('/farmer/addLivestock', 'FarmerController::addLivestock');


$routes->get('/farmer/getAllFarmerLivestock/(:any)', 'FarmerController::getAllFarmerLivestock/$1'); 
// gawa ka ng routes para sa function na ginawa mo