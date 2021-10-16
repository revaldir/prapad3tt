<?php 

class Angkatan extends CI_Controller{

	function __construct(){
		parent::__construct();	
		$this->load->model('angkatan_model');

		$this->role = $this->session->userdata('user_data')['posisi'];
		if(!$this->session->userdata('login') && $this->role != 'Superadmin'){
			redirect('');
		}
	}

	public function index(){
		if($this->session->userdata('user_data')['posisi'] == 'Pemilik' ||
	       $this->session->userdata('user_data')['posisi'] == 'Superadmin'){

			$data['kode'] = $this->angkatan_model->generate_code();
			$data['list'] = $this->angkatan_model->get_data();
			$this->template->load('layout/template','master_data/angkatan/index', $data);
		}else{
			show_404();
		}
		
	}

	public function add(){
		$p = $this->input->post();

		$this->form_validation->set_data($p);
		$this->form_validation->set_rules('kode_angkatan', 'Kode Angkatan', 'required');
		$this->form_validation->set_rules('nama_angkatan', 'Nama Angkatan', 'required|is_unique[angkatan.nama_angkatan]');

		if($this->form_validation->run() == TRUE){

			if($this->angkatan_model->insert($p)){
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil dimasukkan','success'));
			}else{
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal dimasukkan','danger'));
			}

		}else{
			$this->session->set_flashdata('alert_message', show_alert(validation_errors(),'warning'));
		}

		redirect('master_data/angkatan/');
	}

	public function update(){
		$p  = $this->input->post();
		$id = $p['id_angkatan'];
		$s  = false;

		unset($p['id_angkatan']);

		$this->form_validation->set_data($p);
		$this->form_validation->set_rules('kode_angkatan', 'Kode Angkatan', 'required');
		$this->form_validation->set_rules('nama_angkatan', 'Nama Angkatan', 'required');

		$cek = $this->angkatan_model->get_detail('id', $id)->row_array();
		
		if($p['nama_angkatan'] == $cek['nama_angkatan']){
			$s = true;
		
		}else{
			$cek = $this->angkatan_model->get_detail('nama_angkatan', $p['nama_angkatan'])->num_rows();
			if($cek == 0){
				$s = true;
			}
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-warning"></i> Nama angkatan sudah ada','warning'));
		}

		if($s){
			if($this->form_validation->run() == TRUE){

				if($this->angkatan_model->update($p, $id)){
					$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil diubah','success'));
				}else{
					$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal diubah','danger'));
				}

			}else{
				$this->session->set_flashdata('alert_message', show_alert(validation_errors(),'warning'));
			}
		}

		redirect('master_data/angkatan/');
	}

	public function delete($id){

		if($this->angkatan_model->delete($id)){
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil dihapus','success'));
		}else{
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal dihapus','danger'));
		}

		redirect('master_data/angkatan/');
	}

	public function kelas($angkatan_id){
		$cek = $this->db->where('id', $angkatan_id)->get('angkatan');
		if($cek->num_rows() > 0){
			$data['angkatan'] = $cek->row_array();
			$data['list']     = $this->db->where('angkatan_id', $angkatan_id)
										 ->get('angkatan_kelas')->result_array();

			$this->template->load('layout/template','master_data/angkatan/kelas', $data);
		}else{
			show_404();
		}
	}


	public function add_kelas($angkatan_id){
		$p = $this->input->post();
		$p['angkatan_id'] = $angkatan_id;

		$this->form_validation->set_data($p);
		$this->form_validation->set_rules('nama_kelas', 'Nama Kelas', 'required');

		if($this->form_validation->run() == TRUE){
			$cek = $this->db->where('angkatan_id', $angkatan_id)
						->where('nama_kelas', $p['nama_kelas'])->get('angkatan_kelas')
						->num_rows();

			if($cek == 0){
				if($this->angkatan_model->insert_kelas($p)){
					$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil dimasukkan','success'));
				}else{
					$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal dimasukkan','danger'));
				}
			}else{
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Kelas sudah ada','warning'));
			}
			

		}else{
			$this->session->set_flashdata('alert_message', show_alert(validation_errors(),'warning'));
		}

		redirect('master_data/angkatan/kelas/'.$angkatan_id);
	}

	public function update_kelas($angkatan_id){
		$p  = $this->input->post();
		$id = $p['id_kelas'];
		$s  = false;

		unset($p['id_kelas']);

		$this->form_validation->set_data($p);
		$this->form_validation->set_rules('nama_kelas', 'Nama Kelas', 'required');

		$cek = $this->db->where('angkatan_id', $angkatan_id)
						->where('id', $id)->get('angkatan_kelas')->row_array();

		if($p['nama_kelas'] == $cek['nama_kelas']){
			$s = true;
		
		}else{
			$cek = $this->db->where('angkatan_id', $angkatan_id)
							->where('nama_kelas', $p['nama_kelas'])->get('angkatan_kelas')->num_rows();

			if($cek == 0){
				$s = true;
			}
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-warning"></i> Nama angkatan sudah ada','warning'));
		}

		if($s){
			if($this->form_validation->run() == TRUE){

				if($this->angkatan_model->update_kelas($p, $id)){
					$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil diubah','success'));
				}else{
					$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal diubah','danger'));
				}

			}else{
				$this->session->set_flashdata('alert_message', show_alert(validation_errors(),'warning'));
			}
		}

		redirect('master_data/angkatan/kelas/'.$angkatan_id);
	}

	public function delete_kelas($angkatan_id, $id){

		if($this->angkatan_model->delete_kelas($id)){
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil dihapus','success'));
		}else{
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal dihapus','danger'));
		}

		redirect('master_data/angkatan/kelas/'.$angkatan_id);
	}
    
}