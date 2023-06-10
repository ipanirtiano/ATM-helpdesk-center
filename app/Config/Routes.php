<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
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

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Auth::index');
$routes->get('/reset-password', 'Auth::reset_password');

$routes->group('views', ['filter' => 'login'], function ($routes) {
	$routes->add('/', 'Dashboard::index');

	$routes->add('new-ticket', 'Ticket::index');
	$routes->add('my-ticket', 'Ticket::my_ticket');
	$routes->add('assigment-ticket', 'Ticket::assigment_ticket');

	$routes->add('accept-ticket/(:any)', 'Ticket::accept_ticket/$1');
	$routes->add('update-progres/(:any)', 'Ticket::update_progres/$1');

	$routes->add('ticket-detail/(:any)', 'Ticket::ticket_detail/$1');
	$routes->add('delete-ticket/(:any)', 'Ticket::hapus/$1');

	$routes->add('teknisi', 'Teknisi::index2');
	$routes->add('users', 'Karyawan::index2');
	$routes->add('ticket', 'Ticket::index2');


	$routes->add('list-ticket', 'Ticket::list_ticket');
	$routes->add('proses-ticket/(:any)', 'Ticket::proses_ticket/$1');

	$routes->add('update-password', 'Auth::update_password');
});

$routes->group('admin', ['filter' => 'admin'], function ($routes) {
	$routes->add('departemen', 'Departemen::index');
	$routes->add('update-dept/(:any)', 'Departemen::update_dept/$1');
	$routes->add('delete-dept/(:any)', 'Departemen::hapus/$1');

	$routes->add('atm', 'Atm::index');
	$routes->add('update-atm/(:any)', 'Atm::update/$1');
	$routes->add('delete-atm/(:any)', 'Atm::hapus/$1');

	$routes->add('kategori', 'Kategori::index');
	$routes->add('update-kategori/(:any)', 'Kategori::update_kat/$1');
	$routes->add('delete-kategori/(:any)', 'Kategori::hapus/$1');

	$routes->add('users', 'Karyawan::index');
	$routes->add('update-user/(:any)', 'Karyawan::update_user/$1');
	$routes->add('delete-user/(:any)', 'Karyawan::hapus/$1');


	$routes->add('list-ticket', 'Ticket::list_ticket');
	$routes->add('proses-ticket/(:any)', 'Ticket::proses_ticket/$1');

	$routes->add('teknisi', 'Teknisi::index');
	$routes->add('update-teknisi/(:any)', 'Teknisi::update/$1');
	$routes->add('delete-teknisi/(:any)', 'Teknisi::hapus/$1');
});



/**
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
