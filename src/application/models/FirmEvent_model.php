<?php
class firmEvent_model extends CI_Model {


   public function getFirmsbyfirmName($firmnr, $firmNm,$district,$countkd) {


         $_SQL = "SELECT distinct f.name_txt,f.firm_id,il.email,il.webpage,il.facebook,il.adress,
            ct.Name country,cy.Name city,il.iletisim_id,il.ort distict,il.instagram, il.twitter,
            ilt.phone,ilt.mobile_phone,ilt.fax,case when c.create_invoice_status=0 then 'Not create' else 'Created' end create_status ,
             u.start_dt,u.end_dt
            FROM firm f
            inner join iletisim il on il.firm_id=f.firm_id and f.notportalusage=0
            inner join countries ct on ct.country_kd=il.country_kd
            inner join iletisim_tel ilt on ilt.iletisim_id=il.iletisim_id and ilt.record_status=1
            inner join city cy on cy.city_kd=il.city_kd 
            inner join firm_portal_usage u on u.firm_id=f.firm_id  and curdate() <= u.end_dt
           inner join firm_ourservices_cost c on c.firm_portal_usage_id=u.firmportal_usage_id  and c.invoice_group_id=5 ";

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
     public function getOurServices($firmid) {

        $_SQL = "SELECT a.firm_ourservices_id, a.firm_id, a.event_package_id, a.event_package_pieces, "
                . "a.event_status, a.event_start_dt, a.event_end_dt, a.event_support_status, a.ticket_package_id, "
                . "a.ticket_packet_pieces, a.ticket_status, a.ticket_start_dt, a.ticket_end_dt, a.ticket_support_status, "
                . "a.photo_count, a.photographer_status, a.web_status, a.web_meeting_date, a.approved_status, a.photographer_status "
                . " FROM firm_ourservices a where  a.firm_id=" . $firmid;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
     public function getEventPackage($firmid) {

        $_SQL = "select p.firm_event_package_id,p.event_package_pieces from firm_event_package p where p.firm_id=" . $firmid;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
    public function getEventbyId($event_id,$languageId) {

        $_SQL = "select e.firm_event_id,e.start_dt,e.finish_dt,e.start_hour,e.end_hour,l.firm_event_txt,l.event_header,l.language_id from firm_event e 
        inner join firm_event_language l on l.firm_event_id=e.firm_event_id and l.language_id=".$languageId."
        where e.firm_event_id=".$event_id;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
     public function getPhotoPackage($firmid) {

        $_SQL = "select p.firm_photo_package_id,p.photo_count from firm_photo_package p where p.firm_id=" . $firmid;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
         public function getUsagePhotoCount($firmid) {

        $_SQL = " SELECT count(*) count "
                . "FROM firm_usage_photos u "
                . "inner join firm_photo_package p on p.firm_photo_package_id=u.photo_package_id and p.firm_id=u.firm_id"
                . " and p.record_status=1 and u.record_status=1 and p.approved_status=1 where p.firm_id=" . $firmid;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
     public function getAllEvent($firmid,$languageId,$firm_eventpackage_id) {

        $_SQL = " SELECT e.firm_id,e.firm_event_id,e.start_dt,e.finish_dt,e.start_hour,e.end_hour,l.event_header ,l.firm_event_txt, l.language_id FROM firm_event e inner join firm_event_language l 
                 on l.firm_event_id=e.firm_event_id 
                and e.record_status=1 and l.language_id=".$languageId."
                inner join firm_event_package p on p.firm_event_package_id
                where p.firm_event_package_id=".$firm_eventpackage_id." and e.firm_id=".$firmid;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
    
    public function getAllEventbyEventPackageID($firmid,$firm_eventpackage_id) {

        $_SQL = " SELECT e.firm_id,e.firm_event_id,e.start_dt,e.finish_dt,e.start_hour,e.end_hour,l.event_header ,l.firm_event_txt, l.language_id,l.firmevent_lang_id ,e.continues,e.event_cat_id,e.event_subCatID,e.place,e.district
                  FROM firm_event e inner join firm_event_language l 
                 on l.firm_event_id=e.firm_event_id 
                and e.record_status=1 
                inner join firm_event_package p on p.firm_event_package_id
                where p.firm_event_package_id=".$firm_eventpackage_id." and e.firm_id=".$firmid;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
    
   
     public function getFirmAllContactInfoFirmId($firmid) {

        $_SQL = "SELECT f.name_txt,f.firm_id,il.email,il.webpage,il.facebook,il.adress,
            ct.Name country,cy.Name city,il.iletisim_id,il.ort distict,il.instagram, il.twitter,
            ilt.phone,ilt.mobile_phone,ilt.fax,il.country_kd,il.city_kd ,case when c.create_invoice_status=0 then 'Not create' else 'Created' end create_status ,
            u.start_dt,u.end_dt
            FROM `firm` f
            inner join iletisim il on il.firm_id=f.firm_id
            inner join countries ct on ct.country_kd=il.country_kd
            inner join iletisim_tel ilt on ilt.iletisim_id=il.iletisim_id and ilt.record_status=1
            inner join city cy on cy.city_kd=il.city_kd 
            inner join firm_portal_usage u on u.firm_id=f.firm_id  and curdate() <= u.end_dt
            inner join firm_ourservices_cost c on c.firm_portal_usage_id=u.firmportal_usage_id  and c.invoice_group_id=5 where f.firm_id=" . $firmid;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
     public function getFirmHeadInfobyFirmId($firmid) {

        $_SQL = "SELECT * FROM `firm` WHERE firm_id=" . $firmid;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
     public function getOurServicesCost($firmid) {

        $_SQL = "select 
            (SELECT  c.amout FROM firm_ourservices a inner join firm_ourservices_cost c on c.firm_id=a.firm_id and c.invoice_group_id =1 and c.firm_ourservices_id=a.firm_ourservices_id 
             inner join firm_event_package p on p.frm_ourservice_id=c.firm_ourservices_id   and curdate()<=p.end_dt  where a.firm_id=".$firmid."      
            
            ) eventamount,
            (SELECT c.amout FROM firm_ourservices a inner join firm_ourservices_cost c on c.firm_id=a.firm_id and c.invoice_group_id =4 and c.firm_ourservices_id=a.firm_ourservices_id 
            inner join firm_photo_package p on p.frm_ourservice_id=a.firm_ourservices_id where a.firm_id=".$firmid."
            ) photoamount
            " ;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
   
}
   