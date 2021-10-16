<?php 

class Laporan extends CI_Controller{

	function __construct(){
		parent::__construct();	
		$this->load->model('skpa_model');
		if(!$this->session->userdata('login')){
			redirect('');
		}
		$this->role = $this->session->userdata('user_data')['posisi'];
	}

    public function index(){
		if($this->role == 'Superadmin'){
			$data['list'] = $this->skpa_model->get_data();
			$this->template->load('layout/template','skpa/laporan/index', $data);
		}else{
			show_404();
		}
	}

	public function detail($id){
		$cek = $this->db->where('id', $id)->get('skpa');
		if($cek->num_rows() > 0){

			$cek_mhs = $this->db->where('skpa_id', $id)
								->join('skpa_gelombang_daftar', 'skpa_gelombang_daftar.skpa_gelombang_id = skpa_gelombang.id')
								->get('skpa_gelombang')->num_rows();

			if($cek_mhs > 0){
				$data['skpa']      = $cek->row_array();
				$data['gelombang'] = $this->skpa_model->get_gelombang($id);
				$data['mhs']  	   = $this->skpa_model->get_mahasiswa($id, true);
				$data['lulus'] 	   = $this->db->join('skpa_gelombang_daftar', 'skpa_gelombang_daftar.id = pengajuan_judul.skpa_gelombang_daftar_id')
											  ->join('skpa_gelombang', 'skpa_gelombang.id = skpa_gelombang_daftar.skpa_gelombang_id')
											  ->where('skpa_id', $id)
											  ->group_start()
												  ->where('is_acc_3', '1')
												  ->group_start()
												  		->where('is_revisi', '0')
												  		->or_where('is_revisi', '-1')
												  ->group_end()
											  ->group_end()
											  ->or_group_start()
											  	->where('is_acc_3', '1')
											  	->where('is_revisi', '1')
											  	->where('is_revisi_acc','1')
											  ->group_end()
											  ->get('pengajuan_judul')->num_rows();

				$data['per_gelombang'] = $this->db->select('*,
												COUNT(skpa_gelombang_daftar.id) AS num_mhs,
												SUM(CASE
													WHEN 
														(is_acc_3 = "1" AND is_revisi = "0") OR
														(is_acc_3 = "1" AND is_revisi = "1" AND is_revisi_acc = "1") THEN 1 ELSE 0
												END) AS num_lulus
											')
											  ->join('skpa_gelombang_daftar', 'skpa_gelombang_daftar.skpa_gelombang_id = skpa_gelombang.id', 'LEFT')
											  ->join('pengajuan_judul', 'pengajuan_judul.skpa_gelombang_daftar_id = skpa_gelombang_daftar.id', 'LEFT')

											  ->where('skpa_id', $id)
											  ->group_by('gelombang')
											  ->order_by('gelombang', 'ASC')
											  ->get('skpa_gelombang')->result_array();
				$this->template->load('layout/template','skpa/laporan/detail', $data);
			
			}else{
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Pendaftaran SK PA ini belum memiliki mahasiswa terdaftar','warning'));
				redirect('laporan');
			}

		}else{
			show_404();
		}
	}
}