<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Comments::index');
$routes->get('/comments', 'Comments::index');
$routes->post('/comments/create', 'Comments::create');
$routes->post('/comments/create-random', 'Comments::createBatch');