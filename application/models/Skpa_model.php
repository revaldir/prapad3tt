<?php

class Skpa_model extends CI_Model
{

	protected $table = 'skpa';

	public function get_data()
	{
		return $this->db->get($this->table)->result_array();
	}

	public function get_detail($key, $val = '')
	{
		if (is_array($key)) {
			$this->db->where($key);
		} else {
			$this->db->where($key, $val);
		}

		return $this->db->get($this->table);
	}

	public function generate_code()
	{
		$this->db->select('RIGHT(kode_skpa,4) as kode', FALSE)
			->order_by('kode_skpa', 'DESC')
			->limit(1);

		$query = $this->db->get($this->table);
		if ($query->num_rows() <> 0) {
			$data = $query->row();
			$kode = intval($data->kode) + 1;
		} else {
			$kode = 1;
		}

		$kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
		$code = "PERIODE-" . $kodemax;
		return $code;
	}


	public function insert($data)
	{
		$this->db->insert($this->table, $data);

		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	public function update($data, $id)
	{
		$this->db->where('id', $id)
			->update($this->table, $data);
		return true;
	}

	public function delete($id)
	{
		$this->db->where('id', $id)
			->delete($this->table);

		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	public function get_next($id)
	{
		return $this->db->where('skpa_id', $id)->from('skpa_gelombang')->count_all_results() + 1;
	}

	public function insert_gelombang($data)
	{
		$this->db->insert('skpa_gelombang', $data);

		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	public function update_gelombang($data, $id)
	{
		$this->db->where('id', $id)
			->update('skpa_gelombang', $data);
		return true;
	}

	public function get_gelombang($id)
	{
		return $this->db->where('skpa_id', $id)->get('skpa_gelombang')->result_array();
	}

	public function insert_partisipan($data)
	{
		$this->db->insert('skpa_gelombang_daftar', $data);

		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	public function update_partisipan($data, $id)
	{
		$this->db->where('id', $id)
			->update('skpa_gelombang_daftar', $data);
		return true;
	}

	public function get_mahasiswa($id, $sum = false)
	{
		$this->db->select('*, skpa_gelombang_daftar.id AS skpa_gelombang_daftar_id,
						dosen1.kode_dosen AS kode_dosen1, dosen1.nama_dosen AS nama_dosen1,
						dosen2.kode_dosen AS kode_dosen2, dosen2.nama_dosen AS nama_dosen2,
						penguji.kode_dosen AS kode_penguji, penguji.nama_dosen AS nama_penguji')
			->join('skpa_gelombang', 'skpa_gelombang.id = skpa_gelombang_daftar.skpa_gelombang_id')
			->join('mahasiswa', 'mahasiswa.id = skpa_gelombang_daftar.mahasiswa_id')
			->join('dosen dosen1', 'dosen1.id = skpa_gelombang_daftar.pembimbing_1_id')
			->join('dosen dosen2', 'dosen2.id = skpa_gelombang_daftar.pembimbing_2_id', 'LEFT')
			->join('dosen penguji', 'penguji.id = skpa_gelombang_daftar.penguji_id', 'LEFT')
			->order_by('skpa_gelombang.gelombang', 'DESC')
			->order_by('skpa_gelombang_daftar.id', 'DESC');

		$q = $this->db->where('skpa_id', $id)->get('skpa_gelombang_daftar');
		if (!$sum) {
			return $q->result_array();
		} else {
			return $q->num_rows();
		}
	}

	public function get_active()
	{
		$this->db->select('*, skpa_gelombang.id AS skpa_gelombang_id, tanggal_judul_end AS tanggal_judul_end')
			->join('skpa', 'skpa.id = skpa_gelombang.skpa_id')
			->where('is_active', '1');
		return $this->db->get('skpa_gelombang')->row_array();
	}

	public function get_detail_gelombang_daftar($key, $val = '')
	{
		$this->db->select('*, skpa_gelombang_daftar.id AS skpa_gelombang_daftar_id,
						dosen1.kode_dosen AS kode_dosen1, dosen1.nama_dosen AS nama_dosen1,
						dosen2.kode_dosen AS kode_dosen2, dosen2.nama_dosen AS nama_dosen2,
						penguji.kode_dosen AS kode_penguji, penguji.nama_dosen AS nama_penguji')
			->join('skpa_gelombang', 'skpa_gelombang.id = skpa_gelombang_daftar.skpa_gelombang_id')
			->join('skpa', 'skpa.id = skpa_gelombang.skpa_id')
			->join('mahasiswa', 'mahasiswa.id = skpa_gelombang_daftar.mahasiswa_id')
			->join('dosen dosen1', 'dosen1.id = skpa_gelombang_daftar.pembimbing_1_id')
			->join('dosen dosen2', 'dosen2.id = skpa_gelombang_daftar.pembimbing_2_id', 'LEFT')
			->join('dosen penguji', 'penguji.id = skpa_gelombang_daftar.penguji_id', 'LEFT')
			->order_by('skpa_gelombang.gelombang', 'DESC')
			->order_by('skpa_gelombang_daftar.id', 'DESC');

		if (is_array($key)) {
			$this->db->where($key);
		} else {
			$this->db->where($key, $val);
		}

		return $this->db->get('skpa_gelombang_daftar');
	}

	public function get_skpa_options()
	{
		$this->db->select('*')
			->join('skpa_gelombang', 'skpa_gelombang.skpa_id = skpa.id');
		return $this->db->get('skpa');
	}

	public function get_inactive_gelombang($id)
	{
		return $this->db->where('skpa_id', $id)->where('is_active', '0')->get('skpa_gelombang')->result_array();
	}

	public function get_berkas_nama($skpa_id, $skpa_gelombang_id)
	{
		$this->db->select('tahun, kode_skpa, gelombang, file_judul, file_seminar, file_revisi, nim')
			->join('skpa_gelombang', 'skpa_gelombang.skpa_id = skpa.id')
			->join('skpa_gelombang_daftar', 'skpa_gelombang_daftar.skpa_gelombang_id = skpa_gelombang.id')
			->join('pengajuan_judul', 'pengajuan_judul.skpa_gelombang_daftar_id = skpa_gelombang_daftar.id')
			->join('mahasiswa', 'mahasiswa.id = skpa_gelombang_daftar.mahasiswa_id')
			->where('skpa.id', $skpa_id)
			->where('skpa_gelombang.id', $skpa_gelombang_id);
		return $this->db->get($this->table)->result_array();
	}

	public function backup_skpa_gelombang($data, $id)
	{
		$this->db->where('id', $id)
			->update('skpa_gelombang', $data);
		return true;
	}
}
