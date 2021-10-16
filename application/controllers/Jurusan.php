<?php 

class Jurusan extends CI_Controller{

	function __construct(){
		parent::__construct();	
		$this->load->model('jurusan_model');

		if(!$this->session->userdata('login')){
			redirect('');
		}
	}

	public function index(){
		if($this->session->userdata('user_data')['posisi'] == 'Pemilik' ||
	       $this->session->userdata('user_data')['posisi'] == 'Superadmin'){

			$data['kode'] = $this->jurusan_model->generate_code();
			$data['list'] = $this->jurusan_model->get_data();
			$this->template->load('layout/template','master_data/jurusan/index', $data);
		}else{
			show_404();
		}
		
	}

	public function add(){
		$p = $this->input->post();

		$this->form_validation->set_data($p);
		$this->form_validation->set_rules('kode_jurusan', 'Kode jurusan', 'required');
		$this->form_validation->set_rules('nama_jurusan', 'Nama jurusan', 'required|is_unique[jurusan.nama_jurusan]');

		if($this->form_validation->run() == TRUE){

			if($this->jurusan_model->insert($p)){
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil dimasukkan','success'));
			}else{
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal dimasukkan','danger'));
			}

		}else{
			$this->session->set_flashdata('alert_message', show_alert(validation_errors(),'warning'));
		}

		redirect('master_data/jurusan/');
	}

	public function update(){
		$p  = $this->input->post();
		$id = $p['id_jurusan'];
		$s  = false;

		unset($p['id_jurusan']);

		$this->form_validation->set_data($p);
		$this->form_validation->set_rules('kode_jurusan', 'Kode jurusan', 'required');
		$this->form_validation->set_rules('nama_jurusan', 'Nama jurusan', 'required');

		$cek = $this->jurusan_model->get_detail('id', $id)->row_array();
		
		if($p['nama_jurusan'] == $cek['nama_jurusan']){
			$s = true;
		
		}else{
			$cek = $this->jurusan_model->get_detail('nama_jurusan', $p['nama_jurusan'])->num_rows();
			if($cek == 0){
				$s = true;
			}
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-warning"></i> Nama jurusan sudah ada','warning'));
		}

		if($s){
			if($this->form_validation->run() == TRUE){

				if($this->jurusan_model->update($p, $id)){
					$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil diubah','success'));
				}else{
					$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal diubah','danger'));
				}

			}else{
				$this->session->set_flashdata('alert_message', show_alert(validation_errors(),'warning'));
			}
		}

		redirect('master_data/jurusan/');
	}

	public function delete($id){

		if($this->jurusan_model->delete($id)){
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil dihapus','success'));
		}else{
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal dihapus','danger'));
		}

		redirect('master_data/jurusan/');
	}
    
}