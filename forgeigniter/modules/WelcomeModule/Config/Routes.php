<?php

if (!isset($routes)) {
    $routes = \Config\Services::routes(true);
}

$routes->group('', ['namespace' => 'Modules\WelcomeModule\Controllers'], function($routes) {
    $routes->get('welcome-module', 'WelcomeModule::index');
});
