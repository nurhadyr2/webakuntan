<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Models\DetailTransaksiModel;
use App\Models\ProdukModel;
use App\Models\JurnalUmumModel;
use App\Models\DetailJurnalUmumModel;
use App\Models\AkunAkuntansiModel;

class Transaksi extends BaseController
{
    protected TransaksiModel $transaksiModel;
    protected DetailTransaksiModel $detailModel;
    protected ProdukModel $produkModel;

    public function __construct()
    {
        $this->transaksiModel = new TransaksiModel();
        $this->detailModel    = new DetailTransaksiModel();
        $this->produkModel    = new ProdukModel();
    }

    public function index()
    {
        return view('transaksi/index', [
            'title'      => 'Transaksi',
            'breadcrumb' => 'Operasional / Transaksi',
            'transaksi'  => $this->transaksiModel->orderBy('id_trans', 'DESC')->findAll(50),
        ]);
    }

    public function baru()
    {
        return view('transaksi/baru', [
            'title'      => 'Transaksi Baru',
            'breadcrumb' => 'Operasional / Transaksi / Baru',
            'invoice'    => $this->transaksiModel->generateInvoice(),
            'produk'     => $this->produkModel->where('stok >', 0)->orderBy('nama_produk', 'ASC')->findAll(),
        ]);
    }

    public function simpan()
    {
        $idProduk = $this->request->getPost('id_prdk');
        $qty      = $this->request->getPost('qty');
        $bayar    = (float) $this->request->getPost('bayar');

        if (empty($idProduk) || ! is_array($idProduk)) {
            return redirect()->back()->withInput()->with('error', 'Minimal 1 barang harus dipilih.');
        }

        $db = \Config\Database::connect();
        $db->transStart();

        $items = [];
        $total = 0;
        foreach ($idProduk as $i => $pid) {
            $pid = (int) $pid;
            $q   = max(1, (int) ($qty[$i] ?? 1));
            $p   = $this->produkModel->find($pid);
            if (! $p) {
                continue;
            }
            if ($q > $p['stok']) {
                $db->transRollback();
                return redirect()->back()->withInput()
                    ->with('error', "Stok {$p['nama_produk']} tidak mencukupi (tersisa {$p['stok']}).");
            }
            $sub    = $p['harga'] * $q;
            $total += $sub;
            $items[] = ['p' => $p, 'qty' => $q, 'sub' => $sub];
        }

        if (empty($items)) {
            $db->transRollback();
            return redirect()->back()->withInput()->with('error', 'Tidak ada barang valid.');
        }

        if ($bayar < $total) {
            $db->transRollback();
            return redirect()->back()->withInput()->with('error', 'Jumlah bayar kurang dari total.');
        }

        $invoice = $this->transaksiModel->generateInvoice();
        $idTrans = $this->transaksiModel->insert([
            'invoice'   => $invoice,
            'tgl_trans' => date('Y-m-d H:i:s'),
            'total'     => $total,
            'bayar'     => $bayar,
            'kembalian' => $bayar - $total,
            'id_user'   => session('id_user'),
        ]);

        foreach ($items as $it) {
            $this->detailModel->insert([
                'id_trans'  => $idTrans,
                'id_prdk'   => $it['p']['id_produk'],
                'qty'       => $it['qty'],
                'harga'     => $it['p']['harga'],
                'sub_total' => $it['sub'],
            ]);
            $this->produkModel->update($it['p']['id_produk'], [
                'stok' => $it['p']['stok'] - $it['qty'],
            ]);
        }

        $this->buatJurnalOtomatis($idTrans, $invoice, $total);

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->to('/transaksi')->with('error', 'Gagal menyimpan transaksi.');
        }

        return redirect()->to('transaksi/struk/' . $idTrans)
            ->with('success', "Transaksi {$invoice} berhasil disimpan.");
    }

    protected function buatJurnalOtomatis(int $idTrans, string $invoice, float $total): void
    {
        $akunModel         = new AkunAkuntansiModel();
        $jurnalModel       = new JurnalUmumModel();
        $detailJurnalModel = new DetailJurnalUmumModel();

        $kas       = $akunModel->getByKode('111');
        $penjualan = $akunModel->getByKode('411');
        if (! $kas || ! $penjualan) {
            return;
        }

        $idJurnal = $jurnalModel->insert([
            'id_trans'   => $idTrans,
            'no_jurnal'  => $jurnalModel->generateNoJurnal(),
            'tanggal'    => date('Y-m-d'),
            'keterangan' => 'Transaksi Penjualan (' . $invoice . ')',
        ]);

        $detailJurnalModel->insertBatch([
            ['id_jurnal' => $idJurnal, 'id_akun' => $kas['id_akun'],       'debit' => $total, 'kredit' => 0],
            ['id_jurnal' => $idJurnal, 'id_akun' => $penjualan['id_akun'], 'debit' => 0,      'kredit' => $total],
        ]);
    }

    public function struk($idTrans)
    {
        $trx = $this->transaksiModel->find($idTrans);
        if (! $trx) {
            return redirect()->to('/transaksi')->with('error', 'Transaksi tidak ditemukan.');
        }
        return view('transaksi/struk', [
            'title'      => 'Struk ' . $trx['invoice'],
            'breadcrumb' => 'Operasional / Transaksi / Struk',
            'trx'        => $trx,
            'detail'     => $this->detailModel->byTransaksi($idTrans),
        ]);
    }
}
