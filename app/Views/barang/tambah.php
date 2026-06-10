<?php $this->extend('template/layout'); ?>
<?php $this->section('content'); ?>
<h3 class="mt-5">Input Data Barang</h3>
<form action="/barang/simpan" method="post">
    <?php csrf_field(); ?>
    <div class="mb-3">
        <label class="form-label">Kode Barang</label>
        <input type="text" class="form-control" name="kd_barang" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Nama Barang</label>
        <input type="text" class="form-control" name="nama_barang" required>
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="/barang/home" class="btn btn-primary">Kembali</a>
</form>
<?php $this->endSection(); ?>