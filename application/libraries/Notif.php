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
      
        $db = $this->url->db->query("SELECT * FROM t_penjualan as a JOIN t_penjualan_barang as b ON a.penjualan_nomor = b.penjualan_barang_nomor LEFT JOIN t_barang as c ON b.penjualan_barang_barang = c.barang_id LEFT JOIN t_kontak as d ON a.penjualan_kontak = d.kontak_id WHERE a.penjualan_nomor = '$nomor'")->result_array();

        $nomor = $db[0]['penjualan_nomor'];
        $kontak = $db[0]['kontak_nama'];
        $pembayaran = $db[0]['penjualan_status'];
        $tanggal = date_format(date_create($db[0]['penjualan_tanggal']) ,'d/m/Y');
        $keterangan = $db[0]['penjualan_keterangan'];
        $total = $db[0]['penjualan_total'];

        $text = '';
        $text .= '-- Transaksi Penjualan --';
        $text .= '%0a%0a';
        $text .= '--------------------------';
        $text .= '%0a';
        $text .= 'Nomor : '.$nomor;
        $text .= '%0a';
        $text .= 'Pelanggan : '.$kontak;
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
          
          $text .= $v['penjualan_barang_qty'].' x ';
          $text .= $v['barang_nama'].' : '.number_format($v['penjualan_barang_subtotal']);

        }

        $text .= '%0a';
        $text .= '--------------------------';
        $text .= '%0a';
        $text .= 'PPN : '.$db[0]['penjualan_ppn'].'%';
        $text .= '%0a';
        $text .= 'Total : '.number_format($db[0]['penjualan_total']);

        $this->send($text);

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
    function recording($nomor) { 

      $cek = $this->cek();

      if ($cek['notif_recording'] == 'on') {
      
        $db1 = $this->url->db->query("SELECT * FROM t_recording AS a JOIN t_recording_barang AS b ON a.recording_nomor = b.recording_barang_nomor LEFT JOIN t_kandang AS c ON a.recording_kandang = c.kandang_id LEFT JOIN t_barang AS d ON b.recording_barang_barang = d.barang_id WHERE a.recording_hapus = 0 AND a.recording_nomor = '$nomor'")->result_array();

        $kandang = $db1[0]['kandang_nama'];
        $kondisi = $db1[0]['recording_kondisi'];
        $suhu = $db1[0]['recording_suhu'];
        $populasi = $db1[0]['recording_populasi'];
        $bobot = $db1[0]['recording_bobot'];
        $tanggal = date_format(date_create($db1[0]['recording_tanggal']) ,'d/m/Y');

        $text = '';
        $text .= '-- Recording Kandang --';
        $text .= '%0a%0a';
        $text .= '--------------------------';
        $text .= '%0a';
        $text .= 'Tanggal : '.$tanggal;
        $text .= '%0a';
        $text .= 'Kandang : '.$kandang;
        $text .= '%0a';
        $text .= 'Populasi : '.$populasi.' Ayam';
        $text .= '%0a';
        $text .= 'Rata-rata bobot : '.$bobot.' Kg';
        $text .= '%0a';
        $text .= 'Suhu : '.$suhu;
        $text .= '%0a';
        $text .= 'Kondisi kandang : '.$kondisi;
        $text .= '%0a';
        $text .= '--------------------------';
        $text .= '%0a';

        //ayam
        $text .= '( Ayam )';
        $text .= '%0a';
        foreach ($db1 as $v) {
          if ($v['recording_barang_kategori'] == 'ayam') {
            
            $obat = $v['recording_barang_obat'];
            $b = $this->url->db->query("SELECT * FROM t_barang WHERE barang_id = '$obat'")->row_array();

            $text .= $v['barang_nama'].' - '.$v['recording_barang_berat'].'Kg - '.$v['recording_barang_gejala'].' - '.$v['recording_barang_obat_jumlah'].'x '.$b['barang_nama'];
            $text .= '%0a';
          }
        }

        $text .= '--------------------------';
        $text .= '%0a';

        //ayam
        $text .= '( Afkir / Mati )';
        $text .= '%0a';
        foreach ($db1 as $v) {
          if ($v['recording_barang_kategori'] == 'afkir') {

            $text .= $v['recording_barang_jumlah'].'x'.' '.$v['barang_nama'];
            $text .= '%0a';
          }
        }

        $text .= '--------------------------';
        $text .= '%0a';

        //ayam
        $text .= '( Panen Telur )';
        $text .= '%0a';
        foreach ($db1 as $v) {
          if ($v['recording_barang_kategori'] == 'telur') {

            $text .= $v['recording_barang_jumlah'].'x'.' '.$v['barang_nama'];
            $text .= '%0a';
          }
        }

        $text .= '--------------------------';
        $text .= '%0a';

        //ayam
        $text .= '( Pakan )';
        $text .= '%0a';
        foreach ($db1 as $v) {
          if ($v['recording_barang_kategori'] == 'pakan') {

            $pakan = $v['recording_barang_barang'];
            $p = $this->url->db->query("SELECT * FROM t_pakan WHERE pakan_id = '$pakan'")->row_array();

            $text .= $v['recording_barang_jumlah'].'x'.' '.$p['pakan_nama'];
            $text .= '%0a';
          }
        }
        $text .= '--------------------------';

        $this->send($text);

      }else{

        return;
      }

    }
    function print($nomor, $jenis){

      if ($jenis == 'pembelian') {
        
        $db1 = $this->url->db->query("SELECT * FROM t_pembelian as a JOIN t_kontak as b ON a.pembelian_kontak = b.kontak_id WHERE a.pembelian_nomor = '$nomor'")->row_array();
        $id = $db1['pembelian_id'];

        // pembelian
        $text = '';
        $text .= 'Silahkan buka, untuk melihat struk '.$jenis.' : ';
        $text .= base_url('pembelian/transaksi_print/'.$id);

      }else{

        $db1 = $this->url->db->query("SELECT * FROM t_penjualan as a JOIN t_kontak as b ON a.penjualan_kontak = b.kontak_id WHERE a.penjualan_nomor = '$nomor'")->row_array();
        $id = $db1['penjualan_id'];

        //penjualan
        $text = '';
        $text .= 'Silahkan buka, untuk melihat struk '.$jenis.' : ';
        $text .= base_url('penjualan/transaksi_print/'.$id);
      }

      $db2 = $this->url->db->query("SELECT * FROM t_notif")->row_array();

      $apikey= $db2['notif_api'];
      $tujuan= $db1['kontak_tlp'];
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