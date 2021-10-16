<?php
 
Class Fakultas_model extends CI_Model{

   protected $table = 'fakultas';
    
   public function get_data(){
       $this->db->select('fakultas.*, COUNT(fakultas_jurusan.id) AS total_jurusan')
                ->join('fakultas_jurusan', 'fakultas_jurusan.fakultas_id = fakultas.id', 'LEFT')
                ->group_by('fakultas.id');

      return $this->db->get($this->table)->result_array();
   }

   public function get_detail($key, $val = ''){
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

   public function generate_code(){
      $this->db->select('RIGHT(kode_fakultas,4) as kode', FALSE)
               ->order_by('kode_fakultas','DESC')
               ->limit(1);    
      
      $query = $this->db->get($this->table);  
      if($query->num_rows() <> 0){
         $data = $query->row();      
         $kode = intval($data->kode) + 1;    
      }else{
         $kode = 1;    
      }

      $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
      $code = "FKS-".$kodemax;
      return $code;
   }

   public function get_jurusan($id){
      $this->db->select('fakultas_jurusan.*, jurusan.kode_jurusan, jurusan.nama_jurusan')
               ->where('fakultas_id', $id)
               ->join('jurusan', 'jurusan.id = fakultas_jurusan.jurusan_id');
      return $this->db->get('fakultas_jurusan')->result_array();
   }

   public function insert_jurusan($data){
      $this->db->insert('fakultas_jurusan', $data);

      if($this->db->affected_rows() > 0){
         return true;
      }
      return false;
   }

   public function delete_jurusan($id){
      $this->db->where('id', $id)
               ->delete('fakultas_jurusan');

      if($this->db->affected_rows() > 0){
         return true;
      }
      return false;
   }

}
