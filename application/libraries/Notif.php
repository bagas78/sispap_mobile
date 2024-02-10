<?php 

class Notif {
  protected $url;

  function __construct(){
        $this->url = &get_instance();
    }

    function cek(){

      $cek = $this->url->db->query("SELECT * FROM t_notif")->row_array();

      return $cek;
    }

    function send($text){

      $db = $this->url->db->query("SELECT * FROM t_notif")->row_array();

      if (@$db) {
        
        $apikey= $db['notif_api'];
        $tujuan= $db['notif_tujuan'];
        $pesan= $text;

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://starsender.online/api/sendText?message='.rawurlencode($pesan).'&tujuan='.rawurlencode($tujuan.'@s.whatsapp.net'),
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_HTTPHEADER => array(
            'apikey: '.$apikey
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

      }

      return;
    }

    function pembelian($nomor) {

      $cek = $this->cek();

      if ($cek['notif_pembelian'] == 'on') {
        
        $db = $this->url->db->query("SELECT * FROM t_pembelian WHERE pembelian_nomor = '$nomor'")->row_array();

        $transaksi = 'pembelian';
        $faktur = $db['pembelian_faktur'];
        $sales = $db['pembelian_sales'];
        $pembayaran = $db['pembelian_status'];
        $total = $db['pembelian_total'];
        $tanggal = date_format(date_create($db['pembelian_tanggal']) ,'d/m/Y');
        $keterangan = $db['pembelian_keterangan'];

        $pesan = 'Transaksi : '.$transaksi.'%0a'.'Faktur : '.$faktur.'%0a'.'Sales : '.$sales.'%0a'.'Pembayaran : '.$pembayaran.'%0a'.'Total : '.$total.'%0a'.'Tanggal : '.$tanggal.'%0a'.'keterangan : '.$keterangan;

        $this->send($pesan);

      }else{

        return;
      }

    }
    function penjualan($nomor) {

      $cek = $this->cek();

      if ($cek['notif_penjualan'] == 'on') {
      
        $db = $this->url->db->query("SELECT * FROM t_penjualan as a LEFT JOIN t_kontak as b ON a.penjualan_kontak = b.kontak_id WHERE a.penjualan_nomor = '$nomor'")->row_array();

        $transaksi = 'penjualan';
        $nomor = $db['penjualan_nomor'];
        $pelanggan = $db['kontak_nama'];
        $pembayaran = $db['penjualan_status'];
        $total = $db['penjualan_total'];
        $tanggal = date_format(date_create($db['penjualan_tanggal']) ,'d/m/Y');
        $keterangan = $db['penjualan_keterangan'];

        $pesan = 'Transaksi : '.$transaksi.'%0a'.'Nomor : '.$nomor.'%0a'.'Pelanggan : '.$pelanggan.'%0a'.'Pembayaran : '.$pembayaran.'%0a'.'Total : '.$total.'%0a'.'Tanggal : '.$tanggal.'%0a'.'Keterangan : '.$keterangan;

        $this->send($pesan);

      }else{

        return;
      }

    }
    function vaksin($id) {
      
      $cek = $this->cek();

      if ($cek['notif_vaksin'] == 'on') {

        $db = $this->url->db->query("SELECT * FROM t_vaksin AS a LEFT JOIN t_kandang AS b ON a.vaksin_kandang = b.kandang_id LEFT JOIN t_barang AS c ON a.vaksin_ayam = c.barang_id WHERE a.vaksin_status = 1 AND a.vaksin_id = '$id'")->row_array();

        $transaksi = 'vaksin';
        $kandang = $db['kandang_nama'];
        $ayam = $db['barang_nama'];
        $tanggal = date_format(date_create($db['penjualan_tanggal']) ,'d/m/Y');

        $pesan = 'Transaksi : '.$transaksi.'%0a'.'Kandang : '.$kandang.'%0a'.'Jenis Ayam : '.$ayam.'%0a'.'Tanggal : '.$tanggal.'%0a';

        $this->send($pesan);

      }else{

        return;
      }

    }
    function kandang($id) { 

      $cek = $this->cek();

      if ($cek['notif_kandang'] == 'on') {
      
        $db = $this->url->db->query("SELECT * FROM t_report AS a LEFT JOIN t_kandang AS b ON a.report_kandang = b.kandang_id WHERE a.report_id = '$id'")->row_array();

        $transaksi = 'kondisi kandang';
        $kandang = $db['kandang_nama'];
        $kondisi = $db['report_kondisi_kandang'];
        $suhu = $db['report_kondisi_suhu'];
        $tanggal = date_format(date_create($db['report_tanggal']) ,'d/m/Y');

        $pesan = 'Laporan '.$transaksi.'%0a'.'Kandang : '.$kandang.'%0a'.'Kondisi : '.$kondisi.'%0a'.'Suhu : '.$suhu.'%0a'.'Tanggal : '.$tanggal.'%0a';

        $this->send($pesan);

      }else{

        return;
      }

    }
}