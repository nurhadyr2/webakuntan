<?php $this->extend('template/layout'); ?>

<?php $this->section('content'); ?>

<div class="row mb-4">
    <div class="col-6">
        <h2>Data Pelanggan</h2>
    </div>
    <div class="col-3"></div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                <a href="/pelanggan/tambah" class="btn btn-primary mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" 
                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" />
                <line x1="5" y1="12" x2="19" y2="12" /></svg>    
                Tambah Data</a>
                        <table class="table table-striped table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Id Pelanggan</th>
                                    <th scope="col">Nama Pelanggan</th>
                                    <th scope="col">Bagian</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">No Telepon</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                                <tbody>
                                <?php $no = 1 ?>
                                    <?php foreach ($array as $pelanggan) : ?>
                                        <tr>
                                            <th scope="row"><?= $no++ ?></th>
                                            <td><?= $pelanggan['id_pelanggan'] ?></td>
                                            <td><?= $pelanggan['nama_pelanggan'] ?></td>
                                            <td><?= $pelanggan['bagian'] ?></td>
                                            <td><?= $pelanggan['alamat'] ?></td>
                                            <td><?= $pelanggan['no_telepon'] ?></td>
                                            <td>
                                                <a href="/pelanggan/edit/<?= $pelanggan['id_pelanggan'] ?>" class="btn btn-warning btn-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" 
                                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                                                <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                                                <line x1="16" y1="5" x2="19" y2="8" /></svg>
                                                </a>
                                                <form action="/pelanggan/hapus/<?= $pelanggan['id_pelanggan'] ?>" method="post" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                    <?= csrf_field() ?>
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" 
                                                    stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" />
                                                    <line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" />
                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                        </table>
    </div>
        </div>
            </div>
                </div>
</div>
<?php $this->endSection(); ?>