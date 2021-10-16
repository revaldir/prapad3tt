<?php
 
Class Partisipan_model extends CI_Model{

   protected $table = 'skpa_gelombang_daftar';
    
   public function get_data(){
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
      return $this->db->get($this->table)->result_array();
   }

   public function get_detail($key, $val = ''){
      $this->db->select('*, mahasiswa.no_telp AS m_telp, skpa_gelombang_daftar.id AS skpa_gelombang_daftar_id,
                         dosen1.kode_dosen AS kode_dosen1, dosen1.nama_dosen AS nama_dosen1,
                         dosen2.kode_dosen AS kode_dosen2, dosen2.nama_dosen AS nama_dosen2,
                         penguji.kode_dosen AS kode_penguji, penguji.nama_dosen AS nama_penguji')
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

  public function insert_judul($data){
      $this->db->insert('pengajuan_judul', $data);

      if($this->db->affected_rows() > 0){
         return true;
      }
      return false;
  }

  public function update_judul($data, $id){
      $this->db->where('id', $id)
               ->update('pengajuan_judul', $data);
      return true;
   }

  public function get_judul($partisipan_id){
    $this->db->select('*, pengajuan_judul.id AS pengajuan_judul_id')
             ->where('skpa_gelombang_daftar_id', $partisipan_id);
    return $this->db->get('pengajuan_judul')->result_array();
  }

  public function get_judul_last($partisipan_id){
    $this->db->select('*, pengajuan_judul.id AS pengajuan_judul_id, pengajuan_judul.catatan AS catatan')
             ->where('skpa_gelombang_daftar_id', $partisipan_id)
             ->order_by('id', 'DESC');
    return $this->db->get('pengajuan_judul')->row_array();
  }

  public function get_comment($judul_id, $dosen_id = ''){
    $this->db->where('pengajuan_judul_id', $judul_id)
             ->order_by('waktu_comment', 'DESC')
             ->join('dosen', 'dosen.id = pengajuan_judul_comment.dosen_id');

    if($dosen_id != ''){
      $this->db->where('dosen.id', $dosen_id);
    }

    $this->db->order_by('waktu_comment', 'DESC');
    return $this->db->get('pengajuan_judul_comment')->result_array();
  }

  public function get_by_judul_id($judul_id, $dosen_id = ''){
    $this->db->select('*, mahasiswa.no_telp AS m_telp, pengajuan_judul.id AS pengajuan_judul_id,
                         skpa_gelombang_daftar.id AS skpa_gelombang_daftar_id,
                         dosen1.kode_dosen AS kode_dosen1, dosen1.nama_dosen AS nama_dosen1,
                         dosen2.kode_dosen AS kode_dosen2, dosen2.nama_dosen AS nama_dosen2,
                         penguji.kode_dosen AS kode_penguji, penguji.nama_dosen AS nama_penguji')
               ->join('pengajuan_judul', 'pengajuan_judul.skpa_gelombang_daftar_id = skpa_gelombang_daftar.id')
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
               ->order_by('skpa_gelombang_daftar.id', 'DESC')
               ->where('pengajuan_judul.id', $judul_id);

    if($dosen_id != ''){
      $this->db->group_start();
        $this->db->where('dosen1.id', $dosen_id)
                 ->or_where('dosen2.id', $dosen_id)
                 ->or_where('penguji.id', $dosen_id);
      $this->db->group_end();
    }
  
    return $this->db->get($this->table)->row_array();
  }

  public function get_data_by_gelombang($gelombang_id){
     $this->db->select('*, pengajuan_judul.id AS pengajuan_judul_id,
                         skpa_gelombang_daftar.id AS skpa_gelombang_daftar_id,
                         dosen1.kode_dosen AS kode_dosen1, dosen1.nama_dosen AS nama_dosen1,
                         dosen2.kode_dosen AS kode_dosen2, dosen2.nama_dosen AS nama_dosen2,
                         penguji.kode_dosen AS kode_penguji, penguji.nama_dosen AS nama_penguji')
               ->join('pengajuan_judul', 'pengajuan_judul.skpa_gelombang_daftar_id = skpa_gelombang_daftar.id')
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
               ->order_by('skpa_gelombang_daftar.id', 'DESC')
               ->where('skpa_gelombang_id', $gelombang_id);

    return $this->db->get($this->table);
  }

  public function get_detail_judul($key, $val = '', $revisi = false){
     $this->db->select('*, pengajuan_judul.id AS pengajuan_judul_id,
						 pengajuan_judul.catatan AS catatan,
                         skpa_gelombang_daftar.id AS skpa_gelombang_daftar_id,
                         dosen1.kode_dosen AS kode_dosen1, dosen1.nama_dosen AS nama_dosen1,
                         dosen2.kode_dosen AS kode_dosen2, dosen2.nama_dosen AS nama_dosen2,
                         penguji.kode_dosen AS kode_penguji, penguji.nama_dosen AS nama_penguji')
               ->join('pengajuan_judul', 'pengajuan_judul.skpa_gelombang_daftar_id = skpa_gelombang_daftar.id')
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

    if($revisi){
      $find = [
        'is_acc_3'  => '1',
        'is_revisi_acc' => '1'
      ];
      $this->db->or_group_start()
                ->where($find)
               ->group_end();

    }

    return $this->db->get($this->table);
  }

}
