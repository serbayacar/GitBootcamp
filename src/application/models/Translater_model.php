<?php
class translater_model extends CI_Model {

    public function getPhotoWorks($county_kd,$city_kd){
       $_SQL = " SELECT p.firm_ourservices_photos_id, p.firm_ourservice_id, p.firm_id, p.photo_usage, p.processtype_id, p.photo_package_id,
                pp.pieces,pp.cost ,f.name_txt ,il.adress,ilt.mobile_phone,f.representive_id,concat(u.name,' ',u.surname) responsible,
                uit.mobile_phone   responsibletel
                FROM firm_ourservices_photos p
                inner join prt_generalphoto_package pp on pp.photo_pacage_id=p.photo_package_id and p.record_status=1 and p.photo_usage=1 and p.processtype_id=8
                inner join firm f on f.firm_id=p.firm_id and f.country_kd=".$county_kd." and f.city_kd=".$city_kd.
                " inner join iletisim il on il.firm_id=f.firm_id and il.record_status=1
                inner join iletisim_tel ilt on ilt.iletisim_id=il.iletisim_id and ilt.record_status=1
                inner join users u on u.user_id=f.representive_id
                inner join iletisim uil on uil.user_id=u.user_id and uil.record_status=1
                inner join iletisim_tel uit on uit.iletisim_id=uil.iletisim_id ";

        $query = $this->db->query($_SQL);
        return $query->result_array();
    
    }
      public function getTranslater($language_id){
       $_SQL = "  SELECT u.user_id,concat (u.name,' ',u.surname) name  FROM user_grup g 
                    inner join users u on u.user_id=g.user_id and u.record_status=1
                    inner join prt_user_grup ug on ug.group_id=g.group_id
                    inner join prt_language l on l.language_id=ug.usage_language_id
                    where g.record_status=1 and ug.usage_language_id= ".$language_id;

        $query = $this->db->query($_SQL);
        return $query->result_array();
     }
     public function getTranslateDelegationbyDelegateId($translater_delegate_id){
       $_SQL = " SELECT d.translater_delegate_id,d.process_dt,d.end_dt,concat('Firm Translation To ',l.language_name_txt) explanation,d.language_id,l.language_name_txt FROM translater_delegate d 
                 inner join prt_language l 
                on l.language_id=d.language_id and d.record_status=1 and d.processtype_id=10 and d.translater_delegate_id=".$translater_delegate_id;

        $query = $this->db->query($_SQL);
        return $query->result_array();
     }
     public function getTranslateEventbyDelegateId($translater_delegate_id,$event_id){
       $_SQL = " SELECT d.translater_delegate_id,d.process_dt,d.end_dt,concat('Firm Translation To ',l.language_name_txt) explanation,d.language_id,l.language_name_txt FROM translater_delegate d 
                 inner join prt_language l 
                on l.language_id=d.language_id and d.record_status=1 and d.processtype_id=10 and d.translater_delegate_id=".$translater_delegate_id;

        $query = $this->db->query($_SQL);
        return $query->result_array();
     }
        public function getTranslateDiscounbyDelegateId($translater_delegate_id,$discount_id){
       $_SQL = " SELECT d.translater_delegate_id,d.process_dt,d.end_dt,concat('Firm Translation To ',l.language_name_txt) explanation,d.language_id,l.language_name_txt FROM translater_delegate d 
                 inner join prt_language l 
                on l.language_id=d.language_id and d.record_status=1 and d.processtype_id=10 and d.translater_delegate_id=".$translater_delegate_id;

        $query = $this->db->query($_SQL);
        return $query->result_array();
     }
        public function getTranslatesEventForTranslater($event_id,$user_id){
       $_SQL = " select f.event_header,f.firm_event_txt,l.language_name_txt from firm_event_language f inner join prt_language l 
           on f.language_id=l.language_id
        where f.language_id in (select translate_from from user_translater_types  where user_id=".$user_id." ) and f.firm_event_id=".$event_id;
        $query = $this->db->query($_SQL);
        return $query->result_array();
     }
      public function getTranslatesDiscountForTranslater($discount_id,$user_id){
       $_SQL = " select f.explanation,l.language_name_txt from firm_ticket_explanation f inner join prt_language l 
           on f.language_id=l.language_id
        where f.language_id in (select translate_from from user_translater_types  where user_id=".$user_id." ) and f.ticket_id=".$firm_id;
        $query = $this->db->query($_SQL);
        return $query->result_array();
     }
      public function getTranslatesForTranslater($firm_id,$user_id){
       $_SQL = " select f.firm_text,l.language_name_txt from firm_explanation f inner join prt_language l 
           on f.language_id=l.language_id
        where f.language_id in (select translate_from from user_translater_types  where user_id=".$user_id." ) and f.firm_id=".$firm_id;
        $query = $this->db->query($_SQL);
        return $query->result_array();
     }
       public function getTranslateExplanation($firm_id,$language_id){
       $_SQL = " select ex.firm_text,p.language_name_txt from firm_explanation ex 
           inner join prt_language p on p.language_id=ex.language_id  and ex.record_status=1 
            and ex.language_id=$language_id and ex.firm_id=".$firm_id;
        $query = $this->db->query($_SQL);
        return $query->result_array();
     }
 public function getTranslateEventExplanation($firm_id,$language_id){
       $_SQL = " select ex.firm_text,p.language_name_txt from firm_explanation ex 
           inner join prt_language p on p.language_id=ex.language_id  and ex.record_status=1 
            and ex.language_id=$language_id and ex.firm_id=".$firm_id;
        $query = $this->db->query($_SQL);
        return $query->result_array();
     }
      public function getTranslateDiscounExplanation($firm_id,$language_id){
       $_SQL = " select ex.firm_text,p.language_name_txt from firm_explanation ex 
           inner join prt_language p on p.language_id=ex.language_id  and ex.record_status=1 
            and ex.language_id=$language_id and ex.firm_id=".$firm_id;
        $query = $this->db->query($_SQL);
        return $query->result_array();
     }
         public function getLanguagebyUserId($user_id){
       $_SQL = "  SELECT tl.language_id ,tl.language_name_txt FROM  user_translater_types t 
        inner join prt_language tl on tl.language_id=t.translate_to and t.user_id= ".$user_id;

        $query = $this->db->query($_SQL);
        return $query->result_array();
     } 
           public function getwaitingJobforDiscount($user_id,$language_id){
             $_SQL = " select d.translater_delegate_id,d.process_dt,d.end_dt ,f.firm_id,f.name_txt,f.firm_firstexplanation,d.event_id,d.discount_id 
                    from translater_delegate d inner join firm f on f.firm_id=d.firm_id and d.record_status=1
                    and f.record_status=1 
                    where 
                    d.discount_id not in (select fe.ticket_id from firm_ticket_explanation fe 
                                    where fe.ticket_id=d.discount_id and
                                    fe.language_id=d.language_id and d.language_id=".$language_id." ) and 
                                    d.processtype_id=12 and  d.language_id=".$language_id."  and d.user_id=".$user_id;
     

                $query = $this->db->query($_SQL);
                return $query->result_array();
            }
                public function getfinishJobforDiscount($user_id,$language_id){
                $_SQL = " select fe.insert_dt,  d.translater_delegate_id,d.process_dt,d.end_dt ,f.firm_id,f.name_txt,f.firm_firstexplanation,d.event_id,d.discount_id
                    from translater_delegate d inner join firm f on f.firm_id=d.firm_id and d.record_status=1
                    and f.record_status=1 
                    inner join firm_ticket_explanation fe on fe.ticket_id=d.discount_id and 
                                    fe.language_id =d.language_id and d.language_id=".$language_id." and fe.insert_user_id=".$user_id."
                                       and d.processtype_id=12 and  d.language_id=".$language_id."  and d.user_id=".$user_id;
             
                  $query = $this->db->query($_SQL);
                return $query->result_array();
            }
            public function getwaitingJobforEvent($user_id,$language_id){
             $_SQL = " select d.translater_delegate_id,d.process_dt,d.end_dt ,f.firm_id,f.name_txt,f.firm_firstexplanation,d.event_id,d.discount_id 
                    from translater_delegate d inner join firm f on f.firm_id=d.firm_id and d.record_status=1
                    and f.record_status=1 
                    where 
                    d.event_id not in (select fe.firm_event_id from firm_event_language fe 
                                    where fe.firm_event_id=d.event_id and
                                    fe.language_id=d.language_id and d.language_id=".$language_id.") and 
                                    d.processtype_id=11 and  d.language_id=".$language_id."  and d.user_id=".$user_id;
     

                $query = $this->db->query($_SQL);
                return $query->result_array();
            }
                public function getfinishJobforEvent($user_id,$language_id){
                $_SQL = " select fe.insert_dt,  d.translater_delegate_id,d.process_dt,d.end_dt ,f.firm_id,f.name_txt,f.firm_firstexplanation,d.event_id,d.discount_id
                    from translater_delegate d inner join firm f on f.firm_id=d.firm_id and d.record_status=1
                    and f.record_status=1 
                    inner join firm_event_language fe on fe.firm_event_id=d.event_id and 
                                    fe.language_id=d.language_id and d.language_id=".$language_id." and fe.insert_user_id=".$user_id."
                                       and d.processtype_id=11 and  d.language_id=".$language_id."  and d.user_id=".$user_id;
             
        
                $query = $this->db->query($_SQL);
                return $query->result_array();
            }
  
             public function getwaitingJob($user_id,$language_id){
             $_SQL = " select d.translater_delegate_id,d.process_dt,d.end_dt ,f.firm_id,f.name_txt,f.firm_firstexplanation
                    from translater_delegate d inner join firm f on f.firm_id=d.firm_id and d.record_status=1
                    and f.record_status=1 
                    where 
                    d.firm_id not in (select fe.firm_id from firm_explanation fe 
                                    where fe.firm_id=d.firm_id and 
                                    fe.language_id=d.language_id and d.language_id=".$language_id." ) and 
                                    d.processtype_id=10 and  d.language_id=".$language_id."  and d.user_id=".$user_id;
               $query = $this->db->query($_SQL);
                return $query->result_array();
            }
             public function getfinishJob($user_id,$language_id){
                $_SQL = " select fe.insert_dt,  d.translater_delegate_id,d.process_dt,d.end_dt ,f.firm_id,f.name_txt,f.firm_firstexplanation
                    from translater_delegate d inner join firm f on f.firm_id=d.firm_id and d.record_status=1
                    and f.record_status=1 
                    inner join firm_explanation fe on fe.firm_id=d.firm_id and 
                                    fe.language_id=d.language_id and d.language_id=".$language_id." and fe.insert_user_id=".$user_id."
                                       and d.processtype_id=10 and  d.language_id=".$language_id."  and d.user_id=".$user_id;
             
                                    
     

                $query = $this->db->query($_SQL);
                return $query->result_array();
            }
    public function getTranslateLanguages($country_kd){
        
       $_SQL = "  SELECT tl.language_id,l.language_name_txt
                   FROM prt_translate_languages tl inner join prt_language l on l.language_id=tl.language_id WHERE country_kd=".$country_kd." and tl.record_status=1";

        $query = $this->db->query($_SQL);
        return $query->result_array();
     }
       public function getEventDates($event_id){
        
       $_SQL = "  SELECT e.start_dt,e.finish_dt end_dt FROM firm_event e where e.firm_event_id=".$event_id;

        $query = $this->db->query($_SQL);
        return $query->result_array();
     }
     
     public function getTicketDates($discount_id){
        
       $_SQL = "  SELECT e.ticket_start_dt start_dt,e.ticket_end_dt end_dt FROM firm_ticket_durumu e where e.ticket_id=".$discount_id;

        $query = $this->db->query($_SQL);
        return $query->result_array();
     }
     
     public function getFirmTranslateLanguages($firm_id){
        
       $_SQL = "  SELECT '0' translater_delegate_id,l.language_name_txt, 0 user_id,'' name ,l.language_id,
            e.insert_dt process_dt ,e.insert_dt end_dt, e.record_status,e.firm_text
            FROM prt_translate_languages tl 
            inner  join prt_language l on l.language_id=tl.language_id and tl.record_status=1
            inner  join firm_explanation e on e.language_id=tl.language_id and e.firm_id=".$firm_id.
             " union
            sELECT d.translater_delegate_id,l.language_name_txt, u.user_id,concat (u.name,' ',u.surname) name ,l.language_id,
            d.process_dt,d.end_dt, d.record_status,''
            FROM prt_translate_languages tl 
            inner  join prt_language l on l.language_id=tl.language_id and tl.record_status=1
            inner join translater_delegate d on  d.language_id=tl.language_id and d.firm_id=".$firm_id." and 
            d.processtype_id=10 and d.completed_status=0
            inner  join   users u on d.user_id=u.user_id and  d.user_id=u.user_id and  u.record_status=1";

        $query = $this->db->query($_SQL);
        return $query->result_array();
     }
     public function getEventTranslateLanguages($event_id){
        
       $_SQL = " sELECT '0' translater_delegate_id,l.language_name_txt, 0 user_id,'' name ,l.language_id,
            e.insert_dt process_dt ,e.insert_dt end_dt, e.record_status,e.firm_event_txt ,e.event_header
            FROM prt_translate_languages tl 
            inner  join prt_language l on l.language_id=tl.language_id and tl.record_status=1
            inner  join firm_event_language e on e.language_id=tl.language_id and e.firm_event_id=".$event_id."
            union
            sELECT d.translater_delegate_id,l.language_name_txt, u.user_id,concat (u.name,' ',u.surname) name ,l.language_id,
            d.process_dt,d.end_dt, d.record_status,'',''
            FROM prt_translate_languages tl 
            inner  join prt_language l on l.language_id=tl.language_id and tl.record_status=1
            inner join translater_delegate d on  d.language_id=tl.language_id and d.event_id=".$event_id." and 
            d.event_id not in(select fe.firm_event_id from firm_event_language fe where fe.firm_event_id=".$event_id." and 
            d.language_id=fe.language_id)
            inner  join   users u on d.user_id=u.user_id and  d.user_id=u.user_id and  u.record_status=1";

        $query = $this->db->query($_SQL);
        return $query->result_array();
     }
       public function getDiscountTranslateLanguages($discount_id){
        
       $_SQL = "  sELECT '0' translater_delegate_id,l.language_name_txt, 0 user_id, '' name ,l.language_id,
            e.insert_dt process_dt ,e.insert_dt end_dt, e.record_status,e.explanation 
            FROM prt_translate_languages tl 
            inner  join prt_language l on l.language_id=tl.language_id and tl.record_status=1
            inner  join firm_ticket_explanation e on e.language_id=tl.language_id and e.ticket_id=".$discount_id."
            union
            sELECT d.translater_delegate_id,l.language_name_txt, u.user_id,concat (u.name,' ',u.surname) name ,l.language_id,
            d.process_dt,d.end_dt, d.record_status,et.explanation
            FROM prt_translate_languages tl 
            inner  join prt_language l on l.language_id=tl.language_id and tl.record_status=1
            inner join translater_delegate d on  d.language_id=tl.language_id and d.discount_id=".$discount_id." 
            inner  join   users u on d.user_id=u.user_id and  d.user_id=u.user_id and  u.record_status=1
            left outer join firm_ticket_explanation et on et.ticket_id=d.discount_id and d.record_status=1 and et.language_id=d.language_id";

        $query = $this->db->query($_SQL);
        return $query->result_array();
     }
    
     public function getAllTranslate($county_kd){
       $_SQL = " select g.firm_id,g.name_txt,
                (SELECT count(1) FROM firm f 
                inner join firm_explanation e on e.firm_id=f.firm_id left outer join translater_delegate d on d.processtype_id=10
                 AND d.firm_id=f.firm_id and e.firm_id=d.firm_id and d.language_id=137
                where  f.record_status=1 and e.record_status=1 and e.language_id=137 and g.firm_id=f.firm_id
                group by f.firm_id) german,

                (SELECT count(1) FROM firm f 
                inner join firm_explanation e on e.firm_id=f.firm_id left outer join translater_delegate d on d.processtype_id=10
                 AND d.firm_id=f.firm_id and e.firm_id=d.firm_id and d.language_id=112
                where  f.record_status=1 and e.record_status=1 and e.language_id=112 and g.firm_id=f.firm_id
                group by f.firm_id) english,

                
                (SELECT count(1) FROM firm f 
                inner join firm_explanation e on e.firm_id=f.firm_id left outer join translater_delegate d on d.processtype_id=10
                 AND d.firm_id=f.firm_id and e.firm_id=d.firm_id and d.language_id=430
                where  f.record_status=1 and e.record_status=1 and e.language_id=430 and g.firm_id=f.firm_id
                group by f.firm_id) turkish,

                
                (SELECT count(1) FROM firm f 
                inner join firm_explanation e on e.firm_id=f.firm_id left outer join translater_delegate d on d.processtype_id=10
                 AND d.firm_id=f.firm_id and e.firm_id=d.firm_id and d.language_id=178
                where  f.record_status=1 and e.record_status=1 and e.language_id=178 and g.firm_id=f.firm_id
                group by f.firm_id) italian,

               
                (SELECT count(1) FROM firm f 
                inner join firm_explanation e on e.firm_id=f.firm_id left outer join translater_delegate d on d.processtype_id=10
                 AND d.firm_id=f.firm_id and e.firm_id=d.firm_id and d.language_id=17
                where  f.record_status=1 and e.record_status=1 and e.language_id=17 and g.firm_id=f.firm_id
                group by f.firm_id)  arabish,

                
                (SELECT count(1) FROM firm f 
                inner join firm_explanation e on e.firm_id=f.firm_id left outer join translater_delegate d on d.processtype_id=10
                 AND d.firm_id=f.firm_id and e.firm_id=d.firm_id and d.language_id=354
                where  f.record_status=1 and e.record_status=1 and e.language_id=354 and g.firm_id=f.firm_id
                group by f.firm_id)  russian,

                
                (SELECT count(1) FROM firm f 
                inner join firm_explanation e on e.firm_id=f.firm_id left outer join translater_delegate d on d.processtype_id=10
                 AND d.firm_id=f.firm_id and e.firm_id=d.firm_id and d.language_id=437
                where  f.record_status=1 and e.record_status=1 and e.language_id=437 and g.firm_id=f.firm_id
                group by f.firm_id)  farsi 
                
                from firm g 
                inner join invoice i on i.firm_id=g.firm_id and g.notportalusage=0 and g.country_kd=".$county_kd."  
                and i.prepayment_status=1";

        $query = $this->db->query($_SQL);
        return $query->result_array();
    
    }
     public function getAllEventTranslate($county_kd){
       $_SQL = " select * from (
                 select distinct l.firm_event_id event_id,f.name_txt,f.firm_id,ev.start_dt start_dt,ev.finish_dt finish_dt,
                 ( select count(1) count from firm_event_language e left outer JOIN  translater_delegate d on d.event_id=e.firm_event_id and  d.processtype_id=11  and d.language_id=137 and d.record_status=1 where e.firm_event_id=l.firm_event_id and e.language_id=137) german,

                   ( select count(1) count from firm_event_language e left outer JOIN  translater_delegate d on d.event_id=e.firm_event_id and  d.processtype_id=11  and d.language_id=112 and d.record_status=1 where e.firm_event_id=l.firm_event_id and e.language_id=112) english,
                
                    ( select count(1) count from firm_event_language e left outer JOIN  translater_delegate d on d.event_id=e.firm_event_id and  d.processtype_id=11  and d.language_id=430 and d.record_status=1 where e.firm_event_id=l.firm_event_id and e.language_id=430) turkish,

                   ( select count(1) count from firm_event_language e left outer JOIN  translater_delegate d on d.event_id=e.firm_event_id and  d.processtype_id=11  and d.language_id=178 and d.record_status=1 where e.firm_event_id=l.firm_event_id and e.language_id=178) italian,

                    ( select count(1) count from firm_event_language e left outer JOIN  translater_delegate d on d.event_id=e.firm_event_id and  d.processtype_id=11  and d.language_id=178 and d.record_status=1 where e.firm_event_id=l.firm_event_id and e.language_id=17)  arabish,

                  ( select count(1) count from firm_event_language e left outer JOIN  translater_delegate d on d.event_id=e.firm_event_id and  d.processtype_id=11  and d.language_id=178 and d.record_status=1 where e.firm_event_id=l.firm_event_id and e.language_id=354) russian,

                 ( select count(1) count from firm_event_language e left outer JOIN  translater_delegate d on d.event_id=e.firm_event_id and  d.processtype_id=11  and d.language_id=178 and d.record_status=1 where e.firm_event_id=l.firm_event_id and e.language_id=437) farsi 

                from firm_event_language l inner join firm_event ev on ev.firm_event_id=l.firm_event_id and ev.record_status=1 
                inner join firm f on f.firm_id=ev.firm_id and f.country_kd=".$county_kd." left outer join translater_delegate td on l.firm_event_id=td.event_id and td.record_status=1 and l.record_status=1
                 ) m  " ;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    
    }
     public function getAllDiscountTranslate($country_kd){
       $_SQL = " select * from (
                 select distinct l.ticket_id discount_id,f.name_txt,f.firm_id,ev.ticket_start_dt start_dt,ev.ticket_end_dt   finish_dt,
                 ( select count(1) count from firm_ticket_explanation e left outer JOIN  translater_delegate d on d.discount_id=e.ticket_id and  d.processtype_id=12  and d.language_id=137 and d.record_status=1 where e.ticket_id=l.ticket_id and e.language_id=137) german,

                   ( select count(1) count from firm_ticket_explanation e left outer JOIN  translater_delegate d on d.discount_id=e.ticket_id and  d.processtype_id=12  and d.language_id=112 and d.record_status=1 where e.ticket_id=l.ticket_id and e.language_id=112) english,
                
                    ( select count(1) count from firm_ticket_explanation e left outer JOIN  translater_delegate d on d.discount_id=e.ticket_id and  d.processtype_id=12  and d.language_id=430 and d.record_status=1 where e.ticket_id=l.ticket_id and e.language_id=430) turkish,

                   ( select count(1) count from firm_ticket_explanation e left outer JOIN  translater_delegate d on d.discount_id=e.ticket_id and  d.processtype_id=12  and d.language_id=178 and d.record_status=1 where e.ticket_id=l.ticket_id and e.language_id=178) italian,

                    ( select count(1) count from firm_ticket_explanation e left outer JOIN  translater_delegate d on d.discount_id=e.ticket_id and  d.processtype_id=12  and d.language_id=17 and d.record_status=1 where e.ticket_id=l.ticket_id and e.language_id=17)  arabish,

                  ( select count(1) count from firm_ticket_explanation e left outer JOIN  translater_delegate d on d.discount_id=e.ticket_id and  d.processtype_id=12  and d.language_id=354 and d.record_status=1 where e.ticket_id=l.ticket_id and e.language_id=354) russian,

                 ( select count(1) count from firm_ticket_explanation e left outer JOIN  translater_delegate d on d.discount_id=e.ticket_id and  d.processtype_id=12  and d.language_id=437 and d.record_status=1 where e.ticket_id=l.ticket_id and e.language_id=437) farsi 

                from firm_ticket_explanation l inner join firm_ticket_durumu ev on ev.ticket_id=l.ticket_id and ev.record_status=1 
                inner join firm f on f.firm_id=ev.firm_id and f.country_kd=".$country_kd." left outer join translater_delegate td on l.ticket_id=td.discount_id and td.record_status=1 and l.record_status=1
                 ) m  " ;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    
    }

     public function getPhotoMyNewWorks($user_id){
        
       $_SQL = "  SELECT distinct p.firm_ourservices_photos_id, p.firm_id, p.photo_usage, p.processtype_id, p.photo_package_id,
                pp.pieces,pp.cost ,f.name_txt ,il.adress,ilt.mobile_phone,f.representive_id,concat(u.name,' ',u.surname) responsible,
                uit.mobile_phone   responsibletel,concat(j.name,' ',j.surname) photographer,pt.processtype_txt ,d.phographer_delegate_id
                FROM firm_ourservices_photos p
                inner join prt_generalphoto_package pp on pp.photo_pacage_id=p.photo_package_id and p.record_status=1 and p.photo_usage=1 
                inner join firm f on f.firm_id=p.firm_id 
                inner join prt_process_types pt on pt.processtype_id=p.processtype_id
                 inner join iletisim il on il.firm_id=f.firm_id and il.record_status=1
                inner join iletisim_tel ilt on ilt.iletisim_id=il.iletisim_id and ilt.record_status=1
                inner join users u on u.user_id=f.representive_id
                inner join iletisim uil on uil.user_id=u.user_id and uil.record_status=1
                inner join iletisim_tel uit on uit.iletisim_id=uil.iletisim_id 
                           inner join phographer_delegate d on d.firm_photo_id=p.firm_ourservices_photos_id 
                inner join users j on j.user_id=d.phographer_id where  d.processtype_id=5 and  d.phographer_id=".$user_id;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    
    }
      public function getPhotoDelegated($county_kd,$city_kd){
       $user_id=$this->input->post('user_id');
       $_SQL = "     SELECT distinct p.firm_ourservices_photos_id, p.firm_ourservice_id, p.firm_id, p.photo_usage, p.processtype_id, p.photo_package_id,
                pp.pieces,pp.cost ,f.name_txt ,il.adress,ilt.mobile_phone,f.representive_id,concat(u.name,' ',u.surname) responsible,
                uit.mobile_phone   responsibletel, pt.processtype_txt ,concat(j.name,' ',j.surname) photographer
                FROM firm_ourservices_photos p
                inner join prt_generalphoto_package pp on pp.photo_pacage_id=p.photo_package_id and p.record_status=1 and p.photo_usage=1 and p.processtype_id=5
                inner join prt_process_types pt on pt.processtype_id=p.processtype_id
                inner join firm f on f.firm_id=p.firm_id and f.country_kd=".$county_kd." and f.city_kd=".$city_kd.
                " inner join iletisim il on il.firm_id=f.firm_id and il.record_status=1
                 inner join iletisim_tel ilt on ilt.iletisim_id=il.iletisim_id and ilt.record_status=1
                inner join users u on u.user_id=f.representive_id
                inner join iletisim uil on uil.user_id=u.user_id and uil.record_status=1
                inner join iletisim_tel uit on uit.iletisim_id=uil.iletisim_id 
                           inner join phographer_delegate d on d.firm_photo_id=p.firm_ourservices_photos_id 
                inner join users j on j.user_id=d.phographer_id ";

        $query = $this->db->query($_SQL);
        return $query->result_array();
    
      }
      public function getPhotoMyProcess($user_id){
      
       $_SQL = "     SELECT distinct p.firm_ourservices_photos_id, p.firm_id, p.photo_usage, p.processtype_id, p.photo_package_id,
                pp.pieces,pp.cost ,f.name_txt ,il.adress,ilt.mobile_phone,f.representive_id,concat(u.name,' ',u.surname) responsible,
                uit.mobile_phone   responsibletel, pt.processtype_txt,d.phographer_delegate_id
                    FROM firm_ourservices_photos p
                inner join prt_generalphoto_package pp on pp.photo_pacage_id=p.photo_package_id and p.record_status=1 and p.photo_usage=1               
                inner join prt_process_types pt on pt.processtype_id=p.processtype_id
                inner join firm f on f.firm_id=p.firm_id 
                inner join iletisim il on il.firm_id=f.firm_id and il.record_status=1
                inner join iletisim_tel ilt on ilt.iletisim_id=il.iletisim_id and ilt.record_status=1
                inner join users u on u.user_id=f.representive_id
                inner join iletisim uil on uil.user_id=u.user_id and uil.record_status=1
                inner join iletisim_tel uit on uit.iletisim_id=uil.iletisim_id 
                inner join phographer_delegate d on d.firm_photo_id=p.firm_ourservices_photos_id and d.processtype_id <> 8 and d.processtype_id <> 7
                inner join users j on j.user_id=d.phographer_id and d.phographer_id=".$user_id;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    
      }
      public function getPhotoMyFinished($user_id){
       $_SQL = "     SELECT distinct p.firm_ourservices_photos_id, p.firm_ourservice_id, p.firm_id, p.photo_usage, p.processtype_id, p.photo_package_id,
                pp.pieces,pp.cost ,f.name_txt ,il.adress,ilt.mobile_phone,f.representive_id,concat(u.name,' ',u.surname) responsible,
                uit.mobile_phone   responsibletel,pt.processtype_txt,d.phographer_delegate_id
                FROM firm_ourservices_photos p
                inner join prt_generalphoto_package pp on pp.photo_pacage_id=p.photo_package_id and p.record_status=1 and p.photo_usage=1 and p.processtype_id=7
                inner join firm f on f.firm_id=p.firm_id 
                 inner join prt_process_types pt on pt.processtype_id=p.processtype_id
                 inner join iletisim il on il.firm_id=f.firm_id and il.record_status=1
                inner join iletisim_tel ilt on ilt.iletisim_id=il.iletisim_id and ilt.record_status=1
                inner join users u on u.user_id=f.representive_id
                inner join iletisim uil on uil.user_id=u.user_id and uil.record_status=1
                inner join iletisim_tel uit on uit.iletisim_id=uil.iletisim_id 
                           inner join phographer_delegate d on d.firm_photo_id=p.firm_ourservices_photos_id 
                inner join users j on j.user_id=d.phographer_id and d.phographer_id=".$user_id;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    
      }
     
      public function getPhotoDelageting($firm_ourservices_photos_id){
       $_SQL = "  SELECT p.firm_ourservices_photos_id, p.firm_ourservice_id, p.firm_id, p.photo_usage, p.processtype_id, p.photo_package_id,
                pp.pieces,pp.cost ,f.name_txt ,il.adress,ilt.mobile_phone,f.representive_id,concat(u.name,' ',u.surname) responsible,
                uit.mobile_phone   responsibletel,f.country_kd,f.city_kd 
                FROM firm_ourservices_photos p 
                inner join prt_generalphoto_package pp on pp.photo_pacage_id=p.photo_package_id and p.record_status=1 and 
                p.photo_usage=1 and p.firm_ourservices_photos_id=".$firm_ourservices_photos_id.
                " inner join firm f on f.firm_id=p.firm_id ".
                " inner join iletisim il on il.firm_id=f.firm_id and il.record_status=1
                inner join iletisim_tel ilt on ilt.iletisim_id=il.iletisim_id and ilt.record_status=1
                inner join users u on u.user_id=f.representive_id
                inner join iletisim uil on uil.user_id=u.user_id and uil.record_status=1
                inner join iletisim_tel uit on uit.iletisim_id=uil.iletisim_id ";

        $query = $this->db->query($_SQL);
        return $query->result_array();
    
    }
    
    public function getMyPhotoJob($phographer_delegate_id){
       $_SQL = "     SELECT distinct p.firm_ourservices_photos_id, p.firm_ourservice_id, p.firm_id, p.photo_usage, p.processtype_id, p.photo_package_id,
                pp.pieces,pp.cost ,f.name_txt ,il.adress,ilt.mobile_phone,f.representive_id,concat(u.name,' ',u.surname) responsible,
                uit.mobile_phone   responsibletel,pt.processtype_txt,d.phographer_delegate_id,d.process_dt,d.explanation,d.end_dt,d.processtype_id 
                FROM firm_ourservices_photos p
                inner join prt_generalphoto_package pp on pp.photo_pacage_id=p.photo_package_id and p.record_status=1 and p.photo_usage=1 
                inner join firm f on f.firm_id=p.firm_id 
                 inner join prt_process_types pt on pt.processtype_id=p.processtype_id
                 inner join iletisim il on il.firm_id=f.firm_id and il.record_status=1
                inner join iletisim_tel ilt on ilt.iletisim_id=il.iletisim_id and ilt.record_status=1
                inner join users u on u.user_id=f.representive_id
                inner join iletisim uil on uil.user_id=u.user_id and uil.record_status=1
                inner join iletisim_tel uit on uit.iletisim_id=uil.iletisim_id 
                           inner join phographer_delegate d on d.firm_photo_id=p.firm_ourservices_photos_id 
                inner join users j on j.user_id=d.phographer_id  and d.phographer_delegate_id=".$phographer_delegate_id;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    
    }
      public function delegatePhotographer($id,$data)
    {
        
        $deger=true;
        try { 
             
             $this->db->where('firm_ourservices_photos_id', $id);
             $this->db->where('record_status', 1);
             $this->db->update('firm_ourservices_photos', $data);
             
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           $deger=false;
         }
  
         return $deger;     
   }
    public function delegateTranslater($discount_id,$event_id,$language_id,$firm_id,$translater_delegate_id,$data)
    {
        $deger=true;
        try { 
             $this->db->where('translater_delegate_id', $translater_delegate_id);
             $this->db->where('language_id', $language_id);
             $this->db->where('firm_id', $firm_id);
             $this->db->where('event_id', $event_id);
             $this->db->where('discount_id', $discount_id);
             $this->db->where('record_status', 1);
             $this->db->update('translater_delegate', $data);
             
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           $deger=false;
         }
  
         return $deger;     
   }
   
   
         public function getPrtProcess()
    {
        
 
        try { 
            
           $_SQL = "SELECT * FROM prt_process_types where record_status=1 and gruptipi_id=12 and processtype_id <>8";

             $query = $this->db->query($_SQL);
             return $query->result_array();
    }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           return ""; 
       }
  
        
   }
   
    public function translaterLanguagesbyUserID($user_id)
    {
        
 
        try { 
            
           $_SQL = "select l.language_id language_to,concat(lp.language_name_txt,'-',l.language_name_txt) language_name_txt,lp.language_id language_from from user_translater_types t 
                    inner join prt_language l on t.translate_to=l.language_id and t.record_status=1 
                    inner join prt_language lp on t.translate_from =lp.language_id 
                    where t.user_id=".$user_id;

             $query = $this->db->query($_SQL);
             return $query->result_array();
    }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           return ""; 
       }
  
        
   }
  
   public function TranslaterFirmExplanationbyLanguagesIDs($user_id,$from,$to)
    {
        
 
        try { 
            
           $_SQL = "SELECT f.firm_id,f.name_txt,d.translater_delegate_id,d.process_dt,d.end_dt,e.firm_text,pl.language_name_txt from_lan_name,plan.language_name_txt to_lan_name,t.translate_to
                    FROM translater_delegate d inner join 
                    user_translater_types t on t.user_id=d.user_id and t.translate_from=".$from." and t.translate_to=".$to." AND
                    d.record_status=1 and d.user_id=".$user_id."
                    inner join firm f on f.firm_id=d.firm_id and f.record_status=1 
                    inner join prt_language pl on pl.language_id=t.translate_from 
                    inner join prt_language plan on plan.language_id=t.translate_to 
                    inner join firm_explanation e on e.language_id=t.translate_from and e.record_status=1 and e.language_id=".$from."
                    and e.firm_id=d.firm_id
                         where  d.processtype_id=10 and d.completed_status=0";

             $query = $this->db->query($_SQL);
             return $query->result_array();
    }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           return ""; 
       }
  
        
   }
  
    public function TranslaterFirmExplanationFinishedbyLanguagesIDs($user_id,$from,$to)
    {
        
 
        try { 
            
           $_SQL = " SELECT f.firm_id,f.name_txt,d.translater_delegate_id,d.process_dt,d.end_dt,e.firm_text,e2.firm_text toText,e2.firmexplanation_id toID,pl.language_name_txt from_lan_name,plan.language_name_txt to_lan_name,t.translate_to,e.insert_dt
                    FROM translater_delegate d inner join 
                    user_translater_types t on t.user_id=d.user_id and t.translate_from=".$from." and t.translate_to=".$to." AND
                    d.record_status=1 and d.user_id=".$user_id."
                    inner join firm f on f.firm_id=d.firm_id and f.record_status=1 
                    inner join prt_language pl on pl.language_id=t.translate_from 
                    inner join prt_language plan on plan.language_id=t.translate_to 
                    inner join firm_explanation e on e.language_id=t.translate_from and e.record_status=1 and e.language_id =".$from."
                    and e.firm_id=d.firm_id
                     inner join firm_explanation e2 on e2.language_id=t.translate_to and e2.record_status=1  and e2.language_id=".$to." and e2.firm_id=d.firm_id
                        where  d.processtype_id=10 and d.completed_status=1";

             $query = $this->db->query($_SQL);
             return $query->result_array();
    }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           return ""; 
       }
  
        
   }
   
   public function TranslaterDiscountbyLanguagesIDs($user_id,$from,$to)
    {
        
 
        try { 
            
           $_SQL = " SELECT f.firm_id,f.name_txt,d.translater_delegate_id,d.process_dt,d.end_dt,pl.language_name_txt from_lan_name,
                     plan.language_name_txt to_lan_name,t.translate_to,exp.explanation,d.discount_id
                    FROM translater_delegate d inner join 
                    user_translater_types t on t.user_id=d.user_id and t.translate_from=".$from."
                    and t.translate_to=".$to." AND
                    d.record_status=1 
                    inner join firm f on f.firm_id=d.firm_id and f.record_status=1 
                    inner join prt_language pl on pl.language_id=t.translate_from 
                    inner join prt_language plan on plan.language_id=t.translate_to 
                    inner join firm_ticket_durumu ev on ev.ticket_id =d.discount_id
                    inner join firm_ticket_explanation exp on ev.ticket_id=exp.ticket_id and exp.language_id=".$from."
                    where d.processtype_id=12  and d.completed_status=0 and d.user_id=".$user_id;

             $query = $this->db->query($_SQL);
             return $query->result_array();
    }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           return ""; 
       }
  
        
   }
   
   public function TranslaterDiscountFinishedbyLanguagesIDs($user_id,$from,$to)
    {
        
 
        try { 
            
            $_SQL = "SELECT f.firm_id,f.name_txt,d.translater_delegate_id,d.process_dt,d.end_dt,pl.language_name_txt from_lan_name,
                     plan.language_name_txt to_lan_name,t.translate_to,exp.explanation,d.discount_id
                    FROM translater_delegate d inner join 
                    user_translater_types t on t.user_id=d.user_id and t.translate_from=".$from."
                    and t.translate_to=".$to." AND
                    d.record_status=1 
                    inner join firm f on f.firm_id=d.firm_id and f.record_status=1 
                    inner join prt_language pl on pl.language_id=t.translate_from 
                    inner join prt_language plan on plan.language_id=t.translate_to 
                    inner join firm_ticket_durumu ev on ev.ticket_id =d.discount_id
                    inner join firm_ticket_explanation exp on ev.ticket_id=exp.ticket_id and exp.language_id=".$to."
                    where d.processtype_id=12  and d.completed_status=1 and d.user_id=".$user_id;

             $query = $this->db->query($_SQL);
             return $query->result_array();
    }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           return ""; 
       }
  
        
   }
   
   public function TranslaterEventbyLanguagesIDs($user_id,$from,$to)
    {
        
 
        try { 
            
           $_SQL = " SELECT f.firm_id,f.name_txt,d.translater_delegate_id,d.process_dt,d.end_dt,pl.language_name_txt from_lan_name,
                     plan.language_name_txt to_lan_name,t.translate_to,el.event_header,el.firm_event_txt,el.firm_event_id,d.event_id
                    FROM translater_delegate d inner join 
                    user_translater_types t on t.user_id=d.user_id and t.translate_from=".$from."
                     and t.translate_to=".$to." AND
                    d.record_status=1 
                    inner join firm f on f.firm_id=d.firm_id and f.record_status=1 
                    inner join prt_language pl on pl.language_id=t.translate_from 
                    inner join prt_language plan on plan.language_id=t.translate_to 
                    inner join firm_event ev on ev.firm_event_id =d.event_id
                    inner join firm_event_language el on ev.firm_event_id=el.firm_event_id and el.language_id=".$from."
                    where d.processtype_id=11 and  d.completed_status=0 and d.user_id=".$user_id;


             $query = $this->db->query($_SQL);
             return $query->result_array();
    }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           return ""; 
       }
  
        
   }
   public function TranslaterEventFinishedbyLanguagesIDs($user_id,$from,$to)
    {
        
 
        try { 
            
           $_SQL = " SELECT f.firm_id,f.name_txt,d.translater_delegate_id,d.process_dt,d.end_dt,pl.language_name_txt from_lan_name,
                     plan.language_name_txt to_lan_name,t.translate_to,el.firm_event_txt,el.event_header,el2.firm_event_txt toEvent,
                     el2.event_header toHeadEvent ,el.firm_event_id,d.event_id,el2.insert_dt
                    FROM translater_delegate d inner join 
                    user_translater_types t on t.user_id=d.user_id and t.translate_from=".$from."
                     and t.translate_to=".$to." AND
                    d.record_status=1 
                    inner join firm f on f.firm_id=d.firm_id and f.record_status=1 
                    inner join prt_language pl on pl.language_id=t.translate_from 
                    inner join prt_language plan on plan.language_id=t.translate_to 
                    inner join firm_event ev on ev.firm_event_id =d.event_id
                    inner join firm_event_language el on ev.firm_event_id=el.firm_event_id and el.language_id=".$from."
                      inner join firm_event_language el2 on el2.firm_event_id=ev.firm_event_id and el2.language_id=".$to."
                    where d.processtype_id=11 and  d.completed_status=1 and d.user_id=".$user_id;


             $query = $this->db->query($_SQL);
             return $query->result_array();
            }catch (Exception $e) {
                 //alert the user.
                  var_dump($e->getMessage());
                  return ""; 
              }
  
        
   }
     public function updateDelagateComplete($translater_delegate_id){
     
             $data = array(
               'update_dt' => $dateTime ,
               'update_user_id' => $this->session->userdata("user_id") ,
               'completed_status'=> 1
              );
     
        $this->db->where("translater_delegate_id",$translater_delegate_id);
        $id = $this->db->update("translater_delegate",$data);
        return $id;
   }
    public function updateFirmExplanation($firm_id,$lang_id,$data){
     
        $this->db->where("firm_id",$firm_id);
        $this->db->where("language_id",$lang_id);
        $id = $this->db->update("firm_explanation",$data);
        return $id;
   }
   
   public function updateEventExplanation($event_id,$lang_id,$data){
     
        $this->db->where("firm_event_id",$event_id);
        $this->db->where("language_id",$lang_id);
        $id = $this->db->update("firm_event_language",$data);
        return $id;
   }
   
   public function updateDiscountExplanation($ticket_id,$lang_id,$data){
     
        $this->db->where("ticket_id",$ticket_id);
        $this->db->where("language_id",$lang_id);
        $id = $this->db->update("firm_ticket_explanation",$data);
        return $id;
   }
   
    
}



   