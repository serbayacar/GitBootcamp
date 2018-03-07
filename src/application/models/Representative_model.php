<?php defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * this model for representative controller
 */

class representative_model extends CI_Model {
    
    // for representative page, all messages are brought for right side
     public function getAllMessages(){
                
        $_SQL = "SELECT `mesage_id`, `message_txt`, `message_dt`, `expire_dt`, "
                . "`mesage_type_id`, `message_user_id`, `message_status`, "
                . "`explanation`, `country_kd`, `city_kd`, `record_status` "
                . "FROM `all_mesage`"
                . "WHERE expire_dt >=curdate() and message_user_id=0";
       
        $query = $this->db->query($_SQL);
        return $query->result_array();
        
      }
   // for representative page, all messages for this user are brought 
   // for right bottom side
     public function getPrivateMessages($user_id){
                
        $_SQL = "SELECT `mesage_id`, `message_txt`, `message_dt`, `expire_dt`, "
                . "`mesage_type_id`, `message_user_id`, `message_status`, "
                . "`explanation`, `country_kd`, `city_kd`, `record_status` "
                . "FROM `all_mesage`"
                . "WHERE expire_dt >=curdate() and message_user_id=".$user_id;
       
        $query = $this->db->query($_SQL);
        return $query->result_array();
        
      }
      
      // for representative page, all messages for this user are brought 
      // according to  
     public function getCountryMessages($country_kd){
                
        $_SQL = "SELECT `mesage_id`, `message_txt`, `message_dt`, `expire_dt`, "
                . "`mesage_type_id`, `message_user_id`, `message_status`, "
                . "`explanation`, `country_kd`, `city_kd`, `record_status` "
                . "FROM `all_mesage`"
                . "WHERE expire_dt >=curdate() and country_kd=".$country_kd;
       
        $query = $this->db->query($_SQL);
        return $query->result_array();
        
      }
   
    // for representative page, get count firm by userid
     public function getCountFirmbyUserId($user_id){
                
        $_SQL = "SELECT count(firm_id) count FROM `firm` wHERE record_status =1 and `representive_id`=".$user_id;
       
        $query = $this->db->query($_SQL);
        return $query->result_array();
        
      }
      
       // for representative page, get count firm by userid
     public function getCountPrivateMessagebyUserId($user_id){
                
        $_SQL = "SELECT count(mesage_id) count FROM `all_mesage` wHERE record_status =1 and expire_dt >= current_date and `message_user_id`=".$user_id;
       
        $query = $this->db->query($_SQL);
        return $query->result_array();
        
      }
      
      
    public function getSupportMessages($user_id){
        $_SQL = "SELECT mi.mail_info_id,mc.mail_content_id,f.name_txt,mc.mail_content_txt,mt.message_type_id,mt.message_type_txt,mpri.message_priority_txt
                FROM `mail_info` mi
                inner join mail_content mc on mi.mail_content_id=mc.mail_content_id and mc.record_status=1 and mi.record_status=1 and mc.mail_type_id = 3
                inner join firm f on mi.from_firm=f.firm_id
                inner join message_types mt on mt.message_type_id=mi.mail_send_type and mt.record_status=1
                inner join message_priority mpri on mpri.messagepriority_id=mi.message_priority and mpri.record_status=1
                where mc.record_status=1 and  mi.to_user = ".$user_id." and mi.mail_send_type =3";

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
    
    public function getPrivateMessagesforRepresentative($user_id){
        $_SQL = "Select mi.mail_info_id,mi.mail_content_id,mc.mail_content_txt,concat(u.name,' ',u.surname) from_name,mt.message_type_id,mt.message_type_txt from mail_info mi 
                inner join mail_content mc on mc.mail_content_id=mi.mail_content_id and mc.record_status=1
                inner join users u on u.user_id=mi.from_user and u.record_status=1

                inner join message_types mt on mt.message_type_id=mi.mail_send_type and mt.record_status=1

                where mi.record_status=1 and not mi.from_user=".$user_id."  and mi.from_firm=0";

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
   
    
    
}


