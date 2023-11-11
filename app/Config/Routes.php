<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/loginAuth', 'UserController::loginAuth');
$routes->get('/getLivestockTypes', 'GeneralController::getLivestockTypes');
$routes->get('/getLivestockBreeds/(:any)', 'GeneralController::getLivestockBreeds/$1');

$routes->group('admin',static function($routes){
    $routes->post('registerUserAccount', 'UserController::registerUserAccount');
    $routes->get('getUserAccounts', 'UserController::getUserAccounts');
    $routes->post('editFarmerProfile', 'UserController::editFarmerProfile');
    $routes->post('archiveFarmerprofile', 'UserController::archiveFarmerprofile');
    $routes->post('addLivestockType', 'AdminController::addLivestockType');
    $routes->post('editLivestockType', 'AdminController::editLivestockType');
    $routes->post('removeLivestockType', 'AdminController::removeLivestockType');
    $routes->post('addLivestockBreed', 'AdminController::addLivestockBreed');
    $routes->post('editLivestockBreed', 'AdminController::editLivestockBreed');
    $routes->post('removeLivestockBreed', 'AdminController::removeLivestockBreed');

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
    $routes->post('searchLivestocks','FarmerController::searchLivestocks');
    $routes->post('addLivestockMortality','FarmerController::addLivestockMortality');
    $routes->get('fetchFarmerLivestockMortalityRecords/(:any)','FarmerController::fetchFarmerLivestockMortalityRecords/$1');
});