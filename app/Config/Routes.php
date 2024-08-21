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
$routes->get('dashboard', 'Publikasi::dashboard', ['filter' => 'authGuard']);
$routes->get('auth/login', 'Auth::login');
$routes->get('login', 'Auth::login');
$routes->get('auth/ssoCallback', 'Auth::ssoCallback');
$routes->get('auth/logout', 'Auth::logout');
$routes->get('auth/switchRole/(:num)', 'Auth::switchRole/$1');
$routes->get('publikasi', 'Publikasi::index');
$routes->get('Publikasi', 'Publikasi::index');
$routes->get('Publikasi/ajupublikasi', 'Publikasi::Ajupublikasi');
$routes->post('Publikasi/Judulpublikasi/(:num)', 'Publikasi::Judulpublikasi/$1');
$routes->get('Publikasi/LihatKomentar/(:num)', 'Publikasi::LihatKomentar/$1');
$routes->get('pengajuan/publikasi', 'Publikasi::index');
$routes->get('pemeriksaan/publikasi', 'Publikasi::index');
$routes->post('Publikasi/InsertData', 'Publikasi::InsertData');

// Routes for SPRP CRUD
$routes->get('/sprp', 'SprpController::index');
$routes->get('pengajuan/sprp', 'SprpController::index');
$routes->get('/sprp/create', 'SprpController::create');
$routes->post('/sprp/store', 'SprpController::store');
$routes->get('/sprp/edit/(:num)', 'SprpController::edit/$1');
$routes->post('/sprp/update/(:num)', 'SprpController::update/$1');
$routes->get('/sprp/delete/(:num)', 'SprpController::delete/$1');

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








// $routes->get('/layanan/form', 'Layanan::form');
// $routes->get('/layanan/tabel', 'Layanan::tabel');
// $routes->post('/layanan/submit', 'Layanan::submit');

// $routes->get('/pengajuan_layanan_ti', 'LayananTI::index');
// $routes->get('/pengajuan_layanan_ti/create', 'LayananTI::create');
// $routes->post('/pengajuan_layanan_ti/store', 'LayananTI::store');
// $routes->get('/pengajuan_layanan_ti/(:num)', 'LayananTI::show/$1');
// $routes->get('/pengajuan_layanan_ti/(:num)/edit', 'LayananTI::edit/$1');
// $routes->post('/pengajuan_layanan_ti/(:num)/update', 'LayananTI::update/$1');
// $routes->post('/pengajuan_layanan_ti/(:num)/delete', 'LayananTI::delete/$1');
// $routes->get('/pengajuan_layanan_ti/assign_technician/(:num)', 'LayananTI::assignTechnician/$1');
// $routes->post('/pengajuan_layanan_ti/saveTechnicianAssignment/(:num)', 'LayananTI::saveTechnicianAssignment/$1');
// $routes->post('/pengajuan_layanan_ti/addAction/(:num)', 'LayananTI::addAction/$1');
// $routes->get('/pengajuan_layanan_ti/print_receipt/(:num)', 'LayananTI::printReceipt/$1');


// $routes->group('', ['filter' => 'auth'], function ($routes) {
//     $routes->get('/dashboard', 'Dashboard::index');

    // Layanan TI
    // $routes->group('layanan_ti', function ($routes) {
    // $routes->get('pengajuan', 'LayananTI::pengajuan');
    // $routes->get('status', 'LayananTI::status');
    // $routes->get('penanganan', 'LayananTI::penanganan', ['filter' => 'teknisiOrAdmin']);
    //     $routes->get('pengajuan', 'LayananTI::index');
    //     $routes->get('create', 'LayananTI::create');
    //     $routes->post('store', 'LayananTI::store');
    //     $routes->get('assign/(:num)', 'LayananTI::assign/$1');
    //     $routes->get('print/(:num)', 'LayananTI::print/$1');
    //     $routes->get('status', 'StatusController::index');
    //     $routes->get('penanganan', 'PenangananController::index', ['filter' => 'role:teknisi,admin']);
    // });


//     $routes->group('layanan_ti', function ($routes) {
//         $routes->get('/', 'LayananTI::index');
//         $routes->get('pengajuan', 'LayananTI::index');
//         $routes->get('create', 'LayananTI::create');
//         $routes->get('/layanan_ti/edit/(:num)', 'LayananTI::edit/$1');
//         $routes->post('/layanan_ti/update/(:num)', 'LayananTI::update/$1');

//         $routes->post('store', 'LayananTI::store');
//         $routes->get('assign/(:num)', 'LayananTI::assign/$1');
//         $routes->post('assign_store/(:num)', 'LayananTI::assign_store/$1');

//         $routes->get('print/(:num)', 'LayananTI::print/$1');
//         $routes->get('update_status/(:num)', 'LayananTI::updateStatus/$1');
//         $routes->get('penanganan', 'PenangananController::index');
//     });

//     // Pengaturan (Only for Admin)
//     $routes->group('pengaturan', ['filter' => 'admin'], function ($routes) {
//         $routes->get('/', 'Pengaturan::index');
//         $routes->get('create', 'Pengaturan::create');
//         $routes->post('store', 'Pengaturan::store');
//         $routes->get('edit/(:num)', 'Pengaturan::edit/$1');
//         $routes->post('update/(:num)', 'Pengaturan::update/$1');
//         $routes->get('delete/(:num)', 'Pengaturan::delete/$1');
//     });

//     // Aksi Layanan TI
//     $routes->group('aksi_layanan_ti', function($routes) {
//         $routes->get('/', 'AksiLayananTIController::index');
//         $routes->get('index', 'AksiLayananTIController::index');
//         $routes->get('create/(:num)', 'AksiLayananTIController::create/$1');
//         $routes->post('store', 'AksiLayananTIController::store');
//         $routes->get('log/(:num)', 'AksiLayananTIController::log/$1');
//         $routes->get('updateStatus/(:num)/(:any)', 'AksiLayananTIController::updateStatus/$1/$2');
//         $routes->get('printTandaTerima/(:num)', 'AksiLayananTIController::printTandaTerima/$1');
//     });
// });
