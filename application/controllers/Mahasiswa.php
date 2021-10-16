<?php 

class Mahasiswa extends CI_Controller{

	function __construct(){
		parent::__construct();	
		$this->load->model('mahasiswa_model');
		$this->load->model('angkatan_model');
		$this->load->model('jurusan_model');
		$this->load->model('dosen_model');
		if(!$this->session->userdata('login')){
			redirect('');
		}
	}

	public function index(){
		$role = $this->session->userdata('user_data')['posisi'];
		if($role == 'Superadmin' || $role == 'Kasir'){
			$data['angkatan']  = $this->angkatan_model->get_data();
			$data['jurusan']   = $this->jurusan_model->get_data();
			$data['list']      = $this->mahasiswa_model->get_data();
			$this->template->load('layout/template','master_data/user/mahasiswa', $data);

		}else{
			show_404();
		}	
	}

	public function add(){
		$p = $this->input->post();

		$this->form_validation->set_rules('nim', 'NIM', 'required|is_unique[mahasiswa.nim]');
		$this->form_validation->set_rules('nama_mahasiswa', 'Nama Mahasiswa', 'required');
		$this->form_validation->set_rules('angkatan_id', 'Angkatan', 'required');
		$this->form_validation->set_rules('kelas_id', 'Kelas', 'required');
		$this->form_validation->set_rules('jurusan_id', 'Jurusan', 'required');
	
		if($this->form_validation->run() == TRUE){

			if($this->mahasiswa_model->insert($p)){
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil dimasukkan','success'));
			}else{
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal dimasukkan','danger'));
			}

		}else{
			$this->session->set_flashdata('alert_message', show_alert(validation_errors(),'warning'));
		}

		redirect('master_data/mahasiswa');
	}

	public function update(){
		$p  = $this->input->post();
		$id = $p['id_mahasiswa'];
		unset($p['id_mahasiswa']);

		$this->form_validation->set_data($p);
		$this->form_validation->set_rules('nim', 'NIM', 'required');
		$this->form_validation->set_rules('nama_mahasiswa', 'Nama Mahasiswa', 'required');
		$this->form_validation->set_rules('angkatan_id', 'Angkatan', 'required');
		$this->form_validation->set_rules('kelas_id', 'Kelas', 'required');
		$this->form_validation->set_rules('jurusan_id', 'Jurusan', 'required');

		if($this->form_validation->run() == TRUE){

			$cek = $this->mahasiswa_model->get_detail('mahasiswa.id', $id)->row_array();
			$list_cek = ['nim'];

			foreach ($list_cek as $row) {
				if($p[$row] == $cek[$row]){
					$s = true;
				
				}else{
					$cek = $this->mahasiswa_model->get_detail($row, $p[$row])->num_rows();
					if($cek == 0){
						$s = true;
					}else{
						$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-warning"></i> '.$row.' sudah ada','warning'));
						break;
					}
				}
			}
			
			if($s){
				if($this->mahasiswa_model->update($p, $id)){
					$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil diubah','success'));
				}else{
					$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal diubah','danger'));
				}
			}
			

		}else{
			$this->session->set_flashdata('alert_message', show_alert(validation_errors(),'warning'));
		}

		redirect('master_data/mahasiswa');
	}

	public function delete($id){

		if($this->mahasiswa_model->delete($id)){
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil dihapus','success'));
		}else{
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal dihapus','danger'));
		}

		redirect('master_data/mahasiswa');
	}
    
    public function detail($id){
		if($this->session->userdata('user_data')['posisi'] == 'Pemilik' ||
	       $this->session->userdata('user_data')['posisi'] == 'Superadmin'){
			$cek = $this->mahasiswa_model->get_detail('mahasiswa.id', $id);
			if($cek->num_rows() > 0){
				$data['mahasiswa'] = $cek->row_array();
				$data['dosen']	   = $this->dosen_model->get_data('kode_dosen', 'ASC');
				$this->template->load('layout/template','master_data/user/mahasiswa_detail', $data);

			}else{
				redirect('master_data/fakultas');
			}
			
		}else{
			show_404();
		}
	}
}