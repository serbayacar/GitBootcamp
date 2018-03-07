<?php
Class User extends CI_Model
{
 function login($username, $password)
 {
   $this -> db -> select('user_id id, email AS username, password');
   $this -> db -> from('users');
   $this -> db -> where('email', $username);
   $this -> db -> where('password', $password);
   $this -> db -> limit(1);
   $query = $this -> db -> get();
   return $query->result_array();
   
 }
  function getAllUserInfobyUserId($user_id){
       $_SQL = "SELECT u.*,ilt.phone,ilt.mobile_phone,ilt.fax,il.email,il.ort,il.webpage,il.facebook,il.instagram,il.adress,il.twitter,pt.path 
        FROM users u inner join iletisim il on il.user_id=u.user_id 
         inner join iletisim_tel ilt on ilt.iletisim_id=il.iletisim_id 
        and il.record_status=1 and ilt.record_status=1 and u.record_status=1 and u.user_id=" . $user_id.
        " left outer join photos pt on pt.user_id=u.user_id ";
       

        $query = $this->db->query($_SQL);
        return $query->result_array();
    
  }
  function getAutorization($user_id){
       $_SQL = "SELECT g.group_id from user_grup g where g.record_status=1 and g.user_id=" . $user_id;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    
  }
  
   function saveLoginConnection() {
       $dateTime = date('Y-m-d H:i:s');
        if ( !empty( $_SERVER['HTTP_CLIENT_IP'] ) ) { //check ip from share internet
                $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif ( !empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) { // to check ip is pass from proxy, also could be used ['HTTP_X_REAL_IP ']
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
                $ip = $_SERVER['REMOTE_ADDR'];
        }
        $sess_array = array();
        $sess_array["ip"]= $ip;
        $sess_array["userid"]=$this->session->userdata('user_id');
        $sess_array["login_dt"]=$dateTime;
           
       $this->generalChangeProcess_model->insertTables('connect',$sess_array);
  }
  function saveLogoutConnection() {
        $dateTime = date('Y-m-d H:i:s');
        if ( !empty( $_SERVER['HTTP_CLIENT_IP'] ) ) { //check ip from share internet
                $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif ( !empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) { // to check ip is pass from proxy, also could be used ['HTTP_X_REAL_IP ']
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
                $ip = $_SERVER['REMOTE_ADDR'];
        }
        $sess_array = array();
        $sess_array["ip"]= $ip;
        $sess_array["userid"]=$this->session->userdata('user_id');
        $sess_array["login_dt"]=date('Y-m-d H:i:s'); //null //login_dt nereden geldiği belli değil
        $sess_array["logout_dt"]=$dateTime;
           
       $this->generalChangeProcess_model->insertTables('connect',$sess_array);
  }
}
