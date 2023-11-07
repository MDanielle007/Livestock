<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/loginAuth', 'UserController::loginAuth');

// gawa ka ng routes para sa function na ginawa mo

$routes->group('admin',static function($routes){
    $routes->post('register', 'UserController::register');
    $routes->get('getUserAccounts', 'UserController::getUserAccounts');
    $routes->post('registerFarmer', 'UserController::registerFarmer');
    $routes->post('editFarmerProfile', 'UserController::editFarmerProfile');
    $routes->post('archiveFarmerprofile', 'UserController::archiveFarmerprofile');
});

$routes->group('farmer',static function($routes){
    $routes->post('addLivestock', 'FarmerController::addLivestock');
    $routes->post('editLivestockDetails', 'FarmerController::editLivestockDetails');
    $routes->post('archiveLivestockRecord', 'FarmerController::archiveLivestockRecord');
    $routes->post('getFarmerProfile', 'FarmerController::getFarmerProfile');
    $routes->get('getOneLivestock/(:segment)/(:segment)', 'FarmerController::getOneLivestock/$1/$2');
    $routes->get('getAllFarmerLivestock/(:any)', 'FarmerController::getAllFarmerLivestock/$1');
    $routes->post('getLivestockTypeCount','FarmerController::getLivestockTypeCount');
    $routes->post('getFarmerLivestockTypeCount','FarmerController::getLivestockTypeCount');
});