<?php

class Skpa extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('skpa_model');
		$this->load->model('mahasiswa_model');
		$this->load->model('partisipan_model');
		$this->load->model('dosen_model');

		if (!$this->session->userdata('login')) {
			redirect('');
		}

		$this->user = $this->session->userdata('user_data');
		$this->role = $this->session->userdata('user_data')['posisi'];
	}

	public function list()
	{
		if ($this->role == 'Superadmin') {
			$data['kode'] = $this->skpa_model->generate_code();
			$data['list'] = $this->skpa_model->get_data();
			$this->template->load('layout/template', 'skpa/index', $data);
		} else {
			show_404();
		}
	}

	public function add()
	{
		$p = $this->input->post();

		//$this->form_validation->set_rules('tahun', 'Tahun', 'required|numeric|exact_length[4]|is_unique[skpa.tahun]');
		$this->form_validation->set_rules('tahun', 'Tahun', 'required');
		$this->form_validation->set_rules('start', 'Tanggal Mulai', 'required');
		$this->form_validation->set_rules('end', 'Tanggal Selesai', 'required');

		if ($this->form_validation->run() == TRUE) {

			if (strtotime($p['end']) > strtotime($p['start'])) {
				if ($this->skpa_model->insert($p)) {
					$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil dimasukkan', 'success'));
				} else {
					$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal dimasukkan', 'danger'));
				}
			} else {
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Tanggal Mulai harus dibawah tanggal selesai', 'warning'));
			}
		} else {
			$this->session->set_flashdata('alert_message', show_alert(validation_errors(), 'warning'));
		}

		redirect('skpa/list/');
	}

	public function detail($id)
	{
		if ($this->role == 'Superadmin') {
			$cek = $this->skpa_model->get_detail('id', $id);

			if ($cek->num_rows() > 0) {
				$data['skpa']      = $cek->row_array();
				$data['mahasiswa'] = $this->mahasiswa_model->get_data();
				$data['dosen'] 	   = $this->dosen_model->get_data();
				$data['next']      = $this->skpa_model->get_next($id);

				$data['gelombang'] = $this->skpa_model->get_gelombang($id);
				$data['skpa_mhs']  = $this->skpa_model->get_mahasiswa($id);
				$this->template->load('layout/template', 'skpa/detail', $data);
			} else {
				show_404();
			}
			$data['kode'] = $this->skpa_model->generate_code();
			$data['list'] = $this->skpa_model->get_data();
		} else {
			show_404();
		}
	}

	public function set_gelombang($tipe, $skpa_id, $id)
	{
		$array = ['approve', 'deny'];

		if (in_array($tipe, $array)) {
			$this->db->trans_begin();

			if ($tipe == 'approve') {
				$status = '1';
			} else {
				$status = '0';
			}

			$this->db->update('skpa_gelombang', ['is_active' => '0']);
			$this->db->where('id', $id)
				->update('skpa_gelombang', ['is_active' => $status]);

			if ($this->db->trans_status()) {
				$this->db->trans_commit();
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil diaktifkan', 'success'));
			} else {
				$this->db->trans_rollback();
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data gagal diaktifkan', 'success'));
			}

			redirect('skpa/detail/' . $skpa_id);
		} else {
			show_404();
		}
	}

	public function add_gelombang($skpa_id)
	{
		$p = $this->input->post();

		$this->form_validation->set_rules('tanggal_judul_start', 'Tanggal Mulai Penentuan Judul', 'required');
		$this->form_validation->set_rules('tanggal_judul_end', 'Tanggal Selesai Penentuan Judul', 'required');
		$this->form_validation->set_rules('tanggal_sidang_start', 'Tanggal Mulai Sidang Komite', 'required');
		$this->form_validation->set_rules('tanggal_sidang_end', 'Tanggal Selesai Sidang Komite', 'required');
		$this->form_validation->set_rules('tanggal_hasil_sidang', 'Tanggal Pemberitahuan Sidang Komite', 'required');
		$this->form_validation->set_rules('tanggal_seminar_start', 'Tanggal Mulai Seminar', 'required');
		$this->form_validation->set_rules('tanggal_seminar_end', 'Tanggal Selesai Seminar', 'required');
		$this->form_validation->set_rules('tanggal_hasil_seminar', 'Tanggal Pemberitahuan Hasil Seminar', 'required');

		if ($this->form_validation->run() == TRUE) {

			if (strtotime($p['tanggal_judul_end']) > strtotime($p['tanggal_judul_start'])) {
				if ($p['tanggal_sidang_end'] > $p['tanggal_sidang_start'] && $p['tanggal_sidang_start'] > $p['tanggal_judul_end']) {

					if ($p['tanggal_seminar_end'] > $p['tanggal_seminar_start'] && $p['tanggal_seminar_start'] > $p['tanggal_sidang_end']) {

						if ($this->skpa_model->insert_gelombang($p)) {
							$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil dimasukkan', 'success'));
						} else {
							$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal dimasukkan', 'danger'));
						}
					} else {
						$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Tanggal Mulai Seminar harus dibawah tanggal selesai seminar Dan Tanggal Seminar harus diatas tanggal selesai sidang komite', 'warning'));
					}
				} else {
					$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Tanggal Mulai Sidang Komite harus dibawah tanggal selesai sidang komite Dan Tanggal Mulai Sidang harus diatas tanggal selesai penentuan judul', 'warning'));
				}
			} else {
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Tanggal Mulai Penentuan Judul harus dibawah tanggal selesai penentuan judul', 'warning'));
			}
		} else {
			$this->session->set_flashdata('alert_message', show_alert(validation_errors(), 'warning'));
		}

		redirect('skpa/detail/' . $skpa_id);
	}

	public function update_gelombang($skpa_id)
	{
		$p = $this->input->post();
		$id = $p['skpa_gelombang_id'];
		unset($p['skpa_gelombang_id']);

		$this->form_validation->set_rules('tanggal_judul_start', 'Tanggal Mulai Penentuan Judul', 'required');
		$this->form_validation->set_rules('tanggal_judul_end', 'Tanggal Selesai Penentuan Judul', 'required');
		$this->form_validation->set_rules('tanggal_sidang_start', 'Tanggal Mulai Sidang Komite', 'required');
		$this->form_validation->set_rules('tanggal_sidang_end', 'Tanggal Selesai Sidang Komite', 'required');
		$this->form_validation->set_rules('tanggal_hasil_sidang', 'Tanggal Pemberitahuan Sidang Komite', 'required');
		$this->form_validation->set_rules('tanggal_seminar_start', 'Tanggal Mulai Seminar', 'required');
		$this->form_validation->set_rules('tanggal_seminar_end', 'Tanggal Selesai Seminar', 'required');
		$this->form_validation->set_rules('tanggal_hasil_seminar', 'Tanggal Pemberitahuan Hasil Seminar', 'required');

		if ($this->form_validation->run() == TRUE) {

			if (strtotime($p['tanggal_judul_end']) > strtotime($p['tanggal_judul_start'])) {
				if ($p['tanggal_sidang_end'] > $p['tanggal_sidang_start'] && $p['tanggal_sidang_start'] > $p['tanggal_judul_end']) {

					if ($p['tanggal_seminar_end'] > $p['tanggal_seminar_start'] && $p['tanggal_seminar_start'] > $p['tanggal_sidang_end']) {

						if ($this->skpa_model->update_gelombang($p, $id)) {
							$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil diubah', 'success'));
						} else {
							$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal diubah', 'danger'));
						}
					} else {
						$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Tanggal Mulai Seminar harus dibawah tanggal selesai seminar Dan Tanggal Seminar harus diatas tanggal selesai sidang komite', 'warning'));
					}
				} else {
					$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Tanggal Mulai Sidang Komite harus dibawah tanggal selesai sidang komite Dan Tanggal Mulai Sidang harus diatas tanggal selesai penentuan judul', 'warning'));
				}
			} else {
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Tanggal Mulai Penentuan Judul harus dibawah tanggal selesai penentuan judul', 'warning'));
			}
		} else {
			$this->session->set_flashdata('alert_message', show_alert(validation_errors(), 'warning'));
		}

		redirect('skpa/detail/' . $skpa_id);
	}


	public function add_partisipan($skpa_id)
	{
		$p = $this->input->post();

		$this->form_validation->set_rules('skpa_gelombang_id', 'Gelombang', 'required');
		$this->form_validation->set_rules('mahasiswa_id', 'Mahasiswa', 'required');
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
				if ($this->skpa_model->insert_partisipan($p)) {
					$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil dimasukkan', 'success'));
				} else {
					$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-times"></i> Data gagal dimasukkan', 'danger'));
				}
			} else {
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-warning"></i> Mahasiswa yang dipilih sudah ada pada gelombang yang anda pilih', 'warning'));
			}
		} else {
			$this->session->set_flashdata('alert_message', show_alert(validation_errors(), 'warning'));
		}

		redirect('skpa/detail/' . $skpa_id);
	}


	public function progress($skpa_id, $partisipan_id)
	{
		if ($this->role == 'Superadmin') {
			$cek = $this->partisipan_model->get_detail('skpa_gelombang_daftar.id', $partisipan_id);

			if ($cek->num_rows() > 0) {
				$data['partisipan'] = $cek->row_array();
				$data['judul']		= $this->partisipan_model->get_judul($partisipan_id);
				$data['last_judul'] = $this->partisipan_model->get_judul_last($partisipan_id);
				$data['dosen']	    = $this->dosen_model->get_data();
				$this->template->load('layout/template', 'skpa/progress', $data);
			} else {
				show_404();
			}
		} else {
			show_404();
		}
	}

	public function set_seminar($skpa_id, $partisipan_id)
	{
		if ($this->role == 'Superadmin') {
			$cek = $this->partisipan_model->get_detail('skpa_gelombang_daftar.id', $partisipan_id);

			if ($cek->num_rows() > 0) {
				$p = $this->input->post();
				$this->form_validation->set_rules('tanggal_seminar', 'Tanggal Seminar', 'required');
				$this->form_validation->set_rules('penguji_id', 'Dosen Penguji', 'required');
				$this->form_validation->set_rules('ruangan', 'Ruangan', 'required');

				if ($this->form_validation->run() == TRUE) {
					$p['jam_seminar'] = date('H:i', strtotime($p['jam_seminar'])) . ":00";
					$this->partisipan_model->update($p, $partisipan_id);
					$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data Seminar berhasil dimasukkan', 'success'));
				} else {
					$this->session->set_flashdata('alert_message', show_alert(validation_errors(), 'warning'));
				}

				redirect('skpa/detail/' . $skpa_id . '/progress/' . $partisipan_id);
			} else {
				show_404();
			}
		} else {
			show_404();
		}
	}

	public function set_notif($tipe, $status, $gelombang_id)
	{
		$get_tipe   = ['to', 'result'];
		$get_status = ['active', 'nonactive'];

		if (in_array($tipe, $get_tipe) && in_array($status, $get_status)) {
			$this->db->trans_begin();

			if ($status == 'active') {
				$status = '1';
			} else {
				$status = '0';
			}

			$skpa_id = $this->db->where('id', $gelombang_id)->get('skpa_gelombang')->row_array()['skpa_id'];

			$data['notif_' . $tipe . '_seminar'] = $status;
			$this->db->where('id', $gelombang_id)->update('skpa_gelombang', $data);

			if ($this->db->trans_status()) {
				$this->db->trans_commit();
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Notifikasi berhasil diubah', 'success'));
			} else {
				$this->db->trans_rollback();
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data gagal diubah', 'success'));
			}

			redirect('skpa/detail/' . $skpa_id);
		} else {
			show_404();
		}
	}


	public function komite()
	{
		if ($this->role == 'Superadmin') {
			$find = [
				'is_acc_1' => '1'
			];
			$data['list'] = $this->partisipan_model->get_detail_judul($find)->result_array();
			$this->template->load('layout/template', 'skpa/komite/index', $data);
		} else {
			show_404();
		}
	}

	public function komite_approval()
	{
		$array = ['approve', 'deny'];
		$tipe = $this->input->post('status');
		$judul_id = $this->input->post('id_judul');

		if (in_array($tipe, $array)) {
			$by = 'is_acc_2';
			$this->db->trans_begin();

			if ($tipe == 'approve') {
				$status = '2';
				$data['waktu_acc_2'] = date('Y-m-d h:i:s');
				$data['catatan'] = $this->input->post('catatan');
				$status_approval = 'Diterima';
			} else {
				$status = '0';
				$data['waktu_acc_2'] = date('Y-m-d h:i:s');
				$data['catatan'] = $this->input->post('catatan');
				$status_approval = 'Ditolak';
			}

			$data[$by] = $status;
			$this->partisipan_model->update_judul($data, $judul_id);

			#$this->partisipan_model->update_judul(['is_acc_2' => $status], $judul_id);

			if ($this->db->trans_status()) {
				$this->db->trans_commit();

				$judul = $this->partisipan_model->get_by_judul_id($judul_id);
				$no = "62" . substr($judul['m_telp'], 1);

				$my_apikey   = "KLALLQ6HPGH1YW9L280M";
				$destination = $no;
				$message     = "[ NOTIFIKASI PENGAJUAN JUDUL PROYEK AKHIR ] \n";
				$message	.= "Judul : " . $judul['nama_judul'] . " \n\n";
				$message 	.= "Pengajuan Judul Proyek Akhir " . $status_approval . " pada sidang Komite PA";

				$api_url = "http://panel.capiwha.com/send_message.php";
				$api_url .= "?apikey=" . urlencode($my_apikey);
				$api_url .= "&number=" . urlencode($destination);
				$api_url .= "&text=" . urlencode($message);
				$my_result_object = json_decode(file_get_contents($api_url, false));

				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil diubah', 'success'));
			} else {
				$this->db->trans_rollback();
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data gagal diubah', 'success'));
			}

			redirect('skpa/komite');
		} else {
			show_404();
		}
	}


	public function berkas_seminar()
	{
		if ($this->role == 'Superadmin') {
			$find = [
				'is_acc_2' => '1'
			];
			$data['dosen'] = $this->dosen_model->get_data();
			$data['list']  = $this->partisipan_model->get_detail_judul($find)->result_array();
			$this->template->load('layout/template', 'skpa/komite/berkas_seminar', $data);
		} else {
			show_404();
		}
	}

	public function berkas_seminar_approval($tipe, $judul_id)
	{
		$array = ['approve', 'deny'];

		if (in_array($tipe, $array)) {
			$this->db->trans_begin();
			$p = $this->input->post();

			if ($tipe == 'approve') {
				$status = '1';
				$status_approval = 'Diterima';

				$field = ['penguji_id', 'tanggal_seminar', 'jam_seminar', 'ruangan'];
				$seminar = [];
				foreach ($field as $row) {
					if ($row == 'jam_seminar') {
						$p[$row] = date('H:i', strtotime($p['jam_seminar'])) . ":00";
					}
					$seminar[$row] = $p[$row];
					unset($p[$row]);
				}

				$partisipan_id = $this->db->where('id', $judul_id)
					->get('pengajuan_judul')
					->row_array()['skpa_gelombang_daftar_id'];

				$this->partisipan_model->update($seminar, $partisipan_id);
			} else {
				$status = '0';
				$status_approval = 'Ditolak';
			}

			$p['is_acc_2_1'] = $status;
			$p['is_berkas_seminar_upload'] = '0';

			$this->partisipan_model->update_judul($p, $judul_id);

			if ($this->db->trans_status()) {
				$this->db->trans_commit();

				$judul = $this->partisipan_model->get_by_judul_id($judul_id);
				$no = "62" . substr($judul['m_telp'], 1);

				$my_apikey   = "KLALLQ6HPGH1YW9L280M";
				$destination = $no;

				$message     = "[ NOTIFIKASI PENGAJUAN JUDUL PROYEK AKHIR ] \n";
				$message	.= "Judul : " . $judul['nama_judul'] . " \n\n";
				$message 	.= "Berkas Seminar Proyek Akhir Anda Telah " . $status_approval;

				$api_url = "http://panel.capiwha.com/send_message.php";
				$api_url .= "?apikey=" . urlencode($my_apikey);
				$api_url .= "&number=" . urlencode($destination);
				$api_url .= "&text=" . urlencode($message);
				$my_result_object = json_decode(file_get_contents($api_url, false));
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil diubah', 'success'));
			} else {
				$this->db->trans_rollback();
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data gagal diubah', 'success'));
			}

			redirect('skpa/berkas_seminar');
		} else {
			show_404();
		}
	}


	public function confirmation()
	{
		if ($this->role == 'Superadmin') {
			$find = [
				'is_acc_2_1' => '1'
			];
			$data['list'] = $this->partisipan_model->get_detail_judul($find)->result_array();
			$this->template->load('layout/template', 'skpa/komite/confirmation', $data);
		} else {
			show_404();
		}
	}

	public function confirmation_approval($tipe, $judul_id)
	{
		$array = ['approve', 'deny'];

		if (in_array($tipe, $array)) {
			$this->db->trans_begin();
			$p = $this->input->post();

			if ($tipe == 'approve') {
				$status = '1';
				$revisi = false;
				if (isset($p['is_revisi'])) {
					if ($p['is_revisi'] == '1') {
						$revisi =  true;
					}
				}

				if (!$revisi) {
					$status_approval = 'Selamat anda lulus seminar Proyek Akhir, silahkan lanjutkan proses penerbitan SK PA ke Igracias';
				} else {
					$status_approval = 'Selamat anda lulus seminar Proyek Akhir - Dengan REVISI, silahkan penuhi dan upload berkas persyaratan revisi pada aplikasi';
				}
			} else {
				$status = '0';
				$status_approval = 'Maaf anda tidak lulus seminar Proyek Akhir, silahkan daftar kembali pada gelombang berikutnya';
			}

			$p['is_acc_3'] = $status;
			$this->partisipan_model->update_judul($p, $judul_id);

			if ($this->db->trans_status()) {
				$this->db->trans_commit();

				$judul = $this->partisipan_model->get_by_judul_id($judul_id);
				$no = "62" . substr($judul['m_telp'], 1);

				$my_apikey   = "KLALLQ6HPGH1YW9L280M";
				$destination = $no;
				$message     = "[ NOTIFIKASI PENGAJUAN JUDUL PROYEK AKHIR ] \n";
				$message	.= "Judul : " . $judul['nama_judul'] . " \n\n";
				$message 	.= $status_approval;

				$api_url = "http://panel.capiwha.com/send_message.php";
				$api_url .= "?apikey=" . urlencode($my_apikey);
				$api_url .= "&number=" . urlencode($destination);
				$api_url .= "&text=" . urlencode($message);
				$my_result_object = json_decode(file_get_contents($api_url, false));

				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil diubah', 'success'));
			} else {
				$this->db->trans_rollback();
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data gagal diubah', 'success'));
			}

			redirect('skpa/confirmation');
		} else {
			show_404();
		}
	}

	public function revisi()
	{
		if ($this->role == 'Superadmin') {
			$find = [
				'is_acc_3'  => '1',
				'is_revisi' => '1'
			];
			$data['list'] = $this->partisipan_model->get_detail_judul($find, '', true)->result_array();
			$this->template->load('layout/template', 'skpa/komite/revisi', $data);
		} else {
			show_404();
		}
	}

	public function revisi_approval($tipe, $judul_id)
	{
		$array = ['approve', 'deny'];

		if (in_array($tipe, $array)) {
			$this->db->trans_begin();
			$p = $this->input->post();

			if ($tipe == 'approve') {
				$status = '1';
				$p['is_revisi'] = '0';
				$status_approval = 'Revisi hasil seminar Proyek Akhir telah diterima, silahkan lanjutkan proses penerbitan SK PA ke Igracias';
			} else {
				$status = '0';
				$status_approval = 'Berkas revisi hasil seminar Proyek Akhir tidak memenuhi persyaratan berkas, silahkan lengkapi dan upload kembali melalui aplikasi';
			}

			$p['is_revisi_acc'] = $status;
			$p['is_revisi_upload'] = '0';

			$this->partisipan_model->update_judul($p, $judul_id);

			if ($this->db->trans_status()) {
				$this->db->trans_commit();

				$judul = $this->partisipan_model->get_by_judul_id($judul_id);
				$no = "62" . substr($judul['m_telp'], 1);

				$my_apikey   = "KLALLQ6HPGH1YW9L280M";
				$destination = $no;
				$message     = "[ NOTIFIKASI PENGAJUAN JUDUL PROYEK AKHIR ] \n";
				$message	.= "Judul : " . $judul['nama_judul'] . " \n\n";
				$message 	.= $status_approval;

				$api_url = "http://panel.capiwha.com/send_message.php";
				$api_url .= "?apikey=" . urlencode($my_apikey);
				$api_url .= "&number=" . urlencode($destination);
				$api_url .= "&text=" . urlencode($message);
				$my_result_object = json_decode(file_get_contents($api_url, false));

				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil diubah', 'success'));
			} else {
				$this->db->trans_rollback();
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data gagal diubah', 'success'));
			}

			redirect('skpa/revisi');
		} else {
			show_404();
		}
	}


	public function komite_status()
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
			#$data['list'] = $this->partisipan_model->get_detail_judul($find)->result_array();

			$this->template->load('layout/template', 'skpa/partisipan/komite', $data);
		} else {
			show_404();
		}
	}


	public function recommendation()
	{
		if ($this->role == 'Dosen') {
			$find = [
				'is_acc_3'  => '1',
				'is_revisi' => '1'
			];
			$data['list'] = $this->db->where('dosen_id', $this->session->userdata('user_data')['id'])
				->get('dosen_recommendation')->result_array();
			$this->template->load('layout/template', 'skpa/partisipan/recomendation', $data);
		} else {
			show_404();
		}
	}

	public function insert_recommendation()
	{
		if ($this->role == 'Dosen') {
			$p = $this->input->post();
			$p['dosen_id'] = $this->session->userdata('user_data')['id'];

			$this->db->insert('dosen_recommendation', $p);
			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil dimasukkan', 'success'));
			} else {
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-times"></i> Data gagal dimasukkan', 'danger'));
			}

			redirect('skpa/recommendation');
		} else {
			show_404();
		}
	}


	public function delete_recommendation($id)
	{
		if ($this->role == 'Dosen') {

			$this->db->where('id', $id)
				->delete('dosen_recommendation');

			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil dihapus', 'success'));
			} else {
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-times"></i> Data gagal dihapus', 'danger'));
			}

			redirect('skpa/recommendation');
		} else {
			show_404();
		}
	}

	public function change_status_recommendation($id)
	{
		if ($this->role == 'Dosen') {

			$cek = $this->db->where('id', $id)->get('dosen_recommendation')->row_array();

			if (!empty($cek)) {
				if ($cek['is_lock'] == '1') {
					$p['is_lock'] = '0';
				} else {
					$p['is_lock'] = '1';
				}

				$this->db->where('id', $id)->update('dosen_recommendation', $p);
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil diubah', 'success'));
			} else {
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-times"></i> ID Tidak Diketahui', 'danger'));
			}

			redirect('skpa/recommendation');
		} else {
			show_404();
		}
	}

	public function update_recommendation()
	{
		if ($this->role == 'Dosen') {
			$id = $this->input->post('id_rekomendasi');

			$this->db->where('id', $id)->update('dosen_recommendation', ['nama_rekomendasi' => $this->input->post('nama_rekomendasi')]);
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-times"></i> Data berhasil diubah', 'success'));


			redirect('skpa/recommendation');
		} else {
			show_404();
		}
	}

	public function update_komite()
	{
		if ($this->role == 'Superadmin') {
			$judul_id = $this->input->post('id_judul');
			$data['is_acc_2'] = $this->input->post('status');
			$data['waktu_acc_2'] = date('Y-m-d h:i:s');
			$data['catatan'] = $this->input->post('catatan');

			$this->partisipan_model->update_judul($data, $judul_id);
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-times"></i> Data berhasil diubah', 'success'));


			redirect('skpa/komite');
		} else {
			show_404();
		}
	}
}
