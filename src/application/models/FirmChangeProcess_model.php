<?php
class firmChangeProcess_model extends CI_Model {
   
    public function insertOurServiceEventPhotoPackage($firm_id,$event_package,$photo_package,$dataeventcost,$dataphotocost)
   {
        $_firm_ourservices_cost_id=0;
        $active_event_package=$this->firmProcess_model->getActiveEventPackage($firm_id);
        $active_photo_package=$this->firmProcess_model->getActivePhotoPackage($firm_id);
        try { 
             $dateTime = date('Y-m-d H:i:s');
              $_record_status=1;
              $user_id=$this->session->userdata('user_id');
              $muaf_status=0;
             
            if($event_package["event_status"]!=1)// package  having 
            {
                 $_firm_ourservices_cost_id=$this->generalChangeProcess_model->insertTables('firm_ourservices_cost',$dataeventcost); 
                  
                if(isset($active_event_package[0]["firm_event_package_id"])) // if firm has got active package
                {
                                  
                     
                   
                    $active_event_package_id=$active_event_package[0]["firm_event_package_id"];
                      
                     
                            $event_package1 = array();
                            $event_package1["firm_id"]=$firm_id;
                            $event_package1["evet_package_id"]=$event_package["evet_package_id"];
                            $event_package1["amount"]=$event_package["amount"];
                            $event_package1["event_package_pieces"]=$event_package["event_package_pieces"];
                            $event_package1["support_package_status"]=$event_package["support_package_status"];
                            $event_package1["event_status"]=$event_package["event_status"];
                            $event_package1["record_status"]=$_record_status;
                            if($this->input->post("event_status")==3)
                               $muaf_status=1;
                            $event_package1["muaf_status"]=$muaf_status;
                            $event_package1["approved_status"]=0;
                            $event_package1["approved_user_id"]=0;
                            $event_package1["approved_dt"]=null;
                            $event_package1["insert_user_id"]=$user_id;
                            $event_package1["update_user_id"]=$user_id;
                            $event_package1["insert_dt"]=$dateTime;
                            $event_package1["update_dt"]=$dateTime;
                            $event_package1["active_status"]=0;
                            $event_package1["next_event_package_id"]=0;
                            $event_package1["old_event_package_id"]=$active_event_package[0]["firm_event_package_id"];
                            $event_package1["ourservice_cost_id"] = $_firm_ourservices_cost_id;
                            $_firm_new_package_id=$this->generalChangeProcess_model->insertTables('firm_event_package',$event_package1);

                            $this->updateEventPackagebynexId($active_event_package_id,$_firm_new_package_id);                 
                  
                     
                }
                else
                {
                   
                    $event_package["ourservice_cost_id"] = $_firm_ourservices_cost_id;
                    $event_package["next_event_package_id"]=0;
                    $event_package["old_event_package_id"]=0;
                    $event_package["active_status"]=1;
                    $firm_event_package=$this->generalChangeProcess_model->insertTables("firm_event_package",$event_package);
                }
            }
            
            
            if($photo_package["photo_status"]!=1)
            {
               
                $_firm_ourservices_cost_id=$this->generalChangeProcess_model->insertTables('firm_ourservices_cost',$dataphotocost);
                 if(isset($active_photo_package[0]["firm_photo_package_id"])) // if firm has got active package
                {
                           $active_package_id=$active_photo_package[0]["firm_photo_package_id"];
                           $muaf_status=0;
                           $photo_package1 = array();
                           $photo_package1["firm_id"]=$firm_id;
                           //$photo_package["frm_ourservice_id"]=$row["firm_ourservices_id"];
                           $photo_package1["photo_count"]=$photo_package["photo_count"];
                           $photo_package1["completed_status"]=0;
                           $photo_package1["amount"]=$photo_package["amount"];
                           $photo_package1["photo_status"]=$photo_package["photo_status"];
                           $photo_package1["record_status"]=$_record_status;
                           if($photo_package["photo_status"]==3)
                              $muaf_status=1;
                           $photo_package1["muaf_status"]=$muaf_status;
                           $photo_package1["approved_status"]=0;
                           $photo_package1["approved_user_id"]=0;
                           $photo_package1["approved_dt"]=null;
                           $photo_package1["record_status"]=$_record_status;
                           $photo_package1["insert_user_id"]=$user_id;
                           $photo_package1["update_user_id"]=$user_id;
                           $photo_package1["insert_dt"]=$dateTime;
                           $photo_package1["update_dt"]=$dateTime;
                           $photo_package1["photo_package_id"]= $photo_package["photo_package_id"];
                           $photo_package1["active_status"]=0;
                           $photo_package1["next_photo_package_id"]=0;
                           $photo_package1["old_photo_package_id"]=$active_photo_package[0]["firm_photo_package_id"];
                           $photo_package1["ourservice_cost_id"] = $_firm_ourservices_cost_id;
                           $_firm_ourservices_photos_id= $this->generalChangeProcess_model->insertTables('firm_photo_package',$photo_package1); 
                           
                           $this->updatePhotoPackagebynexId($active_package_id,$_firm_ourservices_photos_id); 
                           
                          // $dataphoto["ourservice_cost_id"] = $_firm_ourservices_cost_id;
                          // $_firm_ourservices_photos_id= $this->generalChangeProcess_model->insertTables('firm_ourservices_photos',$dataphoto); 
              
                      
                }
                else{
                       $photo_package["ourservice_cost_id"] = $_firm_ourservices_cost_id;
                       $photo_package["active_status"]=1;
                       $this->generalChangeProcess_model->insertTables("firm_photo_package",$photo_package);
                       $dataphoto["ourservice_cost_id"] = $_firm_ourservices_cost_id;
                       $_firm_ourservices_photos_id= $this->generalChangeProcess_model->insertTables('firm_ourservices_photos',$dataphoto); 
              
                 }
                        
            }
            
            
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
        }
         return true;     
   }
   
    public function insertOurServiceTicketPackage($firm_id,$ticket_package,$dataticketcost)
   {
        $_firm_ourservices_cost_id=0;
        $active_ticket_package=$this->firmProcess_model->getActiveTicketPackage($firm_id);
       
        try { 
             $dateTime = date('Y-m-d H:i:s');
              $_record_status=1;
              $user_id=$this->session->userdata('user_id');
              $muaf_status=0;
             
            if($ticket_package["ticket_status"]!=1)// package  having 
            {
                 $_firm_ourservices_cost_id=$this->generalChangeProcess_model->insertTables('firm_ourservices_cost',$dataticketcost); 
                  
                if(isset($active_ticket_package[0]["firm_ticket_package_id"])) // if firm has got active package
                {
                                  
                     
                   
                    $active_package_id=$active_ticket_package[0]["firm_ticket_package_id"];
                      
                     
                            $ticket_package1 = array();
                            $ticket_package1["firm_id"]=$firm_id;
                            //$ticket_package["frm_ourservice_id"]=$row["firm_ourservices_id"];
                            $ticket_package1["ticket_package_id"]=$ticket_package["ticket_package_id"];
                            $ticket_package1["ticket_pieces"]=$ticket_package["ticket_pieces"]; 
                            $ticket_package1["amount"]=$ticket_package["amount"];
                            $ticket_package1["support_package_status"]=$ticket_package["support_package_status"];
                             $ticket_package1["ticket_status"]=$ticket_package["ticket_status"];
                            $ticket_package1["record_status"]=$_record_status;
                              if($ticket_package["ticket_status"]==3)
                               $muaf_status=1;
                            $ticket_package1["muaf_status"]=$muaf_status;
                            $ticket_package1["approved_status"]=0;
                            $ticket_package1["approved_user_id"]=0;
                            $ticket_package1["approved_dt"]=null;
                            $ticket_package1["record_status"]=$_record_status;
                            $ticket_package1["insert_user_id"]=$user_id;
                            $ticket_package1["update_user_id"]=$user_id;
                            $ticket_package1["insert_dt"]=$dateTime;
                            $ticket_package1["update_dt"]=$dateTime;
                            
                            $ticket_package1["active_status"]=0;
                            $ticket_package1["next_ticket_package_id"]=0;
                            $ticket_package1["old_ticket_package_id"]=$active_ticket_package[0]["firm_ticket_package_id"];
                            $ticket_package1["ourservice_cost_id"] = $_firm_ourservices_cost_id;
                            $_firm_new_package_id=$this->generalChangeProcess_model->insertTables('firm_ticket_package',$ticket_package1);

                            $this->updateTicketPackagebynexId($active_package_id,$_firm_new_package_id);                 
                  
                     
                }
                else
                {
                   
                    $ticket_package["ourservice_cost_id"] = $_firm_ourservices_cost_id;
                    $ticket_package["next_ticket_package_id"]=0;
                    $ticket_package["old_ticket_package_id"]=0;
                    $ticket_package["active_status"]=1;
                    $firm_ticket_package=$this->generalChangeProcess_model->insertTables("firm_ticket_package",$ticket_package);
                }
            }
            
            
            
            
            
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
        }
         return true;     
   }
    public function updateTicketPackagebynexId($active_package_id, $next_package_id)
   {
        
        $deger=true;
        try { 
            $data = array(
               'next_ticket_package_id' => $next_package_id               
            );
            $this->db->where('firm_ticket_package_id', $active_package_id);
            $this->db->update('firm_ticket_package', $data); 
             
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           $deger=false;
         }
  
         return $deger;     
   }
     public function updateEventPackagebynexId($active_package_id, $next_event_package_id)
   {
        
        $deger=true;
        try { 
            $data = array(
               'next_event_package_id' => $next_event_package_id               
            );
            $this->db->where('firm_event_package_id', $active_package_id);
            $this->db->update('firm_event_package', $data); 
             
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           $deger=false;
         }
  
         return $deger;     
   }
   
    public function updatePhotoPackagebynexId($active_package_id, $next_event_package_id)
   {
        
        $deger=true;
        try { 
            $data = array(
               'next_photo_package_id' => $next_event_package_id               
            );
            $this->db->where('firm_photo_package_id', $active_package_id);
            $this->db->update('firm_photo_package', $data); 
             
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           $deger=false;
         }
  
         return $deger;     
   }
   
    public function insertFirmWebPackage($dataweb,$datawebCost,$datawebprocess)
   {
        $firm_web_id=0;
        $get_status=0; 
        if($dataweb["muaf_status"]!=1)
        {
                  $get_status=1; 
                  if($dataweb["amount"]==0)
                  {
                      $dataweb["ourservice_cost_id"] = 0;
                      $firm_web_id= $this->generalChangeProcess_model->insertTables('frm_web_package',$dataweb); 
                  }else
                  {
                      $firm_web_cost_id=$this->generalChangeProcess_model->insertTables('firm_ourservices_cost',$datawebCost); 
                      $dataweb["ourservice_cost_id"] = $firm_web_cost_id;
                      $firm_web_id= $this->generalChangeProcess_model->insertTables('frm_web_package',$dataweb); 
                      $datawebprocess["firm_web_package_id"] = $firm_web_id;
                      $firm_web_process_id=$this->generalChangeProcess_model->insertTables('web_process_history',$datawebprocess); 
                  }
                  
          
        } 
        return $firm_web_id;
   }
   public function updateFirmWebPackage($dataweb,$webpackage_id,$datacost,$webcost_id,$dataprocess,$process_id,$webcost_status,$process_status)
   {
        if($webpackage_id==0)
        {
                  $get_status=1; 
                  if($dataweb["amount"]==0)
                  {
                      $dataweb["ourservice_cost_id"] = 0;
                      $firm_web_id= $this->generalChangeProcess_model->insertTables('frm_web_package',$dataweb); 
                  }else
                  {
                      $firm_web_cost_id=$this->generalChangeProcess_model->insertTables('firm_ourservices_cost',$datawebCost); 
                      $dataweb["ourservice_cost_id"] = $firm_web_cost_id;
                      $firm_web_id= $this->generalChangeProcess_model->insertTables('frm_web_package',$dataweb); 
                      $datawebprocess["firm_web_package_id"] = $firm_web_id;
                      $firm_web_process_id=$this->generalChangeProcess_model->insertTables('web_process_history',$datawebprocess); 
                  }
                   $firm_web_cost_id=$this->generalChangeProcess_model->insertTables('firm_ourservices_cost',$datawebCost); 
                            $dataweb["ourservice_cost_id"] = $firm_web_cost_id;
          
        } 
        else
        {
           
          if($webcost_id==0)
          {
              $firm_web_cost_id=$this->generalChangeProcess_model->insertTables('firm_ourservices_cost',$datawebCost); 
              $dataweb["ourservice_cost_id"] = $firm_web_cost_id;
              $this->generalChangeProcess_model->updateTable('frm_web_package',$webpackage_id,$dataweb);  
              $datawebprocess["firm_web_package_id"] = $webpackage_id;
              $firm_web_process_id=$this->generalChangeProcess_model->insertTables('web_process_history',$datawebprocess); 
          }
          else
          {
              $this->generalChangeProcess_model->updateTable('frm_web_package',$webpackage_id,$dataweb);  
              if($process_status==1)//kayit var ve invoice yaratilmamis
                 $this->generalChangeProcess_model->updateTable('web_process_history',$process_id,$dataprocess); 
              else
              {
                   $datawebprocess["firm_web_package_id"] = $webpackage_id;
                   $firm_web_process_id=$this->generalChangeProcess_model->insertTables('web_process_history',$datawebprocess); 
              }
                  
              if($webcost_status==1)
                $this->generalChangeProcess_model->updateTable('firm_ourservices_cost',$webcost_id,$datacost);
              else
              {
                  $firm_web_cost_id=$this->generalChangeProcess_model->insertTables('firm_ourservices_cost',$datawebCost);
                   $dataweb["ourservice_cost_id"] = $firm_web_cost_id;
                  $this->generalChangeProcess_model->updateTable('frm_web_package',$webpackage_id,$dataweb);  
              }
          }
        }
        return true;
   }
   
   
   
     //  iletisim_tel table is updated by firm_id which is sent
   public function insertFirmOurServicesAll($firm_id,$event_package,$ticket_package,$photo_package,$dataeventcost,$dataticketcost,$dataphotocost,$dataweb)
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
                //$dataphoto["ourservice_cost_id"] = $_firm_ourservices_cost_id;
                //$_firm_ourservices_photos_id= $this->generalChangeProcess_model->insertTables('firm_ourservices_photos',$dataphoto); 
          
                       
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
                  $dataweb["ourservice_cost_id"] = 0;
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
 
    public function updateFirmOurServicesAll($firm_id,$event_package,$ticket_package,
           $photo_package,$dataeventcost,$dataticketcost,$dataphotocost,$photoourservice_cost_id,
           $eventourservice_cost_id,$ticketourservice_cost_id,$web_package)
   {
        
        $deger=true;
        try { 
            
            $this->load->model("userChangeProcess_model");
            $this->load->model("userProcess_model");
            $this->load->model("prtTableProcess_model");
            
            //$result1= $this->generalChangeProcess_model->updateTable('firm_ourservices',$firm_ourservices_id, $datafirm); 
            //$result4= $this->generalChangeProcess_model->updateTable('firm_ourservices_photos',$firm_ourservices_photos_id, $dataphoto);  
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
   public function passUsagePackageInsert($firm_id,$datafirmusage,$datacost,$package_id)
   {
        $deger=true;
        try { 
                 
               
                $datafirmusage["ourservice_cost_id"]=0;
                $_portalusage_id=$this->generalChangeProcess_model->insertTables('firm_portal_usage',$datafirmusage);

                $this->updateFirmUsageId($firm_id,$_portalusage_id);
                $this->updateFirmUsagePackageId($firm_id,$package_id);
                $datacost["firm_portal_usage_id"]=$_portalusage_id;
                $ourservices_cost_id=$this->generalChangeProcess_model->insertTables('firm_ourservices_cost',$datacost);

                $this->updateFirmUsagebyCostId($_portalusage_id,$ourservices_cost_id);
    
           }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           $deger=false;
         }
  
         
   }
    public function passUsagePackageUpdate($firm_id,$firm_portal_usage_id,$datafirmusage,$datacost,$package_id)
   {
        
        $deger=true;
        try { 
                 
            $result5= $this->generalChangeProcess_model->updateTable('firm_portal_usage',$firm_portal_usage_id, $datafirmusage); 
            $result6=  $this->updateFirmCostbyUsage($firm_portal_usage_id, $datacost); 
            $this->updateFirmUsagePackageId($firm_id,$package_id);
         
            
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           $deger=false;
         }
  
         return $deger;     
   }
   
    public function insertFirmIletisimAll($datafirm,$datailetisim,$datailetisimtel,$datafirmexplanation,$datafirmusage,$datacost,$dataRegisty,$dataPaymentTypes,$dataPhoto)
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
/*
            $tips =array(1,2,3);
            $dateTime = date('Y-m-d H:i:s');
            $ilk=0;

            foreach ($tips as $tip){
                $record_status=0;
                if($dataPaymentTypes[$ilk] == $tip){
                    $record_status =1;
                    $ilk++;
                }

                $datapayment["firm_id"] =$firm_id;
                $datapayment["type_id"] =$tip;
                $datapayment["record_status"] =$record_status;
                $datapayment["insert_dt"] =$dateTime;
                $datapayment["insert_user_id"] =$this->session->userdata('user_id');
                $datapayment["update_dt"] =$dateTime;
                $datapayment["update_user_id"] =$this->session->userdata('user_id');
                $datapayment_id =$this->generalChangeProcess_model->insertTables('firm_payment_type',$datapayment);

            }

            foreach ($dataPaymentTypes as $types ){


            }
            */
            if($dataPaymentTypes!=null){
                $dateTime = date('Y-m-d H:i:s');

                foreach ($dataPaymentTypes as $dataPaymentType) {

                    $datapayment["firm_id"] =$firm_id;
                    $datapayment["type_id"] =$dataPaymentType["type"];
                    $datapayment["record_status"] =$dataPaymentType["status"];
                    $datapayment["insert_dt"] =$dateTime;
                    $datapayment["insert_user_id"] =$this->session->userdata('user_id');
                    $datapayment["update_dt"] =$dateTime;
                    $datapayment["update_user_id"] =$this->session->userdata('user_id');
                    $datapayment_id =$this->generalChangeProcess_model->insertTables('firm_payment_type',$datapayment);

                }

            }

            if ($datafirm["photo_free_status"]==1)
            {
                 $dataPhoto["firm_id"] =$firm_id;
                 $datapayment_id =$this->generalChangeProcess_model->insertTables('photographer_delegate',$dataPhoto);

            }
           
            $this->prtTableProcess_model->updateFirmProcess($firm_id,1,0,1); //firma eklendi processi completed
                        
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           
         }
  
         return $_firm_id;     
   }
   
   public function updateFirmAll($_firm_id,$_iletisim_id,$firmexplanation_id,$firm_portal_usage_id,$datafirm,$datailetisim,$datailetisimtel,$datafirmexplanation,$datafirmusage,$datacost,$datacost1,$dataPaymentTypes)
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
            $result7=  $this->updateFirmPaymentTypes($_firm_id, $dataPaymentTypes);

            
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           $deger=false;
         }
  
         return $deger;     
   }

    public  function updateFirmPaymentTypes($_firm_id,$dataPaymentTypes){


        if($dataPaymentTypes!=null){
            $dateTime = date('Y-m-d H:i:s');

            foreach ($dataPaymentTypes as $dataPaymentType) {

                $datapayment["firm_id"] =$_firm_id;
                $datapayment["type_id"] =$dataPaymentType["type"];
                $datapayment["record_status"] =$dataPaymentType["status"];

                $datapayment["update_dt"] =$dateTime;
                $datapayment["update_user_id"] =$this->session->userdata('user_id');

                $this->db->where('type_id', $dataPaymentType["type"]);
                $this->db->where('firm_id', $_firm_id);
                $this->db->update('firm_payment_type', $datapayment);

            }

        }

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
    public function updateFirmUsagePackageId($firm_id,$_package_id)
   {
        
        $deger=true;
        try { 
            $data = array(
               'usage_package_id' => $_package_id               
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
}
