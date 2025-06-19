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
$routes->group('top-up', static function (RouteCollection $routes) {
    $routes->group('games', static function (RouteCollection $routes) {
        $routes->get('/', '\App\Modules\Store\Controllers\Store::showAllGame');
        $routes->get('(:segment)', '\App\Modules\Store\Controllers\Store::showDetailGameAndTopUpOption/$1');
    });
});
$routes->get('profile', '');
$routes->get('orders', '\App\Modules\Penjualan\Controllers\Penjualan::orders');
$routes->get('transactions', '\App\Modules\Penjualan\Controllers\Penjualan::transaction_index');
$routes->post('transactions/pesan', '\App\Modules\Penjualan\Controllers\Penjualan::transaction');
$routes->group('admin', static function (RouteCollection $routes) {
    $routes->get('users', '\App\Modules\Users\Controllers\Users::index');
    $routes->get('users/search', '\App\Modules\Users\Controllers\Users::search');
    $routes->get('users/form/', '\App\Modules\Users\Controllers\Users::form');
    $routes->get('users/form/(:num)', '\App\Modules\Users\Controllers\Users::form/$1');
    $routes->get('users/detail/(:num)', '\App\Modules\Users\Controllers\Users::detail/$1');
    $routes->post('users/save', '\App\Modules\Users\Controllers\Users::save');
    $routes->put('users/reset-password', '\App\Modules\Users\Controllers\Users::resetPassword');
    $routes->get('games', '\App\Modules\Games\Controllers\Games::index');
    $routes->get('games/search', '\App\Modules\Games\Controllers\Games::search');
    $routes->get('games/form', '\App\Modules\Games\Controllers\Games::form');
    $routes->get('games/form/(:num)', '\App\Modules\Games\Controllers\Games::form/$1');
    $routes->get('games/detail/(:num)', '\App\Modules\Games\Controllers\Games::detail/$1');
    $routes->post('games/save', '\App\Modules\Games\Controllers\Games::save');
    $routes->post('games/topup/save', '\App\Modules\Games\Controllers\Games::saveTopUpOption');
    $routes->post('games/topup/update/(:num)', '\App\Modules\Games\Controllers\Games::updateTopUpOption/$1');
    $routes->delete('games/topup/delete/(:num)', '\App\Modules\Games\Controllers\Games::deleteTopUpOption/$1');
    $routes->get('payment-methods', '\App\Modules\PaymentMethod\Controllers\PaymentMethod::index');
    $routes->get('payment-methods/search', '\App\Modules\PaymentMethod\Controllers\PaymentMethod::search');
    $routes->get('payment-methods/form', '\App\Modules\PaymentMethod\Controllers\PaymentMethod::form');
    $routes->get('payment-methods/form/(:num)', '\App\Modules\PaymentMethod\Controllers\PaymentMethod::form/$1');
    $routes->get('payment-methods/detail/(:num)', '\App\Modules\PaymentMethod\Controllers\PaymentMethod::detail/$1');
    $routes->post('payment-methods/save', '\App\Modules\PaymentMethod\Controllers\PaymentMethod::save');
    $routes->get('sales', '\App\Modules\Penjualan\Controllers\Penjualan::sales');
});
$routes->group('transactions', static function (RouteCollection $routes) {
    $routes->post('pesan', '\App\Modules\Penjualan\Controllers\Penjualan::transaction');
});

$routes->group('api', function (RouteCollection $routes) {
    $routes->resource('apiusers', ['namespace' => 'App\Modules\Users\Controllers']);
    $routes->resource('apigames', ['namespace' => 'App\Modules\Games\Controllers']);
    $routes->resource('apipaymentmethods', ['namespace' => 'App\Modules\PaymentMethod\Controllers']);
    $routes->resource('apipenjualan', ['namespace' => 'App\Modules\Penjualan\Controllers']);
    $routes->post('users/reset-password', 'App\Modules\Users\Controllers\APIUsers::resetPassword');
});
