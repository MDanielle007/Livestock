<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/loginAuth', 'UserController::loginAuth');
$routes->get('/getLivestockTypes', 'GeneralController::getLivestockTypes');
$routes->get('/getLivestockBreed/(:any)', 'GeneralController::getLivestockBreed/$1');
$routes->get('/getLivestockAgeClass/(:any)', 'GeneralController::getLivestockAgeClass/$1');

$routes->group('apiCharts',static function($routes){
    $routes->post('/getLivestockPopulationProgression', 'VisualizationController::getLivestockPopulationProgression');
    $routes->post('/getFarmerLivestockPopulationProgression', 'VisualizationController::getFarmerLivestockPopulationProgression');
    $routes->post('/getLivestockTypePopulationProgression', 'VisualizationController::getLivestockTypePopulationProgression');
    $routes->post('/getFarmerLivestockTypePopulationProgression', 'VisualizationController::getFarmerLivestockTypePopulationProgression');
    $routes->post('/getLivestockMortality', 'VisualizationController::getLivestockMortality');
    $routes->post('/getFarmerLivestockMortality', 'VisualizationController::getFarmerLivestockMortality');
    $routes->post('/getLivestockTypePopulationProgression', 'VisualizationController::getLivestockTypePopulationProgression');
    $routes->post('/getFarmerLivestockTypePopulationProgression', 'VisualizationController::getFarmerLivestockTypePopulationProgression');
    $routes->post('/getLivestockTypeMortality', 'VisualizationController::getLivestockTypeMortality');
    $routes->post('/getFarmerLivestockTypeMortality', 'VisualizationController::getFarmerLivestockTypeMortality');
});

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
    $routes->get('getAllLivestock', 'LivestocksController::getAllLivestock');
    $routes->get('getLivestockTypes','LivestocksController::getLivestockTypes');
});

$routes->group('farmer',static function($routes){
    $routes->post('addLivestock', 'FarmerController::addLivestock');
    $routes->post('editLivestockDetails', 'FarmerController::editLivestockDetails');
    $routes->post('archiveLivestockRecord', 'FarmerController::archiveLivestockRecord');
    $routes->post('getFarmerProfile', 'FarmerController::getFarmerProfile');
    $routes->get('getOneLivestock/(:segment)', 'FarmerController::getOneLivestock/$1');
    $routes->get('getAllFarmerLivestock/(:any)', 'FarmerController::getAllFarmerLivestock/$1');
    $routes->post('getLivestockTypeCount','FarmerController::getLivestockTypeCount');
    $routes->post('getFarmerLivestockTypeCount','FarmerController::getLivestockTypeCount');
    $routes->post('searchFarmerLivestocks','FarmerController::searchFarmerLivestocks');
    $routes->post('addLivestockMortality','FarmerController::addLivestockMortality');
    $routes->get('fetchFarmerLivestockMortalityRecords/(:any)','FarmerController::fetchFarmerLivestockMortalityRecords/$1');
    $routes->post('commitSalesTransaction', 'SalesController::commitSalesTransaction');
    $routes->post('getFarmerSales', 'SalesController::getFarmerSales');
    $routes->post('administerVaccine', 'LivestocksController::administerVaccine');
    $routes->get('getFarmerVaccinationRecords/(:any)','LivestocksController::getFarmerVaccinationRecords/$1');
    $routes->post('updateVaccinationRecord','LivestocksController::updateVaccinationRecord');
    $routes->post('archiveVaccinationRecord','LivestocksController::archiveVaccinationRecord');
    $routes->get('getFarmerMortalityRecords/(:any)','LivestocksController::getFarmerMortalityRecords/$1');
    $routes->post('updateMortalityRecord','LivestocksController::updateMortalityRecord');
    $routes->post('archiveMortalityRecord','LivestocksController::archiveMortalityRecord');
    $routes->post('addLivestockType','LivestocksController::addLivestockType');
    $routes->post('updateLivestockType','LivestocksController::updateLivestockType');
    $routes->post('deleteLivestockType','LivestocksController::deleteLivestockType');
});
