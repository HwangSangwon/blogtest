<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Posts::index');
$routes->get('posts', 'Posts::index');
$routes->get('posts/new', 'Posts::new');
$routes->post('posts', 'Posts::create');
$routes->get('posts/(:segment)', 'Posts::show/$1');
$routes->get('posts/(:segment)/edit', 'Posts::edit/$1');
$routes->put('posts/(:segment)', 'Posts::update/$1');
$routes->patch('posts/(:segment)', 'Posts::update/$1');
$routes->delete('posts/(:segment)', 'Posts::delete/$1');

$routes->get('admin', 'Admin::index');
$routes->get('admin/settings', 'Admin::settings');
$routes->post('admin/saveSettings', 'Admin::saveSettings');

$routes->get('admin/posts', 'Admin::posts');
$routes->delete('admin/posts/(:num)', 'Admin::deletePost/$1');
