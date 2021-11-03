<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

// $route['admin'] = 'admin/overview';

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', '\App\Modules\Laporan\Controllers\Laporan::index');
$routes->get('/Laporan', '\App\Modules\Laporan\Controllers\Laporan::index');
$routes->get('/Laporan/tambah', '\App\Modules\Laporan\Controllers\Laporan::tambah/', ['filter' => 'role:admin']);
$routes->add('/Laporan/create', '\App\Modules\Laporan\Controllers\Laporan::create/', ['filter' => 'role:admin']);
$routes->add('/Laporan/ubah/(:num)', '\App\Modules\Laporan\Controllers\Laporan::ubah/$1', ['filter' => 'role:admin']);
$routes->add('/Laporan/edit/(:num)', '\App\Modules\Laporan\Controllers\Laporan::edit/$1', ['filter' => 'role:admin']);
$routes->get('/Laporan/delete/(:num)', '\App\Modules\Laporan\Controllers\Laporan::delete/$1', ['filter' => 'role:admin']);

$routes->get('/Pengguna', '\App\Modules\Pengguna\Controllers\Pengguna::index', ['filter' => 'role:admin']);
$routes->get('/Pengguna/index', '\App\Modules\Pengguna\Controllers\Pengguna::index', ['filter' => 'role:admin']);
$routes->get('/Pengguna/detail/(:num)', '\App\Modules\Pengguna\Controllers\Pengguna::detail/$1', ['filter' => 'role:admin']);
$routes->add('/Pengguna/ubah/(:num)', '\App\Modules\Pengguna\Controllers\Pengguna::ubah/$1', ['filter' => 'role:admin']);
$routes->get('/Pengguna/delete/(:num)', '\App\Modules\Pengguna\Controllers\Pengguna::delete/$1', ['filter' => 'role:admin']);

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
