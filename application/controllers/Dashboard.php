<?php

class Dashboard extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('skpa_model');
		$this->load->model('partisipan_model');

		if (!$this->session->userdata('login')) {
			redirect('');
		}

		$this->role = $this->session->userdata('user_data')['posisi'];
	}

	public function index()
	{
		$data['skpa'] = $this->skpa_model->get_active();

		if ($this->role == 'Mahasiswa') {
			$data['skpa']   = $this->skpa_model->get_active();
			$data['option'] = $this->db->where('id', '1')->get('option')->row_array();
			$find = [
				'skpa_gelombang_id' => $data['skpa']['skpa_gelombang_id'],
				'mahasiswa_id'		=> $this->session->userdata('user_data')['id']
			];
			$data['gelombang'] = $this->skpa_model->get_detail_gelombang_daftar($find)->row_array();

			$partisipan_id = !empty($data['gelombang']) ? $data['gelombang']['skpa_gelombang_daftar_id'] : null;
			$data['last_judul'] = $this->partisipan_model->get_judul_last($partisipan_id);
		}

		$this->template->load('layout/template', 'dashboard', $data);
	}

	public function informasi()
	{
		if ($this->role == 'Superadmin') {
			$data['info'] = $this->db->where('id', '1')->get('option')->row_array();
			$this->template->load('layout/template', 'master_data/informasi', $data);
		}
	}

	public function insert_info()
	{
		$p = $this->input->post();
		$this->db->where('id', '1')
			->update('option', [
				'info_tambahan' => $p['info_tambahan']
			]);
		$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Informasi berhasil ditambahkan', 'success'));
		redirect('master_data/informasi');
	}

	public function insert_syarat()
	{
		$config['upload_path']          = './assets/';
		$config['allowed_types']        = 'pdf|doc|docx|zip|rar';
		$config['file_name']			= 'syarat_berkas';
		$config['max_size']             = 20480;
		$config['max_width']            = 3000;
		$config['max_height']           = 3000;

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('file_syarat')) {
			$upl = $this->upload->data();
			$p['syarat_terbit_skpa']   = $upl['file_name'];

			$get = $this->db->where('id', '1')->get('option')->row_array()['syarat_terbit_skpa'];

			$path = './assets/' . $get;
			if (file_exists($path)) {
				unlink($path);
			} else {
				//echo $path;
			}

			$this->db->where('id', '1')
				->update('option', $p);

			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Syarat Berkas berhasil ditambahkan', 'success'));
		} else {
			$this->session->set_flashdata('alert_message', show_alert('<b><i class="fa fa-minus-circle"></i></b> ' . $this->upload->display_errors(), 'warning'));
		}

		redirect('master_data/informasi');
	}
}
