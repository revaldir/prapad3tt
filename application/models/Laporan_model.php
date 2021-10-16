<?php
 
Class Laporan_model extends CI_Model{
    
   public function get_jurnal($req = array()){

      $waktu = ''; $coa_id = '';

      if(isset($req['start'])){
         $this->db->where('tgl_jurnal >=', $req['start'])
                  ->where('tgl_jurnal <=', $req['end']);
      
      }

      if(isset($req['bulan'])){
         $this->db->where('MONTH(tgl_jurnal)', $req['bulan'])
                  ->where('YEAR(tgl_jurnal)', $req['tahun']);
         $waktu = $req['tahun'].'-'.$req['bulan'].'-01';
      }

      if(isset($req['coa_id'])){
         if($req['coa_id'] != 'all'){
            $this->db->where('coa_id', $req['coa_id']);
            $coa_id = $req['coa_id'];
         }
      }

      $this->db->order_by('jurnal.id', 'ASC')
               ->join('coa','coa.id = jurnal.coa_id');

      return [
         'list' => $this->db->get('jurnal')->result_array(),
         'saldo_awal' => $this->get_saldo_awal($waktu, $coa_id)
      ];
   }

      private function get_saldo_awal($waktu, $coa_id){
         $debit  = $this->_saldo('debit', $waktu, $coa_id);
         $kredit = $this->_saldo('kredit', $waktu, $coa_id);

         return $debit - $kredit;
      }

      private function _saldo($tipe, $waktu, $coa_id){
         $this->db->select('SUM(nominal) AS nominal')
                  ->where('posisi', $tipe)
                  ->where('coa_id', $coa_id)
                  ->where('tgl_jurnal <', $waktu);

         return $this->db->get('jurnal')->row_array()['nominal'];
      }

}
