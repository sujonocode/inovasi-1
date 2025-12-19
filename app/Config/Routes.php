<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

use App\Controllers\Dokumen;
use App\Controllers\SuratKeluar;
use App\Controllers\SuratMasuk;
use App\Controllers\SK;
use App\Controllers\Kontrak;
use App\Controllers\Dokumen26;
use App\Controllers\FP26;
use App\Controllers\SuratKeluar26;
use App\Controllers\SuratMasuk26;
use App\Controllers\SK26;
use App\Controllers\Kontrak26;
use App\Controllers\Humas;
use App\Controllers\QualityGates;
use App\Controllers\Publikasi;
use App\Controllers\Lainnya;

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
    $routes->get('/dokumen26', [Dokumen26::class, 'index']);
    $routes->get('/dokumen26/arsip', [Dokumen26::class, 'arsip2025']);

    // document 2025
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
        $routes->get('export_xlsx', 'SuratMasuk::exportExcel');
    });

    $routes->get('/dokumen/sk', [SK::class, 'index']);
    $routes->group('/sk', function ($routes) {
        $routes->get('manage', 'SK::manage');
        $routes->get('create', 'SK::create');
        $routes->post('store', 'SK::store');
        $routes->get('edit/(:num)', 'SK::edit/$1');
        $routes->post('update/(:num)', 'SK::update/$1');
        $routes->get('delete/(:num)', 'SK::delete/$1');
        $routes->post('create/getKode1', 'SK::getKode1');
        $routes->post('create/getKodeKlasifikasi', 'SK::getKodeKlasifikasi');
        $routes->post('create/getKodeArsip', 'SK::getKodeArsip');
        $routes->get('export_xlsx', 'SK::exportExcel');
    });

    $routes->get('/dokumen/kontrak', [Kontrak::class, 'index']);
    $routes->group('/kontrak', function ($routes) {
        $routes->get('manage', 'Kontrak::manage');
        $routes->get('create', 'Kontrak::create');
        $routes->post('store', 'Kontrak::store');
        $routes->get('edit/(:num)', 'Kontrak::edit/$1');
        $routes->post('update/(:num)', 'Kontrak::update/$1');
        $routes->get('delete/(:num)', 'Kontrak::delete/$1');
        $routes->post('create/getKode1', 'Kontrak::getKode1');
        $routes->post('create/getKodeKlasifikasi', 'Kontrak::getKodeKlasifikasi');
        $routes->post('create/getKodeArsip', 'Kontrak::getKodeArsip');
        $routes->get('export_xlsx', 'Kontrak::exportExcel');
    });

    // document 2026
    $routes->get('/dokumen26/surat_keluar', [SuratKeluar26::class, 'index']);
    $routes->group('/surat_keluar26', function ($routes) {
        $routes->get('manage', 'SuratKeluar26::manage');
        $routes->get('create', 'SuratKeluar26::create');
        $routes->post('store', 'SuratKeluar26::store');
        $routes->get('edit/(:num)', 'SuratKeluar26::edit/$1');
        $routes->post('update/(:num)', 'SuratKeluar26::update/$1');
        $routes->get('delete/(:num)', 'SuratKeluar26::delete/$1');
        $routes->post('create/getKode1', 'SuratKeluar26::getKode1');
        $routes->post('create/getKodeKlasifikasi', 'SuratKeluar26::getKodeKlasifikasi');
        $routes->post('create/getKodeArsip', 'SuratKeluar26::getKodeArsip');
        $routes->get('export_xlsx', 'SuratKeluar26::exportExcel');
    });

    $routes->get('/dokumen26/fp', [FP26::class, 'index']);
    $routes->group('/fp26', function ($routes) {
        $routes->get('manage', 'FP26::manage');
        $routes->get('create', 'FP26::create');
        $routes->post('store', 'FP26::store');
        $routes->get('edit/(:num)', 'FP26::edit/$1');
        $routes->post('update/(:num)', 'FP26::update/$1');
        $routes->get('delete/(:num)', 'FP26::delete/$1');
        $routes->post('create/getKode1', 'FP26::getKode1');
        $routes->post('create/getKodeKlasifikasi', 'FP26::getKodeKlasifikasi');
        $routes->post('create/getKodeArsip', 'FP26::getKodeArsip');
        $routes->get('export_xlsx', 'FP26::exportExcel');
    });

    $routes->get('/dokumen26/surat_masuk', [SuratMasuk26::class, 'index']);
    $routes->group('/surat_masuk26', function ($routes) {
        $routes->get('manage', 'SuratMasuk26::manage');
        $routes->get('create', 'SuratMasuk26::create');
        $routes->post('store', 'SuratMasuk26::store');
        $routes->get('edit/(:num)', 'SuratMasuk26::edit/$1');
        $routes->post('update/(:num)', 'SuratMasuk26::update/$1');
        $routes->get('delete/(:num)', 'SuratMasuk26::delete/$1');
        $routes->get('export_xlsx', 'SuratMasuk26::exportExcel');
    });

    $routes->get('/dokumen26/sk', [SK26::class, 'index']);
    $routes->group('/sk26', function ($routes) {
        $routes->get('manage', 'SK26::manage');
        $routes->get('create', 'SK26::create');
        $routes->post('store', 'SK26::store');
        $routes->get('edit/(:num)', 'SK26::edit/$1');
        $routes->post('update/(:num)', 'SK26::update/$1');
        $routes->get('delete/(:num)', 'SK26::delete/$1');
        $routes->post('create/getKode1', 'SK26::getKode1');
        $routes->post('create/getKodeKlasifikasi', 'SK26::getKodeKlasifikasi');
        $routes->post('create/getKodeArsip', 'SK26::getKodeArsip');
        $routes->get('export_xlsx', 'SK26::exportExcel');
    });

    $routes->get('/dokumen26/kontrak', [Kontrak26::class, 'index']);
    $routes->group('/kontrak26', function ($routes) {
        $routes->get('manage', 'Kontrak26::manage');
        $routes->get('create', 'Kontrak26::create');
        $routes->post('store', 'Kontrak26::store');
        $routes->get('edit/(:num)', 'Kontrak26::edit/$1');
        $routes->post('update/(:num)', 'Kontrak26::update/$1');
        $routes->get('delete/(:num)', 'Kontrak26::delete/$1');
        $routes->post('create/getKode1', 'Kontrak26::getKode1');
        $routes->post('create/getKodeKlasifikasi', 'Kontrak26::getKodeKlasifikasi');
        $routes->post('create/getKodeArsip', 'Kontrak26::getKodeArsip');
        $routes->get('export_xlsx', 'Kontrak26::exportExcel');
    });

    $routes->group('/humas', function ($routes) {
        $routes->get('', [Humas::class, 'index']);
        $routes->get('manage', 'Humas::manage');
        $routes->get('create', 'Humas::create');
        $routes->post('store', 'Humas::store');
        $routes->get('edit/(:num)', 'Humas::edit/$1');
        $routes->post('update/(:num)', 'Humas::update/$1');
        $routes->get('delete/(:num)', 'Humas::delete/$1');
        $routes->get('export_xlsx', 'Humas::exportExcel');

        $routes->get('maintenance1', 'Humas::maintenance1');
        $routes->get('maintenance2', 'Humas::maintenance2');
        $routes->get('maintenance3', 'Humas::maintenance3');
        $routes->get('maintenance4', 'Humas::maintenance4');
        $routes->get('maintenance5', 'Humas::maintenance5');
        $routes->get('maintenance6', 'Humas::maintenance6');
        $routes->get('maintenance7', 'Humas::maintenance7');
        $routes->get('maintenance8', 'Humas::maintenance8');
        $routes->get('maintenance9', 'Humas::maintenance9');
        $routes->get('maintenance10', 'Humas::maintenance10');
        $routes->get('maintenance11', 'Humas::maintenance11');
        $routes->get('maintenance12', 'Humas::maintenance12');
        $routes->get('maintenance13', 'Humas::maintenance13');
        $routes->get('maintenance14', 'Humas::maintenance14');
        $routes->get('maintenance15', 'Humas::maintenance15');
    });

    $routes->group('/quality_gates', function ($routes) {
        $routes->get('', [QualityGates::class, 'index']);
        $routes->get('manage', 'QualityGates::manage');
        $routes->get('create', 'QualityGates::create');
        $routes->post('store', 'QualityGates::store');
        $routes->get('edit/(:num)', 'QualityGates::edit/$1');
        $routes->post('update/(:num)', 'QualityGates::update/$1');
        $routes->get('delete/(:num)', 'QualityGates::delete/$1');
        $routes->get('export_xlsx', 'QualityGates::exportExcel');
    });

    $routes->group('/publikasi', function ($routes) {
        $routes->get('', [Publikasi::class, 'index']);
        $routes->get('manage', 'Publikasi::manage');
        $routes->get('create', 'Publikasi::create');
        $routes->post('store', 'Publikasi::store');
        $routes->get('edit/(:num)', 'Publikasi::edit/$1');
        $routes->post('update/(:num)', 'Publikasi::update/$1');
        $routes->get('delete/(:num)', 'Publikasi::delete/$1');
        $routes->get('export_xlsx', 'Publikasi::exportExcel');
    });

    $routes->group('/lainnya', function ($routes) {
        $routes->get('', [Lainnya::class, 'index']);
        $routes->get('manage', 'Lainnya::manage');
        $routes->get('create', 'Lainnya::create');
        $routes->post('store', 'Lainnya::store');
        $routes->get('edit/(:num)', 'Lainnya::edit/$1');
        $routes->post('update/(:num)', 'Lainnya::update/$1');
        $routes->get('delete/(:num)', 'Lainnya::delete/$1');
        $routes->get('export_xlsx', 'Lainnya::exportExcel');
    });

    // pantau
    $routes->get('/pantau', 'Pantau::index');
    $routes->get('/pantau/master', 'Pantau::master');
    $routes->post('/pantau/tambah-kegiatan', 'Pantau::tambahKegiatan');

    $routes->get('/pantau/upload', 'Upload::index');
    $routes->post('pantau/upload/save', 'Upload::save');

    $routes->get('/pantau/beban-kerja', 'Pantau::bebanKerja');
    $routes->post('/pantau/beban-kerja/update-realisasi', 'Pantau::updateRealisasi');

    $routes->get('/pantau/detail/(:num)', 'Pantau::detail/$1');
    $routes->get('/pantau/edit/(:num)', 'Pantau::edit/$1');
    $routes->post('/pantau/update/(:num)', 'Pantau::update/$1');
    $routes->get('/pantau/delete/(:num)', 'Pantau::delete/$1');

    $routes->get('/pantau/progres', 'Pantau::bebanKerja');
    $routes->get('/pantau/work_calendar', 'Pantau::workCalendar');

    // lantas
    $routes->get('/lantas', 'Lantas::index');
    $routes->get('/lantas/manage', 'Lantas::manage');
    $routes->get('/lantas/edit/(:num)', 'Lantas::edit/$1');
    $routes->post('/lantas/update/(:num)', 'Lantas::update/$1');
    $routes->get('/lantas/delete/(:num)', 'Lantas::delete/$1');
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
