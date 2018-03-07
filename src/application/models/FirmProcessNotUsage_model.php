<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class firmProcessNotUsage_model extends CI_Model {

    public function getFirmAllContactInfoFirmIdNotApproved($firmid) {

        $_SQL = "SELECT f.name_txt,f.firm_id,il.email,il.webpage,il.facebook,il.adress,
            ct.Name country,cy.Name city,il.iletisim_id,il.ort distict,il.instagram, il.twitter,
            ilt.phone,ilt.mobile_phone,ilt.fax,il.country_kd,il.city_kd ,c.amout,f.registry_fee,f.portalusage_id 
            FROM firm f
            inner join iletisim il on il.firm_id=f.firm_id
            inner join countries ct on ct.country_kd=il.country_kd
            inner join iletisim_tel ilt on ilt.iletisim_id=il.iletisim_id and ilt.record_status=1
            inner join city cy on cy.city_kd=il.city_kd 
           inner join firm_ourservices_cost c on c.firm_id=f.firm_id and c.invoice_group_id=11
            WHERE f.notportalusage   =1  and  f.firm_id=" . $firmid;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
     public function getFirmsNotApprovedbyfirmName($firmnr, $firmNm,$district,$countkd) {


         $_SQL = "SELECT distinct f.name_txt,f.firm_id,il.email,il.webpage,il.facebook,il.adress,
            ct.Name country,cy.Name city,il.iletisim_id,il.ort distict,il.instagram, il.twitter,
            ilt.phone,ilt.mobile_phone,ilt.fax,f.notportalusage
            FROM firm f
            inner join iletisim il on il.firm_id=f.firm_id 
            inner join countries ct on ct.country_kd=il.country_kd
            inner join iletisim_tel ilt on ilt.iletisim_id=il.iletisim_id and ilt.record_status=1
            inner join city cy on cy.city_kd=il.city_kd 
            inner join  firm_ourservices_cost c on c.firm_id=f.firm_id and c.create_invoice_status=0  and c.invoice_group_id=11
                where  f.notportalusage=1  ";

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
     public function getFirmsApprovedbyfirmName($firmnr, $firmNm,$district,$countkd) {


         $_SQL = "SELECT distinct f.name_txt,f.firm_id,il.email,il.webpage,il.facebook,il.adress,
            ct.Name country,cy.Name city,il.iletisim_id,il.ort distict,il.instagram, il.twitter,
            ilt.phone,ilt.mobile_phone,ilt.fax,f.notportalusage
            FROM firm f
            inner join iletisim il on il.firm_id=f.firm_id and f.approved_status=0
            inner join countries ct on ct.country_kd=il.country_kd
            inner join iletisim_tel ilt on ilt.iletisim_id=il.iletisim_id and ilt.record_status=1
            inner join city cy on cy.city_kd=il.city_kd 
                 where  f.notportalusage=1  ";

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
      public function getFirmHeadInfobyFirmIdNotApproved($firmid) {

        $_SQL = "SELECT * FROM `firm` WHERE approved_status=0 and firm_id=" . $firmid;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
     public function getLanguageServicebyFirmId($firm_id)
    {
             $_SQL = "SELECT pl.language_id,pl.language_name_txt, fs.servicegiven_language_id FROM firm_servicegiven_language fs "
                     . "right outer join prt_language pl on fs.language_id=pl.language_id and fs.firm_id=".$firm_id." and fs.record_status=1 where pl.record_status=1 ";
            
          
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
     public function insertFirmIletisimAll($datafirm,$datailetisim,$datailetisimtel,$datafirmexplanation,$dataRegisty)
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
                 
            $datafirmexplanation["firm_id"]=$_firm_id;
            $_explanation_id =$this->generalChangeProcess_model->insertTables('firm_explanation',$datafirmexplanation);
            
           
            $this->updateFirmExplanationId($_firm_id,$_explanation_id);
            
            $dataRegisty["firm_id"]=$_firm_id;
            $dataRegisty["firm_portal_usage_id"]=0;
            
            
           $this->generalChangeProcess_model->insertTables('firm_ourservices_cost',$dataRegisty);
           $this->prtTableProcess_model->updateFirmProcess($_firm_id,1,0,1); //firma eklendi processi completed
            return $_firm_id;
                        
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           
         }
  
         return $_firm_id;     
   }
      public function updateFirmAll($_firm_id,$_iletisim_id,$firmexplanation_id,$datafirm,$datailetisim,$datailetisimtel,$datafirmexplanation,$datacost1)
   {
        
        $deger=true;
        try { 
                 
            $result1= $this->generalChangeProcess_model->updateTable('firm',$_firm_id, $datafirm); 
            $result2= $this->generalChangeProcess_model->updateTable('iletisim',$_iletisim_id, $datailetisim);      
            $result3= $this->firmChangeProcess_model->updateFirmIletisimTel($_iletisim_id, $datailetisimtel); 
            $result4= $this->generalChangeProcess_model->updateTable('firm_explanation',$firmexplanation_id, $datafirmexplanation); 
            $result6=  $this->firmChangeProcess_model->updateFirmCostbyFee($_firm_id, $datacost1); 
            return $_firm_id;
            
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           $deger=false;
         }
  
         return $deger;     
   }
     public function updateFirmUsageId($firm_id,$_portalusage_id)
   {
        
        $deger=true;
        try { 
            $data = array(
               'portalusage_id' => $_portalusage_id               
            );
            $this->db->where('firm_id', $firm_id);
             $this->db->where('record_status', 1);
            $this->db->update('firm', $data); 
             
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           $deger=false;
         }
  
         return $deger;     
   }
   
   public function updateFirmCostbyFee($firm_id,$datacost)
   {
        
        $deger=true;
        try { 
      
            $this->db->where('firm_id', $firm_id);
            $this->db->where('record_status', 1);
            $this->db->where('invoice_group_id', 11);
            $this->db->update('firm_ourservices_cost', $datacost); 
             
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           $deger=false;
         }
  
         return $deger;     
   }
   
   
 
   public function updateFirmExplanationId($firm_id,$explanation_id)
   {
        
        $deger=true;
        try { 
            $data = array(
               'firm_firstexplanation_id' => $explanation_id 
            );
            $this->db->where('firm_id', $firm_id);
             $this->db->where('record_status', 1);
            $this->db->update('firm', $data); 
             
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           $deger=false;
         }
  
         return $deger;     
   }
   
    public function updateFirmOldIletisim($firm_id)
   {
        
        $deger=true;
        try { 
            $data = array(
               'record_status' => 0               
            );
            $this->db->where('firm_id', $firm_id);
            $this->db->update('iletisim', $data); 
             
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           $deger=false;
         }
  
         return $deger;     
   }
 
    public function updateFirmApprovedStatus($firm_id,$user_id)
   {
        $dateTime = date('Y-m-d H:i:s');
        $deger=true;
        try { 
            $data = array(
              'approved_user_id' => $user_id ,
              'approved_date' => $dateTime  ,
              'approved_status' => 1 
            );
            $this->db->where('firm_id', $firm_id);
            $this->db->update('firm', $data); 
             
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           $deger=false;
         }
  
         return $deger;     
   }
   
    public function updateFirmCostApprovedStatus($firm_id,$user_id,$ourservices_id)
    {
        $dateTime = date('Y-m-d H:i:s');
        $deger=true;
        try { 
            $data = array(
              'approved_user_id' => $user_id ,
              'approved_date' => $dateTime  ,
              'approved_status' => 1 
            );
            $this->db->where('firm_id', $firm_id);
            $this->db->where('firm_ourservices_id', $ourservices_id);
            $this->db->where('approved_status', 0);
            $this->db->update('firm_ourservices', $data); 
            
            $this->db->where('firm_id', $firm_id);
            $this->db->where('firm_ourservices_id', $ourservices_id);
            $this->db->where('approved_status', 0);
            $this->db->update('firm_ourservices_cost', $data); 
            
            
             
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           $deger=false;
         }
  
         return $deger;     
   }
    public function insertFirmOurServicesApprovedAll($_firm_id,$ourservices_id,$dataevent,$dataticket,$dataphoto,$dataweb,$eventstatus,$ticketstatus,$webstatus,$photographer_status)
   {
       
        try { 
            $user_id=$this->session->userdata('user_id');
            if ($eventstatus!=1)
                $this->generalChangeProcess_model->insertTables('firm_event_package',$dataevent);            
            if ($ticketstatus!=1)
                $this->generalChangeProcess_model->insertTables('firm_ticket_package',$dataticket);
            if ($webstatus!=1)
            {    
                $dataweb["completed_status"]=0;
                $this->generalChangeProcess_model->insertTables('frm_web_package',$dataweb);
            }
            if($photographer_status !=1){
                $dataphoto["completed_status"]=0;
                $this->generalChangeProcess_model->insertTables('firm_photo_package',$dataphoto); 
            }
            
            $eventprocesstype=2;
            $ticketprocesstype=3;
            $webprocesstype=1;
            $photoprocesstype=4;
            
            /*
             * SELECT `firm_payment_muaf_id`, `firm_id`, `firm_ourservice_id`, `process_dt`, `process_type_id`, `start_date`, 
             * `end_date`, `explanation`, `approved_status`, `approved_user_id`, `approved_dt`, 
             * `record_status`, `insert_user_id`, `insert_date`, `update_user_id`, `update_date` FROM `firm_payment_muaf` WHERE 1
             */
            
            $dateTime = date('Y-m-d H:i:s');
            if ($eventstatus==3)
            {
                 $dataevent_muaf=array();
                 $dataevent_muaf["firm_id"]=$dataevent[0]["firm_id"];
                 $dataevent_muaf["firm_ourservice_id"]=$dataevent[0]["frm_ourservice_id"];
                 $dataevent_muaf["process_dt"]=$dateTime ;
                 $dataevent_muaf["process_type_id"]=$eventprocesstype;
                 $dataevent_muaf["start_date"]=$dataevent[0]["start_dt"];
                 $dataevent_muaf["end_date"]=$dataevent[0]["end_dt"];
                 $dataevent_muaf["explanation"]="Event Muaf";
                  
                 $dataevent_muaf["insert_user_id"] = $user_id; 
                 $dataevent_muaf["insert_dt"] = $dateTime;
                 $dataevent_muaf["update_user_id"] = $user_id;                
                 $dataevent_muaf["update_dt"] =$dateTime;
                 $dataevent_muaf["approved_user_id"] = $user_id; ;
                 $dataevent_muaf["approved_dt"] =null;
                 $dataevent_muaf["approved_status"] =0;
                 $dataevent_muaf["record_status"] =1;
                    
                $this->generalChangeProcess_model->insertTables('firm_payment_muaf',$dataevent_muaf);            
            }
            if ($ticketstatus==3)
            {
                 $dataticket_muaf=array();
                
                 $dataticket_muaf["firm_id"]=$dataticket[0]["firm_id"];
                 $dataticket_muaf["firm_ourservice_id"]=$dataticket[0]["frm_ourservice_id"];
                 $dataticket_muaf["process_dt"]=$dateTime ;
                 $dataticket_muaf["process_type_id"]=$ticketprocesstype;
                 $dataticket_muaf["start_date"]=$dataticket[0]["start_dt"];
                 $dataticket_muaf["end_date"]=$dataticket[0]["end_dt"];
                 $dataticket_muaf["explanation"]="Ticket Muaf";
                  
                 $dataticket_muaf["insert_user_id"] = $user_id; 
                 $dataticket_muaf["insert_dt"] = $dateTime;
                 $dataticket_muaf["update_user_id"] = $user_id;                
                 $dataticket_muaf["update_dt"] =$dateTime;
                 $dataticket_muaf["approved_user_id"] = $user_id ;
                 $dataticket_muaf["approved_dt"] =$dateTime;
                 $dataticket_muaf["approved_status"] =1;
                 $dataticket_muaf["record_status"] =1;
                $this->generalChangeProcess_model->insertTables('firm_payment_muaf',$dataticket_muaf);
            }
            if ($webstatus==3)
            {            
                 
                 $dataweb_muaf=array();
                
                 $dataweb_muaf["firm_id"]=$dataweb[0]["firm_id"];
                 $dataweb_muaf["firm_ourservice_id"]=$dataweb[0]["frm_ourservice_id"];
                 $dataweb_muaf["process_dt"]=$dateTime ;
                 $dataweb_muaf["process_type_id"]=$webprocesstype;
                 $dataweb_muaf["start_date"]=$dataweb[0]["start_dt"];
                 $dataweb_muaf["end_date"]=$dataweb[0]["end_dt"];
                 $dataweb_muaf["explanation"]="Web Muaf";
                  
                 $dataweb_muaf["insert_user_id"] = $user_id; 
                 $dataweb_muaf["insert_dt"] = $dateTime;
                 $dataweb_muaf["update_user_id"] = $user_id;                
                 $dataweb_muaf["update_dt"] =$dateTime;
                 $dataweb_muaf["approved_user_id"] = $user_id ;
                 $dataweb_muaf["approved_dt"] =$dateTime;
                 $dataweb_muaf["approved_status"] =1;
                 $dataweb_muaf["record_status"] =1;
                $this->generalChangeProcess_model->insertTables('firm_payment_muaf',$dataweb_muaf);
                
            }
            if($photographer_status ==3)
            {   
                 $dataphoto_muaf=array();                
                 $dataphoto_muaf["firm_id"]=$dataphoto[0]["firm_id"];
                 $dataphoto_muaf["firm_ourservice_id"]=$dataphoto[0]["frm_ourservice_id"];
                 $dataphoto_muaf["process_dt"]=$dateTime ;
                 $dataphoto_muaf["process_type_id"]=$photoprocesstype;
                 $dataphoto_muaf["start_date"]=date('Y-m-d');
                 $dataphoto_muaf["end_date"]= date('yy-mm-dd', strtotime('+1 year'));;
                 $dataphoto_muaf["explanation"]="Photo Muaf";
                  
                 $dataphoto_muaf["insert_user_id"] = $user_id; 
                 $dataphoto_muaf["insert_dt"] = $dateTime;
                 $dataphoto_muaf["update_user_id"] = $user_id;                
                 $dataphoto_muaf["update_dt"] =$dateTime;
                 $dataphoto_muaf["approved_user_id"] = $user_id ;
                 $dataphoto_muaf["approved_dt"] =$dateTime;
                 $dataphoto_muaf["approved_status"] =1;
                 $dataphoto_muaf["record_status"] =1;
                
                $this->generalChangeProcess_model->insertTables('firm_payment_muaf',$dataphoto_muaf); 
            }
            
            //$this->updateFirmApprovedStatus($_firm_id,$user_id);
            //$this->updateFirmCostApprovedStatus($_firm_id,$user_id,$ourservices_id);
            
            $deger=true;
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
            $deger=false;
        }
         return  $deger;     
   }
      public function FirmApproved($firm_id)
   {
        $dateTime = date('Y-m-d H:i:s');
        $user_id=$this->session->userdata('user_id');
        $deger=true;
        try { 
            $data = array(
                 'approved_status' => 1,
                'approved_dt' => $dateTime,
                'approved_user_id' => $user_id
                
            );
            $this->db->where('firm_id', $firm_id);
            $this->db->update('firm', $data); 
             
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           $deger=false;
         }
  
         return $deger;     
   }
    
     public function insertFirmOurServicesAll($firm_id,$event_package,$ticket_package,$photo_package,$dataphoto,$dataeventcost,$dataticketcost,$dataphotocost,$dataweb)
   {
        $_firm_ourservices_cost_id=0;
        try { 
             
            if($event_package["event_status"]!=1)
            {
                $_firm_ourservices_cost_id=$this->generalChangeProcess_model->insertTables('firm_ourservices_cost',$dataeventcost); 
                $event_package["ourservice_cost_id"] = $_firm_ourservices_cost_id;
                $firm_event_package=$this->generalChangeProcess_model->insertTables("firm_event_package",$event_package);
            }
            if($ticket_package["ticket_status"]!=1)
            {
                $_firm_ourservices_cost_id=$this->generalChangeProcess_model->insertTables('firm_ourservices_cost',$dataticketcost); 
                $ticket_package["ourservice_cost_id"] = $_firm_ourservices_cost_id;
                 $this->generalChangeProcess_model->insertTables("firm_ticket_package",$ticket_package);
                      
            }
            
            if($photo_package["photo_status"]!=1)
            {
               
                $_firm_ourservices_cost_id=$this->generalChangeProcess_model->insertTables('firm_ourservices_cost',$dataphotocost);
                $photo_package["ourservice_cost_id"] = $_firm_ourservices_cost_id;
                $this->generalChangeProcess_model->insertTables("firm_photo_package",$photo_package);
                $dataphoto["ourservice_cost_id"] = $_firm_ourservices_cost_id;
                $_firm_ourservices_photos_id= $this->generalChangeProcess_model->insertTables('firm_ourservices_photos',$dataphoto); 
          
                       
            }
           
              $this->prtTableProcess_model->updateFirmProcess($firm_id,2,0,1);//ourservices
           
            
            $get_status=0; 
            if($event_package["event_status"]!=1)
                  $get_status=1; 
            $this->prtTableProcess_model->updateFirmProcess($firm_id,3,$get_status,1);//event
            
            $get_status=0; 
            if($ticket_package["ticket_status"]!=1)
                  $get_status=1; 
            $this->prtTableProcess_model->updateFirmProcess($firm_id,4,$get_status,1);//ticket
            
            $get_status=0; 
            if($dataweb["muaf_status"]!=1)
            {
                  $get_status=1; 
                  $dataphotocost["ourservice_cost_id"] = 0;
                  $_firm_web_id= $this->generalChangeProcess_model->insertTables('frm_web_package',$dataweb); 
          
            }
            $this->prtTableProcess_model->updateFirmProcess($firm_id,5,$get_status,1);//web
            
             $get_status=0; 
            if($photo_package["photo_status"]!=1)
                  $get_status=1; 
            $this->prtTableProcess_model->updateFirmProcess($firm_id,6,$get_status,1);//photo
            
            
            
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
        }
         return true;     
   }

   
   public function updateFirmOurServicesId($firm_id,$firm_ourservices_id)
   {
        
        $deger=true;
        try { 
            $data = array(
               'firm_ourservice_id' => $firm_ourservices_id               
            );
            $this->db->where('firm_id', $firm_id);
             $this->db->where('record_status', 1);
            $this->db->update('firm', $data); 
             
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           $deger=false;
         }
  
         return $deger;     
   }

}

