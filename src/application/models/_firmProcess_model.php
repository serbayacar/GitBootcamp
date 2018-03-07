<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class _firmProcess_model extends CI_Model {
    
      public function getFirmAllContactInfoFirmIdNotApproved($firmid) {

        $_SQL = "SELECT f.name_txt,f.firm_id,il.email,il.webpage,il.facebook,il.adress,
            ct.Name country,cy.Name city,il.iletisim_id,il.ort distict,il.instagram, il.twitter,
            ilt.phone,ilt.mobile_phone,ilt.fax,il.country_kd,il.city_kd ,f.usage_package_id, u.start_dt,u.end_dt,c.amout,f.registry_fee,f.portalusage_id 
            FROM firm f
            inner join iletisim il on il.firm_id=f.firm_id
            inner join countries ct on ct.country_kd=il.country_kd
            inner join iletisim_tel ilt on ilt.iletisim_id=il.iletisim_id and ilt.record_status=1
            inner join city cy on cy.city_kd=il.city_kd 
            inner join firm_portal_usage u on u.firmportal_usage_id=f.portalusage_id and u.record_status=1
            inner join firm_ourservices_cost c on c.firm_portal_usage_id=u.firmportal_usage_id and c.invoice_group_id=5
            WHERE f.firm_id=" . $firmid;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
    
      public function getFirmHeadInfobyFirmIdNotApproved($firmid) {

        $_SQL = "SELECT * FROM `firm` WHERE approved_status=0 and firm_id=" . $firmid;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
    
    
    

    // Event Information retreived by firmid
    // return columns : firm_event_id,start_dt,finish_dt ,firm_event_txt,language_name_txt,record_status
    // this is created for addfirms page -events grid
    public function getEventsbyFirmId($firmid,$lang_id) {

        $_SQL = "select fe.firm_event_id,fe.start_dt,fe.finish_dt ,fev.firm_event_txt,pl.language_name_txt,fe.record_status, fev.event_header
            from firm f inner join firm_event fe on fe.firm_id=f.firm_id and fe.record_status=1 and fe.firm_id=fe.firm_id
            inner join firm_event_language  fev on fev.firm_event_id=fe.firm_event_id  and fev.record_status=1 and fev.language_id=".$lang_id.
            " inner join prt_language pl on pl.language_id=fev.language_id where f.firm_id =".$firmid;
     
      $query = $this->db->query($_SQL);
      return $query->result_array();
     }
     
     public function getEventStatusbyFirmId($firmid,$lang_id) {
        $_SQL = "select count( fe.firm_event_id) count
            from firm f inner join firm_event fe on fe.firm_id=f.firm_id and fe.record_status=1 and fe.firm_id=fe.firm_id
            inner join firm_event_language  fev on fev.firm_event_id=fe.firm_event_id  and fev.record_status=1 and fev.language_id=".$lang_id.
            " inner join prt_language pl on pl.language_id=fev.language_id where f.firm_id =".$firmid;
     
      $query = $this->db->query($_SQL);
      return $query->result_array();
     }
         public function getTicketStatusbyFirmId($firmid) {

        $_SQL = " SELECT count(ticket_id) count FROM `firm_ticket_durumu` 
                    WHERE CURRENT_DATE BETWEEN ticket_start_dt and ticket_end_dt and record_status=1 and firm_id=".$firmid;
     
      $query = $this->db->query($_SQL);
      return $query->result_array();
     }
     
     
    
    // language explanations retreived by firmid 
    // return columns : firmexplanation_id ,language_id,firm_text, record_status,language_name_txt  
    // this is created for addfirms page -language explanation
     public function getExplanationssbyFirmId($firmid){
    
      $_SQL = "SELECT fe.firmexplanation_id ,fe.language_id,fe.firm_text, fe.record_status,l.language_name_txt  "
              . "FROM `firm_explanation` fe inner join prt_language l on l.language_id=fe.language_id WHERE fe.firm_id=".$firmid;
     
      $query = $this->db->query($_SQL);
      return $query->result_array();
     }
         // language explanations retreived by firmid 
    // return columns : firmexplanation_id ,language_id,firm_text, record_status,language_name_txt  
    // this is created for addfirms page -language explanation
     public function getMyFirmbyUserId($user_id){
    
      $_SQL = "SELECT f.name_txt,f.firm_id,il.email,il.webpage,il.facebook,il.adress,
            ct.Name country,cy.Name city,il.iletisim_id,il.ort distict,il.instagram, il.twitter,
            ilt.phone,ilt.mobile_phone,ilt.fax,u.start_dt,u.end_dt,f.responsible_person,
            case when f.approved_status=0 then 'Not Approved' else 'Approved' end approve_status, 
            case when c.create_invoice_status= 0 then 'Not Created' else 'Created' end invoice_status
            FROM `firm` f
            inner join iletisim il on il.firm_id=f.firm_id
            inner join countries ct on ct.country_kd=il.country_kd
            inner join iletisim_tel ilt on ilt.iletisim_id=il.iletisim_id and ilt.record_status=1
            inner join firm_portal_usage u on f.firm_id=u.firm_id
            inner join city cy on cy.city_kd=il.city_kd 
            inner join firm_ourservices_cost c on c.firm_portal_usage_id=f.usage_package_id and c.invoice_group_id=5
            WHERE f.representive_id=" . $user_id;

        $query = $this->db->query($_SQL);
        return $query->result_array();
     }
     
     
     
      // language explanations retreived by firmid 
    // return columns : firmexplanation_id ,language_id,firm_text, record_status,language_name_txt  
    // this is created for addfirms page -language explanation
     public function getExplanationssbyFirmIdandlanguage($firmid,$languageid){
    
      $_SQL = "SELECT fe.firmexplanation_id ,fe.language_id,fe.firm_text, fe.record_status,l.language_name_txt  "
              . "FROM `firm_explanation` fe inner join prt_language l on l.language_id=fe.language_id WHERE fe.firm_id=".$firmid." and fe.language_id=".$languageid;
     
      $query = $this->db->query($_SQL);
      return $query->result_array();
     }
     
     // get active service groups for service list in addfirs page
     public function getServiceListbyFirmId($firmid,$languageid){
    
    /*  $_SQL = "SELECT ps.service_name_txt  FROM
          firm_service_grup f inner join prt_serviceler ps on ps.servicegroup_id= f.firm_service_group_id
          and ps.language_id=".$languageid." WHERE f.record_status=1 and ps.record_status=1 and f.firm_id=".$firmid; */

      $_SQL = "SELECT distinct prser.service_name_txt FROM 
          `firm_service` f inner join prt_subservis_group ps on ps.subservis_group_id=f.subservice_id
          inner join prt_subservices prs on prs.subservice_group_id =ps.subservis_group_id
          inner join prt_serviceler prser on prser.servicegroup_id=f.servicegroup_id
          WHERE f.record_status=1 and ps.record_status=1 and f.firm_id=".$firmid." and prs.language_id=".$languageid ;
      $query = $this->db->query($_SQL);
      return $query->result_array();
     }
     
      public function checkServicebyFirmId($firm_id,$servicegroup_id,$subservice_id){
    
       $_SQL = "SELECT `firmservice_id`  FROM ".
           " `firm_service` WHERE subservice_id=". $subservice_id ." and servicegroup_id =".$servicegroup_id." and firm_id=".$firm_id;
              
       $query = $this->db->query($_SQL);
       return $query->result_array();
     }
     
     
     // get active sub service groups for service list in addfirs page
     public function getSubServiceListbyFirmId($firmid,$languageid){
    
      $_SQL = "SELECT fs.firmservice_id,fs.firm_id,fs.servicegroup_id,fs.subservice_id,pss.language_id,pss.subservice_name,pser.service_name_txt
                FROM firm_service fs
                inner join prt_subservices pss on pss.record_status=1 and pss.subservice_group_id=fs.subservice_id
                inner join prt_serviceler pser on pser.record_status=1 and pser.servicegroup_id=fs.servicegroup_id
                WHERE fs.firm_id=".$firmid." and pss.language_id=".$languageid ;
              
      $query = $this->db->query($_SQL);
      return $query->result_array();
     }
     
     // get active firm photos  in addfirs page -photos
     //return coulums :photo_id`,`picturetipi_id`,`path`,`country_id`,`record_status`
     public function getPhotosbyFirmId($firmid,$order){
    
      $_SQL = "SELECT `photo_id`,`picturetipi_id`,`path`,`country_id`,`record_status`  FROM `photos` WHERE `firm_id`=".$firmid ." and `order`=".$order;
              
      $query = $this->db->query($_SQL);
      return $query->result_array();
     }
     public function getLogobyFirmId($firmid){

      $_SQL = "SELECT `photo_id`,`picturetipi_id`,`path`,`country_id`,`record_status`  FROM `photos` WHERE `firm_id`=".$firmid ." and `order`=0 ";

      $query = $this->db->query($_SQL);
      return $query->result_array();
     }
      // In search Page, you can retreive firm hours which is open or closed 
    // return columns : `day_name`,`open_hours`,`close_hour`,OpenCloseStatus
     public function getHoursbyFirmId($firmid){
    
      $_SQL = "SELECT `day_name`,`open_hours`,`close_hour`, `Status`, "
              . "case when  `Status` = 0 then 'Closed ' else 'Open' end OpenCloseStatus "
              . "FROM `firm_hours` WHERE record_status=1 and `firm_id`=".$firmid
              . " order by orders";
     
      $query = $this->db->query($_SQL);
      return $query->result_array();
     }
     
     
       // you can retreive phones according to iletisim id which is comming from 
       // getFirmContactInfoFirmId function above 
       // `iletisim_id`, `phone`, `mobile_phone`, `fax`
     public function getFirmPhonebyFirmId($iletisimid){
    
        $_SQL = "SELECT `iletisim_id`, `phone`, `mobile_phone`, `fax` FROM `iletisim_tel` 
        WHERE `record_status`=1 AND
        `iletisim_id`=".$iletisimid;
        $query = $this->db->query($_SQL);
        return $query->result_array();
    }


    // you can retreive firm all contact information
    // return columns : name_txt,firm_id,email,webpage,facebook,adress,country,city,
    //iletisim_id,distict,instagram,twitter
    public function getFirmContactInfoFirmId($firmid) {

        $_SQL = "SELECT f.name_txt,f.firm_id,il.email,il.webpage,il.facebook,il.adress, ct.Name country,cy.Name city,il.iletisim_id,il.ort distict,il.instagram, il.twitter
        FROM `firm` f
        inner join iletisim il on il.firm_id=f.firm_id
        inner join countries ct on ct.country_kd=il.country_kd
        inner join city cy on cy.city_kd=il.city_kd WHERE f.firm_id=" . $firmid;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

    // you can retreive firm all contact information
    // return columns : name_txt,firm_id,email,webpage,facebook,adress,country,city,
    //iletisim_id,distict,instagram,twitter,phone,mobile_phone,fax
    public function getFirmAllContactInfoFirmId($firmid) {

        $_SQL = "SELECT f.name_txt,f.firm_id,il.email,il.webpage,il.facebook,il.adress,
            ct.Name country,cy.Name city,il.iletisim_id,il.ort distict,il.instagram, il.twitter,
            ilt.phone,ilt.mobile_phone,ilt.fax
            FROM `firm` f
            inner join iletisim il on il.firm_id=f.firm_id
            inner join countries ct on ct.country_kd=il.country_kd
            inner join iletisim_tel ilt on ilt.iletisim_id=il.iletisim_id and ilt.record_status=1
            inner join city cy on cy.city_kd=il.city_kd WHERE f.approved_status=1 and f.firm_id=" . $firmid;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
    
    
     
    public function getActiveWebPackage($firmid) {

        $_SQL = " Select p.firm_web_package_id , p.muaf_status web_status, p.meeting_dt web_meeting_date,p.ourservice_cost_id  
            from frm_web_package p where p.firm_id =".$firmid;
 

        $query = $this->db->query($_SQL);
        return $query->result_array();
     }         
             
             
     public function getActivePhotoPackage($firmid) {

        $_SQL = " Select p.photo_package_id, p.photo_count, p.photo_status photographer_status ,p.ourservice_cost_id
            from firm_photo_package p inner JOIN firm_ourservices_cost c on c.firm_ourservices_cost_id=p.ourservice_cost_id
            and p.firm_id =".$firmid." and p.photo_count!= (select count(*) 
            from firm_photo_package_usage u where u.firm_id=p.firm_id and p.firm_photo_package_id=u.photo_package_id and u.record_status=1)
            and p.active_status=1
         ";
 

        $query = $this->db->query($_SQL);
        return $query->result_array();
     }
             
    public function getActiveTicketPackage($firmid) {

        $_SQL = " Select p.ticket_package_id, p.ticket_pieces ticket_packet_pieces, p.ticket_status , p.start_dt  ticket_start_dt,p.ourservice_cost_id,
                p.end_dt ticket_end_dt, p.support_package_status ticket_support_status  from firm_ticket_package p 
                inner JOIN firm_ourservices_cost c on c.firm_ourservices_cost_id=p.ourservice_cost_id and p.firm_id =".$firmid."
                and  p.active_status=1";
 

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }        
            
            
            
    public function getActiveEventPackage($firmid) {

        $_SQL = "Select p.evet_package_id, p.event_package_pieces, p.event_status , p.start_dt event_start_dt,p.ourservice_cost_id,
                p.end_dt event_end_dt, p.support_package_status event_support_status  from firm_event_package p
                inner JOIN firm_ourservices_cost c on c.firm_ourservices_cost_id=p.ourservice_cost_id
                and p.firm_id =".$firmid." and p.active_status=1";
    

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
    
    
     
      public function getOurServicesForUpdateNotApproved($firmid) {

        $_SQL = "SELECT a.firm_ourservices_id, a.firm_id, a.event_package_id, a.event_package_pieces, "
                . "a.event_status, a.event_start_dt, a.event_end_dt, a.event_support_status, a.ticket_package_id, "
                . "a.ticket_packet_pieces, a.ticket_status, a.ticket_start_dt, a.ticket_end_dt, a.ticket_support_status, "
                . "a.photo_count, a.photographer_status, a.web_status, a.web_meeting_date, a.approved_status, a.photographer_status "
                . " FROM firm_ourservices a where a.approved_status=0 and a.firm_id=" . $firmid;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
         public function getOurServicesCostForUpdateNotApproved($firmid) {

        $_SQL = "select 
            (SELECT c.amout FROM  firm_ourservices_cost c where c.firm_id=".$firmid." and c.invoice_group_id =1   and c.approved_status=0) eventamount,
            (SELECT c.amout FROM  firm_ourservices_cost c where c.invoice_group_id =2 and c.firm_id=".$firmid." and c.approved_status=0) ticketamount, 
            (SELECT c.amout FROM  firm_ourservices_cost c where c.invoice_group_id =4 and c.firm_id=".$firmid." and  c.approved_status=0) photoamount,
            (SELECT c.meeting_dt FROM  frm_web_package c where c.firm_id=".$firmid." and c.approved_status=0 ) webdate , 
            (SELECT sum(c.amout) FROM firm_ourservices_cost c where  
            (c.invoice_group_id =1 or c.invoice_group_id =2 or c.invoice_group_id =4 or  c.invoice_group_id =3) and  c.firm_id=".$firmid." and  c.approved_status=0) summary" ;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
    

     public function getOurServicesNotApproved($firmid) {

        $_SQL = "SELECT * from firm_ourservices where approved_status=0 and  firm_id =" . $firmid;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
 
    
    // you can retreive firm information from firm table
    // columns : `firm_id`, `name_txt`, `given_explanation_txt`, `firm_explanation_id`,
    //`responsible_user_id`, `agrement_name_surname`, `photographer_status`, `firm_freelancer`,
    //`country_kd`, `city_kd``responsible_person`,`responsible_phone`,`interview_person`,`interview_phone`
    public function getFirmHeadInfobyFirmId($firmid) {

        $_SQL = "SELECT * FROM `firm` WHERE  firm_id=" . $firmid;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

  
    
    public function getFirmsbyaddfirms($firnnr, $countkd, $citykd, $firmnr, $firmname, $responsibleper, $district) {


        $_SQL = "select f.* from firm f   ";

        if (!empty($firnnr)) {
            $_SQL = $_SQL . " where  f.firm_id=" . $firnnr;
        } else {
            $first = 0;
            if ($first == 1) {
                $_SQL = $_SQL . " and il.ort =" . $district;
            } else {
                $_SQL = $_SQL . " where il.ort = " . $district;
                $first == 1;
            }
            if (!empty($citykd)) {
                if ($first == 1) {
                    $_SQL = $_SQL . " and f.city_kd=" . $citykd;
                } else {
                    $_SQL = $_SQL . " where f.city_kd=" . $citykd;
                    $first == 1;
                }
            }
            if (!empty($countkd)) {
                if ($first == 1) {
                    $_SQL = $_SQL . " and f.country_kd= " . $countkd;
                } else {
                    $_SQL = $_SQL . " where f.country_kd= " . $countkd;
                    $first == 1;
                }
            }
            if (!empty($firmNm)) {
                if ($first == 1) {
                    $_SQL = $_SQL . " and f.name_txt like " . "'%" . $firmNm . "%'";
                } else {
                    $_SQL = $_SQL . " where f.name_txt like " . "'%" . $firmNm . "%'";
                    $first == 1;
                }
            }
            if (!empty($responsibleper)) {
                if ($first == 1) {
                    $_SQL = $_SQL . " and f.responsible_person like " . "'%" . $responsibleper . "%'";
                } else {
                    $_SQL = $_SQL . " where f.responsible_person like " . "'%" . $responsibleper . "%'";
                    $first == 1;
                }
            }
        }
        $query = $this->db->query($_SQL);
        return $query->result_array();
        //return $_SQL;
    }
     public function getFirmsbyfirmName($firmnr, $firmname,$district,$country_kd) {


        $_SQL = "SELECT f.name_txt,f.firm_id,il.email,il.webpage,il.facebook,il.adress,
            ct.Name country,cy.Name city,il.iletisim_id,il.ort distict,il.instagram, il.twitter,
            ilt.phone,ilt.mobile_phone,ilt.fax
            FROM `firm` f
            inner join iletisim il on il.firm_id=f.firm_id
            inner join countries ct on ct.country_kd=il.country_kd
            inner join iletisim_tel ilt on ilt.iletisim_id=il.iletisim_id and ilt.record_status=1
            inner join city cy on cy.city_kd=il.city_kd  ";

        if (!empty($firmnr)) {
            $_SQL = $_SQL . " where  f.firm_id=" . $firmnr;
        } else {
            $first = 0;
             if (!empty($district)) {
                if ($first == 1) {
                    $_SQL = $_SQL . " and il.ort =" . $district;
                } else {
                    $_SQL = $_SQL . " where il.ort = " . $district;
                    $first == 1;
                }
             }
            if (!empty($countkd)) {
                if ($first == 1) {
                    $_SQL = $_SQL . " and f.country_kd= " . $countkd;
                } else {
                    $_SQL = $_SQL . " where f.country_kd= " . $countkd;
                    $first == 1;
                }
            }
            if (!empty($firmNm)) {
                if ($first == 1) {
                    $_SQL = $_SQL . " and f.name_txt like " . "'%" . $firmNm . "%'";
                } else {
                    $_SQL = $_SQL . " where f.name_txt like " . "'%" . $firmNm . "%'";
                    $first == 1;
                }
            }
           
        }
        $query = $this->db->query($_SQL);
        return $query->result_array();
        //return $_SQL;
    }
    
        public function getUsageAmountbyDate($start_dt,$end_dt,$country_kd,$city_kd) {

            $_SQL = "SELECT * from prt_general where country_kd=" .$country_kd ." and city_kd=".$city_kd;
            /*SELECT `prt_general_id`, `monthly_firm_cost`, `six_monthly_firm_cost`, `yearly_firm_cost`, `until_two_years_firm_cost`,
             * `iki_yil_ustu_firm_cost`, `salesrepresentative_comission`, `firm_resim_sayisi`, `firm_event_resim_sayisi`, `photo_cost`, 
             * `monthly_customer_service_cost`, `firm_max_user_count`, `country_kd`, `city_kd`, 
             * `customersupport_cost`, `currency_kd`, `record_status`, `insert_user_id`, `insert_date`, `update_user_id`, `update_date` FROM `prt_general` WHERE 1*/
            $datetime1 = date_create($start_dt);
            $datetime2 = date_create($end_dt);
            $interval = date_diff($datetime1, $datetime2);
            $month=$interval->format('%m months');

            $query = $this->db->query($_SQL);
            $data=$query->result_array();
            $sum=0;
            if ($month==6)
               $sum=$data[0]["six_monthly_firm_cost"]; 
            else if ($month>6 and $month<12)
               $sum=$data[0]["monthly_firm_cost"]*$month;  
            else if ($month==12)
                $sum=$data[0]["yearly_firm_cost"]; 
            else if ($month>12 and $month<24)
                 $sum=$data[0]["until_two_years_firm_cost"]*$month;
            else if ($month==24)
                 $sum=$data[0]["iki_yil_ustu_firm_cost"];
            return $sum;
        
    }
    public function getNotApprovedInvoice($firm_id,$language_id)
    {
         $_SQL = "SELECT fc.*, g.name invoice_group,invt.description FROM firm_ourservices_cost fc inner join prt_invoivegroup g 
             on g.prt_invoivegroup_id=fc.invoice_group_id  and g.record_status=1
             and fc.record_status=1
            inner join prt_invoice_type invt on invt.invoice_group_id=g.prt_invoivegroup_id and invt.language_id=" .$language_id.
            " and invt.record_status=1  where fc.approved_status=0 and fc.firm_id=".$firm_id;
          
            $query = $this->db->query($_SQL);
            $data=$query->result_array();
        
    }
   
    public function getNotApprovedCreateInvoiceinfo($firm_id,$language_id)
    {
         $_SQL = "SELECT fc.firm_id,fc.firm_portal_usage_id,fc.firm_ourservices_id,fc.amout,case when fc.muaf_status=3 then 'Ok' else '-' end muaf,fc.muaf_status,il.adress, f.name_txt firm_name,fc.invoice_group_id,
             f.country_kd,f.city_kd,g.name invoice_group,invt.description ,fc.pieces FROM firm_ourservices_cost fc inner join prt_invoivegroup g 
             on g.prt_invoivegroup_id=fc.invoice_group_id  and g.record_status=1
            and fc.record_status=1 
            inner join prt_invoice_type invt on invt.invoice_group_id=g.prt_invoivegroup_id and invt.language_id=".$language_id. 
            " and invt.record_status=1
            inner join iletisim il on il.firm_id=fc.firm_id and il.record_status=1
            inner join firm f on f.firm_id=fc.firm_id 
            where fc.approved_status=0 and fc.firm_id=".$firm_id;
          
            $query = $this->db->query($_SQL);
            $data=$query->result_array();
        
    }
    
       public function getLanguageServicebyFirmId($firm_id)
    {
             $_SQL = "SELECT pl.language_id,pl.language_name_txt, fs.servicegiven_language_id FROM firm_servicegiven_language fs "
                     . "right outer join prt_language pl on fs.language_id=pl.language_id and fs.firm_id=".$firm_id." and fs.record_status=1 where pl.record_status=1 ";
            
          
            $query = $this->db->query($_SQL);
            return $query->result_array();
            
    }
     public function getFirmsNotApprovedbyfirmName($firmnr, $firmNm,$district,$countkd) {


         $_SQL = "SELECT distinct f.name_txt,f.firm_id,il.email,il.webpage,il.facebook,il.adress,
            ct.Name country,cy.Name city,il.iletisim_id,il.ort distict,il.instagram, il.twitter,
            ilt.phone,ilt.mobile_phone,ilt.fax
            FROM firm f
            inner join iletisim il on il.firm_id=f.firm_id and f.notportalusage=0
            inner join countries ct on ct.country_kd=il.country_kd
            inner join iletisim_tel ilt on ilt.iletisim_id=il.iletisim_id and ilt.record_status=1
            inner join city cy on cy.city_kd=il.city_kd 
            inner join  firm_ourservices_cost c on c.firm_id=f.firm_id and c.create_invoice_status=0 
            where  f.approved_status=0 ";

        if (!empty($firmnr)) {
            $_SQL = $_SQL . "  and  f.firm_id=" . $firmnr;
        } else {
            $first = 0;
             if (!empty($district)) {
               
                    $_SQL = $_SQL . " and il.ort =" . $district;
                            }
            if (!empty($countkd)) {
                    $_SQL = $_SQL . " and f.country_kd= " . $countkd;
               
            }
            if (!empty($firmNm)) {
                    $_SQL = $_SQL . " and f.name_txt like " . "'%" . $firmNm . "%'";
          }
           
            
        }
        $query = $this->db->query($_SQL);
        return $query->result_array();
        //return $_SQL;
    }
    public function getFirmsNotApprovedCreateInvoice($firmnr, $firmname,$district,$country_kd) {


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
     public function getHourIdbyFirmIdandOrders($firm_id,$order) {
        $_SQL = "SELECT `firm_hours_id` "
                . "FROM `firm_hours` "
                . "WHERE  `orders`= ". $order ." and  `firm_id`= ". $firm_id ."";
     
      $query = $this->db->query($_SQL);
      return $query->result_array();
     }
     public function insertFirmIletisimAll($datafirm,$datailetisim,$datailetisimtel,$datafirmexplanation,$datafirmusage,$datacost,$dataRegisty)
   {
        
       
        try { 
         
            //insert firm table
            $this->load->model("prtTableProcess_model");
            $_firm_id= $this->generalChangeProcess_model->insertTables('firm',$datafirm);            
            
            $this->prtTableProcess_model->insertFirmProcess($_firm_id);
            
            //insert iletisim table
            $datailetisim["firm_id"]=$_firm_id;
            $_iletisim_id= $this->generalChangeProcess_model->insertTables('iletisim',$datailetisim);  
            
           // $this->updateFirmIletisimId($_firm_id,$_iletisim_id);
            //insert iletisim_tel table
            
            $datailetisimtel["iletisim_id"]=$_iletisim_id;
            $_iletisimtel= $this->generalChangeProcess_model->insertTables('iletisim_tel',$datailetisimtel); 
            $firm_id=$_firm_id;  
            
            $datafirmexplanation["firm_id"]=$firm_id;
            $_explanation_id =$this->generalChangeProcess_model->insertTables('firm_explanation',$datafirmexplanation);
            
           
            $this->updateFirmExplanationId($firm_id,$_explanation_id);
            
            
             
             
            $datafirmusage["firm_id"]=$firm_id;
            $_portalusage_id=$this->generalChangeProcess_model->insertTables('firm_portal_usage',$datafirmusage);
            $this->updateFirmUsageId($firm_id,$_portalusage_id);
            
            
            $datacost["firm_id"]=$firm_id;
            $datacost["firm_portal_usage_id"]=$_portalusage_id;
            $dataRegisty["firm_id"]=$firm_id;
            $dataRegisty["firm_portal_usage_id"]=$_portalusage_id;
            
            $this->generalChangeProcess_model->insertTables('firm_ourservices_cost',$datacost);
            $this->generalChangeProcess_model->insertTables('firm_ourservices_cost',$dataRegisty);
            
            
            $this->prtTableProcess_model->updateFirmProcess($firm_id,1,0,1); //firma eklendi processi completed
                        
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           
         }
  
         return $firm_id;     
   }
   
}
