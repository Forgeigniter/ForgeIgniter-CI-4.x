<?php

if (!isset($routes)) {
    $routes = \Config\Services::routes(true);
}

$routes->group('', ['namespace' => 'Modules\Blog\Controllers'], function($routes) {
    $routes->get('blog', 'Blog::index');
    $routes->get('blog/post/(:num)', 'Blog::post/$1');
    // Admin
    $routes->get('admin/blog', 'Blog_Admin::index');
    // Edit Post
    $routes->get('admin/blog/edit/(:num)', 'Blog_Admin::edit/$1');
    $routes->post('admin/blog/edit/(:num)', 'Blog_Admin::edit/$1'); // For form submission
});