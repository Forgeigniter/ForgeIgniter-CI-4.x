<?php

if (!isset($routes)) {
    $routes = \Config\Services::routes(true);
}

$routes->group('', ['namespace' => 'Modules\Blog\Controllers'], function($routes) {
    $routes->get('blog', 'Blog::index');
    $routes->get('blog/post/(:num)', 'Blog::post/$1');
    // Admin
    $routes->get('admin/blog', 'Blog_Admin::index');
    // Create Post
    $routes->get('admin/blog/create', 'Blog_Admin::create');
    $routes->post('admin/blog/create', 'Blog_Admin::create');
    // Edit Post
    $routes->get('admin/blog/edit/(:num)', 'Blog_Admin::edit/$1');
    $routes->post('admin/blog/edit/(:num)', 'Blog_Admin::edit/$1');
});