<style type="text/css">
/* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>

    <!-- Main content --> 
    <section class="content">

      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border">

          <div align="left"><br/></div>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
        
        <form method="POST" action="<?=base_url('wa/save')?>">

            <div class="form-group">
                <label>API KEY</label>
                <input type="text" name="api" class="form-control" required id="api">
            </div>

            <div class="form-group">
                <label>Tujuan</label>
                <input type="number" name="tujuan" class="form-control" required id="tujuan">
            </div>

            <table class="table table-responsive table-bordered">
                <thead>
                    <tr>
                        <th>Menu</th>
                        <th>ON / OFF</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>PEMBELIAN</td>
                        <td>
                            <label class="switch">
                              <input type="checkbox" name="pembelian" id="pembelian">
                              <span class="slider round"></span>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>PENJUALAN</td>
                        <td>
                           <label class="switch">
                              <input type="checkbox" name="penjualan" id="penjualan">
                              <span class="slider round"></span>
                            </label> 
                        </td>
                    </tr>
                    <tr>
                        <td>JADWAL VAKSINASI</td>
                        <td>
                           <label class="switch">
                              <input type="checkbox" name="vaksin" id="vaksin">
                              <span class="slider round"></span>
                            </label> 
                        </td>
                    </tr>
                    <tr>
                        <td>KONDISI KANDANG</td>
                        <td>
                           <label class="switch">
                              <input type="checkbox" name="kandang" id="kandang">
                              <span class="slider round"></span>
                            </label> 
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- hidden -->
            <input type="hidden" name="id" id="id">

            <div class="form-group">
                <button class="btn btn-success">SIMPAN <i class="fa fa-check"></i></button>
            </div>

        </form>

        </div>

        
      </div>
      <!-- /.box -->

<script type="text/javascript">

    //id
    $('#id').val('<?=@$data['notif_id']?>');
    
    
    //atribute
    $('#api').val('<?=@$data['notif_api']?>');
    $('#tujuan').val('<?=@$data['notif_tujuan']?>');

    if ('<?=@$data['notif_pembelian']?>' == 'on') {

        $('#pembelian').attr('checked', true);
    } 

    if ('<?=@$data['notif_penjualan']?>' == 'on') {

        $('#penjualan').attr('checked', true);
    } 

    if ('<?=@$data['notif_vaksin']?>' == 'on') {

        $('#vaksin').attr('checked', true);
    } 

    if ('<?=@$data['notif_kandang']?>' == 'on') {

        $('#kandang').attr('checked', true);
    } 

</script>