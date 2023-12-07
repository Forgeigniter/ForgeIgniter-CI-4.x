<?php

if (!isset($routes)) {
    $routes = \Config\Services::routes(true);
}

$routes->group('', ['namespace' => 'Modules\Blog\Controllers'], function($routes) {
    $routes->get('blog', 'Blog::index');
});