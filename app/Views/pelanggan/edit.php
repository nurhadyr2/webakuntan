<?php $this->extend('template/layout'); ?>
<?php $this->section('content'); ?>
<h3 class="mt-5">Edit Data Barang</h3>
<form action="/pelanggan/ubah/<?= $pelanggan['id_pelanggan']?>" method="post">
    <?php csrf_field(); ?>
    <div class="mb-3">
        <label class="form-label">Id Pelangan</label>
        <input type="text" class="form-control" name="id_pelanggan" required value="<?=$pelanggan['id_pelanggan']?>"disabled>
    </div>
    <div class="mb-3">
        <label class="form-label">Nama Pelanggan</label>
        <input type="text" class="form-control" name="nama_pelanggan" required value="<?=$pelanggan['nama_pelanggan']?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Bagian</label>
        <input type="text" class="form-control" name="bagian" required value="<?=$pelanggan['bagian']?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Alamat</label>
        <input type="text" class="form-control" name="alamat" required value="<?=$pelanggan['alamat']?>">
    </div>
    <div class="mb-3">
        <label class="form-label">No Telepon</label>
        <input type="text" class="form-control" name="no_telepon" required value="<?=$pelanggan['no_telepon']?>">
    </div>
    <button type="submit" class="btn btn-success">Edit </button>
    <a href="/pelanggan/home" class="btn btn-primary">Kembali</a>
</form>
<?php $this->endSection(); ?>