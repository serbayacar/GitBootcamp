<?php
class message_model extends CI_Model {

    // message brought from all_message  table
    public function getMessagesStatus($county_kd){
        $_SQL = "SELECT `message_status_id`, `message_status_txt`, `record_status`, `insert_user_id`, `insert_dt`,"
                . " `update_user_id`, `update_dt`, `county_kd` FROM `message_status` where record_status=1 and county_kd =".$county_kd;

        $query = $this->db->query($_SQL);
        return $query->result_array();

        
    }
     public function getMessagesPriority(){
        $_SQL = "SELECT `messagepriority_id`, `message_priority_txt`, `icon_type`, `icon_color`, `record_status`, `insert_user_id`, `insert_dt`, "
                . "`update_user_id`, `update_dt` FROM `message_priority` WHERE record_status=1";

        $query = $this->db->query($_SQL);
        return $query->result_array();

        
    }
       public function getMessageTypes(){
        $_SQL = "SELECT `message_type_id`, `message_type_txt`, `record_status`, `insert_user_id`, "
                . "`insert_dt`, `update_user_id`, `update_dt` FROM `message_types` WHERE record_status=1";

        $query = $this->db->query($_SQL);
        return $query->result_array();

        
    }
        public function getInactiveMessage($county_kd){
        $_SQL = "SELECT a.`mesage_id`, a.`message_txt`, a.`message_dt`, a.`expire_dt`, a.`mesage_type_id`, a.`message_user_id`, a.`message_status`, a.`explanation`, a.`country_kd`, a.`city_kd`, a.`messagepriority_id`  , p.message_priority_txt,
                t.message_type_txt,s.message_status_txt
                FROM all_mesage a
                inner join message_priority p on p.messagepriority_id=a.messagepriority_id and a.record_status=1
                inner join message_types t on t.message_type_id=a.mesage_type_id
                inner join message_status s on s.message_status_id=a.message_status
                where a.expire_dt<curdate() and a.country_kd=".$county_kd;

        $query = $this->db->query($_SQL);
        return $query->result_array();

        
        }
         public function getActiveMessage($county_kd){
       $_SQL = "SELECT a.`mesage_id`, a.`message_txt`, a.`message_dt`, a.`expire_dt`, a.`mesage_type_id`, a.`message_user_id`, a.`message_status`, a.`explanation`, a.`country_kd`, a.`city_kd`, a.`messagepriority_id`  , p.message_priority_txt,
                t.message_type_txt,s.message_status_txt
                FROM all_mesage a
                inner join message_priority p on p.messagepriority_id=a.messagepriority_id and a.record_status=1
                inner join message_types t on t.message_type_id=a.mesage_type_id
                inner join message_status s on s.message_status_id=a.message_status
                where a.expire_dt>=curdate() and a.country_kd=".$county_kd." order by a.message_dt desc" ;
       
        $query = $this->db->query($_SQL);
        return $query->result_array();

       }
              public function getMessage($message_id){
       $_SQL = "SELECT a.`mesage_id`, a.`message_txt`, a.`message_dt`, a.`expire_dt`, a.`mesage_type_id`, a.`message_user_id`, a.`message_status`, a.`explanation`, a.`country_kd`, a.`city_kd`, a.`messagepriority_id`  , p.message_priority_txt,
                t.message_type_txt,s.message_status_txt
                FROM all_mesage a
                inner join message_priority p on p.messagepriority_id=a.messagepriority_id and a.record_status=1
                inner join message_types t on t.message_type_id=a.mesage_type_id
                inner join message_status s on s.message_status_id=a.message_status
                where a.mesage_id=".$message_id;
       
        $query = $this->db->query($_SQL);
        return $query->result_array();

       }
    
}

