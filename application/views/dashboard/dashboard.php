<style type="text/css">
  .box-style{
    background: white;
    color: #999;
    border-width: 5px;
    border-style: solid;
    border-color: whitesmoke;
  }
  .box-style:hover{
    background: lightgrey;
  }
  .tit{
    max-width: fit-content; 
    background: black;
    padding: 0.5%;
    color: white; 
  } 
</style>
 
    <!-- Main content --> 
    <section class="content"> 
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
         <a href="<?=base_url('barang/telur')?>">
          <div class="small-box box-style" style="padding: 8px;">
            <div class="inner">
              <h3 style="font-size: 28px;"><?=@number_format($telur_)?></h3>
 
              <p>Total Telur</p>
            </div>
            <div class="icon" style="top: -20px;">
              <img width="80" height="80" src="<?=base_url('assets/gambar/telur.png')?>">
            </div>
          </div>
        </a>
        </div> 
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <a href="<?=base_url('barang/ayam')?>">
            <div class="small-box box-style" style="padding: 8px;">
              <div class="inner">
                <h3 style="font-size: 28px;"><?=@number_format($ayam_)?></h3>

                <p>Total Ayam</p>
              </div>
              <div class="icon" style="top: -20px;">
                <img width="80" height="80" src="<?=base_url('assets/gambar/chiken.png')?>">
              </div>
            </div>
          </a>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <a href="<?=base_url('barang/pakan')?>">
            <div class="small-box box-style" style="padding: 8px;">
              <div class="inner">
                <h3 style="font-size: 28px;"><?=@number_format($pakan_)?></h3>

                <p>Total Pakan</p>
              </div>
              <div class="icon" style="top: -20px">
                <img width="80" height="80" src="<?=base_url('assets/gambar/pakan.png')?>">
              </div>
            </div>
          </a>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <a href="<?=base_url('barang/obat')?>">
            <div class="small-box box-style" style="padding: 8px;">
              <div class="inner">
                <h3 style="font-size: 28px;"><?=@number_format($obat_)?></h3>

                <p>Total Obat</p>
              </div>
              <div class="icon" style="top: -20px;">
                <img width="80" height="80" src="<?=base_url('assets/gambar/obat.png')?>">
              </div>
            </div>
          </div>
        </a>
        <!-- ./col -->
      </div>

      <!-- grafik -->

      <div class="box">
        <div class="box-header with-border">

          <div class="col-md-1 col-xs-3">
            <form method="POST" action="">
              <input type="hidden" name="filter" value="1">
              <button type="submit" class="btn btn-default <?=(@$filter == 1)?'active':'' ?>">Harian <i class="fa fa-filter"></i></button>
            </form>
          </div>
          <div class="col-md-1 col-xs-3">
            <form method="POST" action="">
              <input type="hidden" name="filter" value="2">
              <button type="submit" class="btn btn-default <?=(@$filter == 2)?'active':'' ?>">Bulanan <i class="fa fa-filter"></i></button>
            </form>
          </div>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">

          <div id="chartContainer" style="height: 300px; width: 100%;"></div>

        </div>
      </div>

      <!-- end grafik -->

      <div class="box">
        <div class="box-header with-border">

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
      
          <h4 class="tit"><?=strtoupper('JADWAL VAKSINASI')?></h4>

        <!-- <a style="color: black;" href="<?=base_url('vaksin/ayam')?>"> -->
          <table class="example3 table table-bordered table-responssive display nowrap" style="width: 100%;">
            <thead>
              <tr>
                <th>Kandang</th>
                <th>Ayam</th>
                <th width="120">Tanggal</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; ?>
              <?php foreach ($vaksin_data as $vaksin): ?>

                <tr>
                  <td><?=@$vaksin['kandang_nama']?></td>
                  <td><?=@$vaksin['barang_nama']?></td>
                  <td class="bg-red"><?=date_format(date_create(@$vaksin['vaksin_tanggal']), 'd/m/Y');?></td>
                </tr>
              <?php $no++; ?>
              <?php endforeach ?>
            </tbody>
          </table>
        <!-- </a> -->

        </div>
        <!-- /.box-body -->
      </div>

      <div class="box">
        <div class="box-header with-border">

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
      
          <h4 class="tit"><?=strtoupper('PEFORMA KARYAWAN '.date('M Y'))?></h4>

          <table class="example3 table table-bordered table-responssive display nowrap" style="width: 100%;">
            <thead>
              <tr>
                <th width="100">Peringkat</th>
                <th>Nama</th>
                <th>Pekerjaan</th>
                <th>Masuk</th>
                <th>Tidak Masuk</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; ?>
              <?php foreach ($peforma as $value): ?>
                <tr>
                  <td><?=$no?></td>
                  <td><?=$value['nama']?></td>
                  <td><?=$value['pekerjaan']?></td>
                  <td><?=$value['masuk']?></td>
                  <td><?=$value['tidak']?></td>
                </tr>
              <?php $no++; ?>
              <?php endforeach ?>
            </tbody>
          </table>

        </div>
        <!-- /.box-body -->
      </div>

<script type="text/javascript">

  window.onload = function () {

  var options = {
    theme: "light2",
    exportEnabled: false,
    animationEnabled: true,
    title:{
      text: "Grafik Pembelian | Penjualan | Pengeluaran Tahun <?=date('Y')?>"
    },
    subtitles: [{
      text: ""
    }],
    axisX: {
      title: ""
    },
    axisY: {
      title: "",
      titleFontColor: "#4F81BC",
      lineColor: "#4F81BC",
      labelFontColor: "#4F81BC",
      tickColor: "#4F81BC"
    },
    axisY2: {
      title: "",
      titleFontColor: "#C0504E",
      lineColor: "#C0504E",
      labelFontColor: "#C0504E",
      tickColor: "#C0504E"
    },
    axisY3: {
      title: "",
      titleFontColor: "#C0504E",
      lineColor: "#C0504E",
      labelFontColor: "#C0504E",
      tickColor: "#C0504E"
    },
    toolTip: {
      shared: true
    },
    legend: {
      cursor: "pointer",
      itemclick: toggleDataSeries
    },
    data: [{
      type: "spline",
      name: "Pembelian",
      showInLegend: true,
      xValueFormatString: "<?=(@$filter == 1)?'DD MMMM YYYY':'MMMM YYYY' ?>",
      yValueFormatString: "Rp #,##0.#",
      dataPoints: [

        <?php foreach($pembelian_data as $p): ?>

          { x: new Date(<?=$p['tahun'].','.$p['bulan'].','.$p['tanggal']?>),  y: <?=$p['total']?> },

        <?php endforeach ?>
      
      ]
    },
    {
      type: "spline",
      name: "Penjualan",
      axisYType: "secondary",
      showInLegend: true,
      xValueFormatString: "<?=(@$filter == 1)?'DD MMMM YYYY':'MMMM YYYY' ?>",
      yValueFormatString: "Rp #,##0.#",
      dataPoints: [
        
        <?php foreach($penjualan_data as $p): ?>

          { x: new Date(<?=$p['tahun'].','.$p['bulan'].','.$p['tanggal']?>),  y: <?=$p['total']?> },

        <?php endforeach ?>

      ]
    },
    {
      type: "spline",
      name: "Pengeluaran",
      axisYType: "secondary",
      showInLegend: true,
      xValueFormatString: "<?=(@$filter == 1)?'DD MMMM YYYY':'MMMM YYYY' ?>",
      yValueFormatString: "Rp #,##0.#",
      dataPoints: [
        
        <?php foreach($pengeluaran_data as $p): ?>

          { x: new Date(<?=$p['tahun'].','.$p['bulan'].','.$p['tanggal']?>),  y: <?=$p['total']?> },

        <?php endforeach ?>

      ]
    }]
  };

  $("#chartContainer").CanvasJSChart(options);

  function toggleDataSeries(e) {
    if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
      e.dataSeries.visible = false;
    } else {
      e.dataSeries.visible = true;
    }
    e.chart.render();
  }

  }

</script>

<script src="https://cdn.canvasjs.com/jquery.canvasjs.min.js"></script></section>