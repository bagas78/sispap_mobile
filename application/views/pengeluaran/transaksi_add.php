<style type="text/css">
  .lm{
    background: #3c8dbc;
    padding: 0.5% 1% 0.5% 1%;
    border-radius: 5px;
    color: white;
  }
</style>

    <!-- Main content --> 
    <section class="content">

      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border">

          <div hidden align="left" class="back">
            <a href="<?= @$_SERVER['HTTP_REFERER'] ?>"><button type="button" class="btn bg-navy"><i class="fa fa-arrow-left"></i> Kembali</button></a>
          </div>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>  
        </div>
        <div class="box-body">
          
          <form action="<?=base_url('pengeluaran/transaksi_save');?>" method="post" enctype="multipart/form-data">
              
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Nomor</label>
                  <input type="text" required readonly="" name="nomor" class="nomor form-control" value="<?=@$nomor?>">
                </div>
                <div class="form-group">
                  <label>Jatuh Tempo</label>
                  <input type="date" required name="jatuh_tempo" class="jatuh_tempo form-control" value="<?=date('Y-m-d')?>">
                </div>                
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Lampiran</label>
                  <input type="file" name="lampiran" class="lampiran form-control" value="">
                </div>   
                <div class="form-group">
                  <label>Keterangan</label>
                  <textarea name="keterangan" class="keterangan form-control"></textarea>
                </div>
              </div>

              <div class="col-md-12">
                <table class="table table-borderless">
                  <thead>
                    <tr>
                      <th width="250">Barang</th>
                      <th width="150">Harga</th>
                      <th width="150">Qty</th>
                      <th width="150">Diskon (%)</th>
                      <th width="150">Subtotal</th>
                      <th width="1"><button type="button" onclick="clone()" class="add btn btn-success btn-sm"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>
                  <tbody id="paste">
                    <tr id="copy">
                      <td>
                        <input required type="text" name="barang[]" class="form-control barang" placeholder="Nama Barang">
                      </td>
                      <td>
                        <input type="number" name="harga[]" class="harga form-control" required min="1" value="0" step="0.01">
                      </td>
                      <td>
                        <input type="number" name="qty[]" class="qty form-control" required min="1" value="0" step="0.01">
                      </td>
                      <td>
                        <input type="number" name="diskon[]" class="diskon form-control" required min="0" value="0" step="0.01">
                      </td>
                      <td>
                        <input type="text" name="subtotal[]" class="subtotal form-control" required min="1" value="0" readonly="">
                      </td>
                      <td>
                        <button type="button" class="remove btn btn-danger btn-sm" onclick="$(this).closest('tr').remove()"><i class="fa fa-minus"></i></button>
                      </td>
                    </tr>
                    
                    <tr>
                      <td colspan="3"></td>
                      <td align="right">Qty Akhir</td>
                      <td><input id="qty" readonly="" type="text" name="qty_akhir" class="form-control" value="0" min="0" step="0.01"></td>
                    </tr>

                    <tr>
                      <td colspan="3"></td>
                      <td align="right">PPN</td>
                      <td>
                        <div class="input-group">
                          <input id="ppn"  type="text" name="ppn" class="form-control" required min="0" value="0">
                          <span class="input-group-addon">%</span>
                        </div>
                      </td>
                    </tr> 

                    <tr>
                      <td colspan="3"></td>
                      <td align="right">Total Akhir</td>
                      <td><input id="total" readonly="" type="text" name="total" class="form-control" value="0" min="0"></td>
                    </tr>

                    <tr class="save">
                      <td colspan="5" align="right">
                        <button type="submit" class="btn btn-primary">Simpan <i class="fa fa-check"></i></button>
                        <a href="<?= @$_SERVER['HTTP_REFERER'] ?>"><button type="button" class="btn btn-danger">Batal <i class="fa fa-times"></i></button></a>
                      </td>
                    </tr>

                  </tbody>
                </table>
              </div>

            </div>

          </form>          

        </div>
      </div>
      <!-- /.box -->

<script type="text/javascript">

  //copy paste
  function clone(){
    //paste
    $('#paste').prepend($('#copy').clone());

    //reset value
    $('#copy').find('select').val('').change();
    $('#copy').find('input').val(0);
  }

  function auto(){

    //subtotal
    var harga = 0;
    var qty = 0;
    var total = 0;
    $.each($('.harga'), function(index, val) {

      var h = Number($(this).val());
      var q = Number($(this).closest('tr').find('.qty').val());
      var d = Number($(this).closest('tr').find('.diskon').val());
      var s = Number($(this).closest('tr').find('.subtotal').val().replace(/,/g, ''));

      harga += h;
      qty += q;
      total += s;

      //subtotal
      var sub = (h * q) - ((h * q) * d / 100);
      $(this).closest('tr').find('.subtotal').val(number_format(sub));

    });

    //qty akhir
    $('#qty').val(qty);

    //ppn
    var ppn = Number($('#ppn').val()) * Number(total) / 100;
    var final = Number(ppn) + Number(total); 

    //total akhir
    $('#total').val(number_format(final));

    //border none
    $('td').css('border-top', 'none');

    setTimeout(function() {
        auto();
    }, 100);
  }

  auto();

</script>
