
    <!-- Main content --> 
    <section class="content">

      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border">

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
         
          <form class="bg-alice" action="<?=base_url('user/level_save')?>" method="POST" accept-charset="utf-8">

            <div class="row">

              <div class="col-lg-12">
                
                <div class="form-group">
                  <label>Nama Level</label>
                  <input id="nama" type="text" name="nama" required class="form-control">
                </div>
                <div class="form-group">
                  <label>Tampilan</label>
                  <select id="tampilan" name="tampilan" required class="form-control">
                    <option value="" hidden>-- Pilih --</option>
                    <option value="desktop">Desktop</option>
                    <option value="tablet">Tablet</option>
                  </select>
                </div>

              </div>
              <div class="col-lg-6">

                <div class="form-group">
                  <label>Whatsapp</label>
                  <select id="whatsapp" name="whatsapp" required class="form-control">
                    <option value="" hidden>-- Pilih --</option>
                    <option value="1">Beri</option>
                    <option value="0">Tidak</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Kontak</label>
                  <select id="kontak" name="kontak" required class="form-control">
                    <option value="" hidden>-- Pilih --</option>
                    <option value="1">Beri</option>
                    <option value="0">Tidak</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Vaksinasi</label>
                  <select id="vaksinasi" name="vaksinasi" required class="form-control">
                    <option value="" hidden>-- Pilih --</option>
                    <option value="1">Beri</option>
                    <option value="0">Tidak</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Kandang</label>
                  <select id="kandang" name="kandang" required class="form-control">
                    <option value="" hidden>-- Pilih --</option>
                    <option value="1">Beri</option>
                    <option value="0">Tidak</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Satuan</label>
                  <select id="satuan" name="satuan" required class="form-control">
                    <option value="" hidden>-- Pilih --</option>
                    <option value="1">Beri</option>
                    <option value="0">Tidak</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Gudang</label>
                  <select id="gudang" name="gudang" required class="form-control">
                    <option value="" hidden>-- Pilih --</option>
                    <option value="1">Beri</option>
                    <option value="0">Tidak</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Produksi</label>
                  <select id="produksi" name="produksi" required class="form-control">
                    <option value="" hidden>-- Pilih --</option>
                    <option value="1">Beri</option>
                    <option value="0">Tidak</option>
                  </select>
                </div>

              </div>

              <div class="col-lg-6">
              
                <div class="form-group">
                  <label>Pembelian</label>
                  <select id="pembelian" name="pembelian" required class="form-control">
                    <option value="" hidden>-- Pilih --</option>
                    <option value="1">Beri</option>
                    <option value="0">Tidak</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Pengeluaran</label>
                  <select id="pengeluaran" name="pengeluaran" required class="form-control">
                    <option value="" hidden>-- Pilih --</option>
                    <option value="1">Beri</option>
                    <option value="0">Tidak</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Recording</label>
                  <select id="recording" name="recording" required class="form-control">
                    <option value="" hidden>-- Pilih --</option>
                    <option value="1">Beri</option>
                    <option value="0">Tidak</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Penjualan</label>
                  <select id="penjualan" name="penjualan" required class="form-control">
                    <option value="" hidden>-- Pilih --</option>
                    <option value="1">Beri</option>
                    <option value="0">Tidak</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Laporan</label>
                  <select id="laporan" name="laporan" required class="form-control">
                    <option value="" hidden>-- Pilih --</option>
                    <option value="1">Beri</option>
                    <option value="0">Tidak</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Absensi</label>
                  <select id="absensi" name="absensi" required class="form-control">
                    <option value="" hidden>-- Pilih --</option>
                    <option value="1">Beri</option>
                    <option value="0">Tidak</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Gaji</label>
                  <select id="gaji" name="gaji" required class="form-control">
                    <option value="" hidden>-- Pilih --</option>
                    <option value="1">Beri</option>
                    <option value="0">Tidak</option>
                  </select>
                </div>
                
              </div>
            </div>

            <br/>

            <button type="submit" class="btn btn-success">Simpan <i class="fa fa-check"></i></button>
            <a href="<?= @$_SERVER['HTTP_REFERER'] ?>"><button type="button" class="btn btn-danger">Batal <i class="fa fa-times"></i></button></a>

          </form>

        </div>

        
      </div>
      <!-- /.box -->