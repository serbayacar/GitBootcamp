<?php

//hi
defined('BASEPATH') OR exit('No direct script access allowed');

class firmUnusual_model extends CI_Model {

      public function getDiscountPackage($country_kd,$city_kd) {

        $_SQL = "SELECT `prt_usage_package_id`, `cost`, `explanation`, `package_name`, 
            `country_kd`, `city_kd`,  `package_type`, `insert_user_id`, 
            `insert_dt`, `update_user_id`, `update_dt`, `usage_month`, `order_id`, `discount_package`, 
            `exempt_package` FROM `prt_usage_package` WHERE record_status=1 and exempt_package=0
             and country_kd=".$country_kd." and city_kd= ".$city_kd." order by order_id ";
     
      $query = $this->db->query($_SQL);
      return $query->result_array();
     }
     public function getUnusalType($country_kd,$city_kd) {

        $_SQL = " SELECT `unusual_types_id`, `type_group_id`, `unusal_type_txt`, 
             `discount`, `percentage`, `fixed` FROM `prt_unusual_types` WHERE type_group_id=5 and discount=1
              and country_kd=".$country_kd." and city_kd=".$city_kd;
     
      $query = $this->db->query($_SQL);
      return $query->result_array();
     }
     public function getUnusual($firm_id) {

        $_SQL = " SELECT u.`unusal_id`, f.`firm_id`, u.`user_id`, u.`unusul_type_id`,
            u.`cost`, u.`unusal_start_dt`, u.`unusal_end_dt`, u.`explanation_txt`, f.city_kd,f.country_kd,
             u.`month`, u.`usage_package_id`,f.name_txt,u.real_price,u.amount FROM firm f left outer join  unusal  u
                on f.firm_id=u.firm_id
                where  f.firm_id=".$firm_id;
     
      $query = $this->db->query($_SQL);
      return $query->result_array();
     }
       public function getRealPrice($month) {

        $_SQL = " SELECT cost from prt_usage_package 
                where  cost <>0  and usage_month=".$month;
     
      $query = $this->db->query($_SQL);
      return $query->result_array();
     }
    public function getPackageId($firm_id) {

        $_SQL = " select p.firmportal_usage_id from firm f inner join firm_portal_usage p on p.firm_id=f.firm_id and p.firmportal_usage_id=f.portalusage_id "
                . " where p.firm_id=".$firm_id;
     
      $query = $this->db->query($_SQL);
      return $query->result_array();
     }
    public function updateFirmbyUnusualId($firmID,$unusual_id)
    {
        
        $deger=true;
        try { 
             $data=array();
             $data["unusual_id"]=$unusual_id;
             $this->db->where('firm_id', $firmID);
             $this->db->update('firm_portal_usage', $data);
             
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           $deger=false;
         }
  
         return $deger;     
   }
     public function updateFirmbyUsagePackageId($firmID,$usage_package_id)
    {
        
        $deger=true;
        try { 
             $data=array();
             $data["usage_package_id"]=$usage_package_id;
             $this->db->where('firm_id', $firmID);
             $this->db->update('firm', $data);
             
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           $deger=false;
         }
  
         return $deger;     
   }
    public function updateFirmPortalbyUsagePackage($portalusagepackage_id,$usage_package_id)
    {
        
        $deger=true;
        try { 
             $data=array();
             $data["usage_package_id"]=$usage_package_id;
             
             $this->db->where('firm_id', $firmID);
             $this->db->update('firm_portal_usage', $data);
             
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           $deger=false;
         }
  
         return $deger;     
   }
       public function updateFirmCost($firm_id,$portalusagepackage_id,$dataCost)
    {
        
        $deger=true;
        try { 
          
             $this->db->where('firm_id', $firm_id);
             $this->db->where('firm_portal_usage_id', $portalusagepackage_id);
             $this->db->where('invoice_group_id', 5);
             $this->db->update('firm_ourservices_cost', $dataCost);
             
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           $deger=false;
         }
  
         return $deger;     
   }

   public function updateFirmAll($firm_id,$unusal_id,$usage_package_id,$update_dt,$update_user_id,$amount,$unusal_start_dt,$unusal_end_dt)
    {
       try { 
          
          
            
            $usage_package_id =  $usage_package_id ;
            $portalusagepackage=$this->getPackageId($firm_id);
            $portalusagepackage_id=$portalusagepackage[0]["firmportal_usage_id"];

            // firm tablosunu update eder usage_package_id güncellenmeli               
            $this->updateFirmbyUsagePackageId($firm_id,$usage_package_id);

            $dataportal=array();
            $dataportal["start_dt"]=$unusal_start_dt;
            $dataportal["end_dt"]=$unusal_end_dt;
            $dataportal["unusual_id"]=$unusal_id;
            $dataportal["package_id"]=$usage_package_id;
            $dataportal["update_user_id"]= $update_user_id;
            $dataportal["update_dt"]=$update_dt;

            //    firm_portal_usage tablosu güncellenir   
            $this->generalChangeProcess_model->updateTable('firm_portal_usage',$portalusagepackage_id,$dataportal);      
 
            
            //ourservice cost tablosu update
            $dataCost=array();
            $dataCost["amout"]=$amount;
            $dataCost["discount_id"]=$unusal_id;
            $dataCost["update_user_id"]= $update_user_id;
            $dataCost["update_dt"]=$update_dt;
            $this->updateFirmCost($firm_id,$portalusagepackage_id,$dataCost); 
            
            
            $deger=true;
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           $deger=false;
         }
  
         return $deger;     
   }
     public function checkRecord($firm_id) {

        $_SQL = "SELECT `firm_ourservices_cost_id` FROM firm_ourservices_cost c inner join firm_portal_usage p on p.firm_id=c.firm_id and c.invoice_group_id=5 
            and c.create_invoice_status=1 AND C.firm_portal_usage_id=p.firmportal_usage_id
            and p.firm_id=".$firm_id;
     
      $query = $this->db->query($_SQL);
      return $query->result_array();
     }
 


}