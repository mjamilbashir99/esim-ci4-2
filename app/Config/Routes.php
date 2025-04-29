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

    $routes->get('get-city-suggestions', 'Home\HomeController::getCitySuggestions');

    $routes->post('search-hotels', 'Home\HomeController::searchHotels');

    $routes->get('search-result', 'Home\HomeController::searchResult');
    $routes->post('register/submit', 'Auth\AuthController::submit');

    $routes->get('login', 'Auth\AuthController::login');
    $routes->post('login/submit', 'Auth\AuthController::loginSubmit');

    $routes->get('logout', 'Auth\AuthController::logout');
    


   //  Admin Routes
    $routes->get('admin/dashboard', 'Admin\AdminController::index');
    $routes->get('admin/all-users', 'Admin\AdminController::listUsers');
    

    


    

    
   