<?php
class photographer_model extends CI_Model {

    public function getPhotoWorks($county_kd,$city_kd){
       $_SQL = "     SELECT p.firm_photo_package_id,p.photo_count,p.photo_package_id,l.description,f.firm_id,f.name_txt,
            case when f.notportalusage=1 then 'Not Usage Pck' else '' end portal_usage,
            (select count(u.firm_usage_photos_id) from firm_usage_photos u where u.firm_id=p.firm_id and 
            u.photo_package_id=p.photo_package_id and u.record_status=1 ) count,
            concat(u.name,' ',u.surname) user_name,fi.adress,
            t.mobile_phone
            FROM firm_photo_package p inner join 
            firm f on f.firm_id=p.firm_id and f.record_status=1 and p.record_status=1
            inner join iletisim fi on fi.firm_id=f.firm_id and fi.record_status=1 
            inner join prt_generalphoto_package pp on pp.photo_pacage_id=p.photo_package_id
            inner join prt_generalphoto_package_language l on l.language_id=112 and 
            l.generalphoto_package_id=pp.photo_pacage_id
            inner join firm_ourservices_cost c on c.firm_id=f.firm_id and 
            p.ourservice_cost_id=c.firm_ourservices_cost_id and c.create_invoice_status=1
           inner join users u on u.user_id=f.representive_id
           inner join iletisim ilu on ilu.user_id=f.representive_id
          inner join iletisim_tel t on t.iletisim_id=ilu.iletisim_id 
            where p.active_status=1  and f.country_kd=".$county_kd." and f.city_kd=".$city_kd;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    
    }
       public function getPhotoNewWorks($county_kd,$city_kd){
       $_SQL = "select d.phographer_delegate_id,f.firm_id,f.name_txt,
           il.ort district,il.adress, d.pieces pieces,concat(u.name,' ',u.surname) user_name,
           t.mobile_phone,u.user_id ,d.photo_type,pt.processtype_txt from firm f inner join 
           firm_ourservices_cost c on c.firm_id=f.firm_id and f.notportalusage=0 
           and c.create_invoice_status=1 and c.invoice_group_id=5 
           inner join iletisim il on il.firm_id=f.firm_id inner join photographer_delegate d 
           on d.firm_id=c.firm_id and d.completed_status=0 and d.processtype_id=19 
           inner join users u on u.user_id=f.representive_id inner join iletisim ilu 
           on ilu.user_id=f.representive_id inner join iletisim_tel t 
           on t.iletisim_id=ilu.iletisim_id inner join prt_process_types pt 
           on pt.processtype_id=d.photo_type 
        where f.country_kd=".$county_kd." and f.city_kd=".$city_kd;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    
    }
    

     public function getPhotoMyNewWorks($user_id){
        
       $_SQL = " select d.phographer_delegate_id,f.firm_id,f.name_txt,il.ort district,il.adress,
           d.pieces pieces,concat(u.name,' ',u.surname) user_name,t.mobile_phone,u.user_id ,
           d.photo_type,pt.processtype_txt,d.process_dt,d.end_dt,d.explanation 
           from firm f 
        inner join iletisim il on il.firm_id=f.firm_id
        inner join photographer_delegate d on d.firm_id=f.firm_id 
        and d.processtype_id=20
        inner join users u on u.user_id=f.representive_id
        inner join iletisim ilu on ilu.user_id=f.representive_id
        inner join iletisim_tel t on t.iletisim_id=ilu.iletisim_id 
        inner join prt_process_types pt on pt.processtype_id=d.photo_type
        where d.phographer_id=".$user_id." and d.completed_status=0";

        $query = $this->db->query($_SQL);
        return $query->result_array();
    
    }
      public function getPhotoDelegated($county_kd,$city_kd){
       $user_id=$this->input->post('user_id');
       $_SQL = "  select d.phographer_delegate_id,d.phographer_id,d.firm_photo_package_id,d.firm_id,
                concat(u.name,' ',u.surname) user_name,t.mobile_phone,d.process_dt,d.pieces,
                d.explanation,
                case when d.completed_status=0 then 'Not Completed' else 'completed' end completed_status, d.end_dt,f.name_txt,fi.adress
                from photographer_delegate d inner join users u on u.user_id=d.phographer_id
                inner join iletisim i on i.user_id=u.user_id and i.record_status=1
                inner join iletisim fi on fi.firm_id=u.user_id and i.record_status=1
                inner join iletisim_tel t on t.iletisim_id=i.iletisim_id and t.record_status=1
                inner join firm f on f.firm_id=d.firm_id and d.processtype_id=20 
                and f.country_kd=".$county_kd." and f.city_kd=".$city_kd;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    
      }
       public function getPhotoFinished($county_kd,$city_kd){
       $user_id=$this->input->post('user_id');
       $_SQL = "  select d.phographer_delegate_id,d.phographer_id,d.firm_photo_package_id,d.firm_id,
                concat(u.name,' ',u.surname) user_name,t.mobile_phone,d.process_dt,d.pieces,
                d.explanation,
                 d.end_dt,f.name_txt,fi.adress
                from photographer_delegate d inner join users u on u.user_id=d.phographer_id
                inner join iletisim i on i.user_id=u.user_id and i.record_status=1
                inner join iletisim fi on fi.firm_id=u.user_id and i.record_status=1
                inner join iletisim_tel t on t.iletisim_id=i.iletisim_id and t.record_status=1
                inner join firm f on f.firm_id=d.firm_id and d.processtype_id=21
                and f.country_kd=".$county_kd." and f.city_kd=".$city_kd;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    
      }
      public function getPhotoMyProcess($user_id){
      
       $_SQL = "     SELECT distinct p.firm_ourservices_photos_id, p.ourservice_cost_id, p.firm_id, p.photo_usage, p.processtype_id, p.photo_package_id,
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
        $_SQL = "  select d.phographer_delegate_id,f.firm_id,f.name_txt,il.ort district,il.adress,
           d.pieces pieces,concat(u.name,' ',u.surname) user_name,t.mobile_phone,u.user_id ,
           d.photo_type,pt.processtype_txt,d.process_dt,d.end_dt,d.explanation 
           from firm f 
        inner join iletisim il on il.firm_id=f.firm_id
        inner join photographer_delegate d on d.firm_id=f.firm_id 
        and d.processtype_id=21
        inner join users u on u.user_id=f.representive_id
        inner join iletisim ilu on ilu.user_id=f.representive_id
        inner join iletisim_tel t on t.iletisim_id=ilu.iletisim_id 
        inner join prt_process_types pt on pt.processtype_id=d.photo_type
        where d.phographer_id=".$user_id." and d.completed_status=1";

        $query = $this->db->query($_SQL);
        return $query->result_array();
    
      }
     
      public function getPhotoDelageting($firm_photo_package_id){
       $_SQL = " SELECT p.firm_photo_package_id,p.photo_count,p.photo_package_id,l.description,f.firm_id,f.name_txt,
            case when f.notportalusage=1 then 'Not Usage Pck' else '' end portal_usage,
            (select count(u.firm_usage_photos_id) from firm_usage_photos u where u.firm_id=p.firm_id and 
            u.photo_package_id=p.photo_package_id and u.record_status=1 ) count,f.country_kd,f.city_kd,
            concat(u.name,' ',u.surname) user_name,fi.adress,
            t.mobile_phone
            FROM firm_photo_package p inner join 
            firm f on f.firm_id=p.firm_id and f.record_status=1 and p.record_status=1
            inner join iletisim fi on fi.firm_id=f.firm_id and fi.record_status=1 
            inner join prt_generalphoto_package pp on pp.photo_pacage_id=p.photo_package_id
            inner join prt_generalphoto_package_language l on l.language_id=112 and 
            l.generalphoto_package_id=pp.photo_pacage_id
            inner join firm_ourservices_cost c on c.firm_id=f.firm_id and 
            p.ourservice_cost_id=c.firm_ourservices_cost_id and c.create_invoice_status=1
           inner join users u on u.user_id=f.representive_id
           inner join iletisim ilu on ilu.user_id=f.representive_id
          inner join iletisim_tel t on t.iletisim_id=ilu.iletisim_id 
          where p.firm_photo_package_id=".$firm_photo_package_id;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    
    }
     public function getPhotoDelagetingNew($phographer_delegate_id){
       $_SQL = " select d.phographer_delegate_id,f.firm_id,f.name_txt,
           il.ort district,il.adress,d.pieces pieces,d.process_dt,
           concat(u.name,' ',u.surname) user_name,t.mobile_phone,
           u.user_id,f.country_kd,f.city_kd,d.insert_dt ,d.end_dt,d.explanation 
        from firm f 
        inner join firm_ourservices_cost c on c.firm_id=f.firm_id and 
        f.notportalusage=0 and c.create_invoice_status=1 and c.invoice_group_id=5 
        inner join iletisim il on il.firm_id=f.firm_id
        inner join photographer_delegate d on d.firm_id=f.firm_id 
        inner join users u on u.user_id=f.representive_id
        inner join iletisim ilu on ilu.user_id=f.representive_id
        inner join iletisim_tel t on t.iletisim_id=ilu.iletisim_id
        where d.phographer_delegate_id=".$phographer_delegate_id;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    
    }
    
    public function getMyPhotoJob($phographer_delegate_id){
       $_SQL = " select d.phographer_delegate_id,f.firm_id,f.name_txt,il.ort district,il.adress,
           d.pieces pieces,concat(u.name,' ',u.surname) user_name,t.mobile_phone,u.user_id ,
           d.photo_type,pt.processtype_txt,d.end_dt,d.process_dt,d.explanation 
           from firm f 
          inner join iletisim il on il.firm_id=f.firm_id
        inner join photographer_delegate d on d.firm_id=f.firm_id 
        and d.processtype_id=20
        inner join users u on u.user_id=f.representive_id
        inner join iletisim ilu on ilu.user_id=f.representive_id
        inner join iletisim_tel t on t.iletisim_id=ilu.iletisim_id 
        inner join prt_process_types pt on pt.processtype_id=d.photo_type 
            where d.completed_status=0 and  d.phographer_delegate_id=".$phographer_delegate_id;

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
    
}
