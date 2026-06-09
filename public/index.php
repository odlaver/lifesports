<?php
session_start();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/Core/AutoLoader.php';

\App\Core\AutoLoader::register();

$router = new \App\Core\Router();

$router->get('/', 'App\Controllers\HomeController@index');
$router->get('/home', 'App\Controllers\HomeController@index');
$router->get('/lapangan', 'App\Controllers\HomeController@lapangan');
$router->get('/home/lapangan', 'App\Controllers\HomeController@lapangan');
$router->get('/lapangan/{id}', 'App\Controllers\HomeController@detailLapangan');

$router->get('/login', 'App\Controllers\AuthController@showLogin');
$router->post('/login', 'App\Controllers\AuthController@login');
$router->get('/register', 'App\Controllers\AuthController@showRegister');
$router->post('/register', 'App\Controllers\AuthController@register');
$router->get('/logout', 'App\Controllers\AuthController@logout');

$router->get('/auth/login', 'App\Controllers\AuthController@showLogin');
$router->post('/auth/prosesLogin', 'App\Controllers\AuthController@login');
$router->get('/auth/register', 'App\Controllers\AuthController@showRegister');
$router->post('/auth/prosesRegister', 'App\Controllers\AuthController@register');
$router->get('/auth/logout', 'App\Controllers\AuthController@logout');

$router->get('/pelanggan', 'App\Controllers\Pelanggan\DashboardController@index');
$router->get('/pelanggan/lapangan', 'App\Controllers\Pelanggan\LapanganController@index');
$router->get('/pelanggan/lapangan/{id}', 'App\Controllers\Pelanggan\LapanganController@show');
$router->get('/pelanggan/pelanggan_detail_lapangan/{id}', 'App\Controllers\Pelanggan\LapanganController@show');

$router->get('/pelanggan/booking', 'App\Controllers\Pelanggan\BookingController@index');
$router->get('/pelanggan/booking/{id}', 'App\Controllers\Pelanggan\BookingController@show');
$router->get('/pelanggan/booking_detail/{id}', 'App\Controllers\Pelanggan\BookingController@show');
$router->get('/pelanggan/booking/create/{id}', 'App\Controllers\Pelanggan\BookingController@create');
$router->post('/pelanggan/booking/store', 'App\Controllers\Pelanggan\BookingController@store');
$router->post('/pelanggan/proses_booking', 'App\Controllers\Pelanggan\BookingController@store');
$router->post('/pelanggan/prosesBooking', 'App\Controllers\Pelanggan\BookingController@store');
$router->post('/pelanggan/cancelBooking/{id}', 'App\Controllers\Pelanggan\BookingController@cancel');

$router->get('/pelanggan/pembayaran/{id}', 'App\Controllers\Pelanggan\PembayaranController@create');
$router->post('/pelanggan/pembayaran/store/{id}', 'App\Controllers\Pelanggan\PembayaranController@store');
$router->post('/pelanggan/proses_pembayaran', 'App\Controllers\Pelanggan\PembayaranController@store');
$router->post('/pelanggan/prosesPembayaran/{id}', 'App\Controllers\Pelanggan\PembayaranController@store');

$router->get('/pelanggan/review/{id}', 'App\Controllers\Pelanggan\ReviewController@create');
$router->post('/pelanggan/review/store/{id}', 'App\Controllers\Pelanggan\ReviewController@store');
$router->post('/pelanggan/proses_review', 'App\Controllers\Pelanggan\ReviewController@store');
$router->post('/pelanggan/prosesReview', 'App\Controllers\Pelanggan\ReviewController@store');

$router->get('/pelanggan/profile', 'App\Controllers\Pelanggan\ProfileController@index');
$router->post('/pelanggan/profile/update', 'App\Controllers\Pelanggan\ProfileController@update');
$router->post('/pelanggan/update_profile', 'App\Controllers\Pelanggan\ProfileController@update');
$router->post('/pelanggan/updateProfile', 'App\Controllers\Pelanggan\ProfileController@update');
$router->post('/pelanggan/profile/password', 'App\Controllers\Pelanggan\ProfileController@changePassword');
$router->post('/pelanggan/ubahPassword', 'App\Controllers\Pelanggan\ProfileController@changePassword');

$router->get('/pengelola', 'App\Controllers\Pengelola\DashboardController@index');
$router->get('/pengelola/lapangan', 'App\Controllers\Pengelola\LapanganController@index');
$router->get('/pengelola/lapangan/create', 'App\Controllers\Pengelola\LapanganController@create');
$router->get('/pengelola/tambahLapangan', 'App\Controllers\Pengelola\LapanganController@create');
$router->post('/pengelola/lapangan/store', 'App\Controllers\Pengelola\LapanganController@store');
$router->post('/pengelola/proses_lapangan', 'App\Controllers\Pengelola\LapanganController@save');
$router->post('/pengelola/prosesTambahLapangan', 'App\Controllers\Pengelola\LapanganController@store');
$router->get('/pengelola/lapangan/edit/{id}', 'App\Controllers\Pengelola\LapanganController@edit');
$router->get('/pengelola/editLapangan/{id}', 'App\Controllers\Pengelola\LapanganController@edit');
$router->post('/pengelola/lapangan/update/{id}', 'App\Controllers\Pengelola\LapanganController@update');
$router->post('/pengelola/prosesEditLapangan', 'App\Controllers\Pengelola\LapanganController@update');
$router->post('/pengelola/lapangan/delete/{id}', 'App\Controllers\Pengelola\LapanganController@delete');
$router->post('/pengelola/hapusLapangan/{id}', 'App\Controllers\Pengelola\LapanganController@delete');
$router->post('/pengelola/lapangan/status/{id}', 'App\Controllers\Pengelola\LapanganController@toggleStatus');

$router->get('/pengelola/booking', 'App\Controllers\Pengelola\BookingController@index');
$router->get('/pengelola/booking/{id}', 'App\Controllers\Pengelola\BookingController@show');
$router->get('/pengelola/booking_detail/{id}', 'App\Controllers\Pengelola\BookingController@show');
$router->post('/pengelola/booking/confirm/{id}', 'App\Controllers\Pengelola\BookingController@confirm');
$router->post('/pengelola/konfirmasiBooking/{id}', 'App\Controllers\Pengelola\BookingController@confirm');
$router->post('/pengelola/booking/reject/{id}', 'App\Controllers\Pengelola\BookingController@reject');
$router->post('/pengelola/tolakBooking/{id}', 'App\Controllers\Pengelola\BookingController@reject');
$router->post('/pengelola/booking/complete/{id}', 'App\Controllers\Pengelola\BookingController@complete');

$router->get('/pengelola/pembayaran', 'App\Controllers\Pengelola\PembayaranController@index');

$router->get('/pengelola/laporan', 'App\Controllers\Pengelola\LaporanController@index');

$router->get('/pengelola/profile', 'App\Controllers\Pengelola\ProfileController@index');
$router->post('/pengelola/profile/update', 'App\Controllers\Pengelola\ProfileController@update');
$router->post('/pengelola/proses_profile', 'App\Controllers\Pengelola\ProfileController@update');
$router->post('/pengelola/updateProfile', 'App\Controllers\Pengelola\ProfileController@update');
$router->post('/pengelola/profile/password', 'App\Controllers\Pengelola\ProfileController@changePassword');
$router->post('/pengelola/ubahPassword', 'App\Controllers\Pengelola\ProfileController@changePassword');


$router->get('/admin', 'App\Controllers\Admin\DashboardController@index');
$router->get('/admin/user', 'App\Controllers\Admin\UserController@index');
$router->get('/admin/users', 'App\Controllers\Admin\UserController@index');
$router->get('/admin/user/create', 'App\Controllers\Admin\UserController@create');
$router->get('/admin/tambahUser', 'App\Controllers\Admin\UserController@create');
$router->post('/admin/user/store', 'App\Controllers\Admin\UserController@store');
$router->post('/admin/simpan_user', 'App\Controllers\Admin\UserController@save');
$router->post('/admin/prosesTambahUser', 'App\Controllers\Admin\UserController@store');
$router->get('/admin/user/edit/{id}', 'App\Controllers\Admin\UserController@edit');
$router->post('/admin/user/update/{id}', 'App\Controllers\Admin\UserController@update');
$router->post('/admin/prosesEditUser', 'App\Controllers\Admin\UserController@update');
$router->post('/admin/user/delete/{id}', 'App\Controllers\Admin\UserController@delete');
$router->post('/admin/hapusUser/{id}', 'App\Controllers\Admin\UserController@delete');

$router->get('/admin/kategori', 'App\Controllers\Admin\KategoriController@index');
$router->get('/admin/kategori/edit/{id}', 'App\Controllers\Admin\KategoriController@edit');
$router->post('/admin/kategori/store', 'App\Controllers\Admin\KategoriController@store');
$router->post('/admin/tambahKategori', 'App\Controllers\Admin\KategoriController@store');
$router->post('/admin/kategori/update/{id}', 'App\Controllers\Admin\KategoriController@update');
$router->post('/admin/prosesEditKategori', 'App\Controllers\Admin\KategoriController@update');
$router->post('/admin/kategori/delete/{id}', 'App\Controllers\Admin\KategoriController@delete');
$router->post('/admin/hapusKategori/{id}', 'App\Controllers\Admin\KategoriController@delete');

$router->get('/admin/lapangan', 'App\Controllers\Admin\LapanganController@index');
$router->get('/admin/lapangan/{id}', 'App\Controllers\Admin\LapanganController@show');
$router->get('/admin/lapangan_detail/{id}', 'App\Controllers\Admin\LapanganController@show');
$router->post('/admin/lapangan/status/{id}', 'App\Controllers\Admin\LapanganController@toggleStatus');

$router->get('/admin/booking', 'App\Controllers\Admin\BookingController@index');
$router->get('/admin/booking/{id}', 'App\Controllers\Admin\BookingController@show');
$router->get('/admin/booking_detail/{id}', 'App\Controllers\Admin\BookingController@show');

$router->get('/admin/pembayaran', 'App\Controllers\Admin\PembayaranController@index');

$router->get('/admin/laporan', 'App\Controllers\Admin\LaporanController@index');

$uri = $_SERVER['REQUEST_URI'];
$base = dirname($_SERVER['SCRIPT_NAME']);
if (strpos($uri, $base) === 0) {
    $uri = substr($uri, strlen($base));
}
$uri = parse_url($uri, PHP_URL_PATH);

$router->dispatch($uri, $_SERVER['REQUEST_METHOD']);
