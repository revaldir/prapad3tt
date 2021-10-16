<?php
 
Class Transaksi_model extends CI_Model{

   protected $table = 'transaksi';
    
   public function get_data(){
      $this->db->select('*, pembelian.id AS pembelian_id');
      return $this->db->get($this->table)->result_array();
   }

   public function get_list_item($jenis, $id, $for = ''){

      if($jenis == 'perawatan'){
         $this->db->select('*, transaksi_perawatan.id AS transaksi_perawatan_id')
                  ->join('transaksi_perawatan', 'transaksi_perawatan.transaksi_id = transaksi.id')
                  ->join('perawatan', 'perawatan.id = transaksi_perawatan.perawatan_id');
      
      }else if($jenis == 'beban'){
         $this->db->select('*, transaksi_beban.id AS transaksi_beban_id')
                  ->join('transaksi_beban', 'transaksi_beban.transaksi_id = transaksi.id')
                  ->join('beban', 'beban.id = transaksi_beban.beban_id');

         if($for == 'jurnal'){
            $this->db->select('SUM(subtotal) AS coa_subtotal')
                     ->group_by('beban.coa_id');
         }
      
      }else if($jenis == 'gaji'){
         $this->db->join('transaksi_gaji', 'transaksi_gaji.transaksi_id = transaksi.id')
                  ->join('user', 'user.id = transaksi_gaji.karyawan_id');
      
      }else if($jenis == 'barang'){
         $this->db->select('*, transaksi_barang.id AS transaksi_barang_id')
                  ->join('transaksi_barang', 'transaksi_barang.transaksi_id = transaksi.id')
                  ->join('barang', 'barang.id = transaksi_barang.barang_id');

         if($for == 'jurnal'){
            $this->db->select('SUM(subtotal) AS coa_subtotal')
                     ->group_by('barang.tipe');
         }
      }

      $this->db->where("transaksi.id", $id);
      return $this->db->get($this->table)->result_array();
   }

   public function get_list_pembayaran($id){
      $this->db->where('pembelian_id', $id);
      return $this->db->get('pembelian_pembayaran')->result_array();
   }

   public function get_item_by_produk($jenis ,$transaksi_id, $produk_id){

      if($jenis == 'perawatan'){
         $this->db->select('*, perawatan.id AS perawatan_id, transaksi_perawatan.id AS transaksi_perawatan_id')
                  ->join('transaksi_perawatan', 'transaksi_perawatan.transaksi_id = transaksi.id')
                  ->join('perawatan', 'perawatan.id = transaksi_perawatan.perawatan_id')
                  ->where('perawatan.id', $produk_id)
                  ->where('transaksi.id', $transaksi_id);

      }else if($jenis == 'beban'){
         $this->db->select('*, beban.id AS beban_id, transaksi_beban.id AS transaksi_beban_id')
                  ->join('transaksi_beban', 'transaksi_beban.transaksi_id = transaksi.id')
                  ->join('beban', 'beban.id = transaksi_beban.beban_id')
                  ->where('beban.id', $produk_id)
                  ->where('transaksi.id', $transaksi_id);

      }else if($jenis == 'barang'){
         $this->db->select('*, barang.id AS barang_id, transaksi_barang.id AS transaksi_barang_id')
                  ->join('transaksi_barang', 'transaksi_barang.transaksi_id = transaksi.id')
                  ->join('barang', 'barang.id = transaksi_barang.barang_id')
                  ->where('barang.id', $produk_id)
                  ->where('transaksi.id', $transaksi_id);
      }
      
      return $this->db->get($this->table);
   }

   public function get_detail($key, $val = ''){

      $this->db->select('*, transaksi.id AS transaksi_id')
               ->join('pelanggan', 'pelanggan.id = transaksi.pelanggan_id', 'LEFT')
               ->join('user', 'user.id = transaksi.karyawan_id', 'LEFT');

      if(is_array($key)){
         $this->db->where($key);
      
      }else{
         $this->db->where($key, $val);
      }

      return $this->db->get($this->table);
   }

   public function last_data($jenis){
      $this->db->order_by('id','DESC')
               ->where('jenis', $jenis)
               ->limit(1);
      return $this->db->get($this->table)->row_array();
   }

   public function generate_code($jenis){
      $this->db->select('RIGHT(kode_transaksi,4) as kode', FALSE)
               ->order_by('kode_transaksi','DESC')
               ->where('jenis', $jenis)
               ->limit(1);    
      
      $query = $this->db->get($this->table);  
      if($query->num_rows() <> 0){
         $data = $query->row();      
         $kode = intval($data->kode) + 1;    
      }else{
         $kode = 1;    
      }

      if($jenis == 'beban'){
         $prefix = 'BBN';
      }else if($jenis == 'setoran'){
         $prefix = 'STR';
      }else if($jenis == 'pembelian'){
         $prefix = 'PMB';
      }else if($jenis == 'penggajian'){
         $prefix = 'PGJ';
      }else if($jenis == 'perawatan'){
         $prefix = 'RWT';
      }else if($jenis == 'penarikan'){
         $prefix = 'PNR';
      }else if($jenis == 'gaji'){
         $prefix = 'GJI';
      }else if($jenis == 'barang'){
         $prefix = 'BRG';
      }

      $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
      $code = "TRX-".$prefix."-".$kodemax;
      return $code;
   }

   public function insert($data){
      $this->db->insert($this->table, $data);

      if($this->db->affected_rows() > 0){
         return true;
      }
      return false;
   }

   public function insert_pembayaran($data){
      $this->db->insert('pembelian_pembayaran', $data);

      if($this->db->affected_rows() > 0){
         return true;
      }
      return false;
   }

   public function insert_item($jenis, $data){
      $this->db->insert('transaksi_'.$jenis, $data);

      if($this->db->affected_rows() > 0){
         return true;
      }
      return false;
   }

   public function insert_item_batch($data){
      $this->db->insert_batch('pembelian_detail', $data);

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

   public function update_item($jenis, $data, $id){
      $this->db->where('id', $id)
               ->update('transaksi_'.$jenis, $data);
      return true;
   }

   public function delete_item($jenis, $id){
      $this->db->where('id', $id)
               ->delete('transaksi_'.$jenis);

      if($this->db->affected_rows() > 0){
         return true;
      }
      return false;
   }

   public function get_total_price($jenis ,$id){
      $this->db->select('SUM(transaksi_'.$jenis.'.subtotal) AS total_harga')
               ->where('transaksi.id', $id)
               ->join('transaksi_'.$jenis,'transaksi_'.$jenis.'.transaksi_id = transaksi.id');

      if($jenis == 'perawatan'){
         $this->db->select('SUM(transaksi_perawatan.harga_diskon) AS total_diskon');
         return $this->db->get('transaksi')->row_array();
      
      }else{
         return $this->db->get('transaksi')->row_array()['total_harga'];
      }
   }

}
