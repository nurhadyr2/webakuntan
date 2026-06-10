<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('user')->insertBatch([
            [
                'nama_user' => 'Owner',
                'username'  => 'owner',
                'password'  => password_hash('owner123', PASSWORD_DEFAULT),
                'hak_akses' => 'owner',
            ],
            [
                'nama_user' => 'Kasir',
                'username'  => 'kasir',
                'password'  => password_hash('kasir123', PASSWORD_DEFAULT),
                'hak_akses' => 'kasir',
            ],
        ]);

        $this->db->table('akun_akuntansi')->insertBatch([
            ['kode_akun' => '111', 'nama_akun' => 'Kas', 'posisi' => 'debit'],
            ['kode_akun' => '112', 'nama_akun' => 'Persediaan Barang Dagang', 'posisi' => 'debit'],
            ['kode_akun' => '211', 'nama_akun' => 'Utang Usaha', 'posisi' => 'kredit'],
            ['kode_akun' => '212', 'nama_akun' => 'Pendapatan Diterima Dimuka (DP Preorder)', 'posisi' => 'kredit'],
            ['kode_akun' => '311', 'nama_akun' => 'Modal', 'posisi' => 'kredit'],
            ['kode_akun' => '411', 'nama_akun' => 'Penjualan', 'posisi' => 'kredit'],
            ['kode_akun' => '511', 'nama_akun' => 'Harga Pokok Penjualan', 'posisi' => 'debit'],
            ['kode_akun' => '512', 'nama_akun' => 'Beban Operasional', 'posisi' => 'debit'],
        ]);

        $this->db->table('kategori')->insertBatch([
            ['nama_kategori' => 'Makanan'],
            ['nama_kategori' => 'Minuman'],
            ['nama_kategori' => 'Alat Tulis'],
        ]);
    }
}
