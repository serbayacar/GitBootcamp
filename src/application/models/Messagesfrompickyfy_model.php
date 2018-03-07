<?php defined('BASEPATH') OR exit('No direct script access allowed');

class messagesfrompickyfy_model extends CI_Model {

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
                
        $_SQL = "SELECT a.*,m.icon_type,m.icon_color,m.message_priority_txt FROM `all_mesage` a inner join message_priority m ".
                " on m.messagepriority_id=a.messagepriority_id and a.expire_dt > current_date and a.message_user_id=".$user_id;
        $query = $this->db->query($_SQL);
        return $query->result_array();
        
      }
      
      // for representative page, all messages for this user are brought 
      // according to  
     public function getCountryMessages($country_kd){
                
        $_SQL = "SELECT a.*,m.icon_type,m.icon_color,m.message_priority_txt "
                . "FROM `all_mesage` a "
                . "inner join message_priority m "
                . "on m.messagepriority_id=a.messagepriority_id and a.expire_dt > current_date "
                . "and a.mesage_type_id=2 and a.country_kd=".$country_kd;
       
        $query = $this->db->query($_SQL);
        return $query->result_array();
        
      }  

}