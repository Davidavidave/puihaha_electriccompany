<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Public website
$routes->get('/', 'PublicHome::index');
$routes->get('welcome', 'PublicHome::index');
$routes->get('about', 'About::index');
$routes->get('services', 'Services::index');
$routes->match(['get', 'post'], 'contact', 'Contact::index');
$routes->get('register', 'Register::index');
$routes->post('register', 'Register::create');

// Login and protected CRUD dashboard
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::login');
$routes->post('logout', 'Auth::logout');
$routes->get('dashboard', 'Home::index');
$routes->get('account/(:num)', 'Home::viewAccount/$1');
$routes->get('account/create', 'Home::create');
$routes->post('account/store', 'Home::store');
$routes->get('account/edit/(:num)', 'Home::edit/$1');
$routes->post('account/update/(:num)', 'Home::update/$1');
$routes->post('account/delete/(:num)', 'Home::delete/$1');
