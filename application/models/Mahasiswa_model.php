<?php

class Mahasiswa_model extends CI_Model
{

	protected $table = 'mahasiswa';

	public function get_data()
	{
		$this->db->select('mahasiswa.*, jurusan.nama_jurusan, fakultas.nama_fakultas, angkatan.nama_angkatan, angkatan_kelas.nama_kelas')
			->join('angkatan', 'angkatan.id = mahasiswa.angkatan_id')
			->join('angkatan_kelas', 'angkatan_kelas.id = mahasiswa.kelas_id')
			->join('jurusan', 'jurusan.id = mahasiswa.jurusan_id')
			->join('fakultas_jurusan', 'fakultas_jurusan.jurusan_id = jurusan.id', 'LEFT')
			->join('fakultas', 'fakultas.id = fakultas_jurusan.fakultas_id', 'LEFT');
		return $this->db->get($this->table)->result_array();
	}

	public function get_detail($key, $val = '')
	{
		$this->db->select('mahasiswa.*, jurusan.nama_jurusan, fakultas.nama_fakultas, angkatan.nama_angkatan')
			->join('angkatan', 'angkatan.id = mahasiswa.angkatan_id')
			->join('jurusan', 'jurusan.id = mahasiswa.jurusan_id')
			->join('fakultas_jurusan', 'fakultas_jurusan.jurusan_id = jurusan.id', 'LEFT')
			->join('fakultas', 'fakultas.id = fakultas_jurusan.fakultas_id', 'LEFT');
		if (is_array($key)) {
			$this->db->where($key);
		} else {
			$this->db->where($key, $val);
		}

		return $this->db->get($this->table);
	}

	public function generate_code()
	{
		$this->db->select('RIGHT(kode_plg,4) as kode', FALSE)
			->order_by('kode_plg', 'DESC')
			->limit(1);

		$query = $this->db->get($this->table);
		if ($query->num_rows() <> 0) {
			$data = $query->row();
			$kode = intval($data->kode) + 1;
		} else {
			$kode = 1;
		}

		$kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
		$code = "PLG-" . $kodemax;
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
}
