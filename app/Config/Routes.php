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
    $routes->get('users/search', '\App\Modules\Users\Controllers\Users::search');
    $routes->get('users/form/', '\App\Modules\Users\Controllers\Users::form');
    $routes->get('users/form/(:num)', '\App\Modules\Users\Controllers\Users::form/$1');
    $routes->get('users/detail/(:num)', '\App\Modules\Users\Controllers\Users::detail/$1');
    $routes->post('users/save', '\App\Modules\Users\Controllers\Users::save');
    $routes->put('users/reset-password', '\App\Modules\Users\Controllers\Users::resetPassword');
    $routes->get('games', '\App\Modules\Games\Controllers\Games::index');
    $routes->get('games/form', '\App\Modules\Games\Controllers\Games::form');
    $routes->get('games/form/(:num)', '\App\Modules\Games\Controllers\Games::form/$1');
    $routes->get('games/detail/(:num)', '\App\Modules\Games\Controllers\Games::detail/$1');
    $routes->post('games/save', '\App\Modules\Games\Controllers\Games::save');
    $routes->post('games/topup/save', '\App\Modules\Games\Controllers\Games::saveTopUpOption');
    $routes->post('games/topup/update/(:num)', '\App\Modules\Games\Controllers\Games::updateTopUpOption/$1');
    $routes->delete('games/topup/delete/(:num)', '\App\Modules\Games\Controllers\Games::deleteTopUpOption/$1');
    $routes->get('orders', '');
});

$routes->group('api', ['namespace' => 'App\Modules\Users\Controllers'], function (RouteCollection $routes) {
    $routes->resource('apiusers');
    $routes->resource('apigames');
    $routes->post('users/reset-password', '\App\Modules\Users\Controllers\APIUsers::resetPassword');
});