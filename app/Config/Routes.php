<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

use App\Controllers\News; // Add this line
use App\Controllers\Pages;
use App\Controllers\Humas;
use App\Controllers\Surat;
use App\Controllers\SuratNomor;
use App\Controllers\Sbml;
use App\Controllers\Tracking;

$routes->get('/calendar', 'CalendarController::index');
$routes->get('/fetch-events', 'CalendarController::fetchEvents');

$routes->get('news', [News::class, 'index']);
$routes->get('news/new', [News::class, 'new']); // Add this line
$routes->get('news/(:segment)', [News::class, 'show']); // Add this line

// $routes->get('pages', [Pages::class, 'index']);
// $routes->get('(:segment)', [Pages::class, 'view']);

$routes->post('news', 'News::create');

// Features
$routes->get('humas', [Humas::class, 'index']);
$routes->get('humas/manage', 'Humas::manage');
$routes->get('/humas/create', 'Humas::create');
$routes->post('/humas/store', 'Humas::store');
$routes->get('/humas/edit/(:num)', 'Humas::edit/$1');
$routes->post('/humas/update/(:num)', 'Humas::update/$1');
$routes->get('/humas/delete/(:num)', 'Humas::delete/$1');

$routes->get('surat', [Surat::class, 'index']);
$routes->get('/surat/manage', 'Surat::manage');
$routes->get('/surat/create', 'Surat::create');
$routes->post('/surat/store', 'Surat::store');
$routes->get('/surat/edit/(:num)', 'Surat::edit/$1');
$routes->post('/surat/update/(:num)', 'Surat::update/$1');
$routes->get('/surat/delete/(:num)', 'Surat::delete/$1');

$routes->get('surat_nomor', [SuratNomor::class, 'index']);
$routes->get('/surat/manage_nomor', 'SuratNomor::manage');
$routes->get('/surat/create_nomor', 'SuratNomor::create');
$routes->post('/surat/store_nomor', 'SuratNomor::store');
$routes->get('/surat/edit_nomor/(:num)', 'SuratNomor::edit/$1');
$routes->post('/surat/update_nomor/(:num)', 'SuratNomor::update/$1');
$routes->get('/surat/delete_nomor/(:num)', 'SuratNomor::delete/$1');

$routes->get('/generate-report', 'ReportController::generateReport');

$routes->group('pages', function ($routes) {
    $routes->get('index', 'Pages::index');
    $routes->get('about', 'Pages::about');
    $routes->get('letter', 'Pages::letter');
    $routes->get('monitoring', 'Pages::monitoring');
});

$routes->get('sbml', [Sbml::class, 'index']);
// $routes->get('sbml', [Sbml::class, 'index']);
// $routes->get('sbml', [Sbml::class, 'index']);
// $routes->get('sbml', [Sbml::class, 'index']);

$routes->get('tracking', [Tracking::class, 'index']);
// $routes->get('tracking', [Tracking::class, 'index']);
// $routes->get('tracking', [Tracking::class, 'index']);
// $routes->get('tracking', [Tracking::class, 'index']);

$routes->get('/calendar', 'CalendarController::index');
$routes->get('/calendar/events', 'CalendarController::events');
