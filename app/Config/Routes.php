<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Beranda::index');
$routes->get('/importer', 'Importer::index');
$routes->get('/beranda', 'Beranda::index');
$routes->get('/masuk', 'Auth::masuk');
$routes->get('/verifikasi', 'Auth::verifikasi');
$routes->get('/daftar', 'Auth::daftar');
$routes->get('/keluar', 'Auth::keluar');
$routes->get('/mailer', 'Auth::mailer');
$routes->get('/pengajuan', 'Pengajuan::index');
$routes->get('/pengajuan/pembayaran', 'Pengajuan::pembayaran');
$routes->get('/riwayat', 'Riwayat::index');
$routes->get('/alumni', 'Alumni::index');
$routes->get('/pembayaran', 'Pembayaran::index');
$routes->get('/pembayaran/genToken', 'Pembayaran::generateToken');
$routes->post('/api', 'API::index');
$routes->get('/api', 'API::index');
$routes->get('/legalisir', 'Legalisir::index');
$routes->get('/excel', 'Pembayaran::excel');
$routes->post('/tokenjwt', 'tokenjwt::generatetoken');
$routes->get('/tokenjwt', 'tokenjwt::index');
$routes->post('/masuk', 'Auth::masuk');
$routes->post('/verifikasi', 'Auth::verifikasi');
$routes->post('/daftar', 'Auth::daftar');
$routes->post('/importer/import_excel', 'Importer::import_excel');
$routes->post('/pengajuan', 'Pengajuan::index');

// $routes->get('/pembayaran/modal_token/(:segment)', 'Pembayaran::modal_token');

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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
