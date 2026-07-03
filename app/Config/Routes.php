<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
// Route Autentikasi Modern
$routes->get('/', 'RoyaltyController::login');
$routes->get('login', 'RoyaltyController::login');
$routes->post('auth', 'RoyaltyController::auth');
$routes->get('logout', 'RoyaltyController::logout');

// Route Dashboard Utama
$routes->get('royalty', 'RoyaltyController::index');

// Operasi Pengisian Data Distribusi (Create)
$routes->get('royalty/create', 'RoyaltyController::viewCreate');
$routes->post('royalty/store', 'RoyaltyController::store');

// Operasi Perubahan/Amandemen Berkas (Update)
$routes->get('royalty/edit/(:num)', 'RoyaltyController::viewEdit/$1');
$routes->post('royalty/update/(:num)', 'RoyaltyController::update/$1');

// Operasi Penghapusan Log Mutasi (Delete)
$routes->get('royalty/delete/(:num)', 'RoyaltyController::delete/$1');

// Fitur Kunci: Portal Audit Kedaulatan Kriptografi (Verify / Integrity Check)
$routes->get('royalty/verify/(:num)', 'RoyaltyController::verify/$1');