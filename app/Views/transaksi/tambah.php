<?php $this->extend('template/layout'); ?>
<?php $this->section('content'); ?>
<h3 class="mt-5">Input Data Penjualan</h3>

           
<form action="/barang/simpan" method="post">
<div class="row">
    <div class="div col-md-12">
        <div class="card">
            <div class="card-header">
    <?php csrf_field(); ?>
    <div class="mb-3">
        <label class="form-label">No Transaksi</label>
        <input type="text" class="form-control" name="no_faktur" id="no_faktur" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Tanggal</label>
        <input type="date" class="form-control" name="tgl" id="tgl" required onchange="getjatuhtempo()">
    </div>
    <div class="mb-3">
        <label class="form-label">Id Pelanggan</label>
        <input type="hidden" class="form-control" name="id_pelanggan">
        <input type="text" class="form-control" name="id_pelanggan" id="id_pelanggan" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Jenis Transaksi</label>
        <select name="jenis_transaksi" id="jenis_transaksi" class="form-select" required>
            <option value="">----</option>
            <option value="tunai">Tunai</option>
            <option value="kredit">Kredit</option>
        </select>
    </div>
    <div class="mb-3" id="jt">
        <label class="form-label">Jatuh Tempo</label>
        <input type="date" class="form-control" name="jatuh_tempo" id="jatuh_tempo" required>
    </div>
    
</div>
    </div>
</div>
</div>

<div class="row mt-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Data Barang
                </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                    <div class="mb-3">
                        <label class="form-label">Kode Barang</label>
                        <input type="text" class="form-control" name="nama_barang" id="kd_barang" required>
                    </div>
                    </div>
                    <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" name="nama_barang" id="nama_barang" required>
                    </div>
                    </div>
                    <div class="col-md-2">
                    <div class="mb-3">
                        <label class="form-label">Harga</label>
                        <input type="text" class="form-control" name="harga" id="harga" required>
                    </div>
                    </div>
                    <div class="col-md-2">
                    <div class="mb-3">
                        <label class="form-label">Jumlah</label>
                        <input type="text" class="form-control" name="qty" id="qty" required>
                    </div>
                    </div>
                    <div class="col-md-2">
                    <div class="md-3">
                        <a href="#" class="btn btn-primary mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="10" height="10" viewBox="0 0 24 24" 
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" /></svg>    
                        </a>
                    </div>
                    </div>

                    <div class="row">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th colspan="5">TOTAL BAYAR</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <button type="submit" class="btn btn-promary">SIMPAN</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
<div class="modal modal-blu fade" id="modalpelanggan" tabindex="1" roel="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Pelanggan</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
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
                                <?php if ( !empty($array)): ?>
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
                                    <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data pelanggan</td>
                                </tr>
                            <?php endif; ?>
                                </tbody>
                        </table>
                </div>
        </div>
    </div>
</div>
<div class="mt-3">
    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="/barang/home" class="btn btn-primary">Kembali</a>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(function(){
        function hidejatuhtempo(){
            $("#jt").hide();
        }

        function showjatuhtempo(){
            $("#jt").show();
        }

        function getjatuhtempo() {
                var tgl = $("#tgl").val(); 
                console.log("Tanggal yang dikirim: " + tgl); // Debugging
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url(); ?>Transaksi/getjatuhtempo', // Pastikan URL ini benar
                    data: {tgl: tgl}, 
                    cache: false,
                    success: function(respond) {
                        console.log("Respons dari server: " + respond); // Debugging
                        $("#jatuh_tempo").val(respond); // Mengisi input jatuh_tempo
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error("AJAX Error: " + textStatus + ": " + errorThrown);
                    }
                });
        }
        getjatuhtempo();
        hidejatuhtempo();

        $("#jenis_transaksi").change(function(){
            var jenis_transaksi = $(this).val();
            if(jenis_transaksi == "kredit"){
                showjatuhtempo();
            }
            else{
                hidejatuhtempo();
            }
        });
        
        $("#tgl").change(function(){
            getjatuhtempo();
        });

        $("#id_pelanggan").click(function(){
             $("#modalpelanggan").modal("show");
        });
    });
</script>
         


<?php $this->endSection(); ?>