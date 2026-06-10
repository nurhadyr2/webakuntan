<?php $this->extend('template/layout'); ?>

<?php $this->section('content'); ?>

<div class="row mb-4">
    <div class="col-6">
        <h2>Data</h2>
    </div>
    <div class="col-3"></div>
    <div class="col-3 text-end mt-2">
        <a href="/transaksi/tambah" class="btn btn-primary">Tambah Data</a>
    </div>
</div>
<table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th scope="col">No</th>
            <th scope="col">No Transaksi</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Id Pelanggan</th>
            <th scope="col">Jenis Transaksi</th>
            <th scope="col">Nama Pelanggan</th>
            <th scope="col">Nama Barang</th>
            <th scope="col">Jumlah Barang</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1 ?>
        <?php foreach ($array as $kolom) : ?>
            <tr>
                <th scope="row"><?= $no++ ?></th>
                <td><?//= $kolom['id_produk'] ?></td>
                <td><?//= $kolom['nama_produk'] ?></td>
                <td><?//= $kolom['harga'] ?></td>
                <td>
                    <a href="/edit/<?//= $kolom['di isi kolom primary key'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <form action="/hapus/<?//= $kolom['di isi kolom primary'] ?>" method="post" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
</div>
<?php $this->endSection(); ?>