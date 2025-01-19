<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// use App\Controllers\News; // Add this line
use App\Controllers\Dokumen;
use App\Controllers\Surat;
use App\Controllers\SK;
use App\Controllers\Kontrak;
use App\Controllers\Humas;
use App\Controllers\GenerateSurat;
use App\Controllers\Kendala;
use App\Controllers\Sbml;
use App\Controllers\Tracking;

$routes->group('', ['filter' => 'role:admin,user'], function ($routes) {
    $routes->get('/dashboard', 'DashboardController::index');
});

$routes->group('', ['filter' => 'role:admin'], function ($routes) {
    $routes->get('/admin', 'AdminController::index');
});

$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::authenticate');
$routes->get('/register', 'AuthController::register');
$routes->post('/register', 'AuthController::storeUser');
$routes->get('/logout', 'AuthController::logout');
// $routes->get('/unauthorized', function () {
//     return 'Access Denied';
// });

$routes->get('/unauthorized', function () {
    return view('errors/unauthorized');
});

// $routes->group('pages', function ($routes) {
//     $routes->get('index', 'Pages::index');
//     $routes->get('about', 'Pages::about');
//     $routes->get('letter', 'Pages::letter');
//     $routes->get('monitoring', 'Pages::monitoring');
// });
/// ini asli
// $routes->get('/', 'Home::index');

// $routes->get('/dokumen', [Dokumen::class, 'index']);

// $routes->get('/dokumen/surat', [Surat::class, 'index']);
// $routes->get('/surat/manage', 'Surat::manage');
// $routes->get('/surat/create', 'Surat::create');
// $routes->post('/surat/store', 'Surat::store');
// $routes->get('/surat/edit/(:num)', 'Surat::edit/$1');
// $routes->post('/surat/update/(:num)', 'Surat::update/$1');
// $routes->get('/surat/delete/(:num)', 'Surat::delete/$1');
/// ini modif
$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Home::index');
    $routes->get('/dokumen', [Dokumen::class, 'index']);
    $routes->get('/dokumen/surat', [Surat::class, 'index']);
    $routes->get('/surat/manage', 'Surat::manage');
    $routes->get('/surat/create', 'Surat::create');
    $routes->post('/surat/store', 'Surat::store');
    $routes->get('/surat/edit/(:num)', 'Surat::edit/$1');
    $routes->post('/surat/update/(:num)', 'Surat::update/$1');
    $routes->get('/surat/delete/(:num)', 'Surat::delete/$1');
});

///
$routes->get('/dokumen/sk', [SK::class, 'index']);
$routes->get('/sk/manage', 'SK::manage');
$routes->get('/sk/create', 'SK::create');
$routes->post('/sk/store', 'SK::store');
$routes->get('/sk/edit/(:num)', 'SK::edit/$1');
$routes->post('/sk/update/(:num)', 'SK::update/$1');
$routes->get('/sk/delete/(:num)', 'SK::delete/$1');

$routes->get('/dokumen/kontrak', [Kontrak::class, 'index']);
$routes->get('/kontrak/manage', 'Kontrak::manage');
$routes->get('/kontrak/create', 'Kontrak::create');
$routes->post('/kontrak/store', 'Kontrak::store');
$routes->get('/kontrak/edit/(:num)', 'Kontrak::edit/$1');
$routes->post('/kontrak/update/(:num)', 'Kontrak::update/$1');
$routes->get('/kontrak/delete/(:num)', 'Kontrak::delete/$1');

$routes->get('/form', 'FormController::index');
$routes->post('/form/getKode1', 'FormController::getKode1');
$routes->post('/form/getKodeKlasifikasi', 'FormController::getKodeKlasifikasi');
$routes->post('form/submitForm', 'FormController::submitForm');

$routes->get('/humas', [Humas::class, 'index']);
$routes->get('/humas/manage', 'Humas::manage');
$routes->get('/humas/create', 'Humas::create');
$routes->post('/humas/store', 'Humas::store');
$routes->get('/humas/edit/(:num)', 'Humas::edit/$1');
$routes->post('/humas/update/(:num)', 'Humas::update/$1');
$routes->get('/humas/delete/(:num)', 'Humas::delete/$1');

// $routes->get('/kendala', [Kendala::class, 'index']);
// $routes->get('/kendala/manage', 'Kendala::manage');
// $routes->get('/kendala/create', 'Kendala::create');
// $routes->post('/kendala/store', 'Kendala::store');
// $routes->get('/kendala/edit/(:num)', 'Kendala::edit/$1');
// $routes->post('/kendala/update/(:num)', 'Kendala::update/$1');
// $routes->get('/kendala/delete/(:num)', 'Kendala::delete/$1');

// $routes->get('/generate_surat', [GenerateSurat::class, 'index']);
// $routes->get('/generate_surat/manage', 'GenerateSurat::manage');
// $routes->get('/generate_surat/create', 'GenerateSurat::create');
// $routes->post('/generate_surat/store', 'GenerateSurat::store');
// $routes->get('/generate_surat/edit/(:num)', 'GenerateSurat::edit/$1');
// $routes->post('/generate_surat/update/(:num)', 'GenerateSurat::update/$1');
// $routes->get('/generate_surat/delete/(:num)', 'GenerateSurat::delete/$1');

$routes->get('/kendala', [Kendala::class, 'maintenance']);
$routes->get('/kendala/manage', 'Kendala::maintenance');
$routes->get('/kendala/create', 'Kendala::maintenance');
$routes->post('/kendala/store', 'Kendala::maintenance');
$routes->get('/kendala/edit/(:num)', 'Kendala::maintenance');
$routes->post('/kendala/update/(:num)', 'Kendala::maintenance');
$routes->get('/kendala/delete/(:num)', 'Kendala::maintenance');

$routes->get('sbml', [Sbml::class, 'maintenance']);
$routes->get('/sbml/manage', 'Sbml::maintenance');
$routes->get('/sbml/create', 'Sbml::maintenance');
$routes->post('/sbml/store', 'Sbml::maintenance');
$routes->get('/sbml/edit/(:num)', 'Sbml::maintenance');
$routes->post('/sbml/update/(:num)', 'Sbml::maintenance');
$routes->get('/sbml/delete/(:num)', 'Sbml::maintenance');

$routes->get('tracking', [Tracking::class, 'maintenance']);
$routes->get('/tracking/manage', 'Tracking::maintenance');
$routes->get('/tracking/create', 'Tracking::maintenance');
$routes->post('/tracking/store', 'Tracking::maintenance');
$routes->get('/tracking/edit/(:num)', 'Tracking::maintenance');
$routes->post('/tracking/update/(:num)', 'Tracking::maintenance');
$routes->get('/tracking/delete/(:num)', 'Tracking::maintenance');

$routes->get('/generate_surat', [GenerateSurat::class, 'index']);
$routes->get('/generate_surat/manage', 'GenerateSurat::maintenance');
$routes->get('/generate_surat/create', 'GenerateSurat::maintenance');
$routes->post('/generate_surat/store', 'GenerateSurat::maintenance');
$routes->get('/generate_surat/edit/(:num)', 'GenerateSurat::maintenance');
$routes->post('/generate_surat/update/(:num)', 'GenerateSurat::maintenance');
$routes->get('/generate_surat/delete/(:num)', 'GenerateSurat::maintenance');

$routes->get('/calendar', 'CalendarController::index');
$routes->get('/fetch-events', 'CalendarController::fetchEvents');

// $routes->get('news', [News::class, 'index']);
// $routes->get('news/new', [News::class, 'new']); // Add this line
// $routes->get('news/(:segment)', [News::class, 'show']); // Add this line

// $routes->get('pages', [Pages::class, 'index']);
// $routes->get('(:segment)', [Pages::class, 'view']);

// $routes->post('news', 'News::create');

// Features
$routes->get('/generate-report', 'ReportController::generateReport');

$routes->get('/calendar', 'CalendarController::index');
$routes->get('/calendar/events', 'CalendarController::events');
