<?php

class Partisipan extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('partisipan_model');
		$this->load->model('skpa_model');
		$this->load->model('judul_model');
		$this->load->model('dosen_model');

		if (!$this->session->userdata('login')) {
			redirect('');
		}

		$this->user = $this->session->userdata('user_data');
	}

	public function index()
	{
		if ($this->user['posisi'] == 'Mahasiswa') {

			$data['skpa'] = $this->skpa_model->get_active();

			$find = [
				'skpa_gelombang_id' => $data['skpa']['skpa_gelombang_id'],
				'tanggal_judul_end' => $data['skpa']['tanggal_judul_end'],
				'mahasiswa_id'		=> $this->user['id']
			];

			$data['gelombang'] = $this->skpa_model->get_detail_gelombang_daftar($find)->row_array();

			$partisipan_id = !empty($data['gelombang']) ? $data['gelombang']['skpa_gelombang_daftar_id'] : null;
			$data['judul']		= $this->partisipan_model->get_judul($partisipan_id);
			$data['last_judul'] = $this->partisipan_model->get_judul_last($partisipan_id);
			$data['dosen']      = $this->dosen_model->get_data();


			$this->template->load('layout/template', 'skpa/partisipan/index', $data);
		} else {
			show_404();
		}
	}

	public function add_partisipan()
	{
		$currentdate = date('Y-m-d');
		$p = $this->input->post();
		$p['mahasiswa_id'] = $this->session->userdata('user_data')['id'];

		$data['skpa'] = $this->skpa_model->get_active();

		$find2 = [
			'tanggal_judul_end' => $data['skpa']['tanggal_judul_end']
		];

		$this->form_validation->set_rules('skpa_gelombang_id', 'Gelombang', 'required');
		$this->form_validation->set_rules('pembimbing_1_id', 'Pembimbing 1', 'required');


		if ($this->form_validation->run() == TRUE) {
			$find = [
				'mahasiswa_id' => $p['mahasiswa_id'],
				'skpa_gelombang_id' => $p['skpa_gelombang_id']
			];
			$cek = $this->db->where($find)->get('skpa_gelombang_daftar');

			if ($cek->num_rows() == 0) {
				if (isset($p['pembimbing_2_id'])) {
					if ($p['pembimbing_2_id'] == '') {
						$p['pembimbing_2_id'] = null;
					}
				}

				if ((strtotime($currentdate)) <= (strtotime($find2['tanggal_judul_end']))) {
					if ($this->skpa_model->insert_partisipan($p)) {
						$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil dimasukkan', 'success'));
					} else {
						$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-times"></i> Data gagal dimasukkan', 'danger'));
					}
				} else {
					$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Pendaftaran gelombang aktif telah selesai, silahkan mendaftar pada gelombang selanjutnya', 'warning'));
				}
			} else {
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-warning"></i> Mahasiswa yang dipilih sudah ada pada gelombang yang anda pilih', 'warning'));
			}
		} else {
			$this->session->set_flashdata('alert_message', show_alert(validation_errors(), 'warning'));
		}

		redirect('skpa/daftar');
	}

	public function change()
	{
		if ($this->user['posisi'] == 'Mahasiswa') {
			$data['skpa'] = $this->skpa_model->get_active();

			$find = [
				'skpa_gelombang_id' => $data['skpa']['skpa_gelombang_id'],
				'mahasiswa_id'		=> $this->user['id']
			];
			$data['gelombang'] = $this->skpa_model->get_detail_gelombang_daftar($find)->row_array();

			$partisipan_id = $data['gelombang']['skpa_gelombang_daftar_id'];
			$data['dosen'] = $this->dosen_model->get_data();
			$data['judul'] = $this->partisipan_model->get_judul_last($partisipan_id);
			$data['change'] = $this->judul_model->get_change($data['judul']['pengajuan_judul_id']);

			$this->template->load('layout/template', 'skpa/partisipan/change', $data);
		} else {
			show_404();
		}
	}

	public function insert_judul($partisipan_id)
	{
		$p = $this->input->post();
		$this->form_validation->set_rules('nama_judul', 'Nama Judul', 'required');

		if ($this->form_validation->run() == TRUE) {
			$config['upload_path']          = './assets/file/';
			$config['allowed_types']        = 'pdf|doc|docx|zip|rar';
			$config['file_name']			= $partisipan_id . "_judul_" . time();
			$config['max_size']             = 20480;
			$config['max_width']            = 3000;
			$config['max_height']           = 3000;

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('file_judul')) {
				$upl = $this->upload->data();
				$p['file_judul']   = $upl['file_name'];
				$p['waktu_upload'] = date('Y-m-d H:i:s');
				$p['skpa_gelombang_daftar_id'] = $partisipan_id;

				if ($this->partisipan_model->insert_judul($p)) {
					$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil dimasukkan', 'success'));
				} else {
					$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal dimasukkan', 'danger'));
				}
			} else {
				$this->session->set_flashdata('alert_message', show_alert('<b><i class="fa fa-minus-circle"></i></b> ' . $this->upload->display_errors(), 'warning'));
			}
		} else {
			$this->session->set_flashdata('alert_message', show_alert(validation_errors(), 'warning'));
		}

		redirect('skpa/daftar');
	}


	public function edit_judul($partisipan_id)
	{
		$p = $this->input->post();

		$judul = $this->partisipan_model->get_judul_last($partisipan_id);

		if (count($judul) > 0) {

			$path = './assets/file/' . $judul['file_judul'];
			if (file_exists($path)) {
				unlink($path);
			} else {
				echo $path;
			}

			$config['upload_path']          = './assets/file/';
			$config['allowed_types']        = 'pdf|doc|docx|]zip|rar';
			$config['file_name']			= $partisipan_id . "_judul_" . time();
			$config['max_size']             = 20480;
			$config['max_width']            = 3000;
			$config['max_height']           = 3000;

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('file_judul')) {

				$upl = $this->upload->data();
				$p['file_judul']   = $upl['file_name'];
				$p['waktu_upload'] = date('Y-m-d H:i:s');
				$p['is_read']	   = '0';
				$p['is_acc_1'] 	   = '-1';

				if (file_exists(base_url('assets/file/' . $p['file_judul']))) {
					unlink(base_url('assets/file/' . $p['file_judul']));
				}

				if ($this->partisipan_model->update_judul($p, $judul['id'])) {
					$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil diubah', 'success'));
				} else {
					$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal diubah', 'danger'));
				}
			} else {
				$this->session->set_flashdata('alert_message', show_alert('<b><i class="fa fa-minus-circle"></i></b> File gagal diupload', 'danger'));
			}
		} else {
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data tidak diketahui', 'danger'));
		}

		redirect('skpa/daftar');
	}


	public function upload_berkas_seminar($judul_id)
	{
		$p = $this->input->post();
		$judul = $this->db->where('id', $judul_id)->get('pengajuan_judul')->row_array();
		$path = './assets/file/seminar/' . $judul['file_seminar'];
		if (file_exists($path)) {
			unlink($path);
		} else {
			echo $path;
		}

		$config['upload_path']          = './assets/file/seminar/';
		$config['allowed_types']        = 'pdf|doc|docx|zip|rar';
		$config['file_name']			= $judul_id . "_seminar_" . time();
		$config['max_size']             = 20480;
		$config['max_width']            = 3000;
		$config['max_height']           = 3000;

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('file_seminar')) {

			$upl = $this->upload->data();
			$p['file_seminar']   				= $upl['file_name'];
			$p['waktu_upload_berkas_seminar'] 	= date('Y-m-d H:i:s');
			$p['is_berkas_seminar_upload']		= '1';
			$p['is_acc_2_1']					= '-1';

			$this->db->trans_begin();

			if (isset($p['pembimbing_2_id'])) {
				$pbb_2_id = $p['pembimbing_2_id'];
				$partisipan_id = $this->db->where('id', $judul_id)->get('pengajuan_judul')->row_array()['skpa_gelombang_daftar_id'];
				$this->db->where('id', $partisipan_id)
					->update('skpa_gelombang_daftar', ['pembimbing_2_id' => $pbb_2_id]);

				unset($p['pembimbing_2_id']);
			}

			$this->partisipan_model->update_judul($p, $judul['id']);

			if ($this->db->trans_status()) {
				$this->db->trans_commit();
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil diubah', 'success'));
			} else {
				$this->db->trans_rollback();
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal diubah', 'danger'));
			}
		} else {
			$this->session->set_flashdata('alert_message', show_alert('<b><i class="fa fa-minus-circle"></i></b> File gagal diupload', 'danger'));
		}

		redirect('skpa/seminar');
	}

	public function upload_revisi_seminar($judul_id)
	{
		$p = $this->input->post();
		$judul = $this->db->where('id', $judul_id)->get('pengajuan_judul')->row_array();
		$path = './assets/file/revisi/' . $judul['file_revisi'];
		if (file_exists($path)) {
			unlink($path);
		} else {
			echo $path;
		}

		$config['upload_path']          = './assets/file/revisi/';
		$config['allowed_types']        = 'pdf|doc|docx|zip|rar';
		$config['file_name']			= $judul_id . "_revisi_" . time();
		$config['max_size']             = 20480;
		$config['max_width']            = 3000;
		$config['max_height']           = 3000;

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('file_revisi')) {

			$upl = $this->upload->data();
			$p['file_revisi']   		= $upl['file_name'];
			$p['waktu_upload_revisi'] 	= date('Y-m-d H:i:s');
			$p['is_revisi_upload']		= '1';
			$p['is_revisi_acc']			= '-1';

			if ($this->partisipan_model->update_judul($p, $judul['id'])) {
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil diubah', 'success'));
			} else {
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal diubah', 'danger'));
			}
		} else {
			$this->session->set_flashdata('alert_message', show_alert('<b><i class="fa fa-minus-circle"></i></b> File gagal diupload', 'danger'));
		}

		redirect('skpa/penerbitan');
	}

	public function request()
	{
		if ($this->user['posisi'] == 'Superadmin') {
			$data['skpa'] = $this->skpa_model->get_active();

			$find = [
				'skpa_gelombang_id' => $data['skpa']['skpa_gelombang_id']
			];

			$data['mahasiswa'] = $this->partisipan_model->get_data_by_gelombang(
				$data['skpa']['skpa_gelombang_id']
			)->result_array();

			$this->template->load('layout/template', 'skpa/request/index', $data);
		} else {
			show_404();
		}
	}

	public function request_detail($judul_id)
	{
		if ($this->user['posisi'] == 'Superadmin') {
			$cek      = $this->partisipan_model->get_by_judul_id($judul_id);

			if (count($cek) > 0) {
				$data['skpa']    = $cek;
				$this->partisipan_model->update_judul(['is_read' => '1'], $judul_id);
				$this->template->load('layout/template', 'skpa/request/detail', $data);
			} else {
				show_404();
			}
		} else {
			show_404();
		}
	}

	public function insert_comment($judul_id)
	{
		$p = $this->input->post();
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

		if ($this->form_validation->run() == TRUE) {
			$cek   = $this->partisipan_model->get_by_judul_id($judul_id, $this->user['id']);
			$dosen = [$cek['pembimbing_1_id'], $cek['pembimbing_2_id'], $cek['penguji_id']];
			$key   = array_search($this->user['id'], $dosen) + 1;
			$val   = $cek['is_acc_' . $key];

			if ($val == '3') {
				$by = 'Penguji';
			} else {
				$by = 'Pembimbing ' . $key;
			}

			$data = [
				'dosen_id' => $this->user['id'],
				'pengajuan_judul_id' => $judul_id,
				'keterangan_comment' => $p['keterangan'],
				'waktu_comment'		 => date('Y-m-d H:i:s'),
				'comment_by'		 => $by
			];

			if ($this->judul_model->insert_comment($data)) {
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil dimasukkan', 'success'));
			} else {
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal dimasukkan', 'danger'));
			}
		} else {
			$this->session->set_flashdata('alert_message', show_alert(validation_errors(), 'warning'));
		}

		redirect('skpa/request/detail/' . $judul_id);
	}

	public function set_approval($status, $judul_id)
	{

		if (in_array($status, ['approve', 'deny'])) {
			$by = 'is_acc_1';

			$this->db->trans_begin();
			if ($status == 'approve') {
				$val = '1';
				$data['waktu_acc_1'] = date('Y-m-d h:i:s');
				$status_approval = 'Diterima';
			} else {
				$val = '0';
				$data['ket_tolak'] = $this->input->post('ket_tolak');
				$data['waktu_acc_1'] = date('Y-m-d h:i:s');
				$status_approval = "Ditolak \r\r Note : " . $data['ket_tolak'];
				/**$change = [
            		'pengajuan_judul_id' => $judul_id,
            		'dosen_prev_id'		 => $this->user['id']
            	];
            	$this->db->insert('pengajuan_judul_change', $change);**/
			}

			$data[$by] = $val;
			$this->judul_model->update($data, $judul_id);

			if ($this->db->trans_status()) {
				$this->db->trans_commit();

				$judul = $this->partisipan_model->get_by_judul_id($judul_id);
				$no = "62" . substr($judul['m_telp'], 1);

				$my_apikey   = "KLALLQ6HPGH1YW9L280M";
				$destination = $no;
				$message     = "[ NOTIFIKASI PENGAJUAN JUDUL PROYEK AKHIR ] \n";
				$message	 .= "Judul : " . $judul['nama_judul'] . " \n\n";
				$message 	 .= "Pengajuan Judul Proyek Akhir " . $status_approval;

				$api_url = "http://panel.capiwha.com/send_message.php";
				$api_url .= "?apikey=" . urlencode($my_apikey);
				$api_url .= "&number=" . urlencode($destination);
				$api_url .= "&text=" . urlencode($message);
				$my_result_object = json_decode(file_get_contents($api_url, false));

				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Status berhasil diubah', 'success'));
			} else {
				$this->db->trans_rollback();
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Status gagal diubah', 'danger'));
			}
		} else {
			$this->session->set_flashdata('alert_message', show_alert(validation_errors(), 'warning'));
		}

		redirect('skpa/request/detail/' . $judul_id);
	}

	public function change_dosen()
	{
		$p = $this->input->post();

		$config['upload_path']          = './assets/file/';
		$config['allowed_types']        = 'pdf|doc|docx|zip|rar';
		$config['file_name']			= $p['change_id'] . "_pendukung_" . time();
		$config['max_size']             = 20480;
		$config['max_width']            = 3000;
		$config['max_height']           = 3000;

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('file_judul')) {
			$upl = $this->upload->data();
			$p['file_judul']   = $upl['file_name'];
			$p['waktu_request'] = date('Y-m-d H:i:s');
			$p['skpa_gelombang_daftar_id'] = $partisipan_id;

			if ($this->judul_model->insert_judul($p)) {
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil dimasukkan', 'success'));
			} else {
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal dimasukkan', 'danger'));
			}
		} else {
			$this->session->set_flashdata('alert_message', show_alert('<b><i class="fa fa-minus-circle"></i></b> ' . $this->upload->display_errors(), 'warning'));
		}

		redirect('skpa/daftar/change');
	}


	public function seminar()
	{
		if ($this->user['posisi'] == 'Mahasiswa') {
			$data['skpa'] = $this->skpa_model->get_active();

			$find = [
				'skpa_gelombang_id' => $data['skpa']['skpa_gelombang_id'],
				'mahasiswa_id'		=> $this->user['id']
			];
			$data['gelombang'] = $this->skpa_model->get_detail_gelombang_daftar($find)->row_array();

			$partisipan_id = !empty($data['gelombang']) ? $data['gelombang']['skpa_gelombang_daftar_id'] : null;
			$data['judul']		= $this->partisipan_model->get_judul($partisipan_id);
			$data['last_judul'] = $this->partisipan_model->get_judul_last($partisipan_id);
			$data['dosen']      = $this->dosen_model->get_data();

			$this->template->load('layout/template', 'skpa/partisipan/seminar', $data);
		} else {
			show_404();
		}
	}

	public function penerbitan()
	{
		if ($this->user['posisi'] == 'Mahasiswa') {
			$data['skpa'] = $this->skpa_model->get_active();

			$find = [
				'skpa_gelombang_id' => $data['skpa']['skpa_gelombang_id'],
				'mahasiswa_id'		=> $this->user['id']
			];
			$data['gelombang'] = $this->skpa_model->get_detail_gelombang_daftar($find)->row_array();

			$partisipan_id = !empty($data['gelombang']) ? $data['gelombang']['skpa_gelombang_daftar_id'] : null;
			$data['judul']		= $this->partisipan_model->get_judul($partisipan_id);
			$data['last_judul'] = $this->partisipan_model->get_judul_last($partisipan_id);
			$data['option'] 	= $this->db->where('id', '1')->get('option')->row_array();
			$this->template->load('layout/template', 'skpa/partisipan/penerbitan', $data);
		} else {
			show_404();
		}
	}

	public function rekomendasi_judul()
	{
		if ($this->user['posisi'] == 'Mahasiswa') {
			$data['dosen'] = $this->db->order_by('kode_dosen', 'ASC')->get('dosen')->result_array();

			if ($this->input->get('dosen_id')) {
				$data['list'] = $this->db->where('dosen_id', $this->input->get('dosen_id'))->get('dosen_recommendation')->result_array();
			}

			$this->template->load('layout/template', 'skpa/partisipan/rekomendasi_judul', $data);
		} else {
			show_404();
		}
	}
}
