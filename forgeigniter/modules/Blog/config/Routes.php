<?php

if (!isset($routes)) {
    $routes = \Config\Services::routes(true);
}

$routes->group('', ['namespace' => 'Modules\Blog\Controllers'], function($routes) {
    // Public Routes
    $routes->get('blog', 'Blog::index');
    $routes->get('blog/post/(:num)', 'Blog::post/$1');

    // Admin
    $routes->get('admin/blog', 'Blog_Admin::index');

    // Create,Edit,Delete
    $routes->match(['get', 'post'], 'admin/blog/create', 'Blog_Admin::create');
    $routes->match(['get', 'post'], 'admin/blog/edit/(:num)', 'Blog_Admin::edit/$1');
    // DELETE
    $routes->delete('admin/blog/delete/(:num)', 'Blog_Admin::delete/$1');
});