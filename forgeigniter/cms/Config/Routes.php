<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('welcome', 'Modules\Welcome\Controllers\Welcome::index');

// We'll create clever routes for modules later, for now manually add for tests.
if (file_exists(ROOTPATH . 'forgeigniter/modules/WelcomeModule/Config/Routes.php')) {
    require_once ROOTPATH . 'forgeigniter/modules/WelcomeModule/Config/Routes.php';
}

