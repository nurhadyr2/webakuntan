<?php $this->extend('template/layout'); ?>
<?php $this->section('content'); ?>
<h3 class="mt-5">Edit Data Barang</h3>
<form action="/barang/ubah/<?= $barang['kd_barang']?>" method="post">
    <?php csrf_field(); ?>
    <div class="mb-3">
        <label class="form-label">Kode Barang</label>
        <input type="text" class="form-control" name="kd_barang" required value="<?=$barang['kd_barang']?>"disabled>
    </div>
    <div class="mb-3">
        <label class="form-label">Nama Barang</label>
        <input type="text" class="form-control" name="nama_barang" required value="<?=$barang['nama_barang']?>">
    </div>
    <button type="submit" class="btn btn-success">Edit </button>
    <a href="/barang/home" class="btn btn-primary">Kembali</a>
</form>
<?php $this->endSection(); ?>