<?php
class report_model extends CI_Model {
   
     //  iletisim_tel table is updated by firm_id which is sent
   public function getAllUserbyCountry($country_kd,$status)
   {
       
         $_SQL = "SELECT u.user_id, u.email, concat(u.name,' ',u.surname) name , u.uyelik_tarihi, u.firm_id, il.ort,il.adress,ilt.mobile_phone,f.name_txt firm_name
                FROM users  u inner join iletisim il on il.iletisim_id=u.iletisim_id  
                inner join iletisim_tel ilt on ilt.iletisim_id=il.iletisim_id 
                 left outer join firm f  on f.firm_id= u.firm_id and f.record_status=1
                 WHERE u.country_kd=16 and u.record_status=".$status." and u.country_kd=".$country_kd;
          
            $query = $this->db->query($_SQL);
            return $query->result_array();
   }

      public function getAllFirms($country_kd,$status)
   {
       
         $_SQL = "select f.firm_id,f.name_txt,f.responsible_person,case when f.firm_freelancer=1 then 'Freelancer' else '' end freelancer,f.responsible_phone,f.web_status,
            case when f.approved_status=0 then 'Not Approved' else '' end status,
            il.ort district,il.adress,ilt.phone,ilt.mobile_phone,il.user_id,concat(u.name,' ',u.surname) user_name,pu.start_dt,pu.end_dt
            from firm f 
            inner join iletisim il on il.firm_id =f.firm_id and il.record_status=1  
            inner join iletisim_tel ilt on ilt.iletisim_id=il.iletisim_id and ilt.record_status=1 
                        inner join users u on u.user_id=f.representive_id
                        inner join firm_portal_usage pu on pu.firm_id=f.firm_id  where f.country_kd=".$country_kd." and f.record_status=".$status;
          
            $query = $this->db->query($_SQL);
            return $query->result_array();
   }
      public function getAllEvents($country_kd,$status)
   {
       
         $_SQL = "SELECT f.`firm_id`,f.`name_txt`,c.Name city,fe.start_dt start_dt,fe.end_dt end_dt , case when f.`approved_status` = 0 then 'Not Approved' else '' end approved_status,il.ort district "
                 . "FROM firm f inner join city c on c.city_kd= f.`city_kd` "
                 . "inner join iletisim il on il.firm_id= f.firm_id left outer join firm_event_package fe on fe.firm_id=f.firm_id and fe.record_status=1  where f.country_kd=".$country_kd." and f.record_status=".$status;
          
            $query = $this->db->query($_SQL);
            return $query->result_array();
   }
  
    public function getAllTickets($country_kd,$status)
   {
       
         $_SQL = "SELECT f.`firm_id`,f.`name_txt`,c.Name city,fe.start_dt start_dt,fe.end_dt end_dt , case when f.`approved_status` = 0 then 'Not Approved' else '' end approved_status,il.ort district "
                 . "FROM firm f inner join city c on c.city_kd= f.`city_kd` "
                 . "inner join iletisim il on il.firm_id= f.firm_id left outer join firm_event_package fe on fe.firm_id=f.firm_id and fe.record_status=1  where f.country_kd=".$country_kd." and f.record_status=".$status;
          
            $query = $this->db->query($_SQL);
            return $query->result_array();
   }
   public function getAllFirmCountsNotApproved($country_kd,$city_kd)
   {
       
         $_SQL = "SELECT count(f.firm_id)  count from firm f where f.record_status=1 and f.approved_status=0";
         if ($country_kd!=0)
             $_SQL .= " and f.country_kd=".$country_kd;         
         if ($city_kd!=0)
             $_SQL .= " and f.city_kd=".$city_kd;  
         
         $query = $this->db->query($_SQL);
          return $query->result_array();
   }
      public function getAllFirmCountsApproved($country_kd,$city_kd)
   {
       
          $_SQL = "SELECT count(f.firm_id) count from firm f where f.record_status=1 and f.approved_status=1";
         if ($country_kd!=0)
             $_SQL .= " and f.country_kd=".$country_kd;         
         if ($city_kd!=0)
             $_SQL .= " and f.city_kd=".$city_kd;            
         
            $query = $this->db->query($_SQL);
            return $query->result_array();
   }
    public function getAllFirmCountsActive($country_kd,$city_kd)
   {
       
         $_SQL = "SELECT count(f.firm_id)  count from firm f 
                inner join firm_portal_usage p on p.firm_id=f.firm_id and p.record_status=1
                 where f.record_status=1 and f.approved_status=1 and p.end_dt >= CURRENT_DATE ";
          if ($country_kd!=0)
             $_SQL .= " and f.country_kd=".$country_kd;         
         if ($city_kd!=0)
             $_SQL .= " and f.city_kd=".$city_kd;  
         
         $query = $this->db->query($_SQL);
          return $query->result_array();
   }
   public function getAllRepresentiveCounts($country_kd,$city_kd)
   {
       
         $_SQL = "
            select count(k.user_id) count from (select distinct u.user_id   from users u 
            inner join user_grup ug on ug.user_id=u.user_id and u.record_status=1 
            and ug.record_status=1
            where ug.group_id=3  ";
           if ($country_kd!=0)
               $_SQL .= " and u.country_kd=".$country_kd;         
            if ($city_kd!=0)
               $_SQL .= " and u.city_kd=".$city_kd;  
            $_SQL = $_SQL." ) k" ;
            $query = $this->db->query($_SQL);
            return $query->result_array();
   }
   public function getAllEventPackageCountsAvtive($country_kd,$city_kd)
   {
       
         $_SQL = "SELECT count(ep.firm_event_package_id)  count from firm f 
                inner join firm_event_package ep on ep.firm_id=f.firm_id and 
                f.approved_status=1 and f.record_status=1 and ep.active_status=1 
                and ep.record_status=1
                where  f.record_status=1 and f.approved_status=1";   
         if ($country_kd!=0)
               $_SQL .= " and f.country_kd=".$country_kd;         
            if ($city_kd!=0)
               $_SQL .= " and f.city_kd=".$city_kd;  
            $query = $this->db->query($_SQL);
            return $query->result_array();
   }
      public function getAllEventPackageCounts($country_kd,$city_kd)
   {
       
         $_SQL = "SELECT count(ep.firm_event_package_id)  count from firm f 
                inner join firm_event_package ep on ep.firm_id=f.firm_id and f.approved_status=1 
                and f.record_status=1
                and ep.record_status=1
                where  f.record_status=1 and f.approved_status=1 ";   
         if ($country_kd!=0)
               $_SQL .= " and f.country_kd=".$country_kd;         
            if ($city_kd!=0)
               $_SQL .= " and f.city_kd=".$city_kd;  
            $query = $this->db->query($_SQL);
            return $query->result_array();
   }
   public function getAllTicketPackageCountsActive($country_kd,$city_kd)
   {
       
         $_SQL = "SELECT count(ep.firm_ticket_package_id)  count from firm f 
                inner join firm_ticket_package ep on ep.firm_id=f.firm_id and 
                f.approved_status=1 and f.record_status=1 and ep.active_status=1 
                and ep.record_status=1
                where  f.record_status=1 and f.approved_status=1";   
         if ($country_kd!=0)
               $_SQL .= " and f.country_kd=".$country_kd;         
            if ($city_kd!=0)
               $_SQL .= " and f.city_kd=".$city_kd;  
            $query = $this->db->query($_SQL);
            return $query->result_array();
   }
   public function getAllTicketPackageCounts($country_kd,$city_kd)
   {
       
         $_SQL = "SELECT count(ep.firm_ticket_package_id)  count from firm f 
                inner join firm_ticket_package ep on ep.firm_id=f.firm_id and f.approved_status=1 
                and f.record_status=1
                and ep.record_status=1
                where  f.record_status=1 and f.approved_status=1 ";   
         if ($country_kd!=0)
               $_SQL .= " and f.country_kd=".$country_kd;         
            if ($city_kd!=0)
               $_SQL .= " and f.city_kd=".$city_kd;  
            $query = $this->db->query($_SQL);
            return $query->result_array();
   }

      public function getAllPhotoServiceCountsNotCompleted($country_kd,$city_kd)
   {
       
         $_SQL = "SELECT count(`firm_photo_package_id`)  count from  
             firm_photo_package fp inner join firm f on f.firm_id=fp.firm_id and f.record_status=1 AND
             f.approved_status=1 and fp.record_status=1 and fp.active_status=1 
             where fp.completed_status=0";   
         if ($country_kd!=0)
               $_SQL .= " and f.country_kd=".$country_kd;         
            if ($city_kd!=0)
               $_SQL .= " and f.city_kd=".$city_kd;  
            $query = $this->db->query($_SQL);
            return $query->result_array();
   }
   public function getAllPhotoServiceCountsCompleted($country_kd,$city_kd)
   {
       
         $_SQL = "SELECT count(`firm_photo_package_id`) count from  
             firm_photo_package fp inner join firm f on f.firm_id=fp.firm_id and f.record_status=1 AND
             f.approved_status=1 and fp.record_status=1 where fp.completed_status=1";   
         if ($country_kd!=0)
               $_SQL .= " and f.country_kd=".$country_kd;         
            if ($city_kd!=0)
               $_SQL .= " and f.city_kd=".$city_kd;  
            $query = $this->db->query($_SQL);
            return $query->result_array();
   }
    public function getAllWebServiceCountsNotCompleted($country_kd,$city_kd)
   {
       
         $_SQL = "SELECT count(fw.firm_web_package_id) count FROM frm_web_package fw inner join firm f on f.firm_id=fw.firm_id and f.record_status=1 AND
            f.approved_status=1 and fw.record_status=1
            where fw.completed_status=0";   
         if ($country_kd!=0)
               $_SQL .= " and f.country_kd=".$country_kd;         
            if ($city_kd!=0)
               $_SQL .= " and f.city_kd=".$city_kd;  
            $query = $this->db->query($_SQL);
            return $query->result_array();
   }
    public function getAllWebServiceCountsCompleted($country_kd,$city_kd)
   {
       
        $_SQL = "SELECT count(fw.firm_web_package_id) count FROM frm_web_package fw inner join firm f on f.firm_id=fw.firm_id and f.record_status=1 AND
            f.approved_status=1 and fw.record_status=1
            where fw.completed_status=1";
        
         if ($country_kd!=0)
               $_SQL .= " and f.country_kd=".$country_kd;         
            if ($city_kd!=0)
               $_SQL .= " and f.city_kd=".$city_kd;  
            $query = $this->db->query($_SQL);
            return $query->result_array();
   }


   //FirmLink Reports


   public function getCountLink_Personal($user_id){

        $_SQL = "  SELECT count(fl.`firm_link_id`) \"count\" FROM `firm_link` fl WHERE fl.record_status=1 and fl.insert_user_id=".$user_id;



        $query = $this->db->query($_SQL);
        return $query->result_array();

    }

    public function getCountLink_passive_Personal($user_id){

        $_SQL = "  SELECT count(fl.`firm_link_id`) \"count\" FROM `firm_link` fl WHERE fl.record_status=0 and fl.insert_user_id=".$user_id;



        $query = $this->db->query($_SQL);
        return $query->result_array();

    }

    public function getCountLink_General()
    {
        $_SQL = "  SELECT count(fl.`firm_link_id`) \"count\" FROM `firm_link` fl WHERE fl.record_status=1 ";


        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

    public function getCountLink_passive_General()
    {
        $_SQL = "  SELECT count(fl.`firm_link_id`) \"count\" FROM `firm_link` fl WHERE fl.record_status=0 ";


        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

    public function getLink_Personal($user_id,$country,$city,$firmName,$cat,$ser,$app)
    {
        $_SQL = "   SELECT fl.firm_link_id,fl.firm_id,fll.name_txt,fll.country_kd,fll.city_kd,fl.link,fl.link_categori,fl.link_subcategory,fl.start_dt,fl.expire_dt,fl.`google_store`,fl.`apple_store`,CASE fl.`app` WHEN 1 THEN 'Yes'ELSE 'No'  END as app_status 
                    FROM `firm_link` fl
                    inner join firm_list_link fll on fll.record_status=1 and fll.firm_id= fl.firm_id
                    WHERE fl.record_status=1 and fl.insert_user_id=".$user_id;

        if($country!="-1"){
            $_SQL .= " and fll.country_kd=".$country;
        }
        if($city!="-1"){
            $_SQL .= " and fll.city_kd=".$city;
        }

        if(!empty($firmName)){
            $_SQL .= " and fll.name_txt like '%".$firmName."%' ";
        }

        if($app!="2"){
            $_SQL .= " and fl.`app`=".$app;
        }

        if(!isset($cat)){
            $_SQL .= " and fl.link_categori in (";
            $first=0;
            foreach ($cat as $value)
            {
                if($first==0) {
                    $_SQL .= $value;
                    $first=1;
                }
                else{

                    $_SQL .= ",".$value;

                }

            }
            $_SQL .= ")";
        }

        if(!isset($ser)){
            $_SQL .= " and fl.link_subcategory in (";
            $first=0;
            foreach ($ser as $value)
            {
                if($first==0) {
                    $_SQL .= $value;
                    $first=1;
                }
                else{

                    $_SQL .= ",".$value;

                }

            }
            $_SQL .= ")";
        }
        //print_r($_SQL );
        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

    public function getLink_General($country,$city,$firmName,$cat,$ser,$app)
    {
        $_SQL = "   SELECT fl.firm_link_id,fl.firm_id,fll.name_txt,fll.country_kd,fll.city_kd,fl.link,fl.link_categori,fl.link_subcategory,fl.start_dt,fl.expire_dt,fl.`google_store`,fl.`apple_store`,CASE fl.`app` WHEN 1 THEN 'Yes' ELSE 'No'  END as app_status 
                    FROM `firm_link` fl
                    inner join firm_list_link fll on fll.record_status=1 and fll.firm_id= fl.firm_id
                    WHERE fl.record_status=1 ";

        if($country!="-1"){
            $_SQL .= " and fll.country_kd=".$country;
        }
        if($city!="-1"){
            $_SQL .= " and fll.city_kd=".$city;
        }

        if(!empty($firmName)){
            $_SQL .= " and fll.name_txt like '%".$firmName."%' ";
        }

        if($app!="2"){
            $_SQL .= " and fl.`app`=".$app;
        }

        if(!isset($cat)){
            $_SQL .= " and fl.link_categori in (";
            $first=0;
            foreach ($cat as $value)
            {
                if($first==0) {
                    $_SQL .= $value;
                    $first=1;
                }
                else{

                    $_SQL .= ",".$value;

                }

            }
            $_SQL .= ")";
        }

        if(!isset($ser)){
            $_SQL .= " and fl.link_subcategory in (";
            $first=0;
            foreach ($ser as $value)
            {
                if($first==0) {
                    $_SQL .= $value;
                    $first=1;
                }
                else{

                    $_SQL .= ",".$value;

                }

            }
            $_SQL .= ")";
        }
        //print_r($_SQL );
        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
}
