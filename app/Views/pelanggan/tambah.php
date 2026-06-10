<?php $this->extend('template/layout'); ?>
<?php $this->section('content'); ?>
<h3 class="mt-5">Input Data Pelanggan</h3>
<form action="/pelanggan/simpan" method="post">
    <?php csrf_field(); ?>
    <div class="mb-3">
        <label class="form-label">Id Pelanggan</label>
        <input type="text" class="form-control" name="id_pelanggan" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Nama Pelanggan</label>
        <input type="text" class="form-control" name="nama_pelanggan" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Bagian</label>
        <input type="text" class="form-control" name="bagian" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Alamat</label>
        <input type="text" class="form-control" name="alamat" required>
    </div>
    <div class="mb-3">
        <label class="form-label">No Telepon</label>
        <input type="text" class="form-control" name="no_telepon" required>
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="/pelanggan/home" class="btn btn-primary">Kembali</a>
</form>
<?php $this->endSection(); ?>