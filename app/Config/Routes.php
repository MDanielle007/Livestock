<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/admin/register', 'UserController::register');
$routes->get('/admin/getUserAccounts', 'UserController::getUserAccounts');
