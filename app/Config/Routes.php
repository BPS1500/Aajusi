<?php

use App\Controllers\Publikasi;
use App\Filters\AuthGuard;
use CodeIgniter\Commands\Utilities\Routes;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
// $routes->get('/login', 'Auth::login');
// $routes->get('/auth/ssoCallback', 'Auth::ssoCallback');
// $routes->get('/logout', 'Auth::logout');
// $routes->get('/dashboard', 'Dashboard::index', ['filter' => 'authGuard']);
// $routes->get('/auth/switchRole/(:any)', 'Auth::switchRole/$1');


$routes->get('/', 'Home::index');
$routes->get('auth/login', 'Auth::login');
$routes->get('login', 'Auth::login');
$routes->get('auth/ssoCallback', 'Auth::ssoCallback');
$routes->get('auth/logout', 'Auth::logout');

$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('dashboard', 'Publikasi::dashboard');

    $routes->get('auth/switchRole/(:num)', 'Auth::switchRole/$1');
    $routes->get('publikasi', 'Publikasi::index');
    $routes->get('Publikasi', 'Publikasi::index');
    $routes->get('Publikasi/ajupublikasi', 'Publikasi::Ajupublikasi');
    $routes->post('Publikasi/Judulpublikasi/(:num)', 'Publikasi::Judulpublikasi/$1');
    $routes->get('Publikasi/LihatKomentar/(:num)', 'Publikasi::LihatKomentar/$1');
    $routes->get('pengajuan/publikasi', 'Publikasi::index');
    $routes->get('pemeriksaan/publikasi', 'Publikasi::index');
    $routes->post('Publikasi/InsertData', 'Publikasi::InsertData');
    $routes->get('pemeriksaan/sprp', 'PemeriksaanController::index');
    $routes->get('pemeriksaan/sprp', 'PemeriksaanController::save_no_publikasi/$1');
    $routes->post('pemeriksaan/save_no_publikasi', 'PemeriksaanController::save_no_publikasi');
    $routes->get('pemeriksaan/get_details/(:num)', 'PemeriksaanController::get_details/$1');
    $routes->post('/pemeriksaan/store_nomor_publikasi', 'PemeriksaanController::store_nomor_publikasi');
    // $routes->get('pemeriksaan/pemeriksaan', 'Pemeriksaan::index');

    // Routes for SPRP CRUD
    $routes->get('/sprp', 'SprpController::index');
    $routes->get('pengajuan/sprp', 'SprpController::index');
    $routes->get('/sprp/create', 'SprpController::create');
    $routes->post('/sprp/store', 'SprpController::store');
    $routes->get('/sprp/edit/(:num)', 'SprpController::edit/$1');
    $routes->post('/sprp/update/(:num)', 'SprpController::update/$1');
    $routes->get('/sprp/delete/(:num)', 'SprpController::delete/$1');
    $routes->get('sprp/get_details/(:num)', 'SprpController::get_details/$1');
    $routes->get('sprp/updateNomorPublikasi/(:num)', 'SprpController::updateNomorPublikasi/$1');
    $routes->get('sprp/save_no_publikasi/(:num)', 'SprpController::save_no_publikasi/$1');

    // Routes Master Publikasi
    $routes->get('kelola/masterpublikasi', 'MasterPublikasi::index');
    $routes->post('kelola/masterpublikasi/delete/(:num)', 'MasterPublikasi::delete/$1');
    $routes->post('kelola/masterpublikasi/edit/(:num)', 'MasterPublikasi::edit/$1');
    $routes->post('masterpublikasi/tambah', 'MasterPublikasi::tambah');
    $routes->post('masterpublikasi/unggahPublikasi', 'MasterPublikasi::unggahPublikasi');
    $routes->post('kelola/masterpublikasi/import', 'MasterPublikasi::unggahPublikasi');

    // Routes Komentar
    $routes->post('publikasi/addkomentar', 'Publikasi::AddKomentar');

    $routes->post('Publikasi/getStatusOptions', 'Publikasi::getStatusOptions');
    $routes->post('Publikasi/updateStatus', 'Publikasi::updateStatus');
    $routes->post('publikasi/editkomentar', 'Publikasi::editKomentar');
    $routes->post('publikasi/deletekomentar/(:num)', 'Publikasi::deleteKomentar/$1');
    $routes->post('publikasi/updateStatus', 'Publikasi::updateStatus');
    $routes->post('Publikasi/deletePublikasi/(:num)', 'Publikasi::deletePublikasi/$1');
    $routes->post('Publikasi/updateLink', 'Publikasi::updateLink');

    $routes->get('Publikasi/getReplies', 'Publikasi::getReplies');
    $routes->post('publikasi/addReply', 'Publikasi::addReply');

    // Routes Kelola Pengguna
    $routes->get('/kelola/peranpengguna', 'Pengguna::index');
    $routes->get('kelola/create', 'Pengguna::createUser');
    $routes->post('/kelola/pengguna/store', 'Pengguna::storeUser');
    $routes->get('/kelola/pengguna/edit/(:num)', 'Pengguna::editUser/$1');
    $routes->post('/kelola/pengguna/update/(:num)', 'Pengguna::updateUser/$1');
    $routes->get('/kelola/pengguna/delete/(:num)', 'Pengguna::deleteUser/$1');
});
