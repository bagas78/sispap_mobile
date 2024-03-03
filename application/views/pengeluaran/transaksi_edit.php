<script type="text/javascript">

<?php if(@$view == 1):?>
	$('.form-group, table').css('pointer-events', 'none');
	$('.back').removeAttr('hidden');
	$('.add').remove();
	$('.remove').remove();
	$('.save').remove();
<?php endif?> 

//form
$('.nomor').val('<?=@$data[0]['pengeluaran_nomor']?>');
$('.jatuh_tempo').val('<?=@$data[0]['pengeluaran_jatuh_tempo']?>');
$('.keterangan').val('<?=@$data[0]['pengeluaran_keterangan']?>');

$('#ppn').val('<?=@$data[0]['pengeluaran_ppn']?>');

//clone table
<?php $count = count(@$data) - 1; ?>
<?php for ($i = 0; $i < $count; $i++): ?>

	clone();

<?php endfor ?>

//insert table
<?php foreach(@$data as $key => $val): ?>

	$('.barang:eq(<?=$key?>)').val('<?=$val['pengeluaran_barang_barang']?>');
	$('.harga:eq(<?=$key?>)').val('<?=$val['pengeluaran_barang_harga']?>');
	$('.qty:eq(<?=$key?>)').val('<?=$val['pengeluaran_barang_qty']?>');
	$('.diskon:eq(<?=$key?>)').val('<?=$val['pengeluaran_barang_diskon']?>');

<?php endforeach ?>

</script>