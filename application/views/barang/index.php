
    <!-- Main content --> 
    <section class="content">

      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border"> 
 
            <div align="left">
              <a href="<?= base_url('barang/'.@$kategori.'_add/'.@$kategori) ?>"><button class="add btn btn-primary"><i class="fa fa-plus"></i> Tambah</button></a>
            </div>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          
          <table id="example" class="table table-bordered table-hover display nowrap" style="width: 100%;">
            <thead>
            <tr>
              <th>Kode</th>
              <th>Nama</th> 
              <th>Stok</th>
              <th>Satuan</th>
              <th width="40" class="action">Action</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
          </table>

        </div>

        
      </div>
      <!-- /.box -->

<script type="text/javascript">
    var table;
    $(document).ready(function() {

        //datatables
        table = $('#example').DataTable({ 

            "responsive"  : true,
            "scrollX"     : true,
            "processing"  : true, 
            "serverSide"  : true,
            "order"       :[],  
            
            "ajax": {
                "url": "<?= base_url('barang/get_data/'.@$kategori_id); ?>",
                "type": "GET"
            },
            "columns": [                               
                        { "data": "barang_kode"},
                        { "data": "barang_nama"},
                        { "data": "barang_stok"},
                        { "data": "satuan_singkatan"},
                        { "data": "barang_id",
                        "render": 
                        function( data ) {
                            return "<a href='<?php echo base_url('barang/'.@$kategori.'_edit/')?>"+data+"'><button class='btn btn-xs btn-primary'><i class='fa fa-edit'></i></button></a> "+
                            "<button onclick=del('<?php echo base_url('barang/delete/')?>"+data+"/<?=@$kategori?>') class='btn_delete btn btn-xs btn-danger'><i class='fa fa-trash'></i></button>";
                          }
                        },
                        
                    ],
        });

    });


//otomatis
function remove_x(){

  if (<?=@$kategori_id?> == 6) {

    $('.btn_delete').remove();
    $('.add').remove();
  }

  setTimeout(function() {
      remove_x();
  }, 100);
}

remove_x();

</script>