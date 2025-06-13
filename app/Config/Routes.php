<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', '\App\Modules\Store\Controllers\Store::index');
$routes->group('login', static function (RouteCollection $routes) {
    $routes->get('/', '\App\Modules\Login\Controllers\Login::index');
});
$routes->group('register', static function (RouteCollection $routes) {
    $routes->get('/', '\App\Modules\Registration\Controllers\Registration::index');
});
