<?php 

class Dosen extends CI_Controller{

	function __construct(){
		parent::__construct();	
		$this->load->model('dosen_model');

		if(!$this->session->userdata('login')){
			redirect('');
		}
	}

	public function index(){
		$role = $this->session->userdata('user_data')['posisi'];
		if($role == 'Superadmin' || $role == 'Kasir'){
			$data['list']      = $this->dosen_model->get_data();
			$this->template->load('layout/template','master_data/user/dosen', $data);

		}else{
			show_404();
		}
		
	}

	public function add(){
		$p = $this->input->post();

		$this->form_validation->set_rules('nip', 'NIP', 'required|is_unique[dosen.nip]');
		$this->form_validation->set_rules('kode_dosen', 'Kode Dosen', 'required|is_unique[dosen.kode_dosen]');
		$this->form_validation->set_rules('nama_dosen', 'Nama Dosen', 'required');
	
		if($this->form_validation->run() == TRUE){

			if($this->dosen_model->insert($p)){
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil dimasukkan','success'));
			}else{
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal dimasukkan','danger'));
			}

		}else{
			$this->session->set_flashdata('alert_message', show_alert(validation_errors(),'warning'));
		}

		redirect('master_data/dosen');
	}

	public function update(){
		$p  = $this->input->post();
		$id = $p['id_dosen'];
		unset($p['id_dosen']);

		$this->form_validation->set_data($p);
		$this->form_validation->set_rules('nip', 'NIP', 'required');
		$this->form_validation->set_rules('kode_dosen', 'Kode Dosen', 'required');
		$this->form_validation->set_rules('nama_dosen', 'Nama Dosen', 'required');

		if($this->form_validation->run() == TRUE){

			$cek = $this->dosen_model->get_detail('id', $id)->row_array();
			$list_cek = ['kode_dosen','nip'];

			foreach ($list_cek as $row) {
				if($p[$row] == $cek[$row]){
					$s = true;
				
				}else{
					$cek = $this->dosen_model->get_detail($row, $p[$row])->num_rows();
					if($cek == 0){
						$s = true;
					}else{
						$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-warning"></i> '.$row.' sudah ada','warning'));
						$s = false;
						break;
					}
				}
			}
			
			if($s){
				if($this->dosen_model->update($p, $id)){
					$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil diubah','success'));
				}else{
					$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal diubah','danger'));
				}
			}
			

		}else{
			$this->session->set_flashdata('alert_message', show_alert(validation_errors(),'warning'));
		}

		redirect('master_data/dosen');
	}

	public function delete($id){

		if($this->dosen_model->delete($id)){
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil dihapus','success'));
		}else{
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal dihapus','danger'));
		}

		redirect('master_data/dosen');
	}
    
}