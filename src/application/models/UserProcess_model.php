<?php
class userProcess_model extends CI_Model {

    // user info brought from users  table
    public function getUserInfobyUserId($user_id){
      $this->db->select("*"); 
      $sorgu=$this->db->get("users");      
      return $sorgu->result_array();
    }
    // user's country code  brought from users table  
    public function getUserCountrybyUserId($user_id){
      $this->db->select("county_kd"); 
      $sorgu=$this->db->get("users");      
      return $sorgu->result_array();
    }
    public function getUserLanguage($country_kd){
      $this->db->select("*"); 
      $this->db->select("country_kd",$country_kd);
      $sorgu=$this->db->get("prt_portal_language");      
      return $sorgu->result_array();
    }
    
      public function getUserGroup($user_id){
       $_SQL = "select g.group_id from user_grup g 
            where g.group_id in(1,2,5) and g.user_id= ".$user_id;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    
    }
    
       // user info brought from users  table
    public function getAllUserInfobyUserId($user_id){
       $_SQL = "SELECT u.*,ilt.phone,ilt.mobile_phone,ilt.fax,il.email,il.ort,il.webpage,il.facebook,il.instagram,il.adress,il.twitter,pt.path , "
               . "b.bank_id,b.country_kd bank_country_kd,b.acount_iban,b.city_kd bank_city_kd,b.BIC FROM users u inner join iletisim il on il.user_id=u.user_id and il.record_status=1 and u.record_status=1 and u.user_id= ".$user_id.
                " inner join iletisim_tel ilt on ilt.iletisim_id=il.iletisim_id and ilt.record_status=1 and il.record_status=1 and ilt.record_status=1 "
               . " and u.record_status=1 left outer join photos pt on pt.user_id=u.user_id left outer join user_bank_account b on b.user_id=u.user_id "
               . " and b.record_status=1 ";

        $query = $this->db->query($_SQL);
        return $query->result_array();
    
    }
        public function getUsersbyType($country_kd,$city_kd,$type){
       $_SQL = "select * from users u inner join user_grup mu on mu.user_id=u.user_id and u.record_status=1
        and u.country_kd=".$country_kd." and u.city_kd=".$city_kd." and  mu.group_id= ".$type;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    
    }
    
      public function getMenubyUserId($user_id){
        $_SQL = "  SELECT m.menu_id,m.ust_menu_id,ml.name,m.menu_url,m.menu_icon,(select count(mn.menu_id) from menu mn inner join menu_user mun on mun.menu_id=mn.menu_id and mn.record_status=1"
                . " and mun.record_status=1 inner join user_grup gr on gr.group_id=mun.group_id and gr.record_status=1 and gr.user_id=".$user_id.") count "
                . "FROM menu m inner join "
                . "menu_languages ml on ml.menu_id=m.menu_id and ml.language_id=112 and m.record_status=1 inner join menu_user mu on mu.menu_id=m.menu_id "
                . "and mu.record_status=1 inner join user_grup g on g.group_id=mu.group_id and g.record_status=1 and g.user_id=".$user_id." order by m.menu_order";

        $query = $this->db->query($_SQL);
        return $query->result_array();;

    }
    
     public function getUserGroupbyUserid($user_id){
       $_SQL = "SELECT pg.group_id,pg.grup_name_txt,u.user_group_id,u.record_status FROM prt_user_grup pg left outer join user_grup u on u.group_id=pg.group_id and pg.record_status=1 and
                 u.user_id=" . $user_id ;
       

        $query = $this->db->query($_SQL);
        return $query->result_array();
    
    }
    public  function getAllprofileData($user_id)
    {
       $this->load->model("userProcess_model");
       $this->load->model("message_model");
       $this->load->model("representative_model");
      
        //$data["data"]=$this->userProcess_model->getAllUserInfobyUserId($user_id);
        $data["messages"]=$this->message_model->getMessagesbyTypeId(2);
        $data["messagespri"]=$this->message_model->getMessagesbyTypeId(1);
        $data["counts"]=$this->representative_model->getCountFirmbyUserId($user_id);
        $data["countmessage"]=$this->representative_model->getCountPrivateMessagebyUserId($user_id);
       return $data;
    }
    
    public function getAllUserCountsbyUserId($user_id){
       $_SQL = "SELECT count(a.firm_id) countfirm,count(e.firm_event_id) countevent,count(td.ticket_id) countticket,count(f.firm_id) countweb FROM firm a 
            left outer join firm_event e on e.firm_id=a.firm_id and e.record_status=1
            left outer join firm_ticket_durumu td on td.firm_id=a.firm_id and td.record_status=1
            left outer join firm f on f.firm_id=a.firm_id and f.web_status=1
            wHERE a.record_status =1 and a.representive_id= ".$user_id;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    
    }
     public function getAllUserCountsbyUserIdPeriod($user_id,$type){
        if($type=="week")
        {
            $_SQL = "SELECT count(a.firm_id) count from firm a inner join firm_portal_usage f
                on f.firm_id =a.firm_id and 
                f.start_dt between  adddate(curdate(), INTERVAL 1-DAYOFWEEK(curdate()) DAY) and
                adddate(curdate(), INTERVAL 7-DAYOFWEEK(curdate()) DAY) 
                 wHERE a.record_status =1 and  a.representive_id=".$user_id;
        }
        else if ($type=="month")
        {
            $_SQL = "SELECT count(a.firm_id) count from firm a inner join firm_portal_usage f
                on f.firm_id =a.firm_id and 
                f.start_dt between  DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW()
                 wHERE a.record_status =1 and  a.representive_id=".$user_id;
        }
        else {
            $_SQL = "SELECT count(a.firm_id) count from firm a 
                 wHERE a.record_status =1 and  a.representive_id=".$user_id;
        }
        $query = $this->db->query($_SQL);
        return $query->result_array();
    
    }
     public function getCitiesforSelected($country,$city_kd) {
        //$data=$this->prtTableProcess_model->getPrtGeneral($countrycode);
        //loadType,loadId
        

        //$this->load->model('model');

        $result = $this->prtTableProcess_model->getCitiesbyCountryCode($country);
        $HTML = "";

        // if($result->num_rows() > 0){
        foreach ($result as $list) {
                    if($list['city_kd']==$city_kd){
                        $HTML.="<option  selected=\"selected\" value='" . $list['city_kd'] . "'>" . $list['Name'] . "</option>";    
                    }
                    else {
                        $HTML.="<option value='" . $list['city_kd'] . "'>" . $list['Name'] . "</option>";
                    }
            // }
        }
        return $HTML;
        // $data["veri"] = $this->prtGeneralProcess_model->getPrtTable('countries');
        // $this->load->view('admin_parameters', $data );
    }
    
     public function getUserbyUserName($uesrnr, $username,$country_kd) {

        $first="";    
        $_SQL = "select f.* from users f   ";
            
        
            if (!empty($uesrnr)) {
                
                   $_SQL = $_SQL . " where f.user_id=". $uesrnr;
                   $first = 1;
                
            }
            
            if (!empty($country_kd)) {
                if ($first == 1) {
                    $_SQL = $_SQL . " and f.country_kd= " . $country_kd;
                } else {
                    $_SQL = $_SQL . " where f.country_kd= " . $country_kd;
                    $first = 1;
                }
            }
            if (!empty($username)) {
                if ($first == 1) {
                    $_SQL = $_SQL . " and f.name like " . "'%" . $username . "%' or";
                    $_SQL = $_SQL . " and f.surname like " . "'%" . $username . "%' ";
                } else {
                    $_SQL = $_SQL . " where f.name like " . "'%" . $username . "%' or ";
                    $_SQL = $_SQL . " f.surname like " . "'%" . $username . "%'";
                    $first = 1;
                }
            }
           
        
        $query = $this->db->query($_SQL);
        return $query->result_array();
        //return $_SQL;
    }
    
    function getUserbyCountrybyCitybyDistrict ($country_kd,$city_kd,$district_kd){
        $_SQL = "SELECT u.user_id,u.name,u.surname, i.email,i.ort "
                . "FROM users u inner JOIN iletisim i "
                . "WHERE u.user_id=i.user_id ";
        if ($country_kd!="-1"){
            $_SQL .= " and u.country_kd=".$country_kd;
        }
        if ($city_kd!="-1"){
            $_SQL .= " and u.city_kd=".$city_kd;
        }
        if ($district_kd!="-1"){
            $_SQL .= " and i.ort=".$district_kd;
        }
        
        $query = $this->db->query($_SQL);
        return $query->result_array();
        
    }
      
    public function userPhotosGetID($id){
       $this->db->select("photo_id"); 
       $this->db->where("user_id",$id); 
       $this->db->where("firm_id",0); 
      $sorgu=$this->db->get("photos");      
      $result=$sorgu->result_array();
      
      return $result[0]["photo_id"]; 
    }
    
    
     public function userPhotosGetPhotoPath($id){
       $this->db->select("path"); 
       $this->db->where("user_id",$id); 
       $this->db->where("firm_id",0); 
      $sorgu=$this->db->get("photos");      
      return $sorgu->result_array()[0]["path"]; 
    }
}

