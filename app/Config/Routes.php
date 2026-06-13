<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Auth::index');
$routes->get('login', 'Auth::index');
$routes->post('login', 'Auth::login');
$routes->get('logout', 'Auth::logout');

$routes->group('', ['filter' => 'auth'], static function ($routes) {
    $routes->get('dashboard', 'Dashboard::index');

    $routes->get('transaksi', 'Transaksi::index');
    $routes->get('transaksi/baru', 'Transaksi::baru');
    $routes->post('transaksi/simpan', 'Transaksi::simpan');
    $routes->get('transaksi/struk/(:num)', 'Transaksi::struk/$1');

    $routes->get('histori', 'Histori::index');
    $routes->get('histori/detail/(:num)', 'Histori::detail/$1');

    $routes->get('laporan-penjualan', 'Laporan::penjualan');
    $routes->get('laporan-penjualan/cetak', 'Laporan::cetakPenjualan');

    $routes->group('', ['filter' => 'role:owner'], static function ($routes) {
        $routes->get('kategori', 'Kategori::index');
        $routes->post('kategori/simpan', 'Kategori::simpan');
        $routes->post('kategori/update/(:num)', 'Kategori::update/$1');
        $routes->get('kategori/hapus/(:num)', 'Kategori::hapus/$1');

        $routes->get('produk', 'Produk::index');
        $routes->post('produk/simpan', 'Produk::simpan');
        $routes->post('produk/update/(:num)', 'Produk::update/$1');
        $routes->get('produk/hapus/(:num)', 'Produk::hapus/$1');

        $routes->get('akun', 'Akun::index');
        $routes->post('akun/simpan', 'Akun::simpan');
        $routes->post('akun/update/(:num)', 'Akun::update/$1');
        $routes->get('akun/hapus/(:num)', 'Akun::hapus/$1');

        $routes->get('jurnal', 'Jurnal::index');
        $routes->get('bukubesar', 'BukuBesar::index');

        $routes->get('laporan-labarugi', 'Laporan::labaRugi');
        $routes->get('laporan-labarugi/cetak', 'Laporan::cetakLabaRugi');
    });
});
