<?php
class firmApprove_model extends CI_Model {

function getWaitinApprovedFirm($country_kd)
     {
     $_SQL = "select k.firm_id,fr.name_txt,il.adress,c.Name city,concat(u.name,' ',u.surname) username from (
              SELECT f.firm_id, count(p.record_process_id) count FROM  firm_record_process p inner join firm f on f.firm_id=p.firm_id
            and f.approved_status=0 and p.completed=1 and f.country_kd=".$country_kd.
            " group by f.firm_id) k
            inner join firm fr on fr.firm_id=k.firm_id 
            inner join iletisim il on il.firm_id=k.firm_id and il.record_status=1 
            inner join city c on c.city_kd=il.city_kd
            inner join users u on u.user_id=fr.representive_id

            where k.count = (SELECT count(*)-1 FROM prt_firm_record_process)";
     
        $query = $this->db->query($_SQL);
        return $query->result_array();
     }  
     function getApprovedFirm($country_kd)
     {
     $_SQL = "select k.firm_id,fr.name_txt,il.adress,c.Name city,concat(u.name,' ',u.surname) username from (
              SELECT f.firm_id, count(p.record_process_id) count FROM  firm_record_process p inner join firm f on f.firm_id=p.firm_id
            and f.approved_status=1 and p.completed=1 and f.country_kd=".$country_kd.
            " group by f.firm_id) k
            inner join firm fr on fr.firm_id=k.firm_id 
            inner join iletisim il on il.firm_id=k.firm_id and il.record_status=1 
            inner join city c on c.city_kd=il.city_kd
            inner join users u on u.user_id=fr.representive_id

            where k.count = (SELECT count(*) FROM prt_firm_record_process)";
     
        $query = $this->db->query($_SQL);
        return $query->result_array();
     }  
       function getMissingProcessFirm($country_kd)
     {
        $_SQL = "select k.firm_id,fr.name_txt,il.adress,c.Name city,concat(u.name,' ',u.surname) username from (
              SELECT f.firm_id, count(p.record_process_id) count FROM  firm_record_process p inner join firm f on f.firm_id=p.firm_id
            and f.approved_status=0 and p.completed=1 and f.country_kd=".$country_kd.
            " group by f.firm_id) k
            inner join firm fr on fr.firm_id=k.firm_id
            inner join iletisim il on il.firm_id=k.firm_id and il.record_status=1 
            inner join city c on c.city_kd=il.city_kd
            inner join users u on u.user_id=fr.representive_id

            where k.count < (SELECT count(*)-1 FROM prt_firm_record_process where record_status=1)";
     
        $query = $this->db->query($_SQL);
        return $query->result_array();
     }
      function getFirmProcessDetail($firm_id)
     {
        $_SQL = "select k.record_process_txt,case when p.completed=0 then 'not ok' else  'ok' end completed ,p.firm_id,
        case when p.get_status=0 then 'not ok' else 'ok' end status from firm_record_process p inner join prt_firm_record_process k on p.record_process_id=k.record_process_id
        where p.firm_id=".$firm_id." order by k.order_id";
     
        $query = $this->db->query($_SQL);
        return $query->result_array();
     }
      function getFirmEventLanguages($event_id)
     {
        $_SQL = "select distinct e.firm_event_id,e.start_dt,e.finish_dt,l.firm_event_txt,l.event_header,case when l.first_record=0 then 'First' else '' end first_record,
            pl.language_name_txt,e.start_hour,e.end_hour,l.insert_dt,e.approved_status ,f.name_txt 
            from firm_event e inner join firm_event_language l 
            on e.firm_event_id=l.firm_event_id and l.record_status=1 and e.record_status=1 
            inner join prt_translate_languages tl on tl.language_id=l.language_id and tl.record_status=1
            inner join prt_language pl on pl.language_id=tl.language_id and l.language_id=pl.language_id
            inner join firm f on f.firm_id=e.firm_id
            where e.firm_event_id=".$event_id;
     
        $query = $this->db->query($_SQL);
        return $query->result_array();
     }
      function getFirmDiscountLanguages($ticket_id)
     {
        $_SQL = "select distinct e.ticket_id,e.ticket_start_dt start_dt,e.ticket_end_dt finish_dt,l.explanation,case when l.first_record=0 then 'First' else '' end first_record,
            pl.language_name_txt,e.start_hour,e.end_hour,l.insert_dt,e.approved_status ,f.name_txt 
            from firm_ticket_durumu e inner join firm_ticket_explanation l 
            on e.ticket_id=l.ticket_id and l.record_status=1 and e.record_status=1 
            inner join prt_translate_languages tl on tl.language_id=l.language_id and tl.record_status=1
            inner join prt_language pl on pl.language_id=tl.language_id and l.language_id=pl.language_id
            inner join firm f on f.firm_id=e.firm_id
            where e.ticket_id=".$ticket_id;
     
        $query = $this->db->query($_SQL);
        return $query->result_array();
     }
     function getProcessCount($country_kd)
     {
        $_SQL = "SELECT count(*) count FROM prt_firm_record_process p ";
     
        $query = $this->db->query($_SQL);
        return $query->result_array();
     }  
     
      function firmApproved()
     {
           try { 
             $firm_id=$this->input->post("firm_id");
             $this->firmChangeProcess_model->FirmApproved($firm_id) ; 
            
             return true;
  
           }catch (Exception $e) {
             //alert the user.
              var_dump($e->getMessage());
             $deger=false;
           }
     }
     
     public function firmApprovedEvent($event_id, $data_event)
   {
        
        $deger=true;
        try { 
            
            $this->db->where('firm_event_id', $event_id);
            $this->db->update('firm_event', $data_event); 
             
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           $deger=false;
         }
  
         return $deger;     
   }
   public function firmApprovedDiscount($ticket_id, $data_ticket)
   {
        
        $deger=true;
        try { 
            
            $this->db->where('ticket_id', $ticket_id);
            $this->db->update('firm_ticket_durumu', $data_ticket); 
             
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           $deger=false;
         }
  
         return $deger;     
   }
   function getWaitinApprovedFirmEvents($country_kd)
     {
     $_SQL = "select fr.firm_id,fr.name_txt,il.adress,c.Name city,concat(u.name,' ',u.surname) username,e.start_dt,e.finish_dt,e.firm_event_id 
            ,e.start_hour,e.end_hour
            from
            firm fr 
            inner join iletisim il on il.firm_id=fr.firm_id and il.record_status=1 
            inner join city c on c.city_kd=il.city_kd
            inner join firm_event e on e.firm_id=fr.firm_id and e.record_status=0 and e.approved_status=0 
            inner join users u on u.user_id=e.insert_user_id
            where  (select count(l.firmevent_lang_id) from firm_event_language l where l.firm_event_id=e.firm_event_id and l.record_status=1) = 7";
     
        $query = $this->db->query($_SQL);
        return $query->result_array();
     }  
     function getApprovedFirmEvents($country_kd)
     {
     $_SQL = "select fr.firm_id,fr.name_txt,il.adress,c.Name city,concat(u.name,' ',u.surname) username,e.start_dt,e.finish_dt,e.firm_event_id ,e.start_hour,e.end_hour
            from firm fr 
            inner join iletisim il on il.firm_id=fr.firm_id and il.record_status=1 
            inner join city c on c.city_kd=il.city_kd
            inner join firm_event e on e.firm_id=fr.firm_id and e.record_status=1 and e.approved_status=1 
            inner join users u on u.user_id=e.insert_user_id
            
            ";
     
        $query = $this->db->query($_SQL);
        return $query->result_array();
     }  
       function getMissingProcessFirmEvents($country_kd)
     {
        $_SQL = "select fr.firm_id,fr.name_txt,il.adress,c.Name city,concat(u.name,' ',u.surname) username,e.start_dt,e.finish_dt,e.firm_event_id,
            e.start_hour,e.end_hour from
            firm fr 
            inner join iletisim il on il.firm_id=fr.firm_id and il.record_status=1 
            inner join city c on c.city_kd=il.city_kd
            inner join firm_event e on e.firm_id=fr.firm_id and e.record_status=1 and e.approved_status=0 
            inner join users u on u.user_id=e.insert_user_id            
            where  (select count(l.firmevent_lang_id) from firm_event_language l where l.firm_event_id=e.firm_event_id and l.record_status=1) <7";
     
        $query = $this->db->query($_SQL);
        return $query->result_array();
     }
     function getWaitinApprovedFirmDiscounts($country_kd)
     {
     $_SQL = "select fr.firm_id,fr.name_txt,il.adress,c.Name city,concat(u.name,' ',u.surname) username,e.ticket_start_dt start_dt,e.ticket_end_dt finish_dt,e.ticket_id 
            ,e.start_hour,e.end_hour
            from
            firm fr 
            inner join iletisim il on il.firm_id=fr.firm_id and il.record_status=1 
            inner join city c on c.city_kd=il.city_kd
            inner join firm_ticket_durumu e on e.firm_id=fr.firm_id and e.record_status=1 and e.approved_status=0 
            inner join users u on u.user_id=e.insert_user_id
            where  (select count(l.explanation) from firm_ticket_explanation l where l.ticket_id=e.ticket_id and l.record_status=1) = 7";
     
        $query = $this->db->query($_SQL);
        return $query->result_array();
     }  
     function getApprovedFirmDiscounts($country_kd)
     {
     $_SQL = "
            select fr.firm_id,fr.name_txt,il.adress,c.Name city,concat(u.name,' ',u.surname) username,e.ticket_start_dt start_dt,e.ticket_end_dt finish_dt,e.ticket_id 
            ,e.start_hour,e.end_hour
            from
            firm fr 
            inner join iletisim il on il.firm_id=fr.firm_id and il.record_status=1 
            inner join city c on c.city_kd=il.city_kd
            inner join firm_ticket_durumu e on e.firm_id=fr.firm_id and e.record_status=1 and e.approved_status=1 
            inner join users u on u.user_id=e.insert_user_id
            ";
     
        $query = $this->db->query($_SQL);
        return $query->result_array();
     }  
       function getMissingProcessFirmDiscounts($country_kd)
     {
        $_SQL = "select fr.firm_id,fr.name_txt,il.adress,c.Name city,concat(u.name,' ',u.surname) username,e.ticket_start_dt start_dt,e.ticket_end_dt finish_dt,e.ticket_id 
            ,e.start_hour,e.end_hour
            from
            firm fr 
            inner join iletisim il on il.firm_id=fr.firm_id and il.record_status=1 
            inner join city c on c.city_kd=il.city_kd
            inner join firm_ticket_durumu e on e.firm_id=fr.firm_id and e.record_status=1 and e.approved_status=0
            inner join users u on u.user_id=e.insert_user_id
            where  (select count(l.explanation) from firm_ticket_explanation l where l.ticket_id=e.ticket_id and l.record_status=1) < 7";
     
        $query = $this->db->query($_SQL);
        return $query->result_array();
     }
}