<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ===== Auth =====
$routes->get('/', 'Auth::index');
$routes->get('login', 'Auth::index');
$routes->post('login', 'Auth::login');
$routes->get('logout', 'Auth::logout');

// ===== Area terproteksi (wajib login) =====
$routes->group('', ['filter' => 'auth'], static function ($routes) {

    // Dashboard
    $routes->get('dashboard', 'Dashboard::index');

    // Transaksi (owner + kasir)
    $routes->get('transaksi', 'Transaksi::index');
    $routes->get('transaksi/baru', 'Transaksi::baru');
    $routes->post('transaksi/simpan', 'Transaksi::simpan');
    $routes->get('transaksi/struk/(:num)', 'Transaksi::struk/$1');

    // Histori transaksi (owner + kasir)
    $routes->get('histori', 'Histori::index');
    $routes->get('histori/detail/(:num)', 'Histori::detail/$1');

    // ===== Khusus Owner =====
    $routes->group('', ['filter' => 'role:owner'], static function ($routes) {

        // Master: Kategori
        $routes->get('kategori', 'Kategori::index');
        $routes->post('kategori/simpan', 'Kategori::simpan');
        $routes->post('kategori/update/(:num)', 'Kategori::update/$1');
        $routes->get('kategori/hapus/(:num)', 'Kategori::hapus/$1');

        // Master: Produk
        $routes->get('produk', 'Produk::index');
        $routes->post('produk/simpan', 'Produk::simpan');
        $routes->post('produk/update/(:num)', 'Produk::update/$1');
        $routes->get('produk/hapus/(:num)', 'Produk::hapus/$1');

        // Master: Stok (gudang / stok masuk)
        $routes->get('stok', 'Stok::index');
        $routes->post('stok/simpan', 'Stok::simpan');
        $routes->get('stok/hapus/(:num)', 'Stok::hapus/$1');

        // Master: Akun Akuntansi
        $routes->get('akun', 'Akun::index');
        $routes->post('akun/simpan', 'Akun::simpan');
        $routes->post('akun/update/(:num)', 'Akun::update/$1');
        $routes->get('akun/hapus/(:num)', 'Akun::hapus/$1');

        // Jurnal Umum
        $routes->get('jurnal', 'Jurnal::index');

        // Buku Besar
        $routes->get('bukubesar', 'BukuBesar::index');

        // Laporan
        $routes->get('laporan-penjualan', 'Laporan::penjualan');
        $routes->get('laporan-penjualan/cetak', 'Laporan::cetakPenjualan');
        $routes->get('laporan-labarugi', 'Laporan::labaRugi');
        $routes->get('laporan-labarugi/cetak', 'Laporan::cetakLabaRugi');
    });
});
