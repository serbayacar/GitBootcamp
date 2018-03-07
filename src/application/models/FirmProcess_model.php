<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class firmProcess_model extends CI_Model {
    
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
        }
         if (!empty($countkd)) {
             $_SQL = $_SQL . " and f.country_kd= " . $countkd;

         }
         if ($district!="-1") {

             $_SQL = $_SQL . " and il.ort =" . $district;
         }
         if (!empty($firmNm)) {
             $_SQL = $_SQL . " and f.name_txt like " . "'%" . $firmNm . "%'";
         }
        $query = $this->db->query($_SQL);
        return $query->result_array();
        //return $_SQL;
    }
     public function getFirmsNotApprovedCreateInvoice($firmnr, $firmNm,$district,$countkd) {


         $_SQL = "SELECT distinct f.name_txt,f.firm_id,il.email,il.webpage,il.facebook,il.adress,
            ct.Name country,cy.Name city,il.iletisim_id,il.ort distict,il.instagram, il.twitter,
            ilt.phone,ilt.mobile_phone,ilt.fax
            FROM firm f
            inner join iletisim il on il.firm_id=f.firm_id and f.notportalusage=0
            inner join countries ct on ct.country_kd=il.country_kd
            inner join iletisim_tel ilt on ilt.iletisim_id=il.iletisim_id and ilt.record_status=1
            inner join city cy on cy.city_kd=il.city_kd 
            inner join  firm_ourservices_cost c on c.firm_id=f.firm_id and c.create_invoice_status=1 and c.invoice_group_id=5 
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
      public function getFirmAllContactInfoFirmIdNotApproved($firmid) {

        $_SQL = "SELECT f.name_txt,f.firm_id,il.email,il.webpage,il.facebook,il.adress,
            ct.Name country,cy.Name city,il.iletisim_id,il.ort distict,il.instagram, il.twitter,
            ilt.phone,ilt.mobile_phone,ilt.fax,il.country_kd,il.city_kd ,f.usage_package_id, 
            u.start_dt,u.end_dt,c.amout,f.registry_fee,f.portalusage_id,f.photo_free_status 
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
    public function getFirmAllContactInfoFirmIdNotPortalUsage($firmid) {

        $_SQL = "SELECT f.name_txt,f.firm_id,il.email,il.webpage,il.facebook,il.adress,
            ct.Name country,cy.Name city,il.iletisim_id,il.ort distict,il.instagram, il.twitter,
            ilt.phone,ilt.mobile_phone,ilt.fax,il.country_kd,il.city_kd ,f.usage_package_id, 
            f.registry_fee,f.portalusage_id, u.start_dt,u.end_dt,c.amout,
            FROM firm f
            inner join iletisim il on il.firm_id=f.firm_id
            inner join countries ct on ct.country_kd=il.country_kd
            inner join iletisim_tel ilt on ilt.iletisim_id=il.iletisim_id and ilt.record_status=1
            inner join city cy on cy.city_kd=il.city_kd 
            left outer join firm_portal_usage u on u.firmportal_usage_id=f.portalusage_id and u.record_status=1
            left outer join firm_ourservices_cost c on c.firm_portal_usage_id=u.firmportal_usage_id and c.invoice_group_id=5
             WHERE f.firm_id=" . $firmid;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
    public function getFirmAllContactInfoFirmId($firmid) {

        $_SQL = "SELECT f.name_txt,f.firm_id,il.email,il.webpage,il.facebook,il.adress,
            ct.Name country,cy.Name city,il.iletisim_id,il.ort distict,il.instagram, il.twitter,
            ilt.phone,ilt.mobile_phone,ilt.fax,il.country_kd,il.city_kd ,f.usage_package_id, 
            u.start_dt,u.end_dt,f.registry_fee,f.portalusage_id 
            FROM firm f
            inner join iletisim il on il.firm_id=f.firm_id
            inner join countries ct on ct.country_kd=il.country_kd
            inner join iletisim_tel ilt on ilt.iletisim_id=il.iletisim_id and ilt.record_status=1
            inner join city cy on cy.city_kd=il.city_kd 
            inner join firm_portal_usage u on u.firmportal_usage_id=f.portalusage_id and u.record_status=1
            WHERE f.firm_id=" . $firmid;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
    
     public function getFirmLinkAdress($firmid) {

        $_SQL = "SELECT * FROM `firm_other` WHERE  firm_id=" . $firmid;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
     public function  getFirmHeadInfobyFirmId($firmid) {

        $_SQL = "SELECT * FROM `firm` WHERE  firm_id=" . $firmid;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
       public function getFirmAllEventInGerman($firmid) {

        $_SQL = "SELECT e.start_dt,e.finish_dt,e.start_hour,e.end_hour,l.event_header,l.firm_event_txt FROM firm_event e 
            inner join firm_event_language l on l.firm_event_id=e.firm_event_id and e.record_status=1
                and e.approved_status=1  and l.language_id=137 and e.finish_dt>=curdate()
                WHERE e.firm_id=" . $firmid;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
         public function getFirmAllDiscountInGerman($firmid) {

        $_SQL = " SELECT e.ticket_start_dt,e.ticket_end_dt,l.explanation FROM firm_ticket_durumu e 
            inner join firm_ticket_explanation l on l.ticket_id=e.ticket_id and e.record_status=1
                and e.approved_status=1  and l.language_id=137 and e.ticket_end_dt>=curdate() where e.firm_id=" . $firmid;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
   
      public function getFirmUsagePackageInfo($firmid) {

        $_SQL = "select u.start_dt,u.end_dt,l.description  from firm_portal_usage u  
            inner join prt_usage_package_language l on l.prt_usage_package_id=u.package_id
            and u.firm_id=".$firmid." and l.lang_id=137
            and u.record_status=1 " ;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
      public function getFirmEventPackageInfo($firmid) {

        $_SQL = "SELECT ep.event_package_pieces,el.description, case when ep.active_status=0 then 'pasive' else 'active' end status FROM firm_event_package ep 
                     inner join prt_generalevet_package_language el on el.generalevent_package_id=ep.evet_package_id
                    and el.language_id=137 and ep.record_status=1 
                    where ep.firm_id=".$firmid ;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
   public function getFirmTicketPackageInfo($firmid) {

        $_SQL = " SELECT ep.ticket_pieces,el.description, case when ep.active_status=0 then 'pasive' else 'active' end status FROM firm_ticket_package ep 
                    inner join prt_generalticket_package_language el on el.generalticket_package_id=ep.ticket_package_id
                    and el.language_id=137 and ep.record_status=1 
                    where ep.firm_id=".$firmid ;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
      public function getFirmWebPackageInfo($firmid) {

        $_SQL = "  SELECT W.meeting_dt, w.approved_status,w.finish_dt,w.web_status FROM frm_web_package W WHERE W.firm_id=".$firmid ;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
        public function getFirmPhotoPackageInfo($firmid) {

        $_SQL = "  SELECT ep.photo_count,el.description, case when ep.active_status=0 then 'pasive' else 'active' end status FROM firm_photo_package ep inner join prt_generalphoto_package_language el on el.generalphoto_package_id=ep.photo_package_id
                and el.language_id=137 and ep.record_status=1 
                where ep.firm_id=".$firmid ;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
      public function getFirmEventCount($firmid) {

      $_SQL = " select count(e.firm_event_id) count from firm_event e "
              . "where e.finish_dt>=curdate() and e.approved_status=1 and e.record_status=1 and e.firm_id=".$firmid ;
        
        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
     public function getFirmDiscountCount($firmid) {

      $_SQL = " select count(e.ticket_id) count from firm_ticket_durumu e where  e.ticket_end_dt>=curdate() and e.approved_status=1 and e.record_status=1 and e.firm_id=".$firmid ;
        
        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
         public function getFirmRepresentative($firmid) {

      $_SQL = " select u.user_id,concat(u.name,' ',u.surname) user_name,t.mobile_phone,i.email from firm f 
          inner join users u on f.representive_id=u.user_id and u.record_status=1
            inner join iletisim i on i.firm_id=f.firm_id and i.record_status=1
            inner join iletisim_tel t on t.iletisim_id=i.iletisim_id and t.record_status=1
            where f.firm_id=".$firmid ;
        
        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
    
    
     public function getFirmEventPackageCount($firmid) {

      $_SQL = " SELECT count(ep.firm_event_package_id) count FROM firm_event_package ep where ep.record_status=1 and ep.firm_id=".$firmid ;
        
        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
   public function getFirmTicketPackageCount($firmid) {

        $_SQL = " SELECT count(ep.firm_ticket_package_id) count FROM firm_ticket_package ep where ep.record_status=1 and ep.firm_id=".$firmid ;
                   

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
     
        public function getFirmPhotoPackageCount($firmid) {

        $_SQL = "  SELECT count(ep.firm_photo_package_id) count FROM firm_photo_package ep  where ep.record_status=1 and ep.firm_id=".$firmid ;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
    
        public function getFirmUsagePackageCount($firmid) {

        $_SQL = "  select count(u.firmportal_usage_id) count  from firm_portal_usage u  where u.record_status=1 and u.firm_id=".$firmid ;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
   
   
      public function getFirmHeadInfobyFirmIdNotApproved($firmid) {

        $_SQL = "SELECT * FROM `firm` WHERE approved_status=0 and firm_id=" . $firmid;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
     
      public function getLanguageServicebyFirmId($firm_id)
    {
             $_SQL = "SELECT pl.language_id,pl.language_name_txt, fs.servicegiven_language_id,fs.record_status FROM firm_servicegiven_language fs "
                     . "right outer join prt_language pl on fs.language_id=pl.language_id and fs.firm_id=".$firm_id;
            
          
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

        $_SQL = " Select p.photo_package_id, p.photo_count, p.photo_status photographer_status ,p.firm_photo_package_id ,p.ourservice_cost_id,pp.package_name 
            from firm_photo_package p inner JOIN firm_ourservices_cost c on c.firm_ourservices_cost_id=p.ourservice_cost_id
            and p.firm_id =".$firmid."  
            and p.active_status=1
            inner join prt_generalphoto_package pp on pp.photo_pacage_id=p.photo_package_id and p.record_status=1
         ";
 

        $query = $this->db->query($_SQL);
        return $query->result_array();
     }
             
    public function getActiveTicketPackage($firmid) {

        $_SQL = " Select p.ticket_package_id, p.ticket_pieces ticket_packet_pieces, p.ticket_status ,p.ourservice_cost_id,pe.ticket_name,
                 p.support_package_status ticket_support_status , p.firm_ticket_package_id
                from firm_ticket_package p 
                inner JOIN firm_ourservices_cost c on c.firm_ourservices_cost_id=p.ourservice_cost_id and p.firm_id =".$firmid."
                and  p.active_status=1 inner join prt_generalticket_package pe on pe.ticket_pacage_id =p.ticket_package_id";
 

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }        
            
      
     public function getDefinedPhoto($firmid) {

        $_SQL = " Select  count(u.photo_package_usage_id) count
            from firm_photo_package p 
            inner join  firm_photo_package_usage u on u.firm_id=p.firm_id and 
            p.firm_photo_package_id=u.photo_package_id and u.record_status=1 and  p.firm_id =".$firmid."
            and p.active_status=1
            inner join prt_generalphoto_package pp on pp.photo_pacage_id=p.photo_package_id and p.record_status=1   ";
    

        $query = $this->db->query($_SQL);
        return $query->result_array();
     }
              
       public function getDefinedEvents($firmid) {

        $_SQL = " SELECT count(e.firm_event_id) count FROM firm_event e inner join firm_event_package p on p.evet_package_id=e.firm_event_package_id
                and e.firm_id=".$firmid." and e.record_status=1 and p.record_status=1     ";
    

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
    public function getDefinedTickets($firmid) {

        $_SQL = " SELECT count(e.ticket_id) count FROM firm_ticket_durumu e inner join firm_ticket_package p on p.ticket_package_id=e.ticket_package_id
                and e.firm_id=".$firmid." and e.record_status=1 and p.record_status=1     ";
    

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
            
    public function getActiveEventPackage($firmid) {

        $_SQL = "Select p.evet_package_id, p.event_package_pieces, p.event_status , p.ourservice_cost_id,pe.package_name,
                 p.support_package_status event_support_status ,p.next_event_package_id,p.old_event_package_id, p.firm_event_package_id  from firm_event_package p
                inner JOIN firm_ourservices_cost c on c.firm_ourservices_cost_id=p.ourservice_cost_id
                and p.firm_id =".$firmid." and p.active_status=1
                inner join prt_generalevet_package pe on pe.generalevent_package_id =p.evet_package_id";
    

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
    
     public function getHoursbyFirmId($firmid){
    
      $_SQL = "SELECT `day_name`,`open_hours`,`close_hour`, `Status`, "
              . "case when  `Status` = 0 then 'Closed ' else 'Open' end OpenCloseStatus "
              . "FROM `firm_hours` WHERE record_status=1 and `firm_id`=".$firmid
              . " order by orders";
     
      $query = $this->db->query($_SQL);
      return $query->result_array();
     }
       public function checkServicebyFirmId($firm_id,$servicegroup_id,$subservice_id){
    
       $_SQL = "SELECT `firmservice_id`  FROM ".
           " `firm_service` WHERE subservice_id=". $subservice_id ." and servicegroup_id =".$servicegroup_id." and firm_id=".$firm_id;
              
       $query = $this->db->query($_SQL);
       return $query->result_array();
     }
       public function getOurServicesNotApproved($firmid) {

        $_SQL = "SELECT * from firm_ourservices where approved_status=0 and  firm_id =" . $firmid;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
 
       public function getInactivePackages($firm_id)
   {
       
                $_SQL = " select 'Event' type, e.firm_event_package_id,e.evet_package_id,e.event_package_pieces ,e.muaf_status,null start_dt,null end_dt,e.amount,
                    ep.package_name from firm_event_package e 
                    inner join prt_generalevet_package ep on ep.generalevent_package_id=e.evet_package_id   where e.firm_id=".$firm_id." and e.record_status=1
                     and e.active_status=0
                     union 
                    select 'Ticket',t.ticket_package_id,t.ticket_package_id, t.ticket_pieces,t.muaf_status,null,null,t.amount,tt.ticket_name  
                    from firm_ticket_package t 
                    inner join prt_generalticket_package tt on tt.ticket_pacage_id=t.ticket_package_id
                    where t.firm_id=".$firm_id." and t.record_status=1  and t.active_status=0
                    union 
                   select 'Photo',p.firm_photo_package_id,p.photo_package_id,  p.photo_count,p.muaf_status,null,null,p.amount,pp.package_name from firm_photo_package p  
                    inner join prt_generalphoto_package pp on pp.photo_pacage_id=p.photo_package_id
                    where p.firm_id=".$firm_id." and p.record_status=1 
                    union
                    select 'Portal Usage',p.firmportal_usage_id,f.usage_package_id, c.pieces,p.muaf_status,p.start_dt,p.end_dt,c.amout,g.name  from firm_portal_usage p  
                    inner join firm_ourservices_cost c on c.firm_id=p.firm_id and c.firm_portal_usage_id=p.firmportal_usage_id and p.start_dt<= CURDATE() 
                    and p.end_dt>=CURDATE()
                    inner join firm f on f.firm_id=p.firm_id
                    inner join prt_invoivegroup g on g.prt_invoivegroup_id=c.invoice_group_id and  c.invoice_group_id=5
                    where p.firm_id=".$firm_id." and p.record_status=1 and (p.start_dt< CURDATE() 
                    and p.end_dt<CURDATE()) ";

                    $query = $this->db->query($_SQL);
                    return $query->result_array();
   }
   
   public function getActivePackages($firm_id)
   {
       
                $_SQL = " select 'Event' type, e.firm_event_package_id,e.evet_package_id,e.event_package_pieces ,e.muaf_status,null start_dt,null end_dt,e.amount,
                    ep.package_name from firm_event_package e 
                    inner join prt_generalevet_package ep on ep.generalevent_package_id=e.evet_package_id   where e.firm_id=".$firm_id." and e.record_status=1
                        and e.start_dt<= CURDATE() 
                    and e.end_dt>=CURDATE()
                    union 
                    select 'Ticket',t.ticket_package_id,t.ticket_package_id, t.ticket_pieces,t.muaf_status,null start_dt,null end_dt,t.amount,tt.ticket_name  
                    from firm_ticket_package t 
                    inner join prt_generalticket_package tt on tt.ticket_pacage_id=t.ticket_package_id
                    where t.firm_id=".$firm_id." and t.record_status=1 and t.start_dt<= CURDATE() 
                    and t.end_dt>=CURDATE()
                    union 
                    select 'Photo',p.firm_photo_package_id,p.photo_package_id,  p.photo_count,p.muaf_status,null,null,p.amount,pp.package_name from firm_photo_package p  
                    inner join prt_generalphoto_package pp on pp.photo_pacage_id=p.photo_package_id
                    where p.firm_id=".$firm_id." and p.record_status=1 
                    union
                    select 'Portal Usage',p.firmportal_usage_id,f.usage_package_id, c.pieces,p.muaf_status,p.start_dt,p.end_dt,c.amout,g.name  from firm_portal_usage p  
                    inner join firm_ourservices_cost c on c.firm_id=p.firm_id and c.firm_portal_usage_id=p.firmportal_usage_id and p.start_dt<= CURDATE() 
                    and p.end_dt>=CURDATE()
                    inner join firm f on f.firm_id=p.firm_id
                    inner join prt_invoivegroup g on g.prt_invoivegroup_id=c.invoice_group_id and c.invoice_group_id=5
                    where p.firm_id=".$firm_id." and p.record_status=1";

                    $query = $this->db->query($_SQL);
                    return $query->result_array();
   }
     public function getAllEvents($firm_id,$language_id)
   {
       
         $_SQL = "SELECT     fe.firm_event_id ,fe.start_dt,fe.finish_dt,fe.start_hour,fe.end_hour,fl.firm_event_txt,fl.event_header,case when fe.approved_status=0 then 'Not approved' else 'Approved' end status                
                from firm_event fe 
                inner join firm_event_language fl on fl.firm_event_id=fe.firm_event_id and fl.language_id=".$language_id." and  fe.record_status=1   
                and fl.record_status=1 and fe.`firm_id`=".$firm_id."
                 where fe.record_status=1";
         
            $query = $this->db->query($_SQL);
            return $query->result_array();
   }

         public function getAllTickets($firm_id,$language_id)
   {
       
         $_SQL = "SELECT     fe.ticket_id ,fe.ticket_start_dt,fe.ticket_end_dt,fe.start_hour,fe.end_hour,fl.explanation,case when fe.approved_status=0 then 'Not approved' else 'Approved' end status                
                from firm_ticket_durumu fe 
                inner join firm_ticket_explanation fl on fl.ticket_id=fe.ticket_id and fl.language_id=".$language_id." and  fe.record_status=1   
                and fl.record_status=1 and fe.`firm_id`=".$firm_id." 
                 where fe.record_status=1
          ";
         
            $query = $this->db->query($_SQL);
            return $query->result_array();
   }
   

     public function getEventsbyNextPackages($firm_id)
   {
       
    $_SQL = "SELECT e.firm_event_package_id,  e.firm_id,e.ourservice_cost_id,e.evet_package_id,e.event_package_pieces,e.support_package_status,
                    e.muaf_status,e.amount,e.next_event_package_id,
                case when e.active_status=1 then 'Aktive' else 'Passive' end active_status,d.firm_invoice_id
                FROM firm_event_package e 
                left outer join invoice_detail d on d.ourservice_cost_id=e.ourservice_cost_id
                where e.firm_id=".$firm_id;

            $query = $this->db->query($_SQL);
            return $query->result_array();
   }
        
          
            public function getExplanations($firm_id)
   {
       
                $_SQL = "SELECT e.firmexplanation_id, e.language_id, e.firm_text,p.language_name_txt,e.firm_id
               FROM firm_explanation e  inner join prt_language p on p.language_id=e.language_id and e.record_status=1
                and e.firm_id=".$firm_id;

            $query = $this->db->query($_SQL);
            return $query->result_array();
   }
               public function getPayments($firm_id)
   {
       
                $_SQL = " SELECT i.firm_invoice_id,i.invoice_dt,i.net,i.tax,i.amount,i.pre_payment_amount,c.name currency,l.language_name_txt,
                    case when i.paid_status=0 then 'not completed' else 'completed' end payment_status,i.paid_status 
                    FROM invoice i 
                    inner join prt_currency c on i.currency_kd= c.prt_currency_id
                    inner join prt_language l on l.language_id=i.language_id where  i.firm_id=".$firm_id;

                    $query = $this->db->query($_SQL);
                    return $query->result_array();
   }
    public function getFirmsNotUsage($firmnr, $firmname,$district,$country_kd,$city_kd) {


         $_SQL = "SELECT distinct f.name_txt,f.firm_id,il.email,il.webpage,il.facebook,il.adress,
            ct.Name country,cy.Name city,il.iletisim_id,il.ort distict,il.instagram, il.twitter,
            ilt.phone,ilt.mobile_phone,ilt.fax, c.create_invoice_status,f.approved_status
            FROM firm f
            inner join iletisim il on il.firm_id=f.firm_id and f.notportalusage=0
            inner join countries ct on ct.country_kd=il.country_kd
            inner join iletisim_tel ilt on ilt.iletisim_id=il.iletisim_id and ilt.record_status=1
            inner join city cy on cy.city_kd=il.city_kd 
            left outer join  firm_ourservices_cost c on c.firm_id=f.firm_id and c.invoice_group_id=11 ";

        if (!empty($firmnr)) {
            $_SQL = $_SQL . "  where  f.firm_id=" . $firmnr;
        } else {
            $first = 0;
            if (!empty($district)) {
                if ($first == 1) {
                    $_SQL = $_SQL . " and il.ort =" . $district;
                } else {
                   $_SQL = $_SQL . " where il.ort =" . $district;
                    $first == 1;
                }
                    
                            }
            if (!empty($country_kd)) {
                
                if ($first == 1) {
                    $_SQL = $_SQL . " and f.country_kd= " . $country_kd;
                } else {
                   $_SQL = $_SQL . " where  f.country_kd= " . $country_kd;
                    $first == 1;
                }
                 
               
            }
              if (!empty($city_kd)) {
                
                if ($first == 1) {
                    $_SQL = $_SQL . " and f.city_kd= " . $city_kd;
                } else {
                   $_SQL = $_SQL . " where  f.city_kd= " . $city_kd;
                    $first == 1;
                }
                 
               
            }
            if (!empty($firmname)) {
                 if ($first == 1) {
                     $_SQL = $_SQL . " and f.name_txt like " . "'%" . $firmname . "%'";
                } else {
                    $_SQL = $_SQL . " where f.name_txt like " . "'%" . $firmname . "%'";
                    $first == 1;
                }
                   
          }

            
        }
        $query = $this->db->query($_SQL);
        return $query->result_array();
        //return $_SQL;
    }    
    public function getFirms($firmnr, $firmname,$district,$country_kd,$city_kd) {


         $_SQL = "SELECT distinct f.name_txt,f.firm_id,il.email,il.webpage,il.facebook,il.adress,
            ct.Name country,cy.Name city,il.iletisim_id,il.ort distict,il.instagram, il.twitter,
            ilt.phone,ilt.mobile_phone,ilt.fax, c.create_invoice_status,f.approved_status
            FROM firm f
            inner join iletisim il on il.firm_id=f.firm_id and f.notportalusage=0
            inner join countries ct on ct.country_kd=il.country_kd
            inner join iletisim_tel ilt on ilt.iletisim_id=il.iletisim_id and ilt.record_status=1
            inner join city cy on cy.city_kd=il.city_kd 
            inner join  firm_ourservices_cost c on c.firm_id=f.firm_id and c.invoice_group_id=11 and c.create_invoice_status=1 ";

        if (!empty($firmnr)) {
            $_SQL = $_SQL . "  and  f.firm_id=" . $firmnr;
        }
        if ($country_kd!="-1") {
            $_SQL = $_SQL . " and f.country_kd= " . $country_kd;

        }
        if (!empty($city_kd)) {
            $_SQL = $_SQL . " and f.city_kd= " . $country_kd;

        }
        if ($district!="-1") {

            $_SQL = $_SQL . " and il.ort =" . $district;
        }
        if (!empty($firmname)) {
            $_SQL = $_SQL . " and f.name_txt like " . "'%" . $firmname . "%'";
        }
        //print_r($_SQL);
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
     
    public function getFirmsformessage( $firmname,$country_kd,$city_kd) {


         $_SQL = "SELECT distinct f.name_txt,f.firm_id,il.email,il.webpage,il.facebook,il.adress,
            ct.Name country,cy.Name city,il.iletisim_id,il.ort distict,il.instagram, il.twitter,
            ilt.phone,ilt.mobile_phone,ilt.fax
            FROM firm f
            inner join iletisim il on il.firm_id=f.firm_id 
            inner join countries ct on ct.country_kd=il.country_kd
            inner join iletisim_tel ilt on ilt.iletisim_id=il.iletisim_id and ilt.record_status=1
            inner join city cy on cy.city_kd=il.city_kd 
             ";

        
            $first = 0;
          
            if (!empty($country_kd)) {
                
                if ($first == 1) {
                    $_SQL = $_SQL . " and f.country_kd= " . $country_kd;
                } else {
                   $_SQL = $_SQL . " where  f.country_kd= " . $country_kd;
                    $first == 1;
                }
                 
               
            }
              if (!empty($city_kd)) {
                
                if ($first == 1) {
                    $_SQL = $_SQL . " and f.city_kd= " . $city_kd;
                } else {
                   $_SQL = $_SQL . " where  f.city_kd= " . $city_kd;
                    $first == 1;
                }
                 
               
            }
            if (!empty($firmname)) {
                 if ($first == 1) {
                     $_SQL = $_SQL . " and f.name_txt like " . "'%" . $firmname . "%'";
                } else {
                    $_SQL = $_SQL . " where f.name_txt like " . "'%" . $firmname . "%'";
                    $first == 1;
                }
           
            }
        $query = $this->db->query($_SQL);
        return $query->result_array();
        //return $_SQL;
    }    
     public function getUsersformessage($username,$country_kd,$city_kd) {


         $_SQL = "SELECT `user_id`, `email`, concat(`name`,' ',`surname`) name, `password`, `question`, `answer`, `uyelik_tarihi`, 
             `firm_id`, `country_kd`, `city_kd` FROM `users` WHERE record_status=1
             ";

        
            $first = 1;
          
            if (!empty($country_kd)) {
                
                if ($first == 1) {
                    $_SQL = $_SQL . " and country_kd= " . $country_kd;
                } else {
                   $_SQL = $_SQL . " where  country_kd= " . $country_kd;
                    $first == 1;
                }
                 
               
            }
              if (!empty($city_kd)) {
                
                if ($first == 1) {
                    $_SQL = $_SQL . " and city_kd= " . $city_kd;
                } else {
                   $_SQL = $_SQL . " where  city_kd= " . $city_kd;
                    $first == 1;
                }
                 
               
            }
            if (!empty($username)) {
                     $_SQL = $_SQL . " and ( f.name like " . "'%" . $username . "%'" ." or f.name like " . "'%" . $username . "%')";
             
            }
        $query = $this->db->query($_SQL);
        return $query->result_array();
        //return $_SQL;
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
    public function getExplanationssbyFirmId($firmid){
    
      $_SQL = "SELECT fe.firmexplanation_id ,fe.language_id,fe.firm_text, fe.record_status,l.language_name_txt  "
              . "FROM `firm_explanation` fe inner join prt_language l on l.language_id=fe.language_id WHERE fe.firm_id=".$firmid;
     
      $query = $this->db->query($_SQL);
      return $query->result_array();
     }
     public function getPhotosbyFirm($firmid){
    
      $_SQL = "SELECT `photo_id`,`picturetipi_id`,`path`,`country_id`,`record_status`,`order`  FROM `photos` WHERE `firm_id`=".$firmid;
              
      $query = $this->db->query($_SQL);
      return $query->result_array();
     }
     
     public function getFirmbyCountrybyCitybyDistrict($country_kd,$city_kd,$district) {

        $_SQL = "SELECT  f.firm_id,f.name_txt,i.email,i.ort "
                . "FROM firm f inner join iletisim i "
                . "where f.firm_id=i.firm_id";
        if($country_kd!="-1"){  $_SQL .= " and f.country_kd=".$country_kd; }
       if($city_kd!="-1"){  $_SQL .= " and f.city_kd=".$city_kd; }
       if($district!="-1"){  $_SQL .= " and i.ort=".$city_kd; }

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
    
    public function getFirminFirmListbyCountrybyCitybyDistrict($country_kd,$city_kd,$district) {
        
        $_SQL = "SELECT * "
                . "FROM firm_list f  "
                . "where f.record_status=1";
        if($country_kd!="-1"){ 
            
                $_SQL .= " and f.country_kd=".$country_kd;
            
        }
       if($city_kd!="-1"){ 
           
                $_SQL .= " and f.city_kd=".$city_kd;
            
            
           
       }
       if($district!="-1"){ 
           
                  $_SQL .= " and i.ort=".$city_kd;
            
          
           
       }

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }


    public function getFirmUsersbyFirmID($firmid){

        $_SQL = "SELECT u.name,u.surname,u.iletisim_id,u.email,it.phone,p.path FROM users u 
                inner join iletisim i on i.user_id=u.user_id and i.iletisim_id=u.iletisim_id and i.record_status=1
                inner join iletisim_tel it on it.iletisim_id=i.iletisim_id and it.record_status =1
                inner join photos p on p.firm_id=u.firm_id and p.record_status=1
                WHERE u.firm_id=".$firmid;
        $query = $this->db->query($_SQL);
        return $query->result_array();

    }

    public function  getFirmPaymentsTypebyFirmIDWithLang($firm_id,$lang_id){
        $_SQL = " Select pl.text from firm_payment_type fpt 
                inner join prt_firmpayment_type p on p.record_status=1 and fpt.type_id=p.prt_firmpayment_type_id 
                inner join prt_firmpayment_type_language pl on pl.record_status=1 and pl.prt_firmpayment_type_id=p.prt_firmpayment_type_id 
                where fpt.record_status=1 and fpt.firm_id=".$firm_id." and pl.language_id=".$lang_id;

        $query = $this->db->query($_SQL);
        return $query->result_array();

    }

    public function  getFirmPaymentsTypebyFirmID($firm_id){
        $_SQL = " Select pl.text,fpt.type_id,fpt.record_status from firm_payment_type fpt 
                inner join prt_firmpayment_type p on p.record_status=1 and fpt.type_id=p.prt_firmpayment_type_id 
                inner join prt_firmpayment_type_language pl on pl.record_status=1 and pl.prt_firmpayment_type_id=p.prt_firmpayment_type_id 
                where  fpt.firm_id=".$firm_id." and pl.language_id=112";

        $query = $this->db->query($_SQL);
        return $query->result_array();

    }

    public function  getServicesGivenLangbyFirmIDwithLangID($firm_id){
        $_SQL = "SELECT l.language_name_txt FROM firm_servicegiven_language fsl
                inner join prt_language l on l.record_status=1 and l.language_id=fsl.language_id
                WHERE fsl.firm_id=".$firm_id." and fsl.record_status=1";

        $query = $this->db->query($_SQL);
        return $query->result_array();

    }

     public function  getAllInvoiceByFirmIDAndFirmType($firm_id,$firmType){
         
         if($firmType=="2"){
              $_SQL = "select  fo.firm_id,fo.name_txt,i.firm_invoice_id,ins.installment_count,i.amount,i.invoice_dt,i.language_id,idt.real_invoice_id,case i.paid_status when '0' then 'Wait Paid' when '1' then 'Paid' end paymentStatus  from firm_other fo
                inner join invoice i on i.record_status=1 and i.firm_type=2 and i.firm_id=fo.firm_id
                inner join invoice_detail idt on idt.record_status=1 and idt.firm_invoice_id=i.firm_invoice_id and idt.invoice_group_id=12
                inner join firm_invoice_installment ins on ins.record_status=1 and ins.invoice_id=i.firm_invoice_id
                inner join firm_invoice_installment_detail insd on insd.record_status=1 and insd.invoice_id=ins.invoice_id
                where fo.record_status=1 and i.firm_id=".$firm_id." and i.firm_type=".$firmType;

              $query = $this->db->query($_SQL);
              return $query->result_array();
         }
       

    }
    
     public function  getAllInvoiceByFirmID($firm_id){
        $_SQL = " SELECT * FROM `invoice` WHERE record_status=1 and invoice_status=1 and  firm_id= ".$firm_id;

        $query = $this->db->query($_SQL);
        return $query->result_array();

    }
public function  getPhotosbyFirmId($firm_id){
        $_SQL = " SELECT * FROM `photos` WHERE record_status=1 and  firm_id= ".$firm_id;

        $query = $this->db->query($_SQL);
        return $query->result_array();

    }

public function  getPhotosIDbyFirmIDandOrder($number,$firmID){
        $_SQL = " SELECT photo_id FROM `photos` WHERE record_status=1 and `order`=" .$number." and  firm_id= ".$firmID;

        $query = $this->db->query($_SQL);
        return $query->result_array();

    }



}
