<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', '\App\Modules\Store\Controllers\Store::index');
$routes->group('login', static function (RouteCollection $routes) {
    $routes->get('/', '\App\Modules\Login\Controllers\Login::index');
    $routes->post("submit", '\App\Modules\Login\Controllers\Login::submit');
});
$routes->get('logout', '\App\Modules\Login\Controllers\Login::logout');
$routes->group('register', static function (RouteCollection $routes) {
    $routes->get('/', '\App\Modules\Registration\Controllers\Registration::index');
    $routes->post("submit", '\App\Modules\Registration\Controllers\Registration::submit');
});
$routes->get('profile', '');
$routes->get('orders', '');
$routes->group('admin', static function (RouteCollection $routes) {
    $routes->get('users', '\App\Modules\Users\Controllers\Users::index');
    $routes->get('users/form/', '\App\Modules\Users\Controllers\Users::form');
    $routes->get('users/form/(:num)', '\App\Modules\Users\Controllers\Users::form/$1');
    $routes->get('users/detail/(:num)', '\App\Modules\Users\Controllers\Users::detail/$1');
    $routes->post('users/save', '\App\Modules\Users\Controllers\Users::save');
    $routes->put('users/reset-password', '\App\Modules\Users\Controllers\Users::resetPassword');
    $routes->get('games', '');
    $routes->get('orders', '');
});

$routes->group('api', ['namespace' => 'App\Modules\Users\Controllers'], function (RouteCollection $routes) {
    $routes->resource('apiusers');
    $routes->post('users/reset-password', '\App\Modules\Users\Controllers\APIUsers::resetPassword');
});