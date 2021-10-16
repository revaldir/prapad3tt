<?php
 
Class Judul_model extends CI_Model{

   protected $table = 'pengajuan_judul';

   public function get_detail($key, $val = ''){
      $this->db->select('*, pengajuan_judul.id AS pengajuan_judul_id, skpa_gelombang_daftar.id AS skpa_gelombang_daftar_id,
                         dosen1.kode_dosen AS kode_dosen1, dosen1.nama_dosen AS nama_dosen1,
                         dosen2.kode_dosen AS kode_dosen2, dosen2.nama_dosen AS nama_dosen2,
                         penguji.kode_dosen AS kode_penguji, penguji.nama_dosen AS nama_penguji')
               ->join('skpa_gelombang_daftar', 'skpa_gelombang_daftar.id = pengajuan_judul.skpa_gelombang_daftar_id')
               ->join('skpa_gelombang', 'skpa_gelombang.id = skpa_gelombang_daftar.skpa_gelombang_id')
               ->join('skpa', 'skpa.id = skpa_gelombang.skpa_id')
               ->join('mahasiswa', 'mahasiswa.id = skpa_gelombang_daftar.mahasiswa_id')
               ->join('jurusan', 'jurusan.id = mahasiswa.jurusan_id', 'LEFT')
               ->join('fakultas_jurusan', 'fakultas_jurusan.jurusan_id = jurusan.id', 'LEFT')
               ->join('fakultas', 'fakultas.id = fakultas_jurusan.fakultas_id', 'LEFT')
               ->join('dosen dosen1', 'dosen1.id = skpa_gelombang_daftar.pembimbing_1_id')
               ->join('dosen dosen2', 'dosen2.id = skpa_gelombang_daftar.pembimbing_2_id', 'LEFT')
               ->join('dosen penguji', 'penguji.id = skpa_gelombang_daftar.penguji_id', 'LEFT')
               ->order_by('skpa_gelombang.gelombang', 'DESC')
               ->order_by('skpa_gelombang_daftar.id', 'DESC');

      if(is_array($key)){
         $this->db->where($key);
      
      }else{
         $this->db->where($key, $val);
      }

      return $this->db->get($this->table);
   }


   public function insert($data){
      $this->db->insert($this->table, $data);

      if($this->db->affected_rows() > 0){
         return true;
      }
      return false;
   }

   public function update($data, $id){
      $this->db->where('id', $id)
               ->update($this->table, $data);
      return true;
   }

   public function delete($id){
      $this->db->where('id', $id)
               ->delete($this->table);

      if($this->db->affected_rows() > 0){
         return true;
      }
      return false;
   }

   public function insert_comment($data){
      $this->db->insert('pengajuan_judul_comment', $data);

      if($this->db->affected_rows() > 0){
         return true;
      }
      return false;
   }

   public function update_comment($data, $id){
      $this->db->where('id', $id)
               ->update('pengajuan_judul_comment', $data);
      return true;
   }

   public function delete_comment($id){
      $this->db->where('id', $id)
               ->delete('pengajuan_judul_comment');

      if($this->db->affected_rows() > 0){
         return true;
      }
      return false;
   }

   public function get_change($judul_id){
    $this->db->select('*,pengajuan_judul_change.id AS change_id, dosen_prev.id AS dosen_prev_id, dosen_prev.kode_dosen AS kode_dosen_prev, dosen_prev.nama_dosen AS nama_dosen_prev, dosen_next.id AS dosen_next_id, dosen_next.kode_dosen AS kode_dosen_next, dosen_next.nama_dosen AS nama_dosen_next')
             ->join('dosen dosen_prev', 'dosen_prev.id = pengajuan_judul_change.dosen_prev_id')
             ->join('dosen dosen_next', 'dosen_next.id = pengajuan_judul_change.dosen_next_id', 'LEFT');
    return $this->db->get('pengajuan_judul_change')->result_array();
   }
}
