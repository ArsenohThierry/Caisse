<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
// $routes->post('/achats', 'Home::formAchats');

$routes->post('/login', 'UserController::login');
$routes->post('/register', 'UserController::register');

$routes->get('/home', 'Home::accueuil');

$routes->get('/saisie-achat', 'SaisieAchatController::index');
$routes->post('/saisie-achat', 'SaisieAchatController::addToPanier');
$routes->post('/cloturer-achat', 'SaisieAchatController::cloturerAchat');
$routes->post('/choisir-caisse', 'SaisieAchatController::choisirCaisse');

$routes->get('/liste-produits', 'ListeController::produits');
$routes->get('/liste-achats', 'ListeController::achats');