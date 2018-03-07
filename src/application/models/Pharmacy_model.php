<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class pharmacy_model extends CI_Model {
    public function getFirms($firmnr, $firmname,$district,$country_kd) {

//Eczane kodu eklenecek
        $_SQL = "SELECT distinct f.name_txt,f.firm_id,il.email,il.webpage,il.facebook,il.adress,
            ct.Name country,cy.Name city,il.iletisim_id,il.ort distict,il.instagram, il.twitter,
            ilt.phone,ilt.mobile_phone,ilt.fax
            FROM firm f
            inner join iletisim il on il.firm_id=f.firm_id and f.notportalusage=0
            inner join countries ct on ct.country_kd=il.country_kd
            inner join iletisim_tel ilt on ilt.iletisim_id=il.iletisim_id and ilt.record_status=1
            inner join city cy on cy.city_kd=il.city_kd 
            inner join  firm_ourservices_cost c on c.firm_id=f.firm_id and c.create_invoice_status=1 
            where  f.approved_status=0 ";

        if (!empty($firmnr)) {
            $_SQL = $_SQL . "  and  f.firm_id=" . $firmnr;
        } else {
            $first = 0;
             if (!empty($district)) {
               
                    $_SQL = $_SQL . " and il.ort =" . $district;
                            }
            if (!empty($country_kd)) {
                    $_SQL = $_SQL . " and f.country_kd= " . $country_kd;
               
            }
            if (!empty($firmname)) {
                    $_SQL = $_SQL . " and f.name_txt like " . "'%" . $firmname . "%'";
          }
           
            
        }
        $query = $this->db->query($_SQL);
        return $query->result_array();
        //return $_SQL;
    }
      public function getDatesbyFirmId($firmid){
    
      $_SQL = "SELECT `apothe_dates_id`, `firm_id`, `onduty_dt`, `record_status`, `insert_dt`, 
          `update_dt`, `insert_user_id`, `update_user_id`, `approve_status`, `approve_dt`, 
          `approve_user_id` FROM `pharmacy_dates` WHERE 
            record_status=1 and firm_id=".$firmid;
     
      $query = $this->db->query($_SQL);
      return $query->result_array();
     }
}

