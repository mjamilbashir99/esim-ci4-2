<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


    $routes->get('/', 'Home::index');
    // Registeration Form
    $routes->get('register', 'Auth\AuthController::register');
    $routes->get('/testDatabaseConnection', 'Home::testDatabaseConnection');
    $routes->get('/hotelBedsApi', 'Auth\AuthController::hotelBedsApi');

    $routes->post('hotel-api/1.0/hotels', 'Auth\AuthController::searchNearbyHotels');
    $routes->get('home', 'Auth\AuthController::index');

    


    

    
   