<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class forgetpassword_model extends CI_Model {

    
    function forgetPasswordGetUserId($encrypted_code){
        $this->db->select("*");
        $this->db->where("key_forget",$encrypted_code);
        $this->db->where("used",1);
        $sorgu=$this->db->get("forget_password");
        return $sorgu;
    }
    
    function getUserIdforForgetPassword($email){
       $this->db->select("user_id");
       $this->db->where("email",$email);
       $sorgu=$this->db->get("users");
       return $sorgu;
    }
    
}
