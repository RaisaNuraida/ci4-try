<?php

use CodeIgniter\Router\RouteCollection;


$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'ContactController::index'); // Assuming you have an index method in Home controller
{
    $routes->get('dashboard', 'Home::dashboard');
    $routes->get('contact', 'ContactController::index');
    $routes->post('contact', 'ContactController::create');
    $routes->add('contact/edit/(:segment)', 'ContactController::edit/$1');
    $routes->get('contact/delete/(:segment)', 'ContactController::delete/$1');
};
