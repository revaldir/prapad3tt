<?php
 
Class User_model extends CI_Model{

   protected $table = 'user';
    
   public function get_data(){
      return $this->db->get($this->table);
   }

   public function get_detail($key, $val = ''){
      if(is_array($key)){
         $this->db->where($key);
      
      }else{
         $this->db->where($key, $val);
      }

      return $this->db->get($this->table);
   }
}
