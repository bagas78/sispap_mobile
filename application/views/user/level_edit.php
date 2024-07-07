<script type="text/javascript">

	$('form').attr('action', '<?=base_url('user/level_update/'.@$data['level_id'])?>');

	$('#nama').val('<?=@$data['level_nama']?>');
	$('#tampilan').val('<?=@$data['level_tampilan']?>').change();
	$('#whatsapp').val('<?=@$data['level_whatsapp']?>').change();
	$('#kontak').val('<?=@$data['level_kontak']?>').change();
	$('#vaksinasi').val('<?=@$data['level_vaksinasi']?>').change();
	$('#kandang').val('<?=@$data['level_kandang']?>').change();
	$('#satuan').val('<?=@$data['level_satuan']?>').change();
	$('#gudang').val('<?=@$data['level_gudang']?>').change();
	$('#produksi').val('<?=@$data['level_produksi']?>').change();
	$('#pembelian').val('<?=@$data['level_pembelian']?>').change();
	$('#pengeluaran').val('<?=@$data['level_pengeluaran']?>').change();
	$('#recording').val('<?=@$data['level_recording']?>').change();
	$('#penjualan').val('<?=@$data['level_penjualan']?>').change();
	$('#laporan').val('<?=@$data['level_laporan']?>').change();
	$('#absensi').val('<?=@$data['level_absensi']?>').change();
	$('#gaji').val('<?=@$data['level_gaji']?>').change();
</script>