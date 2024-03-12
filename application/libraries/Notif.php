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

      $arr = explode(',', $db['notif_tujuan']);

      if (@$db) {

        foreach ($arr as $v) {
            
          $apikey= $db['notif_api'];
          $tujuan= $v;
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

      }

      return;
    }

    function pembelian($nomor) {

      $cek = $this->cek();

      if ($cek['notif_pembelian'] == 'on') {
        
        $db = $this->url->db->query("SELECT * FROM t_pembelian as a JOIN t_pembelian_barang as b ON a.pembelian_nomor = b.pembelian_barang_nomor JOIN t_barang as c ON b.pembelian_barang_barang = c.barang_id WHERE a.pembelian_nomor = '$nomor'")->result_array();

        $faktur = $db[0]['pembelian_faktur'];
        $sales = $db[0]['pembelian_sales'];
        $pembayaran = $db[0]['pembelian_status'];
        $tanggal = date_format(date_create($db[0]['pembelian_tanggal']) ,'d/m/Y');
        $keterangan = $db[0]['pembelian_keterangan'];
        $total = $db[0]['pembelian_total'];

        $text = '';
        $text .= '-- Transaksi Pembelian --';
        $text .= '%0a%0a';
        $text .= '--------------------------';
        $text .= '%0a';
        $text .= 'Faktur : '.$faktur;
        $text .= '%0a';
        $text .= 'Sales : '.$sales;
        $text .= '%0a';
        $text .= 'Pembayaran : '.$pembayaran;
        $text .= '%0a';
        $text .= 'Tanggal : '.$tanggal;
        $text .= '%0a';
        $text .= 'Keterangan : '.$keterangan;
        $text .= '%0a';
        $text .= '--------------------------';
        $text .= '%0a';

        foreach ($db as $v) {
          
          $text .= '%0a';
          $text .= $v['pembelian_barang_qty'].' x ';
          $text .= $v['barang_nama'].' : '.number_format($v['pembelian_barang_subtotal']);

        }

        $text .= '%0a';
        $text .= '--------------------------';
        $text .= '%0a';
        $text .= 'PPN : '.$db[0]['pembelian_ppn'].'%';
        $text .= '%0a';
        $text .= 'Total : '.number_format($db[0]['pembelian_total']);

        $this->send($text);

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
    function vaksin($kandang, $ayam, $jadwal) {
      
      $cek = $this->cek();

      if ($cek['notif_vaksin'] == 'on') {

        //get database
        $db1 = $this->url->db->query("SELECT * FROM t_kandang WHERE kandang_id = '$kandang'")->row_array();
        $db2 = $this->url->db->query("SELECT * FROM t_barang WHERE barang_id = '$ayam'")->row_array();

        $transaksi = 'Pengingat Vaksin';
        $text_kandang = $db1['kandang_nama'];
        $text_ayam = $db2['barang_nama'];
        $text_jadwal = date_format(date_create($jadwal) ,'d/m/Y');

        $pesan = 'Transaksi : '.$transaksi.'%0a'.'Kandang : '.$text_kandang.'%0a'.'Jenis Ayam : '.$text_ayam.'%0a'.'Tanggal : '.$text_jadwal.'%0a';

        $this->send($pesan);

      }else{

        return;
      }

    }
    function recording($id) { 

      $cek = $this->cek();

      if ($cek['notif_recording'] == 'on') {
      
        //$db = $this->url->db->query("SELECT * FROM t_report AS a LEFT JOIN t_kandang AS b ON a.report_kandang = b.kandang_id WHERE a.report_id = '$id'")->row_array();

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
    function struk_pembelian($nomor) {
      
      $db1 = $this->url->db->query("SELECT * FROM t_pembelian as a JOIN t_pembelian_barang as b ON a.pembelian_nomor = b.pembelian_barang_nomor LEFT JOIN t_barang as c ON b.pembelian_barang_barang = c.barang_id LEFT JOIN t_kontak as d ON a.pembelian_kontak = d.kontak_id WHERE a.pembelian_nomor = '$nomor'")->result_array();

      $tanggal = date_format(date_create($db1[0]['pembelian_tanggal']), 'd/m/Y');

      $text = '';
      $text .= '-- Struk Pembelian --';
      $text .= '%0a%0a';
      $text .= 'Tanggal : '.$tanggal;
      $text .= '%0a';
      $text .= '--------------------------';

      foreach ($db1 as $v) {
          
        $text .= '%0a';
        $text .= $v['pembelian_barang_qty'].' x ';
        $text .= $v['barang_nama'].' : '.number_format($v['pembelian_barang_subtotal']);

      }

      $text .= '%0a';
      $text .= '--------------------------';
      $text .= '%0a';
      $text .= 'PPN : '.$db1[0]['pembelian_ppn'].'%';
      $text .= '%0a';
      $text .= 'Total : '.number_format($db1[0]['pembelian_total']);

      ///////////////////////// API WA ///////////////////////////////////

      $db2 = $this->url->db->query("SELECT * FROM t_notif")->row_array();

      $apikey= $db2['notif_api'];
      $tujuan= $db1[0]['kontak_tlp'];
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

  }

  function struk_penjualan($nomor) {
      
      $db1 = $this->url->db->query("SELECT * FROM t_penjualan as a JOIN t_penjualan_barang as b ON a.penjualan_nomor = b.penjualan_barang_nomor LEFT JOIN t_barang as c ON b.penjualan_barang_barang = c.barang_id LEFT JOIN t_kontak as d ON a.penjualan_kontak = d.kontak_id WHERE a.penjualan_nomor = '$nomor'")->result_array();

      $tanggal = date_format(date_create($db1[0]['penjualan_tanggal']), 'd/m/Y');

      $text = '';
      $text .= '-- Struk Penjualan --';
      $text .= '%0a%0a';
      $text .= 'Tanggal : '.$tanggal;
      $text .= '%0a';
      $text .= '--------------------------';

      foreach ($db1 as $v) {
          
        $text .= '%0a';
        $text .= $v['penjualan_barang_qty'].' x ';
        $text .= $v['barang_nama'].' : '.number_format($v['penjualan_barang_subtotal']);

      }

      $text .= '%0a';
      $text .= '--------------------------';
      $text .= '%0a';
      $text .= 'PPN : '.$db1[0]['penjualan_ppn'].'%';
      $text .= '%0a';
      $text .= 'Total : '.number_format($db1[0]['penjualan_total']);

      ///////////////////////// API WA ///////////////////////////////////

      $db2 = $this->url->db->query("SELECT * FROM t_notif")->row_array();

      $apikey= $db2['notif_api'];
      $tujuan= $db1[0]['kontak_tlp'];
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

  }
}