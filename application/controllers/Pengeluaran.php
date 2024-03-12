<?php
class Pengeluaran extends CI_Controller{

	function __construct(){
		parent::__construct(); 
		$this->load->model('m_pengeluaran');
	} 
	function transaksi(){ 
		if ( $this->session->userdata('login') == 1) {
			$data['title'] = 'Pengeluaran';

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('pengeluaran/transaksi');
		    $this->load->view('v_template_admin/admin_footer');
 
		} 
		else{
			redirect(base_url('login')); 
		}
	}
	function transaksi_get(){

		$level = $this->session->userdata('level');
		$user = $this->session->userdata('id');

		if ($level == 1) {
			//admin
			$where = array('pengeluaran_hapus' => 0);
		}else{
			//user
			$where = array('pengeluaran_hapus' => 0, 'pengeluaran_user' => $user);
		}

	    $data = $this->m_pengeluaran->get_datatables($where);
		$total = $this->m_pengeluaran->count_all($where);
		$filter = $this->m_pengeluaran->count_filtered($where);

		$output = array(
			"draw" => $_GET['draw'],
			"recordsTotal" => $total,
			"recordsFiltered" => $filter,
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	} 
	function transaksi_add(){
		if ( $this->session->userdata('login') == 1) {
			$data['title'] = 'Pengeluaran';

			//generate nomor
			$get = $this->query_builder->count("SELECT * FROM t_pengeluaran");
			$data['nomor'] = 'PG-'.date('dmy').'-'.($get + 1);

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('pengeluaran/'.$this->ui->view('transaksi_add'));
		    $this->load->view('v_template_admin/admin_footer');

		} 
		else{
			redirect(base_url('login'));
		}
	}
	function transaksi_save(){

		$nomor = strip_tags($_POST['nomor']);
		$status = strip_tags($_POST['status']);

		//upload lampiran
		if (@$_FILES['lampiran']['name']) {
			
			//replace Karakter name foto
	        $filename = $_FILES['lampiran']['name'];

	        //replace name foto
	        $type = explode(".", $filename);
	        $no = count($type) - 1;
	        $new_name = md5($i.time()).'.'.$type[$no];

			//config uplod foto
			  $config = array(
			  'upload_path' 	=> './assets/lampiran',
			  'allowed_types' 	=> "gif|jpg|png|jpeg",
			  'overwrite' 		=> TRUE,
			  'file_name'       => $new_name,
			  );

			//upload foto
			$this->load->library('upload', $config);

			if ($this->upload->do_upload('lampiran')) {

				//sukses upload
			    $lampiran = $new_name;

			}else{

				//gagal upload
				$lampiran = '';
			}
			
		}else{

			//foto kosong
			$lampiran = '';
		}

		//pembelian
		$set1 = array(
						'pengeluaran_user' => $this->session->userdata('id'),
						'pengeluaran_nomor' => $nomor,
						'pengeluaran_jatuh_tempo' => strip_tags($_POST['jatuh_tempo']),
						'pengeluaran_keterangan' => strip_tags($_POST['keterangan']),
						'pengeluaran_lampiran' => $lampiran,
						'pengeluaran_ppn' => strip_tags($_POST['ppn']),
						'pengeluaran_qty' => strip_tags(str_replace(',', '', $_POST['qty_akhir'])),
						'pengeluaran_total' => strip_tags(str_replace(',', '', $_POST['total'])),
					);

		$save = $this->query_builder->add('t_pengeluaran',$set1);

		if ($save == 1) {
			
			$num = count($_POST['barang']);

			for ($i = 0; $i < $num; ++$i) {
				
				//barang
				$set2 = array(
								'pengeluaran_barang_nomor' => $nomor,
								'pengeluaran_barang_barang' => strip_tags($_POST['barang'][$i]),
								'pengeluaran_barang_harga' => strip_tags(str_replace(',', '', $_POST['harga'][$i])),
								'pengeluaran_barang_diskon' => strip_tags(str_replace(',', '', $_POST['diskon'][$i])),
								'pengeluaran_barang_qty' => strip_tags(str_replace(',', '', $_POST['qty'][$i])),
								'pengeluaran_barang_subtotal' => strip_tags(str_replace(',', '', $_POST['subtotal'][$i])),
							);

				$this->query_builder->add('t_pengeluaran_barang',$set2);	
			}

			$this->session->set_flashdata('success','Data berhasil di rubah');

		} else {

			$this->session->set_flashdata('gagal','Data gagal di rubah');
		}

		redirect(base_url('pengeluaran/transaksi'));
	}
	function transaksi_delete($id){

		$set = ['pengeluaran_hapus' => 1];
		$where = ['pengeluaran_id' => $id];
		$del = $this->query_builder->update('t_pengeluaran',$set,$where);
		if ($del == 1) {
			
			$this->session->set_flashdata('success','Data berhasil di rubah');

		} else {

			$this->session->set_flashdata('gagal','Data gagal di rubah');
		}

		redirect(base_url('pengeluaran/transaksi'));

	}
	function transaksi_print($id){
		$data['title'] = 'Pengeluaran';
		$data['data'] = $this->query_builder->view("SELECT * FROM t_pengeluaran as a JOIN t_pengeluaran_barang as b ON a.pengeluaran_nomor = b.pengeluaran_barang_nomor JOIN t_user as d ON a.pengeluaran_user = d.user_id WHERE a.pengeluaran_id = '$id'");
		$this->load->view('pengeluaran/transaksi_print',$data);
	}
	function transaksi_view($id){

		if ( $this->session->userdata('login') == 1) {

			$data['title'] = 'Pengeluaran';
			$data['view'] = '1';

			//data
			$data['data'] = $this->query_builder->view("SELECT * FROM t_pengeluaran as a JOIN t_pengeluaran_barang as b ON a.pengeluaran_nomor = b.pengeluaran_barang_nomor JOIN t_user as d ON a.pengeluaran_user = d.user_id WHERE a.pengeluaran_id = '$id'");

			
		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('pengeluaran/'.$this->ui->view('transaksi_add'));
		    $this->load->view('pengeluaran/transaksi_edit');
		    $this->load->view('v_template_admin/admin_footer');

		} 
		else{
			redirect(base_url('login'));
		}
	}
}