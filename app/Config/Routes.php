<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// use App\Controllers\News; // Add this line
use App\Controllers\Dokumen;
use App\Controllers\SuratKeluar;
use App\Controllers\SuratMasuk;
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
    $routes->get('/admin_dashboard', 'Admin::index');
    $routes->get('/admin/create', 'Admin::create');
    $routes->post('/admin/store', 'Admin::store');
    $routes->get('/admin/edit/(:num)', 'Admin::edit/$1');
    $routes->post('/admin/update/(:num)', 'Admin::update/$1');
    $routes->get('/admin/delete/(:num)', 'Admin::delete/$1');
    $routes->get('/register', 'AuthController::register');
    $routes->post('/register', 'AuthController::storeUser');
});

$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Home::index');
    $routes->get('/dokumen', [Dokumen::class, 'index']);
    $routes->get('/dokumen/surat_keluar', [SuratKeluar::class, 'index']);
    $routes->group('/surat_keluar', function ($routes) {
        $routes->get('manage', 'SuratKeluar::manage');
        $routes->get('create', 'SuratKeluar::create');
        $routes->post('store', 'SuratKeluar::store');
        $routes->get('edit/(:num)', 'SuratKeluar::edit/$1');
        $routes->post('update/(:num)', 'SuratKeluar::update/$1');
        $routes->get('delete/(:num)', 'SuratKeluar::delete/$1');
        $routes->post('create/getKode1', 'SuratKeluar::getKode1');
        $routes->post('create/getKodeKlasifikasi', 'SuratKeluar::getKodeKlasifikasi');
        $routes->post('create/getKodeArsip', 'SuratKeluar::getKodeArsip');
        $routes->get('export_xlsx', 'SuratKeluar::exportExcel');
    });
    $routes->get('/dokumen/surat_masuk', [SuratMasuk::class, 'index']);
    $routes->group('/surat_masuk', function ($routes) {
        $routes->get('manage', 'SuratMasuk::manage');
        $routes->get('create', 'SuratMasuk::create');
        $routes->post('store', 'SuratMasuk::store');
        $routes->get('edit/(:num)', 'SuratMasuk::edit/$1');
        $routes->post('update/(:num)', 'SuratMasuk::update/$1');
        $routes->get('delete/(:num)', 'SuratMasuk::delete/$1');
    });

    $routes->get('/dokumen/sk', [SK::class, 'index']);
    $routes->get('/sk/manage', 'SK::manage');
    $routes->get('/sk/create', 'SK::create');
    $routes->post('/sk/store', 'SK::store');
    $routes->get('/sk/edit/(:num)', 'SK::edit/$1');
    $routes->post('/sk/update/(:num)', 'SK::update/$1');
    $routes->get('/sk/delete/(:num)', 'SK::delete/$1');
    $routes->post('/sk/create/getKode1', 'SK::getKode1');
    $routes->post('/sk/create/getKodeKlasifikasi', 'SK::getKodeKlasifikasi');
    $routes->post('sk/create/getKodeArsip', 'SK::getKodeArsip');

    $routes->get('/dokumen/kontrak', [Kontrak::class, 'index']);
    $routes->get('/kontrak/manage', 'Kontrak::manage');
    $routes->get('/kontrak/create', 'Kontrak::create');
    $routes->post('/kontrak/store', 'Kontrak::store');
    $routes->get('/kontrak/edit/(:num)', 'Kontrak::edit/$1');
    $routes->post('/kontrak/update/(:num)', 'Kontrak::update/$1');
    $routes->get('/kontrak/delete/(:num)', 'Kontrak::delete/$1');
    $routes->post('/kontrak/create/getKode1', 'Kontrak::getKode1');
    $routes->post('/kontrak/create/getKodeKlasifikasi', 'Kontrak::getKodeKlasifikasi');
    $routes->post('kontrak/create/getKodeArsip', 'Kontrak::getKodeArsip');

    $routes->get('/humas', [Humas::class, 'maintenance']);
    $routes->get('/humas/manage', 'Humas::maintenance');
    $routes->get('/humas/create', 'Humas::maintenance');
    $routes->post('/humas/store', 'Humas::maintenance');
    $routes->get('/humas/edit/(:num)', 'Humas::maintenance');
    $routes->post('/humas/update/(:num)', 'Humas::maintenance');
    $routes->get('/humas/delete/(:num)', 'Humas::maintenance');

    $routes->get('/kendala', [Kendala::class, 'maintenance']);
    $routes->get('/kendala/manage', 'Kendala::maintenance');
    $routes->get('/kendala/create', 'Kendala::maintenance');
    $routes->post('/kendala/store', 'Kendala::maintenance');
    $routes->get('/kendala/edit/(:num)', 'Kendala::maintenance');
    $routes->post('/kendala/update/(:num)', 'Kendala::maintenance');
    $routes->get('/kendala/delete/(:num)', 'Kendala::maintenance');

    $routes->get('/sbml', [Sbml::class, 'maintenance']);
    $routes->get('/sbml/manage', 'Sbml::maintenance');
    $routes->get('/sbml/create', 'Sbml::maintenance');
    $routes->post('/sbml/store', 'Sbml::maintenance');
    $routes->get('/sbml/edit/(:num)', 'Sbml::maintenance');
    $routes->post('/sbml/update/(:num)', 'Sbml::maintenance');
    $routes->get('/sbml/delete/(:num)', 'Sbml::maintenance');

    // $routes->get('tracking', [Tracking::class, 'maintenance']);
    // $routes->get('/tracking/manage', 'Tracking::maintenance');
    // $routes->get('/tracking/create', 'Tracking::maintenance');
    // $routes->post('/tracking/store', 'Tracking::maintenance');
    // $routes->get('/tracking/edit/(:num)', 'Tracking::maintenance');
    // $routes->post('/tracking/update/(:num)', 'Tracking::maintenance');
    // $routes->get('/tracking/delete/(:num)', 'Tracking::maintenance');

    // $routes->get('/generate_surat', [GenerateSurat::class, 'index']);
    // $routes->get('/generate_surat/manage', 'GenerateSurat::maintenance');
    // $routes->get('/generate_surat/create', 'GenerateSurat::maintenance');
    // $routes->post('/generate_surat/store', 'GenerateSurat::maintenance');
    // $routes->get('/generate_surat/edit/(:num)', 'GenerateSurat::maintenance');
    // $routes->post('/generate_surat/update/(:num)', 'GenerateSurat::maintenance');
    // $routes->get('/generate_surat/delete/(:num)', 'GenerateSurat::maintenance');

    $routes->get('/calendar', 'CalendarController::index');
    $routes->get('/fetch-events', 'CalendarController::fetchEvents');

    // Features
    $routes->get('/generate-report', 'ReportController::generateReport');

    $routes->get('/calendar', 'CalendarController::index');
    $routes->get('/calendar/events', 'CalendarController::events');
});

$routes->get('/profile', 'Profile::index', ['filter' => 'auth']);
$routes->post('/profile/update', 'Profile::updateProfile', ['filter' => 'auth']);
$routes->post('/profile/change-password', 'Profile::changePassword', ['filter' => 'auth']);

$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::authenticate');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/unauthorized', function () {
    return view('errors/unauthorized');
});
