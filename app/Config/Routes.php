<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/achats', 'Home::formAchats');

$routes->post('/login', 'UserController::login');
$routes->post('/register', 'UserController::register');

$routes->get('/home', 'Home::accueuil');