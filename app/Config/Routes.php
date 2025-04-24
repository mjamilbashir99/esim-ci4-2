<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


    $routes->get('/', 'Home::index');
    // Registeration Form
    $routes->get('register', 'Auth\AuthController::register');
    $routes->get('/testDatabaseConnection', 'Home::testDatabaseConnection');

    
   