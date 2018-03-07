<?php
class firmBeforeMeeting_model extends CI_Model {


  
       function getFirmByCountryByCityByDistrictByName($firm_id,$firm_name,$firm_country,$firm_city,$firm_district)
     {
        $_SQL = "SELECT * FROM `firm_list` WHERE `record_status`=1 ";
        if($firm_id!="-1"){
            $_SQL .= " and `firm_list_id`=".$firm_id;
        }
        if($firm_name!=""){
            $_SQL .= " and `firm_name` like '%".$firm_name."%' ";
        }
        if($firm_country!="-1"){
            $_SQL .= " and `country_kd`=".$firm_country;
        }
        if($firm_city!="-1"){
            $_SQL .= " and `city_kd`=".$firm_city;
        }
        if($firm_district!="-1"){
            $_SQL .= " and `district`=".$firm_district;
        }
      
        $query = $this->db->query($_SQL);
        return $query->result_array();
     }
     
     function getQuestionandAnswer($firm_id){
         $_SQL="select * from "
                 . "firm_list_check c left outer join firm_check_answer a "
                 . "on c.firm_list_check_id=a.check_list_id "
                 . "and c.record_status=1 "
                 . "and a.record_status=1 "
                 . "and a.firm_list_id=".$firm_id." "
                 . "order by c.firm_list_check_id";
         $query = $this->db->query($_SQL);
         return $query->result_array();
         
     }
}

//"and `firm_list_id`=1 and country_kd=16 and city_kd=1523 and `district`=1070";
     