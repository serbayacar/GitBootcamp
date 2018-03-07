<?php
class firmTicket_model extends CI_Model {


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
           inner join firm_ourservices_cost c on c.firm_portal_usage_id=u.firmportal_usage_id  and c.invoice_group_id=5 
           where f.record_status=1 ";

          if (!empty($firmnr)) {
            $_SQL = $_SQL . " and  f.firm_id=" . $firmnr;
        }
       if ($district!="-1") {
           $_SQL = $_SQL . " and il.ort =" . $district;
       }
       if (!empty($countkd)) {
           $_SQL = $_SQL . " and f.country_kd= " . $countkd;
       }
       if (!empty($firmNm)) {
           $_SQL = $_SQL . " and f.name_txt like " . "'%" . $firmNm . "%'";
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
     public function getTicketPackage($firmid) {

        $_SQL = "SELECT firm_ticket_package_id FROM `firm_ticket_package` WHERE firm_id=" . $firmid;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
    public function getTicketbyId($ticket_id) {

        $_SQL = "SELECT t.ticket_start_dt,t.ticket_end_dt,t.start_hour,t.end_hour,e.explanation,e.language_id FROM firm_ticket_durumu t inner join firm_ticket_explanation e on 
       e.firm_ticket_package_id=t.ticket_id and e.language_id=112 and e.ticket_id=".$ticket_id;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
     public function getAllTickets($firmid,$languageId,$ticketpackage_id) {

        $_SQL = " SELECT d.ticket_package_id,d.ticket_id, d.ticket_id,d.ticket_start_dt,d.ticket_end_dt,d.start_hour,d.end_hour ,t.explanation ,t.language_id
            FROM  firm_ticket_durumu d  inner join firm_ticket_explanation t on t.ticket_id=d.ticket_id
            and t.language_id=".$languageId."
            inner join firm_ticket_package p on p.ticket_package_id=d.ticket_package_id  and p.firm_id=".$firmid.
              " and p.firm_ticket_package_id=". $ticketpackage_id ;

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

        $_SQL = "
           SELECT  c.amout FROM firm_ourservices a inner join firm_ourservices_cost c on c.firm_id=a.firm_id and c.invoice_group_id =1 and c.firm_ourservices_id=a.firm_ourservices_id 
             inner join firm_ticket_package p on p.frm_ourservice_id=c.firm_ourservices_id   and curdate()<=p.end_dt  where a.firm_id=".$firmid ;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
   
}
   