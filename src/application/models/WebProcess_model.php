<?php
class webProcess_model extends CI_Model {

   public function getProcessHistory($history_id){
      $this->db->select("*"); 
      $this->db->where("web_process_history_id",$history_id); 
      $sorgu=$this->db->get("web_process_history");      
      return $sorgu->result_array();
    }
    
    public function getProcessHistoryFirmID($firm_id){
      $this->db->select("*"); 
      $this->db->where("firm_id",$firm_id); 
      $sorgu=$this->db->get("web_process_history");      
      return $sorgu->result_array();
    }
       // history duzenleme
    public function getWebProcessHistory($firm_id){
       $_SQL = "SELECT w.web_process_history_id, w.firm_id, w.process_type_id,concat(u.name,' ',u.surname) user_name,
           t.processtype_txt, w.process_explanation_txt, w.process_dt, w.record_status, w.process_user_id, w.firm_web_package_id FROM  
           web_process_history w  inner join prt_process_types t on t.gruptipi_id=12 and t.processtype_id=w.process_type_id and 
           w.record_status=1 and t.record_status=1 inner join users u on u.user_id=w.process_user_id
           where w.firm_id=".$firm_id;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    
    }
     public function getProcessTypes(){
      $this->db->select("*"); 
      $this->db->where("gruptipi_id",12); 
      $sorgu=$this->db->get("prt_process_types");      
      return $sorgu->result_array();
    }
     public function checkWebPackage($firm_id){
      $this->db->select("*"); 
      $this->db->where("firm_id",$firm_id); 
      $sorgu=$this->db->get("frm_web_package");      
      return $sorgu->result_array();
    }
      public function checkWebCostInvoice($firm_id){
      $this->db->select("*"); 
      $this->db->where("invoice_group_id",3); 
      $this->db->where("create_invoice_status",0); 
      $this->db->where("firm_id",$firm_id); 
      $sorgu=$this->db->get("firm_ourservices_cost");      
      return $sorgu->result_array();
    }
    public function checkWebProcess($firm_id){
      $this->db->select("*"); 
      $this->db->where("firm_id",$firm_id); 
      $this->db->where("process_type_id",9); 
      $sorgu=$this->db->get("web_process_history");      
      return $sorgu->result_array();
    }
    
    
}



