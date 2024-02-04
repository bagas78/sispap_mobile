<style type="text/css">
  .tit{
    background: black;
    color: white;
    padding: 0.5%;
  }
  .col-om{
    background: radial-gradient(#999999a1, #9999991f);
    padding: 1%;
  }
  .bg-card{
    background: #f4f4f4;
    margin-top: 10px;
    margin-right: 1px;
    margin-left: 1px;
    padding-bottom: 15px;
  }
</style> 

    <!-- Main content --> 
    <section class="content">
 
      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border">

          <br/>

          <div hidden align="left" id="back">
            <a href="<?= @$_SERVER['HTTP_REFERER'] ?>"><button type="button" class="btn bg-navy"><i class="fa fa-arrow-left"></i> Kembali</button></a>
          </div>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body" style="padding: 0;">
          
          <form method="POST" action="<?=base_url('recording/save')?>">
          
          <div class="row col-md-12">
            <div class="col-md-6">
              <div class="form-group">
                <label>Nomor</label>
                <input readonly id="nomor" type="text" name="nomor" class="form-control" value="<?=@$nomor?>">
              </div>
            </div>
             <div class="col-md-6">
              <div class="form-group">
                <label>Tanggal Recording</label>
                <input id="tanggal" type="date" name="tanggal" class="form-control" value="<?=date('Y-m-d')?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Kandang</label>
                <select id="kandang" class="form-control" required name="kandang">
                  <option value="" hidden>-- Pilih --</option>
                  <?php foreach ($kandang_data as $value): ?>
                    <option value="<?=@$value['kandang_id']?>"><?=@$value['kandang_nama']?></option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>
            <div class="col-md-6"> 
              <div class="form-group">
                <label>Populasi</label>
                <input id="populasi" readonly type="number" name="populasi" class="form-control" required value="0" min="0">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Rata-rata Bobot</label>
                <div class="input-group">
                  <input id="bobot" type="text" name="bobot" class="form-control" required>
                  <span class="input-group-addon">Kg</span>
                </div>
              </div>
            </div>
          </div>

          <div class="clearfix"></div><br/>

          <!-- ayam -->
           <div class="col-md-12">

              <h4 align="center" class="tit"><b>-- AYAM --</b></h4>

              <div class="row">

                <div class="col-xs-12 col-sm-12">
                  <button type="button" onclick="clone('ayam')" class="form-control add btn btn-success btn-sm"><i class="fa fa-plus"></i></button>
                </div>
                
              </div>

              <div id="paste_ayam"></div>

            </div>

          <div class="clearfix"></div><br/>
          <!-- end ayam -->


          <!-- afkir / mati -->
           <div class="col-md-12">

              <h4 align="center" class="tit"><b>-- AFKIR / MATI --</b></h4>

              <div class="row">

                <div class="col-xs-12 col-sm-12">
                  <button type="button" onclick="clone('afkir')" class="form-control add btn btn-success btn-sm"><i class="fa fa-plus"></i></button>
                </div>
                
              </div>

              <div id="paste_afkir"></div>
          
          </div>

          <div class="clearfix"></div><br/>
          <!-- end afkir / mati -->


          <!-- telur -->
           <div class="col-md-12">

              <h4 align="center" class="tit"><b>-- PANEN TELUR --</b></h4>

              <div class="row">

                <div class="col-xs-12 col-sm-12">
                  <button type="button" onclick="clone('telur')" class="form-control add btn btn-success btn-sm"><i class="fa fa-plus"></i></button>
                </div>
                
              </div>

              <div id="paste_telur"></div>
          
          </div>

          <div class="clearfix"></div><br/>
          <!-- end telur -->


          <!-- pakan -->
           <div class="col-md-12">

              <h4 align="center" class="tit"><b>-- PAKAN --</b></h4>

              <div class="row">

                <div class="col-xs-12 col-sm-12">
                  <button type="button" onclick="clone('pakan')" class="form-control add btn btn-success btn-sm"><i class="fa fa-plus"></i></button>
                </div>
                
              </div>

              <div id="paste_pakan"></div>
          
          </div>

          <div class="clearfix"></div><br/>
          <!-- end pakan -->

          <!-- premix -->
           <div class="col-md-12">

              <h4 align="center" class="tit"><b>-- PREMIX --</b></h4>

              <div class="row">

                <div class="col-xs-12 col-sm-12">
                  <button type="button" onclick="clone('premix')" class="form-control add btn btn-success btn-sm"><i class="fa fa-plus"></i></button>
                </div>
                
              </div>

              <div id="paste_premix"></div>
          
          </div>

          <div class="clearfix"></div><br/>
          <!-- end premix -->

          <div class="col-md-12" style="margin-bottom: 3%;">
            <div id="submit" class="col-md-12 row">
              <button type="submit" class="btn btn-primary">Simpan <i class="fa fa-check"></i></button>
              <a href="<?= @$_SERVER['HTTP_REFERER'] ?>"><button type="button" class="btn btn-danger">Batal <i class="fa fa-times"></i></button></a>
            </div>
          </div>

          </form>

        </div>

        
      </div>
      <!-- /.box -->


<div hidden>

  <!-- copy ayam -->
  <div class="row bg-card" id="copy_ayam">

    <div class="col-xs-12 col-sm-12"><br></div>

    <div class="col-xs-6 col-sm-6">
      <div class="form-group">
        <label>Ayam</label>
        <select id="ayam" class="form-control ayam" required name="ayam[]">
          <option value="" hidden>-- Pilih --</option>
          <?php foreach ($ayam_data as $value): ?>
            <option value="<?=@$value['barang_id']?>"><?=@$value['barang_nama']?></option>
          <?php endforeach ?>
        </select>
      </div>
    </div>
    <div class="col-xs-6 col-sm-6">
      <div class="form-group">
        <label>Berat Ayam</label>
        <div class="input-group">
          <input id="ayam_berat" type="number" name="ayam_berat[]" class="form-control ayam_berat" required value="0" min="0">
          <span class="input-group-addon">Kg
        </div>
      </div>
    </div>

    <div class="col-xs-6 col-sm-6">
      <div class="form-group">
        <label>Gejala Klinis</label>
        <input id="ayam_gejala" type="text" name="ayam_gejala[]" class="form-control ayam_gejala">
      </div>
    </div>
    <div class="col-xs-6 col-sm-6">
      <div class="form-group">
        <label>Pemberian Obat</label>
        <select id="ayam_obat" class="form-control ayam_obat" required name="ayam_obat[]">
          <option value="" hidden>-- Pilih --</option>
          <?php foreach ($obat_data as $value): ?>
            <option value="<?=@$value['barang_id']?>"><?=@$value['barang_nama']?></option>
          <?php endforeach ?>
        </select>
      </div>
    </div>

    <!-- hidden -->
    <input value="ayam" type="hidden" name="ayam_kategori[]" class="form-control ayam_kategori">

    <div class="col-xs-12 col-sm-12">
      <button type="button" class="form-control remove btn btn-danger btn-sm" onclick="$(this).closest('#copy_ayam').remove()"><i class="fa fa-minus"></i></button>
    </div>

  </div>
  <!-- copy ayam -->


  <!-- copy afkir / mati -->
  <div class="row bg-card" id="copy_afkir">

    <div class="col-xs-12 col-sm-12"><br></div>

    <div class="col-xs-6 col-sm-6">
      <div class="form-group">
        <label>Ayam</label>
        <select id="afkir" class="form-control afkir" required name="afkir[]">
          <option value="" hidden>-- Pilih --</option>
          <?php foreach ($afkir_data as $value): ?>
            <option value="<?=@$value['barang_id']?>"><?=@$value['barang_nama']?></option>
          <?php endforeach ?>
        </select>
      </div>
    </div>
    <div class="col-xs-6 col-sm-6">
      <div class="form-group">
        <label>Jumlah Ayam</label>
        <div class="input-group">
          <input id="afkir_jumlah" type="number" name="afkir_jumlah[]" class="form-control afkir_jumlah" required value="0" min="0">
          <span class="input-group-addon" id="afkir_satuan"></span>
        </div>
      </div>
    </div>

    <!-- hidden -->
    <input value="afkir" type="hidden" name="afkir_kategori[]" class="form-control afkir_kategori">

    <div class="col-xs-12 col-sm-12">
      <button type="button" class="form-control remove btn btn-danger btn-sm" onclick="$(this).closest('#copy_afkir').remove()"><i class="fa fa-minus"></i></button>
    </div>

  </div>
  <!-- copy afkir / mati -->

  <!-- copy telur -->
  <div class="row bg-card" id="copy_telur">

    <div class="col-xs-12 col-sm-12"><br></div>

    <div class="col-xs-6 col-sm-6">
      <div class="form-group">
        <label>Telur</label>
        <select id="telur" class="form-control telur" required name="telur[]">
          <option value="" hidden>-- Pilih --</option>
          <?php foreach ($telur_data as $value): ?>
            <option value="<?=@$value['barang_id']?>"><?=@$value['barang_nama']?></option>
          <?php endforeach ?>
        </select>
      </div>
    </div>
    <div class="col-xs-6 col-sm-6">
      <div class="form-group">
        <label>Jumlah Telur</label>
        <div class="input-group">
          <input id="telur_jumlah" type="number" name="telur_jumlah[]" class="form-control telur_jumlah" required value="0" min="0">
          <span class="input-group-addon" id="telur_satuan"></span>
        </div>
      </div>
    </div>

    <!-- hidden -->
    <input value="telur" type="hidden" name="telur_kategori[]" class="form-control telur_kategori">

    <div class="col-xs-12 col-sm-12">
      <button type="button" class="form-control remove btn btn-danger btn-sm" onclick="$(this).closest('#copy_telur').remove()"><i class="fa fa-minus"></i></button>
    </div>

  </div>
  <!-- copy telur -->

  <!-- copy pakan -->
  <div class="row bg-card" id="copy_pakan">

    <div class="col-xs-12 col-sm-12"><br></div>

    <div class="col-xs-6 col-sm-6">
      <div class="form-group">
        <label>Pakan</label>
        <select id="pakan" class="form-control pakan" required name="pakan[]">
          <option value="" hidden>-- Pilih --</option>
          <?php foreach ($pakan_data as $value): ?>
            <option value="<?=@$value['pakan_id']?>"><?=@$value['pakan_nama']?></option>
          <?php endforeach ?>
        </select>
      </div>
    </div>
    <div class="col-xs-6 col-sm-6">
      <div class="form-group">
        <label>Stok Pakan</label>
        <div class="input-group">
          <input id="pakan_stok" readonly type="number" name="pakan_stok[]" class="form-control pakan_stok" required value="0" min="0">
          <span class="input-group-addon pakan_satuan"></span>
        </div>
      </div>
    </div>
    <div class="col-xs-6 col-sm-6">
      <div class="form-group">
        <label>Jumlah Pakan</label>
        <div class="input-group">
          <input id="pakan_jumlah" type="number" name="pakan_jumlah[]" class="form-control pakan_jumlah" required value="0" min="0">
          <span class="input-group-addon pakan_satuan"></span>
        </div>
      </div>
    </div>

    <!-- hidden -->
    <input id="pakan_kategori" type="hidden" name="pakan_kategori[]" class="form-control pakan_kategori" value="pakan">

    <div class="col-xs-12 col-sm-12">
      <button type="button" class="form-control remove btn btn-danger btn-sm" onclick="$(this).closest('#copy_pakan').remove()"><i class="fa fa-minus"></i></button>
    </div>

  </div>
  <!-- copy pakan -->

  <!-- copy premix -->
  <div class="row bg-card" id="copy_premix">

    <div class="col-xs-12 col-sm-12"><br></div>

    <div class="col-xs-6 col-sm-6">
      <div class="form-group">
        <label>Premix</label>
        <select id="premix" class="form-control premix" required name="premix[]">
          <option value="" hidden>-- Pilih --</option>
          <?php foreach ($premix_data as $value): ?>
            <option value="<?=@$value['premix_id']?>"><?=@$value['premix_nama']?></option>
          <?php endforeach ?>
        </select>
      </div>
    </div>
    <div class="col-xs-6 col-sm-6">
      <div class="form-group">
        <label>Stok Premix</label>
        <div class="input-group">
          <input id="premix_stok" readonly value="0" min="0" type="number" name="premix_stok[]" class="form-control premix_stok" required>
          <span class="input-group-addon premix_satuan"></span>
        </div>
      </div>
    </div>
    <div class="col-xs-6 col-sm-6">
      <div class="form-group">
        <label>Jumlah Premix</label>
        <div class="input-group">
          <input id="premix_jumlah" value="0" min="0" type="number" name="premix_jumlah[]" class="form-control premix_jumlah" required>
          <span class="input-group-addon premix_satuan"></span>
        </div>
      </div>
    </div>

    <!-- hidden -->
    <input value="premix" type="hidden" name="premix_kategori[]" class="form-control premix_kategori">

    <div class="col-xs-12 col-sm-12">
      <button type="button" class="form-control remove btn btn-danger btn-sm" onclick="$(this).closest('#copy_premix').remove()"><i class="fa fa-minus"></i></button>
    </div>

  </div>
  <!-- copy premix -->

</div>


<script type="text/javascript">

$('form').submit( function(e){ 
    e.preventDefault();
    
    if ($('#populasi').val() == 0) {

      alert('Jumlah populasi 0 silahkan "tambah afkir" di menu "kode kandang" sub menu "kandang"');
    }else{

      $(this)[0].submit();
    }

});

//kandang
$(document).on('change', '#kandang', function() {

    var id = $(this).val();
    $.get('<?=base_url('recording/get_kandang/')?>'+id, function(data) {
      
      var val = $.parseJSON(data);

      $('#populasi').val(val.kandang_ayam);

    });

});

//stok pakan
$(document).on('change', '#pakan', function() {
    
  var nama = $(this).prop('name').replace("[]","");  
  var id = $(this).val();
  var stok = $(this).closest('.row').find('#'+nama+'_stok');
  var satuan = $(this).closest('.row').find('.'+nama+'_satuan');
  var jumlah = $(this).closest('.row').find('#'+nama+'_jumlah');
  var select = $(this).closest('.row').find('#'+nama);

  if (id != '') {

    //cek exist data
    var index = $(this).closest('.row').index();
    var arr = new Array();

    $.each($('.'+nama), function(idx, val) {
      
          var val = $(this).val();

          if (index != idx)
          arr.push(val);

      });

     if ($.inArray(id, arr) != -1) {

        warning('Pilihan sudah ada');

        //reset value
        satuan.text('');
        jumlah.val(0);
        stok.val(0);
        select.val('').change();
        
     }else{

        //get data
        $.get('<?=base_url('recording/get_pakan/')?>'+id, function(data) {
      
          var val = $.parseJSON(data);

          stok.val(val.pakan_stok);
          satuan.text(val.pakan_satuan);

        });
     }

  }

});

//stok premix
$(document).on('change', '#premix', function() {
    
  var nama = $(this).prop('name').replace("[]","");  
  var id = $(this).val();
  var stok = $(this).closest('.row').find('#'+nama+'_stok');
  var satuan = $(this).closest('.row').find('.'+nama+'_satuan');
  var jumlah = $(this).closest('.row').find('#'+nama+'_jumlah');
  var select = $(this).closest('.row').find('#'+nama);

  if (id != '') {

    //cek exist data
    var index = $(this).closest('.row').index();
    var arr = new Array();

    $.each($('.'+nama), function(idx, val) {
      
          var val = $(this).val();

          if (index != idx)
          arr.push(val);

      });

     if ($.inArray(id, arr) != -1) {

        warning('Pilihan sudah ada');

        //reset value
        satuan.text('');
        jumlah.val(0);
        stok.val(0);
        select.val('').change();
        
     }else{

        //get data
        $.get('<?=base_url('recording/get_premix/')?>'+id, function(data) {
      
          var val = $.parseJSON(data);

          stok.val(val.premix_stok);
          satuan.text(val.premix_satuan);

        });
     }

  }

});

//satuan afkir dan telur
$(document).on('change', '#afkir, #telur', function() {

  var id = $(this).val();
  var nama = $(this).prop('name').replace("[]", "");  
  var satuan = $(this).closest('.row').find('#'+nama+'_satuan');
  var select = $(this).closest('.row').find('#'+nama);
  var jumlah = $(this).closest('.row').find('#'+nama+'_jumlah');
  
  if (id != '') {

    //cek exist data
    var index = $(this).closest('.row').index();
    var arr = new Array();

    $.each($('.'+nama), function(idx, val) {
      
          var val = $(this).val();

          if (index != idx)
          arr.push(val);

      });

     if ($.inArray(id, arr) != -1) {

        warning('Pilihan sudah ada');

        //reset value
        satuan.text('');
        jumlah.val(0);
        select.val('').change();

     }else{

        //get data
        $.get('<?=base_url('recording/get_barang/')?>'+id, function(data) {
          
          var val = $.parseJSON(data);

          satuan.text(val.barang_satuan);

        });

     } 

  }

}); 

//copy paste
function clone(target){
  //paste
  $('#paste_'+target).prepend($('#copy_'+target).clone().removeAttr('hidden'));

  //reset value
  $('#copy_'+target).find('select').val('').change();
  $('#copy_'+target).find('input[type="number"]').val(0);
  $('#copy_'+target).find('#'+target+'_satuan').text('');

  $('#copy_'+target).find('#'+target+'_gejala').val('');
} 

//cek stok populasi
$(document).on('keyup | change', '.afkir_jumlah', function() {

  var afkir = 0;
  $.each($('.afkir_jumlah'), function(index, val) {
     
     afkir += parseInt($(this).val());

  });

  if (afkir > parseInt($('#populasi').val())) {

    warning('Jumlah melebihi populasi');

    //reset
    $(this).val(0);

  }

});

//cek stok pakan dan premix
$(document).on('keyup | change', '.pakan_jumlah, .premix_jumlah', function() {

  var nama = $(this).prop('name').replace("[]", "");
  var stok = $(this).closest('.row').find('#'+nama.replace('jumlah', 'stok'));

  var jum = 0;
  $.each($('.'+nama), function(index, val) {
     
     jum += parseInt($(this).val());

  });

  if (jum > parseInt(stok.val())) {

    warning('Jumlah melebihi stok');

    //reset
    $(this).val(0);

  }

});


//otomatis
// function auto(){

//   setTimeout(function() {
//       auto();
//   }, 100);
// }

//auto();

</script>