<?php
class firmChangeProcessyedek_model extends CI_Model {
   
     //  iletisim_tel table is updated by firm_id which is sent
   public function updatePhotosFirm($id,$data)
   {
        
        $deger=true;
        try { 
             
             $this->db->where('iletisim_id', $id);
             $this->db->update('iletisim_tel', $data);
             
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           $deger=false;
         }
  
         return $deger;     
   }
   
   public function updateAvatarPath($user_id,$data)
    {
        
        $deger=true;
        try { 
             
             $this->db->where('user_id', $user_id);
             $this->db->where('record_status', 1);
             $this->db->update('photos', $data);
             
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           $deger=false;
         }
  
         return $deger;     
   }

   
   public function updateiconPath($lan_id,$data)
    {
        
        $deger=true;
        try { 
             
             $this->db->where('language_id', $lan_id);
             $this->db->where('record_status', 1);
             $this->db->update('prt_language', $data);
             
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           $deger=false;
         }
  
         return $deger;     
   }
   
   public function updateFirmIletisimTel($iletisim_id,$data)
   {
        
        $deger=true;
        try { 
             
             $this->db->where('iletisim_id', $iletisim_id);
             $this->db->where('record_status', 1);
             $this->db->update('iletisim_tel', $data);
             
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
   
   
   public function updateFirmOurServicesAll($firm_id,$firm_ourservices_photos_id,$event_package,$ticket_package,
           $photo_package,$dataphoto,$dataeventcost,$dataticketcost,$dataphotocost,$photoourservice_cost_id,
           $eventourservice_cost_id,$ticketourservice_cost_id,$web_package)
   {
        
        $deger=true;
        try { 
            
            $this->load->model("userChangeProcess_model");
            $this->load->model("userProcess_model");
            $this->load->model("prtTableProcess_model");
            
            //$result1= $this->generalChangeProcess_model->updateTable('firm_ourservices',$firm_ourservices_id, $datafirm); 
            $result4= $this->generalChangeProcess_model->updateTable('firm_ourservices_photos',$firm_ourservices_photos_id, $dataphoto);  
            $result1= $this->updateFirmEventPackagebyOurServiceCostId($firm_id,$eventourservice_cost_id,$event_package);
            $result2= $this->updateFirmTicketPackagebyOurServiceCostId($firm_id,$ticketourservice_cost_id,$ticket_package) ; 
            $result3= $this->updateFirmWebPackagebyOurServiceCostId($firm_id,$web_package) ;
            $result5= $this->updateFirmPhotoPackagebyOurServiceCostId($firm_id,$photoourservice_cost_id,$photo_package) ;
             
            $this->updateFirmCostbyOurServicesId($firm_id,$eventourservice_cost_id,$dataeventcost,1);
            $this->updateFirmCostbyOurServicesId($firm_id,$ticketourservice_cost_id,$dataticketcost,2); 
            $this->updateFirmCostbyOurServicesId($firm_id,$photoourservice_cost_id,$dataphotocost,4); 
            
            $get_status=0; 
            if($event_package["event_status"]!=1)
                  $get_status=1; 
            $this->prtTableProcess_model->updateFirmProcess($firm_id,3,$get_status,1);//event
            
            $get_status=0; 
            if($ticket_package["ticket_status"]!=1)
                  $get_status=1; 
            $this->prtTableProcess_model->updateFirmProcess($firm_id,4,$get_status,1);//ticket
            
            $get_status=0; 
            if($web_package["muaf_status"]!=1)
                  $get_status=1; 
            $this->prtTableProcess_model->updateFirmProcess($firm_id,5,$get_status,1);//web
            
             $get_status=0; 
            if($photo_package["photo_status"]!=1)
                  $get_status=1; 
            $this->prtTableProcess_model->updateFirmProcess($firm_id,6,$get_status,1);//photo
            
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           $deger=false;
         }
  
         return $deger;     
   }
   
   public function updateFirmEventPackagebyOurServiceCostId($firm_id,$firm_ourservice_cost_id,$dataeventpackage)
   {
        
        $deger=true;
        try { 
           
            $this->db->where('firm_id', $firm_id);
            $this->db->where('record_status', 1);
            $this->db->where('ourservice_cost_id', $firm_ourservice_cost_id);
            $this->db->update('firm_event_package', $dataeventpackage); 
             
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           $deger=false;
         }
  
         return $deger;     
   }
   public function updateFirmTicketPackagebyOurServiceCostId($firm_id,$firm_ourservice_cost_id,$dataticketpackage)
   {
        
        $deger=true;
        try { 
           
            $this->db->where('firm_id', $firm_id);
            $this->db->where('record_status', 1);
            $this->db->where('ourservice_cost_id', $firm_ourservice_cost_id);
            $this->db->update('firm_ticket_package', $dataticketpackage); 
             
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           $deger=false;
         }
  
         return $deger;     
   }
   public function updateFirmPhotoPackagebyOurServiceCostId($firm_id,$firm_ourservice_cost_id,$dataphotopackage)
   {
        
        $deger=true;
        try { 
           
            $this->db->where('firm_id', $firm_id);
            $this->db->where('record_status', 1);
            $this->db->where('ourservice_cost_id', $firm_ourservice_cost_id);
            $this->db->update('firm_photo_package', $dataphotopackage); 
             
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           $deger=false;
         }
  
         return $deger;     
   }
   public function updateFirmWebPackagebyOurServiceCostId($firm_id,$datawebpackage)
   {
        
        $deger=true;
        try { 
           
            $this->db->where('firm_id', $firm_id);
            $this->db->where('record_status', 1);
            $this->db->update('frm_web_package', $datawebpackage); 
             
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           $deger=false;
         }
  
         return $deger;     
   }
    public function updateFirmCostbyOurServicesId($firm_id,$firm_ourservice_cost_id,$dataeventcost,$type)
   {
        
        $deger=true;
        try { 
           
            $this->db->where('firm_id', $firm_id);
            $this->db->where('record_status', 1);
            $this->db->where('firm_ourservices_cost_id', $firm_ourservice_cost_id);
            $this->db->where('invoice_group_id', $type);
            $this->db->update('firm_ourservices_cost', $dataeventcost); 
             
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           $deger=false;
         }
  
         return $deger;     
   }
   public function updateFirmOurServicesId($firm_id,$firm_ourservice_cost_id)
   {
        
        $deger=true;
        try { 
            $data = array(
               'ourservice_Cost_id' => $firm_ourservice_cost_id               
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
    function insertFirmProcess($firm_id)
    {
        $process= $this->getFirmProcess();
        $dateTime = date('Y-m-d H:i:s');
        foreach ($process as $row)
        { 
                
                $datafirm = array();
                $datafirm["firm_id"] = $firm_id;
                $datafirm["record_process_id"] = $row["record_process_id"]; 
                $datafirm["completed"] = 0;
                $datafirm["get_status"] = 0;
                $datafirm["insert_dt"] = $dateTime;
                $datafirm["update_dt"] = $dateTime;
                 $datafirm["insert_user_id"] = $this->session->userdata('user_id');;
                $datafirm["update_user_id"] = $this->session->userdata('user_id');;
                $this->generalChangeProcess_model->insertTables('firm_record_process',$datafirm); 
            
        }
        return true;
    }
     
      
    function getFirmProcess()
     {
        $_SQL = "SELECT `record_process_id`, `record_process_txt`, `order_id`, `record_status` FROM `prt_firm_record_process` WHERE record_status=1 order by order_id";
     
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
            $datafirmusage["ourservice_cost_id"]=0;
            $_portalusage_id=$this->generalChangeProcess_model->insertTables('firm_portal_usage',$datafirmusage);
           
            $this->updateFirmUsageId($firm_id,$_portalusage_id);
            
            
            $datacost["firm_id"]=$firm_id;
            $datacost["firm_portal_usage_id"]=$_portalusage_id;
            $ourservices_cost_id=$this->generalChangeProcess_model->insertTables('firm_ourservices_cost',$datacost);
            
            $this->updateFirmUsagebyCostId($_portalusage_id,$ourservices_cost_id);
           
           
            $dataRegisty["firm_id"]=$firm_id;
            $dataRegisty["firm_portal_usage_id"]=$_portalusage_id;
            $ourservices_cost_free_id=$this->generalChangeProcess_model->insertTables('firm_ourservices_cost',$dataRegisty);
           
            $this->prtTableProcess_model->updateFirmProcess($firm_id,1,0,1); //firma eklendi processi completed
                        
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           
         }
  
         return $_firm_id;     
   }
   
   public function updateFirmAll($_firm_id,$_iletisim_id,$firmexplanation_id,$firm_portal_usage_id,$datafirm,$datailetisim,$datailetisimtel,$datafirmexplanation,$datafirmusage,$datacost,$datacost1)
   {
        
        $deger=true;
        try { 
                 
            $result1= $this->generalChangeProcess_model->updateTable('firm',$_firm_id, $datafirm); 
            $result2= $this->generalChangeProcess_model->updateTable('iletisim',$_iletisim_id, $datailetisim);      
            $result3= $this->updateFirmIletisimTel($_iletisim_id, $datailetisimtel); 
            $result4= $this->generalChangeProcess_model->updateTable('firm_explanation',$firmexplanation_id, $datafirmexplanation); 
            $result5= $this->generalChangeProcess_model->updateTable('firm_portal_usage',$firm_portal_usage_id, $datafirmusage); 
            $result6=  $this->updateFirmCostbyUsage($firm_portal_usage_id, $datacost); 
            $result6=  $this->updateFirmCostbyFee($firm_portal_usage_id, $datacost1); 
            
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
     public function updateFirmUsagebyCostId($_portalusage_id,$ourservices_cost_id)
   {
        
        $deger=true;
        try { 
            $data = array(
               'ourservice_cost_id' => $ourservices_cost_id               
            );
            $this->db->where('firmportal_usage_id', $_portalusage_id);
             $this->db->where('record_status', 1);
            $this->db->update('firm_portal_usage', $data); 
             
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           $deger=false;
         }
  
         return $deger;     
   }
   
    public function updateFirmCostbyUsage($firm_portal_usage_id,$datacost)
   {
        
        $deger=true;
        try { 
  
            $this->db->where('firm_portal_usage_id', $firm_portal_usage_id);
            $this->db->where('record_status', 1);
            $this->db->where('invoice_group_id', 5);
            $this->db->update('firm_ourservices_cost', $datacost); 
             
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           $deger=false;
         }
  
         return $deger;     
   }
   public function updateFirmCostbyFee($firm_portal_usage_id,$datacost)
   {
        
        $deger=true;
        try { 
      
            $this->db->where('firm_portal_usage_id', $firm_portal_usage_id);
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
   
   
   public function updateFirmPotralUsageId($firm_id,$portalusage_id)
   {
        
        $deger=true;
        try { 
            $data = array(
               'portalusage_id' => $portalusage_id               
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
   

      public function updateFirmServiceLanguage($language_id,$firm_id,$data)
   {
        
        $deger=true;
        try { 
           
            $this->db->where('firm_id', $firm_id);
             $this->db->where('language_id', $language_id);
            $this->db->update('firm_servicegiven_language', $data); 
             
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
   
   public function updateFirmServices($firm_id, $servicegroup_id,$subservicegroup_id,$recordstatus)
   {
        
        $deger=true;
        try { 
            $data = array(
               'record_status' => $recordstatus               
            );
            $this->db->where('subservice_id', $subservicegroup_id);
            $this->db->where('servicegroup_id', $servicegroup_id);
            $this->db->where('firm_id', $firm_id);
            $this->db->update('firm_service', $data); 
             
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
   
  /*  public function updateFirmCostApprovedStatus($firm_id,$user_id,$ourservices_id)
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
   }*/
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
    
   
}
