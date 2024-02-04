
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
         
          <form class="bg-alice" action="<?=base_url('report/save')?>" method="POST" accept-charset="utf-8">
            
            <!--hidden-->
            <input type="hidden" name="jenis" value="<?=@$jenis?>">

            <div class="row">
              <div class="col-lg-6">

                <div class="form-group">
                  <label>Tanggal</label>
                  <input type="date" name="tanggal" class="tanggal form-control" required value="<?=date('Y-m-d')?>">
                </div>
                <div class="form-group">
                  <label>Kandang</label>
                  <select name="kandang" class="kandang form-control" required>
                    <option value="" hidden>-- Pilih --</option>
                    <?php foreach (@$kandang_data as $v): ?>
                      <option value="<?=$v['kandang_id']?>"><?=$v['kandang_nama']?></option>
                    <?php endforeach ?>
                  </select>
                </div>

              </div>

              <div class="col-lg-6">
              
                <div class="form-group">
                  <label>Kondisi Suhu</label>
                  <input type="text" name="kondisi_suhu" class="kondisi_suhu form-control" required>
                </div>
                <div class="form-group">
                  <label>Kondisi Kandang</label>
                  <input type="text" name="kondisi_kandang" class="kondisi_kandang form-control" required>
                </div>
                
              </div>

              <div class="col-lg-12">
              
                <div class="form-group">
                  <label>Catatan</label>
                  <textarea name="catatan" class="catatan form-control" required></textarea>
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