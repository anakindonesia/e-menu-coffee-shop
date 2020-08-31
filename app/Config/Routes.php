<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
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
$routes->add('/', 'Front\Login::index');
$routes->add('/login', 'Front\Login::loginPelanggan');
$routes->add('/login/(:any)/(:any)', 'Front\Login::loginQrcode/$1/$2');
$routes->add('/home', 'Front\Home::index');
$routes->add('/menu/(:num)', 'Front\Home::menu/$1');
$routes->add('/cart', 'Front\Cart::index');
$routes->add('/cart/beli/(:num)', 'Front\Cart::beli/$1');
$routes->add('/cart/tambah/(:num)', 'Front\Cart::tambah/$1');
$routes->add('/cart/kurang/(:num)', 'Front\Cart::kurang/$1');
$routes->add('/cart/proses/(:num)', 'Front\Cart::proses/$1');
$routes->add('/cart/hapus/(:num)', 'Front\Cart::hapus/$1');
$routes->add('/selesai', 'Front\SelesaiPesanan::index');
$routes->add('/selesai/(:num)', 'Front\SelesaiPesanan::aksi/$1');
$routes->add('/selesai/cetak/(:num)', 'Front\SelesaiPesanan::cetak/$1');

$routes->add('/json', 'Front\SelesaiPesanan::json');

$routes->add('/admin', 'Back\Login::index');
$routes->add('/admin/login', 'Back\Login::loginAdmin');
$routes->add('/admin/logout', 'Back\Login::logout');
$routes->add('/admin/home', 'Back\Home::index');
$routes->add('/admin/home/meja', 'Back\Home::getMeja');
$routes->add('/admin/home/lihat/(:num)', 'Back\Home::LihatPesanan/$1'); 
$routes->add('/admin/home/(:segment)', 'Back\Home::Pesanan/$1'); 
$routes->get('/admin/home/(:segment)/proses', 'Back\Home::prosesPesanan/$1');
$routes->get('/admin/home/pesanan/(:num)', 'Back\Home::lihatProsesPesanan/$1');
$routes->get('/admin/home/pesanan/proses/(:num)', 'Back\Home::selesaiProsesPesanan/$1');
$routes->get('/admin/home/pesanan/delete/(:num)', 'Back\Home::hapusPesanan/$1');
$routes->add('/admin/home/form/bayar', 'Back\Home::lihataksiPesanan'); 
$routes->add('/admin/home/aksi/bayar', 'Back\Home::bayar'); 
$routes->add('/admin/meja', 'Back\Meja::index');
$routes->add('/admin/meja/cetak', 'Back\Meja::cetakMeja');


$routes->add('/admin/kategori', 'Back\Kategori::index');
$routes->add('/admin/kategori/save', 'Back\Kategori::saveKategori');
$routes->add('/admin/kategori/update', 'Back\Kategori::updateKategori');
$routes->add('/admin/kategori/delete', 'Back\Kategori::deleteKategori');

$routes->add('/admin/minuman', 'Back\Minuman::index');
$routes->add('/admin/minuman/tambah', 'Back\Minuman::tambahMinuman');
$routes->add('/admin/minuman/saveTambahMinuman', 'Back\Minuman::saveTambahMinuman');
$routes->add('/admin/minuman/edit/(:num)', 'Back\Minuman::editMinuman/$1');
$routes->add('/admin/minuman/saveEdit', 'Back\Minuman::saveEditMinuman');
$routes->add('/admin/minuman/hapusMinuman', 'Back\Minuman::hapusMinuman');
$routes->add('/admin/minuman/status/(:num)/(:num)', 'Back\Minuman::statusMinuman/$1/$2');


$routes->add('/admin/makanan', 'Back\Makanan::index');
$routes->add('/admin/makanan/tambah', 'Back\Makanan::tambahMakanan');
$routes->add('/admin/makanan/saveTambahMakanan', 'Back\Makanan::saveTambahMakanan');
$routes->add('/admin/makanan/edit/(:num)', 'Back\Makanan::editMakanan/$1');
$routes->add('/admin/makanan/saveEdit', 'Back\Makanan::saveEditMakanan');
$routes->add('/admin/makanan/hapusMakanan', 'Back\Makanan::hapusMakanan');
$routes->add('/admin/makanan/status/(:num)/(:num)', 'Back\Makanan::statusMakanan/$1/$2');

$routes->add('/admin/meja', 'Back\Meja::index');
$routes->add('/admin/meja/save', 'Back\Meja::saveMeja');
$routes->add('/admin/meja/delete', 'Back\Meja::deleteMeja');

$routes->add('/admin/rekap', 'Back\Rekap::index');
$routes->add('/admin/rekap/(:num)', 'Back\Rekap::lihatRekap/$1');
$routes->add('/admin/rekap/(:num)/cetak', 'Back\Rekap::cetakRekap/$1');

$routes->add('/admin/laporan/(:segment)', 'Back\Laporan::index/$1');
$routes->add('/admin/laporan/(:segment)/cetak', 'Back\Laporan::cetakLaporan/$1');

$routes->add('/admin/user', 'Back\User::index');
$routes->add('/admin/user/tambah', 'Back\User::tambahUser');
$routes->add('/admin/user/saveTambahUser', 'Back\User::saveTambahUser');
$routes->add('/admin/user/edit/(:num)', 'Back\User::editUser/$1');
$routes->add('/admin/user/saveEditUser', 'Back\User::saveEditUser');
$routes->add('/admin/user/reset/(:num)', 'Back\User::resetPassword/$1');
$routes->add('/admin/user/delete', 'Back\User::deleteUser');

$routes->add('/admin/password', 'Back\Password::index');
$routes->add('/admin/password/reset', 'Back\Password::resetPassword');

$routes->add('/admin/reset', 'Back\Reset::send');
$routes->add('/admin/reset/password/(:any)', 'Back\Reset::checkToken/$1');
$routes->add('/admin/reset/save', 'Back\Reset::reset');
/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
