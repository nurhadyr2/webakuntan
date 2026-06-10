<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//routes utama / halaman home
$routes->get('/', 'Produk::MenampilkanData');

//data barang
$routes->get('/barang/home','Barang::index');
$routes->get('/barang/tambah','Barang::tambah');
$routes->post('/barang/simpan','Barang::simpan');
$routes->get('/barang/edit/(:segment)','Barang::edit/$1');
$routes->post('/barang/ubah/(:segment)','Barang::ubah/$1');
$routes->post('/barang/hapus/(:segment)','Barang::hapus/$1');

//data pelanggan
$routes->get('/pelanggan/home','Pelanggan::index');
$routes->get('/pelanggan/tambah','Pelanggan::tambah');
$routes->post('/pelanggan/simpan','Pelanggan::simpan');
$routes->get('/pelanggan/edit/(:segment)','Pelanggan::edit/$1');
$routes->post('/pelanggan/ubah/(:segment)','Pelanggan::ubah/$1');
$routes->post('/pelanggan/hapus/(:segment)','Pelanggan::hapus/$1');

//data transaksi
$routes->get('/transaksi/home','Transaksi::index');
$routes->get('/transaksi/tambah','Transaksi::tambah');