<script type="text/javascript">

//data	 
$('#nomor').val('<?=@$data['recording_nomor']?>');
$('#tanggal').val('<?=@$data['recording_tanggal']?>');
$('#kandang').val('<?=@$data['recording_kandang']?>');
$('#populasi').val('<?=@$data['recording_populasi']?>');
$('#mati').val('<?=@$data['recording_mati']?>');
$('#afkir').val('<?=@$data['recording_afkir']?>');
$('#bobot').val('<?=@$data['recording_bobot']?>');
$('#suhu').val('<?=@$data['recording_suhu']?>');
$('#kondisi').val('<?=@$data['recording_kondisi']?>');
$('form').attr('action', '<?=base_url('recording/update/'.@$data['recording_id'])?>');

//index loop 
<?php $d = 1;?>
<?php $a = 1;?> 
<?php $t = 1;?>

<?php foreach ($barang_data as $v): ?>

	//ayam 
	<?php if($v['recording_barang_kategori'] == 'ayam'): ?>

		<?php if($d - 0): ?>

			clone('ayam');

		<?php endif ?>

	<?php $d++ ?>

	<?php endif ?>

	//afkir 
	<?php if($v['recording_barang_kategori'] == 'afkir'): ?>

		<?php if($a - 0): ?>

			clone('afkir');

		<?php endif ?>

	<?php $a++ ?>

	<?php endif ?>

	//telur
	<?php if($v['recording_barang_kategori'] == 'telur'): ?>

		<?php if($t - 0): ?>

			clone('telur');

		<?php endif ?>

	<?php $t++ ?>

	<?php endif ?>

<?php endforeach ?>

//insert data
<?php $i_d = 0; ?>
<?php $i_a = 0; ?>
<?php $i_t = 0; ?>
<?php foreach(@$barang_data as  $key => $v): ?>

	//ayam
	<?php if($v['barang_kategori'] == 5): ?>
		
		$('.ayam:eq(<?=$i_d?>)').val('<?=$v['recording_barang_barang']?>').change();
		$('.ayam_berat:eq(<?=$i_d?>)').val('<?=$v['recording_barang_berat']?>');
		$('.ayam_gejala:eq(<?=$i_d?>)').val('<?=$v['recording_barang_gejala']?>');
		$('.ayam_obat:eq(<?=$i_d?>)').val('<?=$v['recording_barang_obat']?>').change();
		$('.ayam_obat_jumlah:eq(<?=$i_d?>)').val('<?=$v['recording_barang_obat_jumlah']?>');

		<?php $i_d++; ?>
	<?php endif ?>

	//afkir
	<?php if($v['barang_kategori'] == 2): ?>
		
		$('.afkir:eq(<?=$i_a?>)').val('<?=$v['recording_barang_barang']?>').change();
		$('.afkir_jumlah:eq(<?=$i_a?>)').val('<?=$v['recording_barang_jumlah']?>');

		<?php $i_a++; ?>
	<?php endif ?>

	//afkir
	<?php if($v['barang_kategori'] == 1): ?>
		
		$('.telur:eq(<?=$i_t?>)').val('<?=$v['recording_barang_barang']?>').change();
		$('.telur_jumlah:eq(<?=$i_t?>)').val('<?=$v['recording_barang_jumlah']?>');

		<?php $i_t++; ?>
	<?php endif ?>

<?php endforeach ?>

//pakan campur
<?php foreach ($barang_data_pakan as $v): ?>

	//pakan campur 
	clone('pakan');

<?php endforeach ?>

//insert campur
<?php $i_p = 0; ?>
<?php foreach(@$barang_data_pakan as  $key => $v): ?>

	//pakan
		
	$('.pakan:eq(<?=$i_p?>)').val('<?=$v['recording_barang_barang']?>').change();
	$('.pakan_jumlah:eq(<?=$i_p?>)').val('<?=$v['recording_barang_jumlah']?>');

	<?php $i_p++; ?>

<?php endforeach ?>

if (!'<?=@$edit?>') {

	//button
	$('#submit').remove();
	$('#back').removeAttr('hidden');
	
	//off click
	$('.form-group, table').css('pointer-events', 'none');
}

</script>