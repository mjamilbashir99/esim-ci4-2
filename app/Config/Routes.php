<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// if (file_exists(APPPATH . 'Modules/Auth/Config/Routes.php')) {
//     require APPPATH . 'Modules/Auth/Config/Routes.php';
// }
// $routes->setAutoRoute(true);
$routes->setAutoRoute(true); 
// $routes->setAutoRoute(true);


$routes->group('', ['namespace' => 'Modules\Auth\Controllers'], function ($routes) {
    $routes->get('/', 'Home::index');
    $routes->get('register', 'AuthController::register');
    $routes->post('register', 'AuthController::register');
    $routes->get('test-hotelbeds', 'AuthController::testHotelbeds');
});