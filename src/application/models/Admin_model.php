<?php
class admin_model extends CI_Model {
       
     public function getSupportMessagesforAdmin($user_id){
        $_SQL = "SELECT mi.mail_info_id,mc.mail_content_id,concat(u.name,' ',u.surname) from_name,mc.mail_content_txt,mt.message_type_id,mt.message_type_txt,mpri.message_priority_txt
                FROM `mail_info` mi
                inner join mail_content mc on mi.mail_content_id=mc.mail_content_id and mc.record_status=1 and mi.record_status=1 and mc.mail_type_id = 3
                inner join users u on mi.from_user=u.user_id and u.record_status=1
                inner join message_types mt on mt.message_type_id=mi.mail_send_type and mt.record_status=1
                   inner join message_priority mpri on mpri.messagepriority_id=mi.message_priority and mpri.record_status=1
                where mc.record_status=1 and  mi.to_user = ".$user_id." and mi.from_firm=0 and mi.mail_send_type =3";

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
    
    public function getPrivateMessagesforAdmin($user_id){
        $_SQL = "SELECT mi.mail_info_id,mc.mail_content_id,concat(u.name,' ',u.surname) from_name,mc.mail_content_txt,mi.from_user,mi.to_user
                FROM `mail_info` mi
                inner join mail_content mc on mi.mail_content_id=mc.mail_content_id and mc.record_status=1 and mi.record_status=1 and mc.mail_type_id = 2
                inner join users u on mi.from_user=u.user_id and u.record_status=1
                inner join message_types mt on mt.message_type_id=mi.mail_send_type and mt.record_status=1
                   
                where mc.record_status=1 and  mi.to_user = ".$user_id." and mi.from_firm=0";

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
    
}
   