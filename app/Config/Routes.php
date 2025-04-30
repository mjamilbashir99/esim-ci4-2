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

    $routes->get('hotel-details/(:num)', 'Home\HomeController::hotelDetails/$1');



    $routes->get('verify-otp', 'Auth\AuthController::verifyOtpView');
    $routes->post('verify-otp/submit', 'Auth\AuthController::verifyOtpSubmit');

    $routes->get('resend-otp', 'Auth\AuthController::resendOtp');

    $routes->get('hotel-details', 'Home\HomeController::fetchHotelData');

    




    $routes->get('logout', 'Auth\AuthController::logout');
    


  // Admin routes
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function($routes) {
   $routes->get('login', 'AuthController::login');
   $routes->post('login/submit', 'AuthController::loginSubmit');
   $routes->get('logout', 'AuthController::logout');
   
   // Protected admin routes
   $routes->group('', ['filter' => 'adminauth'], function($routes) {
       $routes->get('dashboard', 'AdminController::index');
       $routes->get('all-users', 'AdminController::listUsers');
   });
});