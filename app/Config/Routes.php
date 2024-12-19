<?php

use App\Controllers\ProductPage;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'LoginController::index');
$routes->post('/login', 'LoginController::login');
$routes->get('login', 'LoginController::index', ['filter' => 'guest']);

$routes->get('/logout', 'LoginController::logout');
$routes->get('/register', 'RegisterController::index');
$routes->post('/register', 'RegisterController::register');
$routes->get('product', 'ProductPage::index');
$routes->get('/men','JenisProduk::index');
$routes->get('/cart','CartController::index');
$routes->get('/payment','PaymentController::index');
$routes->get('/payment-summary/(:segment)','PaymentController::show/$1');
$routes->get('category/(:segment)', 'JenisProduk::viewBarangByCategory/$1');
$routes->get('barang/detail/(:segment)', 'BarangController::detail/$1');
$routes->get('barang/index', 'BarangController::catalog');
$routes->get('barang/index/(:num)', 'BarangController::catalog/$1'); // Filter by category
$routes->get('/profile', 'ProfileController::index');
$routes->post('/create-snap-token', 'ProfileController::createSnapToken');
$routes->post('/save-snap-token','PaymentController::saveSnapToken');
$routes->post('/get-snap-token','PaymentController::getSnapToken');
$routes->post('/pembayaran','PaymentController::insert');
$routes->post('/pembayaran-update','PaymentController::update');
$routes->post('/payment-verify/(:any)', 'PaymentController::verify/$1');
$routes->get('/pembayaran', 'PaymentController::show');
$routes->get('/profile', 'ProfileController::index');

$routes->group('admin', ['filter' => 'admin'], function ($routes) {
    $routes->get('/', 'BarangController::barangMasukHariIni'); // Halaman utama admin
    $routes->get('category', 'AdminController::category'); // Kategori
    $routes->get('user', 'LoginController::AllUsers'); // Halaman pengguna
    $routes->get('orders', 'AdminController::allOrders'); // Semua pesanan
    $routes->get('orders/detail/(:segment)', 'AdminController::orderDetail/$1'); // Detail pesanan
    $routes->get('orders/detail/updateStatus/(:segment)','AdminController::ordersStatus/$1');
    $routes->get('orders/detail/delete/(:segment)','AdminController::ordersDelete/$1');
    $routes->get('payment', 'AdminController::allPayment'); // Semua pembayaran
    $routes->get('payment/detail/(:segment)', 'AdminController::paymentDetail/$1'); // Detail pembayaran
    $routes->get('barang/add', 'BarangController::add'); // Tambah barang
    $routes->post('barang/store', 'BarangController::store'); // Simpan barang baru
    $routes->get('barang', 'BarangController::index'); // Tampilkan daftar barang
    $routes->get('barang/delete/(:segment)', 'BarangController::delete/$1'); // Hapus barang
    $routes->get('barang/edit/(:segment)', 'BarangController::edit/$1'); // Form edit barang
    $routes->post('barang/update/(:segment)', 'BarangController::update/$1'); // Perbarui barang
});


?>




