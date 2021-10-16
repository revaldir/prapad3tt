<?php 

class Fakultas extends CI_Controller{

	function __construct(){
		parent::__construct();	
		$this->load->model('fakultas_model');
		$this->load->model('jurusan_model');

		if(!$this->session->userdata('login')){
			redirect('');
		}
	}

	public function index(){
		if($this->session->userdata('user_data')['posisi'] == 'Pemilik' ||
	       $this->session->userdata('user_data')['posisi'] == 'Superadmin'){

			$data['kode'] = $this->fakultas_model->generate_code();
			$data['list'] = $this->fakultas_model->get_data();
			$this->template->load('layout/template','master_data/fakultas/index', $data);
		}else{
			show_404();
		}
	}

	public function detail($id){
		if($this->session->userdata('user_data')['posisi'] == 'Pemilik' ||
	       $this->session->userdata('user_data')['posisi'] == 'Superadmin'){
			$cek = $this->fakultas_model->get_detail('id', $id);
			if($cek->num_rows() > 0){
				$data['fakultas'] = $cek->row_array();
				$data['list_jurusan'] = $this->fakultas_model->get_jurusan($id);
				$data['jurusan'] = $this->jurusan_model->get_unselected();
				$this->template->load('layout/template','master_data/fakultas/detail', $data);

			}else{
				redirect('master_data/fakultas');
			}
			
		}else{
			show_404();
		}
	}

	public function add(){
		$p = $this->input->post();

		$this->form_validation->set_data($p);
		$this->form_validation->set_rules('kode_fakultas', 'Kode fakultas', 'required');
		$this->form_validation->set_rules('nama_fakultas', 'Nama fakultas', 'required|is_unique[fakultas.nama_fakultas]');

		if($this->form_validation->run() == TRUE){

			if($this->fakultas_model->insert($p)){
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil dimasukkan','success'));
			}else{
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal dimasukkan','danger'));
			}

		}else{
			$this->session->set_flashdata('alert_message', show_alert(validation_errors(),'warning'));
		}

		redirect('master_data/fakultas/');
	}

	public function update(){
		$p  = $this->input->post();
		$id = $p['id_fakultas'];
		$s  = false;

		unset($p['id_fakultas']);

		$this->form_validation->set_data($p);
		$this->form_validation->set_rules('kode_fakultas', 'Kode fakultas', 'required');
		$this->form_validation->set_rules('nama_fakultas', 'Nama fakultas', 'required');

		$cek = $this->fakultas_model->get_detail('id', $id)->row_array();
		
		if($p['nama_fakultas'] == $cek['nama_fakultas']){
			$s = true;
		
		}else{
			$cek = $this->fakultas_model->get_detail('nama_fakultas', $p['nama_fakultas'])->num_rows();
			if($cek == 0){
				$s = true;
			}
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-warning"></i> Nama fakultas sudah ada','warning'));
		}

		if($s){
			if($this->form_validation->run() == TRUE){

				if($this->fakultas_model->update($p, $id)){
					$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil diubah','success'));
				}else{
					$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal diubah','danger'));
				}

			}else{
				$this->session->set_flashdata('alert_message', show_alert(validation_errors(),'warning'));
			}
		}

		redirect('master_data/fakultas/');
	}

	public function delete($id){

		if($this->fakultas_model->delete($id)){
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil dihapus','success'));
		}else{
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal dihapus','danger'));
		}

		redirect('master_data/fakultas/');
	}

	public function add_jurusan(){
		$p = $this->input->post();

		$this->form_validation->set_data($p);
		$this->form_validation->set_rules('jurusan_id', 'Jurusan', 'required');

		if($this->form_validation->run() == TRUE){

			if($this->fakultas_model->insert_jurusan($p)){
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil dimasukkan','success'));
			}else{
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal dimasukkan','danger'));
			}

		}else{
			$this->session->set_flashdata('alert_message', show_alert(validation_errors(),'warning'));
		}

		redirect('master_data/fakultas/detail/'.$p['fakultas_id']);
	}

	public function delete_jurusan($fakultas_id, $id){

		if($this->fakultas_model->delete_jurusan($id)){
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil dihapus','success'));
		}else{
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal dihapus','danger'));
		}

		redirect('master_data/fakultas/detail/'.$fakultas_id);
	}
    
}