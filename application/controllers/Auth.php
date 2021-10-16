<?php 

class Auth extends CI_Controller{

	function __construct(){
		parent::__construct();	
		$this->load->model('user_model');
		$this->load->model('mahasiswa_model');	
		$this->load->model('dosen_model');		
		$this->load->model('angkatan_model');	
	}

	public function index(){
		if($this->session->userdata('login')){
			redirect('dashboard');
		
		}else{
			$data['info'] = $this->db->where('id', '1')->get('option')->row_array();
			$this->load->view('login/index', $data);
		}
	}

	public function get_page($page){
		if(in_array($page, ['mahasiswa','dosen', 'admin'])){
			$data['page'] = $page;
			$this->load->view('login/login', $data);

		}else{
			show_404();
		}
	}

	public function login($role){
		$p = $this->input->post();

		if($role == 'mahasiswa'){
			$title = 'nim';
		}else if($role == 'dosen'){
			$title = 'nip';
		}else{
			$title = 'username';
		}

		$this->form_validation->set_rules($title, $title, 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if($this->form_validation->run() == TRUE){

			if($role == 'admin'){
				$check = $this->user_model->get_detail($p);

			}else if($role == 'dosen'){
				$check = $this->dosen_model->get_detail($p);

			}else{
				$p = [
					'nim' => $p['nim'],
					'password' => $p['password']
				];
				$check = $this->mahasiswa_model->get_detail($p);
			}
			

			if($check->num_rows() > 0){

				$data_user = $check->row_array();
				$this->session->set_userdata('login', true);

				if($role != 'admin'){
					if($role == 'dosen'){
						$data_user['nama']   = $data_user['nama_dosen'];
						$data_user['posisi'] = 'Dosen';
						
					}else{
						$data_user['nama']   = $data_user['nama_mahasiswa'];
						$data_user['posisi'] = 'Mahasiswa';
					}
				}
				$this->session->set_userdata('user_data', $data_user);
				redirect('dashboard');
				//var_dump($check);

			}else{
				$this->session->set_flashdata('alert_message', show_alert('<b><i class="fa fa-danger"></i> Username / Password Salah</b><br> Silahkan masukkan username / password dengan benar','danger'));
				redirect('login/'.$role);
			}

		}else{
			$this->session->set_flashdata('alert_message', show_alert(validation_errors(),'danger'));
			redirect('login/'.$role);
		}
	}

	public function daftar(){
		$data['angkatan'] = $this->db->get('angkatan')->result_array();
		$this->load->view('login/daftar', $data);
	}

	public function do_register(){
		$p = $this->input->post();
		$cek = $this->db->where('nim', $p['nim'])->get('mahasiswa')->num_rows();
		if($cek == 0){
			$p['jurusan_id'] = '8';

			if($this->db->insert('mahasiswa',$p)){
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Registrasi Berhasil','success'));
				redirect('login/mahasiswa');

			}else{
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Registrasi Gagal','danger'));
			}
			redirect('daftar');

		}else{
			$this->session->set_flashdata('alert_message', show_alert('<b><i class="fa fa-warning"></i> NIM Sudah Terdaftar</b><br> Silahkan masukkan nim yang lain','danger'));
			redirect('daftar');
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('');
	}

	public function get_kelas(){
		if($this->input->is_ajax_request()){
			$this->db->where('angkatan_id', $this->input->post('angkatan_id'));

			$res = [
				'status' => true,
				'data'	 => $this->db->get('angkatan_kelas')->result_array()
			];

			echo json_encode($res);

		}else{
			show_404();
		}
	}
}